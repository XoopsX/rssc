<?php
// $Id: rssc_import_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2007-10-10 K.OHWADA
// move from admin_import_base_class.php

// 2006-09-20 K.OHWADA
// use XoopsGTicket
// use build_lib_box_limit_offset() : remove admin_import_form

// 2006-07-10 K.OHWADA
// this is new file
// move from admin_import_class.php

//=========================================================
// RSS Center Module
// 2006-07-10 K.OHWADA
//=========================================================

//=========================================================
// class rssc_import_handler
//=========================================================
class rssc_import_handler extends happy_linux_error
{
	var $_LIMIT = 100;
	var $_FLAG_UPDATE_LINK = true;

	var $_link_handler;
	var $_black_handler;
	var $_white_handler;
	var $_feed_basic_handler;

	var $_form;
	var $_post;
	var $_system;
	var $_strings;
	var $_rss_parser;

// local
	var $_exist_lid = 0;
	var $_lid_list_by_p1   = array();
	var $_lid_list_by_url  = array();
	var $_link_objs_by_lid = array();
	var $_table_rssc_link;
	var $_table_rssc_feed;
	var $_table_rssc_black;
	var $_table_rssc_white;

	var $_dirname_orig;
	var $_mid_orig = 0;

// post
	var $_op;
	var $_limit;
	var $_offset;
	var $_next;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_import_handler( $dirname )
{
	$this->happy_linux_error();

	$this->_system     =& happy_linux_system::getInstance();
	$this->_strings    =& happy_linux_strings::getInstance();
	$this->_form       =& happy_linux_form_lib::getInstance();
	$this->_post       =& happy_linux_post::getInstance();
	$this->_rss_parser =& happy_linux_rss_parser::getInstance();

	$this->_link_handler       =& rssc_get_handler( 'link',       $dirname );
	$this->_black_handler      =& rssc_get_handler( 'black',      $dirname );
	$this->_white_handler      =& rssc_get_handler( 'white',      $dirname );
	$this->_feed_basic_handler =& rssc_get_handler( 'feed_basic', $dirname );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_import_handler( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_op()
{
	$this->_op = $this->_post->get_post_get('op');
	return $this->_op;
}

function get_post_limit()
{
	$this->_limit = $this->_post->get_post_get_int('limit');
	return $this->_limit;
}

function get_post_offset()
{
	$this->_offset = $this->_post->get_post_get_int('offset');
	return $this->_offset;
}

function calc_next( $total=null )
{
	$next = $this->_offset + $this->_LIMIT;
	if ( $total &  ( $next > $total ) )
	{
		$next = $total;
	}
	$this->_next = $next;
	return $next;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_mid_orig($mid)
{
	$this->_mid_orig = intval($mid);
}

function get_mid_orig()
{
	return $this->_mid_orig;
}

function clear_num()
{
	$this->_num = 0;
}

function set_lid_list()
{
	$this->_set_lid_list();
}

function set_mid_orig_by_dirname( $dirname )
{
	$this->_dirname_orig = $dirname;
	$this->_mid_orig = $this->_system->get_mid_by_dirname( $dirname );
}

function exist_module()
{
	if ($this->_mid_orig)
	{
		return true;
	}
	return false;
}

function get_msg_not_installed()
{
	$msg = $this->_dirname_orig." module is not installed \n";
	return $msg;
}

function set_limit($limit)
{
	$this->_LIMIT = intval($limit);
}

//---------------------------------------------------------
// import_site
//---------------------------------------------------------
function import_site_weblinks( $site_url )
{
	$this->_num ++;
	echo $this->_num.": ".htmlspecialchars($site_url);

	if ( $this->_exist_url_in_rssc($site_url) )
	{
		echo " <b>skip</b> <br />\n";
		return false;
	}

	echo " <br />\n";
	$title = '';
	$link  = '';

	$parse_obj = $this->_rss_parser->parse_by_url($site_url);
	if ( is_object($parse_obj) )
	{
		$title = $parse_obj->get_channel_by_key('title');
		$link  = $parse_obj->get_channel_by_key('link');
	}

	if ( empty($title) )
	{
		$title = 'RSS site '.$this->_num;
	}

	$url      = $link;
	$rss_url  = $site_url;

	$link_obj =& $this->_link_handler->create();
	$link_obj->set('uid',      1 );	// admin
	$link_obj->set('mid',      $this->_mid_orig );
	$link_obj->set('ltype',    RSSC_C_LINK_LTYPE_SERACH );
	$link_obj->set('mode',     RSSC_C_MODE_RSS );
	$link_obj->set('refresh',  3600 );	// 1 hour
	$link_obj->setVar('title',    $title,    true );
	$link_obj->setVar('url',      $url,      true );
	$link_obj->setVar('rss_url',  $rss_url,  true );
	$this->_link_handler->insert($link_obj);

	unset($link_obj);

	return true;
}

//---------------------------------------------------------
// import_black
//---------------------------------------------------------
function import_black_weblinks( $site_url )
{
	$this->_num ++;
	$title = null;

	$parse_obj =& $this->_rss_parser->discover_and_parse_by_html_url($site_url);
	if ( is_object($parse_obj) )
	{
		$title = $parse_obj->get_channel_by_key('title');
	}

	if ( empty($title) )
	{
		$title = 'Black '.$this->_num;
	}

	$url = $site_url;

	echo $this->_num.": ".htmlspecialchars($url)." <br />\n";

	$black_obj =& $this->_black_handler->create();

	$black_obj->set('uid',      1 );	// admin
	$black_obj->set('mid',      $this->_mid_orig );
	$black_obj->setVar('title',    $title,    true );
	$black_obj->setVar('url',      $url,      true );

	$this->_black_handler->insert($black_obj);
	unset($black_obj);

	return true;
}

//---------------------------------------------------------
// import_white
//---------------------------------------------------------
function import_white_weblinks()
{
	$this->_num ++;
	$title = null;

	$parse_obj =& $this->_rss_parser->discover_and_parse_by_html_url($site_url);
	if ( is_object($parse_obj) )
	{
		$title = $parse_obj->get_channel_by_key('title');
	}

	if ( empty($title) )
	{
		$title = 'White '.$this->_num;
	}

	$url = $site_url;

	echo $this->_num.": ".htmlspecialchars($url)." <br />\n";

	$white_obj =& $this->_white_handler->create();

	$white_obj->set('uid',      1 );	// admin
	$white_obj->set('mid',      $this->_mid_orig );
	$white_obj->setVar('title',    $title,    true );
	$white_obj->setVar('url',      $url,      true );

	$this->_white_handler->insert($white_obj);
	unset($white_obj);

	return true;
}

//---------------------------------------------------------
// import_link
//---------------------------------------------------------
function import_link_weblinks( &$weblinks_link_obj )
{
	$weblinks_lid      = $weblinks_link_obj->get('lid');
	$weblinks_rss_flag = $weblinks_link_obj->get('rss_flag');
	$weblinks_rss_url  = $weblinks_link_obj->get('rss_url');

	$rss_url  = '';
	$atom_url = '';

	switch ( $weblinks_rss_flag )
	{
		case 1:
			$mode    = 2;	// rss
			$rss_url = $weblinks_rss_url;
			break;

		case 2:
			$mode     = 3;	// atom
			$atom_url = $weblinks_rss_url;
			break;

		default:
			$mode = 4;	// auto
			break;
	}

	$orig_obj = new happy_linux_basic();
	$orig_obj->set_vars( $weblinks_link_obj->getVarAll() );
	$orig_obj->set('id',           $weblinks_lid );
	$orig_obj->set('p1',           $weblinks_lid ); 	// store lid;
	$orig_obj->set('mid',          $this->_mid_orig );
	$orig_obj->set('refresh',      86400 );	// 24 hours
	$orig_obj->set('headline',     0 );	// non
	$orig_obj->set('encoding',     '' );	// auto
	$orig_obj->set('mode',         $mode );
	$orig_obj->set('rss_url',      $rss_url );
	$orig_obj->set('atom_url',     $atom_url );
	$orig_obj->set('orig_rss_url', $weblinks_rss_url );	

	return $this->import_link_common( $orig_obj );
}

function import_link_common( &$orig_obj )
{
	$id           = $orig_obj->get('id');
	$p1           = $orig_obj->get('p1');
	$mid          = $orig_obj->get('mid');
	$title        = $orig_obj->get('title');
	$uid          = $orig_obj->get('uid');
	$url          = $orig_obj->get('url');
	$refresh      = $orig_obj->get('refresh');
	$encoding     = $orig_obj->get('encoding');
	$headline     = $orig_obj->get('headline');
	$mode         = $orig_obj->get('mode');
	$rss_url      = $orig_obj->get('rss_url');
	$atom_url     = $orig_obj->get('atom_url');	
	$orig_rss_url = $orig_obj->get('orig_rss_url');

	echo $id.": ".htmlspecialchars($title);

// if exist same url
	if ( $this->_exist_url($orig_rss_url) )
	{
		echo " <b>update</b> <br />\n";
		$rssc_lid = $this->_exist_lid;

// overwrite data in rssc link table
		if ( $this->_FLAG_UPDATE_LINK )
		{
			$link_obj =& $this->_link_handler->get($rssc_lid);
			if ( is_object($link_obj) )
			{
				$link_obj->set('mid', $mid );
				$link_obj->set('p1',  $p1 );

				$this->_link_handler->update($link_obj);
				unset($link_obj);
			}
		}
	}

// if not exist same url
	else
	{
		echo " insert <br />\n";

		$link_obj =& $this->_link_handler->create();
		$link_obj->set('p1',       $p1 );
		$link_obj->set('uid',      $uid );
		$link_obj->set('mid',      $mid );
		$link_obj->set('mode',     $mode );
		$link_obj->set('refresh',  $refresh );
		$link_obj->set('headline', $headline );
		$link_obj->setVar('title',    $title,    true );
		$link_obj->setVar('url',      $url,      true );
		$link_obj->setVar('encoding', $encoding, true );
		$link_obj->setVar('rss_url',  $rss_url,  true );
		$link_obj->setVar('atom_url', $atom_url, true );

		$rssc_lid = $this->_link_handler->insert($link_obj);
		unset($link_obj);
	}

	return $rssc_lid;
}

//---------------------------------------------------------
// import_feed
//---------------------------------------------------------
function import_feed_weblinks( &$weblinks_atomfeed_obj )
{
	$aid   = $weblinks_atomfeed_obj->get('aid');
	$title = $weblinks_atomfeed_obj->get('title');
	$link  = $weblinks_atomfeed_obj->get('url');

	echo $aid.": ".htmlspecialchars($title);

	if ( $this->_exist_feed($link) )
	{
		echo " <b>skip</b> <br />\n";
		return false;
	}

	echo " <br />\n";

	$lid = $this->_get_feed_lid( $weblinks_atomfeed_obj);
	$uid = $this->_get_feed_uid( $lid );
	$p1  = $this->_get_feed_p1(  $lid );
	$site_title     = $weblinks_atomfeed_obj->get('site_title');
	$site_link      = $weblinks_atomfeed_obj->get('site_url');
	$entry_id       = $weblinks_atomfeed_obj->get('entry_id');
	$guid           = $weblinks_atomfeed_obj->get('guid');
	$updated_unix   = $weblinks_atomfeed_obj->get('time_modified');
	$published_unix = $weblinks_atomfeed_obj->get('time_issued');
	$author_name    = $weblinks_atomfeed_obj->get('author_name');
	$author_uri     = $weblinks_atomfeed_obj->get('author_url');
	$author_email   = $weblinks_atomfeed_obj->get('author_email');
	$content        = $weblinks_atomfeed_obj->get('content');

	$feed_obj =& $this->_feed_basic_handler->create();

	$feed_obj->set('lid', $lid );
	$feed_obj->set('uid', $uid );
	$feed_obj->set('mid', $this->_mid_orig );
	$feed_obj->set('p1',  $p1 );
	$feed_obj->set('updated_unix',   $updated_unix );
	$feed_obj->set('published_unix', $published_unix );
	$feed_obj->setVar('site_title',   $site_title,   true );
	$feed_obj->setVar('site_link',    $site_link,    true );
	$feed_obj->setVar('title',        $title,        true );
	$feed_obj->setVar('link',         $link,         true );
	$feed_obj->setVar('entry_id',     $entry_id,     true );
	$feed_obj->setVar('guid',         $guid,         true );
	$feed_obj->setVar('author_name',  $author_name,  true );
	$feed_obj->setVar('author_uri',   $author_uri,   true );
	$feed_obj->setVar('author_email', $author_email, true );
	$feed_obj->setVar('content',      $content,      true );
	$feed_obj->set_search();

	$this->_feed_basic_handler->insert($feed_obj);
	unset($feed_obj);

	return true;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function _exist_url($url)
{
	$this->_exist_lid = 0;
	$list =& $this->_link_handler->get_list_by_rssurl( $url );
	if ( is_array($list) && (count($list) > 0) )
	{
		$this->_exist_lid = $list[0];
		return true;
	}
	return false;
}

function _set_lid_list()
{
	$link_objs =& $this->_link_handler->getObjects();

	$arr1 = array();
	$arr2 = array();
	$arr3 = array();

	foreach ( $link_objs as $obj )
	{
		$lid = $obj->get('lid');
		$url = $obj->get('url');
		$p1  = $obj->get('p1');

		if ( $p1 )
		{
			$arr1[ $p1 ]  = $lid;
		}

		if ( $url )
		{
			$arr2[ $url ] = $lid;
		}

		$arr3[ $lid ] = $obj;
	}

	$this->_lid_list_by_p1   = $arr1;
	$this->_lid_list_by_url  = $arr2;
	$this->_link_objs_by_lid = $arr3;

}

function _get_feed_lid( $obj )
{
	$lid = $obj->get('lid');
	$url = $obj->get('site_url');

	if ( isset( $this->_lid_list_by_p1[$lid] ) )
	{
		$val = $this->_lid_list_by_p1[$lid];
	}
	elseif ( isset( $this->_lid_list_by_url[$url] ) )
	{
		$val = $this->_lid_list_by_url[$url];
	}
	else
	{
		$val = 0;
	}

	return $val;
}

function _get_feed_uid($lid)
{
	$ret = 0;
	$obj =& $this->_get_link_obj_by_lid($lid);
	if ( is_object($obj) )
	{
		$ret = $obj->get('uid');
	}
	return $ret;
}

function _get_feed_p1($lid)
{
	$ret = 0;
	$obj =& $this->_get_link_obj_by_lid($lid);
	if ( is_object($obj) )
	{
		$ret = $obj->get('p1');
	}
	return $ret;
}

function &_get_link_obj_by_lid($lid)
{
	$obj = false;
	if ( isset($this->_link_objs_by_lid[$lid]) )
	{
		$obj = $this->_link_objs_by_lid[$lid];
	}
	return $obj;
}

function _exist_feed($link)
{
	$count =& $this->_feed_basic_handler->get_count_by_link($link);
	if ( $count )
	{
		return true;
	}
	return false;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_finish()
{
	echo "<br /><hr />\n";
	echo "<h4>FINISHED</h4>\n";
	echo "<a href='index.php'>GOTO Admin Menu</a><br />\n";
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function _print_form_next($title, $op, $submit, $offset=0)
{
	echo $this->build_form_next($title, $op, $submit, $offset, 'Import');
}

function build_form_next($title, $op, $submit, $offset=0, $sub='Import')
{
	$text  = "<br /><hr />\n";
	$text .= "<h4>".$title."</h4>\n";

	if ($offset)
	{
		$next  = $offset + $this->_LIMIT;
		$text .= $sub." ".$offset." - ".$next." th record<br />\n";
	}

// show form
	$limit  = 0;
	$desc   = '';
	$action = '';
	$text = $this->_form->build_lib_box_limit_offset($title, $desc, $limit, $offset, $op, $submit, $action);

	return $text;
}

function check_token()
{
	return $this->_form->check_token();
}

// --- class end ---
}

?>