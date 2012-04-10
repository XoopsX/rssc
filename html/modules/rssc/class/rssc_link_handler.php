<?php
// $Id: rssc_link_handler.php,v 1.2 2012/04/10 03:06:50 ohwada Exp $

// 2012-04-02 K.OHWADA
// url XOBJ_DTYPE_URL -> XOBJ_DTYPE_URL_AREA

// 2009-02-20 K.OHWADA
// gicon_id

// 2008-01-20 K.OHWADA
// post_plugin in link

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// enclosure censor plugin in link

// 2007-06-01 K.OHWADA
// divid to xml_handler
// add get_ltype_option()
// use rssc_link_basic

// 2006-09-18 K.OHWADA
// move build_error_rssurl_list() from rssc_link_exist_handler
// change _build_insert_sql() get_list_by_rssurl()

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler

// 2006-06-04 K.OHWADA
// add build_show(), get_export_channel()
// move refreshExpired(), update_xml_url(), etc to link_basic
// move _sanitize_link(), etc to xml_object
// use get_cache()
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// this file contain 2 class
//   rssc_link
//   rssc_link_handler
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_link_handler') ) 
{

//=========================================================
// class link
//=========================================================
class rssc_link extends happy_linux_object
{
	var $_charset = _CHARSET;
	var $_link_basic;

//---------------------------------------------------------
// ltype : 1 = rss search site
//---------------------------------------------------------

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_link()
{
	$this->happy_linux_object();

	$this->initVar('lid', XOBJ_DTYPE_INT, null, false);
	$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('mid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p1',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p2',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p3',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('title',  XOBJ_DTYPE_TXTBOX, null, true, 255);
	$this->initVar('url',    XOBJ_DTYPE_URL_AREA );
	$this->initVar('ltype',     XOBJ_DTYPE_INT, RSSC_C_LINK_LTYPE_NORMAL, false);
	$this->initVar('refresh',   XOBJ_DTYPE_INT, 0, false);
	$this->initVar('headline',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('mode',      XOBJ_DTYPE_INT, 0, false);
	$this->initVar('rdf_url',   XOBJ_DTYPE_URL_AREA );
	$this->initVar('rss_url',   XOBJ_DTYPE_URL_AREA );
	$this->initVar('atom_url',  XOBJ_DTYPE_URL_AREA );
	$this->initVar('encoding',  XOBJ_DTYPE_TXTBOX, null, false);
	$this->initVar('updated_unix',   XOBJ_DTYPE_INT, 0, false);
	$this->initVar('channel',     XOBJ_DTYPE_TXTAREA);
	$this->initVar('xml',         XOBJ_DTYPE_TXTAREA);
	$this->initVar('enclosure',   XOBJ_DTYPE_INT,   1);
	$this->initVar('censor',      XOBJ_DTYPE_TXTAREA);
	$this->initVar('plugin',      XOBJ_DTYPE_TXTAREA);
	$this->initVar('post_plugin', XOBJ_DTYPE_TXTAREA);
	$this->initVar('icon',        XOBJ_DTYPE_TXTBOX, null, false);
	$this->initVar('gicon_id',    XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_1',   XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',   XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2',  XOBJ_DTYPE_TXTBOX, null, false, 255);

	$this->_link_basic =& rssc_link_basic::getInstance();
}

//---------------------------------------------------------
// set
//---------------------------------------------------------
function set_vars_keyword( $site )
{
	if ( isset($_POST['keyword']) ) {
		$key = $_POST['keyword'];
	} else {
		return false;
	}

	$convert =& happy_linux_convert_encoding::getInstance();

	$key_conv   = $convert->convert($key, $site['code'], $this->_charset);
	$key_encode = urlencode( $key_conv );

	$title   = $site['title'].': '.$key;
	$url     = $site['url']. $key_encode;
	$rss_url = $site['rss']. $key_encode;

	$this->setVars( $_POST );
	$this->setVar('title',    $title );
	$this->setVar('url',      $url );
	$this->setVar('encoding', $site['encoding'] );

	switch ( $site['mode'] )
	{
		case RSSC_C_MODE_RDF:
			$this->setVar('mode',     RSSC_C_MODE_RDF );
			$this->setVar('rdf_url',  $rss_url );
			break;
	
		case RSSC_C_MODE_ATOM:
			$this->setVar('mode',     RSSC_C_MODE_ATOM );
			$this->setVar('atom_url',  $rss_url );
			break;

		case RSSC_C_MODE_RSS:
		default:
			$this->setVar('mode',     RSSC_C_MODE_RSS );
			$this->setVar('rss_url',  $rss_url );
			break;
	}

}

//---------------------------------------------------------
// get
//---------------------------------------------------------
function get_rssurl_by_mode($format='n')
{
	$mode     = $this->get('mode');
	$rdf_url  = $this->get('rdf_url');
	$rss_url  = $this->get('rss_url');
	$atom_url = $this->get('atom_url');
	$val = $this->_link_basic->_get_rssurl_by_mode_url( $mode, $rdf_url, $rss_url, $atom_url );

	$val = $this->sanitize_format_url( $val, $format );
	return $val;
}

function get_rss_icon_by_mode()
{
	$ret = $this->_link_basic->_get_rss_icon_by_mode( $this->get('mode') );
	return $ret;
}

function _format_time( $unixtime, $format)
{
	if ($unixtime)
	{
		$text = formatTimestamp( $unixtime, $format );
		return $text;
	}
	return false;
}

function &get_channel()
{
	$ret =& $this->getVarArray('channel');
	return $ret;
}

function get_mode_name()
{
	$mode = $this->get('mode');
	$arr  =& $this->get_mode_array();
	if ( isset($arr[$mode]) )
	{
		return $arr[$mode];
	}
	return false;
}

function &get_mode_array()
{
	$arr = array(
		RSSC_C_MODE_NON  => _RSSC_RSS_MODE_NON,
		RSSC_C_MODE_AUTO => _RSSC_RSS_MODE_AUTO,
		RSSC_C_MODE_RDF  => _RSSC_RSS_MODE_RDF,
		RSSC_C_MODE_RSS  => _RSSC_RSS_MODE_RSS,
		RSSC_C_MODE_ATOM => _RSSC_RSS_MODE_ATOM,
	);
	return $arr;
}

function &get_mode_option()
{
	$arr = array_flip( $this->get_mode_array() );
	return $arr;
}

function &get_ltype_option()
{
	$arr = array(
		_RSSC_LTYPE_NON    => RSSC_C_LINK_LTYPE_NON,
		_RSSC_LTYPE_SEARCH => RSSC_C_LINK_LTYPE_SEARCH,
		_RSSC_LTYPE_NORMAL => RSSC_C_LINK_LTYPE_NORMAL,
	);
	return $arr;
}

function &get_enclosure_option()
{
	$arr = array(
		_RSSC_LINK_ENCLOSURE_NON => RSSC_C_LINK_ENCLOSURE_NON,
		_RSSC_LINK_ENCLOSURE_POD => RSSC_C_LINK_ENCLOSURE_POD,
	);
	return $arr;
}

// --- class end ---
}

//=========================================================
// class link handler
//=========================================================
class rssc_link_handler extends happy_linux_object_handler
{
// link table
	var $_link_lid;
	var $_link_obj;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_link_handler( $dirname )
{
	$this->happy_linux_object_handler($dirname, 'link', 'lid', 'rssc_link');

	$this->set_debug_db_sql(   RSSC_DEBUG_LINK_SQL );
	$this->set_debug_db_error( RSSC_DEBUG_ERROR );
}

//=========================================================
// Public
//=========================================================
//---------------------------------------------------------
// basic function
//---------------------------------------------------------
function _build_insert_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql  = 'INSERT INTO '.$this->_table.' (';
	$sql .= 'uid, ';
	$sql .= 'mid, ';
	$sql .= 'p1, ';
	$sql .= 'p2, ';
	$sql .= 'p3, ';
	$sql .= 'title, ';
	$sql .= 'url, ';
	$sql .= 'ltype, ';
	$sql .= 'rdf_url, ';
	$sql .= 'rss_url, ';
	$sql .= 'atom_url, ';
	$sql .= 'mode, ';
	$sql .= 'encoding, ';
	$sql .= 'refresh, ';
	$sql .= 'headline, ';
	$sql .= 'updated_unix, ';
	$sql .= 'channel, ';
	$sql .= 'xml, ';

	$sql .= 'enclosure, ';
	$sql .= 'censor, ';
	$sql .= 'plugin, ';
	$sql .= 'post_plugin, ';
	$sql .= 'icon, ';
	$sql .= 'gicon_id, ';

	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2 ';

	$sql .= ') VALUES (';
	$sql .= intval($uid).', ';
	$sql .= intval($mid).', ';
	$sql .= intval($p1).', ';
	$sql .= intval($p2).', ';
	$sql .= intval($p3).', ';
	$sql .= $this->quote($title).', ';
	$sql .= $this->quote($url).', ';
	$sql .= intval($ltype).', ';
	$sql .= $this->quote($rdf_url).', ';
	$sql .= $this->quote($rss_url).', ';
	$sql .= $this->quote($atom_url).', ';
	$sql .= intval($mode).', ';
	$sql .= $this->quote($encoding).', ';
	$sql .= intval($refresh).', ';
	$sql .= intval($headline).', ';
	$sql .= intval($updated_unix).', ';
	$sql .= $this->quote($channel).', ';
	$sql .= $this->quote($xml).', ';

	$sql .= intval($enclosure).', ';
	$sql .= $this->quote($censor).', ';
	$sql .= $this->quote($plugin).', ';
	$sql .= $this->quote($post_plugin).', ';
	$sql .= $this->quote($icon).', ';
	$sql .= intval($gicon_id).', ';

	$sql .= intval($aux_int_1).', ';
	$sql .= intval($aux_int_2).', ';
	$sql .= $this->quote($aux_text_1).', ';
	$sql .= $this->quote($aux_text_2).' ';
	$sql .= ')';

	return $sql;
}

function _build_update_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'uid='.intval($uid).', ';
	$sql .= 'mid='.intval($mid).', ';
	$sql .= 'p1='.intval($p1).', ';
	$sql .= 'p2='.intval($p2).', ';
	$sql .= 'p3='.intval($p3).', ';
	$sql .= 'title='.$this->quote($title).', ';
	$sql .= 'url='.$this->quote($url).', ';
	$sql .= 'ltype='.intval($ltype).', ';
	$sql .= 'rdf_url='.$this->quote($rdf_url).', ';
	$sql .= 'rss_url='.$this->quote($rss_url).', ';
	$sql .= 'atom_url='.$this->quote($atom_url).', ';
	$sql .= 'mode='.intval($mode).', ';
	$sql .= 'encoding='.$this->quote($encoding).', ';
	$sql .= 'refresh='.intval($refresh).', ';
	$sql .= 'headline='.intval($headline).', ';
	$sql .= 'updated_unix='.intval($updated_unix).', ';
	$sql .= 'channel='.$this->quote($channel).', ';
	$sql .= 'xml='.$this->quote($xml).', ';

	$sql .= 'enclosure='.intval($enclosure).', ';
	$sql .= 'censor='.$this->quote($censor).', ';
	$sql .= 'plugin='.$this->quote($plugin).', ';
	$sql .= 'post_plugin='.$this->quote($post_plugin).', ';
	$sql .= 'icon='.$this->quote($icon).', ';
	$sql .= 'gicon_id='.intval($gicon_id).', ';

	$sql .= 'aux_int_1='.intval($aux_int_1).', ';
	$sql .= 'aux_int_2='.intval($aux_int_2).', ';
	$sql .= 'aux_text_1='.$this->quote($aux_text_1).', ';
	$sql .= 'aux_text_2='.$this->quote($aux_text_2).' ';
	$sql .= ' WHERE lid='.intval($lid);

	return $sql;
}

//---------------------------------------------------------
// get same link list
// for admin/link_manage.php
//---------------------------------------------------------
function &get_list_by_rssurl( $url1, $url2='', $url3='', $lid=0 )
{
	$list   = false;
	$q_url1 = '';
	$q_url2 = '';
	$q_url3 = '';

	$sql1 = 'SELECT lid FROM '.$this->_table.' WHERE ';
	$sql2 = '';

	if ( $url1 && ($url1 != 'http://') )
	{
		$q_url1 = $this->quote($url1);
		$sql2 .= 'rdf_url='. $q_url1.' OR ';
		$sql2 .= 'rss_url='. $q_url1.' OR ';
		$sql2 .= 'atom_url='.$q_url1;
	}

	if ( $url2 && ($url2 != 'http://') )
	{
		if ($q_url1)
		{
			$sql2 .= ' OR ';
		}

		$q_url2 = $this->quote($url2);
		$sql2 .= 'rdf_url='. $q_url2.' OR ';
		$sql2 .= 'rss_url='. $q_url2.' OR ';
		$sql2 .= 'atom_url='.$q_url2;
	}

	if ( $url3 && ($url3 != 'http://') )
	{
		if ($q_url1 || $q_url2)
		{
			$sql2 .= ' OR ';
		}

		$q_url3 = $this->quote($url3);
		$sql2 .= 'rdf_url='. $q_url3.' OR ';
		$sql2 .= 'rss_url='. $q_url3.' OR ';
		$sql2 .= 'atom_url='.$q_url3;
	}

	if ( $sql2 )
	{
		$sql = $sql1.' ( '.$sql2.' ) ';

		if ( $lid )
		{
			$sql .= 'AND lid != '.intval($lid); 
		}

		$list =& $this->get_first_rows_by_sql($sql);
		if ( !is_array($list) || !count($list) )
		{
			$list = false;
		}
	}

	return $list;
}

//---------------------------------------------------------
// check_exist_rssurl
// for admin/link_manage.php
//---------------------------------------------------------
function build_error_rssurl_list($list, $script)
{
	$msg = null;
	if ( is_array($list) && (count($list) > 0) )
	{
		$msg = "<ul>";

		foreach ($list as $lid)
		{
			$msg .= $this->_build_error_rssurl_list_single($lid, $script);
		}

		$msg .= "</ul>\n";
	}
	return $msg;
}

function _build_error_rssurl_list_single($lid, $script)
{
	$text = null;
	$obj  = $this->getCache($lid);
	if ( is_object($obj) )
	{
		$lid_s   = sprintf("%03d", $lid);
		$url_l   = $script.$lid;
		$title_s = $obj->getVar('title');
		$url_s   = $obj->getVar('url');

		$text  = '<li>';
		$text .= '<a href="'.$url_l.'" target="_blank">'.$lid_s.'</a> : ';
		$text .= '<a href="'.$url_s.'" target="_blank">'.$title_s.'</a> ';
		$text .= "</li>\n";
	}
	return $text;
}

function get_mode_option()
{
	$obj =& $this->create();
	return $obj->get_mode_option();
}

//=========================================================
// private
//=========================================================
//---------------------------------------------------------
// link object
//---------------------------------------------------------
function _set_lid($lid)
{
	$lid = intval($lid);
	if ($lid < 0)
	{
		$this->_set_errors( 'rssc_link_handler: lid not above zero' );
		return false;
	}

	$this->_link_lid = $lid;
	return true;
}

function _get_link_obj($lid)
{
	if ( !$this->_set_lid($lid) )
	{
		$this->_set_errors( 'rssc_link_handler: lid not above zero' );
		return false;
	}

	$obj =& $this->get($lid);

	if ( !is_object($obj) )
	{
		$this->_set_errors( 'rssc_link_handler: link object not exist' );
		return false;
	}

	$this->_link_obj  = $obj;
	return $obj;
}

// --- class end ---
}

// === class end ===
}

?>