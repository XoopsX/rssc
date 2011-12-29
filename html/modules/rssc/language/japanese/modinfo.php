<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:37:08 ohwada Exp $

// 2006-09-20 K.OHWADA
// show blog

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
// 有朋自遠方来
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_MI_LOADED') ) 
{

define('RSSC_LANG_MI_LOADED', 1);

// The name of this module
define('_MI_RSSC_NAME','RSSセンター');
define('_MI_RSSC_DESC','RDF/RSS/ATOM形式の記事を収集して、DBに格納し、検索する');

// Names of sub menu
define('_MI_RSSC_SMNAME_HEADLINE','簡易ヘッドライン');

// Names of blocks
define('_MI_RSSC_BNAME_LATEST','最新 RDF/RSS/ATOM 記事');
define('_MI_RSSC_BNAME_HEADLINE','簡易ヘッドライン');
define('_MI_RSSC_BNAME_REFRESH','簡易ヘッドライン(更新あり)');

// 2006-09-20
define('_MI_RSSC_BNAME_BLOG','RSSC Blog表示');

// Names of admin menu
define('_MI_RSSC_ADMENU_CONFIG','モジュール設定');
define('_MI_RSSC_ADMENU_LINKLIST','リンク一覧');

// === 2009-02-20 ===
define('_MI_RSSC_BNAME_MAP','RSS Googleマップ');

}
// --- define language end ---

?>