<?php
// $Id: rssc_filter_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2009-03-01 K.OHWADA
// replace_control_code()

// 2007-10-10 K.OHWADA
// rename rssc_filter to rssc_filter_handler
// judge_title()

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_filter_handler') ) 
{

// minus value for reject
	define('RSSC_CODE_FILTER_NORMAL',        0);
	define('RSSC_CODE_FILTER_REJECT_BLACK', -1);
	define('RSSC_CODE_FILTER_REJECT_WORD',  -2);
	define('RSSC_CODE_FILTER_WHITE',        11);
	define('RSSC_CODE_FILTER_PASS',         12);

//=========================================================
// class word
//=========================================================
class rssc_filter_handler
{
	var $_black_handler;
	var $_white_handler;
	var $_word_handler;

	var $_conf       = null;
	var $_black_list = array();
	var $_white_list = array();
	var $_word_list  = array();

	var $_flag_init   = false;
	var $_match_count = 0;
	var $_match_words = null;
	var $_log = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_filter_handler($dirname)
{
	$this->_config_handler =& rssc_get_handler('config_basic', $dirname);
	$this->_black_handler  =& rssc_get_handler('black_basic',  $dirname);
	$this->_white_handler  =& rssc_get_handler('white_basic',  $dirname);
	$this->_word_handler   =& rssc_get_handler('word_basic',   $dirname);
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function init_once()
{
	if ( !$this->_flag_init )
	{
		$this->_init();
		$this->_flag_init = true;
	}
}

function _init()
{
	$this->_conf =& $this->_config_handler->get_conf();
	if ( $this->_conf['white_use'] )
	{
		$this->_white_list =& 
			$this->_init_list($this->_white_handler->get_rows_act(), 'wid', 'url');
	}
	if ( $this->_conf['black_use'] )
	{
		$this->_black_list =& 
			$this->_init_list($this->_black_handler->get_rows_act(), 'bid', 'url');
	}
	if ( $this->_conf['word_use'] )
	{
		$this->_word_list  =& 
			$this->_init_list($this->_word_handler->get_rows_act(),  'sid', 'word');
	}
}

function &_init_list($list, $id_name, $target_name)
{
	$arr = array();
	foreach ($list as $row)
	{
		if ( $row['reg'] )
		{
			$pat = '/'.str_replace("/", '\/', $row[ $target_name ]).'/i';
		}
		else
		{
			$pat = '/'.preg_quote($row[ $target_name ],'/').'/i';
		}
		$temp            =& $row;
		$temp['pattern'] =  $pat;
		$arr[ $row[ $id_name ] ] = $temp;
	}
	return $arr;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function judge_title( $censor, $title )
{
	$censor = $this->replace_control_code( $censor );

	if ( empty($censor) )
	{	return true;	}

	$arr = explode('|',  $censor);

	if ( !is_array($arr) || !count($arr) )
	{	return true;	}

	foreach ( $arr as $word )
	{
		$pattern = '/'.preg_quote($word).'/';
		if ( preg_match( $pattern, $title ) )
		{
			$this->_log = 'reject title:'. $word;
			return false;
		}
	}

	return true;
}

function judge_cont( $url, $content ) 
{
	$this->_match_words = '';
	$this->_log = '';
	$this->_word_match = array();

	if ( $this->_conf['white_use'] )
	{
// pass if white
		$wid = $this->_check_white($url);
		if ( $wid )
		{
			$this->_log = 'pass white:'. $wid .' '. $url;
			return RSSC_CODE_FILTER_WHITE;
		}
	}

	$total = 0;
	if ( $this->_conf['black_use'] )
	{
		$bid = $this->_check_black($url);
		if ( $bid )
		{
// reject if black
			if ( $this->_conf['black_use'] == 1 )
			{
				$this->_log = 'reject black:'. $bid .' '. $url;
				return RSSC_CODE_FILTER_REJECT_BLACK;
			}

// learning
		$total += $this->_conf['word_level'];
		}
	}

	if ( $this->_conf['word_use'] )
	{
		$total += $this->_check_word($content);
	}

	$log = 'word:'. $total .' '. $url .' '. $this->_match_count .' '. $this->_match_words;

// pass if lower level
	if ($total < $this->_conf['word_level'])
	{
		$this->_log = 'pass '. $log;
		return RSSC_CODE_FILTER_PASS;
	}

	$this->_log = 'reject '. $log;
	return RSSC_CODE_FILTER_REJECT_WORD;
}

function get_log()
{
	return $this->_log;
}

//---------------------------------------------------------
// private
//---------------------------------------------------------
function _check_white($url)
{
	if ( count($this->_white_list) == 0 )
	{	return false;	}

	foreach ( $this->_white_list as $row )
	{
		if ( preg_match($row['pattern'], $url) )
		{
			if ( $this->_conf['white_count'] )
			{
				$this->_white_handler->countup( $row['wid'] );
			}
			return $row['wid'];
		}
	}
	return false;
}

function _check_black($url)
{
	if ( count($this->_black_list) == 0 )
	{	return false;	}

	foreach ( $this->_black_list as $row )
	{
		if ( preg_match($row['pattern'], $url) )
		{
			if ( $this->_conf['black_count'] )
			{
				$this->_black_handler->countup( $row['bid'] );
			}
			return $row['bid'];
		}
	}
	return false;
}

function _check_word( $content ) 
{
	$total = 0;
	$count = 0;
	$words = '';

	foreach($this->_word_list as $row)
	{
		if ( preg_match($row['pattern'], $content) )
		{
			$count ++;
			$total += $row['point'];
			$words .= $row['sid'] .':'. $row['point'] .':'. $row['word'] .' ';
			if ( $this->_conf['word_count'] )
			{
				$this->_word_handler->countup( $row['sid'] );
			}
		}
	}

	$this->_match_count = $count;
	$this->_match_words = $words;
	return $total;
}

function replace_control_code( $str, $replace='' )
{
	$str = preg_replace('/[\x00-\x1F]/', $replace, $str );
	$str = preg_replace('/[\x7F]/',      $replace, $str );
	return $str;
}

// --- class end ---
}

// === class end ===
}

?>