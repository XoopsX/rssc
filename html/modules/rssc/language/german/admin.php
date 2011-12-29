<?php
// $Id: admin.php,v 1.1 2011/12/29 14:37:08 ohwada Exp $

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
define('_AM_RSSC_CONF', 'RSS Zentrum  Chefetage');
define('_AM_RSSC_LIST_LINK', 'Link Liste');
define('_AM_RSSC_LIST_BLACK', 'Blackliste');
define('_AM_RSSC_LIST_WHITE', 'Whiteliste ');
define('_AM_RSSC_LIST_FEED', 'Artikel Liste');
define('_AM_RSSC_ADD_LINK', 'Link hinzufügen');
define('_AM_RSSC_ADD_BLACK', 'Blackliste hinzufügen');
define('_AM_RSSC_ADD_WHITE', 'Whiteliste hinzufügen');
define('_AM_RSSC_ADD_KEYWORD', 'Keyword hinzufügen');
define('_AM_RSSC_ARCHIVE_MANAGE', 'Archiv Management');
//define('_AM_RSSC_COMMAND_MANAGE', 'Command Management');
define('_AM_RSSC_UPDATE_MANAGE', 'Import Management');
define('_AM_RSSC_VIEW_RSS', 'Vorschau RDF/RSS/ATOM');
//define('_AM_RSSC_GOTO_MODULE', 'Goto Module');
// === index & config ===
define('_AM_RSSC_FORM_BASIC', 'Grundeinstellung');
define('_AM_RSSC_FORM_BASIC_DESC', 'Gemeinsame Nutzung in allen Modulen');
define('_AM_RSSC_FORM_MAIN', 'Hauptansicht Konfiguration');
define('_AM_RSSC_FORM_MAIN_DESC', 'Hauptseite von diesem Modul nutzen');
define('_AM_RSSC_FORM_BLOCK', 'Blockeinstellungen');
define('_AM_RSSC_FORM_BLOCK_DESC', 'Block dieses Moduls nutzen');
//define('_AM_RSSC_FORM_BIN', 'Command Config');
//define('_AM_RSSC_FORM_BIN_DESC', 'It is used on bin command');
//define('_AM_RSSC_INIT_NOT', 'The config table is not initialized');
//define('_AM_RSSC_INIT_EXEC', 'Initialized the config table');
//define('_AM_RSSC_VERSION_NOT', 'It is not version  %s');
//define('_AM_RSSC_UPGRADE_EXEC', 'Upgrade the config table');
//define('_AM_RSSC_WARNING_NOT_WRITABLE', 'Not writable the directory');
//define('_AM_RSSC_CONF_NAME', 'Item');
define('_AM_RSSC_DBUPDATED', 'Datenbank Updated vollständig!');
define('_AM_RSSC_FAILUPDATE', 'Fehler beim Speichern in die Datenbank');
define('_AM_RSSC_FAILDELETE', 'Fehler beim Löschen aus der Datenbank');
define('_AM_RSSC_THERE_ARE_LINKS', 'Es gibt <b>%s</b> Links in der Datenbank');
define('_AM_RSSC_THERE_ARE_FEEDS', 'Es gibt <b>%s</b> Feeds in der Datenbank');
// === link manage ===
define('_AM_RSSC_LINK_MANAGE', 'Link Management');
define('_AM_RSSC_MOD_LINK', 'Andern Link');
define('_AM_RSSC_DEL_LINK', 'Löschen Link');
define('_AM_RSSC_SHOW_RSS', 'Ansicht RSS');
define('_AM_RSSC_SHOW_FEED', 'Ansicht Eingabe');
define('_AM_RSSC_FEED_BELONG_LINK', 'Ansicht-Eingabe Zugehörigkeit zu diesem Link');
define('_AM_RSSC_ERROR_FILL', 'Fehler: Enter %s');
define('_AM_RSSC_ERROR_ILLEGAL', 'Fehler: Illegal %s');
// === black list manage ===
define('_AM_RSSC_BLACK_MANAGE', 'Blacklist Managemnet');
define('_AM_RSSC_MOD_BLACK', 'Ändern Blacklist');
define('_AM_RSSC_DEL_BLACK', 'Löschen Blacklist');
define('_AM_RSSC_FEED_MATCH_LINK', 'RSS-Feeds anzeigen, in dieser Liste');
// === white list manage ===
define('_AM_RSSC_WHITE_MANAGE', 'Whitelist Managemnet');
define('_AM_RSSC_MOD_WHITE', 'Ändern Whitelist');
define('_AM_RSSC_DEL_WHITE', 'Löschen Whitelist');
// === feed list manage ===
define('_AM_RSSC_ADD_FEED', 'Hinzufügen Feed');
define('_AM_RSSC_MOD_FEED', 'Ändern Feed');
define('_AM_RSSC_DEL_FEED', 'Löschen Feed');
define('_AM_RSSC_THERE_ARE_MATCH', 'Es gibt <b>% s </ b>, Daten mit Bedingungen');
define('_AM_RSSC_CONDITION', 'Bedingungen');
// === archive manage ===
define('_AM_RSSC_REFRESH', 'Auffrischen Archive');
define('_AM_RSSC_REFRESH_NEXT', 'überprüfe nächste %s');
define('_AM_RSSC_LINK_LIMIT', 'Link Limit');
define('_AM_RSSC_LINK_OFFSET', 'Link Offset');
define('_AM_RSSC_FEED_CLEAR', 'Archive säubern');
define('_AM_RSSC_FEED_CLEAR_OLD', 'Ältere säubern');
define('_AM_RSSC_FEED_CLEAR_NUM', 'Löscht die älteren Aufzeichnungen, wenn mehr als die angegebene Zahl');
// refresh result
define('_AM_RSSC_NO_REFRESH', 'Kein Link verändert');
define('_AM_RSSC_TIME_START', 'Start Zeit');
define('_AM_RSSC_TIME_END', 'Endzeit');
define('_AM_RSSC_TIME_ELAPSE', 'Ablaufzeit');
define('_AM_RSSC_MIN_SEC', '%s min %s sec');
define('_AM_RSSC_NUM_LINK_TOTAL', 'Gesamt Links');
define('_AM_RSSC_NUM_LINK_TARGET', 'Die Anzahl der Ziel-Links');
define('_AM_RSSC_NUM_LINK_BROKEN', 'Die Anzahl der deffekten-Links');
define('_AM_RSSC_NUM_LINK_UPDATED', 'Die Anzahl der veränderten-Links');
define('_AM_RSSC_NUM_FEED_UPDATED', 'Die Anzahl der aktualisierten Eingaben');
define('_AM_RSSC_NUM_FEED_CLEARED', 'Die Anzahl der gelöschten Eingaben');
define('_AM_RSSC_NUM_LINKS', 'Links');
define('_AM_RSSC_NUM_FEEDS', 'Eingabe');
define('_AM_RSSC_FAILGET', 'Nicht in Funktion  XML von %s');
define('_AM_RSSC_GOTOTOP', 'Gehe zum Anfang');
// === configuration ===
// basic configuration
define('_AM_RSSC_CONF_FEED_LIMIT', 'Die maximale Anzahl von RSS-Eingabe');
define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'Geben Sie die maximale Anzahl von RSS-Feeds in Feed-Tabelle<br />die älteren Löschen,sobald sie mehr als dieser Wert<br /><b>0</b> ist es unbegrenzt');
define('_AM_RSSC_CONF_RSS_ATOM', 'Makiere RSS or ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'Wählen Sie RSS oder ATOM, wenn beide RSS-und ATOM-URL URL entdeckt worden sind');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS', 'RSS');
define('_AM_RSSC_CONF_RSS_PARSER', 'Wählen Sie RSS paser');
define('_AM_RSSC_CONF_RSS_PARSER_SELF', 'RSSC parser');
define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS Parser');
define('_AM_RSSC_CONF_ATOM_PARSER', 'Wähle ATOM parser');
define('_AM_RSSC_CONF_ATOM_PARSER_0', 'RSSC parser');
define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
define('_AM_RSSC_CONF_RSS_MODE', 'Initial-Wert von RSS mode');
define('_AM_RSSC_CONF_XML_SAVE', 'Speichern XML');
define('_AM_RSSC_CONF_XML_SAVE_DESC', 'XML zu speichern in die Link Tabelle');
define('_AM_RSSC_CONF_FUTURE_DAYS', 'unbestimmter Zeitpunkt');
define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', 'Eine Einheit ist ein Tag<br />Feed nicht anzeigen,wenn er nicht mit den Tagen übereinstimmt');
// show configuration
define('_AM_RSSC_CONF_SHOW_ORDER', 'Zeigen');
//define('_AM_RSSC_CONF_SHOW_ORDER_DESC', '');
define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED', 'Letzte Updates');
define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED', 'Letzte Veröffentlichung');
define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE', 'Links pro Seite');
//define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC', '');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE', 'Feeds pro Seite');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC', '');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK', 'Feeds pro Link');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC', '');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE', 'Die maximale Anzahl der Zeichen des Titels');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC', 'HTML-Tags sind zugelassen, wenn mehr als diese Anzahl<br /><b>-1</b> ist unlimitiert');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY', 'Die maximale Anzahl der Zeichen der Zusammenfassung');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC', '<b>-1</b> ist unbegrenzt');
// main configuration
define('_AM_RSSC_CONF_MAIN_SEARCH_MIN', 'Die Anzahl der Zeichen mindestens der Keyword-Suche');
//define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC', '');
// bin configuration
//define('_AM_RSSC_CONF_BIN_PASS', 'Password');
//define('_AM_RSSC_CONF_BIN_PASS_DESC', '');
//define('_AM_RSSC_CONF_BIN_SEND', 'Send Mail');
//define('_AM_RSSC_CONF_BIN_SEND_DESC', '');
//define('_AM_RSSC_CONF_BIN_MAILTO', 'Email to send');
//define('_AM_RSSC_CONF_BIN_MAILTO_DESC', '');
// === view rss ===
define('_AM_RSSC_VIEW_RSS_OPTION', 'Option einstellen');
define('_AM_RSSC_NOT_SELECT_LINK', 'Der Link ist nicht ausgewählt');
define('_AM_RSSC_PLEASE_SELECT_LINK', 'Wähle Link aus der Liste,oder wähle LINK ID');
define('_AM_RSSC_VIEW_PARSER', 'Parser Einstellung');
define('_AM_RSSC_VIEW_SAVE_ETC', 'Speicher die Tabelle, etc');
define('_AM_RSSC_VIEW_MODE', 'Ansicht');
define('_AM_RSSC_VIEW_MODE_DESC', 'NIcht speichern in Tabelle, Wenn Mode is 0');
define('_AM_RSSC_VIEW_MODE_CURRENT', 'Mode 0: XML-Daten erhalten');
define('_AM_RSSC_VIEW_MODE_LINK', 'mode 1: XML Daten speichern in Link Tabelle');
define('_AM_RSSC_VIEW_MODE_FEED', 'mode 2: Daten speichern in Eingabe Tabelle');
define('_AM_RSSC_VIEW_SANITIZE', 'HTML Saniert');
define('_AM_RSSC_VIEW_TITLE_HTML', 'Zeigen HTML tags des Titel');
define('_AM_RSSC_VIEW_TITLE_HTML_DESC', 'Wenn ja ausgewählt, zeigen inclusive HTML tags. <br />Wenn nein ausgewählt, ohne HTML tags zeigen. ');
define('_AM_RSSC_VIEW_CONTENT_HTML', 'Zeigen HTML Tags Inhalt');
define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', 'Wenn ja ausgewählt, zeigen inclusive HTML tags. <br />Wenn nein ausgewählt, ohne HTML tags zeigen. ');
define('_AM_RSSC_VIEW_MAX_CONTENT', 'Die maximale Anzahl der Zeichen von Content');
define('_AM_RSSC_VIEW_MAX_CONTENT_DESC', 'HTML Tags begrenzt, wenn mehr Zeichen sind<br /><b>-1</b> ist es unlimited');
define('_AM_RSSC_VIEW_LINK_UPDATE', 'Update Link Tabelle');
define('_AM_RSSC_VIEW_FEED_UPDATE', 'Update EingabeTabelle');
define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'Force zu entdecken RSS-URL');
define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'Überschreiben RDF/RSS/ATOM URL,wenn diese URL nicht im Zusammenhang mit RSS-Modus steht');
define('_AM_RSSC_VIEW_FORCE_UPDATE', 'Force update Archiv');
define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', 'Überschreiben Archiv, wenn RDF/RSS/ATOM nicht im Zusammenhang mit Refresh-Intervall');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'Force update Feed table');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', 'Overwrite Feed, auch wenn es die für die gleichen Daten RDF/RSS/ATOM URL');
define('_AM_RSSC_VIEW_PRINT_LOG', 'Anzeige Log');
define('_AM_RSSC_VIEW_PRINT_LOG_DESC', 'Anzeige Log gleichzeitig während der Ausführung');
define('_AM_RSSC_VIEW_PRINT_ERROR', 'Anzeige Fehler');
define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', 'Anzeige Fehler gleichzeitig während der Ausführung');
// === command manage ===
define('_AM_RSSC_CREATE_CONFIG', 'Konfiguration erstellen');
define('_AM_RSSC_TEST_BIN_REFRESH', 'Ausgang testen bin/refresh.php');
// === update manage ===
define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'Import von XoopsHeadline');
define('_AM_RSSC_IMPORT_WEBLINKS', 'Import von WebLinks');
// === rename ===
define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

// 2006-01-20
define('_AM_RSSC_ID_ASC', 'ID Stufe');
define('_AM_RSSC_ID_DESC', 'ID Übertragung');
// === 2006-06-04 ===
// build rss
//define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
//define('_AM_RSSC_BUILD_DSC', 'Build and show RDF/RSS/ATOM for debug');
//define('_AM_RSSC_BUILD_RDF', 'Build RDF');
//define('_AM_RSSC_BUILD_RSS', 'Build RSS');
//define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');
// parse rss
define('_AM_RSSC_PARSE_RSS', 'Parse RDF/RSS/ATOM');
// refresh link
//define('_AM_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
//define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.');
//define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');
// === 2006-07-08 ===
// description at main
define('_AM_RSSC_CONF_INDEX_DESC', 'Beschreibung auf Startseite');
define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'Beschreibung wenn Sie möchten, um auf die Hauptseite zu gelangen.');
define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Hier sind Beschreibung zu     beachten.<br />Sie können Beschreibung bearbeiten unter "Module Konfiguration".<br /></div><br />');
// link table
define('_AM_RSSC_LINK_DESC', 'Finden <b>RDF/RSS/ATOM URL</b> automatisch erkennen <b>Encoding</b> wenn nicht ausgefüllt <br />bzw. bei Fehler, <br />Support aufsuchen "RSS Auto Discovery"');
//define('_AM_RSSC_LINK_EXIST', 'Already exists this "RDF/RSS/ATOM URL"');
//define('_AM_RSSC_LINK_EXIST_MORE', 'There are twe or more links which have same "RDF/RSS/ATOM URL" ');
//define('_AM_RSSC_AUTO_FIND_FAILD', 'RSS Auto Discovery Faild');
define('_AM_RSSC_LINK_FORCE', 'Froce speichern');
// black & white table
define('_AM_RSSC_BLACK_MEMO', 'Memo');
// === 2006-09-20 ===
// show content with html
define('_AM_RSSC_CONF_SHOW_TITLE_HTML', 'HTML Tag nutzen beim Titel');
define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', 'Wenn "Ja",Titel zeigen mit HTML-Tags, falls der Titel haben HTML-Tag. <br /> Wenn "NEIN", zeigen Titel Striping HTML-Tag. ');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML', 'HTML Tag nutzen für Content');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', 'Wenn "Ja",Inhalt zeigen mit HTML Tag, wenn Inhalt HTML Tag hat. <br />Wenn "NEIN", zeigen Inhalt Striping HTML-Tag. ');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT', 'Die maximale Anzahl der Zeichen vom Inhalt');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'HTML-Tags sind stripped, wenn mehr als diese Anzahl<br /><b>-1</b> ist unlimited');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT', 'Maximale Anzahl RSS/ATOM Feeds Anzeige im Content');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', 'Maximale Anzahl  RSS/ATOM Eingabe Anzeige Inhalt');
define('_AM_RSSC_CONF_SHOW_BLOG_LID', 'Link ID anzeigen im Block');
//define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');
define('_AM_RSSC_TABLE_MANAGE', 'DB Tabelle Managen');
// === 2006-11-08 ===
// proxy server
define('_AM_RSSC_FORM_PROXY', 'Proxy Server Einstellungen');
define('_AM_RSSC_CONF_PROXY_USE', 'Proxy Server nutzen');
define('_AM_RSSC_CONF_PROXY_HOST', 'Proxy Host');
define('_AM_RSSC_CONF_PROXY_PORT', 'Proxy Port');
define('_AM_RSSC_CONF_PROXY_USER', 'Proxy Username');
define('_AM_RSSC_CONF_PROXY_USER_DESC', 'Geben Sie Benutzernamen, wenn der Proxy-Server-Authentifizierung benötigt BASIC, <br />wenn nicht frei lassen');
define('_AM_RSSC_CONF_PROXY_PASS', 'Proxy Password');
define('_AM_RSSC_CONF_PROXY_PASS_DESC', 'Geben Sie das Passwort ein, wenn der Proxy-Server-Authentifizierung benötigt BASIC, <br />wenn nicht bleibt leer');
define('_AM_RSSC_CONF_HIGHLIGHT', 'Verwenden Sie Keyword-Highlight');
// === 2007-06-01 ===
// word_list
define('_AM_RSSC_LIST_WORD', 'verbotene Wort Liste');
define('_AM_RSSC_WORD_MANAGE', 'verbotene Wort Liste Management');
define('_AM_RSSC_ADD_WORD', 'verbotene Worte einfügen');
define('_AM_RSSC_MOD_WORD', 'verbotene Worte ändern');
define('_AM_RSSC_DEL_WORD', 'verbotene Worte löschen');
define('_AM_RSSC_POINT_ASC', 'Kleine Bestell Nummer');
define('_AM_RSSC_POINT_DESC', 'Mehr Bestell-Nummern');
define('_AM_RSSC_COUNT_ASC', 'Kleiner Frequenz Count Bestellung');
define('_AM_RSSC_COUNT_DESC', 'Mehrere Frequenz Count Bestellung');
define('_AM_RSSC_WORD_ASC', 'A-Z');
define('_AM_RSSC_WORD_DESC', 'Z-A');
define('_AM_RSSC_NON_ACT', 'Liste nicht anzeigen');
define('_AM_RSSC_NON_ACT_ASC', 'ID Ascent nicht anzeigen');
define('_AM_RSSC_NON_ACT_DESC', 'ID Descent nicht anzeigen');
define('_AM_RSSC_WORD_ALREADY', 'Dieses Wort ist bereits registriert');
define('_AM_RSSC_WORD_SEARCH', 'Synonym Suche');
// content filter
define('_AM_RSSC_FORM_FILTER', 'Filter einstellen');
define('_AM_RSSC_FORM_FILTER_DESC', 'Dieser Filter ist zum automatischen Speichern oder nicht in die Datenbank bei der Sammlung von RSS-Feeds');
define('_AM_RSSC_CONF_LINK_USE', 'Benutze Link Tabelle');
define('_AM_RSSC_CONF_LINK_USE_DESC', 'Speicher, wenn "Type" der Link Tabelle ist "Normal"');
define('_AM_RSSC_CONF_WHITE_USE', 'Benutze White Liste');
define('_AM_RSSC_CONF_WHITE_USE_DESC', 'Gespeichert, wenn in der weißen Liste');
define('_AM_RSSC_CONF_BLACK_USE', 'Benutze Black Liste');
define('_AM_RSSC_CONF_BLACK_USE_DESC', 'Nicht speichern, wenn in der schwarzen Liste <br /> Wenn Sie "Use", Interrupt-Filter-Prozess, wenn Richter schwarz <br /> Wenn Sie "lernen", weiterhin Filter-Prozess, für den Zweck Extraktion Worten, wenn Richtung schwarz');
define('_AM_RSSC_CONF_BLACK_USE_DESC', 'Nicht speichern, wenn in der schwarzen Liste <br /> Wenn Sie "Use", Interrupt-Filter-Prozess, wenn Richter schwarz <br /> Wenn Sie "lernen", weiterhin Filter-Prozess, für den Zweck Extraktion Worten, wenn Richtung schwarz');
define('_AM_RSSC_CONF_BLACK_USE_NO', 'nicht benutzt');
define('_AM_RSSC_CONF_BLACK_USE_YES', 'nutzen');
define('_AM_RSSC_CONF_BLACK_USE_LEARN', 'lernen');
define('_AM_RSSC_CONF_WORD_USE', 'Verwenden Sie Liste abgelehnte Worte');
define('_AM_RSSC_CONF_WORD_USE_DESC', 'Nicht gespeichert wenn insgesamt Worte Liste übersteigen dann Stufe nablehnen');
define('_AM_RSSC_CONF_WORD_LEVEL', 'abgelehntes Stufe');
define('_AM_RSSC_CONF_FEED_SAVE', 'Eingabe speichern');
define('_AM_RSSC_CONF_FEED_SAVE_DESC', 'Wenn insgesamt der Wort-Liste übersteigen ablehnen Ebene');
define('_AM_RSSC_CONF_FEED_SAVE_NO', 'Nicht gespeichert');
define('_AM_RSSC_CONF_FEED_SAVE_YES', 'Speichern');
define('_AM_RSSC_CONF_LOG_USE', 'Benutze Log File');
define('_AM_RSSC_CONF_LOG_USE_DESC', 'Schreibe Log File wenn judge black');
define('_AM_RSSC_CONF_WHITE_COUNT', 'Berechne White List');
define('_AM_RSSC_CONF_WHITE_COUNT_DESC', 'Vorrangig mit passenden Datensatz, wenn in der weißen Liste');
define('_AM_RSSC_CONF_BLACK_COUNT', 'Berechne Black List');
define('_AM_RSSC_CONF_BLACK_COUNT_DESC', 'Berechne die mit passender Datensatz als Liste mit Block');
define('_AM_RSSC_CONF_WORD_COUNT', 'Berechne Liste abgelehnte Worte');
define('_AM_RSSC_CONF_WORD_COUNT_DESC', 'Zählen Sie die passenden Einträge mit ablehnen, wenn in der Wort-Liste');
define('_AM_RSSC_CONF_BLACK_AUTO', 'In die Black Liste einfügen');
define('_AM_RSSC_CONF_BLACK_AUTO_DESC', 'URL hinzufügen in schwarzen Liste automatisch<b> <br /> </ b> "Status" ist als "ungültig" <br /> Bitte ändern Sie in "gültig", wenn Sie');
define('_AM_RSSC_CONF_WORD_AUTO', 'In die Bad Word Liste einfügen');
define('_AM_RSSC_CONF_WORD_AUTO_DESC', 'Auswahl Wörter in der Content automatisch, und fügen Sie Wörter in Wort ablehnen Liste automatisch<b> <br /> </ b> "point" ist als Null <br /> Bitte ändern "point", wenn Sie');
define('_AM_RSSC_CONF_WORD_AUTO_NON', 'Nicht eingefügt');
define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL', 'Auswahl durch das Symbol Pause');
define('_AM_RSSC_CONF_WORD_AUTO_KAKASI', 'Auswahl by KAKASI: nur Japanisch');
// word extract
define('_AM_RSSC_FORM_WORD', 'Wort Auswahl Einstellung');
define('_AM_RSSC_CONF_JOIN_PREV', 'Wort verbinden');
define('_AM_RSSC_CONF_JOIN_PREV_DESC', 'Gehe vor und zurück, und bilden Sie eine Phrase');
define('_AM_RSSC_CONF_JOIN_GLUE', 'Wort Speicher');
define('_AM_RSSC_CONF_JOIN_GLUE_DESC', 'Auf Englisch eingestellt Raum <br /> auf Japanisch eingestellt fest,');
define('_AM_RSSC_CONF_KAKASI_PATH', 'Command Path of KAKASI');
define('_AM_RSSC_CONF_KAKASI_MODE', 'Mode of KAKASI');
define('_AM_RSSC_CONF_KAKASI_MODE_FILE', 'Nutze temp File');
define('_AM_RSSC_CONF_KAKASI_MODE_PIPE', 'Benutze UNIX Pipe');
define('_AM_RSSC_CONF_CHAR_LENGTH', 'Die minimale Anzahl der Zeichen');
define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', 'Die minimale Anzahl der Zeichen der exakten  Worte');
define('_AM_RSSC_CONF_WORD_LIMIT', 'Maximale Anzahl der verbotenen Worte');
define('_AM_RSSC_CONF_WORD_LIMIT_DESC', 'Geben Sie die maximale Anzahl der gespeicherten Wort in Wort Tisch <br /> Löscht den älteren Aufzeichnungen, sobald sie mehr als dieser Wert <b> 0 <br /> </ b> ist umlimited');
define('_AM_RSSC_KAKASI_EXECUTABLE', 'kakasi ist ausführbar');
define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'kakasi ist nicht ausführbar');
define('_AM_RSSC_CONF_HTML_GET', 'HTML');
define('_AM_RSSC_CONF_HTML_GET_DESC', 'Sie Herkunft HTML-Daten automatisch, wenn Richter ablehnen Wort Liste <br /> Wenn Sie "Use", die Präzision des Urteils wird verbessert, aber die Ausführung lange Zeit geworden');
define('_AM_RSSC_CONF_HTML_GET_NO', 'Nicht benutzt');
define('_AM_RSSC_CONF_HTML_GET_YES', 'Benutzen');
define('_AM_RSSC_CONF_HTML_GET_BLACK', 'Benutze wenn bewertete Black');
define('_AM_RSSC_CONF_HTML_LIMIT', 'Die Maximum Anzahl von HTML-Zeichen');
define('_AM_RSSC_CONF_HTML_LIMIT_DESC', 'Die maxmum Reihe von HTML-Zeichen, die sich automatisch <br /> An einigen Standorten ist die große HTML-Daten, und dann ist die Ausführung lange Zeit geworden');
// archive manage
define('_AM_RSSC_LEAN_BLACK', 'Black List erlermen');
define('_AM_RSSC_LEAN_BLACK_DESC', 'Patrol in die schwarze Liste, für die Zwecke Extrahieren Wörter in der Content automatisch, und das Hinzufügen von Wörtern in der Liste automatisch ablehnen Wort');
define('_AM_RSSC_NUM_FEED_ALL', 'Die Zahl der RSS-Feeds');
define('_AM_RSSC_NUM_FEED_SKIP', 'Die Zahl der bereits gespeicherten Feeds');
define('_AM_RSSC_NUM_FEED_REJECT', 'Die Zahl der bewerteten schwarz-Feeds');
define('_AM_RSSC_THEREARE_TITLE', 'In verwandten <b>% s </ b> gibt es <b>% s </ b>');
// === 2007-10-10 ===
// config
define('_AM_RSSC_CONF_SHOW_MODE_DATE', 'Zeit Modus');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON', 'Keine Ansicht');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT', 'Kurz');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', 'Mitte');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG', 'Lang');
define('_AM_RSSC_CONF_SHOW_SITE', 'Seiten Information');
define('_AM_RSSC_CONF_SHOW_SITE_DSC', 'Wenn Ja,zeige Seiten Titel und url');
// link table
define('_AM_RSSC_LINK_CENSOR_DESC', 'Trennen Sie die einzelnen mit einem <b> | </ b> <br /> Groß-und Kleinschreibung');
}
// --- define language begin ---

?>