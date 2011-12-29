<?php
// $Id: config_manage_2.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2008-01-20 K.OHWADA
// print_xoops_token_error()

// 2007-10-10 K.OHWADA
// remove SAVE

//=========================================================
// RSS Center Module
// 2007-06-01 K.OHWADA
//=========================================================

include_once 'admin_header_config.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/kakasi.php';

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
		redirect_header('config_manage_2.php', 2, _AM_RSSC_DBUPDATED);
	}
}
else
{
	xoops_cp_header();
}

rssc_admin_print_header();
rssc_admin_print_menu();

echo "<h4>"._MI_RSSC_ADMENU_CONFIG."</h4>\n";
$config_form->init_form();

echo "<h4>"._AM_RSSC_FORM_FILTER."</h4>\n";
echo _AM_RSSC_FORM_FILTER_DESC."<br /><br />\n";
$config_form->set_form_title( _AM_RSSC_FORM_FILTER );
$config_form->show_by_catid( 11 );

echo "<h4>"._AM_RSSC_FORM_WORD."</h4>\n";
$config_form->print_executable_kakasi();
$config_form->set_form_title( _AM_RSSC_FORM_WORD );
$config_form->show_by_catid( 13 );

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---


?>