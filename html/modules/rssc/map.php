<?php
// $Id: map.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2012-03-01 K.OHWADA
// rssc_map::getInstance( RSSC_DIRNAME )

// 2009-05-17 K.OHWADA
// Notice [PHP]: Undefined variable: feed_list

//================================================================
// Rss center Module
// 2009-02-20 K.OHWADA
//================================================================

include 'header.php';
include_once RSSC_ROOT_PATH.'/class/rssc_view_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_map.php';

$view_handler  =& rssc_get_handler( 'view',         RSSC_DIRNAME );
$conf_handler  =& rssc_get_handler( 'config_basic', RSSC_DIRNAME );
$map_class     =& rssc_map::getInstance( RSSC_DIRNAME );
$icon_class    =& rssc_icon::getInstance();
$post          =& happy_linux_post::getInstance();
$pagenavi      =& happy_linux_pagenavi::getInstance();

$MAP_IMAGE_WIDTH  = 120;
$MAP_IMAGE_HEIGHT = 120;
$map_div_id = RSSC_DIRNAME.'_map_0';
$map_func   = RSSC_DIRNAME.'_load_map_0';

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = RSSC_DIRNAME.'_map.html';
include XOOPS_ROOT_PATH.'/header.php';

$conf =& $conf_handler->get_conf();
$feed_limit     = $conf['main_map_perpage'];
$show_thumb     = $conf['main_map_show_thumb'] ;
$show_site      = $conf['main_map_show_site'] ;
$show_icon      = $conf['main_map_show_icon'] ;
$webmap_dirname = $conf['webmap_dirname'] ;

$link_show   = 0;
$feed_show   = 0;
$lid         = 0;
$channel     = array();
$feeds       = array();
$error       = '';
$reason      = '';
$navi        = '';
$feed_total  = 0;
$show_map    = 0;
$map_js      = null;
$ele_id_map  = null;
$feed_list   = null ;
$icon_list   = null ;

$ret = $map_class->init( $webmap_dirname );
if ( $ret ) {

	$view_handler->setFeedOrder(  $conf['main_map_order'] );
	$view_handler->setFutureDays( $conf['basic_future_days'] );
	$view_handler->setFlagSanitize( true );
	$view_handler->set_flag_ltype( true );
	$view_handler->set_flag_enclosure( true );
	$view_handler->set_title_html(   $conf['main_map_title_html'] );
	$view_handler->set_content_html( $conf['main_map_content_html'] );
	$view_handler->set_max_title(    $conf['main_map_max_title'] );
	$view_handler->set_max_content(  $conf['main_map_max_content'] );
	$view_handler->set_max_summary(  $conf['main_map_max_summary'] );

	$pagenavi->setPerpage( $feed_limit );
	$pagenavi->getGetPage();

	$where = ' (( geo_lat != 0 ) OR ( geo_long != 0 )) ';

	$feed_total = $view_handler->get_feed_count_by_where( $where );

	$pagenavi->setTotal($feed_total);
	$feed_start = $pagenavi->calcStart();

	$feeds = $view_handler->get_feeds_by_where( $where, $feed_limit, $feed_start );

	if ( is_array($feeds) && count($feeds) ) {
		$feed_show = 1;
		$show_map  = 1;

		$map_class->set_map_div_id( $map_div_id ) ;
		$map_class->set_map_func(   $map_func ) ;
		$map_class->set_info_max(   $MAP_IMAGE_WIDTH ) ;
		$map_class->set_info_width( $MAP_IMAGE_HEIGHT ) ;

		$param  = $map_class->fetch_map( $feeds );
		$map_js = $param['map_js'] ;

		$param = array(
			'feeds'      => $feeds ,
			'show_thumb' => $show_thumb ,
			'show_icon'  => $show_icon ,
			'show_site'  => $show_site ,
			'keywords'   => null ,
		);
		$feed_list = $view_handler->fetch_tpl_feed_list( $param );
	}

	$url = RSSC_URL.'/map.php';
	$navi = $pagenavi->build($url);

	if ( $show_icon ) {
		$icon_list = $icon_class->build_template_icon_list( RSSC_DIRNAME );
	}

} else {
	$reason = 'NOT exist webmap module';
}

$xoopsTpl->assign('show_map',   $show_map );
$xoopsTpl->assign('map_js',     $map_js );
$xoopsTpl->assign('map_div_id', $map_div_id );

// Notice [PHP]: Undefined variable: feed_list
$xoopsTpl->assign('feed_list',   $feed_list );

$xoopsTpl->assign('icon_list',   $icon_list );

$xoopsTpl->assign( $view_handler->get_tpl_common_param() );

$xoopsTpl->assign('lang_total',   sprintf(_RSSC_THEREARE, $feed_total) );

$xoopsTpl->assign('link_show',   $link_show);
$xoopsTpl->assign('feed_show',   $feed_show);
$xoopsTpl->assign('rssc_error',  $error);
$xoopsTpl->assign('rssc_reason', $reason);
$xoopsTpl->assign('rssc_navi',   $navi);

$xoopsTpl->assign('execution_time',  happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',    happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---

?>