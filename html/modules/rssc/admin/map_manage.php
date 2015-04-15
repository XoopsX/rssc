<?php
// $Id: map_manage.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-034-02 K.OHWADA
// print_check_version()

//=========================================================
// RSS Center Module
// 2012-03-01 K.OHWADA
//=========================================================

include_once 'admin_header_config.php';
include_once RSSC_ROOT_PATH.'/class/rssc_block_map.php';
include_once RSSC_ROOT_PATH.'/class/rssc_map.php';

//=========================================================
// class map manage
//=========================================================
class admin_map_manage 
{
	var $_conf_handler;
	var $_config_form;
	var $_config_store;
 	var $_map_class;
 
	var $_conf;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_map_manage( $dirname )
{
	$this->_conf_handler =& rssc_get_handler( 'config_basic', $dirname );
	$this->_config_form  =& admin_config_form::getInstance();
	$this->_config_store =& admin_config_store::getInstance();
	$this->_map_class    =& rssc_map::getInstance( $dirname );

	$this->_conf =& $this->_conf_handler->get_conf();
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new admin_map_manage( $dirname );
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

	$this->_map_class->print_check_version();
	$ret = $this->_map_class->init_html();
	if ( $ret ) {
		echo $this->_map_class->build_iframe();
	}

	echo "<h4>"._AM_RSSC_FORM_MAP."</h4>\n";
	$this->_config_form->set_form_title( _AM_RSSC_FORM_MAP );
	$this->_config_form->show_by_catid( 18 );

	rssc_admin_print_footer();
	return true;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_map_manage::getInstance( RSSC_DIRNAME );

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