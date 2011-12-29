<?php
// $Id: config_manage_4.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// RSS Center Module
// 2008-01-20 K.OHWADA
//=========================================================

include_once 'admin_header_config.php';

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
		redirect_header('config_manage_4.php', 2, _AM_RSSC_DBUPDATED);
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

echo "<h4>"._AM_RSSC_FORM_CUSTOM_PLUGIN."</h4>\n";

echo '<a href="'. RSSC_URL .'/plugin_popup.php" target="_blank">';
echo ' - '._RSSC_PLUGIN_LIST;
echo '</a>'."<br /><br />\n";

$config_form->set_form_title( _AM_RSSC_FORM_CUSTOM_PLUGIN );
$config_form->show_by_catid( 17 );

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---


?>