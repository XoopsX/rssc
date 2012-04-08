<?php
// $Id: parse_rss.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-30 K.OHWADA
// main()
// bug: break xoops cache if not set template

// 2007-11-01 K.OHWADA
// PHP 5.2: Assigning the return value of new by reference
// rssc_admin_print_footer()

// 2007-06-01 K.OHWADA
// api/refresh.php
// link_basic_handler xml_basic_handler
// get_lang_items()

// 2006-11-08 K.OHWADA
// use xoops_error()

// 2006-07-10 K.OHWADA
// move class admin_form_rss from admin_form_class.php
// use happy_linux_error happy_linux_form
// change make_xxx to build_xxx
// support podcast

// 2006-06-04 K.OHWADA
// change file name from view_rss.php to parse_rss.php
// change to contant RSSC_DIRNAME
// use new handler

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once XOOPS_ROOT_PATH.'/class/template.php';

include_once RSSC_ROOT_PATH.'/api/view.php';
include_once RSSC_ROOT_PATH.'/api/refresh.php';

//=========================================================
// class admin_parse_rss
//=========================================================
class admin_parse_rss extends happy_linux_error
{
// handler
	var $_config_handler;
	var $_refresh_handler;
	var $_view_handler;
	var $_link_basic_handler;
	var $_xml_basic_handler;
	var $_parser;
	var $_post;
	var $_form ;

	var $TEMPLATE_RDF;
	var $TEMPLATE_RSS;
	var $TEMPLATE_ATOM;

	var $_template;
	var $_result;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_parse_rss()
{
	$this->happy_linux_error();

	$this->_conf_handler       =& rssc_get_handler('config_basic', RSSC_DIRNAME);
	$this->_link_basic_handler =& rssc_get_handler('link_basic',   RSSC_DIRNAME);
	$this->_xml_basic_handler  =& rssc_get_handler('xml_basic',    RSSC_DIRNAME);
	$this->_refresh_handler    =& rssc_get_handler('refresh',      RSSC_DIRNAME);
	$this->_view_handler       =& rssc_get_handler('view',         RSSC_DIRNAME);
	$this->_parser             =& happy_linux_rss_parser::getInstance();
	$this->_utility            =& happy_linux_rss_utility::getInstance();
	$this->_post               =& happy_linux_post::getInstance();
	$this->_form               =& admin_form_rss::getInstance();

/* CDS Patch. RSS Center. 1.02. 3. BOF */
	global $xoopsConfig;
	$dir_theme = XOOPS_THEME_PATH . '/' . $xoopsConfig['theme_set'] . '/modules/' . RSSC_DIRNAME . '/xml';
	if (file_exists($dir_theme . '/rssc_build_rdf.html'))
	{
		$this->TEMPLATE_RDF = $dir_theme . '/rssc_view_rdf.html';
	}
	else
	{
		$this->TEMPLATE_RDF = RSSC_ROOT_PATH . '/templates/xml/rssc_view_rdf.html';
	}
	if (file_exists($dir_theme . '/rssc_view_rss.html'))
	{
		$this->TEMPLATE_RSS = $dir_theme . '/rssc_view_rss.html';
	}
	else
	{
		$this->TEMPLATE_RSS = RSSC_ROOT_PATH . '/templates/xml/rssc_view_rss.html';
	}
	if (file_exists($dir_theme . '/rssc_view_atom.html'))
	{
		$this->TEMPLATE_ATOM = $dir_theme . '/rssc_view_atom.html';
	}
	else
	{
		$this->TEMPLATE_ATOM = RSSC_ROOT_PATH . '/templates/xml/rssc_view_atom.html';
	}
/* CDS Patch. RSS Center. 1.02. 3. EOF */

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_parse_rss();
	}

	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	echo "<h3>"._AM_RSSC_PARSE_RSS."</h3>\n";
	echo "<a href='#option'>"._AM_RSSC_VIEW_RSS_OPTION."</a><br /><br />\n";

	$op  = $this->get_post_op();
	$lid = $this->get_post_get_lid();

	$param =& $this->get_param();

	if ( $lid > 0 )
	{
		if ( $this->exists_link($lid) )
		{
			if ($op == 'param')
			{
				$param =& $_POST;
			}
			else
			{
				$param =& $this->get_param($lid);
			}

			$ret = $this->get_result($lid, $param);
			if ( $ret )
			{
				$this->display_tpl($param);
			}
		}
		else
		{
			echo "<font color='red'>"._NO_RECORD."</font><br />\n";
		}
	}
	else
	{
		echo "<font color='red'>"._AM_RSSC_NOT_SELECT_LINK."</font><br /><br />\n";
		echo _AM_RSSC_PLEASE_SELECT_LINK."<br />\n";
	}

	echo "<br />\n";
	echo "<a name='option'><h4>"._AM_RSSC_VIEW_RSS_OPTION."</h4></a>\n";

	$this->show_rss($param);
}

//---------------------------------------------------------
// get link
//---------------------------------------------------------
function exists_link($lid)
{
	$ret = $this->_link_basic_handler->exists_by_lid($lid);
	return $ret;
}

function &get_link_by_lid($lid)
{
	$ret =& $this->_link_basic_handler->get_link_by_lid($lid);
	return $ret;
}

//---------------------------------------------------------
// get param
//---------------------------------------------------------
function &get_param($lid='')
{
	$false = false;
	$conf_data =& $this->_conf_handler->get_conf();

	$title    = '';
	$rdf_url  = '';
	$rss_url  = '';
	$atom_url = '';
	$rss_mode = '';

	if ($lid)
	{
		$link =& $this->get_link_by_lid($lid);
		if ( !is_array($link) )
		{	return $false;	}

		$title    = $link['title'];
		$rdf_url  = $link['rdf_url'];
		$rss_url  = $link['rss_url'];
		$atom_url = $link['atom_url'];
		$rss_mode = $link['mode'];
	}

	$data = array(
		'lid'      => $lid,
		'title'    => $title,
		'rdf_url'  => $rdf_url,
		'rss_url'  => $rss_url,
		'atom_url' => $atom_url,
		'rss_mode' => $rss_mode,
		'rss_atom'      => $conf_data['basic_rss_atom'],
//		'parser_rss'    => $conf_data['basic_parser_rss'],
		'xml_save'      => $conf_data['basic_xml_save'],
		'mode_view'     => 0,
		'feed_perpage'  => 10,
		'sanitize'      => 1,
		'title_html'    => 1,
		'content_html'  => 1,
		'max_title'     => -1,
		'max_content'   => -1,
		'max_summary'   => -1,
		'link_update'   => 1,
		'feed_update'   => 1,
		'force_discover'  => 0,
		'force_update'    => 0,
		'force_overwrite' => 0,
		'print_log'   => 0,
		'print_error' => 1,
	);

	return $data;
}

function get_result($lid, $param)
{
	$link_obj =& $this->_link_basic_handler->get_cache_object_by_id($lid);
	if ( !is_object($link_obj) )
	{
		xoops_error('no link object');
		return false;
	}

	$link_xml =& $this->_xml_basic_handler->get_xml_by_lid($lid);
	if ( empty($link_xml) )
	{
		xoops_error('no xml data');
		return false;
	}

	$mode     = $param['mode_view'];
	$rss_mode = $param['rss_mode'];

	$link_encoding = $link_obj->get('encoding');
	$xml_url       = $link_obj->get_rssurl_select_by_mode( $rss_mode );

//	$this->_template = $this->get_template( $rss_mode );

	$this->_refresh_handler->set_debug_parse( 1, $xml_url, $link_encoding, $rss_mode );
//	$this->_refresh_handler->setRssParser(          $param['parser_rss'] );
	$this->_refresh_handler->set_link_update(       $param['link_update'] );
	$this->_refresh_handler->set_feed_update(       $param['feed_update'] );
	$this->_refresh_handler->set_xml_save(          $param['xml_save'] );
	$this->_refresh_handler->set_force_discover(    $param['force_discover'] );
	$this->_refresh_handler->set_force_refresh(     $param['force_update'] );
	$this->_refresh_handler->set_force_overwrite(   $param['force_overwrite'] );
	$this->_refresh_handler->set_debug_print_log(   $param['print_log'] );
	$this->_refresh_handler->set_debug_print_error( $param['print_error'] );

	$this->_view_handler->setFlagSanitize(  $param['sanitize'] );
	$this->_view_handler->setFeedStart( 0 );
	$this->_view_handler->setFeedLimit(     $param['feed_perpage'] );
	$this->_view_handler->set_title_html(   $param['title_html'] );
	$this->_view_handler->set_content_html( $param['content_html'] );
	$this->_view_handler->set_max_title(    $param['max_title'] );
	$this->_view_handler->set_max_content(  $param['max_content'] );
	$this->_view_handler->set_max_summary(  $param['max_summary'] );

	if ($mode == 1)
	{
		$result =& $this->get_sanitized_parse_by_lid($lid);
	}
	elseif ($mode == 2)
	{
		if ( !$this->_refresh_handler->refresh($lid) )
		{
			$this->_set_errors( $this->_refresh_handler->getErrors() );
		}

		$result =& $this->_view_handler->get_sanitized_store_by_lid($lid);
	}
	else
	{
		$this->_refresh_handler->set_link_update(   0 );
		$this->_refresh_handler->set_feed_update(   0 );
		$this->_refresh_handler->set_force_refresh( 1 );

		if ( !$this->_refresh_handler->refresh($lid) )
		{
			$this->_set_errors( $this->_refresh_handler->getErrors() );
		}

		$data =& $this->_refresh_handler->getData();
		$result =& $this->_view_handler->view_format_sanitize( $data );
	}

	if ( $this->_error_flag )
	{
		xoops_error( $this->getErrors(1) );
	}

	$this->_result = $result;
	return true;
}

function &get_sanitized_parse_by_lid($lid)
{
	$false = false;

	$link =& $this->get_link_by_lid($lid);
	if ( !is_array($link) )
	{	return $false;	}

	$xml =& $this->_xml_basic_handler->get_xml_by_lid($lid);
	if ( empty($xml) )
	{	return $false;	}

	$encoding = $link['encoding'];

	$parse_obj =& $this->_parser->parse_by_xml($xml, $encoding);
	if ( !is_object($parse_obj) )
	{
		$this->_set_errors( $this->_parser->getErrors() );
		return $false;
	}

	$data1 =& $parse_obj->get_vars();

// sanitize
	$data2 =& $this->_view_handler->view_sanitize( $data1 );
	return $data2;
}

function get_template($mode)
{
	switch ($mode)
	{
		case RSSC_C_MODE_RDF:
			$template = $this->TEMPLATE_RDF;
			break;

		case RSSC_C_MODE_ATOM:
			$template = $this->TEMPLATE_ATOM;
			break;

		case RSSC_C_MODE_RSS:
		default:
			$template = $this->TEMPLATE_RSS;
			break;
	}

	return $template;
}

function display_tpl( $param )
{
	$result = $this->_result;
	if ( !is_array($result) || !count($result) )
	{
		xoops_error('display_tpl: no result');
		return false;
	}

	$rss_mode = $param['rss_mode'];
	$template = $this->get_template( $rss_mode );

	$tpl = new XoopsTpl();

// bug: break xoops cache if not set template
// clear template in update script since v0.70
//	$tpl->clear_compiled_tpl( $template );
//	$tpl->clear_cache( $template );

	$tpl->assign('xoops_url', XOOPS_URL);
	$tpl->assign_by_ref('channel',   $result['channel'] );
	$tpl->assign_by_ref('image',     $result['image'] );
	$tpl->assign_by_ref('textinput', $result['textinput'] );

	if ( isset($result['items']) && is_array($result['items']) )
	{
		foreach ($result['items'] as $item) 
		{
			$tpl->append('items', $item);
		}
	}

	$tpl->assign( $this->_utility->get_lang_items() );

	$tpl->display( $template );

}

//---------------------------------------------------------
// show form
//---------------------------------------------------------
function show_rss($data)
{
	$lid = 0;
	if ( isset($data['lid']) )
	{
		$lid = intval($data['lid']);
	}

	if ($lid)
	{
		$link =& $this->get_link_by_lid($lid);
		if ( is_array($link) )
		{
			$data['title']    = $link['title_s'];
			$data['rdf_url']  = $link['rdf_url_s'];
			$data['rss_url']  = $link['rss_url_s'];
			$data['atom_url'] = $link['atom_url_s'];
		}
	}

	$this->_form->show_rss($data);
}

//---------------------------------------------------------
// class post
//---------------------------------------------------------
function get_post_op()
{
	return $this->_post->get_post('op');
}

function get_post_get_lid()
{
	return $this->_post->get_post_get_int('lid');
}

// --- class end ---
}

//=========================================================
// class admin_form_rss
//=========================================================
class admin_form_rss extends happy_linux_form
{
	var $_link_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_rss()
{
	$this->happy_linux_form();

	$this->_link_handler =& rssc_get_handler('link', RSSC_DIRNAME);
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_rss();
	}
	return $instance;
}

//---------------------------------------------------------
// show form
//---------------------------------------------------------
function show_rss($data)
{
	$this->set_datas($data);

// form start
	echo $this->build_form_begin('rss');
	echo $this->build_xoops_token();
	echo $this->build_html_input_hidden('op', 'param');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title(_AM_RSSC_VIEW_RSS);

	echo $this->build_data_table_text( _RSSC_LINK_ID, 'lid');
	echo $this->build_data_table_label_hidden( _RSSC_SITE_TITLE, 'title' );
	$this->_print_sel_mode();
	$this->_print_text('feed_perpage');
	$this->_print_yesno('sanitize');
	$this->_print_yesno('title_html');
	$this->_print_yesno('content_html');
	$this->_print_text('max_title');
	$this->_print_text('max_content');
	$this->_print_text('max_summary');

	echo $this->build_form_table_title( _AM_RSSC_VIEW_PARSER );
	echo $this->build_data_table_label_hidden( _RSSC_RDF_URL,  'rdf_url' );
	echo $this->build_data_table_label_hidden( _RSSC_RSS_URL,  'rss_url' );
	echo $this->build_data_table_label_hidden( _RSSC_ATOM_URL, 'atom_url' );
	$this->_print_sel_rss_mode();
//	$this->_print_sel_parser_rss();
//	$this->_print_sel_parser_atom();
	$this->_print_yesno('force_discover');

	echo $this->build_form_table_title( _AM_RSSC_VIEW_SAVE_ETC );
	$this->_print_yesno('link_update');
	$this->_print_yesno('xml_save');
	$this->_print_yesno('feed_update');
	$this->_print_yesno('force_update');
	$this->_print_yesno('force_overwrite');
	$this->_print_yesno('print_log');
	$this->_print_yesno('print_error');

	$ele_submit = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

//---------------------------------------------------------
// private
//---------------------------------------------------------
function _print_label_hidden($name)
{
	$cap = $this->_make_admin_caption($name);
	echo $this->build_data_table_label_hidden($cap, $name);
}

function _print_text($name)
{
	$cap = $this->_make_admin_caption($name);
	echo $this->build_data_table_text($cap, $name);
}

function _print_yesno($name)
{
	$cap = $this->_make_admin_caption($name);
	echo $this->build_data_table_radio_yesno($cap, $name);
}

function _print_sel_mode()
{
	$options = array(
		_AM_RSSC_VIEW_MODE_CURRENT => RSSC_C_VIEW_CURRENT,
		_AM_RSSC_VIEW_MODE_LINK    => RSSC_C_VIEW_LINK,
		_AM_RSSC_VIEW_MODE_FEED    => RSSC_C_VIEW_FEED,
		);

	$cap = $this->build_form_caption(_AM_RSSC_VIEW_MODE, _AM_RSSC_VIEW_MODE_DESC);
	$ele = $this->build_html_input_radio_select('mode_view', $this->_datas['mode_view'], $options, '<br />');
	echo $this->build_form_table_line($cap, $ele);
}

function _print_sel_rss_atom()
{
	$options = array(
		_AM_RSSC_CONF_RSS_ATOM_SEL_RSS  => RSSC_C_SEL_RSS,
		_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM => RSSC_C_SEL_ATOM,
		);

	$cap = $this->build_form_caption(_AM_RSSC_CONF_RSS_ATOM, _AM_RSSC_CONF_RSS_ATOM_DESC);
	$ele = $this->build_html_input_radio_select('rss_atom', $this->_datas['rss_atom'], $options, '<br />');
	echo $this->build_form_table_line($cap, $ele);
}

//function _print_sel_parser_rss()
//{
//	$options = array(
//		_AM_RSSC_CONF_RSS_PARSER_XOOPS => RSSC_C_PARSER_RSS_XOOPS,
//		_AM_RSSC_CONF_RSS_PARSER_SELF  => RSSC_C_PARSER_RSS_SELF
//		);
//	$cap = $this->build_form_caption(_AM_RSSC_CONF_RSS_PARSER);
//	$ele = $this->build_html_input_radio_select('parser_rss', $this->_datas['parser_rss'], $options, '<br />');
//	echo $this->build_form_table_line($cap, $ele);
//}

function _print_sel_rss_mode()
{
// PHP 5.2: Assigning the return value of new by reference
	$mode_opt = $this->_link_handler->get_mode_option();
	$ele_mode = $this->build_html_input_radio_select('rss_mode', $this->_datas['rss_mode'], $mode_opt );
	echo $this->build_form_table_line(_RSSC_RSS_MODE, $ele_mode);
}

function _make_admin_caption($keyword)
{
	$const_title = '_AM_RSSC_VIEW_' . strtoupper($keyword);
	$const_desc  = $const_title.'_DESC';
	$title = '';
	$desc  = '';

	if ( defined( $const_title ) )
	{
		$title = constant( $const_title );
	}
	else
	{
		$title = $const_title;
	}

	if ( defined( $const_desc ) )
	{
		$desc = constant( $const_desc );
	}

	$ret = $this->build_form_caption($title, $desc);
	return $ret;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$parse =& admin_parse_rss::getInstance();

xoops_cp_header();

rssc_admin_print_header();
rssc_admin_print_menu();

$parse->main();

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// === main end ===

?>