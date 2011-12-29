<?php
// $Id: oninstall.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

// 2008-01-20 K.OHWADA
// BUG: Fatal error, if not exist happy_linux

//=========================================================
// RSS Center Module
// 2007-11-11 K.OHWADA
//=========================================================

$RSSC_DIRNAME = basename( dirname( __FILE__ ) );

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

// === xoops_module_install_rssc ===
// BUG: Fatal error, if not exist happy_linux
// no action here, if not exist
// same process in admin/index.php
if ( file_exists( XOOPS_ROOT_PATH.'/modules/happy_linux/api/module_install.php' ) ) 
{

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/module_install.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/rss_constant.php';

include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_rss_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_config_define.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_install.php';

// admin.php
if (file_exists( XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/admin.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/admin.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/english/admin.php';
}

// --- eval begin ---
eval( '

function xoops_module_install_'. $RSSC_DIRNAME .'( $module )
{
	return rssc_install_base( "'. $RSSC_DIRNAME .'" ,  $module );
}

function xoops_module_update_'. $RSSC_DIRNAME .'( $module, $prev_version )
{
	return rssc_update_base( "'. $RSSC_DIRNAME .'" ,  $module, $prev_version );
}

' );
// --- eval end ---

}
// === xoops_module_install_rssc end ===

// === rssc_oninstall_base ===
if( ! function_exists( 'rssc_install_base' ) ) 
{

function rssc_install_base( $DIRNAME, $module )
{
// prepare for message
	global $msgs, $ret ; // TODO :-D

// for Cube 2.1
	if( defined( 'XOOPS_CUBE_LEGACY' ) ) 
	{
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( 'Legacy.Admin.Event.ModuleInstall.' . ucfirst($DIRNAME) . '.Success' , 'rssc_message_append_oninstall' ) ;
		$ret = array() ;
	}
	else 
	{
		if( ! is_array( $ret ) ) $ret = array() ;
	}

// main
	$rssc =& rssc_install::getInstance( $DIRNAME );
	$code = $rssc->install();
	$ret[] = $rssc->get_message();

	return $code;
}

function rssc_update_base( $DIRNAME, $module, $prev_version )
{
// prepare for message
	global $msgs ; // TODO :-D

// for Cube 2.1
	if( defined( 'XOOPS_CUBE_LEGACY' ) ) 
	{
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( 'Legacy.Admin.Event.ModuleUpdate.' . ucfirst($DIRNAME) . '.Success', 'rssc_message_append_onupdate' ) ;
		$msgs = array() ;
	}
	else 
	{
		if( ! is_array( $msgs ) ) $msgs = array() ;
	}

// main
	$rssc =& rssc_install::getInstance( $DIRNAME );
	$code = $rssc->update();
	$msgs[] = $rssc->get_message();

	return $code;
}

// for Cube 2.1
function rssc_message_append_oninstall( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['ret'] ) ) {
		foreach( $GLOBALS['ret'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

// for Cube 2.1
function rssc_message_append_onupdate( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['msgs'] ) ) {
		foreach( $GLOBALS['msgs'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

// === rssc_oninstall_base end ===
}

?>