<?php
// $Id: plugin_list.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

//=========================================================
// RSS Center Module
// 2008-01-20 K.OHWADA
//=========================================================

include 'admin_header.php';

//=========================================================
// class admin list plugin
//=========================================================
class admin_plugin_list
{
	var $_plugin;
	var $_post;
	var $_test;
	var $_form;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_plugin_list()
{
	$this->_plugin =& rssc_plugin::getInstance( RSSC_DIRNAME );

	$this->_post  =& happy_linux_post::getInstance();
	$this->_test  =& admin_plugin_test::getInstance();
	$this->_form  =& admin_form_plugin_test::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_plugin_list();
	}
	return $instance;
}

//---------------------------------------------------------
// post
//---------------------------------------------------------
function get_op()
{
	return $this->_post->get_post_text('op');
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function show_list_form()
{
	$this->_plugin->init_once();

	echo '<h4>'. _RSSC_PLUGIN_LIST ."</h4>\n";
	echo $this->_plugin->build_table();

	echo '<h4>'. _AM_RSSC_PLUGIN_TEST ."</h4>\n";
	$data = null;
	$plugin_data = $this->_plugin->get_exsample_data();
	if ( is_array($plugin_data) )
	{
		$data = var_export( $plugin_data, true );
	}
	$this->_form->show( $data );
}

//---------------------------------------------------------
// excute
//---------------------------------------------------------
function execute()
{
	rssc_admin_print_bread( _RSSC_PLUGIN_LIST, 'plugin_list.php', _AM_RSSC_PLUGIN_TEST );
	echo "<h4>". _AM_RSSC_PLUGIN_TEST ."</h4>\n";

	$this->_form->show();
	echo "<br /><hr />\n";

	$this->_test->execute();

	echo "<hr /><br />\n";
	echo '<a href="plugin_list.php"> - '. _RSSC_PLUGIN_LIST ."</a>\n";

}

// --- class end ---
}


//=========================================================
// class admin_plugin_test
//=========================================================
class admin_plugin_test
{
	var $_plugin;
	var $_post;
	var $_form;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_plugin_test()
{
	$this->_plugin =& rssc_plugin::getInstance( RSSC_DIRNAME );
	$this->_post   =& happy_linux_post::getInstance();
	$this->_form   =& admin_form_plugin_test::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_plugin_test();
	}
	return $instance;
}

//---------------------------------------------------------
// excute
//---------------------------------------------------------
function execute()
{
	$plugins   = $this->_post->get_post_text('plugins');
	$post_data = $this->_post->get_post_text('data');

	if ( empty($plugins) )
	{
		xoops_error( 'no plugins' );
		echo "<br />\n";
		return false;
	}

	$this->_plugin->init_once();
	$this->_plugin->set_flag_print( true );
	$data = null;

	if ( $post_data )
	{
		$str  = '$data = '. $this->_add_semicolon_to_tail( $post_data );
		$ret1 = eval( $str );
		if ( $ret1 === FALSE )
		{
			xoops_error( 'cannot eval data' );
			echo "<br />\n";
			return false;
		}
	}
	else
	{
		$ret2 = $this->_plugin->get_exsample_data();
		if ( empty($ret2) )
		{
			xoops_error( 'cannot get data' );
			echo "<br />\n";
			return false;
		}
		$data = $ret2;
	}

	echo '<h4> plugins </h4>'."\n";
	echo '<pre>';
	echo happy_linux_sanitize( $plugins );
	echo '</pre>';

	echo '<h4> input </h4>'."\n";
	echo '<pre>';
	echo happy_linux_sanitize_var_export( $data );
	echo '</pre>'."\n";

	echo '<h4> execute </h4>'."\n";

	$ret = $this->_plugin->execute( $data, $plugins );
	if ( !$ret )
	{
		echo '<h4> failed </h4>'."\n";
		return true;
	}

	$ret =& $this->_plugin->get_items();

	echo '<h4> output </h4>'."\n";
	echo '<pre>';
	echo happy_linux_sanitize_var_export( $ret );
	echo '</pre>'."\n";

	return true;
}

function _add_semicolon_to_tail( $str )
{
	if ( substr( trim($str), -1, 1) != ';' ) 
	{
		$str .= ';';
	}
	return $str;
}

// --- class end ---
}


//=========================================================
// class admin_form_plugin_test
//=========================================================
class admin_form_plugin_test extends happy_linux_form_lib
{
	var $_post;

	var $_DATA_ROWS = 10;
	var $_DATA_COLS = 50; 

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_plugin_test()
{
	$this->happy_linux_form_lib();

	$this->_post =& happy_linux_post::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_plugin_test();
	}
	return $instance;
}

//---------------------------------------------------------
// show form
//---------------------------------------------------------
function show( $data=null )
{
	$plugins = $this->_post->get_post_text('plugins');

	if ( empty($data) )
	{
		$data = $this->_post->get_post_text('data');
	}

// --- form begin ---
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden( 'op', 'execute' );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _AM_RSSC_PLUGIN_TEST );

	$cap_plugins = $this->build_form_caption(_AM_RSSC_PLUGIN, _AM_RSSC_PLUGIN_DESC_2);
	$ele_plugins = $this->build_html_textarea( 'plugins', $plugins );
	echo $this->build_form_table_line( $cap_plugins, $ele_plugins );

	$cap_data = $this->build_form_caption(_AM_RSSC_PLUGIN_TESTDATA, _AM_RSSC_PLUGIN_TESTDATA_DESC);
	$ele_data = $this->build_html_textarea( 'data', $data, $this->_DATA_ROWS, $this->_DATA_COLS );
	echo $this->build_form_table_line( $cap_data, $ele_data );

	$ele_submit = $this->build_html_input_submit( 'submit', _HAPPY_LINUX_EXECUTE );
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
xoops_cp_header();

$list =& admin_plugin_list::getInstance();

$op = $list->get_op();

switch ($op)
{
	case 'execute':
		$list->execute();
		break;

	case 'form':
	default:
		rssc_admin_print_header();
		rssc_admin_print_menu();
		$list->show_list_form();
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---

?>