<?php
// $Id: get_location.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// api_gat_loication.php -> api.php

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
	var $_api_class;

	var $_conf;

// rssc config
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
	$webmap3_dirname = $this->_conf['webmap_dirname'];
	$latitude  = $this->_conf['webmap_latitude'];
	$longitude = $this->_conf['webmap_longitude'];
	$zoom      = $this->_conf['webmap_zoom'];
	$address   = $this->_conf['webmap_address'];

	require XOOPS_ROOT_PATH . '/modules/'.$webmap3_dirname.'/include/api.php';
	if ( ! class_exists('webmap3_api_get_location') ) {
		echo $this->error();
		return false;
	}

	$api_class =& webmap3_api_get_location::getSingleton( $webmap3_dirname );

	$api_class->set_latitude(  $latitude );
	$api_class->set_longitude( $longitude );
	$api_class->set_zoom(      $zoom );
	$api_class->set_address(   $address );
	$api_class->set_ele_id_parent_latitude(  $this->_ELE_ID_PARENT_LATITUDE );
	$api_class->set_ele_id_parent_longitude( $this->_ELE_ID_PARENT_LONGITUDE );
	$api_class->set_ele_id_parent_zoom(      $this->_ELE_ID_PARENT_ZOOM );
	$api_class->set_ele_id_parent_address(   $this->_ELE_ID_PARENT_ADDRESS );
	$api_class->display_get_location();

	return true;
}

function error()
{

$text = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>get location</title>
</head>
<body>
<h3>get location</h3>
<h4 style="color: #ff0000;">require WEBMAP3 module</h4>
</body>
</html>
EOF;

	return $text;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& rssc_get_location::getInstance( $RSSC_DIRNAME );
$manage->main();
exit();

?>