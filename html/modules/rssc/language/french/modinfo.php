<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:37:09 ohwada Exp $

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// Traduit par jbaudin
// Version 0.71
// 09/01/2008
// jeromebaudin@jbnet.fr
// www.jbnet.fr
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_MI_LOADED') ) 
{

define('RSSC_LANG_MI_LOADED', 1);

// The name of this module
define('_MI_RSSC_NAME','RSS Center');
define('_MI_RSSC_DESC','Ce module collecte les  flux RDF/RSS/ATOM, les enregistre dans la base de donn&eacute;es et permet leur recherche.');

// Names of sub menu
define('_MI_RSSC_SMNAME_HEADLINE','RSS simple');

// Names of blocks
define('_MI_RSSC_BNAME_LATEST','Derniers  RDF/RSS/ATOM');
define('_MI_RSSC_BNAME_HEADLINE','RSS simple');
define('_MI_RSSC_BNAME_REFRESH','RSS simple (MAJ)');

// Names of admin menu
define('_MI_RSSC_ADMENU_CONFIG','Configration du module');
define('_MI_RSSC_ADMENU_LINKLIST','Liste des liens');

// 2006-09-20
define('_MI_RSSC_BNAME_BLOG','Blog RSSC');

// Names of admin menu
define('_MI_RSSC_ADMENU_CONFIG','Configuration du module');
define('_MI_RSSC_ADMENU_LINKLIST','Liste des liens');
}
// --- define language end ---

?>
