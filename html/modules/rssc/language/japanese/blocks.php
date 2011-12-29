<?php
// $Id: blocks.php,v 1.1 2011/12/29 14:37:08 ohwada Exp $

// 2006-09-20 K.OHWADA
// show blog

// 2006-07-08 K.OHWADA
// corresponding to podcast

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
// 有朋自遠方来
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_BL_LOADED') ) 
{

define('RSSC_LANG_BL_LOADED', 1);

define('_BL_RSSC_MORE','もっと読む...');

// 2006-07-08
// podcast
define('_BL_RSSC_PODCAST','ポッドキャスト');
define( 'BL_RSSC_UNIT_KB','KB');

// 2006-09-20
define('_BL_RSSC_NO_LINK_ID', 'リンクIDが選択されていない');
define('_BL_RSSC_NO_FEED', '該当する記事がない');

// === 2009-02-20 ===
// icon
define('_BL_RSSC_LINK_ETC',  'その他');

}

// --- define language end ---

?>