<?php
// $Id: admin.php,v 1.1 2011/12/29 14:37:07 ohwada Exp $

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
define('_AM_RSSC_CONF', 'Gestione RSS Center');
define('_AM_RSSC_LIST_LINK', 'Lista Link');
define('_AM_RSSC_LIST_BLACK', 'Elenco Blacklist');
define('_AM_RSSC_LIST_WHITE', 'Elenco Whitelist');
define('_AM_RSSC_LIST_FEED', 'Lista Feed');
define('_AM_RSSC_ADD_LINK', 'Aggiungi Link');
define('_AM_RSSC_ADD_BLACK', 'Aggiungi Blacklist');
define('_AM_RSSC_ADD_WHITE', 'Aggiungi Whitelist');
define('_AM_RSSC_ADD_KEYWORD', 'Aggiungi Keyword');
define('_AM_RSSC_ARCHIVE_MANAGE', 'Gestione Archivi');
define('_AM_RSSC_COMMAND_MANAGE', 'Gestione Comandi');
define('_AM_RSSC_UPDATE_MANAGE', 'Gestione Import');
define('_AM_RSSC_VIEW_RSS', 'Visual. RDF/RSS/ATOM');
define('_AM_RSSC_GOTO_MODULE', 'Vai al Modulo');

// === index & config ===
define('_AM_RSSC_FORM_BASIC', 'Config Base');
define('_AM_RSSC_FORM_BASIC_DESC', 'E\' usato in comune da tutti i moduli');
define('_AM_RSSC_FORM_MAIN', 'Config Vista Principale');
define('_AM_RSSC_FORM_MAIN_DESC', 'E\' usato sulla pagina principaale di questo modulo');
define('_AM_RSSC_FORM_BLOCK', 'Config Vista Blocco');
define('_AM_RSSC_FORM_BLOCK_DESC', 'E\' usato sul blocco di questo modulo');
define('_AM_RSSC_FORM_BIN', 'Config Comandi');
define('_AM_RSSC_FORM_BIN_DESC', 'E\' usato sui comandi bin');
define('_AM_RSSC_INIT_NOT','La tabella config non è inizializzata');
define('_AM_RSSC_INIT_EXEC','Tabella config inizializzata');
define('_AM_RSSC_VERSION_NOT','Non è la versione  %s');
define('_AM_RSSC_UPGRADE_EXEC','Aggiorna la tabella config');
define('_AM_RSSC_WARNING_NOT_WRITABLE','Directory non scrivibile');
//define('_AM_RSSC_CONF_NAME','Item');
define('_AM_RSSC_DBUPDATED', 'Database aggiornato con successo!');
define('_AM_RSSC_FAILUPDATE', 'Errore salvataggio dati nel database');
define('_AM_RSSC_FAILDELETE', 'Errore cancellazione dati da database');
define('_AM_RSSC_THERE_ARE_LINKS','Ci sono <b>%s</b> Links nel database');
define('_AM_RSSC_THERE_ARE_FEEDS','Ci sono <b>%s</b> Feeds nel database');

// === link manage ===
define('_AM_RSSC_LINK_MANAGE','Gestione Link');
define('_AM_RSSC_MOD_LINK','Modifica Link');
define('_AM_RSSC_DEL_LINK','Cancella Link');
define('_AM_RSSC_SHOW_RSS',  'Mostra RSS');
define('_AM_RSSC_SHOW_FEED', 'Show Feed');
define('_AM_RSSC_FEED_BELONG_LINK', 'Mostra feed appartenenti a questo link');
define('_AM_RSSC_ERROR_FILL', 'Errore: Inserisci %s');
define('_AM_RSSC_ERROR_ILLEGAL','Errore: Illegal %s');

// === black list manage ===
define('_AM_RSSC_BLACK_MANAGE','Gestione Blacklist');
define('_AM_RSSC_MOD_BLACK','Modifica Blacklist');
define('_AM_RSSC_DEL_BLACK','Cancella Blacklist');
define('_AM_RSSC_FEED_MATCH_LINK', 'Mostra feed corrispondenti a questa lista');

// === white list manage ===
define('_AM_RSSC_WHITE_MANAGE','Gestione Whitelist');
define('_AM_RSSC_MOD_WHITE','Modifica Whitelist');
define('_AM_RSSC_DEL_WHITE','Cancella Whitelist');

// === feed list manage ===
define('_AM_RSSC_ADD_FEED','Aggiungi Feed');
define('_AM_RSSC_MOD_FEED','Modifica Feed');
define('_AM_RSSC_DEL_FEED','Cancella Feed');
define('_AM_RSSC_THERE_ARE_MATCH','Ci sono <b>%s</b> dati corrispondenti alle condizioni');
define('_AM_RSSC_CONDITION','Condizione');

// === archive manage ===
define('_AM_RSSC_REFRESH', 'Refresh Archivio');
define('_AM_RSSC_REFRESH_NEXT','Controlla Prox %s');
define('_AM_RSSC_LINK_LIMIT', 'Limite Link');
define('_AM_RSSC_LINK_OFFSET','LInk Offset');
define('_AM_RSSC_FEED_CLEAR','Azzera Archivio');
define('_AM_RSSC_FEED_CLEAR_OLD','Azzera record più vecchi');
define('_AM_RSSC_FEED_CLEAR_NUM','Azzera record più vecchi, se eccedono il numero specificato');

// refresh result
define('_AM_RSSC_NO_REFRESH','Nessun link da aggiornare');
define('_AM_RSSC_TIME_START','Ora inizio');
define('_AM_RSSC_TIME_END','Ora fine');
define('_AM_RSSC_TIME_ELAPSE','Tempo trascorso');
define('_AM_RSSC_MIN_SEC','%s min %s sec');
define('_AM_RSSC_NUM_LINK_TOTAL','Totale Link');
define('_AM_RSSC_NUM_LINK_TARGET','Il numero di target link');
define('_AM_RSSC_NUM_LINK_BROKEN','Il numero di link non validi');
define('_AM_RSSC_NUM_LINK_UPDATED','Il numero di link aggiornati');
define('_AM_RSSC_NUM_FEED_UPDATED','Il numero di feed aggiornati');
define('_AM_RSSC_NUM_FEED_CLEARED','Il numero di feed azzerati');
define('_AM_RSSC_NUM_LINKS','links');
define('_AM_RSSC_NUM_FEEDS','feeds');
define('_AM_RSSC_FAILGET', 'Impossibile ricevere XML da %s');
define('_AM_RSSC_GOTOTOP', 'Vai all\'inizio');

// === configuration ===
// basic configuration
define('_AM_RSSC_CONF_FEED_LIMIT', 'Il numero max di feed');
define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'Inserire il num. max di feed salvati in tabella feed<br />Azzera record più vecchi, quando sono più di questo valore<br /><b>0</b> è illimitato');
define('_AM_RSSC_CONF_RSS_ATOM', 'Scegli RSS o ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'Scegli RSS o ATOM, se entrambi presenti nell\'URL indicato');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS',  'RSS');
define('_AM_RSSC_CONF_RSS_PARSER', 'Scegli parser RSS');
define('_AM_RSSC_CONF_RSS_PARSER_SELF',  'RSSC parser');
define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS Parser');
define('_AM_RSSC_CONF_ATOM_PARSER', 'scegli parser ATOM');
define('_AM_RSSC_CONF_ATOM_PARSER_0', 'RSSC parser');
define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
define('_AM_RSSC_CONF_RSS_MODE', 'Valore iniziale dell\'RSS mode');
define('_AM_RSSC_CONF_XML_SAVE', 'Salva XML');
define('_AM_RSSC_CONF_XML_SAVE_DESC', 'salva XML ottenuto in tabella link');
define('_AM_RSSC_CONF_FUTURE_DAYS', 'Giorni futuri');
define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', "Misurato in giorni<br />Non mostrare feed, se la data del feed è in avanti più di questo valore");

// show configuration
define('_AM_RSSC_CONF_SHOW_ORDER','Ordine Visual.');
//define('_AM_RSSC_CONF_SHOW_ORDER_DESC','');
define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED','Ultimo Aggiornato');
define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED','Ultimo Pubblicato');
define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE','Links per pag.');
//define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE','Feeds per pag.');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK','Feeds per link');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE','Il num. max di caratteri del Titolo');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC','I tag HTML vengono tolti se si eccede questo numero<br /><b>-1</b> è illimitato');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY','Il num max di caratteri del Sommario');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC','<b>-1</b> è illimitato');

// main configuration
define('_AM_RSSC_CONF_MAIN_SEARCH_MIN','Il num. minimo caratteri della keyword di ricerca');
//define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','');

// bin configuration
define('_AM_RSSC_CONF_BIN_PASS','Password');
//define('_AM_RSSC_CONF_BIN_PASS_DESC','');
define('_AM_RSSC_CONF_BIN_SEND','Invia Mail');
//define('_AM_RSSC_CONF_BIN_SEND_DESC','');
define('_AM_RSSC_CONF_BIN_MAILTO','Email da inviare');
//define('_AM_RSSC_CONF_BIN_MAILTO_DESC','');

// === view rss ===
define('_AM_RSSC_VIEW_RSS_OPTION', 'Impostazione Opzioni');
define('_AM_RSSC_NOT_SELECT_LINK','Il link non è selezionato');
define('_AM_RSSC_PLEASE_SELECT_LINK','Scegli da lista link, o inserisci LINK ID');
define('_AM_RSSC_VIEW_PARSER', 'Impostazioni Parser');
define('_AM_RSSC_VIEW_SAVE_ETC', 'Salva in tabella, etc');
define('_AM_RSSC_VIEW_MODE', 'Modo Visual.');
define('_AM_RSSC_VIEW_MODE_DESC', 'Non salvare in tabella, quando modo è 0');
define('_AM_RSSC_VIEW_MODE_CURRENT', 'modo 0: ricava dati XML');
define('_AM_RSSC_VIEW_MODE_LINK', 'mode 1: dati XML salvati in tabella link');
define('_AM_RSSC_VIEW_MODE_FEED', 'mode 2: dati salvati in tabella feed');
define('_AM_RSSC_VIEW_SANITIZE', 'HTML Sanitize');
define('_AM_RSSC_VIEW_TITLE_HTML','Mostra tag HTML del titolo');
define('_AM_RSSC_VIEW_TITLE_HTML_DESC', 'Se si sceglie SI, mostra com\'è inclusi i tag HTML. <br />Se si sceglie NO, mostra privo di tag HTML. ');
define('_AM_RSSC_VIEW_CONTENT_HTML','Mostra tag HTML del contenuto');
define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', 'Se si sceglie SI, mostra com\'è inclusi i tag HTML. <br />Se si sceglie NO, mostra privo di tag HTML. ');
define('_AM_RSSC_VIEW_MAX_CONTENT','Il num. max di caratteri del contenuto');
define('_AM_RSSC_VIEW_MAX_CONTENT_DESC','I tag HTML vengono tolti, se si eccede questo numero<br /><b>-1</b> è illimitato');
define('_AM_RSSC_VIEW_LINK_UPDATE', 'Aggiorna tabella Link');
define('_AM_RSSC_VIEW_FEED_UPDATE', 'Aggiorna tabella Feed');
define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'Forza discover URL RSS');
define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'Sovrascrive RDF/RSS/ATOM URL, after detecting this URL, non legato a modo RSS');
define('_AM_RSSC_VIEW_FORCE_UPDATE', 'Forza aggiorn. archivio');
define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', 'Sovrascrivi archivio, dopo aver ricavato RDF/RSS/ATOM, non legato a Intervallo Refresh');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'Forza aggiornam. tabella feed');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', 'Sovrascrivi tabella feed, anche se stessi dati di RDF/RSS/ATOM URL');
define('_AM_RSSC_VIEW_PRINT_LOG', 'Mostra Log');
define('_AM_RSSC_VIEW_PRINT_LOG_DESC', 'Mostra Show log simultaneamente durante esecuzione');
define('_AM_RSSC_VIEW_PRINT_ERROR', 'Mostra Errori');
define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', 'Mostra errori simultaneamente durante esecuzione');

// === command manage ===
define('_AM_RSSC_CREATE_CONFIG', 'Crea file Config');
define('_AM_RSSC_TEST_BIN_REFRESH', 'Test esecuzione bin/refresh.php');

// === update manage ===
define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'Importa da XoopsHeadline');
define('_AM_RSSC_IMPORT_WEBLINKS', 'Importa da WebLinks');

// === rename ===
define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

// 2006-01-20
define('_AM_RSSC_ID_ASC', 'ID Ascend.');
define('_AM_RSSC_ID_DESC','ID Discend.');

// === 2006-06-04 ===
// build rss
define('_AM_RSSC_BUILD', 'Crea RDF/RSS/ATOM');
define('_AM_RSSC_BUILD_DSC',  'Crea e mostra RDF/RSS/ATOM per debug');
define('_AM_RSSC_BUILD_RDF',  'Crea RDF');
define('_AM_RSSC_BUILD_RSS',  'Crea RSS');
define('_AM_RSSC_BUILD_ATOM', 'Crea ATOM');

// parse rss
define('_AM_RSSC_PARSE_RSS', 'Parse RDF/RSS/ATOM');

// refresh link
//define('_AM_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
//define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.');
//define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');

// === 2006-07-08 ===
// description at main
define('_AM_RSSC_CONF_INDEX_DESC','Descrizione su Pagina Principale');
define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'Inserire nota descrittiva da visualizzare in pagina principale.');
define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Questa è una nota descrittiva.<br />Puoi editare questa nota in "Configurazione Modulo".<br /></div><br />');

// link table
define('_AM_RSSC_LINK_DESC','Trova <b>RDF/RSS/ATOM URL</b> automaticamente e individua <b>Encoding</b> automaticamente, <br />quando non indicato, <br />se il sito web supporta "RSS Auto Discovery"');
//define('_AM_RSSC_LINK_EXIST', 'Already exists this "RDF/RSS/ATOM URL"');
//define('_AM_RSSC_LINK_EXIST_MORE','There are twe or more links which have same "RDF/RSS/ATOM URL" ');
//define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery Faild');
define('_AM_RSSC_LINK_FORCE','Forza salvataggio');

// black & white table
define('_AM_RSSC_BLACK_MEMO','Memo');

// === 2006-09-20 ===
// show content with html
define('_AM_RSSC_CONF_SHOW_TITLE_HTML','Usa tag HTML del titolo');
define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', 'Se "SI", mostra titolo con tag HTML, se presenti. <br />Se "NO", mostra titolo privo di tag HTML. ');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML','Usa tag HTML del contenuto');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', 'Se "SI", mostra contenuto con tag HTML, se presenti. <br />Se "NO", mostra contenuto privo di tag HTML. ');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT','Il num. max caratteri del contenuto');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'I tag HTML vengono tolti, se si eccede questo numero<br /><b>-1</b> è illimitato');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT','Num. max di contenuto feed RSS/ATOM visualizzato');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', 'Inserire il num. max di feed RSS/ATOM di cui viene visual. il contenuto.');
define('_AM_RSSC_CONF_SHOW_BLOG_LID','Link ID to show blog');
//define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

define('_AM_RSSC_TABLE_MANAGE','Gestione Tabella DB');

// === 2006-11-08 ===
// proxy server
define('_AM_RSSC_FORM_PROXY', 'Config Proxy Server');
define('_AM_RSSC_CONF_PROXY_USE',  'Usa Proxy Server');
define('_AM_RSSC_CONF_PROXY_HOST', 'Proxy Host');
define('_AM_RSSC_CONF_PROXY_PORT', 'Proxy Port');
define('_AM_RSSC_CONF_PROXY_USER', 'Proxy Username');
define('_AM_RSSC_CONF_PROXY_USER_DESC', 'Inserire username, se il tuo proxy richiede autenticazione BASIC, <br />altrimenti lasciare vuoto');
define('_AM_RSSC_CONF_PROXY_PASS', 'Proxy Password');
define('_AM_RSSC_CONF_PROXY_PASS_DESC', 'Inserire password, se il tou proxy richiede autenticazione BASIC, <br />altrimenti lasciare vuoto');

define('_AM_RSSC_CONF_HIGHLIGHT', 'Usa evidenziazione Keyword');


// === 2007-06-01 ===
// word_list
define('_AM_RSSC_LIST_WORD','Lista Parole Rifiutate');
define('_AM_RSSC_WORD_MANAGE','Gestione Parole Rifiutate');
define('_AM_RSSC_ADD_WORD','Aggiungi parola rifiutata');
define('_AM_RSSC_MOD_WORD','Modifica parola rifiutata');
define('_AM_RSSC_DEL_WORD','Cancella parola rifiutata');
define('_AM_RSSC_POINT_ASC', 'Little Point Order');
define('_AM_RSSC_POINT_DESC','Much Point Order');
define('_AM_RSSC_COUNT_ASC', 'Little Frequency Count Order');
define('_AM_RSSC_COUNT_DESC','Much Frequency Count Order');
define('_AM_RSSC_WORD_ASC', 'Ordine A-Z');
define('_AM_RSSC_WORD_DESC','Ordine Z-A');
define('_AM_RSSC_NON_ACT','Non mostrare lista');
define('_AM_RSSC_NON_ACT_ASC', 'Non mostrare ID Ascend.');
define('_AM_RSSC_NON_ACT_DESC','Non mostrare ID Discend.');
define('_AM_RSSC_WORD_ALREADY','Questa parola è già registrata');
define('_AM_RSSC_WORD_SEARCH','Ricerca sinonimo');

// content filter
define('_AM_RSSC_FORM_FILTER','Impostazioni Filtro');
define('_AM_RSSC_FORM_FILTER_DESC','Questo filtro decide se salvare o meno nel database durante raccolta automatica dei feed');
define('_AM_RSSC_CONF_LINK_USE','Usa Tabella Link');
define('_AM_RSSC_CONF_LINK_USE_DESC','Salva se "Tipo" di tabella link è "Normale"');
define('_AM_RSSC_CONF_WHITE_USE','Usa White List');
define('_AM_RSSC_CONF_WHITE_USE_DESC','Salva se in white list');
define('_AM_RSSC_CONF_BLACK_USE','Usa Black List');
define('_AM_RSSC_CONF_BLACK_USE_DESC','Non salvare se black list');
define('_AM_RSSC_CONF_BLACK_USE_DESC','Non salvare se in black list<br />Se scegli "Usa", interrompe processo filtraggio, se blacklist corrisponde<br />Se scegli "Impara", continua processo filtraggio, anche se blacklist corrisponde, allo scopo di estrarre parole chiave');
define('_AM_RSSC_CONF_BLACK_USE_NO','Non Usare');
define('_AM_RSSC_CONF_BLACK_USE_YES','Usa');
define('_AM_RSSC_CONF_BLACK_USE_LEARN','Impara');
define('_AM_RSSC_CONF_WORD_USE','Usa Lista Parole Respinte');
define('_AM_RSSC_CONF_WORD_USE_DESC','Non salvare se totale punti della lista parola eccede livello rifiuto');
define('_AM_RSSC_CONF_WORD_LEVEL', 'Livello rifiuto');
define('_AM_RSSC_CONF_FEED_SAVE','Salva Feed');
define('_AM_RSSC_CONF_FEED_SAVE_DESC','Salva o meno in tabella feed se blacklist corisponde.<br />Se "Salva", salva con stato "non mostrare".');
define('_AM_RSSC_CONF_FEED_SAVE_NO', 'Non Salvare');
define('_AM_RSSC_CONF_FEED_SAVE_YES','Salva');
define('_AM_RSSC_CONF_LOG_USE','Usa Log File');
define('_AM_RSSC_CONF_LOG_USE_DESC','Scrive log file se blacklist corrisponde');
define('_AM_RSSC_CONF_WHITE_COUNT','Count up White List');
define('_AM_RSSC_CONF_WHITE_COUNT_DESC','Count up the matching record when match with white list');
define('_AM_RSSC_CONF_BLACK_COUNT','Count up Black List');
define('_AM_RSSC_CONF_BLACK_COUNT_DESC','Count up the matching record when match with blck list');
define('_AM_RSSC_CONF_WORD_COUNT','Coun up Reject Word List');
define('_AM_RSSC_CONF_WORD_COUNT_DESC','Count up the matching record when match with reject word list');
define('_AM_RSSC_CONF_BLACK_AUTO','Aggiungi in Black List');
define('_AM_RSSC_CONF_BLACK_AUTO_DESC','Aggiunge URL in black list automaticamente se giudicato black<br /><b>Avviso</b> "status" salvato come "non valido"<br />Per favore cambiare in "valido" per usare');
define('_AM_RSSC_CONF_WORD_AUTO','Aggiungi in Lista Parole Rifiutate');
define('_AM_RSSC_CONF_WORD_AUTO_DESC','Estrae parole nel contenuto automaticamente, e le aggiunge alla lista parole rifiutate, se blacklist corrisponde<br /><b>Notice</b> "point" salvato come zero<br />Per favore cambiare "point" per usare');
define('_AM_RSSC_CONF_WORD_AUTO_NON','Non Aggiungere');
define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL','Extract by the symbol pause');
define('_AM_RSSC_CONF_WORD_AUTO_KAKASI','Extract by KAKASI: Japanese Only');

// word extract
define('_AM_RSSC_FORM_WORD','Impostazioni Estrazione Parole');
define('_AM_RSSC_CONF_JOIN_PREV', 'Unisci Parole');
define('_AM_RSSC_CONF_JOIN_PREV_DESC', 'Unisci a parola precedente e seguente, e crea frase');
define('_AM_RSSC_CONF_JOIN_GLUE', 'Spaziatura Parole');
define('_AM_RSSC_CONF_JOIN_GLUE_DESC', 'in Inglese setta spazio<br />in Giapponese setta nullo');
define('_AM_RSSC_CONF_KAKASI_PATH','Command Path of KAKASI');
define('_AM_RSSC_CONF_KAKASI_MODE','Mode of KAKASI');
define('_AM_RSSC_CONF_KAKASI_MODE_FILE','Usa file temporaneo');
define('_AM_RSSC_CONF_KAKASI_MODE_PIPE','Usa UNIX pipe');
define('_AM_RSSC_CONF_CHAR_LENGTH', 'Il num. minimo caratteri');
define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', 'Il num. minimo caratteri parole da estrarre');
define('_AM_RSSC_CONF_WORD_LIMIT', 'Il num. max di parole rifiutate');
define('_AM_RSSC_CONF_WORD_LIMIT_DESC', 'Inserire num. max parole salvate in tabella parole<br />Azzera record più vecchi, se si supera questo valore<br /><b>0</b> è illimitato');
define('_AM_RSSC_KAKASI_EXECUTABLE', 'kakasi is executable');
define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'kakasi is not executable');
define('_AM_RSSC_CONF_HTML_GET','Ricava HTML');
define('_AM_RSSC_CONF_HTML_GET_DESC','Ricava dati HTML origine automaticamente, se riscontrate parole rifiutate da lista<br />Se scegli "Usa", la precisione della valutazione aumenta, ma il tempo di esecuzione cresce');
define('_AM_RSSC_CONF_HTML_GET_NO','Non Usare');
define('_AM_RSSC_CONF_HTML_GET_YES','Usa');
define('_AM_RSSC_CONF_HTML_GET_BLACK','Usa se corr. blacklist');
define('_AM_RSSC_CONF_HTML_LIMIT', 'Il num. max caratteri HTML');
define('_AM_RSSC_CONF_HTML_LIMIT_DESC', 'Il num. max caratteri HTML ricavati automaticamente<br />In alcuni siti i dati HTML possono essere molti, e l\'esecuzione può rallentarsi');

// archive manage
define('_AM_RSSC_LEAN_BLACK', 'Impara in Black List');
define('_AM_RSSC_LEAN_BLACK_DESC','Esamina blacklist, allo scopo di estrarre automaticamente parole nel contenuto, e aggiungerle alla lista parole rifiutate');
define('_AM_RSSC_NUM_FEED_ALL','Il numero di tutti i feed');
define('_AM_RSSC_NUM_FEED_SKIP','Il numero di feed già salvati');
define('_AM_RSSC_NUM_FEED_REJECT','Il numero di feed valutati blacklist');

define('_AM_RSSC_THEREARE_TITLE','in related <b>%s</b> ci sono <b>%s</b>');

}
// --- define language begin ---

?>
