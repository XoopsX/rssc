<?php
// $Id: block_latest.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2009-02-20 K.OHWADA
// rssc_block.php

// 2007-10-10 K.OHWADA
// enclosure in link table
// BUG: display not-show feed

// 2007-08-01 K.OHWADA
// sanitize.php

// 2007-01-19 K.OHWADA
// b_rssc_shoten_text -> b_rssc_shorten_text
// clean up space

// 2006-12-02 K.OHWADA
// assign updated_unix and all

// 2006-10-26 K.OHWADA
// assign fid

// 2006-09-20 K.OHWADA
// show blog

// 2006-07-08 K.OHWADA
// corresponding to podcast
// add enclosure

// 2006-06-04 K.OHWADA
// assign site_title site_url

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/language.php';

// --- block function begin ---
if( !function_exists( 'b_rssc_show_latest' ) ) 
{

//---------------------------------------------------------
// show latest feeds
// $options
// [0] module directory name (rssc)
//---------------------------------------------------------
function b_rssc_show_latest( $options )
{
	$DIRNAME  = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME  .'/class/rssc_block.php';
	$block_class =& rssc_block::getInstance();
	return $block_class->show_latest( $DIRNAME );
}

//---------------------------------------------------------
// show latest feeds on google map
// $options
// [0] module directory name (rssc)
//---------------------------------------------------------
function b_rssc_show_map( $options )
{
	$DIRNAME  = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME  .'/class/rssc_block.php';
	$block_class =& rssc_block::getInstance();
	return $block_class->show_map( $DIRNAME );
}

//---------------------------------------------------------
// show headline
// $options
// [0] module directory name (rssc)
//---------------------------------------------------------
function b_rssc_show_headline( $options )
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME  .'/class/rssc_block.php';
	$block_class =& rssc_block::getInstance();
	return $block_class->show_headline( $DIRNAME );
}

//---------------------------------------------------------
// show blog
// $options
// [0] module directory name (rssc)
//---------------------------------------------------------
function b_rssc_show_blog( $options )
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME  .'/class/rssc_block.php';
	$block_class =& rssc_block::getInstance();
	return $block_class->show_blog( $DIRNAME );
}

// --- block function begin end ---
}

?>