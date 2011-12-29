<?php
// $Id: rssc_view_param.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2009-02-20 K.OHWADA
// gicon_id 

// 2008-01-20 K.OHWADA
// _execute_plugin()

// 2007-10-10 K.OHWADA
// set_is_japanese()
// enclosure in link table

// 2007-08-01 K.OHWADA
// get_module_header()

// 2007-06-01 K.OHWADA
// happy_linux_rss_viewer
// add create() view_format_sanitize_feed_rows()
// use get_cache_ltype_by_item()

// 2006-09-01 K.OHWADA
// add view_format_sanitize_single_feed_obj() : remove view_format_sanitize_feeds()
// add get_get_keywords()
// highlight_keyword

// 2006-07-22 K.OHWADA
// page title

// 2006-07-10 K.OHWADA
// use happy_linux_error happy_linux_post etc

// 2006-06-04 K.OHWADA
// add view_format_sanitize() etc

//=========================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_view_param') ) 
{

//=========================================================
// class rssc_view_param
//=========================================================
class rssc_view_param extends happy_linux_rss_viewer
{
	var $_DIRNAME;
	var $_MODULE_URL;
	var $_MODULE_DIR;

// handler
	var $_config_handler;
	var $_link_handler;
	var $_feed_handler;
	var $_plugin;
	var $_system;
	var $_image_class;

	var $_conf;

// input parameter
	var $_feed_order = RSSC_C_ORDER_TEXT_UPDATED;
	var $_feed_start =  0;
	var $_feed_limit = 10;
	var $_flag_sanitize  = false;
	var $_flag_ltype     = false;
	var $_flag_enclosure = false;

	var $_flag_icon  = true ;
	var $_flag_gicon = true ;

	var $_max_width  = 120;
	var $_max_height = 120;
	var $_flag_zero  = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_view_param( $dirname )
{
	$this->_DIRNAME    = $dirname;
	$this->_MODULE_URL = XOOPS_URL       .'/modules/'. $dirname ;
	$this->_MODULE_DIR = XOOPS_ROOT_PATH .'/modules/'. $dirname ;

	$this->happy_linux_rss_viewer();

// handler
	$this->_config_handler =& rssc_get_handler('config_basic', $dirname);
	$this->_link_handler   =& rssc_get_handler('link_basic',   $dirname);
	$this->_feed_handler   =& rssc_get_handler('feed_basic',   $dirname);
	$this->_plugin         =& rssc_plugin::getInstance( $dirname );
	$this->_system         =& happy_linux_system::getInstance();
	$this->_image_class    =& happy_linux_image_size::getInstance();

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_view_param( $dirname );
	}
	return $instance;
}

function _init_view_param()
{
	$this->_conf =& $this->_config_handler->get_conf();

	$this->set_mode_content_script(     $this->_conf['html_script'] );
	$this->set_mode_content_style(      $this->_conf['html_style'] );
	$this->set_mode_content_link(       $this->_conf['html_link'] );
	$this->set_mode_content_comment(    $this->_conf['html_comment'] );
	$this->set_mode_content_cdata(      $this->_conf['html_cdata'] );
	$this->set_mode_content_onmouse(    $this->_conf['html_attr_onmouse'] );
	$this->set_mode_content_attr_style( $this->_conf['html_attr_style'] );
	$this->set_mode_content_javascript( $this->_conf['html_javascript'] );
	$this->set_flag_content_tags(       $this->_conf['html_flag_other_tags'] );
	$this->set_content_tags(            $this->_conf['html_other_tags'] );
	$this->set_is_japanese(             $this->_system->is_japanese() );

	$this->_plugin->init_once();

}

//---------------------------------------------------------
// view sanitize
//---------------------------------------------------------
function &view_format_sanitize_feed_objs( &$feed_objs, $flag_sanitize=true )
{
	$feeds = array();
	if ( is_array($feed_objs) && ( count($feed_objs) > 0 ) )
	{
		foreach ($feed_objs as $obj)
		{
			$feeds[] =& $this->view_format_sanitize_single_feed_obj( $obj, $flag_sanitize );
		}
	}
	return $feeds;
}

function &view_format_sanitize_single_feed_obj( &$feed_obj, $flag_sanitize=true )
{
	$feed = array();
	if ( is_object($feed_obj) )
	{
		$feed =& $this->view_format_sanitize_single_feed( $feed_obj->getVarAll(), $flag_sanitize );
	}
	return $feed;
}

function &view_format_sanitize_feed_rows( &$feed_rows, $flag_sanitize=true )
{
	$feeds = array();
	if ( is_array($feed_rows) && ( count($feed_rows) > 0 ) )
	{
		foreach ($feed_rows as $row)
		{
			$feeds[] = $this->view_format_sanitize_single_feed_row( $row, $flag_sanitize );
		}
	}
	return $feeds;
}

function &view_format_sanitize_single_feed_row( &$feed_row, $flag_sanitize=true )
{
	$feed = array();
	if ( is_array($feed_row) )
	{
		$feed = $this->view_format_sanitize_single_feed( $feed_row, $flag_sanitize );
	}
	return $feed;
}

function &view_format_sanitize_single_feed( &$orig, $flag_sanitize=true )
{
	$item = $this->_execute_plugin( $orig );
	$feed = $this->view_format_sanitize_single_item( $item, $flag_sanitize );
	$feed['fulltext'] = $item['content'];

	list( $thumb_url, $thumb_width, $thumb_height ) =
		$this->view_format_thumb( $feed );

	$feed['thumb_url_s']  = happy_linux_sanitize_url( $thumb_url ) ;
	$feed['thumb_width']  = $thumb_width ;
	$feed['thumb_height'] = $thumb_height;

	if ( isset($item['lid']) ) {
	 	$link_row = $this->_link_handler->get_cache_row( $item['lid'] );
		if ( is_array($link_row) ) {
			if ( $this->_flag_ltype ) {
				$feed['ltype'] = $link_row['ltype'] ;
			}
			if ( $this->_flag_enclosure ) {
				$feed['enclosure_mode'] = $link_row['enclosure'];
			}
			if ( $this->_flag_icon ) {
				$feed['icon'] = $link_row['icon'];
			}
			if ( $this->_flag_gicon ) {
				$feed['gicon_id'] = $link_row['gicon_id'];
			}
		}
	}
	return $feed;
}

function view_format_thumb( $item )
{
	$thumb_url    = null ;
	$thumb_width  = 0 ;
	$thumb_height = 0;

	if ( $item['media_thumbnail_url'] ) {
		$thumb_url = $item['media_thumbnail_url'] ;
		list( $thumb_width, $thumb_height ) = 
			$this->adjust_size(
				$item['media_thumbnail_width'], $item['media_thumbnail_height'] ); 

	} elseif ( $item['media_content_url'] && ($item['media_content_medium'] == 'image') ) {
		$thumb_url = $item['media_content_url'] ;
		list( $thumb_width, $thumb_height ) = 
			$this->adjust_size( 
				$item['media_content_width'], $item['media_content_height'] ); 
	}

	return array( $thumb_url, $thumb_width, $thumb_height ) ;
}

function adjust_size( $width, $height )
{
	return $this->_image_class->adjust_size(
		$width, $height, $this->_max_width, $this->_max_height, $this->_flag_zero );
}

function _execute_plugin( $item )
{
	$temp = $item;

	if ( isset($item['lid']) )
	{
	 	$plugin_line = $this->_link_handler->get_cache_post_plugin_by_lid( $item['lid'] );

		$ret1 = $this->_plugin->execute_single( $temp, $plugin_line );
		if ( $ret1 )
		{
			$res1 = $this->_plugin->get_item();
			if ( is_array($res1) && count($res1) )
			{
				$temp = $res1;
			}
		}
	}

	$ret2 = $this->_plugin->execute_single( $temp, $this->_conf['post_plugin'] );
	if ( $ret2 )
	{
		$res2 = $this->_plugin->get_item();
		if ( is_array($res2) && count($res2) )
		{
			$temp = $res2;
		}
	}

	return $temp;
}

//---------------------------------------------------------
// set and get property
//---------------------------------------------------------
function setFeedOrder($value)
{
	switch ( intval($value) )
	{
		case RSSC_C_ORDER_INT_PUBLISHED:
			$order = RSSC_C_ORDER_TEXT_PUBLISHED;
			break;

		case RSSC_C_ORDER_INT_UPDATED:
		default:
			$order = RSSC_C_ORDER_TEXT_UPDATED;
			break;
	}

	$this->_feed_order = $order;
}

function setFeedStart($value)
{
	$this->_feed_start = intval($value);
}

function setFeedLimit($value)
{
	$this->_feed_limit = intval($value);
}

function setFlagSanitize($value)
{
	$this->_flag_sanitize = (bool)$value;
}

function set_flag_ltype($value)
{
	$this->_flag_ltype = (bool)$value;
}

function set_flag_enclosure($value)
{
	$this->_flag_enclosure = (bool)$value;
}

function set_flag_gicon($value)
{
	$this->_flag_gicon = (bool)$value;
}

function setFutureDays($value)
{
	$this->_feed_handler->set_future($value);
}

//---------------------------------------------------------
// template common
//---------------------------------------------------------
function &get_tpl_common_param()
{
	$arr = array(
		'lang_edit'             => _EDIT,
		'lang_home'             => _HAPPY_LINUX_HOME,
		'lang_main'             => _HAPPY_LINUX_MAIN,
		'lang_goto_admin'       => _HAPPY_LINUX_GOTO_ADMIN,
		'lang_no_record'        => _HAPPY_LINUX_NO_RECORD,
		'lang_headline'         => _RSSC_HEADLINE,
		'lang_map'              => _RSSC_MAP,
		'lang_latest'           => _RSSC_LATEST_FEEDS,
		'lang_lastupdate'       => _RSSC_LASTUPDATE,
		'lang_no_feed'          => _RSSC_NO_FEED,
		'lang_single_link'      => _RSSC_SINGLE_LINK,
		'lang_single_link_utf8' => _RSSC_SINGLE_LINK_UTF8,
		'lang_podcast'          => _RSSC_PODCAST,
		'unit_kb'               =>  RSSC_UNIT_KB,
		'dirname'               => $this->_DIRNAME,
		'module_name'           => $this->get_module_name('s'),
		'is_module_admin'       => $this->_system->is_module_admin(),
		'xoops_module_header'   => $this->_get_module_header(),
	);
	return $arr;
}

function get_module_name( $format='s' )
{
	return $this->_system->get_module_name( $format );
}

// some block use xoops_module_header
function _get_module_header()
{
	$url   = $this->_MODULE_URL .'/rssc.css';
	$text  = '<link href="'. $url . '" rel="stylesheet" type="text/css" media="all" />'."\n";
	$text .= $this->_system->get_template_vars('xoops_module_header')."\n";
	return $text;
}

function fetch_tpl_feed_list( $param )
{
	$feeds      = $param['feeds'] ;
	$show_thumb = isset($param['show_thumb']) ? (bool)$param['show_thumb'] : false;
	$show_icon  = isset($param['show_icon'])  ? (bool)$param['show_icon']  : false;
	$show_site  = isset($param['show_site'])  ? (bool)$param['show_site']  : false;
	$keywords   = isset($param['keywords'])   ? $param['keywords'] : null ;

	$template   = $this->_MODULE_DIR. '/templates/parts/rssc_feed_list.html' ;

	$tpl = new XoopsTpl();
	$tpl->assign( $this->get_tpl_common_param() );
	$tpl->assign('xoops_url',  XOOPS_URL );
	$tpl->assign('show_thumb', $show_thumb );
	$tpl->assign('show_icon',  $show_icon );
	$tpl->assign('show_site',  $show_site );
	$tpl->assign('keywords',   $keywords );
	$tpl->assign('max_width',  $this->_max_width);

	foreach ($feeds as $feed) {
		$tpl->append('feeds', $feed);
	}

	return $tpl->fetch( $template );
}

// --- class end ---
}

// === class end ===
}

?>