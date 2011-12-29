<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2006-09-20 K.OHWADA
// show blog

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_MI_LOADED') ) 
{

define('RSSC_LANG_MI_LOADED', 1);

// The name of this module
define('_MI_RSSC_NAME','RSS Center');
define('_MI_RSSC_DESC','Questo modulo raccoglie RDF/RSS/ATOM feeds, li salva nel database, ed esegue ricerche nei dati ricavati.');

// Names of sub menu
define('_MI_RSSC_SMNAME_HEADLINE','Headline Semplice');

// Names of blocks
define('_MI_RSSC_BNAME_LATEST','Ultimi RDF/RSS/ATOM feed');
define('_MI_RSSC_BNAME_HEADLINE','Headline Semplice');
define('_MI_RSSC_BNAME_REFRESH','Headline Semplice (aggiorna)');

// 2006-09-20
define('_MI_RSSC_BNAME_BLOG','RSSC Blog');

// Names of admin menu
define('_MI_RSSC_ADMENU_CONFIG','Configurazione Modulo');
define('_MI_RSSC_ADMENU_LINKLIST','Lista Link');

}
// --- define language end ---

?>
