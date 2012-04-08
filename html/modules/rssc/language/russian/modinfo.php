<?php
// $Id: modinfo.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2006-09-20 K.OHWADA
// show blog

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('RSSC_LANG_MI_LOADED') ) 
{

define('RSSC_LANG_MI_LOADED', 1);

// The name of this module
define('_MI_RSSC_NAME','RSS Центр');
define('_MI_RSSC_DESC','Данный модуль собирает RDF/RSS/ATOM каналы, сохраняет в базе данных и ищет их.');

// Names of sub menu
define('_MI_RSSC_SMNAME_HEADLINE','Простой заголовок');

// Names of blocks
define('_MI_RSSC_BNAME_LATEST','Последние RDF/RSS/ATOM каналы');
define('_MI_RSSC_BNAME_HEADLINE','Простой заголовок');
define('_MI_RSSC_BNAME_REFRESH','Простой заголовок (обновление)');

// 2006-09-20
define('_MI_RSSC_BNAME_BLOG','Блог RSSC');

// Names of admin menu
define('_MI_RSSC_ADMENU_CONFIG','Конфигурация модуля');
define('_MI_RSSC_ADMENU_LINKLIST','Список ссылок');

// === 2009-02-20 ===
define('_MI_RSSC_BNAME_MAP','Карта RSS Google');

}
// --- define language end ---

?>