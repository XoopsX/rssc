<?php
// $Id: rssc_constant.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2007-10-10 K.OHWADA
// enclosure in link table

// 2007-06-01 K.OHWADA
// add RSSC_C_LINK_LTYPE_NON, RSSC_DEBUG_XML_SQL
// move RSSC_C_MODE_NON to rssc_xml_utility

// 2006-09-20 K.OHWADA
// add RSSC_CODE_NORMAL

// 2006-07-10 K.OHWADA
// corresponding to podcast
// add RSSC_UNIT_KB

// 2006-06-04 K.OHWADA
// add "for debug"

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- define constant begin ---
if( !defined('RSSC_CONSTANT_LOADED') ) 
{

define('RSSC_CONSTANT_LOADED', 1);

define('RSSC_C_ORDER_INT_UPDATED',   0);
define('RSSC_C_ORDER_INT_PUBLISHED', 1);
define('RSSC_C_ORDER_TEXT_UPDATED',   'updated_unix DESC, fid DESC');
define('RSSC_C_ORDER_TEXT_PUBLISHED', 'published_unix DESC, fid DESC');

define('RSSC_C_VIEW_CURRENT', 0);
define('RSSC_C_VIEW_LINK',    1);
define('RSSC_C_VIEW_FEED',    2);

// 2006-07-10
// podcast
define('RSSC_UNIT_KB','KB');

// 2007-06-01
define('RSSC_C_LINK_LTYPE_NON',    0);
define('RSSC_C_LINK_LTYPE_SEARCH', 1);
define('RSSC_C_LINK_LTYPE_NORMAL', 2);

// 2007-10-10
define('RSSC_C_LINK_ENCLOSURE_NON', 0);
define('RSSC_C_LINK_ENCLOSURE_POD', 1);

define('RSSC_C_DATE_INT_NON',    0);
define('RSSC_C_DATE_INT_SHORT',  1);
define('RSSC_C_DATE_INT_MIDDLE', 2);
define('RSSC_C_DATE_INT_LONG',   3);

// === return code ===
// 2006-09-01
define('RSSC_CODE_NORMAL', 0);

// rssc_pase_handler
define('RSSC_CODE_PARSE_NOT_READ_XML_URL',  111);
define('RSSC_CODE_PARSE_NOT_FIND_ENCODING', 112);
define('RSSC_CODE_PARSE_FAILED',            113);

// rssc_refresh_handler
define('RSSC_CODE_DB_ERROR',      121);
define('RSSC_CODE_PARSE_MSG',     122);
define('RSSC_CODE_REFRESH_ERROR', 123);

// reserve
define('RSSC_CODE_LINK_NOT_EXIST',  141);
define('RSSC_CODE_LINK_ALREADY',    142);
define('RSSC_CODE_LINK_EXIST_MORE', 143);

// 2007-06-01
//define('RSSC_C_MODE_NON',  0);
//define('RSSC_C_MODE_RDF',  1);
//define('RSSC_C_MODE_RSS',  2);
//define('RSSC_C_MODE_ATOM', 3);
//define('RSSC_C_MODE_AUTO', 4);
//define('RSSC_C_SEL_RSS',  'rss');
//define('RSSC_C_SEL_RDF',  'rdf');
//define('RSSC_C_SEL_ATOM', 'atom');
//define('RSSC_CODE_XML_ENCODINGS_DEFAULT',  101);
//define('RSSC_CODE_DISCOVER_SUCCEEDED', 131);
//define('RSSC_CODE_DISCOVER_FAILED',    132);

// 2006-06-04
//define('RSSC_C_PARSER_RSS_XOOPS', 'rss_xoops');
//define('RSSC_C_PARSER_RSS_SELF',  'rss_self');
//define('RSSC_C_PARSER_ATOM_SELF', 'atom_self');

// === debug ===
define('RSSC_DEBUG_ERROR', 0);

define('RSSC_DEBUG_CONFIG_SQL', 0 );
define('RSSC_DEBUG_LINK_SQL',   0 );
define('RSSC_DEBUG_FEED_SQL',   0 );
define('RSSC_DEBUG_BLACK_SQL',  0 );
define('RSSC_DEBUG_WHITE_SQL',  0 );
define('RSSC_DEBUG_WORD_SQL',   0 );
define('RSSC_DEBUG_XML_SQL',    0 );

define('RSSC_DEBUG_CONFIG_BASIC_SQL', 0 );
define('RSSC_DEBUG_LINK_BASIC_SQL',   0 );
define('RSSC_DEBUG_FEED_BASIC_SQL',   0 );
define('RSSC_DEBUG_BLACK_BASIC_SQL',  0 );
define('RSSC_DEBUG_WHITE_BASIC_SQL',  0 );
define('RSSC_DEBUG_WORD_BASIC_SQL',   0 );
define('RSSC_DEBUG_XML_BASIC_SQL',    0 );

}
// --- define constant end ---

?>