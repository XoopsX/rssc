<?php
// $Id: feed_list_lid.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-07-01 K.OHWADA
// divid from feed_list_class.php

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';
include 'feed_list_class.php';

//=========================================================
// class admin list feed
//=========================================================
class admin_feed_list_lid extends admin_feed_list
{
	var $_link_handler;

	var $_lid       = 0;
	var $_total_lid = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_feed_list_lid()
{
	$this->admin_feed_list();
	$this->set_max_sortid(4);

	$this->_link_handler =& rssc_get_handler('link', RSSC_DIRNAME);
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_feed_list_lid();
	}
	return $instance;
}

//---------------------------------------------------------
// Pre processing
//---------------------------------------------------------
function _init()
{
	if ( isset($_GET['lid']) )
	{
		$this->_lid = $this->_post->get_get_int('lid');
	}
}

function _get_total()
{
	$this->_total_lid     = $this->_handler->get_count_by_lid($this->_lid);
	$this->_total_non_act = $this->_handler->get_count_by_lid_non_act($this->_lid);
	switch ($this->_sortid)
	{
		case 2:
		case 3:
			$total = $this->_total_non_act;
			break;

		case 0:
		case 1:
		default:
			$total = $this->_total_lid;
			break;
	}
	return $total;
}

//---------------------------------------------------------
// items
//---------------------------------------------------------
function &_get_items($limit=0, $start=0)
{
	switch ($this->_sortid)
	{
		case 1:
			$objs =& $this->_handler->get_objects_by_lid_desc($this->_lid, $limit, $start);
			break;

		case 2:
			$objs =& $this->_handler->get_objects_by_lid_non_act_asc($this->_lid, $limit, $start);
			break;

		case 3:
			$objs =& $this->_handler->get_objects_by_lid_non_act_desc($this->_lid, $limit, $start);
			break;

		case 0:
		default:
			$objs =& $this->_handler->get_objects_by_lid_asc($this->_lid, $limit, $start);
			break;
	}
	return $objs;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_sub()
{
	$link_obj = $this->_link_handler->get($this->_lid);
	if ( is_object($link_obj) )
	{
		$title_s  = $link_obj->getVar('title', 's');
		$link     = '<a href="link_manage.php?op=mod_form&lid='. $this->_lid .'">'.  $title_s .'</a>';
		printf(_AM_RSSC_THEREARE_TITLE, $link, $this->_total_lid );
		echo "<br /><br />\n";
	}
}

function _get_condition()
{
	$condition = 'lid = '.$this->_lid;
	switch ($this->_sortid)
	{
		case 2:
		case 3:
			$condition .= ', act = 0';
			break;

		case 0:
		case 1:
		default:
			break;
	}
	return $condition;
}

//---------------------------------------------------------
// script
//---------------------------------------------------------
function _get_script_sortid( $sortid )
{
	$script = $this->_get_script() . '&amp;sortid=' . $sortid;
	return $script;
}

function _get_script()
{
	$script = xoops_getenv('PHP_SELF') . '?lid=' . $this->_lid;
	return $script;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
xoops_cp_header();
rssc_admin_print_header();
rssc_admin_print_menu();

$list =& admin_feed_list_lid::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>