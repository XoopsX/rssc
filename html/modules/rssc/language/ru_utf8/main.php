<?php
// $Id: main.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2007-12-09 K.OHWADA
// remove _RSSC_CREATED

// 2007-10-10 K.OHWADA
// enclusure in link table

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
// _LANGCODE: ru
// _CHARSET : utf-8
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('RSSC_LANG_MB_LOADED') ) 
{

define('RSSC_LANG_MB_LOADED', 1);

// global
//define('_ADDED','Added');
//define('_DELETED','Deleted');
//define('_UPDATE', 'Update');
//define('_UPDATED','Updated');
//define('_MODIFY',  'Midify');
//define('_MODIFIED','Modified');
//define('_SAVE', 'Save');
//define('_SAVED','Saved');
//define('_CLEAR',  'Clear');
//define('_CLEARED','Cleared');
//define('_EXECUTE', 'Execute');
//define('_EXECUTED','Executed');
//define('_CREATE', 'Create');
//define('_CREATED','Created');
//define('_VISIT','Visit');
//define('_SHOW','Show');
//define('_KEYWORD','Keyword');
//define('_NUM','Num');
//define('_NO_ACTION','No Action');
//define('_NO_RECORD','There are no record');

// index & search
//define('_RSSC_MAIN','Main');

define('_RSSC_SEARCH','Поиск');
define('_RSSC_LATEST_FEEDS','Последние RDF/RSS/ATOM каналы');
define('_RSSC_THEREARE','Присутствует <b>%s</b> данных в базе данных');

// headline
define('_RSSC_HEADLINE','Простой заголовок');
define('_RSSC_LASTUPDATE','Последнее обновление');

// single
define('_RSSC_SINGLE','Отдельный канал');

// common
define('_RSSC_SITE_TITLE','Заголовок сайта');
define('_RSSC_SITE_LINK', 'Адрес сайта');

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

define('_RSSC_UPDATED',   'Обновлено');

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
define('_RSSC_LINK_ID','ID ссылки');
define('_RSSC_USER_ID','ID пользователя');
define('_RSSC_MOD_ID','ID модуля');
define('_RSSC_LTYPE','Тип');
define('_RSSC_REFRESH_INTERVAL','Интервал обновления');
define('_RSSC_HEADLINE_ORDER','Порядок заголовка');
define('_RSSC_ENCODING','Кодировка');
define('_RSSC_RDF_URL', 'Адрес RDF');
define('_RSSC_RSS_URL', 'Адрес RSS');
define('_RSSC_ATOM_URL','Адрес ATOM');
define('_RSSC_RSS_MODE','Режим RSS');
define('_RSSC_RSS_MODE_NON',  'Номер');
define('_RSSC_RSS_MODE_RDF',  'Формат RDF');
define('_RSSC_RSS_MODE_RSS',  'Формат RSS');
define('_RSSC_RSS_MODE_ATOM', 'Формат ATOM');
define('_RSSC_RSS_MODE_AUTO', 'Автообнаружение');

// feed table item
define('_RSSC_FEED_ID','ID канала');
define('_RSSC_MODE_CONT','Режим содержимого');
define('_RSSC_RAWS','Необработанные данные');
define('_RSSC_SEARCH_FIELD','Поле поиска');

// black table item
define('_RSSC_BLACK_ID','Черный ID');
define('_RSSC_WHITE_ID','Белый ID');

// 2006-04-16 K.OHWADA
define('_RSSC_NO_HEADLINK','Присутствуют не выбранные заголовки ссылки');
define('_RSSC_NO_FEED','Отсутствуют данные канала');

// === 2006-06-04 ===
// single link
define('_RSSC_SINGLE_LINK',  'Одиночная ссылка');
define('_RSSC_SINGLE_LINK_UTF8', 'Одиночная ссылка в кодировке UTF-8');
//define('_RSSC_SINGLE_SUMMARY', 'Summary');
//define('_RSSC_SINGLE_CONTENT', 'Content allowed HTML tags');
//define('_RSSC_UTF8_SUMMARY', 'Summary with UTF-8');
//define('_RSSC_UTF8_CONTENT', 'Content allowed HTML tags with UTF-8');

// detect encoding
define('_RSSC_ASSUME_ENCODING', 'Предложенное xml кодирование %s ,<br />потому что невозможно определить кодировку автоматически');

// rss item
//define('_RSSC_CREATED', 'Created');
//define('_RSSC_ATOM_CONTRIBUTOR_NAME', 'Contoributor');
//define('_RSSC_ATOM_CONTRIBUTOR_URI',  'Contoributor URL');
//define('_RSSC_ATOM_CONTRIBUTOR_EMAIL','Contoributor email');

// === 2006-07-08 ===
// bread crumb
//define('_HOME', 'HOME');

// podcast
define('_RSSC_PODCAST', 'Подкаст');
//define('_RSSC_ENCLOSURE_URL',    'Enclosure Url');
//define('_RSSC_ENCLOSURE_TYPE',   'Enclosure Type');
//define('_RSSC_ENCLOSURE_LENGTH', 'Enclosure Length');

// === 2006-09-01 ===
// conflict with weblinks
//if( !defined('_SAVE') ) 
//{
//	define('_HOME', 'HOME');
//	define('_SAVE', 'Save');
//	define('_SAVED','Saved');
//	define('_EXECUTE', 'Execute');
//	define('_EXECUTED','Executed');
//	define('_CREATE', 'Create');
//	define('_CREATED','Created');
//}

// error message
define('_RSSC_DB_ERROR',           'Ошибка базы данных RSSC');
define('_RSSC_DISCOVER_SUCCEEDED', 'Автоопределение RSS успешно');
define('_RSSC_DISCOVER_FAILED',    'Автоопределение RSS неудачно');
define('_RSSC_PARSE_MSG',          'Сообщение анализирования RSS');
define('_RSSC_PARSE_FAILED',            'Неудачное анализирование RSS');
define('_RSSC_PARSE_NOT_READ_XML_URL',  'Неудачное анализирование RSS: не читается адрес RSS');
define('_RSSC_PARSE_NOT_FIND_ENCODING', 'Неудачное анализирование RSS: не найдена кодировка');

define('_RSSC_REFRESH_ERROR', 'Ошибка обновления RSS');
define('_RSSC_LINK_NOT_EXIST',  'Отсутствует соответствующая ссылка в модуле RSSC');
define('_RSSC_LINK_EXIST_MORE', 'Присутствуют две или более ссылки, которые имеют тот же "Адрес RDF/RSS/ATOM"');
define('_RSSC_LINK_ALREADY',    'Такая ссылка уже существует, которая имеет тот же "Адрес RDF/RSS/ATOM"');

// refresh link
define('_RSSC_REFRESH_LINK', 'Обновление RDF/RSS/ATOM каналов');
define('_RSSC_REFRESH_LINK_DSC', 'Когда обновляются RSS каналы <br />Обнаруживать адреса <b>RDF/RSS/ATOM</b> автоматически и определять <b>Кодировку</b> автоматически, <br />если они не установлены.');
define('_RSSC_REFRESH_LINK_FINISHED', 'Обновление каналов закончено');

// for other module
define('_RSSC_RSSC_LID', 'ID ссылки модуля RSSC');
define('_RSSC_RSSC_LID_UPDATE', 'Обновление ID ссылки модуля RSSC');
define('_RSSC_GOTO_RSSC_ADMIN_LINK', 'Перейти к странице администрирования модуля RSSC');

// === 2007-06-01 ===
// word table
define('_RSSC_WORD_ID','ID слова');
define('_RSSC_WORD_WORD','Отклоненные слова');
define('_RSSC_WORD_POINT','Точка');
define('_RSSC_ACT','Статус');
define('_RSSC_ACT_NON','Неверный');
define('_RSSC_ACT_ACT','Верный');
define('_RSSC_REG','Выражение адреса');
define('_RSSC_REG_NORMAL','Нормальный');
define('_RSSC_REG_EXP','Регулярное выражение');
define('_RSSC_FREQ_COUNT','Счетчик чувствительности');

// feed table
define('_RSSC_FEED_ACT',     'Статус');
define('_RSSC_FEED_ACT_NON', 'Не показывать');
define('_RSSC_FEED_ACT_VIEW','Показывать');

// link table
define('_RSSC_LTYPE_NON','Нет обновленных каналов');
define('_RSSC_LTYPE_SEARCH','Поиск по сайту');
define('_RSSC_LTYPE_NORMAL','Нормальный');

define('_RSSC_XML_URL','Адрес RDF/RSS/ATOM');

// === 2007-10-10 ===
// link table
define('_RSSC_LINK_ENCLOSURE','Эксплуатация контейнера тега');
define('_RSSC_LINK_ENCLOSURE_NON','Не использовать');
define('_RSSC_LINK_ENCLOSURE_POD','Допускать подкаст');
define('_RSSC_LINK_CENSOR', 'Ввести цензуру слова в заголовке');
//define('_RSSC_LINK_PLUGIN','Plugin');

// black & white table
define('_RSSC_BW_CACHE','Кэш счетчика канала');
define('_RSSC_BW_CTIME','Время кэша счетчика канала');

// keyword manage
define('_RSSC_KEYWORD','Ключевое слово');

// === 2008-01-20 ===
// plugin list
define('_RSSC_PLUGIN_LIST', 'Список плагинов');
define('_RSSC_PLUGIN_NAME', 'Имя плагина');
define('_RSSC_PLUGIN_DESCRIPTION', 'Описание');
define('_RSSC_PLUGIN_USAGE', 'Использование');

// link table
define('_RSSC_PRE_PLUGIN', 'Плагин предварительной обработки');
define('_RSSC_POST_PLUGIN','Плагин окончательной обработки');

// === 2009-02-20 ===
// map
define('_RSSC_MAP','Карты Google');

// link table
define('_RSSC_LINK_ICON',  'Иконка');
define('_RSSC_LINK_GICON_ID', 'ID иконки карт Google ');

// feed table
define('_RSSC_FEED_GEO_LAT',  'Широта');
define('_RSSC_FEED_GEO_LONG', 'Долгота');
define('_RSSC_FEED_MEDIA_CONTENT_URL',    'Адрес содержания');
define('_RSSC_FEED_MEDIA_CONTENT_TYPE',   'Тип содержания');
define('_RSSC_FEED_MEDIA_CONTENT_MEDIUM', 'Среднее содержание');
define('_RSSC_FEED_MEDIA_CONTENT_WIDTH',  'Ширина содержания');
define('_RSSC_FEED_MEDIA_CONTENT_HEIGHT', 'Высота содержания');
define('_RSSC_FEED_MEDIA_THUMBNAIL_URL',    'Адрес миниатюры');
define('_RSSC_FEED_MEDIA_THUMBNAIL_WIDTH',  'Ширина миниатюры');
define('_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT', 'Высота миниатюры');

	define('_RSSC_EXECUTION_TIME', 'Время выполнения');
	define('_RSSC_MEMORY_USAGE', 'Использование памяти');
	define('_RSSC_SEC', 'сек');
	define('_RSSC_MB', 'МБ');

	define('_RSSC_IN', 'в');
	define('_RSSC_MAP_LOADING', 'Загрузка ...');
}
// --- define language end ---

?>