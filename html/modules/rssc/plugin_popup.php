<?php
// $Id: plugin_popup.php,v 1.1 2011/12/29 14:37:03 ohwada Exp $

//================================================================
// RSS Center Module
// 2008-01-20 K.OHWADA
//================================================================

include "header.php";

//=========================================================
// class rssc_plugin_list
//=========================================================
class rssc_plugin_list
{
	var $_DIRNAME;

	var $_system;
	var $_plugin;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_plugin_list( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->_system =& happy_linux_system::getInstance();
	$this->_plugin =& rssc_plugin::getInstance( $dirname );
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_plugin_list( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function build_list()
{
	$this->_plugin->init_once();

	$text  = $this->_build_title();
	$text .= $this->_plugin->build_table();
	$text .= $this->_build_close();

	return $text;
}

function is_module_admin()
{
	return $this->_system->is_module_admin();
}

//---------------------------------------------------------
// private
//---------------------------------------------------------
function _build_title()
{
	$text = '<h3 align="center">'. _RSSC_PLUGIN_LIST ."</h3>";
	return $text;
}

function _build_close()
{
	$text  = '<div style="text-align:center;">';
	$text .= '<input value="'. _CLOSE .'" type="button" onclick="javascript:window.close();" />';
	$text .= '</div>'."\n";
	return $text;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$rssc_plugin_list =& rssc_plugin_list::getInstance( RSSC_DIRNAME );

xoops_header(false);
echo "</head><body>";

if ( !$rssc_plugin_list->is_module_admin() )
{
	xoops_error( "you have no permission" );
	xoops_footer();
	exit();
}

echo $rssc_plugin_list->build_list();

xoops_footer();
?>