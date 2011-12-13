<?php
$elgg_update_services_update_detail = (isset($vars['elgg_update_services_update_detail'])) ? $vars['elgg_update_services_update_detail'] : NULL;

if (!$elgg_update_services_update_detail) {
	return;
}
?>

<a href="<?php echo $elgg_update_services_update_detail["plugin_url"]; ?>"><?php echo $elgg_update_services_update_detail["plugin_name"]; ?></a>&nbsp;-&nbsp;Version&nbsp;<?php echo $elgg_update_services_update_detail["plugin_version"]; ?><br>
<a href="<?php echo $elgg_update_services_update_detail["download_url"]; ?>">Direct Download</a>
