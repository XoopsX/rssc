<?php
// $Id: rssc_xml_utility.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2007-06-01 K.OHWADA
// this file is interface to happy_linux_rss_utility

// 2006-12-02 K.OHWADA
// BUG 4389: cannot auto discovery RDF url

// 2006-11-08 K.OHWADA
// add set_proxy()

// 2006-09-20 K.OHWADA
// move discover_for_manage() from rssc_link_exist_handler
// use set_error_code()

// 2006-07-10 K.OHWADA
// use happy_linux_error happy_linux_remote_file etc

// 2006-06-04 K.OHWADA
// add DEFAULT_ENCODINGS
// move get_unixtime_rfc822(), get_unixtime_w3cdtf() from parse_base
// move parse_by_url() to parse_handler
// suppress notice : Only variable references should be returned by reference

//=========================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_xml_utility') ) 
{

//---------------------------------------------------------
// define constant
//---------------------------------------------------------
define('RSSC_CODE_XML_ENCODINGS_DEFAULT',  HAPPY_LINUX_RSS_CODE_XML_ENCODINGS_DEFAULT);
define('RSSC_CODE_DISCOVER_SUCCEEDED',     HAPPY_LINUX_RSS_CODE_DISCOVER_SUCCEEDED);
define('RSSC_CODE_DISCOVER_FAILED',        HAPPY_LINUX_RSS_CODE_DISCOVER_FAILED);


//=========================================================
// class rssc_xml_utility
//=========================================================
class rssc_xml_utility extends happy_linux_rss_utility
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_xml_utility()
{
	$this->happy_linux_rss_utility();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_xml_utility();
	}
	return $instance;
}

//----- class end -----
}

// === class end ===
}

?>