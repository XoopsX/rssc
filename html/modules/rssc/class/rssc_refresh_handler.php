<?php
// $Id: rssc_refresh_handler.php,v 1.1 2011/12/29 14:37:16 ohwada Exp $

// 2009-02-20 K.OHWADA
// logs

// 2008-02-24 K.OHWADA
// long url

// 2008-01-20 K.OHWADA
// pre_plugin
// bug: not save xml

// 2007-10-10 K.OHWADA
// _execute_plugin()
// _execute_filter()
// PHP 5.2: Non-static method

// 2007-06-10 K.OHWADA
// use xml_handler
// use rssc_filter
// use happy_linux_extract_word happy_linux_file
// add open_log()

// 2006-12-18 K.OHWADA
// BUG 4419: not detect xml encoding correctly
// use get_xml_encoding_orig()

// 2006-11-08 K.OHWADA
// add set_proxy()

// 2006-09-20 K.OHWADA
// add refresh_link_for_add_link()
// use RSSC_CODE_DB_ERROR
// use RSSC_CODE_PARSE_NOT_READ_XML

// 2006-07-18 K.OHWADA
// REQ 4146: some feed have no link

// 2006-07-10 K.OHWADA
// use happy_linux_error happy_linux_strings
// store image to channel
// change _parse_xml_by_url(), _update_link()

// 2006-06-04 K.OHWADA
// use link_basic feed_basic handler
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_refresh_handler') ) 
{

//=========================================================
// class rssc_refresh_handler
// this class is used by command line
//=========================================================
class rssc_refresh_handler extends happy_linux_error
{
// handler
	var $_config_handler;
	var $_link_handler;
	var $_xml_handler;
	var $_feed_handler;
	var $_black_handler;
	var $_word_handler;
	var $_filter_handler;

// class instance
	var $_rss_parser;
	var $_rss_utility;
	var $_plugin;
	var $_extract;
	var $_strings;
	var $_log_file;
	var $_class_dir;

	var $_conf;

// object
	var $_link_obj;
	var $_parse_obj;

// black & white table
	var $_black_list_flag = false;
	var $_white_list_flag = false;
	var $_black_list = array();
	var $_white_list = array();

// result
	var $_parsed_data = array();
	var $_items_for_store = array();
	var $_rdf_url;
	var $_rss_url;
	var $_atom_url;
	var $_xml_data;
	var $_xml_encoding;
	var $_rssurl_list;

	var $_parse_error_code = 0;
	var $_parse_result     = null;

// basic config
//	var $_sel_rss_atom = RSSC_C_SEL_ATOM;

// set parameter
	var $_xml_mode  = 0;

// temporary
	var $_plugin_converted = null;
	var $_logs = null;

// debug
	var $_flag_link_update     = true;	// update
	var $_flag_feed_update     = true;	// update
	var $_flag_xml_save        = false;
	var $_flag_force_discover  = false;
	var $_flag_force_refresh   = false;
	var $_flag_force_overwrite = false;

	var $_flag_debug_parse = false;
	var $_debug_xml_url    = '';
	var $_debug_encoding   = '';
	var $_debug_xml_mode   = '';

	var $_count_all;
	var $_count_skip;
	var $_count_reject;
	var $_count_update;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_refresh_handler( $dirname )
{
	$this->happy_linux_error();

// handler
	$this->_config_handler =& rssc_get_handler('config_basic', $dirname);
	$this->_link_handler   =& rssc_get_handler('link_basic',   $dirname);
	$this->_xml_handler    =& rssc_get_handler('xml_basic',    $dirname);
	$this->_feed_handler   =& rssc_get_handler('feed_basic',   $dirname);
	$this->_black_handler  =& rssc_get_handler('black_basic',  $dirname);
	$this->_word_handler   =& rssc_get_handler('word_basic',   $dirname);
	$this->_filter_handler =& rssc_get_handler('filter',       $dirname);

// PHP 5.2: Non-static method
	$this->_log_file  =  new rssc_log_file( $dirname );
	$this->_plugin    =  new rssc_plugin(   $dirname );

	$this->_rss_parser =& happy_linux_get_singleton( 'rss_parser' );
	$this->_extract    =& happy_linux_get_singleton( 'extract_word' );
	$this->_strings    =& happy_linux_get_singleton( 'strings' );
	$this->_class_dir  =& happy_linux_get_singleton( 'dir' );

	$this->_rss_utility =& $this->_rss_parser->_rss_utility;

	$this->_init_param();
}

//=========================================================
// public
//=========================================================

//---------------------------------------------------------
// refresh_link_for_add_link
// return code
// RSSC_CODE_PARSE_MSG:     set by this functuon
// RSSC_CODE_PARSE_FAILED:  set by _parse_xml_by_url()
// RSSC_CODE_REFRESH_ERROR: set by refresh()
// RSSC_CODE_DB_ERROR:      set by _update_link() _update_feed() etc
//---------------------------------------------------------
function refresh_link_for_add_link( $lid )
{
	$ret = $this->refresh( $lid );
	if ( !$ret )
	{
		return $this->getErrorCode();
	}
	if ( $this->_parse_result )
	{
		return RSSC_CODE_PARSE_MSG;
	}
	return 0;
}

function get_parse_error_code()
{
	return $this->_parse_error_code;
}

function get_parse_result()
{
	return $this->_parse_result;
}

//---------------------------------------------------------
// refresh one link
//---------------------------------------------------------
function refresh($lid)
{
	$this->_set_log_func_name('refresh');

	$link_obj =& $this->_link_handler->get_object_by_id($lid);
	if ( !is_object($link_obj) )
	{
		$this->_set_errors( "no link record: lid = $lid" );
		return false;
	}

	$ret = $this->refresh_by_obj($link_obj);
	if ( !$ret )
	{
		if ( $this->getErrorCode() == 0 )
		{
			$this->_set_error_code( RSSC_CODE_REFRESH_ERROR );
		}
	}

	return $ret;
}

//---------------------------------------------------------
// entry point for refresh all
//---------------------------------------------------------
function refresh_by_obj($link_obj)
{
	$this->_set_log_func_name('refresh_by_obj');

// save object
	$this->_link_obj = $link_obj;

	$lid = $link_obj->get('lid');
	$flag_expired = $link_obj->refresh_expired();

	if ( $this->_flag_force_refresh || $flag_expired )
	{
		if ( !$this->refreshXmlUrl($lid) )
		{
			return false;
		}

		if ( !$this->refreshArchive($lid) )
		{
			return false;
		}
	}

	return true;
}

//---------------------------------------------------------
// refresh 
//---------------------------------------------------------
function refreshXmlUrl($lid)
{
	$this->_set_log_func_name('refreshXmlUrl');

// get new object
	$link_obj =& $this->get_link($lid);
	if ( !is_object($link_obj) )
	{
		return false;
	}

	$link_mode = $link_obj->get('mode');
	$link_url  = $link_obj->get('url');

// RSS auto discovary
	if ( $this->_flag_force_discover || ( $link_mode == RSSC_C_MODE_AUTO ) )
	{
		if ( !$this->discoverXmlUrl($link_url) )
		{
			return false;
		}

		if ( $this->_xml_mode )
		{
			if ( !$this->updateXmlUrl($lid, $this->_xml_mode, $this->_rdf_url, $this->_rss_url, $this->_atom_url) )
			{
				$this->_set_errors( 'cannot update xmlurl' );
				return false;
			}
		}
	}

	return true;
}

function refreshArchive($lid)
{
	$this->_set_log_func_name('refreshArchive');

// get new  object, if auto discovary
	$link_obj =& $this->get_link($lid);
	if ( !is_object($link_obj) )
	{
		return false;
	}

	$link_mode     = $link_obj->get('mode');
	$link_encoding = $link_obj->get('encoding');
	$xml_url       = $link_obj->get_rssurl_by_mode();

	if ( $this->_flag_debug_parse )
	{
		$link_mode     = $this->_debug_xml_mode;
		$link_encoding = $this->_debug_encoding;
		$xml_url       = $this->_debug_xml_url;
	}

// check mode to exist rss url
	if ( ($link_mode != RSSC_C_MODE_RDF) && ($link_mode != RSSC_C_MODE_RSS) && ($link_mode != RSSC_C_MODE_ATOM) )
	{
		return true;	// not execute
	}

// get and parse XML
	if ( !$this->parseXmlByUrl($xml_url, $link_encoding, $link_mode) )
	{
		return false;
	}

	if ( empty($link_encoding) )
	{
		if ( !$this->updateLinkEncoding($lid, $this->_xml_encoding) )
		{
			$this->_set_errors( 'cannot update link encoding' );
			return false;
		}
	}

// update archive
	if ( $this->_flag_link_update )
	{
		if ( !$this->updateLink($lid, $this->_parsed_data, $this->_xml_data, time() ) )
		{
			$this->_set_errors( 'cannot update link' );
			return false;
		}
	}

	if ( $this->_flag_feed_update )
	{
		if ( !$this->updateFeeds($lid, $this->_items_for_store, $this->_xml_data, $this->_xml_encoding, time() ) )
		{
			$this->_set_errors( 'cannot update same feeds' );
			$this->_set_errors( $this->_logs );
			return false;
		}
	}

	return true;
}

function discoverXmlUrl($html_url, $sel_rss_atom='')
{
	$ret = $this->_discover_rssurl($html_url, $sel_rss_atom);
	return $ret;
}

function updateXmlUrl($lid, $rss_mode, $rdf_url, $rss_url, $atom_url)
{
	$ret = $this->_update_link_xmlurl($lid, $rss_mode, $rdf_url, $rss_url, $atom_url);
	return $ret;
}

function parseXmlByUrl($xml_url, $xml_encoding='', $xml_mode=0)
{
	$ret = $this->_parse_xml_by_url($xml_url, $xml_encoding, $xml_mode);
	return $ret;
}

function updateLinkEncoding($lid, $xml_encoding)
{
	$ret = $this->_update_link_encoding($lid, $xml_encoding);
	return $ret;
}

function updateLink($lid, $parsed_data, $xml_data, $updated='')
{
	$ret = $this->_update_link($lid, $parsed_data, $xml_data, $updated);
	return $ret;
}

function updateFeeds($lid, $items_for_store, $xml_data, $xml_encoding, $updated='')
{
	$ret = $this->_update_feeds($lid, $items_for_store, $xml_data, $xml_encoding, $updated);
	return $ret;
}

//---------------------------------------------------------
// get link
//---------------------------------------------------------
function &get_link($lid)
{
	if ( isset($this->_link_obj) && is_object($this->_link_obj) )
	{
		$link_obj = $this->_link_obj;
	}
	else
	{
		$link_obj =& $this->_link_handler->get_object_by_id($lid);

		if ( is_object($link_obj) )
		{
// save object
			$this->_link_obj =& $link_obj;
		}
		else
		{
			$this->_set_errors( "no link record: lid = $lid" );
		}

	}

	return $link_obj;
}

//---------------------------------------------------------
// get result
//---------------------------------------------------------
function &getData()
{
	return $this->_parsed_data;
}

//---------------------------------------------------------
// set and get property
// for xml_utility
//---------------------------------------------------------
function setPriorityRssAtom($value)
{
	$this->_rss_utility->set_priority($value);
}

//function setRssParser($value)
//{
//	$this->_rss_utility->set_rss_parser($value);
//}

//function setAtomParser($value)
//{
//	$this->_rss_utility->set_atom_parser($value);
//}

function set_proxy( $host, $port='8080', $user='', $pass='' )
{
	$this->_rss_utility->set_proxy( $host, $port, $user, $pass );
}

//---------------------------------------------------------
// set debug parameter
//---------------------------------------------------------
function set_link_update($value)
{
	$this->_flag_link_update = (bool)$value;
}

function set_xml_save($value)
{
	$this->_flag_xml_save = (bool)$value;
}

function set_feed_update($value)
{
	$this->_flag_feed_update = (bool)$value;
}

function set_force_discover($value)
{
	$this->_flag_force_discover = (bool)$value;
}

function set_force_refresh($value)
{
	$this->_flag_force_refresh = (bool)$value;
}

function set_force_overwrite($value)
{
	$this->_flag_force_overwrite = (bool)$value;
}

function set_debug_parse($flag, $url='', $encoding='', $mode='')
{
	$this->_flag_debug_parse = (bool)$flag;
	$this->_debug_xml_url    = $url;
	$this->_debug_encoding   = $encoding;
	$this->_debug_xml_mode   = $mode;
}

//=========================================================
// override
//=========================================================
function set_debug_print_log($value)
{
	$value = (bool)$value;
	$this->_flag_debug_print_log = $value;
	$this->_link_handler->set_debug_print_log($value);
	$this->_feed_handler->set_debug_print_log($value);
	$this->_rss_utility->set_debug_print_log($value);
}

function set_debug_print_error($value)
{
	$value = (bool)$value;
	$this->_flag_debug_print_error = $value;
	$this->_link_handler->set_debug_print_error($value);
	$this->_feed_handler->set_debug_print_error($value);
	$this->_rss_utility->set_debug_print_error($value);
}

//=========================================================
// private
//=========================================================
//---------------------------------------------------------
// config
//---------------------------------------------------------
function _init_param()
{
	$this->_conf =& $this->_config_handler->get_conf();

	$this->set_xml_save(  $this->_conf['basic_xml_save'] );

// xml utility
	$this->setPriorityRssAtom( $this->_conf['basic_rss_atom'] );
//	$this->setRssParser(  $this->_conf['basic_parser_rss'] );
//	$this->setAtomParser( $this->_conf['basic_parser_atom'] );

// proxy server
	if ( $this->_conf['proxy_use'] )
	{
		$this->set_proxy( $this->_conf['proxy_host'], $this->_conf['proxy_port'], $this->_conf['proxy_user'] , $this->_conf['proxy_pass']  );
	}

	$this->_filter_handler->init_once();

	$this->_extract->set_flag_join_prev(   $this->_conf['join_prev'] );
	$this->_extract->set_join_glue(        $this->_conf['join_glue'] );
	$this->_extract->set_extract_mode(     $this->_conf['word_auto'] - 1 );
	$this->_extract->set_min_char_length(  $this->_conf['char_length'] );
	$this->_extract->set_kakasi_path(      $this->_conf['kakasi_path'] );
	$this->_extract->set_kakasi_mode(      $this->_conf['kakasi_mode'] );

	$this->_extract->set_kakasi_dir_work( $this->_class_dir->init_dir_work() );

	$this->_plugin->init_once();

	$this->_log_file->set_flag_log_use( $this->_conf['log_use'] );

}

//---------------------------------------------------------
// discover RSS URL
//---------------------------------------------------------
function _discover_rssurl($html_url, $sel='')
{
	$this->_set_log_func_name('_discover_rssurl');

	if ( !$this->_rss_utility->discover($html_url, $sel) )
	{
		$this->_set_errors( "cannot discover xml link" );
		$this->_set_errors( $this->_rss_utility->getErrors() );
		return false;
	}

	$this->_xml_mode = $this->_rss_utility->get_xml_mode();
	$this->_rdf_url  = $this->_rss_utility->get_rdf_url();
	$this->_rss_url  = $this->_rss_utility->get_rss_url();
	$this->_atom_url = $this->_rss_utility->get_atom_url();

	return true;
}

//---------------------------------------------------------
// update XmlUrl
//---------------------------------------------------------
function _update_link_xmlurl($lid, $rss_mode, $rdf_url, $rss_url, $atom_url)
{
	$ret = $this->_link_handler->update_xml_url($lid, $rss_mode, $rdf_url, $rss_url, $atom_url);
	if ( !$ret )
	{
		$this->_set_error_code( RSSC_CODE_DB_ERROR );
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

	unset( $this->_link_obj );
	return $ret;
}

//---------------------------------------------------------
// parse XML
//---------------------------------------------------------
function _parse_xml_by_url($xml_url, $xml_encoding='', $xml_mode=0)
{
	$this->_set_log_func_name('_parse_xml_by_url');

	$parse_obj =& $this->_rss_parser->parse_by_url($xml_url, $xml_encoding);
	if ( !is_object($parse_obj) )
	{
		$this->_parse_error_code = $this->_rss_parser->getErrorCode();
		switch ($this->_parse_error_code)
		{
			case RSSC_CODE_PARSE_NOT_READ_XML_URL:
				$code = RSSC_CODE_PARSE_NOT_READ_XML_URL;
				break;

			case RSSC_CODE_PARSE_FAILED:
			case RSSC_CODE_PARSE_NOT_FIND_ENCODING:
			default:
				$code = RSSC_CODE_PARSE_FAILED;
				break;
		}

		$this->_set_error_code( $code );
		$this->_set_errors( $this->_rss_parser->getErrors() );
		return false;
	}

	$this->_parse_result = $this->_rss_parser->get_parse_result();
	$this->_xml_data     = $this->_rss_parser->get_xml_data();
	$this->_parse_obj       = $parse_obj;
	$this->_parsed_data     = $parse_obj->get_converted_data();
	$this->_items_for_store = $parse_obj->get_items();

	if ( $xml_encoding )
	{
		$this->_xml_encoding = $xml_encoding;
	}
	else
	{
// BUG 4419: not detect xml encoding correctly
		$this->_xml_encoding = $this->_rss_parser->get_xml_encoding_orig();
	}

	return true;
}

//---------------------------------------------------------
// update link encoding
//---------------------------------------------------------
function _update_link_encoding($lid, $encoding)
{
	$ret = $this->_link_handler->update_encoding($lid, $encoding);
	if ( !$ret )
	{
		$this->_set_error_code( RSSC_CODE_DB_ERROR );
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

	unset( $this->_link_obj );
	return $ret;
}

//---------------------------------------------------------
// update archive
//---------------------------------------------------------
function _update_link($lid, $parsed_data, $xml_data, $updated='' )
{
	$channel = array();

// store channel image textinput to channel field
	if ( isset($parsed_data['channel']) && is_array($parsed_data['channel']) && ( count($parsed_data['channel']) > 0 ) )
	{
		$channel['channel'] = $parsed_data['channel'];
	}
	if ( isset($parsed_data['image']) && is_array($parsed_data['image']) && ( count($parsed_data['image']) > 0 ) )
	{
		$channel['image'] = $parsed_data['image'];
	}
	if ( isset($parsed_data['textinput']) && is_array($parsed_data['textinput']) && ( count($parsed_data['textinput']) > 0 )  )
	{
		$channel['textinput'] = $parsed_data['textinput'];
	}

	$ret = $this->_link_handler->update_channel($lid, $channel, $updated);
	if ( !$ret )
	{
		$this->_set_error_code( RSSC_CODE_DB_ERROR );
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

	if ( $this->_flag_xml_save )
	{
		$ret = $this->_xml_handler->add_update_xml($lid, $xml_data);
		if ( !$ret )
		{
			$this->_set_error_code( RSSC_CODE_DB_ERROR );
			$this->_set_errors( $this->_xml_handler->getErrors() );
			return false;
		}
	}

	unset( $this->_link_obj );
	return true;
}

function _update_feeds($lid, $items_for_store, $xml_data, $xml_encoding, $updated='' )
{
	$this->_logs = array();

// get new object
	$link_obj =& $this->get_link($lid);
	if ( !is_object($link_obj) )
	{
		return false;
	}

// some rss has no feed
	if ( !is_array($items_for_store) || ( count($items_for_store) == 0 ) )
	{
		return true;
	}

	$param = array(
		'lid' => $lid,
		'uid' => $link_obj->get('uid'),
		'mid' => $link_obj->get('mid'),
		'p1'  => $link_obj->get('p1'),
		'p2'  => $link_obj->get('p2'),
		'p3'  => $link_obj->get('p3'),
	);

	$flag_err = false;

// refresh ATOM feed
	foreach( $items_for_store as $item )
	{
		$obj =& $this->_feed_handler->create();
		$obj->merge_vars( $item );
		$obj->set_raws(   $item );
		$obj->set('lid', $lid );
		$obj->set('uid', $link_obj->get('uid') );
		$obj->set('mid', $link_obj->get('mid') );
		$obj->set('p1',  $link_obj->get('p1') );
		$obj->set('p2',  $link_obj->get('p2') );
		$obj->set('p3',  $link_obj->get('p3') );

		if ( !$this->_update_single_feed( $obj->get_vars() ) )
		{
			$flag_err = true;
		}
	}

	if ( $flag_err )
	{
		return false;
	}

	return true;
}

function _update_single_feed( &$item )
{
	$this->_count_all ++;

	$temp = $item;
	$act  = 1;	// active

// some feed has no link
	if ( !$this->_check_has_link( $temp ) )
	{
		return false;
	}

	$ret1 = $this->_execute_plugin( $temp );
	if ( !$ret1 ) 
	{
		$act = 0;
		if ( !$this->_conf['feed_save'] )
		{
			return false;
		}
	}

	$temp = $ret1;

// return , if already exist
	if ( $this->_check_feed_exist( $temp ) )
	{	return true;	}

	if ( $act )
	{
		$ret2 = $this->_execute_filter( $temp );
		if ( !$ret2 ) 
		{
			$act = 0;
			if ( !$this->_conf['feed_save'] )
			{
				return false;
			}
		}
	}

	if ( $this->_conf['feed_save'] || $act )
	{
		$this->_count_update ++;
		$temp['act'] = $act;

		$ret = $this->_feed_handler->refresh( $temp );
		if ( !$ret )
		{
			$this->_set_error_code( RSSC_CODE_DB_ERROR );
			$this->_set_errors( $this->_feed_handler->getErrors() );
			return false;
		}
	}

	return true;
}

function _check_has_link( &$item )
{
	$lid   = $item['lid'];
	$link  = $item['link'];
	$title = $item['title'];

// some feed has no link
	if ( empty($link) )
	{
		$this->_set_errors( 'link is empty: lid='. $lid .' title='.$title );
		return false;
	}

	return true;
}

function _check_feed_exist( &$item )
{
	if ( $this->_flag_force_overwrite )
	{	return false;	}

	$link    = $item['link'];
	$updated = $item['updated_unix'];

// check already exist
	$count_time = $this->_feed_handler->get_count_by_link_time($link, $updated);
	if ($count_time)
	{
		$this->_count_skip ++;
		return true;
	}

	return false;
}

function _execute_plugin( &$item )
{
	$temp = $item;

	$ret1 = $this->_plugin->execute_single( $temp, $this->_conf['pre_plugin'] );
	if ( $ret1 )
	{
		$res1 = $this->_plugin->get_item();
		if ( is_array($res1) && count($res1) )
		{
			$temp = $res1;
		}
	}

	$log1 = $this->_plugin->get_logs();
	if ( is_array($log1) && count($log1) )
	{
		$this->write_logs( $logs1 );
	}

	$ret2 = $this->_plugin->execute_single( $temp, $this->_link_obj->get('plugin') );
	if ( $ret2 )
	{
		$res2 = $this->_plugin->get_item();
		if ( is_array($res2) && count($res2) )
		{
			$temp = $res2;
		}
	}

	$log2 = $this->_plugin->get_logs();
	if ( is_array($log2) && count($log2) )
	{
		$this->write_logs( $log2 );
	}

// return false, if marking
	if ( isset( $temp['reject'] ) )
	{
		return false;
	}

	return $temp;
}

function _execute_filter( &$item )
{
	$ret = true;	// active

	$site_title = '';
	$site_link  = '';
	$site_html  = '';

	$title   = $item['title'];
	$link    = $item['link'];
	$content = $item['content'];
	$updated = $item['updated_unix'];

	$link_censor = $this->_link_obj->get('censor');
	$link_ltype  = $this->_link_obj->get('ltype');

	$ret1 = $this->_filter_handler->judge_title( $link_censor, $title );
	if ( !$ret1 )
	{
		$this->_count_reject ++;
		$this->write_logs( $this->_filter_handler->get_log() );
		return false;
	}

// filter judge if link is allow
	if ( !$this->_conf['link_use'] || ( $link_ltype != RSSC_C_LINK_LTYPE_NORMAL ) )
	{
		if ( $this->_conf['html_get'] == 1 )
		{
			$site =& $this->_get_site_info_by_url( $link );
			$site_title = $site['title'];
			$site_link  = $site['link'];
			$site_html  = $site['html'];
		}

		$cont  = $title.' '.$link.' '.$content.' '.$site_title.' '.$site_link.' '.$site_html;
		$judge = $this->_filter_handler->judge_cont( $link, $cont );

		if ( $judge < 0 )
		{
			if ( $this->_conf['html_get'] == 2 )
			{
				$site =& $this->_get_site_info_by_url( $link );
				$site_title = $site['title'];
				$site_link  = $site['link'];
				$site_html  = $site['html'];
				$cont .= ' '.$site_title.' '.$site_link.' '.$site_html;
			}

			if ( $this->_conf['black_auto'] && ( $judge == RSSC_CODE_FILTER_REJECT_WORD ) )
			{
				if ( $site_title && $site_link )
				{
					$this->_black_handler->add_link( $site_title, $site_link );
				}
			}

			$ret = false;	// no active
			$this->_count_reject ++;
		}

		if ( $this->_conf['word_auto'] )
		{
			$word_arr =& $this->_extract->execute( $cont );
			$this->_word_handler->add_word_array( $word_arr );
		}

// loggin in all case
		$this->write_logs( $this->_filter_handler->get_log() );
	}

	return $ret;
}

function &_get_site_info_by_url( $url )
{
	$arr = array(
		'title' => null,
		'link'  => null,
		'html'  => null,
	);

	$parse_obj =& $this->_rss_parser->discover_and_parse_by_html_url( $url );
	if ($parse_obj)
	{
		$title = $parse_obj->get_channel_by_key('title');
		$link  = $parse_obj->get_channel_by_key('link');
		if ( $title && $link )
		{
			$arr['title'] = $title;
			$arr['link']  = $link;
		}
		elseif ( $link )
		{
			$arr['title'] = $link;
			$arr['link']  = $link;
		}
	}

	$html_text = $this->_rss_parser->get_html_text();
	if ( $html_text )
	{
		$encoding  = $this->_rss_utility->find_html_encoding($html_text, true);
		if ( $encoding )
		{
			$html_text = $this->_rss_utility->convert($html_text, _CHARSET, $encoding);
		}
		$html_text = strip_tags($html_text);
		$html_text = preg_replace("/\s+/", ' ', $html_text);
		if ( $this->_conf['html_lenghth'] == 0 )
		{
			$html_text = '';
		}
		elseif ( $this->_conf['html_lenghth'] > 0 )
		{
			$html_text = happy_linux_strcut( $html_text, 0, $this->_conf['html_lenghth'] );
		}
		$arr['html'] = $html_text;
	}

	return $arr;
}

//---------------------------------------------------------
// counter
//---------------------------------------------------------
function clear_count()
{
	$this->_count_all    = 0;
	$this->_count_skip   = 0;
	$this->_count_reject = 0;
	$this->_count_update = 0;
}

function get_count_all()
{
	return $this->_count_all;
}

function get_count_skip()
{
	return $this->_count_skip;
}

function get_count_reject()
{
	return $this->_count_reject;
}

function get_count_update()
{
	return $this->_count_update;
}

//---------------------------------------------------------
// log file
//---------------------------------------------------------
function open_log()
{
	$ret = $this->_log_file->open_log();
	if ( !$ret )
	{
		$this->_set_errors( $this->_log_file->getErrors() );
	}
}

function close_log( $flag_chmod=false )
{
	$this->_log_file->close_log( $flag_chmod );
}

function write_logs( $arr )
{
	if ( is_array($arr) )
	{
		foreach ($arr as $text)
		{
			$this->_write_log( $text );
		}
	}
	else
	{
		$this->_write_log( $arr );
	}
}

function _write_log( $data )
{
	$this->_logs[] = $data;
	$this->_log_file->write_log( $data );
}

// --- class end ---
}

// === class end ===
}

?>