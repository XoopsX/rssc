<?php
// $Id: main.php,v 1.1 2011/12/29 14:37:09 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2007-12-09 K.OHWADA
// remove _RSSC_CREATED

// 2007-10-10 K.OHWADA
// enclusure in link table

// 2007-06-01 K.OHWADA
// move RSS words to happy_linux module
// word table

// 2006-11-08 K.OHWADA
// not use _RSSC_SINGLE_SUMMARY

// 2006-09-20 K.OHWADA
// conflict with weblinks
// error message

// 2006-07-08 K.OHWADA
// corresponding to podcast
// link exist check

// 2006-06-04 K.OHWADA
// _RSSC_SINGLE_LINK, etc

// 2006-04-16 K.OHWADA
// BUG 3864: suppress Notice Undefined offset: 0
//   _RSSC_NO_HEADLINK

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_MB_LOADED') ) 
{

define('RSSC_LANG_MB_LOADED', 1);

// global
//define('_ADDED','Added');
//define('_DELETED','Deleted');
//define('_UPDATE', 'Update');
//define('_UPDATED','Updated');
//define('_MODIFY',  'Midify');
//define('_MODIFIED','Modified');
//define('_SAVE', 'Save');
//define('_SAVED','Saved');
//define('_CLEAR',  'Clear');
//define('_CLEARED','Cleared');
//define('_EXECUTE', 'Execute');
//define('_EXECUTED','Executed');
//define('_CREATE', 'Create');
//define('_CREATED','Created');
//define('_VISIT','Visit');
//define('_SHOW','Show');
//define('_KEYWORD','Keyword');
//define('_NUM','Num');
//define('_NO_ACTION','No Action');
//define('_NO_RECORD','There are no record');

// index & search
//define('_RSSC_MAIN','Main');

define('_RSSC_SEARCH','Search');
define('_RSSC_LATEST_FEEDS','Latest RDF/RSS/ATOM Feeds');
define('_RSSC_THEREARE','There are <b>%s</b> datas in databese');

// headline
define('_RSSC_HEADLINE','Simple Headline');
define('_RSSC_LASTUPDATE','Last Update');

// single
define('_RSSC_SINGLE','Single Feed');

// common
define('_RSSC_SITE_TITLE','Site Title');
define('_RSSC_SITE_LINK', 'Site URL');

//define('_RSSC_SITE_DESCRIPTION', 'Site Description');
//define('_RSSC_SITE_PUBLISHED', 'Site Published');
//define('_RSSC_SITE_UPDATED',   'Site Updated');
//define('_RSSC_SITE_DATE',      'Site Date');
//define('_RSSC_SITE_COPYRIGHT', 'Site Copyright');
//define('_RSSC_SITE_GENERATOR', 'Site Generator');
//define('_RSSC_SITE_CATEGORY',  'Site Category');
//define('_RSSC_SITE_WEBMASTER', 'Site Webmaster');
//define('_RSSC_SITE_LANGUAGE',  'Site Language');
//define('_RSSC_TITLE', 'Title');
//define('_RSSC_LINK',  'URL');
//define('_RSSC_DESCRIPTION', 'Description'); 
//define('_RSSC_SUMMARY', 'Summary'); 
//define('_RSSC_CONTENT', 'Content');
//define('_RSSC_PUBLISHED', 'Published');

define('_RSSC_UPDATED',   'Updated');

//define('_RSSC_CATEGORY',  'Category');
//define('_RSSC_RIGHTS', 'Rights');
//define('_RSSC_SOURCE', 'Source');
//define('_RSSC_AUTHOR_NAME', 'Author Name');
//define('_RSSC_AUTHOR_URI',  'Author URL');
//define('_RSSC_AUTHOR_EMAIL','Author Email');
//define('_RSSC_IMAGE_TITLE', 'Image Title');
//define('_RSSC_IMAGE_URL',   'Image URL');

// RSS
//define('_RSSC_RSS_SITE_TITLE', _RSSC_SITE_TITLE);
//define('_RSSC_RSS_SITE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_RSS_SITE_DESCRIPTION',   _RSSC_SITE_DESCRIPTION);
//define('_RSSC_RSS_SITE_LASTBUILDDATE', _RSSC_SITE_UPDATED);
//define('_RSSC_RSS_SITE_PUBDATE',       _RSSC_SITE_PUBLISHED);
//define('_RSSC_RSS_SITE_GENERATOR', _RSSC_SITE_GENERATOR);
//define('_RSSC_RSS_SITE_CATEGORY',  _RSSC_SITE_CATEGORY);
//define('_RSSC_RSS_SITE_WEBMASTER', _RSSC_SITE_WEBMASTER);
//define('_RSSC_RSS_SITE_LANGUAGE',  _RSSC_SITE_LANGUAGE);
//define('_RSSC_RSS_SITE_COPYRIGHT', _RSSC_SITE_COPYRIGHT);
//define('_RSSC_RSS_SITE_MANAGINGEDITOR', 'Site Editor');
//define('_RSSC_RSS_SITE_DOCS','Site Docs');
//define('_RSSC_RSS_SITE_CLOUD', 'Site Cloud');
//define('_RSSC_RSS_SITE_TTL', 'Site TTL');
//define('_RSSC_RSS_SITE_RATING', 'Site Rating');
//define('_RSSC_RSS_SITE_TEXTINPUT', 'Site Text Input');
//define('_RSSC_RSS_SITE_SKIPHOURS', 'Site Skip Hours');
//define('_RSSC_RSS_SITE_SKIPDAYS',  'Site Skip Days');
//define('_RSSC_RSS_IMAGE_TITLE',  _RSSC_IMAGE_TITLE);
//define('_RSSC_RSS_IMAGE_URL',    _RSSC_IMAGE_URL);
//define('_RSSC_RSS_IMAGE_WIDTH',  'Image Width');
//define('_RSSC_RSS_IMAGE_HEIGHT', 'Image Height');
//define('_RSSC_RSS_IMAGE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_RSS_TITLE',_RSSC_TITLE);
//define('_RSSC_RSS_LINK', _RSSC_LINK);
//define('_RSSC_RSS_DESCRIPTION', _RSSC_DESCRIPTION); 
//define('_RSSC_RSS_PUBDATE',  _RSSC_PUBLISHED);
//define('_RSSC_RSS_CATEGORY', _RSSC_CATEGORY);
//define('_RSSC_RSS_SOURCE',   _RSSC_SOURCE);
//define('_RSSC_RSS_GUID',   'RSS guid');
//define('_RSSC_RSS_AUTHOR', 'Author');
//define('_RSSC_RSS_COMMENTS','Comments');
//define('_RSSC_RSS_ENCLOSURE', 'Enclosure');

// RDF
//define('_RSSC_RDF_SITE_TITLE', _RSSC_SITE_TITLE);
//define('_RSSC_RDF_SITE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_RDF_SITE_DESCRIPTION', _RSSC_SITE_DESCRIPTION);
//define('_RSSC_RDF_SITE_PUBLISHER',   _RSSC_SITE_WEBMASTER);
//define('_RSSC_RDF_SITE_RIGHT', _RSSC_SITE_COPYRIGHT);
//define('_RSSC_RDF_SITE_DATE',  _RSSC_SITE_PUBLISHED );
//define('_RSSC_RDF_SITE_TEXTINPUT', 'Site Text Input');
//define('_RSSC_RDF_SITE_IMAGE',  'Site Image ');
//define('_RSSC_RDF_IMAGE_TITLE', _RSSC_IMAGE_TITLE);
//define('_RSSC_RDF_IMAGE_URL',   _RSSC_IMAGE_URL);
//define('_RSSC_RDF_IMAGE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_RDF_TITLE',_RSSC_TITLE);
//define('_RSSC_RDF_LINK', _RSSC_LINK);
//define('_RSSC_RDF_DESCRIPTION', _RSSC_DESCRIPTION); 
//define('_RSSC_RDF_TEXTINPUT', 'Text Input');

// ATOM
//define('_RSSC_ATOM_SITE_TITLE', _RSSC_SITE_TITLE);
//define('_RSSC_ATOM_SITE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_ATOM_SITE_PUBLISHED', _RSSC_SITE_PUBLISHED);
//define('_RSSC_ATOM_SITE_UPDATED',   _RSSC_SITE_UPDATED);
//define('_RSSC_ATOM_SITE_RIGHTS',    _RSSC_SITE_COPYRIGHT);
//define('_RSSC_ATOM_SITE_GENERATOR', _RSSC_SITE_GENERATOR);
//define('_RSSC_ATOM_SITE_CATEGORY',  _RSSC_SITE_CATEGORY);
//define('_RSSC_ATOM_SITE_LINK_ALTERNATE', _RSSC_SITE_LINK);
//define('_RSSC_ATOM_SITE_LINK_SELF', 'ATOM Self URL');
//define('_RSSC_ATOM_SITE_ID','Site ID');
//define('_RSSC_ATOM_SITE_CONTRIBUTOR','Site Contributor');
//define('_RSSC_ATOM_SITE_SUBTITLE','Site Subtitle');
//define('_RSSC_ATOM_SITE_ICON', 'Site Icon');
//define('_RSSC_ATOM_SITE_LOGO', 'Site Logo');
//define('_RSSC_ATOM_SITE_SOURCE', 'Site Source');
//define('_RSSC_ATOM_SITE_AUTHOR_NAME', _RSSC_SITE_WEBMASTER);
//define('_RSSC_ATOM_SITE_AUTHOR_URI',  'Webmaster URL');
//define('_RSSC_ATOM_SITE_AUTHOR_EMAIL','Webmaster Email');
//define('_RSSC_ATOM_TITLE', _RSSC_TITLE);
//define('_RSSC_ATOM_LINK',  _RSSC_LINK);
//define('_RSSC_ATOM_PUBLISHED', _RSSC_PUBLISHED);
//define('_RSSC_ATOM_UPDATED',   _RSSC_UPDATED);
//define('_RSSC_ATOM_SUMMARY',  _RSSC_SUMMARY); 
//define('_RSSC_ATOM_CONTENT',  _RSSC_CONTENT);
//define('_RSSC_ATOM_CATEGORY', _RSSC_CATEGORY);
//define('_RSSC_ATOM_RIGHTS',   _RSSC_RIGHTS);
//define('_RSSC_ATOM_SOURCE',   _RSSC_SOURCE);
//define('_RSSC_ATOM_ID','ATOM id');
//define('_RSSC_ATOM_CONTRIBUTOR','Contributor');
//define('_RSSC_ATOM_AUTHOR_NAME', _RSSC_AUTHOR_NAME);
//define('_RSSC_ATOM_AUTHOR_URI',  _RSSC_AUTHOR_URI);
//define('_RSSC_ATOM_AUTHOR_EMAIL',_RSSC_AUTHOR_EMAIL);

// Dublin Core
//define('_RSSC_DC_TITLE',_RSSC_TITLE);
//define('_RSSC_DC_DESCRIPTION', _RSSC_DESCRIPTION); 
//define('_RSSC_DC_RIGHTS', _RSSC_RIGHTS);
//define('_RSSC_DC_PUBLISHER', 'Publisher');
//define('_RSSC_DC_CREATOR', 'Creator');
//define('_RSSC_DC_DATE', 'Date');
//define('_RSSC_DC_FORMAT', 'Fromat');
//define('_RSSC_DC_RELATION', 'Relation');
//define('_RSSC_DC_IDENTIFIER', 'Identifier');
//define('_RSSC_DC_COVERAGE', 'Coverage');
//define('_RSSC_DC_AUDIENCE', 'Audience');
//define('_RSSC_DC_SUBJECT', 'Subject');
//define('_RSSC_CONTENT_ENCODED', _RSSC_CONTENT);

// link table item
define('_RSSC_LINK_ID','Link ID');
define('_RSSC_USER_ID','User ID');
define('_RSSC_MOD_ID','Module ID');
define('_RSSC_LTYPE','Type');
define('_RSSC_REFRESH_INTERVAL','Refresh Interval');
define('_RSSC_HEADLINE_ORDER','Headline Order');
define('_RSSC_ENCODING','Encoding');
define('_RSSC_RDF_URL', 'RDF URL');
define('_RSSC_RSS_URL', 'RSS URL');
define('_RSSC_ATOM_URL','ATOM URL');
define('_RSSC_RSS_MODE','RSS Mode');
define('_RSSC_RSS_MODE_NON',  'Non');
define('_RSSC_RSS_MODE_RDF',  'RDF Format');
define('_RSSC_RSS_MODE_RSS',  'RSS Format');
define('_RSSC_RSS_MODE_ATOM', 'ATOM Format');
define('_RSSC_RSS_MODE_AUTO', 'Auto Detect');

// feed table item
define('_RSSC_FEED_ID','Feed ID');
define('_RSSC_MODE_CONT','Content Mode');
define('_RSSC_RAWS','Raw Data');
define('_RSSC_SEARCH_FIELD','Search Field');

// black table item
define('_RSSC_BLACK_ID','Black ID');
define('_RSSC_WHITE_ID','White ID');

// 2006-04-16 K.OHWADA
define('_RSSC_NO_HEADLINK','there are no selected headlink link');
define('_RSSC_NO_FEED','there are no feed data');

// === 2006-06-04 ===
// single link
define('_RSSC_SINGLE_LINK',  'Single Link');
define('_RSSC_SINGLE_LINK_UTF8', 'Single Link with UTF-8');
//define('_RSSC_SINGLE_SUMMARY', 'Summary');
//define('_RSSC_SINGLE_CONTENT', 'Content allowed HTML tags');
//define('_RSSC_UTF8_SUMMARY', 'Summary with UTF-8');
//define('_RSSC_UTF8_CONTENT', 'Content allowed HTML tags with UTF-8');

// detect encoding
define('_RSSC_ASSUME_ENCODING', 'assume xml encoding %s ,<br />because cannot detect encoding automatically');

// rss item
//define('_RSSC_CREATED', 'Created');
//define('_RSSC_ATOM_CONTRIBUTOR_NAME', 'Contoributor');
//define('_RSSC_ATOM_CONTRIBUTOR_URI',  'Contoributor URL');
//define('_RSSC_ATOM_CONTRIBUTOR_EMAIL','Contoributor email');

// === 2006-07-08 ===
// bread crumb
//define('_HOME', 'HOME');

// podcast
define('_RSSC_PODCAST', 'Podcast');
//define('_RSSC_ENCLOSURE_URL',    'Enclosure Url');
//define('_RSSC_ENCLOSURE_TYPE',   'Enclosure Type');
//define('_RSSC_ENCLOSURE_LENGTH', 'Enclosure Length');

// === 2006-09-01 ===
// conflict with weblinks
//if( !defined('_SAVE') ) 
//{
//	define('_HOME', 'HOME');
//	define('_SAVE', 'Save');
//	define('_SAVED','Saved');
//	define('_EXECUTE', 'Execute');
//	define('_EXECUTED','Executed');
//	define('_CREATE', 'Create');
//	define('_CREATED','Created');
//}

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

// === 2007-06-01 ===
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

// === 2007-10-10 ===
// link table
define('_RSSC_LINK_ENCLOSURE','Operation of enclusure tag');
define('_RSSC_LINK_ENCLOSURE_NON','Not use');
define('_RSSC_LINK_ENCLOSURE_POD','Assume PodCast');
define('_RSSC_LINK_CENSOR', 'Words to censor in title');
//define('_RSSC_LINK_PLUGIN','Plugin');

// black & white table
define('_RSSC_BW_CACHE','Cache of feed count');
define('_RSSC_BW_CTIME','Cache Time of feed count');

// keyword manage
define('_RSSC_KEYWORD','Keyword');

// === 2008-01-20 ===
// plugin list
define('_RSSC_PLUGIN_LIST', 'Plugin List');
define('_RSSC_PLUGIN_NAME', 'Plugin Name');
define('_RSSC_PLUGIN_DESCRIPTION', 'Description');
define('_RSSC_PLUGIN_USAGE', 'Usage');

// link table
define('_RSSC_PRE_PLUGIN', 'Pre-Processing Plugin');
define('_RSSC_POST_PLUGIN','Post-Processing Plugin');

// === 2009-02-20 ===
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
// --- define language end ---

?>