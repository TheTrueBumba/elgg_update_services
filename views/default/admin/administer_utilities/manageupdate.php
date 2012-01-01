<?php
$update_result = elgg_update_services_get_updates();

if (count($update_result["result"]) > 0) {
	foreach($update_result["result"] as $result) {
		$plugin_detail = elgg_view('elgg_update_services/update_detail', array('elgg_update_services_update_detail' => $result));
		$content .= elgg_view("page/elements/wrapper", array('body' => $plugin_detail));
	}
}
else {
	echo elgg_view('page/elements/wrapper', array(
		'body' => elgg_echo('elgg_update_services:no_updates')
	));
	return;
}

$body = elgg_view("page/elements/wrapper", array('body' => $content));

$body = elgg_echo('elgg_update_services:next_check') . ' ' . date('Y/m/d H:i', get_plugin_setting('execution_date', 'elgg_update_services')) . '<br><br>' . $body;

echo $body;