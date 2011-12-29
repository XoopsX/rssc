<?php
// $Id: rssc_white_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// add field cache ctime in black, white

// 2007-06-01 K.OHWADA
// add field act reg count

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss center Module
// this file contain 2 class
//   rssc_white
//   rssc_white_handler
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_white_handler') ) 
{

//=========================================================
// class white
//=========================================================
class rssc_white extends happy_linux_object
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_white()
{
	$this->happy_linux_object();

	$this->initVar('wid', XOBJ_DTYPE_INT, null, false);
	$this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('mid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p1',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p2',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p3',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('url',   XOBJ_DTYPE_URL,    null, false, 255);
	$this->initVar('memo',  XOBJ_DTYPE_TXTAREA);
	$this->initVar('aux_int_1',  XOBJ_DTYPE_INT, 0);
	$this->initVar('aux_int_2',  XOBJ_DTYPE_INT, 0);
	$this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('act',   XOBJ_DTYPE_INT, 1);
	$this->initVar('reg',   XOBJ_DTYPE_INT, 0);
	$this->initVar('count', XOBJ_DTYPE_INT, 0);

	$this->initVar('cache', XOBJ_DTYPE_INT, 0);
	$this->initVar('ctime', XOBJ_DTYPE_INT, 0);
}

// --- class end ---
}

//=========================================================
// class white handler
//=========================================================
class rssc_white_handler extends happy_linux_object_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_white_handler( $dirname )
{
	$this->happy_linux_object_handler($dirname, 'white', 'wid', 'rssc_white');

	$this->set_debug_db_sql(   RSSC_DEBUG_WHITE_SQL );
	$this->set_debug_db_error( RSSC_DEBUG_ERROR );

}

//---------------------------------------------------------
// function
//---------------------------------------------------------
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
	$sql .= 'title, ';
	$sql .= 'url, ';
	$sql .= 'memo, ';
	$sql .= 'act, ';
	$sql .= 'reg, ';
	$sql .= 'count, ';

	$sql .= 'cache, ';
	$sql .= 'ctime, ';

	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2 ';

	$sql .= ') VALUES (';

	$sql .= intval($lid).', ';
	$sql .= intval($uid).', ';
	$sql .= intval($mid).', ';
	$sql .= intval($p1).', ';
	$sql .= intval($p2).', ';
	$sql .= intval($p3).', ';
	$sql .= $this->quote($title).', ';
	$sql .= $this->quote($url).', ';
	$sql .= $this->quote($memo).', ';
	$sql .= intval($act).', ';
	$sql .= intval($reg).', ';
	$sql .= intval($count).', ';

	$sql .= intval($cache).', ';
	$sql .= intval($ctime).', ';

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
	$sql .= 'lid='.intval($lid).', ';
	$sql .= 'uid='.intval($uid).', ';
	$sql .= 'mid='.intval($mid).', ';
	$sql .= 'p1='.intval($p1).', ';
	$sql .= 'p2='.intval($p2).', ';
	$sql .= 'p3='.intval($p3).', ';
	$sql .= 'title='.$this->quote($title).', ';
	$sql .= 'url='.$this->quote($url).', ';
	$sql .= 'memo='.$this->quote($memo).', ';
	$sql .= 'act='.intval($act).', ';
	$sql .= 'reg='.intval($reg).', ';
	$sql .= 'count='.intval($count).', ';

	$sql .= 'cache='.intval($cache).', ';
	$sql .= 'ctime='.intval($ctime).', ';

	$sql .= 'aux_int_1='.intval($aux_int_1).', ';
	$sql .= 'aux_int_2='.intval($aux_int_2).', ';
	$sql .= 'aux_text_1='.$this->quote($aux_text_1).', ';
	$sql .= 'aux_text_2='.$this->quote($aux_text_2).' ';
	$sql .= 'WHERE wid='.intval($wid);

	return $sql;
}

//---------------------------------------------------------
// get
//---------------------------------------------------------
function &get_objects_count_asc($limit=0, $start=0)
{
	$sort = 'count ASC, wid ASC';
	$criteria = new CriteriaCompo();
	$criteria->setSort($sort);
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_count_desc($limit=0, $start=0)
{
	$sort = 'count DESC, wid ASC';
	$criteria = new CriteriaCompo();
	$criteria->setSort($sort);
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

// --- class end ---
}

// === class end ===
}

?>