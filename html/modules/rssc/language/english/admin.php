<?php
// $Id: admin.php,v 1.3 2012/03/18 08:27:06 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2008-01-10 K.OHWADA
// double definition : _AM_RSSC_CONF_BLACK_USE_DESC

// 2007-12-09 K.OHWADA
// remove _AM_RSSC_CREATE_CONFIG

// 2007-10-10 K.OHWADA
// censor in link table

// 2007-07-01 K.OHWADA
// word list, content filter

// 2006-11-08 K.OHWADA
// proxy server

// 2006-09-20 K.OHWWADA
// show content with html
// table manage

// 2006-07-08 K.OHWWADA
// description at main

// 2006-06-04 K.OHWADA
// _AM_RSSC_BUILD, etc

// 2006-01-20 K.OHWADA
// _AM_RSSC_ID_ASC

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_AM_LOADED') ) 
{

define('RSSC_LANG_AM_LOADED', 1);

// === menu ===
define('_AM_RSSC_CONF', 'RSS Center Management');
define('_AM_RSSC_LIST_LINK', 'Link List');
define('_AM_RSSC_LIST_BLACK', 'Blacklist List');
define('_AM_RSSC_LIST_WHITE', 'Whitelist List');
define('_AM_RSSC_LIST_FEED', 'Feed List');
define('_AM_RSSC_ADD_LINK', 'Add Link');
define('_AM_RSSC_ADD_BLACK', 'Add Blacklist');
define('_AM_RSSC_ADD_WHITE', 'Add Whitelist');
define('_AM_RSSC_ADD_KEYWORD', 'Add Keyword');
define('_AM_RSSC_ARCHIVE_MANAGE', 'Archive Management');

//define('_AM_RSSC_COMMAND_MANAGE', 'Command Management');

define('_AM_RSSC_UPDATE_MANAGE', 'Import Managemnet');
define('_AM_RSSC_VIEW_RSS', 'View RDF/RSS/ATOM');

//define('_AM_RSSC_GOTO_MODULE', 'Goto Module');

// === index & config ===
define('_AM_RSSC_FORM_BASIC', 'Basic Config');
define('_AM_RSSC_FORM_BASIC_DESC', 'It is used in common by all modules');
define('_AM_RSSC_FORM_MAIN', 'Main View Config');
define('_AM_RSSC_FORM_MAIN_DESC', 'It is used on the main page of this module');
define('_AM_RSSC_FORM_BLOCK', 'Block View Coinfig');
define('_AM_RSSC_FORM_BLOCK_DESC', 'It is used on the block of this module');

//define('_AM_RSSC_FORM_BIN', 'Command Config');
//define('_AM_RSSC_FORM_BIN_DESC', 'It is used on bin command');
//define('_AM_RSSC_INIT_NOT','The config table is not initialized');
//define('_AM_RSSC_INIT_EXEC','Initialized the config table');
//define('_AM_RSSC_VERSION_NOT','It is not version  %s');
//define('_AM_RSSC_UPGRADE_EXEC','Upgrade the config table');
//define('_AM_RSSC_WARNING_NOT_WRITABLE','Not writable the directory');
//define('_AM_RSSC_CONF_NAME','Item');

define('_AM_RSSC_DBUPDATED', 'Database Updated Successfully!');
define('_AM_RSSC_FAILUPDATE', 'Failed saving data to database');
define('_AM_RSSC_FAILDELETE', 'Failed deleting data from database');
define('_AM_RSSC_THERE_ARE_LINKS','There are <b>%s</b> Links in database');
define('_AM_RSSC_THERE_ARE_FEEDS','There are <b>%s</b> Feeds in database');

// === link manage ===
define('_AM_RSSC_LINK_MANAGE','Link Management');
define('_AM_RSSC_MOD_LINK','Modify Link');
define('_AM_RSSC_DEL_LINK','Delete Link');
define('_AM_RSSC_SHOW_RSS',  'Show RSS');
define('_AM_RSSC_SHOW_FEED', 'Show Feed');
define('_AM_RSSC_FEED_BELONG_LINK', 'Show feeds belonging to this link');
define('_AM_RSSC_ERROR_FILL', 'Error: Enter %s');
define('_AM_RSSC_ERROR_ILLEGAL','Error: Illegal %s');

// === black list manage ===
define('_AM_RSSC_BLACK_MANAGE','Blacklist Managemnet');
define('_AM_RSSC_MOD_BLACK','Modify Blacklist');
define('_AM_RSSC_DEL_BLACK','Delete Blacklist');
define('_AM_RSSC_FEED_MATCH_LINK', 'Show feeds which is matched with this list');

// === white list manage ===
define('_AM_RSSC_WHITE_MANAGE','Whitelist Managemnet');
define('_AM_RSSC_MOD_WHITE','Modify Whitelist');
define('_AM_RSSC_DEL_WHITE','Delete Whitelist');

// === feed list manage ===
define('_AM_RSSC_ADD_FEED','Add Feed');
define('_AM_RSSC_MOD_FEED','Modify Feed');
define('_AM_RSSC_DEL_FEED','Delete Feed');
define('_AM_RSSC_THERE_ARE_MATCH','There are <b>%s</b> datas which is matched to with conditions');
define('_AM_RSSC_CONDITION','Condition');

// === archive manage ===
define('_AM_RSSC_REFRESH', 'Refresh Archive');
define('_AM_RSSC_REFRESH_NEXT','Check Next %s');
define('_AM_RSSC_LINK_LIMIT', 'Link Limit');
define('_AM_RSSC_LINK_OFFSET','LInk Offset');
define('_AM_RSSC_FEED_CLEAR','Clear Archive');
define('_AM_RSSC_FEED_CLEAR_OLD','Clears the older records');
define('_AM_RSSC_FEED_CLEAR_NUM','Clears the older records, if it becomes more than the specified number');

// refresh result
define('_AM_RSSC_NO_REFRESH','No link to update');
define('_AM_RSSC_TIME_START','Start Time');
define('_AM_RSSC_TIME_END','Finish Time');
define('_AM_RSSC_TIME_ELAPSE','Elapse time');
define('_AM_RSSC_MIN_SEC','%s min %s sec');
define('_AM_RSSC_NUM_LINK_TOTAL','Total Links');
define('_AM_RSSC_NUM_LINK_TARGET','The number of target links');
define('_AM_RSSC_NUM_LINK_BROKEN','The number of broken links');
define('_AM_RSSC_NUM_LINK_UPDATED','The number of updated links');
define('_AM_RSSC_NUM_FEED_UPDATED','The number of updated feeds');
define('_AM_RSSC_NUM_FEED_CLEARED','The number of cleared feeds');
define('_AM_RSSC_NUM_LINKS','links');
define('_AM_RSSC_NUM_FEEDS','feeds');
define('_AM_RSSC_FAILGET', 'Cannot get XML from %s');
define('_AM_RSSC_GOTOTOP', 'Goto Top');

// === configuration ===
// basic configuration
define('_AM_RSSC_CONF_FEED_LIMIT', 'The maximum number of feeds');
define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'Enter the maximum number of feeds stored in feed table<br />Clears the older records, when it becomes more than this value<br /><b>0</b> is umlimited');
define('_AM_RSSC_CONF_RSS_ATOM', 'Select RSS or ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'Select RSS or ATOM, when both RSS URL and ATOM URL are detected');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS',  'RSS');
define('_AM_RSSC_CONF_RSS_PARSER', 'Select RSS paser');
define('_AM_RSSC_CONF_RSS_PARSER_SELF',  'RSSC parser');
define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS Parser');
define('_AM_RSSC_CONF_ATOM_PARSER', 'select ATOM parser');
define('_AM_RSSC_CONF_ATOM_PARSER_0', 'RSSC parser');
define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
define('_AM_RSSC_CONF_RSS_MODE', 'Initial value of RSS mode');
define('_AM_RSSC_CONF_XML_SAVE', 'Save XML');
define('_AM_RSSC_CONF_XML_SAVE_DESC', 'save gettig XML to link table');
define('_AM_RSSC_CONF_FUTURE_DAYS', 'Future Days');
define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', "A unit is days<br />Not show feed, if feed's date is rather than this days");

// show configuration
define('_AM_RSSC_CONF_SHOW_ORDER','Order to show');
//define('_AM_RSSC_CONF_SHOW_ORDER_DESC','');
define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED','Latest Updated');
define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED','Latest Published');
define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE','Links per page');
//define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE','Feeds per page');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK','Feeds per link');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE','The maximum number of characters of Title');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC','HTML tags are stripped, when more than this number<br /><b>-1</b> is unlimited');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY','The maximum number of characters of Summary');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC','<b>-1</b> is unlimited');

// main configuration
define('_AM_RSSC_CONF_MAIN_SEARCH_MIN','The mimimum number of characters of Search keyword');
//define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','');

// bin configuration
//define('_AM_RSSC_CONF_BIN_PASS','Password');
//define('_AM_RSSC_CONF_BIN_PASS_DESC','');
//define('_AM_RSSC_CONF_BIN_SEND','Send Mail');
//define('_AM_RSSC_CONF_BIN_SEND_DESC','');
//define('_AM_RSSC_CONF_BIN_MAILTO','Email to send');
//define('_AM_RSSC_CONF_BIN_MAILTO_DESC','');

// === view rss ===
define('_AM_RSSC_VIEW_RSS_OPTION', 'Option Setting');
define('_AM_RSSC_NOT_SELECT_LINK','The link is not selected');
define('_AM_RSSC_PLEASE_SELECT_LINK','Select from link list, or Enter LINK ID');
define('_AM_RSSC_VIEW_PARSER', 'Parser Setting');
define('_AM_RSSC_VIEW_SAVE_ETC', 'Save to table, etc');
define('_AM_RSSC_VIEW_MODE', 'View Mode');
define('_AM_RSSC_VIEW_MODE_DESC', 'Dont save in table, when mode is 0');
define('_AM_RSSC_VIEW_MODE_CURRENT', 'mode 0: getting XML data');
define('_AM_RSSC_VIEW_MODE_LINK', 'mode 1: XML data saved in link table');
define('_AM_RSSC_VIEW_MODE_FEED', 'mode 2: data saved in feed table');
define('_AM_RSSC_VIEW_SANITIZE', 'HTML Sanitize');
define('_AM_RSSC_VIEW_TITLE_HTML','Show HTML tags of Title');
define('_AM_RSSC_VIEW_TITLE_HTML_DESC', 'When select YES, show as it is including HTML tags. <br />When select NO, show it after stripping HTML tags. ');
define('_AM_RSSC_VIEW_CONTENT_HTML','Show HTML tags of Content');
define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', 'When select YES, show as it is including HTML tags. <br />When select NO, show it after stripping HTML tags. ');
define('_AM_RSSC_VIEW_MAX_CONTENT','The maximum number of characters of Content');
define('_AM_RSSC_VIEW_MAX_CONTENT_DESC','HTML tags are stripped, when more than this number<br /><b>-1</b> is unlimited');
define('_AM_RSSC_VIEW_LINK_UPDATE', 'Update Link table');
define('_AM_RSSC_VIEW_FEED_UPDATE', 'Update Feed table');
define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'Force to discover RSS URL');
define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'Overwrite RDF/RSS/ATOM URL, after detecting this URL not related to RSS mode');
define('_AM_RSSC_VIEW_FORCE_UPDATE', 'Force to update Archive');
define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', 'Overwrite Archive, after getting RDF/RSS/ATOM not related to Refresh Interval');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'Force to update Feed table');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', 'Overwrite Feed table, even if exists the the same data of RDF/RSS/ATOM URL');
define('_AM_RSSC_VIEW_PRINT_LOG', 'Show Log');
define('_AM_RSSC_VIEW_PRINT_LOG_DESC', 'Show log simultaneously during executing');
define('_AM_RSSC_VIEW_PRINT_ERROR', 'Show Error');
define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', 'Show error simultaneously during executing');

// === command manage ===
//define('_AM_RSSC_CREATE_CONFIG', 'Create Config File');
//define('_AM_RSSC_TEST_BIN_REFRESH', 'Test to execute bin/refresh.php');

// === update manage ===
define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'Import from XoopsHeadline');
define('_AM_RSSC_IMPORT_WEBLINKS', 'Import from WebLinks');

// === rename ===
define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

// 2006-01-20
define('_AM_RSSC_ID_ASC', 'ID Ascent');
define('_AM_RSSC_ID_DESC','ID Descent');

// === 2006-06-04 ===
// build rss
//define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
//define('_AM_RSSC_BUILD_DSC',  'Build and show RDF/RSS/ATOM for debug');
//define('_AM_RSSC_BUILD_RDF',  'Build RDF');
//define('_AM_RSSC_BUILD_RSS',  'Build RSS');
//define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');

// parse rss
define('_AM_RSSC_PARSE_RSS', 'Parse RDF/RSS/ATOM');

// refresh link
//define('_AM_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
//define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.');
//define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');

// === 2006-07-08 ===
// description at main
define('_AM_RSSC_CONF_INDEX_DESC','Description at Main page');
define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'Enter description note, when you want to display at a main page.');
define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Here are description note.<br />You can edit description note at "Module Configuration".<br /></div><br />');

// link table
define('_AM_RSSC_LINK_DESC','Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />when you dont fill, <br />if web site support "RSS Auto Discovery"');
//define('_AM_RSSC_LINK_EXIST', 'Already exists this "RDF/RSS/ATOM URL"');
//define('_AM_RSSC_LINK_EXIST_MORE','There are twe or more links which have same "RDF/RSS/ATOM URL" ');
//define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery Faild');
define('_AM_RSSC_LINK_FORCE','Froce to save');

// black & white table
define('_AM_RSSC_BLACK_MEMO','Memo');

// === 2006-09-20 ===
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
//define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

define('_AM_RSSC_TABLE_MANAGE','DB Table Manage');

// === 2006-11-08 ===
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


// === 2007-06-01 ===
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
//define('_AM_RSSC_CONF_BLACK_USE_DESC','Not store when in black list');
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
define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL','Extract by the symbol pause');
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

// === 2007-10-10 ===
// config
define('_AM_RSSC_CONF_SHOW_MODE_DATE', 'Date Mode');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON',    'Not Show');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT',  'short');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', 'middle');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG',   'long');
define('_AM_RSSC_CONF_SHOW_SITE', 'Site Information');
define('_AM_RSSC_CONF_SHOW_SITE_DSC', 'when "YES", show site title and url');

// link table
define('_AM_RSSC_LINK_CENSOR_DESC', 'Separate each with <b>|</b><br />case sensitive');


// === 2008-01-20 ===
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

// === 2009-02-20 ===
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

// === 2012-03-01 ===
define('_AM_RSSC_MAP_MANAGE',  'GoogleMap Manage');
define('_AM_RSSC_FEED_COLUMN_MANAGE', 'Feed Column Manage');

// config
define('_AM_RSSC_CONF_WEBMAP_ADDRESS', 'Address');
define('_AM_RSSC_CONF_WEBMAP_ADDRESS_DESC', 'Memo which shows the place of latitude and longitude');
define('_AM_RSSC_CONF_WEBMAP_LATITUDE',  'Latitude');
define('_AM_RSSC_CONF_WEBMAP_LONGITUDE', 'Longitude');
define('_AM_RSSC_CONF_WEBMAP_ZOOM',      'Zoom');

}
// --- define language begin ---

?>