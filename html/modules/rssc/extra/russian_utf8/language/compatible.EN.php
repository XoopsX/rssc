<?php
// $Id: compatible.EN.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2007-10-10 K.OHWADA
// enclusure in link table

// 2007-07-01 K.OHWADA
// word table

// 2006-11-08 K.OHWADA
// proxy server

// 2006-09-20 K.OHWWADA
// error message
// show content with html
// table manage

// 2006-07-08 K.OHWADA
// support podcast
// link exist check

// 2006-06-04 K.OHWADA
// this is new file

//=========================================================
// RSS Center Module
// 2006-06-04 K.OHWADA
//=========================================================

//---------------------------------------------------------
// compatible for v1.0
//---------------------------------------------------------
if( !defined('_RSSC_MAP') ) 
{
// map
	define('_RSSC_MAP','GoogleMap');

// link table
	define('_RSSC_LINK_ICON',  'Icon');
	define('_RSSC_LINK_GICON_ID', 'GoogleMap Icon ID');

// feed table
	define('_RSSC_FEED_GEO_LAT',  'Latitude');
	define('_RSSC_FEED_GEO_LONG', 'Longitude');
	define('_RSSC_FEED_MEDIA_CONTENT_URL',    'Content URL');
	define('_RSSC_FEED_MEDIA_CONTENT_TYPE',   'Content Type');
	define('_RSSC_FEED_MEDIA_CONTENT_MEDIUM', 'Content Medium');
	define('_RSSC_FEED_MEDIA_CONTENT_WIDTH',  'Content Width');
	define('_RSSC_FEED_MEDIA_CONTENT_HEIGHT', 'Content Height');
	define('_RSSC_FEED_MEDIA_THUMBNAIL_URL',    'Thumbnail URL');
	define('_RSSC_FEED_MEDIA_THUMBNAIL_WIDTH',  'Thumbnail Width');
	define('_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT', 'Thumbnail Height');
}

if( !defined('_AM_RSSC_FORM_MAP') ) 
{
// map
	define('_AM_RSSC_FORM_MAP', 'Google Map  Setting');

// config
	define('_AM_RSSC_CONF_WEBMAP_DIRNAME', 'webmap dirname');
	define('_AM_RSSC_CONF_WEBMAP_DIRNAME_DESC', 'Set dirname of webmap module');
	define('_AM_RSSC_CONF_SHOW_INFO_MAX','The maximum number of characters of Marker info');
	define('_AM_RSSC_CONF_SHOW_INFO_MAX_DSC', 'HTML tags are stripped<br /><b>-1</b> is unlimited');
	define('_AM_RSSC_CONF_SHOW_INFO_WIDTH','The maximum number of characters of Marker info in line');
	define('_AM_RSSC_CONF_SHOW_INFO_WIDTH_DSC', 'Insert a new line, when more than this number<br /><b>-1</b> is unlimited');
	define('_AM_RSSC_CONF_SHOW_ICON','Show Icon');
	define('_AM_RSSC_CONF_SHOW_ICON_DSC', 'when "YES", show Icon');
	define('_AM_RSSC_CONF_SHOW_THUMB','Show Image');
	define('_AM_RSSC_CONF_SHOW_THUMB_DSC', 'when "YES", show thmbnail image');

// link form
	define('_AM_RSSC_LINK_ICON_SEL',  'Select Icon');
	define('_AM_RSSC_LINK_GICON_SEL', 'Select GoogleMap Icon');
}

//---------------------------------------------------------
// compatible for v0.8
//---------------------------------------------------------
if( !defined('_RSSC_PLUGIN_LIST') ) 
{
// plugin list
	define('_RSSC_PLUGIN_LIST', 'Plugin List');
	define('_RSSC_PLUGIN_NAME', 'Plugin Name');
	define('_RSSC_PLUGIN_DESCRIPTION', 'Description');
	define('_RSSC_PLUGIN_USAGE', 'Usage');

// link table
	define('_RSSC_PRE_PLUGIN', 'Pre-Processing Plugin');
	define('_RSSC_POST_PLUGIN','Post-Processing Plugin');
}

if( !defined('_AM_RSSC_FORM_HTMLOUT') ) 
{
// menu
	define('_AM_RSSC_FORM_HTMLOUT',       'HTML Output Setting');
	define('_AM_RSSC_FORM_HTMLOUT_DESC',  "The processing of content ,when 'Use of HTML tag of the content' is 'Yes'<br />All tags are removed ,when 'No' <br />it recommends to remove or replace JavaScript and the relation, to prevent XSS (Cross Site Scripting) ");
	define('_AM_RSSC_FORM_CUSTOM_PLUGIN', 'Custom Plugins');

// html out
	define('_AM_RSSC_CONF_HTML_NON',    'Noting to do');
	define('_AM_RSSC_CONF_HTML_SHOW',   'Sanitize and show in HTML');
	define('_AM_RSSC_CONF_HTML_REMOVE', 'Remove');
	define('_AM_RSSC_CONF_HTML_REPLACE', 'Replace strings');
	define('_AM_RSSC_CONF_HTML_SCRIPT', 'script tag');
	define('_AM_RSSC_CONF_HTML_SCRIPT_DESC', "The processing of '&lt;script&gt;...&lt;/script&gt;' ");
	define('_AM_RSSC_CONF_HTML_STYLE', 'style tag');
	define('_AM_RSSC_CONF_HTML_STYLE_DESC', "The processing of '&lt;style&gt;...&lt;/style&gt;' ");
	define('_AM_RSSC_CONF_HTML_LINK', 'link tag');
	define('_AM_RSSC_CONF_HTML_LINK_DESC', "The processing of '&lt;link ... &gt;' ");
	define('_AM_RSSC_CONF_HTML_COMMENT', 'comment mark');
	define('_AM_RSSC_CONF_HTML_COMMENT_DESC', "The processing of '&lt;!-- ... --&gt;' ");
	define('_AM_RSSC_CONF_HTML_CDATA', 'CDATA mark');
	define('_AM_RSSC_CONF_HTML_CDATA_DESC', "The processing of '&lt;![CDATA[ ... ]]&gt;' ");
	define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE', 'onMouse attribute');
	define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE_DESC', "The processing of 'onmouseover=\"...\"' or 'onclick=\"...\"' <br />replace as 'on_mouseover_=\"...\"', when 'Replace' ");
	define('_AM_RSSC_CONF_HTML_ATTR_STYLE', 'style attribute');
	define('_AM_RSSC_CONF_HTML_ATTR_STYLE_DESC', "The processing of 'style=\"...\"' or 'class=\"...\"' <br />replace as 'style_=\"...\"', when 'Replace' ");
	define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS', 'Remove other tags');
	define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS_DESC', "Rremove or not '&lt;img ... &gt;' '&lt;a ... &gt;' '&lt;link ... &gt;' etc ");
	define('_AM_RSSC_CONF_HTML_OTHER_TAGS', 'allow tags');
	define('_AM_RSSC_CONF_HTML_OTHER_TAGS_DESC', "Enter the tag not to remove, when 'Remove other tags' is 'Yes' <br /> exsample: <img><a> ");
	define('_AM_RSSC_CONF_HTML_JAVASCRIPT', 'JavaScriprt stings');
	define('_AM_RSSC_CONF_HTML_JAVASCRIPT_DESC', "The processing of stings as 'JavaScriprt' <br />replace as 'java_script', when 'Replace' ");

// plugin
	define('_AM_RSSC_PRE_PLUGIN_DESC', 'Execute before storing in the database');
	define('_AM_RSSC_POST_PLUGIN_DESC', 'Execute after reading in the database');
	define('_AM_RSSC_PLUGIN_DESC_2', 'Separate each with <b>|</b>, when specifying two or more plugins ');

	define('_AM_RSSC_PLUGIN_TEST', 'Test fo plugins');
	define('_AM_RSSC_PLUGIN', 'Plugins');
	define('_AM_RSSC_PLUGIN_TESTDATA', 'Test data');
	define('_AM_RSSC_PLUGIN_TESTDATA_DESC', 'Enter the form of associative array');
}

//---------------------------------------------------------
// compatible for v0.7
//---------------------------------------------------------
if( !defined('_RSSC_LINK_ENCLOSURE') ) 
{
// link table
	define('_RSSC_LINK_ENCLOSURE','Operation of enclusure tag');
	define('_RSSC_LINK_ENCLOSURE_NON','Not use');
	define('_RSSC_LINK_ENCLOSURE_POD','Assume PodCast');
	define('_RSSC_LINK_CENSOR', 'Words to censor in title');
	define('_RSSC_LINK_PLUGIN','Plugin');

// black & white table
	define('_RSSC_BW_CACHE','Cache of feed count');
	define('_RSSC_BW_CTIME','Cache Time of feed count');

// keyword manage
	define('_RSSC_KEYWORD','Keyword');
}

if( !defined('_AM_RSSC_CONF_SHOW_MODE_DATE') ) 
{
// config
	define('_AM_RSSC_CONF_SHOW_MODE_DATE', 'Date Mode');
	define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON',    'Not Show');
	define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT',  'short');
	define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', 'middle');
	define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG',   'long');
	define('_AM_RSSC_CONF_SHOW_SITE', 'Site Information');
	define('_AM_RSSC_CONF_SHOW_SITE_DSC', 'when "YES", show site title and url');

// link table
	define('_AM_RSSC_LINK_CENSOR_DESC', 'Separate each with a <b>|</b><br />case sensitive');
}

//---------------------------------------------------------
// compatible for v0.6
//---------------------------------------------------------
if( !defined('_RSSC_WORD_ID') ) 
{
// word table
	define('_RSSC_WORD_ID','Word ID');
	define('_RSSC_WORD_WORD','Reject Word');
	define('_RSSC_WORD_POINT','Point');
	define('_RSSC_ACT','Status');
	define('_RSSC_ACT_NON','Invalid');
	define('_RSSC_ACT_ACT','Valid');
	define('_RSSC_REG','Expression of URL');
	define('_RSSC_REG_NORMAL','Normal');
	define('_RSSC_REG_EXP','Regular Expression');
	define('_RSSC_FREQ_COUNT','Frequency Count');

// feed table
	define('_RSSC_FEED_ACT',     'Status');
	define('_RSSC_FEED_ACT_NON', 'Not Show');
	define('_RSSC_FEED_ACT_VIEW','Show');

// link table
	define('_RSSC_LTYPE_NON','Not refresh feed');
	define('_RSSC_LTYPE_SEARCH','Search Site');
	define('_RSSC_LTYPE_NORMAL','Normal');

	define('_RSSC_XML_URL','RDF/RSS/ATOM URL');
}

if( !defined('_AM_RSSC_LIST_WORD') ) 
{
// word_list
	define('_AM_RSSC_LIST_WORD','Reject Word List');
	define('_AM_RSSC_WORD_MANAGE','Reject Word Management');
	define('_AM_RSSC_ADD_WORD','Add Reject Word');
	define('_AM_RSSC_MOD_WORD','Modify Reject Word');
	define('_AM_RSSC_DEL_WORD','Delete Reject Word');
	define('_AM_RSSC_POINT_ASC', 'Little Point Order');
	define('_AM_RSSC_POINT_DESC','Much Point Order');
	define('_AM_RSSC_COUNT_ASC', 'Little Frequency Count Order');
	define('_AM_RSSC_COUNT_DESC','Much Frequency Count Order');
	define('_AM_RSSC_WORD_ASC', 'A-Z Order');
	define('_AM_RSSC_WORD_DESC','Z-A Order');
	define('_AM_RSSC_NON_ACT','Not Show List');
	define('_AM_RSSC_NON_ACT_ASC', 'Not Show ID Ascent');
	define('_AM_RSSC_NON_ACT_DESC','Not Show ID Descent');
	define('_AM_RSSC_WORD_ALREADY','This word is registered already');
	define('_AM_RSSC_WORD_SEARCH','Synonym Search');

// content filter
	define('_AM_RSSC_FORM_FILTER','Filter Setting');
	define('_AM_RSSC_FORM_FILTER_DESC','This filter judge to store or not into database when collecting feeds automatically');
	define('_AM_RSSC_CONF_LINK_USE','Use Link Table');
	define('_AM_RSSC_CONF_LINK_USE_DESC','Store when "Type" of Link Table is "Normal"');
	define('_AM_RSSC_CONF_WHITE_USE','Use White List');
	define('_AM_RSSC_CONF_WHITE_USE_DESC','Store when in white list');
	define('_AM_RSSC_CONF_BLACK_USE','Use Black List');
	define('_AM_RSSC_CONF_BLACK_USE_DESC','Not store when in black list<br />When select "Use", interrupt filtering process, if judge black<br />When select "Learning", continue filtering process, for purpose extracting words, if judge black');
	define('_AM_RSSC_CONF_BLACK_USE_NO','Not Use');
	define('_AM_RSSC_CONF_BLACK_USE_YES','Use');
	define('_AM_RSSC_CONF_BLACK_USE_LEARN','Learning');
	define('_AM_RSSC_CONF_WORD_USE','Use Reject Word List');
	define('_AM_RSSC_CONF_WORD_USE_DESC','Not Store when total point of word list exceed reject level');
	define('_AM_RSSC_CONF_WORD_LEVEL', 'Reject Level');
	define('_AM_RSSC_CONF_FEED_SAVE','Feed Save');
	define('_AM_RSSC_CONF_FEED_SAVE_DESC','Store or not into feed table when judge black.<br />When "Save", save in "not show" status.');
	define('_AM_RSSC_CONF_FEED_SAVE_NO', 'No Save');
	define('_AM_RSSC_CONF_FEED_SAVE_YES','Save');
	define('_AM_RSSC_CONF_LOG_USE','Use Log File');
	define('_AM_RSSC_CONF_LOG_USE_DESC','Write log file when judge black');
	define('_AM_RSSC_CONF_WHITE_COUNT','Count up White List');
	define('_AM_RSSC_CONF_WHITE_COUNT_DESC','Count up the matching record when match with white list');
	define('_AM_RSSC_CONF_BLACK_COUNT','Count up Black List');
	define('_AM_RSSC_CONF_BLACK_COUNT_DESC','Count up the matching record when match with blck list');
	define('_AM_RSSC_CONF_WORD_COUNT','Coun up Reject Word List');
	define('_AM_RSSC_CONF_WORD_COUNT_DESC','Count up the matching record when match with reject word list');
	define('_AM_RSSC_CONF_BLACK_AUTO','Add in Black List');
	define('_AM_RSSC_CONF_BLACK_AUTO_DESC','Add URL in black list automatically when judge black<br /><b>Notice</b> "status" is stored as "invalid"<br />Please change into "valid" when using');
	define('_AM_RSSC_CONF_WORD_AUTO','Add in Reject Word List');
	define('_AM_RSSC_CONF_WORD_AUTO_DESC','Extract words in the content automatically, and add words in reject word list automatically, when judge black<br /><b>Notice</b> "point" is stored as zero<br />Please change "point" when using');
	define('_AM_RSSC_CONF_WORD_AUTO_NON','Not Add');
	define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL','Extract by space or symbol');
	define('_AM_RSSC_CONF_WORD_AUTO_KAKASI','Extract by KAKASI: Japanese Only');

// word extract
	define('_AM_RSSC_FORM_WORD','Word Extract Setting');
	define('_AM_RSSC_CONF_JOIN_PREV', 'Word Join');
	define('_AM_RSSC_CONF_JOIN_PREV_DESC', 'join to forword and backword word, and make a phrase');
	define('_AM_RSSC_CONF_JOIN_GLUE', 'Word Spacing');
	define('_AM_RSSC_CONF_JOIN_GLUE_DESC', 'in English set space<br />in Japanese set noting');
	define('_AM_RSSC_CONF_KAKASI_PATH','Command Path of KAKASI');
	define('_AM_RSSC_CONF_KAKASI_MODE','Mode of KAKASI');
	define('_AM_RSSC_CONF_KAKASI_MODE_FILE','Use temporary file');
	define('_AM_RSSC_CONF_KAKASI_MODE_PIPE','Use UNIX pipe');
	define('_AM_RSSC_CONF_CHAR_LENGTH', 'The minimum number of characters');
	define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', 'The minimum number of characters to extact word');
	define('_AM_RSSC_CONF_WORD_LIMIT', 'The maxmum number of reject words');
	define('_AM_RSSC_CONF_WORD_LIMIT_DESC', 'Enter the maximum number of word stored in word table<br />Clears the older records, when it becomes more than this value<br /><b>0</b> is umlimited');
	define('_AM_RSSC_KAKASI_EXECUTABLE', 'kakasi is executable');
	define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'kakasi is not executable');
	define('_AM_RSSC_CONF_HTML_GET','Get HTML');
	define('_AM_RSSC_CONF_HTML_GET_DESC','get origin HTML data automatically, when judge with reject word list<br />When select "Use", the precision of the judgment is improved , but the execution time become long');
	define('_AM_RSSC_CONF_HTML_GET_NO','Not Use');
	define('_AM_RSSC_CONF_HTML_GET_YES','Use');
	define('_AM_RSSC_CONF_HTML_GET_BLACK','Use when jugde black');
	define('_AM_RSSC_CONF_HTML_LIMIT', 'The maxmum number of HTML characters');
	define('_AM_RSSC_CONF_HTML_LIMIT_DESC', 'The maxmum number of HTML characters which get automatically<br />At some sites, HTML is the big data, and then the execution time become long');

// archive manage
	define('_AM_RSSC_LEAN_BLACK', 'Learn in Black List');
	define('_AM_RSSC_LEAN_BLACK_DESC','Patrol in blacklist, for purpose extracting words in the content automatically, and adding words in reject word list automatically');
	define('_AM_RSSC_NUM_FEED_ALL','The number of all feeds');
	define('_AM_RSSC_NUM_FEED_SKIP','The number of already stored feeds');
	define('_AM_RSSC_NUM_FEED_REJECT','The number of judged black feeds');

	define('_AM_RSSC_THEREARE_TITLE','in related <b>%s</b> there are <b>%s</b>');
}


//---------------------------------------------------------
// compatible for v0.4
//---------------------------------------------------------
if( !defined('_AM_RSSC_FORM_PROXY') ) 
{
// proxy server
	define('_AM_RSSC_FORM_PROXY', 'Proxy Server Config');
	define('_AM_RSSC_CONF_PROXY_USE',  'Use Proxy Server');
	define('_AM_RSSC_CONF_PROXY_HOST', 'Proxy Host');
	define('_AM_RSSC_CONF_PROXY_PORT', 'Proxy Port');
	define('_AM_RSSC_CONF_PROXY_USER', 'Proxy Username');
	define('_AM_RSSC_CONF_PROXY_USER_DESC', 'Enter username, if your proxy server needs BASIC authentication, <br />Otherwise, keep blank');
	define('_AM_RSSC_CONF_PROXY_PASS', 'Proxy Password');
	define('_AM_RSSC_CONF_PROXY_PASS_DESC', 'Enter password, if your proxy server needs BASIC authentication, <br />Otherwise, keep blank');

	define('_AM_RSSC_CONF_HIGHLIGHT', 'Use Keyword Highlight');
}

//---------------------------------------------------------
// compatible for v0.3
//---------------------------------------------------------
if( !defined('_RSSC_DB_ERROR') ) 
{
// error message
	define('_RSSC_DB_ERROR',           'RSSC DB Error');
	define('_RSSC_DISCOVER_SUCCEEDED', 'RSS Auto Discovery Succeeded');
	define('_RSSC_DISCOVER_FAILED',    'RSS Auto Discovery Failed');
	define('_RSSC_PARSE_MSG',          'RSS Parse Message');
	define('_RSSC_PARSE_FAILED',            'RSS Parse Failed');
	define('_RSSC_PARSE_NOT_READ_XML_URL',  'RSS Parse Failed: not read RSS url');
	define('_RSSC_PARSE_NOT_FIND_ENCODING', 'RSS Parse Failed: not find encoding');
	define('_RSSC_REFRESH_ERROR', 'RSS Refresh Error');
	define('_RSSC_LINK_NOT_EXIST',  'There are no corresponding link in RSSC moudle');
	define('_RSSC_LINK_EXIST_MORE', 'There are twe or more links which have same "RDF/RSS/ATOM URL"');
	define('_RSSC_LINK_ALREADY',    'This link exists already which have same "RDF/RSS/ATOM URL"');

// refresh link
	define('_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
	define('_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.');
	define('_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');

// for other module
	define('_RSSC_RSSC_LID', 'Link ID of RSSC module');
	define('_RSSC_RSSC_LID_UPDATE', 'Update Link ID of RSSC module');
	define('_RSSC_GOTO_RSSC_ADMIN_LINK', 'Goto admin page of RSSC module');
}

if( !defined('_AM_RSSC_CONF_SHOW_TITLE_HTML') ) 
{
// show content with html
	define('_AM_RSSC_CONF_SHOW_TITLE_HTML','Use of HTML tag of the title');
	define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', 'When selcet "YES", show title with HTML tag, if title have HTML tag. <br />When selcet "NO", show title striping HTML tag. ');
	define('_AM_RSSC_CONF_SHOW_CONTENT_HTML','Use of HTML tag of the content');
	define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', 'When selcet "YES", show content with HTML tag, if content have HTML tag. <br />When selcet "NO", show content striping HTML tag. ');
	define('_AM_RSSC_CONF_SHOW_MAX_CONTENT','The maximum number of characters of Content');
	define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'HTML tags are stripped, when more than this number<br /><b>-1</b> is unlimited');
	define('_AM_RSSC_CONF_SHOW_NUM_CONTENT','Maximum number of RSS/ATOM feeds displayed content');
	define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', 'Enter the maximum number of RSS/ATOM feeds displayed content.');
	define('_AM_RSSC_CONF_SHOW_BLOG_LID','Link ID to show blog');
//	define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

	define('_AM_RSSC_TABLE_MANAGE','DB Table Manage');
}

//---------------------------------------------------------
// compatible for v0.2
//---------------------------------------------------------
// main
if( !defined('_RSSC_PODCAST') ) 
{
// bread crumb
	define('_HOME', 'HOME');

// podcast
	define('_RSSC_PODCAST', 'Podcast');
	define('_RSSC_ENCLOSURE_URL',    'Enclosure Url');
	define('_RSSC_ENCLOSURE_TYPE',   'Enclosure Type');
	define('_RSSC_ENCLOSURE_LENGTH', 'Enclosure Length');
}

// admin
if( !defined('_AM_RSSC_CONF_INDEX_DESC') ) 
{
// description at main
	define('_AM_RSSC_CONF_INDEX_DESC','Description at Main page');
	define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'Enter description note, when you want to display at a main page.');
	define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Here are description note.<br />You can edit description note at "Module Configuration 2".<br /></div><br />');

// link table
	define('_AM_RSSC_LINK_DESC','Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />when you dont fill, <br />if web site support "RSS Auto Discovery"');
	define('_AM_RSSC_LINK_EXIST', 'Already exists this "RDF/RSS/ATOM URL"');
	define('_AM_RSSC_LINK_EXIST_MORE','There are twe or more links which have same "RDF/RSS/ATOM URL" ');
	define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery Faild');
	define('_AM_RSSC_LINK_FORCE','Froce to save');

// black & white table
	define('_AM_RSSC_BLACK_MEMO','Memo');
}

//---------------------------------------------------------
// compatible for v0.1
//---------------------------------------------------------
// main
if( !defined('_RSSC_SINGLE_LINK') ) 
{
// single link
	define('_RSSC_SINGLE_LINK',  'Single Link');
	define('_RSSC_SINGLE_LINK_UTF8', 'Single Link with UTF-8');
	define('_RSSC_SINGLE_SUMMARY', 'Summary');
	define('_RSSC_SINGLE_CONTENT', 'Content allowed HTML tags');
	define('_RSSC_UTF8_SUMMARY', 'Summary with UTF-8');
	define('_RSSC_UTF8_CONTENT', 'Content allowed HTML tags with UTF-8');

// detect encoding
	define('_RSSC_ASSUME_ENCODING', 'assume xml encoding %s ,<br />because cannot detect encoding automatically');

// rss item
	define('_RSSC_CREATED', 'Created');
	define('_RSSC_ATOM_CONTRIBUTOR_NAME', 'Contoributor');
	define('_RSSC_ATOM_CONTRIBUTOR_URI',  'Contoributor URL');
	define('_RSSC_ATOM_CONTRIBUTOR_EMAIL','Contoributor email');

// no data
	define('_RSSC_NO_HEADLINK','there are no selected headlink link');
	define('_RSSC_NO_FEED','there are no feed data');
}

// admin
if( !defined('_AM_RSSC_PARSE_RSS') ) 
{
// build rss
//	define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
	define('_AM_RSSC_BUILD_DSC',  'Build and show RDF/RSS/ATOM for debug');
//	define('_AM_RSSC_BUILD_RDF',  'Build RDF');
//	define('_AM_RSSC_BUILD_RSS',  'Build RSS');
//	define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');

// parse rss
	define('_AM_RSSC_PARSE_RSS', 'Parse RDF/RSS/ATOM');

// refresh link
	define('_AM_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
	define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover RSS URL automatically and detect RSS ENCODING automatically, <br />if they are not set up.');
	define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');
}

// execution
if( !defined('_RSSC_EXECUTION_TIME') ) 
{
	define('_RSSC_EXECUTION_TIME', 'Execution time');
	define('_RSSC_MEMORY_USAGE', 'Memory usage');
	define('_RSSC_SEC', 'sec');
	define('_RSSC_MB', 'MB');
}

// other
if( !defined('_RSSC_IN') ) 
{
	define('_RSSC_IN', 'in');
	define('_RSSC_MAP_LOADING', 'Loading ...');
}
?>