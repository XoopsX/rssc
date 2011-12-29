<?php
// $Id: rssc_plugin_base.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2009-02-20 K.OHWADA
// undefined variable

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_plugin_base') ) 
{

class rssc_plugin_base
{
	var $_plural_vars = array();
	var $_single_vars = array();
	var $_param_vars  = array();
	var $_logs        = array();

	var $_DIRNAME;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_plugin_base()
{
	// dummy
}

//---------------------------------------------------------
// interface
//---------------------------------------------------------
//---------------------------------------------------------
// function: init
// return value: none
// note: reserve for future
//---------------------------------------------------------
function init()
{
	// dummy
}

//---------------------------------------------------------
// function: description
// return value:
//    strings: plugin description in English
//
//  exsample:
//	return "this is plugin description";
//---------------------------------------------------------
function description()
{
	return '';
}

//---------------------------------------------------------
// function: usage
// return value:
//    strings: plugin usage in English
//
//  exsample:
//	return "plugin_name ( param_1, param_2 )";
//---------------------------------------------------------
function usage()
{
	return '';
}

//---------------------------------------------------------
// function: convert
// return value:
//    true:  replace converted value
//    false: nothing to do
//
// exsample:
//	$content = $this->get_item_by_key( 'content' );
//	$converted = xxx;	// please write your proccess
//	$this->set_item_by_key( 'content', $converted );
//	return true;
//---------------------------------------------------------
function convert()
{
	return false;
}

//---------------------------------------------------------
// function: reject
// return value:
//    true:  reject to save database
//    false: nothing to do
//
// exsample:
//	$content = $this->get_item_by_key( 'content' );
//	$check = xxx;	// please write your proccess
//	if ( $check ) {
//		return true;
//	} else {
//		retrun false;
//	}
//---------------------------------------------------------
function reject()
{
	return false;
}

//---------------------------------------------------------
// function: execute
// input value:
//    array items
// return value:
//    array items
//---------------------------------------------------------
function execute( &$items )
{
	$arr = array();
	$this->init();

	foreach ( $items as $input )
	{
		$this->set_item_array( $input );

		$val = $input;
		list($ret1, $ret2) = $this->execute_single();
		if ( $ret2 )
		{
			$val = $input;
			$val['reject'] = true;	// marking
		}
		elseif ( $ret1 )
		{
			$val = $this->get_item_array();
		}

// undefined variable
		$arr[] = $val;

	}

	return $arr;
}

//---------------------------------------------------------
// function: execute_single
// input value: none
// return value:
//    array return_of_convert, return_of_reject
//---------------------------------------------------------
function execute_single()
{
	$ret1 = $this->convert();
	$ret2 = $this->reject();
	if ( $ret2 )
	{
		$this->set_logs( 'reject by plugin: '. $this->name() );
	}
	return array($ret1, $ret2);
}

//---------------------------------------------------------
// get name
//---------------------------------------------------------
function name()
{
	$name = get_class($this);
	$name = str_replace('rssc_plugin_', '', $class);
	return $name;
}

//---------------------------------------------------------
// set & get param
//---------------------------------------------------------
function set_param_array( &$arr )
{
	if ( is_array($arr) )
	{
		$this->_param_vars =& $arr;
	}
}

function set_param_by_num( $num, $value )
{
	$this->_param_vars[ $num ] = $value;
}

function get_param_array()
{
	return $this->_param_vars;
}

function get_param_by_num( $num, $default=false )
{
	if ( isset( $this->_param_vars[ $num ] ) )
	{
		return $this->_param_vars[ $num ];
	}
	return $default;
}

//---------------------------------------------------------
// set & get value
//---------------------------------------------------------
function clear_plural_item_array()
{
	$this->_plural_vars = array();
}

function set_plural_item_array( $arr )
{
	if ( is_array($arr) )
	{
		$this->_plural_vars =& $arr;
	}
}

function set_plural_item_by_num( $num, $value )
{
	$this->_plural_vars[ $num ] = $value;
}

function add_plural_item( $value )
{
	$this->_plural_vars[] = $value;
}

function &get_plural_item_array()
{
	return $this->_plural_vars;
}

function &get_plural_item_by_num( $num, $default=false )
{
	if ( isset( $this->_plural_vars[ $num ] ) )
	{
		return $this->_plural_vars[ $num ];
	}
	return $default;
}

//---------------------------------------------------------
// set & get value
//---------------------------------------------------------
function clear_item_array()
{
	$this->_single_vars = array();
}

function set_item_array( $arr )
{
	if ( is_array($arr) )
	{
		$this->_single_vars =& $arr;
	}
}

function set_item_by_key( $key, $value )
{
	$this->_single_vars[ $key ] = $value;
}

function &get_item_array()
{
	return $this->_single_vars;
}

function &get_item_by_key( $key, $default=false )
{
	if ( isset( $this->_single_vars[ $key ] ) )
	{
		return $this->_single_vars[ $key ];
	}
	return $default;
}

//---------------------------------------------------------
// set & get log
//---------------------------------------------------------
function clear_logs()
{
	$this->_logs = array();
}

function set_logs( $arr )
{
	if ( is_array($arr) )
	{
		foreach ($arr as $text)
		{
			$this->_logs[] = $text;
		}
	}
	else
	{
		$this->_logs[] = $arr;
	}
}

function &get_logs()
{
	return $this->_logs;
}

//---------------------------------------------------------
// set & get dirname
//---------------------------------------------------------
function set_dirname( $val )
{
	$this->_DIRNAME = $val;
}

function get_dirname()
{
	return $this->_DIRNAME;
}

function &get_handler( $name )
{
	return rssc_get_handler( $name, $this->_DIRNAME );
}

// --- class end ---
}

// === class end ===
}

?>