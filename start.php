<?php
/*******************************************************************************
 * elgg_update_services
 *
 * @author RayJ
 ******************************************************************************/

function elgg_update_services_init() {
	global $CONFIG;
	
	register_plugin_hook('cron', 'daily', 'elgg_update_services_cron');
	
	register_page_handler('elgg_update_services', 'elgg_update_services_page_handler');
	
	register_elgg_event_handler('pagesetup', 'system', 'elgg_update_services_pagesetup');
	
	return true;
}

function elgg_update_services_pagesetup() {
	if (get_context() == 'admin' && isadminloggedin()) {
		global $CONFIG;
		add_submenu_item('ELGG Update Services', $CONFIG->wwwroot . 'pg/elgg_update_services/admin/');
	}
}

function elgg_update_services_page_handler($page) {
	global $CONFIG;
	
	$page = (isset($page[0])) ? $page[0] : FALSE;

	if ($page == 'admin') {
		set_context('admin');
		admin_gatekeeper();
		
		$update_result = elgg_update_services_get_updates();
		
		if (count($update_result["result"]) > 0) {
			foreach($update_result["result"] as $result) {
				$plugin_detail = elgg_view('elgg_update_services/update_detail', array('elgg_update_services_update_detail' => $result));
				$content .= elgg_view("page_elements/contentwrapper", array('body' => $plugin_detail));
			}
		}
		else {
			$content = elgg_view("page_elements/contentwrapper", array('body' => 'No updates available'));
		}

		$title = 'ELGG Update Services';
		
		$body = elgg_view_layout('two_column_left_sidebar', '', elgg_view_title($title) . $content);
		
		page_draw($title, $body);

		return TRUE;
	}

	forward();
}

function elgg_update_services_get_updates() {
	$installed_plugins = get_installed_plugins();
		
	foreach ($installed_plugins as $plugin => $data) {
	
		if (is_plugin_enabled($plugin)) {
			$manifest = load_plugin_manifest($plugin);
			
			$plugin_hash_list[] = md5($plugin . $manifest['version'] . $manifest['author']);
		}
	}
	
	$url = "http://community.elgg.org/services/api/rest/json/?method=plugins.update.check&version=" . get_version(true);
	
	foreach ($plugin_hash_list as $plugin_hash) {
		$url .= "&plugins[]=" . $plugin_hash;
	}
	
	$update_check = elgg_update_services_file_get_conditional_contents($url);
	
	return json_decode($update_check, true);
}

function elgg_update_services_cron($hook, $entity_type, $returnvalue, $params){
	//Retrieve the next execution date
	set_plugin_setting('execution_date', time(), 'elgg_update_services'); // Uncomment this line to test the plugin
	
	$execution_date = get_plugin_setting('execution_date', 'elgg_update_services');
	
	if ($execution_date && $execution_date <= time()) {
		//Run the task
		elgg_update_services_check_update();
		
		//Set the next execution date
		$day = rand(1, 7);
		$hour = rand(1, 24);
		$minute = rand(1, 60);
		
		$execution_date = time() + 604800 + ($day * $hour * $minute * 60);  //One week plus random day, hour and minute.
		
		set_plugin_setting('execution_date', $execution_date, 'elgg_update_services');
	}
	else {
		set_plugin_setting('execution_date', time(), 'elgg_update_services');
	}
}

function elgg_update_services_check_update() {
	$update_result = elgg_update_services_get_updates();
	
	$message = sprintf(elgg_echo('elgg_update_services:message') . "\r\n\r\n");
	
	if (count($update_result["result"]) > 0) {
		foreach($update_result["result"] as $result) {
			//Compose the e-mail				
			$message .= elgg_echo('elgg_update_services:plugin_name') . $result["plugin_name"] . "\r\n";
			$message .= elgg_echo('elgg_update_services:plugin_version') . $result["plugin_version"] . "\r\n";
			$message .= elgg_echo('elgg_update_services:plugin_url') . $result["plugin_url"] . "\r\n";
			$message .= elgg_echo('elgg_update_services:download_url') . $result["download_url"] . "\r\n\r\n";
		}
		//Send the e-mail
		elgg_update_services_notify_admin($message);
	}
}

function elgg_update_services_notify_admin($message){
	global $CONFIG;

	$site = get_entity($CONFIG->site_guid);
	
	if (($site) && (isset($site->email))) {
		$mailfrom = $site->email;
	} else {
		$mailfrom = 'noreply@' . get_site_domain($CONFIG->site_guid);
	}
	
	$mailto = get_plugin_setting("notify_mail_address");
	
	if($mailto){
		elgg_send_email($mailfrom, $mailto, elgg_echo('elgg_update_services:subject'), $message);
	}
}

function elgg_update_services_file_get_conditional_contents($szURL){
	$pCurl = curl_init($szURL);

	curl_setopt($pCurl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($pCurl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($pCurl, CURLOPT_TIMEOUT, 10);

	$szContents = curl_exec($pCurl);
	$aInfo = curl_getinfo($pCurl);

	if($aInfo['http_code'] === 200){
		return $szContents;
	}

	return false;
}

register_elgg_event_handler('init', 'system', 'elgg_update_services_init');