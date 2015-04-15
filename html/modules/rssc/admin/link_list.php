<?php
// $Id: link_list.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// use feed_list_lid.php

// 2006-09-10 K.OHWADA
// Notice: Only variables should be assigned by reference

// 2006-07-10 K.OHWADA
// use happy_linux_page_frame

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';

//=========================================================
// class admin_link_list
//=========================================================
class admin_link_list extends happy_linux_page_frame
{

// handler
	var $_feed_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_list()
{
	$this->happy_linux_page_frame();
	$this->set_handler('link', RSSC_DIRNAME);
	$this->set_id_name('lid');
	$this->set_lang_title( _AM_RSSC_LIST_LINK );
	$this->set_flag_execute_time( true );

// handler
	$this->_feed_handler =& rssc_get_handler('feed', RSSC_DIRNAME);
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_list();
	}
	return $instance;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
// Notice: Only variables should be assigned by reference
function &_get_table_header()
{
	$edit = _RSSC_LINK_ID.'<br />('._EDIT.')';

	$arr = array(
		$edit,
		_AM_RSSC_SHOW_RSS,
		_AM_RSSC_SHOW_FEED,
		_RSSC_SITE_TITLE,
		_RSSC_RSS_MODE,
		_RSSC_XML_URL,
	);

	return $arr;
}

function &_get_cols( &$obj )
{
	$lid = $obj->getVar('lid');

	$edit_jump = 'link_manage.php?op=mod_form&amp;lid=';
	$link_link = $this->_build_page_id_link_by_obj( $obj, 'lid', $edit_jump);

	list($href1, $href2) = $this->_get_linkfeed($obj);

	$view_image    = RSSC_URL."/images/text.gif";
	$edit_image    = RSSC_URL."/images/edit.gif";
	$view_img_link = $this->build_html_img_tag($view_image, 0, 0, 0, 'link');
	$edit_img_link = $this->build_html_img_tag($edit_image, 0, 0, 0, 'edit');
	$view_url_lid  = RSSC_URL .'/single_link.php?lid='. $lid;
	$edit_url_lid  = RSSC_URL .'/admin/'. $edit_jump . $lid;
	$view_link     = $this->build_html_a_href_name($view_url_lid, $view_img_link, '', false);
	$edit_link     = $this->build_html_a_href_name($edit_url_lid, $edit_img_link, '', false);

	$edit = $edit_link.'&nbsp;'.$view_link.'&nbsp;'.$link_link;

	$mode_name = $obj->get_mode_name();
	$xml_url_s = $obj->get_rssurl_by_mode('s');

	$arr = array(
		$edit,
		$href1,
		$href2,
		$this->_build_page_name_link_by_obj($obj, 'url',      'title', '_blank'),
		$mode_name,
		$this->build_html_a_href_name($xml_url_s, '', '_blank'),
	);

	return $arr;
}

function _get_linkfeed(&$obj)
{
	$lid   = $obj->getVar('lid');
	$lid_p = sprintf("%03d",$lid);
	$count = $this->_feed_handler->get_count_by_lid( $lid );

	if ($count)
	{
		$name_feed = "FEED ($count)";
	}
	else
	{
		$name_feed = "FEED";
	}

	$jump_rss  = "parse_rss.php?lid=".$lid;
	$jump_feed = "feed_list_lid.php?lid=".$lid;
	$href1 = $this->build_html_a_href_name($jump_rss, 'RSS');
	$href2 = $this->build_html_a_href_name($jump_feed, $name_feed);

	return array($href1, $href2);
}

// --- class end ---
}


//=========================================================
// main
//=========================================================
xoops_cp_header();

rssc_admin_print_header();
rssc_admin_print_menu();

$list =& admin_link_list::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>