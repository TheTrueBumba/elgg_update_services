<?php
$update_result = elgg_update_services_get_updates();

if (count($update_result["result"]) > 0) {
	foreach($update_result["result"] as $result) {
		$plugin_detail = elgg_view('elgg_update_services/update_detail', array('elgg_update_services_update_detail' => $result));
		$body .= $plugin_detail . '<br>';
	}
}
else {
	$body = '<p class="mtm">' . elgg_echo('elgg_update_services:no_updates') . '</p>';
}

$body = elgg_echo('elgg_update_services:next_check') . ' ' . date('Y/m/d H:i', elgg_get_plugin_setting('execution_date', 'elgg_update_services')) . '<br><br>' . $body;

echo $body;