<?php
// $Id: main.php,v 1.1 2011/12/29 14:37:09 ohwada Exp $
// 2008-01-19 15:32:38 ken

//=========================================================
// RSS Center Module
// Language for Main
//=========================================================

// =========================================================
// Traduit par jbaudin
// Version 0.71
// 09/01/2008
// jeromebaudin@jbnet.fr
// www.jbnet.fr
// =========================================================


// --- define language begin ---
if( !defined("RSSC_LANG_MB_LOADED") )
{

define("RSSC_LANG_MB_LOADED", "1");
// remove in v0.71
// define("_ADDED", "Ajout&eacute;");
// define("_DELETED", "Supprim&eacute; ");
// define("_UPDATE", "Mise &agrave; jour");
// define("_UPDATED", "Mis &agrave; jour ");
// define("_MODIFY", "Modifier ");
// define("_MODIFIED", "Modifi&eacute; ");
// define("_SAVE", "Sauvegarder");
// define("_SAVED", "Sauvegard&eacute;");
// define("_CLEAR", "Effacer");
// define("_CLEARED", "Effac&eacute;");
// define("_EXECUTE", "Executer");
// define("_EXECUTED", "Execut&eacute;");
// define("_CREATE", "Cr&eacute;er");
// define("_CREATED", "Cr&eacute;&eacute;");
// define("_VISIT", "Visiter");
// define("_SHOW", "Voir");
// define("_KEYWORD", "Mots cl&eacute;s");
// define("_NUM", "Num");
// define("_NO_ACTION", "Pas d'action");
// define("_NO_RECORD", "Il n'y a pas d'enregistrement");
// define("_RSSC_MAIN", "Index");
define("_RSSC_SEARCH", "Chercher");
define("_RSSC_LATEST_FEEDS", "Derniers RDF/RSS/ATOM");
define("_RSSC_THEREARE", "<b>%s</b> items trouv&eacute;s dans la base.");
define("_RSSC_HEADLINE", "RSS simple");
define("_RSSC_LASTUPDATE", "Derni&egrave;re MAJ");
define("_RSSC_SINGLE", "Alimentation simple");
define("_RSSC_SITE_TITLE", "Titre du site");
define("_RSSC_SITE_LINK", "URL du site");
define("_RSSC_UPDATED", "Mis &agrave; jour");
define("_RSSC_LINK_ID", "ID du lien");
define("_RSSC_USER_ID", "ID de l'utilisateur");
define("_RSSC_MOD_ID", "ID du module");
define("_RSSC_LTYPE", "Type");
define("_RSSC_REFRESH_INTERVAL", "Interval de r&eacute;g&eacute;n&eacute;ration");
define("_RSSC_HEADLINE_ORDER", "Poids");
define("_RSSC_ENCODING", "Codage ");
define("_RSSC_RDF_URL", "URL RDF");
define("_RSSC_RSS_URL", "URL RSS");
define("_RSSC_ATOM_URL", "URL ATOM");
define("_RSSC_RSS_MODE", "Mode RSS");
define("_RSSC_RSS_MODE_NON", "Non");
define("_RSSC_RSS_MODE_RDF", "Format RDF");
define("_RSSC_RSS_MODE_RSS", "Format RSS");
define("_RSSC_RSS_MODE_ATOM", "Format ATOM");
define("_RSSC_RSS_MODE_AUTO", "Auto Detection");
define("_RSSC_FEED_ID", "ID du fil");
define("_RSSC_MODE_CONT", "Mode");
define("_RSSC_RAWS", "Donn&eacute;es Raw");
define("_RSSC_SEARCH_FIELD", "Champ Recherche");
define("_RSSC_BLACK_ID", "Black ID");
define("_RSSC_WHITE_ID", "White ID");
define("_RSSC_NO_HEADLINK", "there are no selected headlink link");
define("_RSSC_NO_FEED", "there are no feed data");
define("_RSSC_SINGLE_LINK", "Lien simple");
define("_RSSC_SINGLE_LINK_UTF8", "Lien simple avec UTF-8");
define("_RSSC_ASSUME_ENCODING", "assume xml encoding %s ,<br />because cannot detect encoding automatically");
// define("_RSSC_CREATED", "Cr&eacute;er");
// define("_RSSC_ATOM_CONTRIBUTOR_NAME", "Auteur");
// define("_RSSC_ATOM_CONTRIBUTOR_URI", "Auteur URL");
// define("_RSSC_ATOM_CONTRIBUTOR_EMAIL", "Auteur email");
define("_RSSC_PODCAST", "Podcast");
// define("_RSSC_ENCLOSURE_URL", "Enclosure Url");
// define("_RSSC_ENCLOSURE_TYPE", "Enclosure Type");
// define("_RSSC_ENCLOSURE_LENGTH", "Enclosure Length");
// define("_HOME", "Accueil");
define("_RSSC_DB_ERROR", "Erreur dans la base de donn&eacute;es RSSC");
define("_RSSC_DISCOVER_SUCCEEDED", "D&eacute;couverte automatique des flux RSS ex&eacute;cut&eacute; avec succ&egrave;s");
define("_RSSC_DISCOVER_FAILED", "D&eacute;couverte automatique des flux RSS en erreur");
define("_RSSC_PARSE_MSG", "RSS Parse Message");
define("_RSSC_PARSE_FAILED", "RSS Parse Failed");
define("_RSSC_PARSE_NOT_READ_XML_URL", "RSS Parse Failed: not read RSS url");
define("_RSSC_PARSE_NOT_FIND_ENCODING", "RSS Parse Failed: not find encoding");
define("_RSSC_REFRESH_ERROR", "Erreur de rafraichissement RSS");
define("_RSSC_LINK_NOT_EXIST", "Il n'y a pas de lien correspondant dans le module RSSC");
define("_RSSC_LINK_EXIST_MORE", "Il y a 2 liens ou pluss qui ont la m&ecirc;me URL \"RDF/RSS/ATOM\"");
define("_RSSC_LINK_ALREADY", "Ce lien existe d&eacute;j&agrave;");
define("_RSSC_REFRESH_LINK", "Rafraichissement des flux RDF/RSS/ATOM");
define("_RSSC_REFRESH_LINK_DSC", "Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.");
define("_RSSC_REFRESH_LINK_FINISHED", "Rafraichissement termin&eacute;");
define("_RSSC_RSSC_LID", "Lien du module RSSC");
define("_RSSC_RSSC_LID_UPDATE", "Lien de mise &agrave; jour du module RSSC");
define("_RSSC_GOTO_RSSC_ADMIN_LINK", "Aller &agrave; la page d'administration du module RSSC");
define("_RSSC_WORD_ID", "ID du mot");
define("_RSSC_WORD_WORD", "Mot rejet&eacute;");
define("_RSSC_WORD_POINT", "Point");
define("_RSSC_ACT", "Statut");
define("_RSSC_ACT_NON", "Invalide");
define("_RSSC_ACT_ACT", "Valide");
define("_RSSC_REG", "Expression of URL");
define("_RSSC_REG_NORMAL", "Normal");
define("_RSSC_REG_EXP", "Expression r&eacute;guli&egrave;re");
define("_RSSC_FREQ_COUNT", "Fr&eacute;quence");
define("_RSSC_FEED_ACT", "Statut");
define("_RSSC_FEED_ACT_NON", "Pas vu");
define("_RSSC_FEED_ACT_VIEW", "Vu");
define("_RSSC_LTYPE_NON", "Ne pas r&eacute;g&eacute;n&eacute;rer le flux");
define("_RSSC_LTYPE_SEARCH", "Recherche du site");
define("_RSSC_LTYPE_NORMAL", "Normal");
define("_RSSC_XML_URL", "URL RDF/RSS/ATOM");
define("_RSSC_LINK_ENCLOSURE", "Operation of enclusure tag");
define("_RSSC_LINK_ENCLOSURE_NON", "Ne pas utiliser");
define("_RSSC_LINK_ENCLOSURE_POD", "Assume PodCast");
define("_RSSC_LINK_CENSOR", "Mots &grave; déeacute;tecter dans le titre");
define("_RSSC_LINK_PLUGIN", "Plugin");
define("_RSSC_BW_CACHE", "Cache of feed count");
define("_RSSC_BW_CTIME", "Cache Time of feed count");
define("_RSSC_KEYWORD", "Mot cl&eacute;");


}
// --- define language end ---

?>