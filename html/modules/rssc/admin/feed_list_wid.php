<?php
// $Id: feed_list_wid.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-10-10 K.OHWADA
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
class admin_feed_list_wid extends admin_feed_list
{
	var $_white_handler;

	var $_wid        = 0;
	var $_total_link = 0;
	var $_link       = '';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_feed_list_wid()
{
	$this->admin_feed_list();
	$this->set_max_sortid(4);

	$this->_white_handler =& rssc_get_handler('white', RSSC_DIRNAME);
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_feed_list_wid();
	}
	return $instance;
}

//---------------------------------------------------------
// Pre processing
//---------------------------------------------------------
function _init()
{
	if ( isset($_GET['wid']) )
	{
		$this->_wid  =  $this->_post->get_get_int('wid');
		$white_obj   =& $this->_white_handler->get($this->_wid);
		$this->_link =  $white_obj->get('url');
	}
}

function _get_total()
{
	$this->_total_link    = $this->_handler->get_count_by_link($this->_link);
	$this->_total_non_act = $this->_handler->get_count_by_link_non_act($this->_link);
	switch ($this->_sortid)
	{
		case 2:
		case 3:
			$total = $this->_total_non_act;
			break;

		case 0:
		case 1:
		default:
			$total = $this->_total_link;
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
			$objs =& $this->_handler->get_objects_by_link_desc($this->_link, $limit, $start);
			break;

		case 2:
			$objs =& $this->_handler->get_objects_by_link_non_act_asc($this->_link, $limit, $start);
			break;

		case 3:
			$objs =& $this->_handler->get_objects_by_link_non_act_desc($this->_link, $limit, $start);
			break;

		case 0:
		default:
			$objs =& $this->_handler->get_objects_by_link_asc($this->_link, $limit, $start);
			break;
	}
	return $objs;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_sub()
{
	$white_obj = $this->_white_handler->get($this->_wid);
	if ( is_object($white_obj) )
	{
		$title_s   = $white_obj->getVar('title', 's');
		$link      = '<a href="white_manage.php?op=mod_form&wid='. $this->_wid .'">'.  $title_s .'</a>';
		printf(_AM_RSSC_THEREARE_TITLE, $link, $this->_total_link );
		echo "<br /><br />\n";
	}
}

function _get_condition()
{
	$condition = 'link = '.$this->_link;
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
	$script = xoops_getenv('PHP_SELF') . '?wid=' . $this->_wid;
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

$list =& admin_feed_list_wid::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>