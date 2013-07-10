<?php
$elgg_update_services_update_detail = (isset($vars['elgg_update_services_update_detail'])) ? $vars['elgg_update_services_update_detail'] : NULL;

if (!$elgg_update_services_update_detail) {
	return;
}
?>

<a href="<?php echo $elgg_update_services_update_detail["plugin_url"]; ?>"><?php echo $elgg_update_services_update_detail["plugin_name"]; ?></a>&nbsp;-&nbsp;<?php echo elgg_echo('elgg_update_services:version')?>&nbsp;<?php echo $elgg_update_services_update_detail["plugin_version"]; ?><br>
<<<<<<< HEAD
<a href="<?php echo $elgg_update_services_update_detail["download_url"]; ?>"><?php echo elgg_echo('elgg_update_services:direct_download')?></a><br><br>
=======
<a href="<?php echo $elgg_update_services_update_detail["download_url"]; ?>"><?php echo elgg_echo('elgg_update_services:direct_download')?></a>
>>>>>>> eb1fec2885cb2e561e44e2ad8adb32dd2a9e7973
