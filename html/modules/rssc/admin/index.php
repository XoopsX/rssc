<?php
// $Id: index.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2009-02-20 K.OHWADA
// map

// 2008-12-20 K.OHWADA
// get_error_str()

// 2007-11-01 K.OHWADA
// show_form_template_compiled_clear
// move bin_command to command_manage.php
// rssc_admin_print_powerdby()

// 2007-06-01 K.OHWADA
// admin_table_class.php

// 2006-11-08 K.OHWADA
// proxy server

// 2006-09-01 K.OHWADA
// use XoopsGTicket

// 2006-07-08 K.OHWADA
// use config_base_handler.php etc
// use check_version() for v0.30
// description in main page

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH
// use check_token()

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include_once 'admin_header_config.php';

$DIR_CONFIG = RSSC_ROOT_PATH.'/cache';

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
		redirect_header('index.php', 1, _HAPPY_LINUX_UPDATED);
	}
}
elseif ($op == 'init')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->init();
		redirect_header('index.php', 1, _HAPPY_LINUX_UPDATED);
	}
}
elseif ($op == 'upgrade')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->upgrade();
		redirect_header('index.php', 1, _HAPPY_LINUX_UPDATED);
	}
}
elseif ($op == 'template_compiled_clear')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->template_compiled_clear();
		redirect_header("index.php", 1, _HAPPY_LINUX_CLEARED );
	}
}
else
{
	xoops_cp_header();
}

rssc_admin_print_header();

if ( !$config_store->check_init() )
{
	$config_form->print_lib_box_init_config();
}
elseif ( !$config_store->check_version() )
{
	$config_form->print_lib_box_upgrade_config( 
		RSSC_VERSION, $config_store->_install->get_error_str() );
}
elseif ( !is_writable( $DIR_CONFIG ) )
{
	xoops_error( _HAPPY_LINUX_CONF_NOT_WRITABLE );
	echo "<br />\n";
	echo "$DIR_CONFIG <br /><br />\n";
}
else
{
	rssc_admin_print_menu();
	echo "<h4>"._MI_RSSC_ADMENU_CONFIG."</h4>\n";
	$config_form->init_form();

	echo "<h4>"._AM_RSSC_FORM_BASIC."</h4>\n";
	echo _AM_RSSC_FORM_BASIC_DESC."<br />\n";
	$config_form->set_form_title( _AM_RSSC_FORM_BASIC );
	$config_form->show_by_catid( 1 );

	echo "<h4>"._AM_RSSC_FORM_MAIN."</h4>\n";
	echo _AM_RSSC_FORM_MAIN_DESC."<br />\n";

// description in main page
	$config_form->set_form_title( _AM_RSSC_FORM_MAIN );
	$config_form->show_by_catid( 3 );
	echo "<br />\n";

	$config_form->show_main();

	echo "<h4>"._AM_RSSC_FORM_BLOCK."</h4>\n";
	echo _AM_RSSC_FORM_BLOCK_DESC."<br />\n";
	$config_form->show_block();

	echo "<h4>"._AM_RSSC_FORM_PROXY."</h4>\n";
	$config_form->set_form_title( _AM_RSSC_FORM_PROXY );
	$config_form->show_by_catid( 10 );

	echo "<h4>"._AM_RSSC_FORM_MAP."</h4>\n";
	$config_form->set_form_title( _AM_RSSC_FORM_MAP );
	$config_form->show_by_catid( 18 );

	echo "<h4>"._HAPPY_LINUX_CONF_TPL_COMPILED_CLEAR."</h4>\n";
	$config_form->show_form_template_compiled_clear( _HAPPY_LINUX_CONF_TPL_COMPILED_CLEAR );
}

rssc_admin_print_footer();
rssc_admin_print_powerdby();
xoops_cp_footer();
exit();
// --- main end ---


?>