<h3><?php echo elgg_echo('elgg_update_services:notify_mail_address');?></h3>
<?php
	//Notify by mail
    echo elgg_view('input/text', array('name' => "params[notify_mail_address]", 'value' => $vars['entity']->notify_mail_address));