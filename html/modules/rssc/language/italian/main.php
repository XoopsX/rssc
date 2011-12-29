<?php
// $Id: main.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

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
define('_ADDED','Aggiunto');
define('_DELETED','Cancellato');
define('_UPDATE', 'Aggiorna');
define('_UPDATED','Aggiornato');
define('_MODIFY',  'Modifica');
define('_MODIFIED','Modificato');
//define('_SAVE', 'Save');
//define('_SAVED','Saved');
define('_CLEAR',  'Azzera');
define('_CLEARED','Azzerato');
//define('_EXECUTE', 'Execute');
//define('_EXECUTED','Executed');
//define('_CREATE', 'Create');
//define('_CREATED','Created');

define('_VISIT','Visita');
define('_SHOW','Mostra');
define('_KEYWORD','Keyword');
define('_NUM','Num');
define('_NO_ACTION','Nessuna Azione');
define('_NO_RECORD','Non ci sono record');

// index & search
define('_RSSC_MAIN','Principale');
define('_RSSC_SEARCH','Cerca');
define('_RSSC_LATEST_FEEDS','Ultimi RDF/RSS/ATOM Feeds');
define('_RSSC_THEREARE','Ci sono <b>%s</b> dati nel database');

// headline
define('_RSSC_HEADLINE','Headline Semplice');
define('_RSSC_LASTUPDATE','Ultimo aggiornamento');

// single
define('_RSSC_SINGLE','Feed Singolo');

// common
define('_RSSC_SITE_TITLE','Titolo Sito');
define('_RSSC_SITE_LINK', 'URL Sito');

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

define('_RSSC_UPDATED',   'Aggiornato');

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
define('_RSSC_LINK_ID','ID Link');
define('_RSSC_USER_ID','ID Utente');
define('_RSSC_MOD_ID','ID Modulo');
define('_RSSC_LTYPE','Tipo');
define('_RSSC_REFRESH_INTERVAL','Intervallo Refresh');
define('_RSSC_HEADLINE_ORDER','Ordine Headline');
define('_RSSC_ENCODING','Codifica');
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
define('_RSSC_FEED_ID','ID Feed');
define('_RSSC_MODE_CONT','Content Mode');
define('_RSSC_RAWS','Raw Data');
define('_RSSC_SEARCH_FIELD','Campo Ricerca');

// black table item
define('_RSSC_BLACK_ID','Black ID');
define('_RSSC_WHITE_ID','White ID');

// 2006-04-16 K.OHWADA
define('_RSSC_NO_HEADLINK','non ci sono link headlink selezionati');
define('_RSSC_NO_FEED','non ci sono dati feed');

// === 2006-06-04 ===
// single link
define('_RSSC_SINGLE_LINK',  'Link Singolo');
define('_RSSC_SINGLE_LINK_UTF8', 'Link Singolo con UTF-8');
//define('_RSSC_SINGLE_SUMMARY', 'Summary');
//define('_RSSC_SINGLE_CONTENT', 'Content allowed HTML tags');
//define('_RSSC_UTF8_SUMMARY', 'Summary with UTF-8');
//define('_RSSC_UTF8_CONTENT', 'Content allowed HTML tags with UTF-8');

// detect encoding
define('_RSSC_ASSUME_ENCODING', 'presumi xml encoding %s ,<br />perchè impossibile determinare automaticamente');

// rss item
define('_RSSC_CREATED', 'Creato');
define('_RSSC_ATOM_CONTRIBUTOR_NAME', 'Contributore');
define('_RSSC_ATOM_CONTRIBUTOR_URI',  'URL Contributore');
define('_RSSC_ATOM_CONTRIBUTOR_EMAIL','Email Contributore');

// === 2006-07-08 ===
// bread crumb
//define('_HOME', 'HOME');

// podcast
define('_RSSC_PODCAST', 'Podcast');
define('_RSSC_ENCLOSURE_URL',    'Enclosure Url');
define('_RSSC_ENCLOSURE_TYPE',   'Enclosure Type');
define('_RSSC_ENCLOSURE_LENGTH', 'Enclosure Length');

// === 2006-09-01 ===
// conflict with weblinks
if( !defined('_HOME') ) 
{
	define('_HOME', 'HOME');
	define('_SAVE', 'Salva');
	define('_SAVED','Salvato');
	define('_EXECUTE', 'Esegui');
	define('_EXECUTED','Eseguito');
	define('_CREATE', 'Crea');
	define('_CREATED','Creato');
}

// error message
define('_RSSC_DB_ERROR',           'Errore DB RSSC');
define('_RSSC_DISCOVER_SUCCEEDED', 'RSS Auto Discovery Succeeded');
define('_RSSC_DISCOVER_FAILED',    'RSS Auto Discovery Failed');
define('_RSSC_PARSE_MSG',          'Messaggio RSS Parse');
define('_RSSC_PARSE_FAILED',            'RSS Parse Fallito');
define('_RSSC_PARSE_NOT_READ_XML_URL',  'RSS Parse Fallito: url RSS non letto');
define('_RSSC_PARSE_NOT_FIND_ENCODING', 'RSS Parse Fallito: non trovo codifica');

define('_RSSC_REFRESH_ERROR', 'Errore RSS Refresh');
define('_RSSC_LINK_NOT_EXIST',  'Non c\'è link corrispondente in modulo RSSC');
define('_RSSC_LINK_EXIST_MORE', 'Ci sono due o più link che hanno stesso "RDF/RSS/ATOM URL"');
define('_RSSC_LINK_ALREADY',    'Esiste già un link con questo "RDF/RSS/ATOM URL"');

// refresh link
define('_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
define('_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.');
define('_RSSC_REFRESH_LINK_FINISHED', 'Feed Refresh completato');

// for other module
define('_RSSC_RSSC_LID', 'Link ID di RSSC module');
define('_RSSC_RSSC_LID_UPDATE', 'Aggiorna Link ID di RSSC module');
define('_RSSC_GOTO_RSSC_ADMIN_LINK', 'Vai a pagina admin di RSSC');

// === 2007-06-01 ===
// word table
define('_RSSC_WORD_ID','ID Parola');
define('_RSSC_WORD_WORD','Parola rifiutata');
define('_RSSC_WORD_POINT','Punti');
define('_RSSC_ACT','Status');
define('_RSSC_ACT_NON','Non valido');
define('_RSSC_ACT_ACT','Valido');
define('_RSSC_REG','Espressione URL');
define('_RSSC_REG_NORMAL','Normale');
define('_RSSC_REG_EXP','Regular Expression');
define('_RSSC_FREQ_COUNT','Conteggio Frequenza');

// feed table
define('_RSSC_FEED_ACT',     'Status');
define('_RSSC_FEED_ACT_NON', 'Non mostrare');
define('_RSSC_FEED_ACT_VIEW','Mostra');

// link table
define('_RSSC_LTYPE_NON','No refresh feed');
define('_RSSC_LTYPE_SEARCH','Ricerca Sito');
define('_RSSC_LTYPE_NORMAL','Normale');

define('_RSSC_XML_URL','RDF/RSS/ATOM URL');

}
// --- define language end ---

?>
