<?php
// $Id: block_refresh.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2009-02-20 K.OHWADA
// rssc_block.php

// 2007-10-10 K.OHWADA
// mode_date

// 2007-06-01 K.OHWADA
// api/refresh.php

// rssc_xml_basic_handler
// rssc_word_basic_handler

// 2006-09-20 K.OHWADA
// small change

// 2006-07-10 K.OHWADA
// use happy_linux module
// support podcast

// 2006-06-04 K.OHWADA
// merge api/block.php

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- block function begin ---
if( !function_exists( 'b_rssc_show_refresh' ) ) 
{

$RSSC_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/api/view.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/api/refresh.php';


//---------------------------------------------------------
// show headline after refresh
// $options
// [0] module directory name (rssc)
//---------------------------------------------------------
function b_rssc_show_refresh( $options )
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

//	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME .'/api/view.php';
	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME .'/api/refresh.php';
	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME  .'/class/rssc_block.php';

	$headline_handler =& rssc_get_handler('headline',     $DIRNAME);
	$conf_handler     =& rssc_get_handler('config_basic', $DIRNAME);
	$conf_data        =& $conf_handler->get_conf();

	$link_limit  = $conf_data['block_headline_links_perpage'];
	$link_start  = 0;

	$headline_handler->refresh_headline($link_limit, $link_start);

	$block_class =& rssc_block::getInstance();
	return $block_class->show_headline( $DIRNAME );
}

// --- block function begin ---
}

?>