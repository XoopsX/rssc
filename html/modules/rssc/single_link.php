<?php
// $Id: single_link.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// $conf['basic_url']

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()
// enclosure in link table

// 2007-08-01 K.OHWADA
// xoops_module_header

// 2007-06-10 K.OHWADA
// page navi
// edit button

// 2007-05-20 K.OHWADA
// XOOPS 2.0.16: module name

// 2006-11-08 K.OHWADA
// use basic_highlight
// use main_link_feeds_perlink

// 2006-09-01 K.OHWADA
// use main_search_title_html
// page title
// highlight_keyword

// 2006-07-10 K.OHWADA
// use happy_linux_post happy_linux_system
// support podcast
// bread crumb

// 2006-06-04 K.OHWADA
// this is new file

//================================================================
// Rss center Module
// 2006-06-04 K.OHWADA
//================================================================

include 'header.php';

include_once RSSC_ROOT_PATH."/class/rssc_view_handler.php";

$view_handler =& rssc_get_handler( 'view',         RSSC_DIRNAME );
$conf_handler =& rssc_get_handler( 'config_basic', RSSC_DIRNAME );
$post         =& happy_linux_post::getInstance();
$pagenavi     =& happy_linux_pagenavi::getInstance();

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = RSSC_DIRNAME.'_single_link.html';
include XOOPS_ROOT_PATH.'/header.php';

$conf  =& $conf_handler->get_conf();
$limit =  $conf['main_link_feeds_perlink'];

$lid           = $post->get_get_int('lid');
$mode          = $post->get_get_int('mode');
$keyword_array = $post->get_get_keyword_array();
$urlencode     = $post->get_urlencode_keywords();

$view_handler->setFlagSanitize( true );
$view_handler->set_flag_ltype( true );
$view_handler->set_flag_enclosure( true );
$view_handler->set_title_html(   $conf['main_link_title_html'] );
$view_handler->set_max_title(    $conf['main_link_max_title'] );
$view_handler->set_content_html( $conf['main_link_content_html'] );
$view_handler->set_max_content(  $conf['main_link_max_content'] );
$view_handler->set_max_summary(  $conf['main_link_max_summary'] );
$view_handler->set_highlight(    $conf['basic_highlight'] );
$view_handler->set_keyword_array( $keyword_array );

$pagenavi->setPerpage($limit);
$pagenavi->getGetPage();

$feed  = array();
$link  = array();
$error = '';
$navi  = '';
$total = 0;
$link_show = 0;
$feed_show = 0;

if ( $view_handler->exists_link($lid) )
{
	$link  =& $view_handler->get_link_by_lid($lid);

	if ( is_array($link) && (count($link) > 0) )
	{
		$link_show = 1;
		$xoopsTpl->assign('link', $link);
	}

	$total = $view_handler->get_feed_count_by_lid($lid);

	$pagenavi->setTotal($total);
	$start =  $pagenavi->calcStart();

	$feeds =& $view_handler->get_feeds_by_lid($lid, $limit, $start);

	if ( is_array($feeds) && (count($feeds) > 0) )
	{
		$feed_show = 1;

		foreach ($feeds as $feed) 
		{
			$xoopsTpl->append('feeds', $feed);
		}
	}

	$url = RSSC_URL.'/single_link.php?lid='.$lid.'&keywords='.$urlencode;
	$navi = $pagenavi->build($url);
}

$xoopsTpl->assign( $view_handler->get_tpl_common_param() );

$xoopsTpl->assign('lang_total',   sprintf(_RSSC_THEREARE,   $total) );

$xoopsTpl->assign('link_show',   $link_show);
$xoopsTpl->assign('feed_show',   $feed_show);
$xoopsTpl->assign('rssc_error',  $error);
$xoopsTpl->assign('rssc_navi',   $navi);
$xoopsTpl->assign('link',  $link);
$xoopsTpl->assign('feed',  $feed);
$xoopsTpl->assign('mode',  $mode);
$xoopsTpl->assign('rssc_keywords',   $urlencode);
$xoopsTpl->assign('conf_url', $conf['basic_url']);

// page title
$module_name_s = $view_handler->get_module_name('s');
$xoopsTpl->assign('xoops_pagetitle', $module_name_s.' - '.$link['title_s']);

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---

?>