<?php
// $Id: site_list.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2007-06-01 K.OHWADA
// move from class/rssc_site_list.php

// 2006-04-17 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_site_list') ) 
{

//=========================================================
// class rssc_site_list
//=========================================================
class rssc_site_list
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_site_list()
{
	// dummy
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_site_list();
	}
	return $instance;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function get_site_list()
{
	$site = array();

	$site[1]['title']    = 'google';
	$site[1]['url']      = 'http://blogsearch.google.com/blogsearch?hl=en&lr=lang_en&ie=utf-8&num=10&output=atom&q=';
	$site[1]['rss']      = 'http://blogsearch.google.com/blogsearch_feeds?hl=en&lr=lang_en&ie=utf-8&num=10&output=atom&q=';
	$site[1]['mode']     =  RSSC_C_MODE_ATOM;
	$site[1]['code']     = 'UTF-8';
	$site[1]['encoding'] = 'UTF-8';

	return $site;
}

// --- class end ---
}

// === class end ===
}

?>