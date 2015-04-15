<?php
// $Id: site_list.php,v 1.1 2011/12/29 14:37:09 ohwada Exp $

// 2007-06-01 K.OHWADA
// move from class/rssc_site_list.php
// add google ,yahoo
// remove bulkfeeds 

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

public static function &getInstance()
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
	$site[1]['url']      = 'http://blogsearch.google.co.jp/blogsearch?hl=ja&lr=lang_ja&ie=utf-8&num=10&output=atom&q=';
	$site[1]['rss']      = 'http://blogsearch.google.co.jp/blogsearch_feeds?hl=ja&lr=lang_ja&ie=utf-8&num=10&output=atom&q=';
	$site[1]['mode']     =  RSSC_C_MODE_ATOM;
	$site[1]['code']     = 'UTF-8';
	$site[1]['encoding'] = 'UTF-8';

	$site[2]['title']    = 'yahoo';
	$site[2]['url']      = 'http://blog-search.yahoo.co.jp/search?ei=utf-8&p=';
	$site[2]['rss']      = 'http://blog-search.yahoo.co.jp/rss?ei=utf-8&p=';
	$site[2]['mode']     =  RSSC_C_MODE_RSS;
	$site[2]['code']     = 'UTF-8';
	$site[2]['encoding'] = 'UTF-8';

	$site[3]['title']    = 'livedoor';
	$site[3]['url']      = 'http://sf.livedoor.com/search?sf=update_date&q=';
	$site[3]['rss']      = 'http://rss.sf.livedoor.com/search?sf=update_date&start=0&q=';
	$site[3]['mode']     =  RSSC_C_MODE_RDF;
	$site[3]['code']     = 'EUC-JP';
	$site[3]['encoding'] = 'UTF-8';

	return $site;
}

// this site dont work
function get_site_bulkfeeds()
{
	$arr = array(
		'title'    => 'bulkfeeds',
		'url'      => 'http://bulkfeeds.net/app/search2?q=',
		'rss'      => 'http://bulkfeeds.net/app/search2.rdf?q=',
		'mode'     =>  RSSC_C_MODE_RDF,
		'code'     => 'UTF-8',
		'encoding' => 'UTF-8',
	);
	return $arr;
}

// this site dont work
function get_site_feedback()
{
	$arr = array(
		'title'    => 'FeedBack',
		'url'      => 'http://naoya.dyndns.org/feedback/app/rss?keyword=',
		'rss'      => 'http://naoya.dyndns.org/feedback/app/rss?keyword=',
		'mode'     =>  RSSC_C_MODE_RDF,
		'code'     => 'EUC-JP',
		'encoding' => 'UTF-8',
	);

	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>