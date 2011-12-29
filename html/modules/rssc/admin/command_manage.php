<?php
// $Id: command_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-11-01 K.OHWADA
// rssc_admin_print_footer()
// _HAPPY_LINUX_CONF_BIN

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME

//================================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//================================================================

include 'admin_header_config.php';

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();

$op = $config_form->get_post_get_op();

if ($op == 'save')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->save();
		redirect_header('command_manage.php', 1, _HAPPY_LINUX_UPDATED);
	}
}
else
{
	xoops_cp_header();
}

$pass = $config_form->get_value_by_name('bin_pass');
$url  = RSSC_URL.'/bin/refresh.php?pass='.$pass.'&amp;limit=10';

rssc_admin_print_header();
rssc_admin_print_menu();

echo "<h4>"._HAPPY_LINUX_CONF_COMMAND_MANAGE."</h4>\n";

$text  = '<a href="create_config.php">'._HAPPY_LINUX_CONF_CREATE_CONFIG."</a><br /><br />\n";
$text .= '<a href="'.$url.'">'._HAPPY_LINUX_CONF_TEST_BIN.": bin/refresh.php</a><br /><br/>\n";
echo $config_form->build_lib_box_style( _HAPPY_LINUX_CONF_COMMAND_MANAGE, '', $text );

echo "<h4>"._HAPPY_LINUX_CONF_BIN."</h4>\n";
echo _HAPPY_LINUX_CONF_BIN_DESC."<br /><br />\n";
$config_form->set_form_title( _HAPPY_LINUX_CONF_BIN );
$config_form->show_by_catid( 2 );

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>