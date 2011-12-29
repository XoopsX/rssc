<?php
// $Id: rssc_refresh_all_handler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2007-10-10 K.OHWADA
// PHP 5.2: Non-static method
// PHP 5.2: Assigning the return value of new by reference

// 2007-06-10 K.OHWADA
// word_basic_handler
// happy_linux_bin_file
// use get_active_id_array()
// use open_log()

// 2006-09-20 K.OHWADA
// use happy_linux_error

// 2006-06-04 K.OHWADA
// use link_basic feed_basic handler
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// caller: admin/archive_manage.php & bin/refresh.php
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_refresh_all_handler') ) 
{

//=========================================================
// class rssc_refresh_all_handler
// this class is used by command line
//=========================================================
class rssc_refresh_all_handler extends happy_linux_error
{
	var $_DIRNAME;

// handler
	var $_link_handler;
	var $_feed_handler;
	var $_black_handler;
	var $_word_handler;
	var $_refresh_handler;
	var $_rss_utility;
	var $_bin_file;

// input
	var $_feed_limit = 0;	// unlimit
	var $_word_limit = 0;	// unlimit
	var $_flag_print = true;
	var $_flag_chmod = false;
	var $_fp_result;

// result
	var $_total_link   = 0;
	var $_count_broken = 0;

	var $_count_all    = 0;
	var $_count_skip   = 0;
	var $_count_reject = 0;
	var $_count_update = 0;

// local
	var $_broken_arr   = array();
	var $_count_link   = 0;

	var $_time_start;
	var $_lid_start;
	var $_lid_end;
	var $_num_feed_cleared;
	var $_num_refresh;
	var $_num_atom_site;


//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_refresh_all_handler( $dirname )
{
	$this->_DIRNAME = $dirname;

// handler
	$this->_link_handler    =& rssc_get_handler('link_basic',  $dirname);
	$this->_feed_handler    =& rssc_get_handler('feed_basic',  $dirname);
	$this->_black_handler   =& rssc_get_handler('black_basic', $dirname);
	$this->_word_handler    =& rssc_get_handler('word_basic',  $dirname);
	$this->_refresh_handler =& rssc_get_handler('refresh',     $dirname);

// PHP 5.2: Non-static method
	$this->_bin_file =& happy_linux_get_singleton( 'bin_file' );

	$this->_rss_utility =& $this->_refresh_handler->_rss_utility;
}

//=========================================================
// public
//=========================================================
//---------------------------------------------------------
// refresh XML archive each link
//---------------------------------------------------------
function refresh($limit=0, $start=0)
{
	$this->_refresh_clear();

	$this->_total_link = $this->_link_handler->get_count_all();
	$lid_arr =& $this->_link_handler->get_active_id_array($limit, $start);

	$count_lids = count($lid_arr);
	if ($count_lids == 0)
	{
		$this->_print_write_no_refresh();
		return true;	// no action
	}

	$this->_lid_start   = $lid_arr[0];
	$this->_lid_end     = $lid_arr[$count_lids - 1];
	$this->_num_refresh = $count_lids;

	$this->_refresh_pre();

	foreach($lid_arr as $lid)
	{
		$link_obj =& $this->_link_handler->get_object_by_id($lid);
		if ( !is_object($link_obj) )
		{
			$this->_set_errors( "no link record: lid = $lid" );
			continue;
		}

		$this->_refresh_loop($link_obj);
		unset($link_obj);
	}

	$this->_refresh_post();
	return $this->returnExistError();
}

function learn_black($limit=0, $start=0)
{
	$this->_refresh_clear();

	$this->_total_link = $this->_black_handler->get_count_all();
	$lid_arr =& $this->_black_handler->get_active_id_array($limit, $start);

	$count_lids = count($lid_arr);
	if ($count_lids == 0)
	{
		$this->_print_write_no_refresh();
		return true;	// no action
	}

	$this->_lid_start   = $lid_arr[0];
	$this->_lid_end     = $lid_arr[$count_lids - 1];
	$this->_num_refresh = $count_lids;

	$this->_refresh_pre();

	foreach($lid_arr as $lid)
	{
		$link_obj =& $this->_get_black_object_by_id($lid);
		if ( !is_object($link_obj) )
		{
			continue;
		}

		$this->_refresh_loop($link_obj);
		unset($link_obj);
	}

	$this->_refresh_post();
	return $this->returnExistError();
}


function _print_write_no_refresh()
{
	$data  = '';
	$data .= $this->_get_text_title();
	$data .= $this->_get_text_no_refresh();
	$this->print_write_data($data);
}

function _refresh_clear()
{
	$this->_clear_errors();
	$this->_time_start   = time();
	$this->_broken_arr   = array();
	$this->_count_link   = 0;
	$this->_count_broken = 0;
}

function _refresh_pre()
{
	$this->_refresh_handler->set_force_refresh(1);
	$this->_refresh_handler->clear_count();
	$this->_refresh_handler->open_log();

	$data  = '';
	$data .= $this->_get_text_title();
	$data .= $this->_get_text_html_start();
	$this->print_write_data($data);
}

function _refresh_loop( &$link_obj )
{
	$lid     = $link_obj->get('lid');
	$title   = $link_obj->get('title');
	$rss_url = $link_obj->get_rssurl_by_mode();

	if ( empty($rss_url) ) return;

	if (  $this->_refresh_handler->refresh_by_obj($link_obj) )
	{
		$this->_count_link ++;
	}
	else
	{
		$code = $this->_refresh_handler->getErrorCode();
		if ($code == RSSC_CODE_PARSE_FAILED)
		{
			$this->_count_broken ++;
			$this->_broken_arr[] = array($lid, $title, $rss_url);
		}
		else
		{
			$this->_set_errors( $this->_refresh_handler->getErrors() );
			$this->_set_error_code( $code );
		}
	}
}

function _refresh_post()
{
	$this->_count_all     = $this->_refresh_handler->get_count_all();
	$this->_count_skip    = $this->_refresh_handler->get_count_skip();
	$this->_count_reject  = $this->_refresh_handler->get_count_reject();
	$this->_count_update  = $this->_refresh_handler->get_count_update();
	$this->_refresh_handler->close_log( $this->_flag_chmod );

	$this->_num_feed_cleared = $this->_feed_handler->clear_over_num( $this->_feed_limit );
	$this->_num_word_cleared = $this->_word_handler->clear_over_num( $this->_word_limit );

	$data = $this->_get_text_html_result();
	$this->print_write_data($data);
}

//---------------------------------------------------------
// get result
//---------------------------------------------------------
function get_total()
{
	return $this->_total_link;
}

function get_count_feed()
{
	return $this->_count_update;
}

function get_count_broken()
{
	return $this->_count_broken;
}

//---------------------------------------------------------
// set parameter
//---------------------------------------------------------
function set_feed_limit($value)
{
	$this->_feed_limit = intval($value);
}

function set_word_limit($value)
{
	$this->_word_limit = intval($value);
}

function set_flag_print($value)
{
	$this->_flag_print = (bool)$value;
}

function set_flag_chmod($value)
{
	$this->_flag_chmod = (bool)$value;
}


//=========================================================
// private
//=========================================================
//---------------------------------------------------------
// print HTML
//---------------------------------------------------------
function _get_text_html_start()
{
	$time_now = $this->_get_time_now();

	$text = _AM_RSSC_TIME_START." ".$time_now."<br /><br />\n";
	return $text;
}

function _get_text_html_result()
{
	$time_now    = $this->_get_time_now();
	$time_elapse = $this->_get_time_elapse();

	$text = '';

	if ($this->_count_broken)
	{
		$text .= $this->_get_text_table_start();

		foreach ($this->_broken_arr as $broken)
		{
			list($lid, $title, $url) = $broken;
    		$text .= $this->_get_text_table_line($lid, $title, $url);
		}

		$text .= $this->_get_text_table_end();

		$link_broken = "<font color='red'>$this->_count_broken</font>";
	}
	else
	{
		$link_broken = $this->_count_broken;
	}

	$text .= _AM_RSSC_TIME_END." ".$time_now."<br /><br />\n";
	$text .= "<table><tr>";
	$text .= "<tr><td>"._AM_RSSC_NUM_LINK_TOTAL."</td>";
	$text .= "<td>$this->_total_link "._AM_RSSC_NUM_LINKS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_NUM_LINK_TARGET."</td>";

	if ($this->_lid_start)
	{
		$text .= "<td>$this->_num_refresh "._AM_RSSC_NUM_LINKS." ( "._RSSC_LINK_ID." $this->_lid_start - $this->_lid_end )</td></tr>\n";
	}
	else
	{
		$text .= "<td>$this->_num_refresh "._AM_RSSC_NUM_LINKS."</td></tr>\n";
	}

	$text .= "<tr><td>"._AM_RSSC_NUM_LINK_BROKEN."</td>";
	$text .= "<td>$link_broken "._AM_RSSC_NUM_LINKS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_NUM_LINK_UPDATED."</td>";
	$text .= "<td>$this->_count_link "._AM_RSSC_NUM_LINKS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_NUM_FEED_ALL."</td>";
	$text .= "<td>$this->_count_all "._AM_RSSC_NUM_FEEDS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_NUM_FEED_SKIP."</td>";
	$text .= "<td>$this->_count_skip "._AM_RSSC_NUM_FEEDS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_NUM_FEED_REJECT."</td>";
	$text .= "<td>$this->_count_reject "._AM_RSSC_NUM_FEEDS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_NUM_FEED_UPDATED."</td>";
	$text .= "<td>$this->_count_update "._AM_RSSC_NUM_FEEDS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_NUM_FEED_CLEARED."</td>";
	$text .= "<td>$this->_num_feed_cleared "._AM_RSSC_NUM_FEEDS."</td></tr>\n";
	$text .= "<tr><td>"._AM_RSSC_TIME_ELAPSE."</td>";
	$text .= "<td>$time_elapse</td></tr>\n";
	$text .= "</table>\n";

	return $text;
}

function _get_text_table_start()
{
	$text  = "<br />\n";
	$text .= "<table border='1'><tr>";
	$text .= "<th align='center'>"._RSSC_LINK_ID."</th>";
	$text .= "<th align='center'>"._RSSC_SITE_TITLE."</th>";
	$text .= "<th align='center'>"._RSSC_RSS_URL."</th>";
	$text .= "</tr>\n";

	return $text;
}

function _get_text_table_line($lid, $title, $url)
{
	$link_id = sprintf("%03d",$lid);
	$jump = XOOPS_URL.'/modules/'.$this->_DIRNAME."/admin/link_manage.php?op=mod_form&amp;lid=".$lid;

	$title_html = $this->_sanitize_html_text($title);
	$href1      = $this->_make_html_url($jump, $link_id);
	$href2      = $this->_make_html_url($url);

	$text  = "<tr>";
	$text .= "<td>".$href1."</td>";
	$text .= "<td>".$title_html."</td>";
	$text .= "<td>".$href2."</td>";
	$text .= "</tr>\n";

	return $text;
}

function _get_text_title()
{
	$text  = "<h4>"._AM_RSSC_REFRESH."</h4>\n";
	return $text;
}

function _get_text_no_refresh()
{
	$text = _AM_RSSC_NO_REFRESH."<br />\n";
	return $text;
}

function _get_text_table_end()
{
	return "</table><br />\n";
}

function print_write_data( $data )
{
	if ($this->_flag_print)
	{
		echo $data;
	}
	$this->write_bin( $data );
}

//---------------------------------------------------------
// sanitize
//---------------------------------------------------------
function _make_html_url($url, $name='')
{
	$url_html = $this->_sanitize_html_url($url);

	if ($name)
	{
		$name_html = $this->_sanitize_html_text($name);
	}
	else
	{
		$name_html = $url;
	}

	$href = "<a href='$url_html' target='_blank'>$name_html</a>";
	return $href;
}

function _sanitize_html_text($text)
{
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = preg_replace("/&amp;/i", '&', $text);
	return $text;
}

function _sanitize_html_url($text)
{
	$text = preg_replace('/javascript:/si', 'java script:', $text);
	$text = preg_replace('/&amp;/i', '&', $text);
	$text = htmlspecialchars($text, ENT_QUOTES);
	return $text;
}

//---------------------------------------------------------
// time
//---------------------------------------------------------
function _get_time_now()
{
	$time = date("Y-m-d H:i:s");
	return $time;
}

function _get_time_elapse()
{
	$time = time() - $this->_time_start;
	$min = intval($time/60);
	$sec = $time - 60*$min;
	$ret =  sprintf(_AM_RSSC_MIN_SEC, $min, $sec);
	return $ret;
}

//---------------------------------------------------------
// black_object
//---------------------------------------------------------
function &_get_black_object_by_id($id)
{
	$false = false;

// exist
	$row =& $this->_black_handler->get_row_by_id($id);
	if ( !is_array($row) && !count($row) )
	{	return $false;	}

// discovery
	$ret = $this->_rss_utility->discover( $row['url'] );
	if ( !$ret )
	{	return $false;	}

// build fake object
// PHP 5.2: Assigning the return value of new by reference
	$link_obj =& $this->_link_handler->create();

	$link_obj->set('lid',   0 );	// undefine
	$link_obj->set('ltype', RSSC_C_LINK_LTYPE_SEARCH );

	$link_obj->set('title', $row['title'] );
	$link_obj->set('url',   $row['url'] );

	$link_obj->set('mode',     $this->_rss_utility->get_xml_mode() );
	$link_obj->set('rdf_url',  $this->_rss_utility->get_rdf_url() );
	$link_obj->set('rss_url',  $this->_rss_utility->get_rss_url() );
	$link_obj->set('atom_url', $this->_rss_utility->get_atom_url() );

	return $link_obj;
}

//---------------------------------------------------------
// bin file
//---------------------------------------------------------
function open_bin( $filename )
{
	return $this->_bin_file->open_bin( $filename, 'w' );
}

function close_bin()
{
	$this->_bin_file->close_bin( $this->_flag_chmod );
}

function write_bin( $data )
{
	$this->_bin_file->write_bin($data);
}

function set_flag_write( $val )
{
	$this->_bin_file->set_flag_write( $val );
}

// --- class end ---
}

// === class end ===
}

?>