<?php
// $Id: rssc_feed_handler.php,v 1.3 2012/04/10 03:06:50 ohwada Exp $

// 2012-04-02 K.OHWADA
// site_link XOBJ_DTYPE_URL -> XOBJ_DTYPE_URL_AREA

// 2011-12-29 K.OHWADA
// PHP 5.3 : Assigning the return value of new by reference is now deprecated.

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// change varchar to text: link

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// match http://xxx/*http://yyy/

// 2007-07-01 K.OHWADA
// add act field
// add get_objects_non_act() etc

// 2006-09-01 K.OHWADA
// add get_objects_latest()   : remove get_latest()
// add get_objects_by_where() : remove get_feeds_by_where()
// add get_count_by_mid() get_objects_by_mid_order()
// remove get_feed_by_fid() get_feeds_by_lid()

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler
// use happy_linux_strings
// support podcast

// 2006-06-29 K.OHWADA
// get_objects_by_lid_desc
// get_objects_by_link_desc

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// class feed
// this file contain 2 class
//   rssc_feed
//   rssc_feed_handler
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_feed_hnadler') ) 
{

//=========================================================
// class feed
//=========================================================

class rssc_feed extends happy_linux_object
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_feed()
{
	$this->happy_linux_object();

	$this->initVar('fid', XOBJ_DTYPE_INT, null, false);
	$this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('mid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p1',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p2',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p3',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('site_title', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('site_link',  XOBJ_DTYPE_URL_AREA );
	$this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('link',  XOBJ_DTYPE_URL_AREA );
	$this->initVar('entry_id', XOBJ_DTYPE_URL_AREA );
	$this->initVar('guid',     XOBJ_DTYPE_URL_AREA );
	$this->initVar('updated_unix',   XOBJ_DTYPE_INT, 0, false);
	$this->initVar('published_unix', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('category',     XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('author_name',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('author_uri',   XOBJ_DTYPE_URL_AREA );
	$this->initVar('author_email', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('type_cont',    XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('raws',    XOBJ_DTYPE_TXTAREA);
	$this->initVar('content', XOBJ_DTYPE_TXTAREA);
	$this->initVar('search',  XOBJ_DTYPE_TXTAREA);
	$this->initVar('aux_int_1',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);

// enclosure
	$this->initVar('enclosure_url',    XOBJ_DTYPE_URL_AREA );
	$this->initVar('enclosure_type',   XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('enclosure_length', XOBJ_DTYPE_INT, 0);

	$this->initVar('act', XOBJ_DTYPE_INT, 1);

// geo
	$this->initVar('geo_lat',  XOBJ_DTYPE_FLOAT, 0);
	$this->initVar('geo_long', XOBJ_DTYPE_FLOAT, 0);

// media
	$this->initVar('media_content_url',      XOBJ_DTYPE_URL_AREA );
	$this->initVar('media_content_type',     XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('media_content_medium',   XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('media_content_filesize', XOBJ_DTYPE_INT, 0);
	$this->initVar('media_content_width',    XOBJ_DTYPE_INT, 0);
	$this->initVar('media_content_height',   XOBJ_DTYPE_INT, 0);
	$this->initVar('media_thumbnail_url',    XOBJ_DTYPE_URL_AREA );
	$this->initVar('media_thumbnail_width',  XOBJ_DTYPE_INT, 0);
	$this->initVar('media_thumbnail_height', XOBJ_DTYPE_INT, 0);
	
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function &get_raws()
{
	$ret =& $this->getVarArray('raws');
	return $ret;
}

function &get_export_raws()
{
	$raws =& $this->get_raws();
	$text = var_export($raws, TRUE);
	$ret  = htmlspecialchars($text, ENT_QUOTES);
	return $ret;
}

function get_act_option()
{
	$opt = array(
		_RSSC_FEED_ACT_NON  => 0,
		_RSSC_FEED_ACT_VIEW => 1,
	);
	return $opt;
}

// --- class end ---
}

//=========================================================
// class feed handler
//=========================================================
class rssc_feed_handler extends happy_linux_object_handler
{

// class
	var $_strings;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_feed_handler( $dirname )
{
	$this->happy_linux_object_handler($dirname, 'feed', 'fid', 'rssc_feed');

	$this->set_debug_db_sql(   RSSC_DEBUG_FEED_SQL );
	$this->set_debug_db_error( RSSC_DEBUG_ERROR );

// class
	$this->_strings =& happy_linux_strings::getInstance();
}

//=========================================================
// Public
//=========================================================
//---------------------------------------------------------
// basic function
//---------------------------------------------------------

// for future
// now, admin cannot add feed record
function _build_insert_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql  = 'INSERT INTO '.$this->_table.' (';
	$sql .= 'lid, ';
	$sql .= 'uid, ';
	$sql .= 'mid, ';
	$sql .= 'p1, ';
	$sql .= 'p2, ';
	$sql .= 'p3, ';
	$sql .= 'site_title, ';
	$sql .= 'site_link, ';
	$sql .= 'title, ';
	$sql .= 'link, ';
	$sql .= 'entry_id, ';
	$sql .= 'guid, ';
	$sql .= 'updated_unix, ';
	$sql .= 'published_unix, ';
	$sql .= 'category, ';
	$sql .= 'author_name, ';
	$sql .= 'author_uri, ';
	$sql .= 'author_email, ';
	$sql .= 'type_cont, ';
	$sql .= 'raws, ';
	$sql .= 'content, ';
	$sql .= 'search, ';
	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2, ';

// enclosure
	$sql .= 'enclosure_url, ';
	$sql .= 'enclosure_type, ';
	$sql .= 'enclosure_length, ';
	$sql .= 'act, ';

// geo
	$sql .= 'geo_lat, ';
	$sql .= 'geo_long, ';

// media
	$sql .= 'media_content_url, ';
	$sql .= 'media_content_type, ';
	$sql .= 'media_content_medium, ';
	$sql .= 'media_content_filesize, ';
	$sql .= 'media_content_width, ';
	$sql .= 'media_content_height, ';
	$sql .= 'media_thumbnail_url, ';
	$sql .= 'media_thumbnail_width, ';
	$sql .= 'media_thumbnail_height ';

	$sql .= ') VALUES (';
	$sql .= intval($lid).', ';
	$sql .= intval($uid).', ';
	$sql .= intval($mid).', ';
	$sql .= intval($p1).', ';
	$sql .= intval($p2).', ';
	$sql .= intval($p3).', ';
	$sql .= $this->quote($site_title).', ';
	$sql .= $this->quote($site_link).', ';
	$sql .= $this->quote($title).', ';
	$sql .= $this->quote($link).', ';
	$sql .= $this->quote($entry_id).', ';
	$sql .= $this->quote($guid).', ';
	$sql .= intval($updated_unix).', ';
	$sql .= intval($published_unix).', ';
	$sql .= $this->quote($category).', ';
	$sql .= $this->quote($author_name).', ';
	$sql .= $this->quote($author_uri).', ';
	$sql .= $this->quote($author_email).', ';
	$sql .= $this->quote($type_cont).', ';
	$sql .= $this->quote($raws).', ';
	$sql .= $this->quote($content).', ';
	$sql .= $this->quote($search).', ';
	$sql .= intval($aux_int_1).', ';
	$sql .= intval($aux_int_2).', ';
	$sql .= $this->quote($aux_text_1).', ';
	$sql .= $this->quote($aux_text_2).', ';

// enclosure
	$sql .= $this->quote($enclosure_url).', ';
	$sql .= $this->quote($enclosure_type).', ';
	$sql .= intval($enclosure_length).', ';
	$sql .= intval($act).', ';

// geo
	$sql .= floatval($geo_lat).', ';
	$sql .= floatval($geo_long).', ';

// media	
	$sql .= $this->quote($media_content_url).', ';
	$sql .= $this->quote($media_content_type).', ';
	$sql .= $this->quote($media_content_medium).', ';
	$sql .= intval($media_content_filesize).', ';
	$sql .= intval($media_content_width).', ';
	$sql .= intval($media_content_height).', ';
	$sql .= $this->quote($media_thumbnail_url).', ';
	$sql .= intval($media_thumbnail_width).', ';
	$sql .= intval($media_thumbnail_height).' ';

	$sql .= ')';

	return $sql;
}

function _build_update_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'lid='.intval($lid).', ';
	$sql .= 'uid='.intval($uid).', ';
	$sql .= 'mid='.intval($mid).', ';
	$sql .= 'p1='.intval($p1).', ';
	$sql .= 'p2='.intval($p2).', ';
	$sql .= 'p3='.intval($p3).', ';
	$sql .= 'site_title='.$this->quote($site_title).', ';
	$sql .= 'site_link='.$this->quote($site_link).', ';
	$sql .= 'title='.$this->quote($title).', ';
	$sql .= 'link='.$this->quote($link).', ';
	$sql .= 'entry_id='.$this->quote($entry_id).', ';
	$sql .= 'guid='.$this->quote($guid).', ';
	$sql .= 'updated_unix='.intval($updated_unix).', ';
	$sql .= 'published_unix='.intval($published_unix).', ';
	$sql .= 'category='.$this->quote($category).', ';
	$sql .= 'author_name='.$this->quote($author_name).', ';
	$sql .= 'author_uri='.$this->quote($author_uri).', ';
	$sql .= 'author_email='.$this->quote($author_email).', ';
	$sql .= 'type_cont='.$this->quote($type_cont).', ';
	$sql .= 'raws='.$this->quote($raws).', ';
	$sql .= 'content='.$this->quote($content).', ';
	$sql .= 'search='.$this->quote($search).', ';
	$sql .= 'aux_int_1='.intval($aux_int_1).', ';
	$sql .= 'aux_int_2='.intval($aux_int_2).', ';
	$sql .= 'aux_text_1='.$this->quote($aux_text_1).', ';
	$sql .= 'aux_text_2='.$this->quote($aux_text_2).', ';

// enclosure
	$sql .= 'enclosure_url='.$this->quote($enclosure_url).', ';
	$sql .= 'enclosure_type='.$this->quote($enclosure_type).', ';
	$sql .= 'enclosure_length='.intval($enclosure_length).', ';
	$sql .= 'act='.intval($act).', ';

// geo
	$sql .= 'geo_lat='.floatval($geo_lat).', ';
	$sql .= 'geo_long='.floatval($geo_long).', ';

// media
	$sql .= 'media_content_url='.$this->quote($media_content_url).', ';
	$sql .= 'media_content_type='.$this->quote($media_content_type).', ';
	$sql .= 'media_content_medium='.$this->quote($media_content_medium).', ';
	$sql .= 'media_content_filesize='.intval($media_content_filesize).', ';
	$sql .= 'media_content_width='.intval($media_content_width).', ';
	$sql .= 'media_content_height='.intval($media_content_height).', ';
	$sql .= 'media_thumbnail_url='.$this->quote($media_thumbnail_url).', ';
	$sql .= 'media_thumbnail_width='.intval($media_thumbnail_width).', ';
	$sql .= 'media_thumbnail_height='.intval($media_thumbnail_height).' ';

	$sql .= 'WHERE fid='.intval($fid);

	return $sql;
}

//---------------------------------------------------------
// get count
//---------------------------------------------------------
function get_total()
{
	$ret = $this->getCount();
	return $ret;
}

function get_count_by_lid($lid)
{
	$ret = 0;
	if ($lid)
	{
		$criteria = new CriteriaCompo();
		$criteria->add( $this->get_addtion_by_lid($lid) );
		$ret = $this->getCount($criteria);
	}
	return $ret;
}

function get_count_by_lid_non_act($lid)
{
	$ret = 0;
	if ($lid)
	{
		$criteria = new CriteriaCompo();
		$criteria->add( new criteria('act', 0, '=') );
		$criteria->add( $this->get_addtion_by_lid($lid) );
		$ret = $this->getCount($criteria);
	}
	return $ret;
}

function get_count_by_link($link)
{
	$ret = 0;
	if ($link)
	{
		$criteria = new CriteriaCompo();
		$criteria->add( $this->get_addtion_by_link($link) );
		$ret = $this->getCount($criteria);
	}
	return $ret;
}

function get_count_by_link_non_act($link)
{
	$ret = 0;
	if ($link)
	{
		$criteria = new CriteriaCompo();
		$criteria->add( new criteria('act', 0, '=') );
		$criteria->add( $this->get_addtion_by_link($link) );
		$ret = $this->getCount($criteria);
	}
	return $ret;
}

function &get_addtion_by_lid($lid)
{
	$addtion = new Criteria('lid', $lid, '=');
	return $addtion;
}

function &get_addtion_by_link($link)
{
// match http://xxx/*http://yyy/
	$link = '%'.$link.'%';
	$addtion = new Criteria('link', $link, 'LIKE');
	return $addtion;
}

function get_count_non_act()
{
	$criteria = new CriteriaCompo();
	$criteria->add( new Criteria('act', 0, '=') );
	$ret = $this->getCount( $criteria );
	return $ret;
}

//---------------------------------------------------------
// get objects
//---------------------------------------------------------
function &get_objects($limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects( $criteria );
	return $objs;
}

function &get_objects_by_lid_asc($lid, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_lid($lid, $limit, $start, 'fid ASC');
	return $objs;
}

function &get_objects_by_lid_desc($lid, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_lid($lid, $limit, $start, 'fid DESC');
	return $objs;
}

function &get_objects_by_lid($lid, $limit=0, $start=0, $sort='fid ASC')
{
	$objs = false;
	if ($lid)
	{
		$criteria = new CriteriaCompo();
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		$criteria->add( $this->get_addtion_by_lid($lid) );
		$criteria->setSort($sort);
		$objs =& $this->getObjects( $criteria );
	}
	return $objs;
}

function &get_objects_by_lid_non_act_asc($lid, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_lid_non_act($lid, $limit, $start, 'fid ASC');
	return $objs;
}

function &get_objects_by_lid_non_act_desc($lid, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_lid_non_act($lid, $limit, $start, 'fid DESC');
	return $objs;
}

function &get_objects_by_lid_non_act($lid, $limit=0, $start=0, $sort='fid ASC')
{
	$objs = false;
	if ($lid)
	{
		$criteria = new CriteriaCompo();
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		$criteria->add( new criteria('act', 0, '=') );
		$criteria->add( $this->get_addtion_by_lid($lid) );
		$criteria->setSort($sort);
		$objs =& $this->getObjects( $criteria );
	}
	return $objs;
}

function &get_objects_by_link_asc($link, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_link($link, $limit, $start, 'fid ASC');
	return $objs;
}

function &get_objects_by_link_desc($link, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_link($link, $limit, $start, 'fid DESC');
	return $objs;
}

function &get_objects_by_link($link, $limit=0, $start=0, $sort='fid ASC')
{
	$objs = false;
	if ($link)
	{
		$criteria = new CriteriaCompo();
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		$criteria->add( $this->get_addtion_by_link($link) );
		$criteria->setSort($sort);
		$objs =& $this->getObjects( $criteria );
	}
	return $objs;
}

function &get_objects_by_link_non_act_asc($link, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_link_non_act($link, $limit, $start, 'fid ASC');
	return $objs;
}

function &get_objects_by_link_non_act_desc($link, $limit=0, $start=0)
{
	$objs =& $this->get_objects_by_link_non_act($link, $limit, $start, 'fid DESC');
	return $objs;
}

function &get_objects_by_link_non_act($link, $limit=0, $start=0, $sort='fid ASC')
{
	$objs = false;
	if ($link)
	{
		$criteria = new CriteriaCompo();
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		$criteria->add( new criteria('act', 0, '=') );
		$criteria->add( $this->get_addtion_by_link($link) );
		$criteria->setSort($sort);
		$objs =& $this->getObjects( $criteria );
	}
	return $objs;
}

function &get_objects_non_act_asc($limit=0, $start=0)
{
	$objs =& $this->get_objects_non_act($limit, $start, 'fid ASC');
	return $objs;
}

function &get_objects_non_act_desc($limit=0, $start=0)
{
	$objs =& $this->get_objects_non_act($limit, $start, 'fid DESC');
	return $objs;
}

function &get_objects_non_act($limit=0, $start=0, $sort='fid ASC')
{
	$criteria = new CriteriaCompo();
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$criteria->add( new criteria('act', 0, '=') );
	$criteria->setSort($sort);
	$objs =& $this->getObjects( $criteria );
	return $objs;
}

// --- class end ---
}

// === class end ===
}

?>