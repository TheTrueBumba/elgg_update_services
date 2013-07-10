<?php
$elgg_update_services_update_detail = (isset($vars['elgg_update_services_update_detail'])) ? $vars['elgg_update_services_update_detail'] : NULL;

if (!$elgg_update_services_update_detail) {
	return;
}
?>

<a href="<?php echo $elgg_update_services_update_detail["plugin_url"]; ?>"><?php echo $elgg_update_services_update_detail["plugin_name"]; ?></a>&nbsp;-&nbsp;<?php echo elgg_echo('elgg_update_services:version')?>&nbsp;<?php echo $elgg_update_services_update_detail["plugin_version"]; ?><br>
<a href="<?php echo $elgg_update_services_update_detail["download_url"]; ?>"><?php echo elgg_echo('elgg_update_services:direct_download')?></a><br><br>