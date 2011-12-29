<?php
// $Id: feed_list_class.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_print_request_uri()
// set_flag_execute_time()

// 2007-07-01 K.OHWADA
// divid from feed_list.php

//=========================================================
// RSS Center Module
// 2007-05-26 K.OHWADA
//=========================================================

include_once RSSC_ROOT_PATH.'/class/rssc_feed_basic_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_feed_handler.php';

//=========================================================
// class admin list feed
//=========================================================
class admin_feed_list extends happy_linux_page_frame
{
	var $_post;
	var $_strings;

	var $_total_non_act = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_feed_list()
{
	$this->happy_linux_page_frame();

	$this->set_handler('feed', RSSC_DIRNAME);
	$this->set_id_name('fid');
	$this->set_max_sortid(4);

	$this->set_lang_title( _AM_RSSC_LIST_FEED );
	$this->set_submit_colspan(0, 3, 3);
	$this->set_flag_form(true);

	$this->set_form_name('rssc_feed');
	$this->set_action('feed_manage.php');
	$this->set_operation('mod_all');
	$this->set_flag_print_request_uri( true );
	$this->set_flag_execute_time( true );

// class instance
	$this->_post    =& happy_linux_post::getInstance();
	$this->_strings =& happy_linux_strings::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_feed_list();
	}
	return $instance;
}

//---------------------------------------------------------
// Pre processing
//---------------------------------------------------------
function _get_total()
{
	$this->_total_non_act = $this->_handler->get_count_non_act();
	switch ($this->_sortid)
	{
		case 2:
		case 3:
			$total = $this->_total_non_act;
			break;

			case 0:
			case 1:
			default:
				$total = $this->_handler->getCount();
				break;
	}
	return $total;
}

//---------------------------------------------------------
// items
//---------------------------------------------------------
// Notice: Only variables should be assigned by reference
function _get_table_header()
{
	$arr = array(
		$this->build_form_js_checkall(),
		_RSSC_FEED_ID,
		_HAPPY_LINUX_VIEW_TITLE,
		_HAPPY_LINUX_VIEW_SITE_TITLE,
		_HAPPY_LINUX_VIEW_UPDATED,
		_HAPPY_LINUX_VIEW_CONTENT,
	);

	return $arr;
}

function &_get_items($limit=0, $start=0)
{
	switch ($this->_sortid)
	{
		case 1:
			$objs =& $this->_handler->get_objects_desc($limit, $start);
			break;

		case 2:
			$objs =& $this->_handler->get_objects_non_act_asc($limit, $start);
			break;

		case 3:
			$objs =& $this->_handler->get_objects_non_act_desc($limit, $start);
			break;

		case 0:
			default:
			$objs =& $this->_handler->get_objects_asc($limit, $start);
			break;
	}
	return $objs;
}

function &_get_cols(&$obj)
{
	$fid          = $obj->getVar('fid');
	$updated_unix = $obj->getVar('updated_unix', 'n');
	$content      = $obj->getVar('content', 'n');

	$jump = 'feed_manage.php?op=mod_form&amp;fid=';

	if ($content)
	{
		$content_html = $this->_strings->build_summary($content, 50, 's');
	}
	else
	{
		$content_html = '&nbsp;';
	}

	$url_view_fid = RSSC_URL."/single_feed.php?fid=".$fid;
	$url_text_gif = RSSC_URL."/images/text.gif";
	$img_link  = $this->build_html_img_tag($url_text_gif, 0, 0, 0, 'link');
	$view_feed = $this->build_html_a_href_name($url_view_fid, $img_link, '', false);
	$link_feed = $this->_build_page_id_link_by_obj( $obj, 'fid', $jump);

	$arr = array(
		$this->build_form_js_checkbox($fid),
		$view_feed.'&nbsp;&nbsp;'.$link_feed,
		$this->_build_page_name_link_by_obj($obj, 'link',      'title',      '_blank'),
		$this->_build_page_name_link_by_obj($obj, 'site_link', 'site_title', '_blank'),
		formatTimestamp($updated_unix, 'mysql'),
		$content_html,
	);

	return $arr;
}

function _get_col_class(&$obj)
{
	if ( $obj->getVar('act') == 0 )
	{
		return 'odd';
	}
	return '';
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_top()
{
	echo "<h4>"._AM_RSSC_LIST_FEED."</h4>\n";
	printf(_RSSC_THEREARE, $this->_get_total_all() );
	echo "<br /><br />\n";

	$this->_print_sub();
	$this->_print_index();
	$this->_print_condition();
}

function _print_sub()
{
	// dummy
}

function _print_index()
{
	$title = _HAPPY_LINUX_ID_ASC;
	switch ($this->_sortid)
	{
		case 2:
			$title = _AM_RSSC_NON_ACT_ASC;
			break;

		case 3:
			$title = _AM_RSSC_NON_ACT_DESC;
			break;

		case 1:
			$title = _HAPPY_LINUX_ID_DESC;
			break;

		case 0:
		case 1:
		default:
			break;
	}

	$total_non_act = "(0)";
	if ( $this->_total_non_act )
	{
		$total_non_act = "(<b>". $this->_total_non_act ."</b>)";
	} 

	echo '<table width="80%" border="0" cellspacing="1" class="outer">';
	echo '<tr class="odd"><td>';
	echo '<li><a href="' .$this->_get_script_sortid(0).  '">'. _HAPPY_LINUX_ID_ASC.  "</a></li>\n";
	echo '<li><a href="' .$this->_get_script_sortid(1). '">'. _HAPPY_LINUX_ID_DESC. "</a></li>\n";
	echo '<li><a href="' .$this->_get_script_sortid(2). '">'. _AM_RSSC_NON_ACT_ASC. "</a> ". $total_non_act ."</li>\n";
	echo '<li><a href="' .$this->_get_script_sortid(3). '">'. _AM_RSSC_NON_ACT_DESC. "</a> ". $total_non_act ."</li>\n";
	echo "</td></tr></table>\n";

	echo "<h4>". $title. "</h4>\n";
}

function _print_condition()
{
	$condition = $this->_get_condition();
	if ( $condition )
	{
		$total = $this->_get_total();
		printf(_AM_RSSC_THERE_ARE_MATCH, $total);
		echo "<br />\n";
		echo _AM_RSSC_CONDITION.": ".$condition. "<br /><br />\n";
	}
}

function _get_condition()
{
	$condition = '';
	switch ($this->_sortid)
	{
		case 2:
		case 3:
			$condition = 'act = 0';
			break;

		case 0:
		case 1:
		default:
			break;
	}
	return $condition;
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function _build_page_col_submit( $colspan=1 )
{
	$text  = $this->build_html_td_tag_begin($this->_SUBMIT_ALIGN, $this->_SUBMIT_VALIGN, $colspan, $this->_SUBMIT_ROWSPAN, $this->_SUBMIT_CLASS);
	$text .= $this->build_html_input_submit('del_all', _DELETE );
	$text .= $this->build_html_input_submit('mod_all', _RSSC_FEED_ACT_NON );
	$text .= $this->build_html_td_tag_end();
	return $text;
}

//---------------------------------------------------------
// script
//---------------------------------------------------------
function _get_script_sortid( $sortid )
{
	$script = $this->_get_script() . '?sortid=' . $sortid;
	return $script;
}

function _get_script()
{
	$script = xoops_getenv('PHP_SELF');
	return $script;
}

// --- class end ---
}

?>