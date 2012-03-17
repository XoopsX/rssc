<?php
// $Id: map_manage.php,v 1.1 2012/03/17 13:33:05 ohwada Exp $

//=========================================================
// RSS Center Module
// 2012-03-01 K.OHWADA
//=========================================================

include_once 'admin_header_config.php';
include_once RSSC_ROOT_PATH.'/class/rssc_map.php';

//=========================================================
// class map manage
//=========================================================
class admin_map_manage 
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_map_manage()
{
	$this->_conf_handler =& rssc_get_handler( 'config_basic', RSSC_DIRNAME );
	$this->_config_form  =& admin_config_form::getInstance();
	$this->_config_store =& admin_config_store::getInstance();

	$this->_conf =& $this->_conf_handler->get_conf();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new admin_map_manage();
	}
	return $instance;
}

function get_post_get_op()
{
	return $this->_config_form->get_post_get_op();
}

function check_token()
{
	return $this->_config_form->check_token();
}

function print_xoops_token_error()
{
	$this->_config_form->print_xoops_token_error();
}

function save()
{
	$this->_config_store->save();
}

function main()
{
	rssc_admin_print_header();
	rssc_admin_print_menu();

	echo "<h4>"._AM_RSSC_MAP_MANAGE."</h4>\n";
	$this->_config_form->init_form();

	$this->_config_form->print_check_webmap3_version();
	$ret = $this->webmap3_init();
	if ( $ret ) {
		echo $this->build_map_iframe();
	}

	echo "<h4>"._AM_RSSC_FORM_MAP."</h4>\n";
	$this->_config_form->set_form_title( _AM_RSSC_FORM_MAP );
	$this->_config_form->show_by_catid( 18 );

	rssc_admin_print_footer();
	return true;
}

function webmap3_init()
{
	$webmap3_dirname = $this->_conf['webmap_dirname'];

	$file = XOOPS_ROOT_PATH . '/modules/'.$webmap3_dirname.'/include/api_html.php';
	if ( ! file_exists($file) ) {
		return false;
	}

	include_once $file;
	if ( ! class_exists('webmap3_api_html') ) {
		return false;
	}

	$this->_html_class  =& webmap3_api_html::getSingleton( $webmap3_dirname );
	return true;
}

function build_map_iframe()
{
	$url = RSSC_URL.'/get_location.php';
	$this->_html_class->set_display_iframe_url( $url );
	return $this->_html_class->build_display_iframe();
}

// === class end ===
}

//=========================================================
// main
//=========================================================
$manage =& admin_map_manage::getInstance();

$op = $manage->get_post_get_op();

if ($op == 'save') {
	if( ! $manage->check_token() ) {
		xoops_cp_header();
		$manage->print_xoops_token_error();

	} else {
		$manage->save();
		redirect_header('map_manage.php', 1, _HAPPY_LINUX_UPDATED);
	}

} else {
	xoops_cp_header();
}

$manage->main();

xoops_cp_footer();
exit();

?>