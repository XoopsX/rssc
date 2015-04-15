<?php
// $Id: rssc_map.php,v 1.3 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// rssc_block_map

// 2012-03-01 K.OHWADA
// webmap3_api_map

//=========================================================
// Rss Center Module
// 2009-02-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_map') ) 
{

//=========================================================
// class rssc_map
//=========================================================
class rssc_map extends rssc_block_map 
{
	var $_form_class;

	var $_conf;

// setter
	var $_map_div_id = '';
	var $_map_func   = '';

	var $_flag_webmap = false;

	var $_URL_IFRAME = '';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_map( $dirname )
{
	$this->rssc_block_map( $dirname );

	$this->_conf = $this->get_conf( $dirname );

	$this->_URL_IFRAME = XOOPS_URL.'/modules/'.$dirname.'/get_location.php';
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new rssc_map( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// map manage
//---------------------------------------------------------
function print_check_version()
{
	if ( $this->check_installed() ) {
		if ( ! $this->check_version() ) {
			$this->print_warning_version();
		}
	}
}

function print_warning_version()
{
	$msg = 'require webmap3 module v'.RSSC_WEBMAP3_VERSION.' or later';
	xoops_error( $msg );
}

function check_installed()
{
	$webmap3_dirname = $this->_conf['webmap_dirname'];
	$file = XOOPS_ROOT_PATH . '/modules/'.$webmap3_dirname.'/include/webmap3_version.php';
	if ( ! file_exists($file) ) {
		return false;
	}

	include_once $file;
	if ( ! defined('_C_WEBMAP3_VERSION') ) {
		return false;
	}

	return true;
}

function check_version()
{
	if ( _C_WEBMAP3_VERSION < RSSC_WEBMAP3_VERSION ) {
		return false;
	}
	return true;
}

function init_html()
{
	$webmap3_dirname = $this->_conf['webmap_dirname'];
	$file = XOOPS_ROOT_PATH . '/modules/'.$webmap3_dirname.'/include/api.php';
	if ( ! file_exists($file) ) {
		return false;
	}

	include_once $file;
	if ( ! class_exists('webmap3_api_html') ) {
		return false;
	}

	$this->_flag_webmap = true;
	$this->_html_class  =& webmap3_api_html::getSingleton( $webmap3_dirname );
	return true;
}

function build_iframe()
{
	if ( ! $this->_flag_webmap ) {
		return '';
	}

	$this->_html_class->set_display_iframe_url( $this->_URL_IFRAME );
	return $this->_html_class->build_display_iframe();
}

//---------------------------------------------------------
// link manage
//---------------------------------------------------------
function init_form()
{
	$webmap_dirname = $this->_conf['webmap_dirname'];
	$file = XOOPS_ROOT_PATH.'/modules/'. $webmap_dirname .'/include/api.php' ;
	if ( !is_file($file) ) {
		return false;
	}

	include_once $file ;

	if ( ! class_exists('webmap3_api_form') ) {
		return false;
	}

	$this->_form_class =& webmap3_api_form::getSingleton(  $webmap_dirname );
	return true;
}

function build_form_js()
{
	return $this->_form_class->build_form_js( false );
}

function build_ele_gicon( $id )
{
	$this->_form_class->set_gicon_select_name(    'gicon_id' );
	$this->_form_class->set_gicon_select_id( 'rssc_gicon_id' );
	$this->_form_class->set_gicon_img_id(    'rssc_gicon_img' );

	return $this->_form_class->build_ele_gicon( $id );
}

//---------------------------------------------------------
// map
//---------------------------------------------------------
function init_map( $webmap_dirname )
{
	$file = XOOPS_ROOT_PATH.'/modules/'. $webmap_dirname .'/include/api.php' ;
	if ( !file_exists($file) ) {
		return false;
	}

	include_once $file ;

	if ( !class_exists( 'webmap3_api_map' ) ) {
		return false;
	}

	$this->_flag_webmap = true;
	$this->_map_class =& webmap3_api_map::getSingleton( $webmap_dirname );

	$this->_map_class->init();
	$this->_map_class->set_latitude(  $this->_conf['webmap_latitude'] );
	$this->_map_class->set_longitude( $this->_conf['webmap_longitude'] );
	$this->_map_class->set_zoom(      $this->_conf['webmap_zoom'] );

	$this->_map_class->set_title_length( $this->_conf['main_map_max_title'] ) ;
	$this->_map_class->set_info_max(     $this->_conf['main_map_info_max'] ) ;
	$this->_map_class->set_info_width(   $this->_conf['main_map_info_width'] ) ;

	$this->_map_class->set_overview_map_control( true );
	$this->_map_class->set_overview_map_control_opened( true );

	return true;
}

function fetch_map( $feeds )
{
	$show_map = false;
	if ( ! $this->_flag_webmap ) {
		return $show_map;
	}

// head
	$this->_map_class->assign_google_map_js_to_head();
	$this->_map_class->assign_map_js_to_head();
	$this->_map_class->assign_gicon_array_to_head();

// markers
	foreach ($feeds as $feed) {
		if ( $this->check_latlng_by_feed( $feed ) ) {
			$show_map = true;
			$markers[] = $this->build_marker( $feed );
		}
	}

// map
	$this->_map_class->set_map_div_id( $this->_map_div_id ) ;
	$this->_map_class->set_map_func(   $this->_map_func ) ;

	$param = $this->_map_class->build_markers( $markers );
	         $this->_map_class->fetch_markers_head( $param );

	return $show_map;
}

//---------------------------------------------------------
// config
//---------------------------------------------------------
function get_conf( $dirname )
{
	$db =& Database::getInstance();
	$table_config = $db->prefix( $dirname.'_config' );

	$sql = 'SELECT * FROM '.$table_config.' ORDER BY conf_id ASC';

	$res = $db->query($sql, 0, 0);
	if ( !$res ) {
		return false;
	}

	$conf = array();
	while ( $row = $db->fetchArray($res) ) {
		$conf[ $row['conf_name'] ] = $row['conf_value'];
	}
	return $conf;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_map_div_id( $v )
{
	$this->_map_div_id = $v;
}

function set_map_func( $v )
{
	$this->_map_func = $v;
}

// --- class end ---
}

// === class end ===
}

?>