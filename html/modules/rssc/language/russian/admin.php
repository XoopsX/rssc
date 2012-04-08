<?php
// $Id: admin.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2008-01-10 K.OHWADA
// double definition : _AM_RSSC_CONF_BLACK_USE_DESC

// 2007-12-09 K.OHWADA
// remove _AM_RSSC_CREATE_CONFIG

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
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('RSSC_LANG_AM_LOADED') ) 
{

define('RSSC_LANG_AM_LOADED', 1);

// === menu ===
define('_AM_RSSC_CONF', 'Управление RSS Центром');
define('_AM_RSSC_LIST_LINK', 'Список ссылок');
define('_AM_RSSC_LIST_BLACK', 'Список черного списка');
define('_AM_RSSC_LIST_WHITE', 'Список белого списка');
define('_AM_RSSC_LIST_FEED', 'Список каналов');
define('_AM_RSSC_ADD_LINK', 'Добавить ссылку');
define('_AM_RSSC_ADD_BLACK', 'Добавить черный список');
define('_AM_RSSC_ADD_WHITE', 'Добавить белый список');
define('_AM_RSSC_ADD_KEYWORD', 'Добавить ключевое слово');
define('_AM_RSSC_ARCHIVE_MANAGE', 'Управление архивом');

//define('_AM_RSSC_COMMAND_MANAGE', 'Command Management');

define('_AM_RSSC_UPDATE_MANAGE', 'Управление импортом');
define('_AM_RSSC_VIEW_RSS', 'Просмотр RDF/RSS/ATOM');

//define('_AM_RSSC_GOTO_MODULE', 'Goto Module');

// === index & config ===
define('_AM_RSSC_FORM_BASIC', 'Основная конфигурация');
define('_AM_RSSC_FORM_BASIC_DESC', 'Используется общее для всех модулей');
define('_AM_RSSC_FORM_MAIN', 'Конфигурация просмотра главной страницы');
define('_AM_RSSC_FORM_MAIN_DESC', 'Используется на главной странице этого модуля');
define('_AM_RSSC_FORM_BLOCK', 'Конфигурация просмотра блоков');
define('_AM_RSSC_FORM_BLOCK_DESC', 'Используется в блоках этого модуля');

//define('_AM_RSSC_FORM_BIN', 'Command Config');
//define('_AM_RSSC_FORM_BIN_DESC', 'It is used on bin command');
//define('_AM_RSSC_INIT_NOT','The config table is not initialized');
//define('_AM_RSSC_INIT_EXEC','Initialized the config table');
//define('_AM_RSSC_VERSION_NOT','It is not version  %s');
//define('_AM_RSSC_UPGRADE_EXEC','Upgrade the config table');
//define('_AM_RSSC_WARNING_NOT_WRITABLE','Not writable the directory');
//define('_AM_RSSC_CONF_NAME','Item');

define('_AM_RSSC_DBUPDATED', 'База данных обновлена успешно!');
define('_AM_RSSC_FAILUPDATE', 'Ошибка сохранения данные в базу данных');
define('_AM_RSSC_FAILDELETE', 'Ошибка удаления данных из базы данных');
define('_AM_RSSC_THERE_ARE_LINKS','Присутствует <b>%s</b> ссылок в базе данных');
define('_AM_RSSC_THERE_ARE_FEEDS','Присутствует <b>%s</b> каналов в базе данных');

// === link manage ===
define('_AM_RSSC_LINK_MANAGE','Управление ссылками');
define('_AM_RSSC_MOD_LINK','Изменить ссылку');
define('_AM_RSSC_DEL_LINK','Удалить ссылку');
define('_AM_RSSC_SHOW_RSS',  'Показать RSS');
define('_AM_RSSC_SHOW_FEED', 'Показать канал');
define('_AM_RSSC_FEED_BELONG_LINK', 'Показать каналы, принадлежащие этой ссылке');
define('_AM_RSSC_ERROR_FILL', 'Ошибка: Введите %s');
define('_AM_RSSC_ERROR_ILLEGAL','Ошибка: Недопустимый %s');

// === black list manage ===
define('_AM_RSSC_BLACK_MANAGE','Управление черным списком');
define('_AM_RSSC_MOD_BLACK','Изменить черный список');
define('_AM_RSSC_DEL_BLACK','Удалить черный список');
define('_AM_RSSC_FEED_MATCH_LINK', 'Показать каналы, которые соответствуют этому списку');

// === white list manage ===
define('_AM_RSSC_WHITE_MANAGE','Управление белым списком');
define('_AM_RSSC_MOD_WHITE','Изменить белый список');
define('_AM_RSSC_DEL_WHITE','Удалить белый список');

// === feed list manage ===
define('_AM_RSSC_ADD_FEED','Добавить канал');
define('_AM_RSSC_MOD_FEED','Изменить канал');
define('_AM_RSSC_DEL_FEED','Удалить канал');
define('_AM_RSSC_THERE_ARE_MATCH','Присутствует <b>%s</b>  данных, которые соответствуют условиям');
define('_AM_RSSC_CONDITION','Условие');

// === archive manage ===
define('_AM_RSSC_REFRESH', 'Обновить архив');
define('_AM_RSSC_REFRESH_NEXT','Проверить следующие %s');
define('_AM_RSSC_LINK_LIMIT', 'Предел ссылок');
define('_AM_RSSC_LINK_OFFSET','Смещение ссылок');
define('_AM_RSSC_FEED_CLEAR','Очистить архив');
define('_AM_RSSC_FEED_CLEAR_OLD','Удалить старые записи');
define('_AM_RSSC_FEED_CLEAR_NUM','Удалить старые записи, если они становятся больше, чем заданное число');

// refresh result
define('_AM_RSSC_NO_REFRESH','Нет ссылок для обновления');
define('_AM_RSSC_TIME_START','Начальное время');
define('_AM_RSSC_TIME_END','Конечное время');
define('_AM_RSSC_TIME_ELAPSE','Затраченное время');
define('_AM_RSSC_MIN_SEC','%s мин %s сек');
define('_AM_RSSC_NUM_LINK_TOTAL','Всего ссылок');
define('_AM_RSSC_NUM_LINK_TARGET','Количество целевых ссылок');
define('_AM_RSSC_NUM_LINK_BROKEN','Количество неработающих ссылок');
define('_AM_RSSC_NUM_LINK_UPDATED','Количество обновленных ссылок');
define('_AM_RSSC_NUM_FEED_UPDATED','Количество обновленных каналов');
define('_AM_RSSC_NUM_FEED_CLEARED','Количество очищенных каналов');
define('_AM_RSSC_NUM_LINKS','ссылки');
define('_AM_RSSC_NUM_FEEDS','каналы');
define('_AM_RSSC_FAILGET', 'Невозможно получить XML из %s');
define('_AM_RSSC_GOTOTOP', 'Перейти вверх');

// === configuration ===
// basic configuration
define('_AM_RSSC_CONF_FEED_LIMIT', 'Максимальное количество каналов');
define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'Введите максимальное количество каналов, сохраняемое в таблице каналов<br />Удаляются старые записи, когда они становятся больше, чем это значение<br /><b>0</b> неограничено');
define('_AM_RSSC_CONF_RSS_ATOM', 'Выбор RSS или ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'Выбрать RSS или ATOM, когда оба адреса RSS и ATOM обнаружены');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS',  'RSS');
define('_AM_RSSC_CONF_RSS_PARSER', 'Выбор RSS анализатора');
define('_AM_RSSC_CONF_RSS_PARSER_SELF',  'RSSC анализатор');
define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS анализатор');
define('_AM_RSSC_CONF_ATOM_PARSER', 'Выбор ATOM анализатора');
define('_AM_RSSC_CONF_ATOM_PARSER_0', 'RSSC анализатор');
define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
define('_AM_RSSC_CONF_RSS_MODE', 'Начальное значение RSS режима');
define('_AM_RSSC_CONF_XML_SAVE', 'Сохранять XML');
define('_AM_RSSC_CONF_XML_SAVE_DESC', 'Сохранять полученный XML в таблице ссылок');
define('_AM_RSSC_CONF_FUTURE_DAYS', 'Будущие дни');
define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', "Количество дней<br />Не показывать канал, если дата каналов больше, чем эти дни");

// show configuration
define('_AM_RSSC_CONF_SHOW_ORDER','Порядок показа');
//define('_AM_RSSC_CONF_SHOW_ORDER_DESC','');
define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED','Последние обновления');
define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED','Последние опубликованные');
define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE','Ссылок на страницу');
//define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE','Каналов на страницу');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK','Каналов на ссылку');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE','Максимальное количество символов в заголовке');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC','HTML теги удаляются, когда больше этого числа<br /><b>-1</b> неограничено');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY','Максимальное количество символов в описании');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC','<b>-1</b> неограничено');

// main configuration
define('_AM_RSSC_CONF_MAIN_SEARCH_MIN','Минимальное количество символов в ключевых словах поиска');
//define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','');

// bin configuration
//define('_AM_RSSC_CONF_BIN_PASS','Password');
//define('_AM_RSSC_CONF_BIN_PASS_DESC','');
//define('_AM_RSSC_CONF_BIN_SEND','Send Mail');
//define('_AM_RSSC_CONF_BIN_SEND_DESC','');
//define('_AM_RSSC_CONF_BIN_MAILTO','Email to send');
//define('_AM_RSSC_CONF_BIN_MAILTO_DESC','');

// === view rss ===
define('_AM_RSSC_VIEW_RSS_OPTION', 'Установка параметров');
define('_AM_RSSC_NOT_SELECT_LINK','Ссылка не выбрана');
define('_AM_RSSC_PLEASE_SELECT_LINK','Выберите из списка ссылок или введите ID ссылки');
define('_AM_RSSC_VIEW_PARSER', 'Установка анализатора');
define('_AM_RSSC_VIEW_SAVE_ETC', 'Сохранить в таблицу, и т.д.');
define('_AM_RSSC_VIEW_MODE', 'Режим просмотра');
define('_AM_RSSC_VIEW_MODE_DESC', 'Не сохранять в таблице, когда режим 0');
define('_AM_RSSC_VIEW_MODE_CURRENT', 'режим 0: получения XML данных');
define('_AM_RSSC_VIEW_MODE_LINK', 'режим 1: XML данные, сохраненные в таблице ссылки');
define('_AM_RSSC_VIEW_MODE_FEED', 'режим 2: данные, сохраненные в таблице канала');
define('_AM_RSSC_VIEW_SANITIZE', 'HTML очистка');
define('_AM_RSSC_VIEW_TITLE_HTML','Показывать HTML теги в заголовке');
define('_AM_RSSC_VIEW_TITLE_HTML_DESC', 'Когда выбрано ДА, показывать это как HTML теги. <br />Когда выбрано НЕТ, показывать это после удаления HTML тегов. ');
define('_AM_RSSC_VIEW_CONTENT_HTML','Показывать HTML теги в содержании');
define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', 'Когда выбрано ДА, показывать это как HTML теги. <br />Когда выбрано НЕТ, показывать это после удаления HTML тегов. ');
define('_AM_RSSC_VIEW_MAX_CONTENT','Максимальное количество символов в содержании');
define('_AM_RSSC_VIEW_MAX_CONTENT_DESC','HTML будут удалены, когда больше, чем это число<br /><b>-1</b> неограничено');
define('_AM_RSSC_VIEW_LINK_UPDATE', 'Обновление таблицы ссылки');
define('_AM_RSSC_VIEW_FEED_UPDATE', 'Обновление таблицы канала');
define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'Принудительно обнаружить адрес RSS');
define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'Перезаписать адрес RDF/RSS/ATOM, после обнаружения этого адреса не связанного с режимом RSS');
define('_AM_RSSC_VIEW_FORCE_UPDATE', 'Принудительно обновить архив');
define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', 'Перезаписывать архив, после получения RDF/RSS/ATOM не связанного с интервалом обновления');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'Принудительно обновлять таблицу канала');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', 'Перезаписывать таблицу канала, даже если есть те же данные из адреса RDF/RSS/ATOM');
define('_AM_RSSC_VIEW_PRINT_LOG', 'Показать журнал');
define('_AM_RSSC_VIEW_PRINT_LOG_DESC', 'Просмотр журнала одновременно во время выполнения');
define('_AM_RSSC_VIEW_PRINT_ERROR', 'Показать ошибки');
define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', 'Показать ошибки одновременно во время выполнения');

// === command manage ===
//define('_AM_RSSC_CREATE_CONFIG', 'Create Config File');
//define('_AM_RSSC_TEST_BIN_REFRESH', 'Test to execute bin/refresh.php');

// === update manage ===
define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'Импорт из XoopsHeadline');
define('_AM_RSSC_IMPORT_WEBLINKS', 'Импорт из WebLinks');

// === rename ===
define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

// 2006-01-20
define('_AM_RSSC_ID_ASC', 'ID по возрастанию');
define('_AM_RSSC_ID_DESC','ID по убыванию');

// === 2006-06-04 ===
// build rss
//define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
//define('_AM_RSSC_BUILD_DSC',  'Build and show RDF/RSS/ATOM for debug');
//define('_AM_RSSC_BUILD_RDF',  'Build RDF');
//define('_AM_RSSC_BUILD_RSS',  'Build RSS');
//define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');

// parse rss
define('_AM_RSSC_PARSE_RSS', 'Анализировать RDF/RSS/ATOM');

// refresh link
//define('_AM_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
//define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.');
//define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');

// === 2006-07-08 ===
// description at main
define('_AM_RSSC_CONF_INDEX_DESC','Описание на главную страницу');
define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'Введите описание, если вы хотите чтобы оно отображалось на главной странице.');
define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Здесь описание.<br />Вы можете редактировать описание в "Настройка модуля".<br /></div><br />');

// link table
define('_AM_RSSC_LINK_DESC','Обнаруживать адреса <b>RDF/RSS/ATOM</b> автоматически и определять <b>кодировку</b> автоматически, <br />когда вы не заполните, <br />если сайт поддерживает "RSS автоопределение"');
//define('_AM_RSSC_LINK_EXIST', 'Already exists this "RDF/RSS/ATOM URL"');
//define('_AM_RSSC_LINK_EXIST_MORE','There are twe or more links which have same "RDF/RSS/ATOM URL" ');
//define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery Faild');
define('_AM_RSSC_LINK_FORCE','Принудительное сохранение');

// black & white table
define('_AM_RSSC_BLACK_MEMO','Заметка');

// === 2006-09-20 ===
// show content with html
define('_AM_RSSC_CONF_SHOW_TITLE_HTML','Использовать HTML теги в заголовке');
define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', 'Когда выбрано "ДА", показывать заголовок с тегами HTML, если заголовок имеет HTML теги. <br />Когда выбрано "НЕТ", показывать заголовок с удаленными HTML тегами. ');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML','Использовать HTML теги в содержании');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', 'Когда выбрано "ДА", показывать содержание с тегами HTML, если содержание имеет HTML теги. <br />Когда выбрано "НЕТ", показывать содержание с удаленными HTML тегами. ');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT','Максимальное количество символов содержания');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'HTML теги удаляются, когда больше, чем это число<br /><b>-1</b> неограничено');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT','Максимальное количество RSS/ATOM каналов отображаемых содержание');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', 'Введите максимальное число RSS/ATOM каналов отображаемых содержание.');
define('_AM_RSSC_CONF_SHOW_BLOG_LID','ID ссылки для отображения блога');
//define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

define('_AM_RSSC_TABLE_MANAGE','Управление таблицами базы данных');

// === 2006-11-08 ===
// proxy server
define('_AM_RSSC_FORM_PROXY', 'Конфигурация прокси сервера');
define('_AM_RSSC_CONF_PROXY_USE',  'Использовать прокси сервер');
define('_AM_RSSC_CONF_PROXY_HOST', 'Прокси сервер');
define('_AM_RSSC_CONF_PROXY_PORT', 'Прокси порт');
define('_AM_RSSC_CONF_PROXY_USER', 'Прокси имя пользователя');
define('_AM_RSSC_CONF_PROXY_USER_DESC', 'Введите имя пользователя, если ваш прокси сервер требует обычную проверку подлинности, <br />В противном случае, оставте пустым');
define('_AM_RSSC_CONF_PROXY_PASS', 'Прокси пароль');
define('_AM_RSSC_CONF_PROXY_PASS_DESC', 'Введите пароль, если ваш прокси сервер требует обычную проверку подлинности, <br />В противном случае, оставте пустым');

define('_AM_RSSC_CONF_HIGHLIGHT', 'Использовать выделение ключевых слов');


// === 2007-06-01 ===
// word_list
define('_AM_RSSC_LIST_WORD','Список отклоненных слов');
define('_AM_RSSC_WORD_MANAGE','Управление отслоненными словами');
define('_AM_RSSC_ADD_WORD','Добавить отклоняемое слово');
define('_AM_RSSC_MOD_WORD','Изменить отклоняемое слово');
define('_AM_RSSC_DEL_WORD','Удалить отклоняемое слово');
define('_AM_RSSC_POINT_ASC', 'Малая точка сортировки');
define('_AM_RSSC_POINT_DESC','Большая точка сортировки');
define('_AM_RSSC_COUNT_ASC', 'Малый счетчик чувствительности сортировка');
define('_AM_RSSC_COUNT_DESC','Больший счетчик чувствительности сортировка');
define('_AM_RSSC_WORD_ASC', 'А-Я сортировка');
define('_AM_RSSC_WORD_DESC','Я-А сортировка');
define('_AM_RSSC_NON_ACT','Нет списка показа');
define('_AM_RSSC_NON_ACT_ASC', 'Нет показанных ID по возрастанию');
define('_AM_RSSC_NON_ACT_DESC','Нет показанных ID по убыванию');
define('_AM_RSSC_WORD_ALREADY','Это слово уже зарегистрировано');
define('_AM_RSSC_WORD_SEARCH','Синонимный поиск');

// content filter
define('_AM_RSSC_FORM_FILTER','Установка фильтра');
define('_AM_RSSC_FORM_FILTER_DESC','Этот фильтр считает хранить или нет каналы в базе данных при автоматическом сборе');
define('_AM_RSSC_CONF_LINK_USE','Использовать таблицу ссылки');
define('_AM_RSSC_CONF_LINK_USE_DESC','Сохранять, когда "Тип" таблицы ссылки "Нормальный"');
define('_AM_RSSC_CONF_WHITE_USE','Использовать белый список');
define('_AM_RSSC_CONF_WHITE_USE_DESC','Сохранять, когда в белом списке');
define('_AM_RSSC_CONF_BLACK_USE','Использовать черный список');
//define('_AM_RSSC_CONF_BLACK_USE_DESC','Not store when in black list');
define('_AM_RSSC_CONF_BLACK_USE_DESC','Не сохранять, когда в черном списке<br />Когда выбрано "Использовать", прерывается процесс фильтрации, если считать черный<br />Когда выбрано "Обучение", продолжить процесс фильтрации, с целью извлечения слов, если считать черный');
define('_AM_RSSC_CONF_BLACK_USE_NO','Не использовать');
define('_AM_RSSC_CONF_BLACK_USE_YES','Использовать');
define('_AM_RSSC_CONF_BLACK_USE_LEARN','Обучение');
define('_AM_RSSC_CONF_WORD_USE','Использовать список отклоненных слов');
define('_AM_RSSC_CONF_WORD_USE_DESC','Не сохранять, когда общая точка списка слов превышает уровень отклонения');
define('_AM_RSSC_CONF_WORD_LEVEL', 'Уровень отклонения');
define('_AM_RSSC_CONF_FEED_SAVE','Сохранение канала');
define('_AM_RSSC_CONF_FEED_SAVE_DESC','Сохранять или нет в таблице каналов, когда считается черным.<br />Когда "Сохранить", сохраняется в статусе "не показывать".');
define('_AM_RSSC_CONF_FEED_SAVE_NO', 'Не сохранять');
define('_AM_RSSC_CONF_FEED_SAVE_YES','Сохранять');
define('_AM_RSSC_CONF_LOG_USE','Использовать файл журнала');
define('_AM_RSSC_CONF_LOG_USE_DESC','Записывать файл журнала, когда считается черным');
define('_AM_RSSC_CONF_WHITE_COUNT','Подсчитывать белый список');
define('_AM_RSSC_CONF_WHITE_COUNT_DESC','Подсчитывать совпадающие записи, когда соответствует белому списку');
define('_AM_RSSC_CONF_BLACK_COUNT','Подсчитывать черный список');
define('_AM_RSSC_CONF_BLACK_COUNT_DESC','Подсчитывать совпадающие записи, когда соответствует черному списку');
define('_AM_RSSC_CONF_WORD_COUNT','Подсчитывать список отклоненных слов');
define('_AM_RSSC_CONF_WORD_COUNT_DESC','Подсчитывать совпадающие записи, когда соответствует списку отклоненных слов');
define('_AM_RSSC_CONF_BLACK_AUTO','Добавлять в черный список');
define('_AM_RSSC_CONF_BLACK_AUTO_DESC','Добавлять адрес в черный списокавтоматически, когда считается черным<br /><b>Уведомление</b> "статус" хранится как "недействительный"<br />Пожалуйста, измените на "действительный" при использовании');
define('_AM_RSSC_CONF_WORD_AUTO','Добавлять с список отклоненных слов');
define('_AM_RSSC_CONF_WORD_AUTO_DESC','Извлечение слов в содержании автоматически и добавление слов в список отклоненных слов автоматически, когда считается черным<br /><b>Уведомление</b> "точка" хранится как ноль<br />Пожалуйста, измените "точку" при использованиии');
define('_AM_RSSC_CONF_WORD_AUTO_NON','Не добавлять');
define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL','Извлечение по пробелу или символу');
define('_AM_RSSC_CONF_WORD_AUTO_KAKASI','Извлечение KAKASI: только на японском языке');

// word extract
define('_AM_RSSC_FORM_WORD','Установка извлечения слов');
define('_AM_RSSC_CONF_JOIN_PREV', 'Регистрация слов');
define('_AM_RSSC_CONF_JOIN_PREV_DESC', 'Регистрировать прямые и обратные слова и сделать фразой');
define('_AM_RSSC_CONF_JOIN_GLUE', 'Промежуток слов');
define('_AM_RSSC_CONF_JOIN_GLUE_DESC', 'В английском установите пробел<br />В японском ничего не устанавливайте');
define('_AM_RSSC_CONF_KAKASI_PATH','Путь к командам KAKASI');
define('_AM_RSSC_CONF_KAKASI_MODE','Режим KAKASI');
define('_AM_RSSC_CONF_KAKASI_MODE_FILE','Использовать временный файл');
define('_AM_RSSC_CONF_KAKASI_MODE_PIPE','Использовать канал UNIX');
define('_AM_RSSC_CONF_CHAR_LENGTH', 'Минимальное количество символов');
define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', 'Минимальное количество символов для извлечения слова');
define('_AM_RSSC_CONF_WORD_LIMIT', 'Максимальное количество отклоненных слов');
define('_AM_RSSC_CONF_WORD_LIMIT_DESC', 'Введите максимальное число слов хранимых в таблице слов<br />Удаляются старые записи, когда количество становится больше, чем это значение<br /><b>0</b> неограничено');
define('_AM_RSSC_KAKASI_EXECUTABLE', 'kakasi исполняемо');
define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'kakasi не исполняемо');
define('_AM_RSSC_CONF_HTML_GET','Получить HTML');
define('_AM_RSSC_CONF_HTML_GET_DESC','Получить данные оригинального HTML автоматически, когда считается списком отклоненных слов<br />Когда выбрано "Использовать", точность расчета повышается , но время выполнения становятся долгим');
define('_AM_RSSC_CONF_HTML_GET_NO','Не использовать');
define('_AM_RSSC_CONF_HTML_GET_YES','Использовать');
define('_AM_RSSC_CONF_HTML_GET_BLACK','Использовать, когда считается черным');
define('_AM_RSSC_CONF_HTML_LIMIT', 'Максимальное количество символов HTML');
define('_AM_RSSC_CONF_HTML_LIMIT_DESC', 'Максимальное количество символов HTML, которые получаются автоматически<br />На некоторых сайтах, HTML данные большие, и время выполнения становятся долгим');

// archive manage
define('_AM_RSSC_LEAN_BLACK', 'Обучение в черном списке');
define('_AM_RSSC_LEAN_BLACK_DESC','Патрулирование черного списка, с целью извлечения слов в содержании автоматически и добавление слов в список отклоненных слов автоматически');
define('_AM_RSSC_NUM_FEED_ALL','Число всех каналов');
define('_AM_RSSC_NUM_FEED_SKIP','Число уже сохраненных каналов');
define('_AM_RSSC_NUM_FEED_REJECT','Число каналов, считающихся черными');

define('_AM_RSSC_THEREARE_TITLE','в связанных <b>%s</b> присутствует <b>%s</b>');

// === 2007-10-10 ===
// config
define('_AM_RSSC_CONF_SHOW_MODE_DATE', 'Режим даты');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON',    'Не показывать');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT',  'короткий');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', 'средний');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG',   'длинный');
define('_AM_RSSC_CONF_SHOW_SITE', 'Информация о сайте');
define('_AM_RSSC_CONF_SHOW_SITE_DSC', 'Когда "ДА", показывать заголовок сайта и адрес');

// link table
define('_AM_RSSC_LINK_CENSOR_DESC', 'Разделите каждый с помощью <b>|</b><br />чувствительны к регистру');


// === 2008-01-20 ===
// menu
define('_AM_RSSC_FORM_HTMLOUT',       'Установка вывода HTML');
define('_AM_RSSC_FORM_HTMLOUT_DESC',  "При обработке содержимого, когда 'Использовать HTML теги в содержании' - 'Да'<br />Все теги удаляются, когда 'Нет' <br />это рекомендуется для удаления или замены JavaScript и связей, чтобы предотвратить XSS (Перекрестные сценарии сайта - Cross Site Scripting) ");
define('_AM_RSSC_FORM_CUSTOM_PLUGIN', 'Пользовательские плагины');

// html out
define('_AM_RSSC_CONF_HTML_NON',    'Отметьте, чтобы сделать');
define('_AM_RSSC_CONF_HTML_SHOW',   'Очистить и показать в HTML');
define('_AM_RSSC_CONF_HTML_REMOVE', 'Удаление');
define('_AM_RSSC_CONF_HTML_REPLACE', 'Заменить строки');
define('_AM_RSSC_CONF_HTML_SCRIPT', 'Тег скрипта');
define('_AM_RSSC_CONF_HTML_SCRIPT_DESC', "Обработка '&lt;script&gt;...&lt;/script&gt;' ");
define('_AM_RSSC_CONF_HTML_STYLE', 'Тег стиля');
define('_AM_RSSC_CONF_HTML_STYLE_DESC', "Обработка '&lt;style&gt;...&lt;/style&gt;' ");
define('_AM_RSSC_CONF_HTML_LINK', 'Тег ссылки');
define('_AM_RSSC_CONF_HTML_LINK_DESC', "Обработка '&lt;link ... &gt;' ");
define('_AM_RSSC_CONF_HTML_COMMENT', 'Метки комментария');
define('_AM_RSSC_CONF_HTML_COMMENT_DESC', "Обработка '&lt;!-- ... --&gt;' ");
define('_AM_RSSC_CONF_HTML_CDATA', 'Метки CDATA');
define('_AM_RSSC_CONF_HTML_CDATA_DESC', "Обработка '&lt;![CDATA[ ... ]]&gt;' ");
define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE', 'Атрибуты onMouse');
define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE_DESC', "Обработка 'onmouseover=\"...\"' или 'onclick=\"...\"' <br />заменять как 'on_mouseover_=\"...\"', когда 'Заменить' ");
define('_AM_RSSC_CONF_HTML_ATTR_STYLE', 'Атрибуты стиля');
define('_AM_RSSC_CONF_HTML_ATTR_STYLE_DESC', "Обработка 'style=\"...\"' или 'class=\"...\"' <br />заменять как 'style_=\"...\"', когда 'Заменить' ");
define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS', 'Удалить другие теги');
define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS_DESC', "Удалять или нет '&lt;img ... &gt;' '&lt;a ... &gt;' '&lt;link ... &gt;' т.д. ");
define('_AM_RSSC_CONF_HTML_OTHER_TAGS', 'Разрешенные теги');
define('_AM_RSSC_CONF_HTML_OTHER_TAGS_DESC', "Введенный тег не удалится, когда 'RУдалить другие теги' - 'Да' <br /> Пример: &lt;img&gt;&lt;a&gt; ");
define('_AM_RSSC_CONF_HTML_JAVASCRIPT', 'Строки JavaScriprt');
define('_AM_RSSC_CONF_HTML_JAVASCRIPT_DESC', "Обработка строк 'JavaScriprt' <br />заменяется на 'java_script', когда 'Заменить' ");

// plugin
define('_AM_RSSC_PRE_PLUGIN_DESC', 'Выполнить перед сохранением в базе данных');
define('_AM_RSSC_POST_PLUGIN_DESC', 'Выполнить после чтения в базе данных');
define('_AM_RSSC_PLUGIN_DESC_2', 'Разделите каждый с помощью <b>|</b>, когда указывается два или более плагинов ');

define('_AM_RSSC_PLUGIN_TEST', 'Тест для плагинов');
define('_AM_RSSC_PLUGIN', 'Плагины');
define('_AM_RSSC_PLUGIN_TESTDATA', 'Данные испытаний');
define('_AM_RSSC_PLUGIN_TESTDATA_DESC', 'Введите форму ассоциативного массива');

// === 2009-02-20 ===
// map
define('_AM_RSSC_FORM_MAP', 'Установка карт Google');

// config
define('_AM_RSSC_CONF_WEBMAP_DIRNAME', 'Имя директории webmap');
define('_AM_RSSC_CONF_WEBMAP_DIRNAME_DESC', 'Установите имя директориимодуля webmap');
define('_AM_RSSC_CONF_SHOW_INFO_MAX','Максимальное количество символов маркера информации');
define('_AM_RSSC_CONF_SHOW_INFO_MAX_DSC', 'HTML теги удаляются<br /><b>-1</b> неограничено');
define('_AM_RSSC_CONF_SHOW_INFO_WIDTH','Максимальное количество символов маркера информации в строке');
define('_AM_RSSC_CONF_SHOW_INFO_WIDTH_DSC', 'Вставить новую строку, когда больше, чем это число<br /><b>-1</b> не ограничено');
define('_AM_RSSC_CONF_SHOW_ICON','Показать иконки');
define('_AM_RSSC_CONF_SHOW_ICON_DSC', 'Когда "ДА" - показать иконку');
define('_AM_RSSC_CONF_SHOW_THUMB','Показать изображение');
define('_AM_RSSC_CONF_SHOW_THUMB_DSC', 'Когда "ДА" - показать миниатюру изображения');

// link form
define('_AM_RSSC_LINK_ICON_SEL',  'Выбор иконки');
define('_AM_RSSC_LINK_GICON_SEL', 'Выбор иконки карт Google');

}
// --- define language begin ---

?>