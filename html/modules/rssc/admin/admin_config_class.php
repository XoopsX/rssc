<?php
// $Id: admin_config_class.php,v 1.3 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// remove print_check_webmap3_version()

// 2012-03-01 K.OHWADA
// build_conf_extra_webmpa3_dirname_list

// 2009-02-20 K.OHWADA
// main_map_xxx

// 2008-11-22 K.OHWADA
// BUG: typo

// 2007-11-11 K.OHWADA
// link table: enclosure
// coufig: block_latest_mode_date
// rss_cache_clear()
// rssc_install

// 2007-06-01 K.OHWADA
// create_table: xml word

// 2006-11-08 K.OHWADA
// proxy server
// use build_conf_table_xxx

// 2006-09-20 K.OHWADA
// use XoopsGTicket
// add check_version_config_040()
// add main_search_title_html
// use build_lib_box_button_style()
// show blog

// 2006-07-10 K.OHWADA
// use happy_linux_config_form happy_linux_config_store_handler etc
// change make_xxx to build_xxx
// add check_version() for v0.30

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME

// 2006-04-17 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// this file contain 2 class
//   admin_config_form 
//   admin_config_store
// 2006-01-01 K.OHWADA
//=========================================================

class admin_config_form extends happy_linux_config_form
{
	var $_DIRNAME;

// local
	var $_line_count = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_config_form()
{
	$this->happy_linux_config_form();

	$define =& rssc_config_define::getInstance();
	$this->set_config_handler('config', RSSC_DIRNAME, 'rssc');
	$this->set_config_define( $define );

	$this->_DIRNAME = RSSC_DIRNAME;

// init
	$this->load();

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_config_form();
	}
	return $instance;
}

//=========================================================
// main function
//=========================================================
function init_form()
{
	// dummy
}

function show_main()
{
	echo $this->build_conf_table_begin('rssc_config_main');
	echo $this->build_conf_table_head(   5, _RSSC_SEARCH,               _RSSC_MAP,                _RSSC_HEADLINE,                _RSSC_SINGLE_LINK,        _RSSC_SINGLE );
	echo $this->build_conf_table_textbox(5, 'main_search_min');
	echo $this->build_conf_table_textbox(5, '',                         '',                       'main_headline_links_perpage');
	echo $this->build_conf_table_textbox(5, 'main_search_perpage',      'main_map_perpage',       'main_headline_feeds_perpage', 'main_link_feeds_perlink');
	echo $this->build_conf_table_yesno(  5, 'main_search_title_html',   'main_map_title_html',    'main_headline_title_html',    'main_link_title_html',   'main_single_title_html');
	echo $this->build_conf_table_yesno(  5, 'main_search_content_html', 'main_map_content_html',  'main_headline_content_html',  'main_link_content_html', 'main_single_content_html');
	echo $this->build_conf_table_textbox(5, 'main_search_max_title',    'main_map_max_title',     'main_headline_max_title',     'main_link_max_title',    'main_single_max_title');
	echo $this->build_conf_table_textbox(5, 'main_search_max_content',  'main_map_max_content',   'main_headline_max_content',   'main_link_max_content',  'main_single_max_content');
	echo $this->build_conf_table_textbox(5, 'main_search_max_summary',  'main_map_max_summary',   'main_headline_max_summary',   'main_link_max_summary',  'main_single_max_summary');
	echo $this->build_conf_table_select( 5, 'main_search_order',        'main_map_order',         'main_headline_order',         'main_link_order');
	echo $this->build_conf_table_yesno(  5, 'main_search_show_thumb',   'main_map_show_thumb',    'main_headline_show_thumb'  );
	echo $this->build_conf_table_yesno(  5, 'main_search_show_site',    'main_map_show_site'  );
	echo $this->build_conf_table_yesno(  5, 'main_search_show_icon',    'main_map_show_icon'  );
	echo $this->build_conf_table_textbox(5, '',                         'main_map_info_max' );
	echo $this->build_conf_table_textbox(5, '',                         'main_map_info_width' );
	echo $this->build_conf_table_end(    5 );
}

function show_block()
{
	echo $this->build_conf_table_begin('rssc_config_block');
	echo $this->build_conf_table_head(   4, _MI_RSSC_BNAME_LATEST,      _MI_RSSC_BNAME_BLOG,      _MI_RSSC_BNAME_HEADLINE,        _MI_RSSC_BNAME_MAP );
	echo $this->build_conf_table_textbox(4, '',                         'block_blog_lid');
	echo $this->build_conf_table_textbox(4, '',                         '',                      'block_headline_links_perpage');
	echo $this->build_conf_table_textbox(4, 'block_latest_perpage',     'block_blog_perpage',     'block_headline_feeds_perlink', 'block_map_perpage'  );
	echo $this->build_conf_table_textbox(4, 'block_latest_max_title',   'block_blog_max_title',   'block_headline_max_title',     'block_map_max_title' );
	echo $this->build_conf_table_textbox(4, 'block_latest_max_summary', 'block_blog_max_summary', 'block_headline_max_summary');
	echo $this->build_conf_table_textbox(4, 'block_latest_max_content', 'block_blog_max_content', 'block_headline_max_content');
	echo $this->build_conf_table_textbox(4, 'block_latest_num_content', 'block_blog_num_content', 'block_headline_num_content');
	echo $this->build_conf_table_select( 4, 'block_latest_order',       'block_blog_order',       'block_headline_order',         'block_map_order' );
	echo $this->build_conf_table_select( 4, 'block_latest_mode_date',   'block_blog_mode_date',   'block_headline_mode_date');
	echo $this->build_conf_table_yesno(  4, 'block_latest_show_thumb',  'block_blog_show_thumb',  'block_headline_show_thumb');
	echo $this->build_conf_table_yesno(  4, 'block_latest_show_site'  );
	echo $this->build_conf_table_yesno(  4, 'block_latest_show_icon'  );
	echo $this->build_conf_table_textbox(4, '',                         '',                       '',                             'block_map_info_max' );
	echo $this->build_conf_table_textbox(4, '',                         '',                       '',                             'block_map_info_width' );
	echo $this->build_conf_table_end(    4 );
}

//---------------------------------------------------------
// kakasi
//---------------------------------------------------------
function print_executable_kakasi()
{
	$kakasi      =& happy_linux_kakasi::getInstance();
	$kakasi_path =  $this->_config_define_handler->get_by_name('kakasi_path', 'value');

	if ( $kakasi->is_executable_kakasi( $kakasi_path ) )
	{
		echo '<span style="color:#0000ff">'._AM_RSSC_KAKASI_EXECUTABLE."</span><br /><br />\n";
	}
	else
	{
		echo '<span style="color:#ff0000">'._AM_RSSC_KAKASI_NOT_EXECUTABLE."</span><br /><br />\n";
	}
}

//---------------------------------------------------------
// show form rss cache clear
//---------------------------------------------------------
function show_form_rss_cache_clear( $title )
{
	echo $this->build_lib_box_button_style( $title, _HAPPY_LINUX_CONF_RSS_CACHE_CLEAR_DESC, 'rss_cache_clear', _HAPPY_LINUX_CLEAR );
	echo "<br />\n";
}

function show_form_template_compiled_clear( $title )
{
	$desc = sprintf( _HAPPY_LINUX_CONF_TPL_COMPILED_CLEAR_DIR, 'template/xml/, template/parts/' );
	echo $this->build_lib_box_button_style( $title, $desc, 'template_compiled_clear', _HAPPY_LINUX_CLEAR );
	echo "<br />\n";
}

//---------------------------------------------------------
// build config
//---------------------------------------------------------
function build_conf_extra_func( $config )
{
	$formtype  = $config['formtype'];
	$valuetype = $config['valuetype'];
	$name      = $config['name'];
	$value     = $config['value'];
	$options   = $config['options'];
	$value_s   = $this->sanitize_text( $value );

	switch ( $formtype ) 
	{
		case 'extra_webmpa3_dirname_list':
			$ele = $this->build_conf_extra_webmpa3_dirname_list( $config );
			break;

		default:
			$ele = $this->build_html_input_text( $name, $value_s );
			break;
	}

	return $ele;
}

function build_conf_extra_webmpa3_dirname_list( $config )
{
	$name  =  $config['name'];
	$value =  $config['value'];

	$param = array(
		'dirname_except'  => $this->_DIRNAME,
		'file'            => 'include/webmap3_version.php',
		'none_flag'       => true,
		'dirname_default' => $value,
	);

	$modules = $this->_system->get_module_list( $param );
	$options = $this->_system->get_dirname_list( $modules, $param );

	return $this->build_html_select( $name, $value, $options );
}

// --- class end ---
}

//================================================================
// class admin_config
//================================================================
class admin_config_store extends happy_linux_error
{

// handler
	var $_install;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_config_store()
{
	$this->happy_linux_error();

// config_store_handler
	$define =& rssc_config_define::getInstance();
	$this->_store_handler =& happy_linux_config_store_handler::getInstance();
	$this->_store_handler->set_handler('config', RSSC_DIRNAME, 'rssc');
	$this->_store_handler->set_define( $define );

	$this->_install =& rssc_install::getInstance( RSSC_DIRNAME );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_config_store();
	}

	return $instance;
}

//---------------------------------------------------------
// init config
//---------------------------------------------------------
function check_init()
{
	return $this->_install->check_install();
}

function init()
{
	$this->_clear_errors();

	$ret = $this->_install->install();
	if ( !$ret )
	{
// BUG: typo	
		$this->_set_errors( $this->_install->get_message() );
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// upgrade config
//---------------------------------------------------------
function check_version()
{
	return $this->_install->check_update();
}

function upgrade()
{
	$this->_clear_errors();

	$ret = $this->_install->update();
	if ( !$ret )
	{
// BUG: typo
		$this->_set_errors( $this->_install->get_message() );
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// save config
//---------------------------------------------------------
function save()
{
	$ret = $this->_store_handler->save();
	if ( !$ret )
	{
		$this->_set_errors( $this->_store_handler->getErrors() );
	}
	return $ret;
}

//---------------------------------------------------------
// rss cache clear
//---------------------------------------------------------
function rss_cache_clear()
{
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_builder.php';
	include_once RSSC_ROOT_PATH.'/class/rssc_build_rssc.php';

	$builder =& rssc_build_rssc::getInstance( RSSC_DIRNAME );

	$builder->clear_all_guest_cache();
}

function template_compiled_clear()
{
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/module_install.php';
	include_once RSSC_ROOT_PATH.'/class/rssc_install.php';

	$install =& rssc_install::getInstance( RSSC_DIRNAME );
	$install->clear_all_template();

}

// --- class end ---
}

?>