<?php
// $Id: get_location.php,v 1.1 2012/03/17 13:33:05 ohwada Exp $

//=========================================================
// Rss center Module
// 2012-03-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// xoops system files
//---------------------------------------------------------
include '../../mainfile.php';
include_once XOOPS_ROOT_PATH.'/class/template.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
$RSSC_DIRNAME = $xoopsModule->dirname();
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';

//=========================================================
// class rssc_get_location
//=========================================================
class rssc_get_location
{
	var $_conf_handler;
	var $_multibyte_class;
	var $_map_class;
	var $_html_class;

	var $_conf;

	var $_map_div_id    = "";
	var $_map_func   = '' ;

	var $_OPNER_MODE  = 'parent';

	var $_ELE_ID_LIST   = "";
	var $_ELE_ID_SEARCH = "";
	var $_ELE_ID_CURRENT_LOCATION = "";
	var $_ELE_ID_CURRENT_ADDRESS  = "";

// configg
	var $_ELE_ID_PARENT_LATITUDE  = "webmap_latitude";
	var $_ELE_ID_PARENT_LONGITUDE = "webmap_longitude";
	var $_ELE_ID_PARENT_ZOOM      = "webmap_zoom";
	var $_ELE_ID_PARENT_ADDRESS   = "webmap_address";

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_get_location( $dirname )
{
	$this->_conf_handler =& rssc_get_handler( 'config_basic', $dirname );
	$this->_conf = $this->_conf_handler->get_conf();

	$this->_ELE_ID_LIST   = $dirname."_map_list";
	$this->_ELE_ID_SEARCH = $dirname."_map_search";
	$this->_ELE_ID_CURRENT_LOCATION = $dirname."_map_current_location";
	$this->_ELE_ID_CURRENT_ADDRESS  = $dirname."_map_current_address";

	$this->_map_div_id = $dirname."_map_get_location";
	$this->_map_func   = $dirname.'_load_map_get_location' ;
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new rssc_get_location( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	$ret = $this->init_webmap3();
	if ( !$ret ) {
		return false;
	}

	$param = $this->build_param();

	$this->http_output( 'pass' );
	header('Content-Type:text/html; charset=UTF-8');
	echo $this->_html_class->fetch_get_location( $param );

	return true;
}

function init_webmap3()
{
	$webmap3_dirname = $this->_conf['webmap_dirname'];
	require XOOPS_ROOT_PATH . '/modules/'.$webmap3_dirname.'/include/api_map.php';
	require XOOPS_ROOT_PATH . '/modules/'.$webmap3_dirname.'/include/api_html.php';
	if ( ! class_exists('webmap3_api_map') ) {
		return false;
	}

	$this->_map_class   =& webmap3_api_map::getSingleton(  $webmap3_dirname );
	$this->_html_class  =& webmap3_api_html::getSingleton( $webmap3_dirname );
	return true;
}

function build_param()
{
	$latitude  = $this->_conf['webmap_latitude'];
	$longitude = $this->_conf['webmap_longitude'];
	$zoom      = $this->_conf['webmap_zoom'];
	$addr      = $this->_conf['webmap_address'];

	$param   = $this->build_map( $latitude, $longitude, $zoom );
	$head_js = $param['head_js'];

	$this->_html_class->set_head_js( $head_js );
	$this->_html_class->set_map_div_id( $this->_map_div_id );
	$this->_html_class->set_map_func(   $this->_map_func ) ;
	$this->_html_class->set_address( $addr );
	$this->_html_class->set_show_set_address(     true );
	$this->_html_class->set_show_current_address( true );
	$this->_html_class->set_map_ele_id_list(             $this->_ELE_ID_LIST );
	$this->_html_class->set_map_ele_id_search(           $this->_ELE_ID_SEARCH );
	$this->_html_class->set_map_ele_id_current_location( $this->_ELE_ID_CURRENT_LOCATION );
	$this->_html_class->set_map_ele_id_current_address(  $this->_ELE_ID_CURRENT_ADDRESS );

	return $this->_html_class->build_param_get_location();
}

function build_map( $lat, $lng, $zoom )
{
	$this->_map_class->init();

	$this->_map_class->set_map_div_id( $this->_map_div_id ) ;
	$this->_map_class->set_map_func(   $this->_map_func ) ;

	$this->_map_class->set_latitude(  $lat );
	$this->_map_class->set_longitude( $lng );
	$this->_map_class->set_zoom(      $zoom );
	$this->_map_class->set_opener_mode( $this->_OPNER_MODE );

	$this->_map_class->set_ele_id_list(             $this->_ELE_ID_LIST );
	$this->_map_class->set_ele_id_search(           $this->_ELE_ID_SEARCH );
	$this->_map_class->set_ele_id_current_location( $this->_ELE_ID_CURRENT_LOCATION );
	$this->_map_class->set_ele_id_current_address(  $this->_ELE_ID_CURRENT_ADDRESS );
	$this->_map_class->set_ele_id_parent_latitude(  $this->_ELE_ID_PARENT_LATITUDE );
	$this->_map_class->set_ele_id_parent_longitude( $this->_ELE_ID_PARENT_LONGITUDE );
	$this->_map_class->set_ele_id_parent_zoom(      $this->_ELE_ID_PARENT_ZOOM );
	$this->_map_class->set_ele_id_parent_address(   $this->_ELE_ID_PARENT_ADDRESS );

	$this->_map_class->set_use_draggable_marker( true );
	$this->_map_class->set_use_search_marker(    true );
	$this->_map_class->set_use_current_location( true );
	$this->_map_class->set_use_current_address(  true );

	$param   = $this->_map_class->build_get_location();
	$head_js = $this->_map_class->fetch_get_location_head( $param, false );

	$arr = array(
		'head_js' => $head_js ,
	);

	return $arr;
}

//---------------------------------------------------------
// multibyte
//---------------------------------------------------------
function http_output( $encoding )
{
	if ( function_exists('mb_http_output') ) {
		return mb_http_output( $encoding );
	}
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& rssc_get_location::getInstance( $RSSC_DIRNAME );

$ret = $manage->main();
if ( !$ret ) {
	include XOOPS_ROOT_PATH.'/header.php';
	xoops_error('require Webmap3 module');
	include XOOPS_ROOT_PATH.'/footer.php';
}

exit();

?>