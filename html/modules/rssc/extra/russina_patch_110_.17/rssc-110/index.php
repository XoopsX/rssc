<?php
// $Id: index.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2009-02-20 K.OHWADA
// rssc_map.php
// main_search_show_site

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()
// enclosure in link table

// 2007-08-01 K.OHWADA
// xoops_module_header

// 2007-06-01 K.OHWADA
// happy_linux_time

// 2007-05-20 K.OHWADA
// XOOPS 2.0.16: module name

// 2006-11-08 K.OHWADA
// use basic_highlight

// 2006-09-01 K.OHWADA
// use main_search_title_html
// fuzzy search
// highlight keyword

// 2006-07-10 K.OHWADA
// use happy_linux_system happy_linux_pagenavi
// support podcast
// bread crumb
// description in main page

// 2006-06-04 K.OHWADA
// use header.php

//================================================================
// Rss center Module
// 2006-01-01 K.OHWADA
//================================================================

include 'header.php';

include_once RSSC_ROOT_PATH.'/class/rssc_search_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_icon.php';
include_once RSSC_ROOT_PATH.'/class/rssc_map.php';

$search_handler =& rssc_get_handler( 'search',       RSSC_DIRNAME );
$conf_handler   =& rssc_get_handler( 'config_basic', RSSC_DIRNAME );
$pagenavi       =& happy_linux_pagenavi::getInstance();
$icon_class     =& rssc_icon::getInstance();
$map_class      =& rssc_map::getInstance();

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = RSSC_DIRNAME.'_index.html';
include XOOPS_ROOT_PATH.'/header.php';

$conf =& $conf_handler->get_conf();
$limit      = $conf['main_search_perpage'];
$min        = $conf['main_search_min'];
$show_thumb = $conf['main_search_show_thumb'] ;
$show_site  = $conf['main_search_show_site'] ;
$show_icon  = $conf['main_search_show_icon'] ;
$webmap_dirname = $conf['webmap_dirname'] ;

$search_handler->setFeedLimit(  $limit );
$search_handler->setMinKeyword( $min );
$search_handler->setFeedOrder(  $conf['main_search_order'] );
$search_handler->setFutureDays( $conf['basic_future_days'] );

$search_handler->setFlagSanitize( true );
$search_handler->set_flag_ltype( true );
$search_handler->set_flag_enclosure( true );
$search_handler->set_title_html(   $conf['main_search_title_html'] );
$search_handler->set_content_html( $conf['main_search_content_html'] );
$search_handler->set_max_title(    $conf['main_search_max_title'] );
$search_handler->set_max_content(  $conf['main_search_max_content'] );
$search_handler->set_max_summary(  $conf['main_search_max_summary'] );
$search_handler->set_highlight(    $conf['basic_highlight'] );

$pagenavi->setPerpage($limit);
$pagenavi->getGetPage();

$action   = $search_handler->get_post_get_action();
$andor    = $search_handler->get_post_get_andor();
$query    = $search_handler->get_post_get_query();
$total    = $search_handler->getTotal();

$feeds     = array();
$count     = 0;
$flag_show = 0;
$start     = 0;
$and       = '';
$or        = '';
$exact     = '';
$navi      = '';
$reason_not_show  = '';
$query_urlencode  = '';
$merged_urlencode = '';

$keywords       = null;
$ignores        = null;
$candidates     = null;
$show_ignore    = false;
$show_candidate = false;
$show_title_map = false;

$feed_list = null;
$icon_list = null;

$ret = $map_class->init( $webmap_dirname );
if ( $ret ) {
	$show_title_map = true ;
}

if ( $action == 'results')
{
	if ($query)
	{
		if ( $search_handler->parseQuery() )
		{
			$and       = $search_handler->getAnd();
			$or        = $search_handler->getOr();
			$exact     = $search_handler->getExact();
			$count     = $search_handler->getSearchCount();
			$query_urlencode  = $search_handler->getQueryUrlencode();
			$merged_urlencode = $search_handler->getMergedUrlencode();

			$keywords       = $search_handler->get_query_array();
			$ignores        = $search_handler->get_ignore_array();
			$candidates     = $search_handler->get_candidate_array();
			$show_ignore    = $search_handler->get_count_ignore_array();
			$show_candidate = $search_handler->get_count_candidate_array();

			if ($count > 0) 
			{
				$flag_show = 2;

				$pagenavi->setTotal($count);
				$start =  $pagenavi->calcStart();
				$feeds =& $search_handler->getSearchFeeds($limit, $start);

				$search_url  = RSSC_URL.'/index.php?action=results';
				$search_url .= '&amp;query='.$query_urlencode;
				$search_url .= '&amp;andor='.$andor;

				$navi = $pagenavi->build($search_url);
			}
			else
			{
				$flag_show = 3;
				$reason_not_show = _SR_NOMATCH;
			}
		}
		else 
		{
			$flag_show = 3;
			$reason_not_show = sprintf(_SR_KEYTOOSHORT, $min);
		}

	}
	else
	{
		$flag_show = 2;
		$reason_not_show = _SR_PLZENTER;
		$and = "selected='selected'";
	}
}
else
{
	$flag_show = 1;
	$and = "selected='selected'";

	$pagenavi->setTotal($total);
	$start =  $pagenavi->calcStart();
	$feeds =& $search_handler->getLatest($limit, $start);

	$search_url = RSSC_URL.'/index.php';
	$navi = $pagenavi->build($search_url);
}

// assign template
$query_html = htmlspecialchars($query);

if ($count)
{
	$found = sprintf(_SR_FOUND, $count);
}
else
{
	$found = '';
}

if ( (($flag_show == 1)||($flag_show == 2)) && $show_icon ) {
	$icon_list = $icon_class->build_template_icon_list( RSSC_DIRNAME );
}

if ( is_array($feeds) && count($feeds) ) {
	$param = array(
		'feeds'      => $feeds ,
		'show_thumb' => $show_thumb ,
		'show_icon'  => $show_icon ,
		'show_site'  => $show_site ,
		'keywords'   => $keywords ,
	);
	$feed_list = $search_handler->fetch_tpl_feed_list( $param );
}

$xoopsTpl->assign( $search_handler->get_tpl_common_param() );

// RDF/RSS/ATOM auto discovery
$dir_rssc = 'modules/'.RSSC_DIRNAME;
$xoopsTpl->assign('xoops_rdf',  $dir_rssc.'/rdf.php' );
$xoopsTpl->assign('xoops_rss',  $dir_rssc.'/rss.php' );
$xoopsTpl->assign('xoops_atom', $dir_rssc.'/atom.php' );

$xoopsTpl->assign('index_desc', $conf['index_desc'] );
$xoopsTpl->assign('icon_list',  $icon_list );
$xoopsTpl->assign('show_title_map', $show_title_map );

$xoopsTpl->assign('lang_search',   _SR_SEARCH);
$xoopsTpl->assign('lang_all',      _SR_ALL);
$xoopsTpl->assign('lang_any',      _SR_ANY);
$xoopsTpl->assign('lang_exact',    _SR_EXACT);
$xoopsTpl->assign('lang_nomatch',  _SR_NOMATCH);
$xoopsTpl->assign('lang_result',   _SR_SEARCHRESULTS);
$xoopsTpl->assign('lang_showall',  _SR_SHOWALLR);
$xoopsTpl->assign('lang_prev',     _SR_PREVIOUS);
$xoopsTpl->assign('lang_next',     _SR_NEXT);
$xoopsTpl->assign('lang_keyword',  _SR_KEYWORDS.':');
$xoopsTpl->assign('lang_total',   sprintf(_RSSC_THEREARE,   $total) );
/* CDS Patch. RSS Center. 1.02. 6. BOF */
$xoopsTpl->assign('lang_total_count', $total);
/* CDS Patch. RSS Center. 1.02. 6. EOF */
$xoopsTpl->assign('lang_ignore',  sprintf(_SR_IGNOREDWORDS, $min) );
$xoopsTpl->assign('lang_candidate', _HAPPY_LINUX_SEARCH_CANDICATE );

$xoopsTpl->assign('rssc_and',     $and);
$xoopsTpl->assign('rssc_or',      $or);
$xoopsTpl->assign('rssc_exact',   $exact);
$xoopsTpl->assign('rssc_query',   $query_html);
$xoopsTpl->assign('rssc_andor',   $andor);
$xoopsTpl->assign('rssc_show',    $flag_show);
$xoopsTpl->assign('rssc_found',   $found);
/* CDS Patch. RSS Center. 1.02. 6. BOF */
$xoopsTpl->assign('rssc_found_count', $count);
/* CDS Patch. RSS Center. 1.02. 6. EOF */
$xoopsTpl->assign('rssc_navi',    $navi);
$xoopsTpl->assign('rssc_reason',  $reason_not_show);

$xoopsTpl->assign('rssc_keywords',         $keywords );
$xoopsTpl->assign('rssc_ignores',          $ignores );
$xoopsTpl->assign('rssc_candidates',       $candidates );
$xoopsTpl->assign('rssc_show_ignore',      $show_ignore );
$xoopsTpl->assign('rssc_show_candidate',   $show_candidate );
$xoopsTpl->assign('rssc_query_urlencode',  $query_urlencode);
$xoopsTpl->assign('rssc_merged_urlencode', $merged_urlencode);

$xoopsTpl->assign('feed_limit', $limit);
$xoopsTpl->assign('feed_start', $start);
$xoopsTpl->assign('feed_list',  $feed_list);

$xoopsTpl->assign('happy_linux_url', get_happy_linux_url() );
$xoopsTpl->assign('execution_time',  happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',    happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---


?>