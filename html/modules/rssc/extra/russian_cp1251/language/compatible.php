<?php
// $Id: compatible.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2007-10-10 K.OHWADA
// enclusure in link table

// 2007-07-01 K.OHWADA
// word table

// 2006-11-08 K.OHWADA
// proxy server

// 2006-09-20 K.OHWWADA
// error message
// show content with html
// table manage

// 2006-07-08 K.OHWADA
// support podcast
// link exist check

// 2006-06-04 K.OHWADA
// this is new file

//=========================================================
// RSS Center Module
// 2006-06-04 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

//---------------------------------------------------------
// compatible for v1.0
//---------------------------------------------------------
if( !defined('_RSSC_MAP') ) 
{
// map
	define('_RSSC_MAP','Карты Google');

// link table
	define('_RSSC_LINK_ICON',  'Иконка');
	define('_RSSC_LINK_GICON_ID', 'ID иконки карт Google');

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
	define('_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT', 'Ширина миниатюры');
}

if( !defined('_AM_RSSC_FORM_MAP') ) 
{
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

//---------------------------------------------------------
// compatible for v0.8
//---------------------------------------------------------
if( !defined('_RSSC_PLUGIN_LIST') ) 
{
// plugin list
	define('_RSSC_PLUGIN_LIST', 'Список плагинов');
	define('_RSSC_PLUGIN_NAME', 'Имя плагина');
	define('_RSSC_PLUGIN_DESCRIPTION', 'Описание');
	define('_RSSC_PLUGIN_USAGE', 'Использование');

// link table
	define('_RSSC_PRE_PLUGIN', 'Плагин предварительной обработки');
	define('_RSSC_POST_PLUGIN','Плагин окончательной обработки');
}

if( !defined('_AM_RSSC_FORM_HTMLOUT') ) 
{
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
}

//---------------------------------------------------------
// compatible for v0.7
//---------------------------------------------------------
if( !defined('_RSSC_LINK_ENCLOSURE') ) 
{
// link table
	define('_RSSC_LINK_ENCLOSURE','Эксплуатация контейнера тега');
	define('_RSSC_LINK_ENCLOSURE_NON','Не использовать');
	define('_RSSC_LINK_ENCLOSURE_POD','Допускать подкаст');
	define('_RSSC_LINK_CENSOR', 'Ввести цензуру слова в заголовке');
	define('_RSSC_LINK_PLUGIN','Плагин');

// black & white table
	define('_RSSC_BW_CACHE','Кэш счетчика канала');
	define('_RSSC_BW_CTIME','Время кэша счетчика канала');

// keyword manage
	define('_RSSC_KEYWORD','Ключевое слово');
}

if( !defined('_AM_RSSC_CONF_SHOW_MODE_DATE') ) 
{
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
}

//---------------------------------------------------------
// compatible for v0.6
//---------------------------------------------------------
if( !defined('_RSSC_WORD_ID') ) 
{
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
}

if( !defined('_AM_RSSC_LIST_WORD') ) 
{
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
}


//---------------------------------------------------------
// compatible for v0.4
//---------------------------------------------------------
if( !defined('_AM_RSSC_FORM_PROXY') ) 
{
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
}

//---------------------------------------------------------
// compatible for v0.3
//---------------------------------------------------------
if( !defined('_RSSC_DB_ERROR') ) 
{
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
}

if( !defined('_AM_RSSC_CONF_SHOW_TITLE_HTML') ) 
{
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
//	define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

	define('_AM_RSSC_TABLE_MANAGE','Управление таблицами базы данных');
}

//---------------------------------------------------------
// compatible for v0.2
//---------------------------------------------------------
// main
if( !defined('_RSSC_PODCAST') ) 
{
// bread crumb
	define('_HOME', 'ГЛАВНАЯ');

// podcast
	define('_RSSC_PODCAST', 'Подкаст');
	define('_RSSC_ENCLOSURE_URL',    'Адрес контейнера');
	define('_RSSC_ENCLOSURE_TYPE',   'Тип контейнера');
	define('_RSSC_ENCLOSURE_LENGTH', 'Длина контейнера');
}

// admin
if( !defined('_AM_RSSC_CONF_INDEX_DESC') ) 
{
// description at main
	define('_AM_RSSC_CONF_INDEX_DESC','Описание на главную страницу');
	define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'Введите описание, если вы хотите чтобы оно отображалось на главной странице.');
	define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Здесь описание.<br />Вы можете редактировать описание в "Настройка модуля".<br /></div><br />');

// link table
	define('_AM_RSSC_LINK_DESC','Обнаруживать адреса <b>RDF/RSS/ATOM</b> автоматически и определять <b>кодировку</b> автоматически, <br />когда вы не заполните, <br />если сайт поддерживает "RSS автоопределение"');
	define('_AM_RSSC_LINK_EXIST', 'Уже существует этот "Адрес RDF/RSS/ATOM"');
	define('_AM_RSSC_LINK_EXIST_MORE','Присутствуют два или несколько ссылок, которые имеют тот же "Адрес RDF/RSS/ATOM" ');
	define('_AM_RSSC_AUTO_FIND_FAILD','RSS автоопределение неудачно');
	define('_AM_RSSC_LINK_FORCE','Принудительное сохранение');

// black & white table
	define('_AM_RSSC_BLACK_MEMO','Заметка');
}

//---------------------------------------------------------
// compatible for v0.1
//---------------------------------------------------------
// main
if( !defined('_RSSC_SINGLE_LINK') ) 
{
// single link
	define('_RSSC_SINGLE_LINK',  'Одиночная ссылка');
	define('_RSSC_SINGLE_LINK_UTF8', 'Одиночная ссылка в кодировке UTF-8');
	define('_RSSC_SINGLE_SUMMARY', 'Описание');
	define('_RSSC_SINGLE_CONTENT', 'Содержимое допускает HTML теги');
	define('_RSSC_UTF8_SUMMARY', 'Описание с UTF-8');
	define('_RSSC_UTF8_CONTENT', 'Содержимое допускает HTML теги с UTF-8');

// detect encoding
	define('_RSSC_ASSUME_ENCODING', 'Предложенное xml кодирование %s ,<br />потому что невозможно определить кодировку автоматически');

// rss item
	define('_RSSC_CREATED', 'Созданный');
	define('_RSSC_ATOM_CONTRIBUTOR_NAME', 'Участник');
	define('_RSSC_ATOM_CONTRIBUTOR_URI',  'Адрес участника');
	define('_RSSC_ATOM_CONTRIBUTOR_EMAIL','Электронный адрес участника');

// no data
	define('_RSSC_NO_HEADLINK','Присутствуют не выбранные заголовки ссылки');
	define('_RSSC_NO_FEED','Отсутствуют данные канала');
}

// admin
if( !defined('_AM_RSSC_PARSE_RSS') ) 
{
// build rss
//	define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
	define('_AM_RSSC_BUILD_DSC',  'Создать и показать RDF/RSS/ATOM для отладки');
//	define('_AM_RSSC_BUILD_RDF',  'Build RDF');
//	define('_AM_RSSC_BUILD_RSS',  'Build RSS');
//	define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');

// parse rss
	define('_AM_RSSC_PARSE_RSS', 'Анализировать RDF/RSS/ATOM');

// refresh link
	define('_AM_RSSC_REFRESH_LINK', 'Обновить RDF/RSS/ATOM каналы');
	define('_AM_RSSC_REFRESH_LINK_DSC', 'Когда обновляются RSS каналы <br />Обнаруживать адрес RSS автоматически и определять кодировку RSS автоматически, <br />если они не установлены.');
	define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Обновление каналов закончено');
}

// execution
if( !defined('_RSSC_EXECUTION_TIME') ) 
{
	define('_RSSC_EXECUTION_TIME', 'Время выполнения');
	define('_RSSC_MEMORY_USAGE', 'Использование памяти');
	define('_RSSC_SEC', 'сек');	
	define('_RSSC_MB', 'МБ');
}

// other
if( !defined('_RSSC_IN') ) 
{
	define('_RSSC_IN', 'в');
	define('_RSSC_MAP_LOADING', 'Загрузка ...');
}
?>