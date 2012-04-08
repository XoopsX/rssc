<?php
// $Id: rssc_config_define.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2009-02-20 K.OHWADA
// webmap_dirname

// 2008-01-20 K.OHWADA
// pre_plugin

// 2008-01-10 K.OHWADA
// Notice [PHP]: Only variables should be assigned by reference

// 2007-11-11 K.OHWADA
// $xoopsConfig

// 2007-10-10 K.OHWADA
// block_latest_mode_date

// 2007-06-01 K.OHWADA
// content filter: link_use etc

// 2006-11-08 K.OHWADA
// proxy server
// main_link_feeds_perlink
// basic_highlight

// 2006-09-20 K.OHWADA
// add main_search_title_html
// add block_blog_lid

// 2006-07-10 K.OHWADA
// use happy_linux_config_define_base

// 2006-06-04 K.OHWADA
// not use basic_parser_rss

// 2006-01-20 K.OHWADA
// small change

//================================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//================================================================

// === class begin ===
if( !class_exists('rssc_config_define') ) 
{

//=========================================================
// class rssc_config_define
//=========================================================
class rssc_config_define extends happy_linux_config_define_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_config_define()
{
	$this->happy_linux_config_define_base();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_config_define();
	}
	return $instance;
}

//---------------------------------------------------------
// function
// same as xoops_version.php
//---------------------------------------------------------
// Notice [PHP]: Only variables should be assigned by reference
function &get_define()
{
	global $xoopsConfig;
	$adminmail = $xoopsConfig['adminmail'];

//---------------------------------------------------------
// basic config
//---------------------------------------------------------
	$config[1]['name']      = 'basic_feed_limit';
	$config[1]['catid']     = 1;
	$config[1]['title']       = '_AM_RSSC_CONF_FEED_LIMIT';
	$config[1]['description'] = '_AM_RSSC_CONF_FEED_LIMIT_DESC';
	$config[1]['formtype']  = 'text';
	$config[1]['valuetype'] = 'int';
	$config[1]['default']   = 10000;

	$config[2]['name']      = 'basic_rss_atom';
	$config[2]['catid']     = 1;
	$config[2]['title']       = '_AM_RSSC_CONF_RSS_ATOM';
	$config[2]['description'] = '_AM_RSSC_CONF_RSS_ATOM_DESC';
	$config[2]['formtype']  = 'radio_select';
	$config[2]['valuetype'] = 'text';
	$config[2]['default']   = RSSC_C_SEL_ATOM;
	$config[2]['options']   = array(
		_AM_RSSC_CONF_RSS_ATOM_SEL_RSS  => RSSC_C_SEL_RSS,
		_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM => RSSC_C_SEL_ATOM,
		);

// 2006-06-04
//	$config[3]['name']      = 'basic_parser_rss';
//	$config[3]['catid']     = 1;
//	$config[3]['title']       = '_AM_RSSC_CONF_RSS_PARSER';
//	$config[3]['description'] = '_AM_RSSC_CONF_RSS_PARSER_DESC';
//	$config[3]['formtype']  = 'radio_select';
//	$config[3]['valuetype'] = 'text';
//	$config[3]['default']   = RSSC_C_PARSER_RSS_SELF;
//	$config[3]['options']   = array(
//		_AM_RSSC_CONF_RSS_PARSER_XOOPS => RSSC_C_PARSER_RSS_XOOPS,
//		_AM_RSSC_CONF_RSS_PARSER_SELF  => RSSC_C_PARSER_RSS_SELF
//		);

//	$config[4]['name']      = 'basic_parser_atom';
//	$config[4]['catid']     = 1;
//	$config[4]['title']       = '_AM_RSSC_CONF_ATOM_PARSER';
//	$config[4]['description'] = '_AM_RSSC_CONF_ATOM_PARSER_DESC';
//	$config[4]['formtype']  = 'radio_select';
//	$config[4]['valuetype'] = 'text';
//	$config[4]['default']   = RSSC_C_PARSER_ATOM_SELF;
//	$config[4]['options']   = array(
//		_AM_RSSC_CONF_ATOM_PARSER_0 => RSSC_C_PARSER_ATOM_SELF,
//		);

	$config[5]['name']      = 'basic_xml_save';
	$config[5]['catid']     = 1;
	$config[5]['title']       = '_AM_RSSC_CONF_XML_SAVE';
	$config[5]['description'] = '_AM_RSSC_CONF_XML_SAVE_DESC';
	$config[5]['formtype']  = 'yesno';
	$config[5]['valuetype'] = 'int';
	$config[5]['default']   = 1;

	$config[6]['name']      = 'basic_future_days';
	$config[6]['catid']     = 1;
	$config[6]['title']       = '_AM_RSSC_CONF_FUTURE_DAYS';
	$config[6]['description'] = '_AM_RSSC_CONF_FUTURE_DAYS_DESC';
	$config[6]['formtype']  = 'text';
	$config[6]['valuetype'] = 'int';
	$config[6]['default']   = 3;

	$config[7]['name']       = 'basic_highlight';
	$config[7]['catid']      = 1;
	$config[7]['title']       = '_AM_RSSC_CONF_HIGHLIGHT';
//	$config[7]['description'] = '_AM_RSSC_CONF_HIGHLIGHT_DESC';
	$config[7]['formtype']  = 'yesno';
	$config[7]['valuetype'] = 'int';
	$config[7]['default']   = 1;

//---------------------------------------------------------
// main search
//---------------------------------------------------------
	$config[10]['name']      = 'main_search_min';
	$config[10]['catid']     = 0;
	$config[10]['title']       = '_AM_RSSC_CONF_MAIN_SEARCH_MIN';
//	$config[10]['description'] = '_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC';
	$config[10]['formtype']  = 'text';
	$config[10]['valuetype'] = 'int';
	$config[10]['default']   = 4;

	$config[11]['name']      = 'main_search_order';
	$config[11]['catid']     = 0;
	$config[11]['title']       = '_AM_RSSC_CONF_SHOW_ORDER';
//	$config[11]['description'] = '_AM_RSSC_CONF_SHOW_ORDER_DESC';
	$config[11]['formtype']  = 'radio_select';
	$config[11]['valuetype'] = 'text';
	$config[11]['default']   = RSSC_C_ORDER_INT_UPDATED;
	$config[11]['options']   = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

	$config[12]['name']      = 'main_search_perpage';
	$config[12]['catid']     = 0;
	$config[12]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE';
//	$config[12]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC';
	$config[12]['formtype']  = 'text';
	$config[12]['valuetype'] = 'int';
	$config[12]['default']   = 10;

	$config[13]['name']      = 'main_search_max_title';
	$config[13]['catid']     = 0;
	$config[13]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[13]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[13]['formtype']  = 'text';
	$config[13]['valuetype'] = 'int';
	$config[13]['default']   = -1;

	$config[14]['name']      = 'main_search_max_summary';
	$config[14]['catid']     = 0;
	$config[14]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[14]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[14]['formtype']  = 'text';
	$config[14]['valuetype'] = 'int';
	$config[14]['default']   = 250;

	$config[71]['name']        = 'main_search_title_html';
	$config[71]['catid']       = 0;
	$config[71]['title']       = '_AM_RSSC_CONF_SHOW_TITLE_HTML';
	$config[71]['description'] = '_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC';
	$config[71]['formtype']    = 'yesno';
	$config[71]['valuetype']   = 'int';
	$config[71]['default']     = 0;

	$config[72]['name']        = 'main_search_content_html';
	$config[72]['catid']       = 0;
	$config[72]['title']       = '_AM_RSSC_CONF_SHOW_CONTENT_HTML';
	$config[72]['description'] = '_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC';
	$config[72]['formtype']    = 'yesno';
	$config[72]['valuetype']   = 'int';
	$config[72]['default']     = 0;

	$config[73]['name']        = 'main_search_max_content';
	$config[73]['catid']       = 0;
	$config[73]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[73]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[73]['formtype']    = 'text';
	$config[73]['valuetype']   = 'int';
	$config[73]['default']     = 0;

	$config[98]['name']        = 'main_search_show_site';
	$config[98]['catid']       = 0;
	$config[98]['title']       = '_AM_RSSC_CONF_SHOW_SITE';
	$config[98]['description'] = '_AM_RSSC_CONF_SHOW_SITE_DSC';
	$config[98]['formtype']    = 'text';
	$config[98]['valuetype']   = 'int';
	$config[98]['default']     = 1;

	$config[99]['name']        = 'main_search_show_icon';
	$config[99]['catid']       = 0;
	$config[99]['title']       = '_AM_RSSC_CONF_SHOW_ICON';
	$config[99]['description'] = '_AM_RSSC_CONF_SHOW_ICON_DSC';
	$config[99]['formtype']    = 'text';
	$config[99]['valuetype']   = 'int';
	$config[99]['default']     = 1;

	$config[221]['name']        = 'main_search_show_thumb';
	$config[221]['catid']       = 0;
	$config[221]['title']       = '_AM_RSSC_CONF_SHOW_THUMB';
	$config[221]['description'] = '_AM_RSSC_CONF_SHOW_THUMB_DSC';
	$config[221]['formtype']    = 'text';
	$config[221]['valuetype']   = 'int';
	$config[221]['default']     = 1;

//---------------------------------------------------------
// main headline
//---------------------------------------------------------
	$config[16]['name']      = 'main_headline_links_perpage';
	$config[16]['catid']     = 0;
	$config[16]['title']       = '_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE';
//	$config[16]['description'] = '_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC';
	$config[16]['formtype']  = 'text';
	$config[16]['valuetype'] = 'int';
	$config[16]['default']   = 10;

	$config[17]['name']      = 'main_headline_feeds_perpage';
	$config[17]['catid']     = 0;
	$config[17]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE';
//	$config[17]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC';
	$config[17]['formtype']  = 'text';
	$config[17]['valuetype'] = 'int';
	$config[17]['default']   = 10;

	$config[18]['name']      = 'main_headline_max_title';
	$config[18]['catid']     = 0;
	$config[18]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[18]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[18]['formtype']  = 'text';
	$config[18]['valuetype'] = 'int';
	$config[18]['default']   = -1;

	$config[19]['name']      = 'main_headline_max_summary';
	$config[19]['catid']     = 0;
	$config[19]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[19]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[19]['formtype']  = 'text';
	$config[19]['valuetype'] = 'int';
	$config[19]['default']   = 250;

	$config[20]['name']      = 'main_headline_order';
	$config[20]['catid']     = 0;
	$config[20]['title']       = '_AM_RSSC_CONF_MAIN_HEADLINE_ORDER';
//	$config[20]['description'] = '_AM_RSSC_CONF_MAIN_HEADLINE_ORDER_DESC';
	$config[20]['formtype']  = 'radio_select';
	$config[20]['valuetype'] = 'text';
	$config[20]['default']   = RSSC_C_ORDER_INT_PUBLISHED;
	$config[20]['options']   = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

	$config[74]['name']        = 'main_headline_title_html';
	$config[74]['catid']       = 0;
	$config[74]['title']       = '_AM_RSSC_CONF_SHOW_TITLE_HTML';
	$config[74]['description'] = '_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC';
	$config[74]['formtype']    = 'yesno';
	$config[74]['valuetype']   = 'int';
	$config[74]['default']     = 0;

	$config[75]['name']        = 'main_headline_content_html';
	$config[75]['catid']       = 0;
	$config[75]['title']       = '_AM_RSSC_CONF_SHOW_CONTENT_HTML';
	$config[75]['description'] = '_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC';
	$config[75]['formtype']    = 'yesno';
	$config[75]['valuetype']   = 'int';
	$config[75]['default']     = 0;

	$config[76]['name']        = 'main_headline_max_content';
	$config[76]['catid']       = 0;
	$config[76]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[76]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[76]['formtype']    = 'text';
	$config[76]['valuetype']   = 'int';
	$config[76]['default']     = 0;

	$config[222]['name']        = 'main_headline_show_thumb';
	$config[222]['catid']       = 0;
	$config[222]['title']       = '_AM_RSSC_CONF_SHOW_THUMB';
	$config[222]['description'] = '_AM_RSSC_CONF_SHOW_THUMB_DSC';
	$config[222]['formtype']    = 'text';
	$config[222]['valuetype']   = 'int';
	$config[222]['default']     = 1;

//---------------------------------------------------------
// main single
//---------------------------------------------------------
	$config[22]['name']      = 'main_single_max_title';
	$config[22]['catid']     = 0;
	$config[22]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[22]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[22]['formtype']  = 'text';
	$config[22]['valuetype'] = 'int';
	$config[22]['default']   = -1;

	$config[23]['name']      = 'main_single_max_summary';
	$config[23]['catid']     = 0;
	$config[23]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[23]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[23]['formtype']  = 'text';
	$config[23]['valuetype'] = 'int';
	$config[23]['default']   = 0;

	$config[77]['name']        = 'main_single_title_html';
	$config[77]['catid']       = 0;
	$config[77]['title']       = '_AM_RSSC_CONF_SHOW_TITLE_HTML';
	$config[77]['description'] = '_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC';
	$config[77]['formtype']    = 'yesno';
	$config[77]['valuetype']   = 'int';
	$config[77]['default']     = 0;

	$config[78]['name']        = 'main_single_content_html';
	$config[78]['catid']       = 0;
	$config[78]['title']       = '_AM_RSSC_CONF_SHOW_CONTENT_HTML';
	$config[78]['description'] = '_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC';
	$config[78]['formtype']    = 'yesno';
	$config[78]['valuetype']   = 'int';
	$config[78]['default']     = 1;

	$config[79]['name']        = 'main_single_max_content';
	$config[79]['catid']       = 0;
	$config[79]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[79]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[79]['formtype']    = 'text';
	$config[79]['valuetype']   = 'int';
	$config[79]['default']     = -1;

//---------------------------------------------------------
// main link
//---------------------------------------------------------
	$config[91]['name']        = 'main_link_feeds_perlink';
	$config[91]['catid']       = 0;
	$config[91]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE';
//	$config[91]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC';
	$config[91]['formtype']    = 'text';
	$config[91]['valuetype']   = 'int';
	$config[91]['default']     = 10;

	$config[92]['name']        = 'main_link_title_html';
	$config[92]['catid']       = 0;
	$config[92]['title']       = '_AM_RSSC_CONF_SHOW_TITLE_HTML';
//	$config[92]['description'] = '_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC';
	$config[92]['formtype']    = 'yesno';
	$config[92]['valuetype']   = 'int';
	$config[92]['default']     = 0;

	$config[93]['name']        = 'main_link_content_html';
	$config[93]['catid']       = 0;
	$config[93]['title']       = '_AM_RSSC_CONF_SHOW_CONTENT_HTML';
//	$config[93]['description'] = '_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC';
	$config[93]['formtype']    = 'yesno';
	$config[93]['valuetype']   = 'int';
	$config[93]['default']     = 0;

	$config[94]['name']        = 'main_link_max_title';
	$config[94]['catid']       = 0;
	$config[94]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[94]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
//	$config[94]['formtype']    = 'text';
	$config[94]['valuetype']   = 'int';
	$config[94]['default']     = -1;

	$config[95]['name']        = 'main_link_max_content';
	$config[95]['catid']       = 0;
	$config[95]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[95]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[95]['formtype']    = 'text';
	$config[95]['valuetype']   = 'int';
	$config[95]['default']     = 0;

	$config[96]['name']        = 'main_link_max_summary';
	$config[96]['catid']       = 0;
	$config[96]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[96]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[96]['formtype']    = 'text';
	$config[96]['valuetype']   = 'int';
	$config[96]['default']     = 250;

	$config[97]['name']        = 'main_link_order';
	$config[97]['catid']       = 0;
	$config[97]['title']       = '_AM_RSSC_CONF_SHOW_ORDER';
//	$config[97]['description'] = '_AM_RSSC_CONF_SHOW_ORDER_DESC';
	$config[97]['formtype']    = 'radio_select';
	$config[97]['valuetype']   = 'text';
	$config[97]['default']     = RSSC_C_ORDER_INT_PUBLISHED;
	$config[97]['options']     = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

//---------------------------------------------------------
// block latest config
//---------------------------------------------------------
	$config[30]['name']      = 'block_latest_perpage';
	$config[30]['catid']     = 0;
	$config[30]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE';
//	$config[30]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC';
	$config[30]['formtype']  = 'text';
	$config[30]['valuetype'] = 'int';
	$config[30]['default']   = 10;

	$config[31]['name']      = 'block_latest_max_title';
	$config[31]['catid']     = 0;
	$config[31]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[31]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[31]['formtype']  = 'text';
	$config[31]['valuetype'] = 'int';
	$config[31]['default']   = 30;

	$config[32]['name']      = 'block_latest_max_summary';
	$config[32]['catid']     = 0;
	$config[32]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[32]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[32]['formtype']  = 'text';
	$config[32]['valuetype'] = 'int';
	$config[32]['default']   = 150;

	$config[33]['name']      = 'block_latest_order';
	$config[33]['catid']     = 0;
	$config[33]['title']       = '_AM_RSSC_CONF_SHOW_ORDER';
//	$config[33]['description'] = '_AM_RSSC_CONF_SHOW_ORDER_DESC';
	$config[33]['formtype']  = 'radio_select';
	$config[33]['valuetype'] = 'text';
	$config[33]['default']   = RSSC_C_ORDER_INT_UPDATED;
	$config[33]['options']   = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

	$config[81]['name']        = 'block_latest_max_content';
	$config[81]['catid']       = 0;
	$config[81]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[81]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[81]['formtype']    = 'text';
	$config[81]['valuetype']   = 'int';
	$config[81]['default']     = 0;

	$config[85]['name']      = 'block_latest_num_content';
	$config[85]['catid']     = 0;
	$config[85]['title']       = '_AM_RSSC_CONF_SHOW_NUM_CONTENT';
	$config[85]['description'] = '_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC';
	$config[85]['formtype']  = 'text';
	$config[85]['valuetype'] = 'int';
	$config[85]['default']   = 0;

	$config[141]['name']      = 'block_latest_mode_date';
	$config[141]['catid']     = 0;
	$config[141]['title']       = '_AM_RSSC_CONF_SHOW_MODE_DATE';
//	$config[141]['description'] = '_AM_RSSC_CONF_SHOW_MODE_DATE_DSC';
	$config[141]['formtype']  = 'radio_select';
	$config[141]['valuetype'] = 'int';
	$config[141]['default']   = 1;
	$config[141]['options']   = array(
		_AM_RSSC_CONF_SHOW_MODE_DATE_NON    => RSSC_C_DATE_INT_NON,
		_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT  => RSSC_C_DATE_INT_SHORT,
		_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE => RSSC_C_DATE_INT_MIDDLE,
		_AM_RSSC_CONF_SHOW_MODE_DATE_LONG   => RSSC_C_DATE_INT_LONG,
		);

	$config[144]['name']      = 'block_latest_show_site';
	$config[144]['catid']     = 0;
	$config[144]['title']       = '_AM_RSSC_CONF_SHOW_SITE';
	$config[144]['description'] = '_AM_RSSC_CONF_SHOW_SITE_DSC';
	$config[144]['formtype']  = 'yesno';
	$config[144]['valuetype'] = 'int';
	$config[144]['default']   = 0;

	$config[145]['name']      = 'block_latest_show_icon';
	$config[145]['catid']     = 0;
	$config[145]['title']       = '_AM_RSSC_CONF_SHOW_ICON';
	$config[145]['description'] = '_AM_RSSC_CONF_SHOW_ICON_DSC';
	$config[145]['formtype']  = 'yesno';
	$config[145]['valuetype'] = 'int';
	$config[145]['default']   = 1;

	$config[146]['name']        = 'block_latest_show_thumb';
	$config[146]['catid']       = 0;
	$config[146]['title']       = '_AM_RSSC_CONF_SHOW_THUMB';
	$config[146]['description'] = '_AM_RSSC_CONF_SHOW_THUMB_DSC';
	$config[146]['formtype']    = 'text';
	$config[146]['valuetype']   = 'int';
	$config[146]['default']     = 1;

//---------------------------------------------------------
// block headline config
//---------------------------------------------------------
	$config[35]['name']      = 'block_headline_links_perpage';
	$config[35]['catid']     = 0;
	$config[35]['title']       = '_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE';
//	$config[35]['description'] = '_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC';
	$config[35]['formtype']  = 'text';
	$config[35]['valuetype'] = 'int';
	$config[35]['default']   = 5;

	$config[36]['name']      = 'block_headline_feeds_perlink';
	$config[36]['catid']     = 0;
	$config[36]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK';
//	$config[36]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC';
	$config[36]['formtype']  = 'text';
	$config[36]['valuetype'] = 'int';
	$config[36]['default']   = 5;

	$config[37]['name']      = 'block_headline_max_title';
	$config[37]['catid']     = 0;
	$config[37]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[37]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[37]['formtype']  = 'text';
	$config[37]['valuetype'] = 'int';
	$config[37]['default']   = 30;

	$config[38]['name']      = 'block_headline_max_summary';
	$config[38]['catid']     = 0;
	$config[38]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[38]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[38]['formtype']  = 'text';
	$config[38]['valuetype'] = 'int';
	$config[38]['default']   = 150;

	$config[39]['name']      = 'block_headline_order';
	$config[39]['catid']     = 0;
	$config[39]['title']       = '_AM_RSSC_CONF_MAIN_HEADLINE_ORDER';
//	$config[39]['description'] = '_AM_RSSC_CONF_MAIN_HEADLINE_ORDER_DESC';
	$config[39]['formtype']  = 'radio_select';
	$config[39]['valuetype'] = 'text';
	$config[39]['default']   = RSSC_C_ORDER_INT_PUBLISHED;
	$config[39]['options']   = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

	$config[82]['name']        = 'block_headline_max_content';
	$config[82]['catid']       = 0;
	$config[82]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[82]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[82]['formtype']    = 'text';
	$config[82]['valuetype']   = 'int';
	$config[82]['default']     = 0;

	$config[86]['name']      = 'block_headline_num_content';
	$config[86]['catid']     = 0;
	$config[86]['title']       = '_AM_RSSC_CONF_SHOW_NUM_CONTENT';
	$config[86]['description'] = '_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC';
	$config[86]['formtype']  = 'text';
	$config[86]['valuetype'] = 'int';
	$config[86]['default']   = 0;

	$config[142]['name']      = 'block_headline_mode_date';
	$config[142]['catid']     = 1;
	$config[142]['title']       = '_AM_RSSC_CONF_SHOW_MODE_DATE';
//	$config[142]['description'] = '_AM_RSSC_CONF_SHOW_MODE_DATE_DSC';
	$config[142]['formtype']  = 'radio_select';
	$config[142]['valuetype'] = 'int';
	$config[142]['default']   = 1;
	$config[142]['options']   = array(
		_AM_RSSC_CONF_SHOW_MODE_DATE_NON    => RSSC_C_DATE_INT_NON,
		_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT  => RSSC_C_DATE_INT_SHORT,
		_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE => RSSC_C_DATE_INT_MIDDLE,
		_AM_RSSC_CONF_SHOW_MODE_DATE_LONG   => RSSC_C_DATE_INT_LONG,
		);

	$config[147]['name']        = 'block_headline_show_thumb';
	$config[147]['catid']       = 0;
	$config[147]['title']       = '_AM_RSSC_CONF_SHOW_THUMB';
	$config[147]['description'] = '_AM_RSSC_CONF_SHOW_THUMB_DSC';
	$config[147]['formtype']    = 'text';
	$config[147]['valuetype']   = 'int';
	$config[147]['default']     = 1;

//---------------------------------------------------------
// block blog config
//---------------------------------------------------------
	$config[41]['name']      = 'block_blog_lid';
	$config[41]['catid']     = 0;
	$config[41]['title']       = '_AM_RSSC_CONF_SHOW_BLOG_LID';
//	$config[41]['description'] = '_AM_RSSC_CONF_SHOW_BLOG_LID_DSC';
	$config[41]['formtype']  = 'text';
	$config[41]['valuetype'] = 'int';
	$config[41]['default']   = 0;

	$config[42]['name']      = 'block_blog_perpage';
	$config[42]['catid']     = 0;
	$config[42]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE';
//	$config[42]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC';
	$config[42]['formtype']  = 'text';
	$config[42]['valuetype'] = 'int';
	$config[42]['default']   = 10;

	$config[43]['name']      = 'block_blog_max_title';
	$config[43]['catid']     = 0;
	$config[43]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[43]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[43]['formtype']  = 'text';
	$config[43]['valuetype'] = 'int';
	$config[43]['default']   = -1;

	$config[44]['name']      = 'block_blog_max_summary';
	$config[44]['catid']     = 0;
	$config[44]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[44]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[44]['formtype']  = 'text';
	$config[44]['valuetype'] = 'int';
	$config[44]['default']   = 150;

	$config[45]['name']      = 'block_blog_order';
	$config[45]['catid']     = 0;
	$config[45]['title']       = '_AM_RSSC_CONF_SHOW_ORDER';
//	$config[45]['description'] = '_AM_RSSC_CONF_SHOW_ORDER_DESC';
	$config[45]['formtype']  = 'radio_select';
	$config[45]['valuetype'] = 'text';
	$config[45]['default']   = RSSC_C_ORDER_INT_PUBLISHED;
	$config[45]['options']   = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

	$config[83]['name']        = 'block_blog_max_content';
	$config[83]['catid']       = 0;
	$config[83]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[83]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[83]['formtype']    = 'text';
	$config[83]['valuetype']   = 'int';
	$config[83]['default']     = -1;

	$config[87]['name']      = 'block_blog_num_content';
	$config[87]['catid']     = 0;
	$config[87]['title']       = '_AM_RSSC_CONF_SHOW_NUM_CONTENT';
	$config[87]['description'] = '_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC';
	$config[87]['formtype']  = 'text';
	$config[87]['valuetype'] = 'int';
	$config[87]['default']   = 1;

	$config[143]['name']      = 'block_blog_mode_date';
	$config[143]['catid']     = 0;
	$config[143]['title']       = '_AM_RSSC_CONF_SHOW_MODE_DATE';
//	$config[143]['description'] = '_AM_RSSC_CONF_SHOW_MODE_DATE_DSC';
	$config[143]['formtype']  = 'radio_select';
	$config[143]['valuetype'] = 'int';
	$config[143]['default']   = 1;
	$config[143]['options']   = array(
		_AM_RSSC_CONF_SHOW_MODE_DATE_NON    => RSSC_C_DATE_INT_NON,
		_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT  => RSSC_C_DATE_INT_SHORT,
		_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE => RSSC_C_DATE_INT_MIDDLE,
		_AM_RSSC_CONF_SHOW_MODE_DATE_LONG   => RSSC_C_DATE_INT_LONG,
		);

	$config[148]['name']        = 'block_blog_show_thumb';
	$config[148]['catid']       = 0;
	$config[148]['title']       = '_AM_RSSC_CONF_SHOW_THUMB';
	$config[148]['description'] = '_AM_RSSC_CONF_SHOW_THUMB_DSC';
	$config[148]['formtype']    = 'text';
	$config[148]['valuetype']   = 'int';
	$config[148]['default']     = 1;

//---------------------------------------------------------
// bin refresh
//---------------------------------------------------------
	$config[50]['name']      = 'bin_pass';
	$config[50]['catid']     = 2;
	$config[50]['title']       = '_HAPPY_LINUX_CONF_BIN_PASS';
	$config[50]['formtype']  = 'text';
	$config[50]['valuetype'] = 'text';
	$config[50]['default']   = xoops_makepass();

	$config[51]['name']      = 'bin_send';
	$config[51]['catid']     = 2;
	$config[51]['title']       = '_HAPPY_LINUX_CONF_BIN_SEND';
	$config[51]['formtype']  = 'yesno';
	$config[51]['valuetype'] = 'int';
	$config[51]['default']   = 1;

	$config[52]['name']      = 'bin_mailto';
	$config[52]['catid']     = 2;
	$config[52]['title']       = '_HAPPY_LINUX_CONF_BIN_MAILTO';
	$config[52]['formtype']  = 'text';
	$config[52]['valuetype'] = 'text';
	$config[52]['default']   = $adminmail;

//---------------------------------------------------------
// index
//---------------------------------------------------------
	$config[61]['name']        = 'index_desc';
	$config[61]['catid']       = 3;
	$config[61]['title']       = '_AM_RSSC_CONF_INDEX_DESC';
	$config[61]['description'] = '_AM_RSSC_CONF_INDEX_DESC_DSC';
	$config[61]['formtype']    = 'textarea';
	$config[61]['valuetype']   = 'text';
	$config[61]['default']     = _AM_RSSC_CONF_INDEX_DESC_DEFAULT;

//---------------------------------------------------------
// main config (71-79) (91-99)
// blog config (81-89)
//---------------------------------------------------------

//---------------------------------------------------------
// proxy server
//---------------------------------------------------------
	$config[101]['name']        = 'proxy_use';
	$config[101]['catid']       = 10;
	$config[101]['title']       = '_AM_RSSC_CONF_PROXY_USE';
//	$config[101]['description'] = '_AM_RSSC_CONF_PROXY_USE_DESC';
	$config[101]['formtype']    = 'yesno';
	$config[101]['valuetype']   = 'int';
	$config[101]['default']     = 0;

	$config[102]['name']        = 'proxy_host';
	$config[102]['catid']       = 10;
	$config[102]['title']       = '_AM_RSSC_CONF_PROXY_HOST';
//	$config[102]['description'] = '_AM_RSSC_CONF_PROXY_HOST_DESC';
	$config[102]['formtype']    = 'text';
	$config[102]['valuetype']   = 'text';
	$config[102]['default']     = '';

	$config[103]['name']        = 'proxy_port';
	$config[103]['catid']       = 10;
	$config[103]['title']       = '_AM_RSSC_CONF_PROXY_PORT';
//	$config[103]['description'] = '_AM_RSSC_CONF_PROXY_PORT_DESC';
	$config[103]['formtype']    = 'text';
	$config[103]['valuetype']   = 'text';
	$config[103]['default']     = '8080';

	$config[104]['name']        = 'proxy_user';
	$config[104]['catid']       = 10;
	$config[104]['title']       = '_AM_RSSC_CONF_PROXY_USER';
	$config[104]['description'] = '_AM_RSSC_CONF_PROXY_USER_DESC';
	$config[104]['formtype']    = 'text';
	$config[104]['valuetype']   = 'text';
	$config[104]['default']     = '';

	$config[105]['name']        = 'proxy_pass';
	$config[105]['catid']       = 10;
	$config[105]['title']       = '_AM_RSSC_CONF_PROXY_PASS';
	$config[105]['description'] = '_AM_RSSC_CONF_PROXY_PASS_DESC';
	$config[105]['formtype']    = 'text';
	$config[105]['valuetype']   = 'text';
	$config[105]['default']     = '';

//---------------------------------------------------------
// content filter
//---------------------------------------------------------
	$config[111]['name']        = 'link_use';
	$config[111]['catid']       = 11;
	$config[111]['title']       = '_AM_RSSC_CONF_LINK_USE';
	$config[111]['description'] = '_AM_RSSC_CONF_LINK_USE_DESC';
	$config[111]['formtype']    = 'yesno';
	$config[111]['valuetype']   = 'int';
	$config[111]['default']     = 1;

	$config[112]['name']        = 'white_use';
	$config[112]['catid']       = 11;
	$config[112]['title']       = '_AM_RSSC_CONF_WHITE_USE';
	$config[112]['description'] = '_AM_RSSC_CONF_WHITE_USE_DESC';
	$config[112]['formtype']    = 'yesno';
	$config[112]['valuetype']   = 'int';
	$config[112]['default']     = 0;

	$config[113]['name']        = 'black_use';
	$config[113]['catid']       = 11;
	$config[113]['title']       = '_AM_RSSC_CONF_BLACK_USE';
	$config[113]['description'] = '_AM_RSSC_CONF_BLACK_USE_DESC';
	$config[113]['formtype']    = 'radio_select';
	$config[113]['valuetype']   = 'int';
	$config[113]['default']     = 0;
	$config[113]['options']   = array(
		_AM_RSSC_CONF_BLACK_USE_NO    => 0,
		_AM_RSSC_CONF_BLACK_USE_YES   => 1,
		_AM_RSSC_CONF_BLACK_USE_LEARN => 2,
	);

	$config[114]['name']        = 'word_use';
	$config[114]['catid']       = 11;
	$config[114]['title']       = '_AM_RSSC_CONF_WORD_USE';
	$config[114]['description'] = '_AM_RSSC_CONF_WORD_USE_DESC';
	$config[114]['formtype']    = 'yesno';
	$config[114]['valuetype']   = 'int';
	$config[114]['default']     = 0;

	$config[115]['name']        = 'word_level';
	$config[115]['catid']       = 11;
	$config[115]['title']       = '_AM_RSSC_CONF_WORD_LEVEL';
//	$config[115]['description'] = '_AM_RSSC_CONF_WORD_LEVEL_DESC';
	$config[115]['formtype']    = 'text';
	$config[115]['valuetype']   = 'int';
	$config[115]['default']     = 100;

	$config[116]['name']        = 'feed_save';
	$config[116]['catid']       = 11;
	$config[116]['title']       = '_AM_RSSC_CONF_FEED_SAVE';
	$config[116]['description'] = '_AM_RSSC_CONF_FEED_SAVE_DESC';
	$config[116]['formtype']    = 'radio_select';
	$config[116]['valuetype']   = 'int';
	$config[116]['default']     = 0;
	$config[116]['options']   = array(
		_AM_RSSC_CONF_FEED_SAVE_NO   => 0,
		_AM_RSSC_CONF_FEED_SAVE_YES  => 1,
	);

	$config[117]['name']        = 'log_use';
	$config[117]['catid']       = 11;
	$config[117]['title']       = '_AM_RSSC_CONF_LOG_USE';
	$config[117]['description'] = '_AM_RSSC_CONF_LOG_USE_DESC';
	$config[117]['formtype']    = 'yesno';
	$config[117]['valuetype']   = 'int';
	$config[117]['default']     = 0;

	$config[121]['name']        = 'white_count';
	$config[121]['catid']       = 11;
	$config[121]['title']       = '_AM_RSSC_CONF_WHITE_COUNT';
	$config[121]['description'] = '_AM_RSSC_CONF_WHITE_COUNT_DESC';
	$config[121]['formtype']    = 'yesno';
	$config[121]['valuetype']   = 'int';
	$config[121]['default']     = 0;

	$config[122]['name']        = 'black_count';
	$config[122]['catid']       = 11;
	$config[122]['title']       = '_AM_RSSC_CONF_BLACK_COUNT';
	$config[122]['description'] = '_AM_RSSC_CONF_BLACK_COUNT_DESC';
	$config[122]['formtype']    = 'yesno';
	$config[122]['valuetype']   = 'int';
	$config[122]['default']     = 0;

	$config[123]['name']        = 'word_count';
	$config[123]['catid']       = 11;
	$config[123]['title']       = '_AM_RSSC_CONF_WORD_COUNT';
	$config[123]['description'] = '_AM_RSSC_CONF_WORD_COUNT_DESC';
	$config[123]['formtype']    = 'yesno';
	$config[123]['valuetype']   = 'int';
	$config[123]['default']     = 0;

	$config[124]['name']        = 'black_auto';
	$config[124]['catid']       = 11;
	$config[124]['title']       = '_AM_RSSC_CONF_BLACK_AUTO';
	$config[124]['description'] = '_AM_RSSC_CONF_BLACK_AUTO_DESC';
	$config[124]['formtype']    = 'yesno';
	$config[124]['valuetype']   = 'int';
	$config[124]['default']     = 0;

	$config[125]['name']        = 'word_auto';
	$config[125]['catid']       = 11;
	$config[125]['title']       = '_AM_RSSC_CONF_WORD_AUTO';
	$config[125]['description'] = '_AM_RSSC_CONF_WORD_AUTO_DESC';
	$config[125]['formtype']    = 'radio_select';
	$config[125]['valuetype']   = 'int';
	$config[125]['default']     = 0;
	$config[125]['options']   = array(
		_AM_RSSC_CONF_WORD_AUTO_NON    => 0,
		_AM_RSSC_CONF_WORD_AUTO_SYMBOL => 1,
		_AM_RSSC_CONF_WORD_AUTO_KAKASI => 2,
	);

	$config[131]['name']        = 'html_get';
	$config[131]['catid']       = 13;
	$config[131]['title']       = '_AM_RSSC_CONF_HTML_GET';
	$config[131]['description'] = '_AM_RSSC_CONF_HTML_GET_DESC';
	$config[131]['formtype']    = 'radio_select';
	$config[131]['valuetype']   = 'int';
	$config[131]['default']     = 0;
	$config[131]['options']   = array(
		_AM_RSSC_CONF_HTML_GET_NO     => 0,
		_AM_RSSC_CONF_HTML_GET_YES    => 1,
		_AM_RSSC_CONF_HTML_GET_BLACK  => 2,
	);

	$config[132]['name']        = 'html_lenghth';
	$config[132]['catid']       = 13;
	$config[132]['title']       = '_AM_RSSC_CONF_HTML_LIMIT';
	$config[132]['description'] = '_AM_RSSC_CONF_HTML_LIMIT_DESC';
	$config[132]['formtype']    = 'text';
	$config[132]['valuetype']   = 'int';
	$config[132]['default']     = '1000';

	$config[133]['name']        = 'join_prev';
	$config[133]['catid']       = 13;
	$config[133]['title']       = '_AM_RSSC_CONF_JOIN_PREV';
	$config[133]['description'] = '_AM_RSSC_CONF_JOIN_PREV_DESC';
	$config[133]['formtype']    = 'yesno';
	$config[133]['valuetype']   = 'int';
	$config[133]['default']     = 0;

	$config[134]['name']        = 'join_glue';
	$config[134]['catid']       = 13;
	$config[134]['title']       = '_AM_RSSC_CONF_JOIN_GLUE';
	$config[134]['description'] = '_AM_RSSC_CONF_JOIN_GLUE_DESC';
	$config[134]['formtype']    = 'text';
	$config[134]['valuetype']   = 'text';
	$config[134]['default']     = '';

	$config[135]['name']        = 'char_length';
	$config[135]['catid']       = 13;
	$config[135]['title']       = '_AM_RSSC_CONF_CHAR_LENGTH';
	$config[135]['description'] = '_AM_RSSC_CONF_CHAR_LENGTH_DESC';
	$config[135]['formtype']    = 'text';
	$config[135]['valuetype']   = 'int';
	$config[135]['default']     = '8';

	$config[136]['name']        = 'kakasi_path';
	$config[136]['catid']       = 13;
	$config[136]['title']       = '_AM_RSSC_CONF_KAKASI_PATH';
//	$config[136]['description'] = '_AM_RSSC_CONF_KAKASI_PATH_DESC';
	$config[136]['formtype']    = 'text';
	$config[136]['valuetype']   = 'text';
	$config[136]['default']     = '/usr/local/bin/kakasi';

	$config[137]['name']        = 'kakasi_mode';
	$config[137]['catid']       = 13;
	$config[137]['title']       = '_AM_RSSC_CONF_KAKASI_MODE';
//	$config[137]['description'] = '_AM_RSSC_CONF_KAKASI_MODE_DESC';
	$config[137]['formtype']    = 'radio_select';
	$config[137]['valuetype']   = 'int';
	$config[137]['default']     = '0';
	$config[137]['options']   = array(
		_AM_RSSC_CONF_KAKASI_MODE_FILE => 0,
		_AM_RSSC_CONF_KAKASI_MODE_PIPE => 1,
	);

	$config[138]['name']        = 'word_limit';
	$config[138]['catid']       = 13;
	$config[138]['title']       = '_AM_RSSC_CONF_WORD_LIMIT';
	$config[138]['description'] = '_AM_RSSC_CONF_WORD_LIMIT_DESC';
	$config[138]['formtype']    = 'text';
	$config[138]['valuetype']   = 'int';
	$config[138]['default']     = '1000';

//---------------------------------------------------------
// html out
//---------------------------------------------------------
	$config[151]['name']        = 'html_script';
	$config[151]['catid']       = 15;
	$config[151]['title']       = '_AM_RSSC_CONF_HTML_SCRIPT';
	$config[151]['description'] = '_AM_RSSC_CONF_HTML_SCRIPT_DESC';
	$config[151]['formtype']    = 'radio_select';
	$config[151]['valuetype']   = 'int';
	$config[151]['default']     = 2;
	$config[151]['options']    = array(
		_AM_RSSC_CONF_HTML_NON    => 0,
		_AM_RSSC_CONF_HTML_SHOW   => 1,
		_AM_RSSC_CONF_HTML_REMOVE => 2,
	);

	$config[152]['name']        = 'html_style';
	$config[152]['catid']       = 15;
	$config[152]['title']       = '_AM_RSSC_CONF_HTML_STYLE';
	$config[152]['description'] = '_AM_RSSC_CONF_HTML_STYLE_DESC';
	$config[152]['formtype']    = 'radio_select';
	$config[152]['valuetype']   = 'int';
	$config[152]['default']     = 2;
	$config[152]['options']    = array(
		_AM_RSSC_CONF_HTML_NON    => 0,
		_AM_RSSC_CONF_HTML_SHOW   => 1,
		_AM_RSSC_CONF_HTML_REMOVE => 2,
	);

	$config[153]['name']        = 'html_link';
	$config[153]['catid']       = 15;
	$config[153]['title']       = '_AM_RSSC_CONF_HTML_LINK';
	$config[153]['description'] = '_AM_RSSC_CONF_HTML_LINK_DESC';
	$config[153]['formtype']    = 'radio_select';
	$config[153]['valuetype']   = 'int';
	$config[153]['default']     = 2;
	$config[153]['options']    = array(
		_AM_RSSC_CONF_HTML_NON    => 0,
		_AM_RSSC_CONF_HTML_SHOW   => 1,
		_AM_RSSC_CONF_HTML_REMOVE => 2,
	);

	$config[154]['name']        = 'html_comment';
	$config[154]['catid']       = 15;
	$config[154]['title']       = '_AM_RSSC_CONF_HTML_COMMENT';
	$config[154]['description'] = '_AM_RSSC_CONF_HTML_COMMENT_DESC';
	$config[154]['formtype']    = 'radio_select';
	$config[154]['valuetype']   = 'int';
	$config[154]['default']     = 2;
	$config[154]['options']    = array(
		_AM_RSSC_CONF_HTML_NON    => 0,
		_AM_RSSC_CONF_HTML_SHOW   => 1,
		_AM_RSSC_CONF_HTML_REMOVE => 2,
	);

	$config[155]['name']        = 'html_cdata';
	$config[155]['catid']       = 15;
	$config[155]['title']       = '_AM_RSSC_CONF_HTML_CDATA';
	$config[155]['description'] = '_AM_RSSC_CONF_HTML_CDATA_DESC';
	$config[155]['formtype']    = 'radio_select';
	$config[155]['valuetype']   = 'int';
	$config[155]['default']     = 2;
	$config[155]['options']    = array(
		_AM_RSSC_CONF_HTML_NON    => 0,
		_AM_RSSC_CONF_HTML_SHOW   => 1,
		_AM_RSSC_CONF_HTML_REMOVE => 2,
	);

	$config[156]['name']        = 'html_flag_other_tags';
	$config[156]['catid']       = 15;
	$config[156]['title']       = '_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS';
	$config[156]['description'] = '_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS_DESC';
	$config[156]['formtype']    = 'yesno';
	$config[156]['valuetype']   = 'int';
	$config[156]['default']     = 0;

	$config[157]['name']        = 'html_other_tags';
	$config[157]['catid']       = 15;
	$config[157]['title']       = '_AM_RSSC_CONF_HTML_OTHER_TAGS';
	$config[157]['description'] = '_AM_RSSC_CONF_HTML_OTHER_TAGS_DESC';
	$config[157]['formtype']    = 'text';
	$config[157]['valuetype']   = 'text';
	$config[157]['default']     = '';

	$config[158]['name']        = 'html_attr_onmouse';
	$config[158]['catid']       = 15;
	$config[158]['title']       = '_AM_RSSC_CONF_HTML_ATTR_ONMOUSE';
	$config[158]['description'] = '_AM_RSSC_CONF_HTML_ATTR_ONMOUSE_DESC';
	$config[158]['formtype']    = 'radio_select';
	$config[158]['valuetype']   = 'int';
	$config[158]['default']     = 1;
	$config[158]['options']    = array(
		_AM_RSSC_CONF_HTML_NON     => 0,
		_AM_RSSC_CONF_HTML_REPLACE => 1,
		_AM_RSSC_CONF_HTML_REMOVE  => 2,
	);

	$config[159]['name']        = 'html_attr_style';
	$config[159]['catid']       = 15;
	$config[159]['title']       = '_AM_RSSC_CONF_HTML_ATTR_STYLE';
	$config[159]['description'] = '_AM_RSSC_CONF_HTML_ATTR_STYLE_DESC';
	$config[159]['formtype']    = 'radio_select';
	$config[159]['valuetype']   = 'int';
	$config[159]['default']     = 1;
	$config[159]['options']    = array(
		_AM_RSSC_CONF_HTML_NON     => 0,
		_AM_RSSC_CONF_HTML_REPLACE => 1,
		_AM_RSSC_CONF_HTML_REMOVE  => 2,
	);

	$config[161]['name']        = 'html_javascript';
	$config[161]['catid']       = 15;
	$config[161]['title']       = '_AM_RSSC_CONF_HTML_JAVASCRIPT';
	$config[161]['description'] = '_AM_RSSC_CONF_HTML_JAVASCRIPT_DESC';
	$config[161]['formtype']    = 'radio_select';
	$config[161]['valuetype']   = 'int';
	$config[161]['default']     = 1;
	$config[161]['options']     = array(
		_AM_RSSC_CONF_HTML_NON     => 0,
		_AM_RSSC_CONF_HTML_REPLACE => 1,
		_AM_RSSC_CONF_HTML_REMOVE  => 2,
	);

//---------------------------------------------------------
// custom plugin
//---------------------------------------------------------
	$config[171]['name']        = 'pre_plugin';
	$config[171]['catid']       = 17;
	$config[171]['title']       = '_RSSC_PRE_PLUGIN';
	$config[171]['description'] = _AM_RSSC_PRE_PLUGIN_DESC.'<br />'._AM_RSSC_PLUGIN_DESC_2;
	$config[171]['formtype']    = 'textarea';
	$config[171]['valuetype']   = 'text';
	$config[171]['default']     = '';

	$config[172]['name']        = 'post_plugin';
	$config[172]['catid']       = 17;
	$config[172]['title']       = '_RSSC_POST_PLUGIN';
	$config[172]['description'] = _AM_RSSC_POST_PLUGIN_DESC.'<br />'._AM_RSSC_PLUGIN_DESC_2;
	$config[172]['formtype']    = 'textarea';
	$config[172]['valuetype']   = 'text';
	$config[172]['default']     = '';

//---------------------------------------------------------
// map
//---------------------------------------------------------
	$config[181]['name']        = 'webmap_dirname';
	$config[181]['catid']       = 18;
	$config[181]['title']       = '_AM_RSSC_CONF_WEBMAP_DIRNAME';
//	$config[181]['description'] = '_AM_RSSC_CONF_WEBMAP_DIRNAME_DESC';
	$config[181]['formtype']    = 'text';
/* CDS Patch. RSS Center. 1.02. 5. BOF */
	$config[181]['valuetype']   = 'text';
/* CDS Patch. RSS Center. 1.02. 5. EOF */
	$config[181]['default']     = 'webmap';

//---------------------------------------------------------
// main map config
//---------------------------------------------------------
	$config[191]['name']      = 'main_map_order';
	$config[191]['catid']     = 0;
	$config[191]['title']       = '_AM_RSSC_CONF_SHOW_ORDER';
//	$config[191]['description'] = '_AM_RSSC_CONF_SHOW_ORDER_DESC';
	$config[191]['formtype']  = 'radio_select';
	$config[191]['valuetype'] = 'text';
	$config[191]['default']   = RSSC_C_ORDER_INT_UPDATED;
	$config[191]['options']   = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

	$config[192]['name']      = 'main_map_perpage';
	$config[192]['catid']     = 0;
	$config[192]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE';
//	$config[192]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC';
	$config[192]['formtype']  = 'text';
	$config[192]['valuetype'] = 'int';
	$config[192]['default']   = 100;

	$config[193]['name']      = 'main_map_max_title';
	$config[193]['catid']     = 0;
	$config[193]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[193]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[193]['formtype']  = 'text';
	$config[193]['valuetype'] = 'int';
	$config[193]['default']   = -1;

	$config[194]['name']      = 'main_map_max_summary';
	$config[194]['catid']     = 0;
	$config[194]['title']       = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY';
	$config[194]['description'] = '_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC';
	$config[194]['formtype']  = 'text';
	$config[194]['valuetype'] = 'int';
	$config[194]['default']   = 250;

	$config[195]['name']        = 'main_map_title_html';
	$config[195]['catid']       = 0;
	$config[195]['title']       = '_AM_RSSC_CONF_SHOW_TITLE_HTML';
	$config[195]['description'] = '_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC';
	$config[195]['formtype']    = 'yesno';
	$config[195]['valuetype']   = 'int';
	$config[195]['default']     = 0;

	$config[196]['name']        = 'main_map_content_html';
	$config[196]['catid']       = 0;
	$config[196]['title']       = '_AM_RSSC_CONF_SHOW_CONTENT_HTML';
	$config[196]['description'] = '_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC';
	$config[196]['formtype']    = 'yesno';
	$config[196]['valuetype']   = 'int';
	$config[196]['default']     = 0;

	$config[197]['name']        = 'main_map_max_content';
	$config[197]['catid']       = 0;
	$config[197]['title']       = '_AM_RSSC_CONF_SHOW_MAX_CONTENT';
	$config[197]['description'] = '_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC';
	$config[197]['formtype']    = 'text';
	$config[197]['valuetype']   = 'int';
	$config[197]['default']     = 0;

	$config[198]['name']        = 'main_map_info_max';
	$config[198]['catid']       = 0;
	$config[198]['title']       = '_AM_RSSC_CONF_SHOW_INFO_MAX';
	$config[198]['description'] = '_AM_RSSC_CONF_SHOW_INFO_MAX_DSC';
	$config[198]['formtype']    = 'text';
	$config[198]['valuetype']   = 'int';
	$config[198]['default']     = 100;

	$config[199]['name']        = 'main_map_info_width';
	$config[199]['catid']       = 0;
	$config[199]['title']       = '_AM_RSSC_CONF_SHOW_INFO_WIDTH';
	$config[199]['description'] = '_AM_RSSC_CONF_SHOW_INFO_WIDTH_DSC';
	$config[199]['formtype']    = 'text';
	$config[199]['valuetype']   = 'int';
	$config[199]['default']     = 20;

	$config[211]['name']        = 'main_map_show_site';
	$config[211]['catid']       = 0;
	$config[211]['title']       = '_AM_RSSC_CONF_SHOW_SITE';
	$config[211]['description'] = '_AM_RSSC_CONF_SHOW_SITE_DSC';
	$config[211]['formtype']    = 'text';
	$config[211]['valuetype']   = 'int';
	$config[211]['default']     = 1;

	$config[212]['name']        = 'main_map_show_icon';
	$config[212]['catid']       = 0;
	$config[212]['title']       = '_AM_RSSC_CONF_SHOW_ICON';
	$config[212]['description'] = '_AM_RSSC_CONF_SHOW_ICON_DSC';
	$config[212]['formtype']    = 'text';
	$config[212]['valuetype']   = 'int';
	$config[212]['default']     = 1;

	$config[213]['name']        = 'main_map_show_thumb';
	$config[213]['catid']       = 0;
	$config[213]['title']       = '_AM_RSSC_CONF_SHOW_THUMB';
	$config[213]['description'] = '_AM_RSSC_CONF_SHOW_THUMB_DSC';
	$config[213]['formtype']    = 'text';
	$config[213]['valuetype']   = 'int';
	$config[213]['default']     = 1;

//---------------------------------------------------------
// block map config
//---------------------------------------------------------
	$config[201]['name']      = 'block_map_perpage';
	$config[201]['catid']     = 0;
	$config[201]['title']       = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE';
//	$config[201]['description'] = '_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC';
	$config[201]['formtype']  = 'text';
	$config[201]['valuetype'] = 'int';
	$config[201]['default']   = 100;

	$config[202]['name']      = 'block_map_max_title';
	$config[202]['catid']     = 0;
	$config[202]['title']       = '_AM_RSSC_CONF_SHOW_MAX_TITLE';
	$config[202]['description'] = '_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC';
	$config[202]['formtype']  = 'text';
	$config[202]['valuetype'] = 'int';
	$config[202]['default']   = 40;

	$config[203]['name']      = 'block_map_order';
	$config[203]['catid']     = 0;
	$config[203]['title']       = '_AM_RSSC_CONF_SHOW_ORDER';
//	$config[203]['description'] = '_AM_RSSC_CONF_SHOW_ORDER_DESC';
	$config[203]['formtype']  = 'radio_select';
	$config[203]['valuetype'] = 'text';
	$config[203]['default']   = RSSC_C_ORDER_INT_UPDATED;
	$config[203]['options']   = array(
		_AM_RSSC_CONF_SHOW_ORDER_UPDATED   => RSSC_C_ORDER_INT_UPDATED,
		_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED => RSSC_C_ORDER_INT_PUBLISHED
		);

	$config[204]['name']        = 'block_map_info_max';
	$config[204]['catid']       = 0;
	$config[204]['title']       = '_AM_RSSC_CONF_SHOW_INFO_MAX';
	$config[204]['description'] = '_AM_RSSC_CONF_SHOW_INFO_MAX_DSC';
	$config[204]['formtype']    = 'text';
	$config[204]['valuetype']   = 'int';
	$config[204]['default']     = 100;

	$config[205]['name']        = 'block_map_info_width';
	$config[205]['catid']       = 0;
	$config[205]['title']       = '_AM_RSSC_CONF_SHOW_INFO_WIDTH';
	$config[205]['description'] = '_AM_RSSC_CONF_SHOW_INFO_WIDTH_DSC';
	$config[205]['formtype']    = 'text';
	$config[205]['valuetype']   = 'int';
	$config[205]['default']     = 20;

//---------------------------------------------------------
// 140 block
// 220 main
//---------------------------------------------------------
	return $config;
}

// --- class end ---
}

// === class end ===
}

?>