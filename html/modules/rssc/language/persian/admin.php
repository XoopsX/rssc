<?php
// $Id: admin.php,v 1.1 2011/12/29 14:37:08 ohwada Exp $

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
define('_AM_RSSC_CONF', 'مدیریت مرکز RSS');
define('_AM_RSSC_LIST_LINK', 'لیست لینک');
define('_AM_RSSC_LIST_BLACK', 'لیست لینک  سیاه');
define('_AM_RSSC_LIST_WHITE', 'لیست لینک  سفید');
define('_AM_RSSC_LIST_FEED', 'لیست تغذیه کننده');
define('_AM_RSSC_ADD_LINK', 'اضافه  کردن لینک');
define('_AM_RSSC_ADD_BLACK', 'اضافه کردن لیست سفید');
define('_AM_RSSC_ADD_WHITE', 'اضافه کردن لیست سیاه');
define('_AM_RSSC_ADD_KEYWORD', 'اضافه کردن لغات کلیدی');
define('_AM_RSSC_ARCHIVE_MANAGE', 'مدیریت آرشیو');
define('_AM_RSSC_COMMAND_MANAGE', 'Command Management');
define('_AM_RSSC_UPDATE_MANAGE', 'مدیریت انتقال اطلاعات');
define('_AM_RSSC_VIEW_RSS', 'دیدن RDF/RSS/ATOM');
define('_AM_RSSC_GOTO_MODULE', 'برو به ماژول');

// === index & config ===
define('_AM_RSSC_FORM_BASIC', 'تنظیمات اصلی');
define('_AM_RSSC_FORM_BASIC_DESC', 'این اطلاعات به طور مشترک بین همه ی ماژول ها  استفاده میشود');
define('_AM_RSSC_FORM_MAIN', 'تنظیم متن صفحه ی اول');
define('_AM_RSSC_FORM_MAIN_DESC', 'از این مورد در صفحه ی اصلی ماژول استفاده میشد');
define('_AM_RSSC_FORM_BLOCK', 'تنظیمات بلاک ها');
define('_AM_RSSC_FORM_BLOCK_DESC', 'از این مورد در بلاک های ماژول استفاده میشود');
define('_AM_RSSC_FORM_BIN', 'Command Config');
define('_AM_RSSC_FORM_BIN_DESC', 'It is used on bin command');
define('_AM_RSSC_INIT_NOT','The config table is not initialized');
define('_AM_RSSC_INIT_EXEC','Initialized the config table');
define('_AM_RSSC_VERSION_NOT','It is not version  %s');
define('_AM_RSSC_UPGRADE_EXEC','Upgrade the config table');
define('_AM_RSSC_WARNING_NOT_WRITABLE','راهنما قابل نوشتن نيست');
//define('_AM_RSSC_CONF_NAME','Item');
define('_AM_RSSC_DBUPDATED', 'پایگاه داده ها با موفقیت به روز شد');
define('_AM_RSSC_FAILUPDATE', 'خطا در هنگام ذخیره ی اطلاعات در پایگاه داده ها');
define('_AM_RSSC_FAILDELETE', 'خطا در هنگام حذف کردن اطلاعات از پایگاه داده ها');
define('_AM_RSSC_THERE_ARE_LINKS','تعداد <b>%s</b> لینک در پایگاه داده ها موجود است');
define('_AM_RSSC_THERE_ARE_FEEDS','تعداد <b>%s</b> تغذیه کننده در پایگاه داده ها موجود است');

// === link manage ===
define('_AM_RSSC_LINK_MANAGE','مدیریت لینک');
define('_AM_RSSC_MOD_LINK','ویرایش لینک');
define('_AM_RSSC_DEL_LINK','حذف لینک');
define('_AM_RSSC_SHOW_RSS',  'نمایش RSS');
define('_AM_RSSC_SHOW_FEED', 'نمایش تغذیه کننده ');
define('_AM_RSSC_FEED_BELONG_LINK', 'نمایش تغذیه کننده های وابسته به این لینک');
define('_AM_RSSC_ERROR_FILL', 'خطا: %s را وارد کنید');
define('_AM_RSSC_ERROR_ILLEGAL','خطا: %s غیر مجاز است');

// === black list manage ===
define('_AM_RSSC_BLACK_MANAGE','مدیریت لیست سیاه');
define('_AM_RSSC_MOD_BLACK','ویرایش لیست سیاه');
define('_AM_RSSC_DEL_BLACK','حذف لیست سیاه');
define('_AM_RSSC_FEED_MATCH_LINK', 'تغذیه کننده های را که با این لیست تطابق دارند نمایش بده');

// === white list manage ===
define('_AM_RSSC_WHITE_MANAGE','مدیریت لیست سفید');
define('_AM_RSSC_MOD_WHITE','ویرایش لیست سفید');
define('_AM_RSSC_DEL_WHITE','حذف لیست سفید');

// === feed list manage ===
define('_AM_RSSC_ADD_FEED','اضافه کردن تغذیه کننده');
define('_AM_RSSC_MOD_FEED','ویرایش تغذیه کننده');
define('_AM_RSSC_DEL_FEED','حذف کردن تغذیه کننده');
define('_AM_RSSC_THERE_ARE_MATCH','There are <b>%s</b> datas which is matched to with conditions');
define('_AM_RSSC_CONDITION','Condition');

// === archive manage ===
define('_AM_RSSC_REFRESH', 'تازه کردن آرشیو');
define('_AM_RSSC_REFRESH_NEXT','Check Next %s');
define('_AM_RSSC_LINK_LIMIT', 'محدود کردن لینک');
define('_AM_RSSC_LINK_OFFSET','مبدا لینک');
define('_AM_RSSC_FEED_CLEAR','پاک کردن آرشیو');
define('_AM_RSSC_FEED_CLEAR_OLD','پاک کردن  اطلاعات سفارشی ثبت شده');
define('_AM_RSSC_FEED_CLEAR_NUM','پاک کردن  اطلاعات سفارشی ثبت شده اگر عددی غیر از عدد تعیین شده بدهید پاک میشود');

// refresh result
define('_AM_RSSC_NO_REFRESH','هیچ لینکی به روز نشده');
define('_AM_RSSC_TIME_START','زمان شروع');
define('_AM_RSSC_TIME_END','زمان پایان');
define('_AM_RSSC_TIME_ELAPSE','زمان انجام به روز رسانی');
define('_AM_RSSC_MIN_SEC','%s ثانیه %s دقیقه');
define('_AM_RSSC_NUM_LINK_TOTAL','مجموع لینک ها');
define('_AM_RSSC_NUM_LINK_TARGET','تعداد لینک های هدف');
define('_AM_RSSC_NUM_LINK_BROKEN','تعدا لینک های شکسته');
define('_AM_RSSC_NUM_LINK_UPDATED','تعداد لینک های به روز شده');
define('_AM_RSSC_NUM_FEED_UPDATED','تعادا تغذیه کننده های به روز شده');
define('_AM_RSSC_NUM_FEED_CLEARED','تعداد تغذیه کننده های پاک شده');
define('_AM_RSSC_NUM_LINKS','لینک');
define('_AM_RSSC_NUM_FEEDS','تغذیه کننده');
define('_AM_RSSC_FAILGET', 'نا توان در گرفتن XML  از %s');
define('_AM_RSSC_GOTOTOP', 'Goto Top');

// === configuration ===
// basic configuration
define('_AM_RSSC_CONF_FEED_LIMIT', 'بیشترین تعداد تغذیه کننده ها');
define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'بیشترین تعداد  تغذیه کننده ها را در جدول مقابل وارد کنید<br />وقتی عدد جدید ثبت شود . اطلاعات ثبت شده ی قبلی پاک میشود<br /><b>0</b> نامحدود است');
define('_AM_RSSC_CONF_RSS_ATOM', 'انتخواب کنید RSS یا ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'RSS یا ATOM را  برای وقتی که هر دو لینک RSS یا ATOM پیدا شد انتخواب کنید');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS',  'RSS');
define('_AM_RSSC_CONF_RSS_PARSER', 'تجذیه کننده ی RSS را انتخواب کنید');
define('_AM_RSSC_CONF_RSS_PARSER_SELF',  'RSSC تجزیه کننده');
define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'تجزیه کننده ی RSS زوپس');
define('_AM_RSSC_CONF_ATOM_PARSER', 'تجزیه کننده ATOM را انتخواب کنید');
define('_AM_RSSC_CONF_ATOM_PARSER_0', 'RSSC تجزیه کننده ');
define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
define('_AM_RSSC_CONF_RSS_MODE', 'Initial value of RSS mode');
define('_AM_RSSC_CONF_XML_SAVE', 'ذخیره یXML');
define('_AM_RSSC_CONF_XML_SAVE_DESC', 'اطلاعات XML را در جدول  لینک ذخیره میکند');
define('_AM_RSSC_CONF_FUTURE_DAYS', 'روز های آینده');
define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', "بعد از روز مشخص شده<br />تغذیه کننده ها را نمایش نده, اگر اطلاعات تغذیه کننده ها بیشتر از اطلاعات آن روز بود");

// show configuration
define('_AM_RSSC_CONF_SHOW_ORDER','سفارشی کردن برای نمایش');
//define('_AM_RSSC_CONF_SHOW_ORDER_DESC','');
define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED','آخرین به روز رسانی');
define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED','آخرین انتشار');
define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE','تعداد لینک های هر صفحه');
//define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE','تعداد تغذیه کننده های هر صفحه');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK','تغذیه کننده ها برای هر لینک');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE','بیشترین تعداد کارکتر ها در عنوان');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC','tag های HTML خالی میشود, وقتی عددی بیشتر از مقدار فعلی وارد کنی<br /><b>-1</b> نامحدود میکند');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY','بیشترین تعداد کارکتر ها در خلاصه');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC','<b>-1</b> نامحدود میکند');

// main configuration
define('_AM_RSSC_CONF_MAIN_SEARCH_MIN','کمترین تعداد کارکتر ها برای جستجو');
//define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','');

// bin configuration
define('_AM_RSSC_CONF_BIN_PASS','پسورد');
//define('_AM_RSSC_CONF_BIN_PASS_DESC','');
define('_AM_RSSC_CONF_BIN_SEND','ارسال ایمیل');
//define('_AM_RSSC_CONF_BIN_SEND_DESC','');
define('_AM_RSSC_CONF_BIN_MAILTO','ایمیل فرستنده');
//define('_AM_RSSC_CONF_BIN_MAILTO_DESC','');

// === view rss ===
define('_AM_RSSC_VIEW_RSS_OPTION', 'تنظیم انتخواب ها');
define('_AM_RSSC_NOT_SELECT_LINK','هیچ لینکی انتخواب نشده است');
define('_AM_RSSC_PLEASE_SELECT_LINK','از لیست لینک ها یکی را انتخواب کنید و ID ان را وارد کنید');
define('_AM_RSSC_VIEW_PARSER', 'تنظیمات تجزیه کننده ');
define('_AM_RSSC_VIEW_SAVE_ETC', 'ذخیره کردن در جدول, etc');
define('_AM_RSSC_VIEW_MODE', 'روش نمایش ');
define('_AM_RSSC_VIEW_MODE_DESC', 'وقتی روش 0 را انتخواب کنید در  جدول های پایگاه داده ها ذخیره نمیشود');
define('_AM_RSSC_VIEW_MODE_CURRENT', 'روش0: گرفتن اطلاعات XML');
define('_AM_RSSC_VIEW_MODE_LINK', 'روش 1: داده های XML در  جدول های لینک ذخیره شود');
define('_AM_RSSC_VIEW_MODE_FEED', 'روش 2: داده های XML در جدول های تغذیه کننده ذخیره شود.');
define('_AM_RSSC_VIEW_SANITIZE', 'HTML Sanitize');
define('_AM_RSSC_VIEW_TITLE_HTML','نمایش tag های HTML در عنوان');
define('_AM_RSSC_VIEW_TITLE_HTML_DESC', '.قتی بله را انتخواب کنید  نمایش داده ها شامل tag های HTML هم میشود <br />وقتی نه را انتخواب کنید tag های HTML نمایش داده نمیشود ');
define('_AM_RSSC_VIEW_CONTENT_HTML','نمایش tag های HTML در محتوا');
define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', '.قتی بله را انتخواب کنید  نمایش داده ها شامل tag های HTML هم میشود <br />وقتی نه را انتخواب کنید tag های HTML نمایش داده نمیشود ');
define('_AM_RSSC_VIEW_MAX_CONTENT','بیشترین تعداد کارتر ها در محتوا');
define('_AM_RSSC_VIEW_MAX_CONTENT_DESC','tag های HTML خالی میشود, وقتی عددی بیشتر از مقدار فعلی وارد کنی<br /><b>-1</b> نامحدود میکند');
define('_AM_RSSC_VIEW_LINK_UPDATE', 'جدول لینک ها به روز شد');
define('_AM_RSSC_VIEW_FEED_UPDATE', 'جدول تغذیه کننده ها به روز شد');
define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'نیرو های یابنده ی آدرس RSS');
define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'اور رایت کردن آدرس RDF/RSS/ATOM, وقتی مشخص شد این آدرس به  روش RSS وابسته نیست');
define('_AM_RSSC_VIEW_FORCE_UPDATE', 'نیرو های به روز کننده ی آرشیو');
define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', 'آرشیو اور رایت میشود, وقتی مشخص شد بین زمان  تازه کردن RDF/RSS/ATOM مرتبط فاصله افتاده است');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'نرو های به روز کننده ی جدول تغذیه کننده ها');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', 'جدول تغیزه کننده ها اور رایت میشود, وقتی  اطلاعات اضافی جدیدی در آدرس RDF/RSS/ATOM وجود داشته باشد');
define('_AM_RSSC_VIEW_PRINT_LOG', 'نمایش کارنامه');
define('_AM_RSSC_VIEW_PRINT_LOG_DESC', 'Show log simultaneously during executing');
define('_AM_RSSC_VIEW_PRINT_ERROR', 'نمایش خطا ها');
define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', 'Show error simultaneously during executing');

// === command manage ===
define('_AM_RSSC_CREATE_CONFIG', 'ساخت فایل تنظیم');
define('_AM_RSSC_TEST_BIN_REFRESH', 'تست اجرای bin/refresh.php');

// === update manage ===
define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'وارد کردن اطلاعات از تیتر های خبری زوپس');
define('_AM_RSSC_IMPORT_WEBLINKS', 'وارد کردن اطلاعات از مازول وب لینک');

// === rename ===
define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

// 2006-01-20
define('_AM_RSSC_ID_ASC', 'ID صعودی');
define('_AM_RSSC_ID_DESC','ID نزولی');

// === 2006-06-04 ===
// build rss
define('_AM_RSSC_BUILD', 'ساختن RDF/RSS/ATOM');
define('_AM_RSSC_BUILD_DSC',  'ساخت و نمایش RDF/RSS/ATOM برای اشکال زدایی کردن');
define('_AM_RSSC_BUILD_RDF',  'ساختن RDF');
define('_AM_RSSC_BUILD_RSS',  'ساختن RSS');
define('_AM_RSSC_BUILD_ATOM', 'ساختن ATOM');

// parse rss
define('_AM_RSSC_PARSE_RSS', 'تجزیه کردن RDF/RSS/ATOM');

// refresh link
//define('_AM_RSSC_REFRESH_LINK', 'تازه کردن تغزیه کننده های RDF/RSS/ATOM');
//define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br />Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />if they are not set up.');
//define('_AM_RSSC_REFRESH_LINK_FINISHED', 'تازه کردن تغیزه کننده ها به پایان رسید');

// === 2006-07-08 ===
// description at main
define('_AM_RSSC_CONF_INDEX_DESC','توضیح در صفحه ی اول');
define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'متن توضیح را وارد کنید . این متن در صفحه ی اول ماژول نمایش داده میشود');
define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">این متن توضیحات ماژول است<br />شما  میتوانید این متن را در قسمت تنظیمات ماژول ویرایش کنید.<br /></div><br />');

// link table
define('_AM_RSSC_LINK_DESC','Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />when you dont fill, <br />if web site support "RSS Auto Discovery"');
//define('_AM_RSSC_LINK_EXIST', 'قبلا "RDF/RSS/ATOM آدرس" موجود بوده است');
//define('_AM_RSSC_LINK_EXIST_MORE','There are twe or more links which have same "RDF/RSS/ عنوان سایت" ');
//define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery Faild');
define('_AM_RSSC_LINK_FORCE','Froce to save');

// black & white table
define('_AM_RSSC_BLACK_MEMO','یاداشت');

// === 2006-09-20 ===
// show content with html
define('_AM_RSSC_CONF_SHOW_TITLE_HTML','استفاده از tag های HTML در این جدول');
define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', 'وقتی بله را انتخواب کنید عنوان به وصیله ی  tag های HTML نمایش داده میشود, اگر عنوان HTML tag داشته باشد. <br />وقتی   نه را انتخواب کنید عنوان با tag های هاشور خورده HTML نمایش داده میشود  . ');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML','استفاده از tag های HTML برای محتویات');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', 'وقتی بله را انتخواب کنید محتویات به وصیله ی tag های HTML نمایش داده میشود, اگر محتوا HTML tag داشته باشد. <br />وقتی نه را انتخواب کنید  محتوایت با tag های هاشور خورده HTML نمایش داده میشود. ');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT','بیشترین تعداد کارکتر ها در عنوان');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'tag های HTML خالی میشود, وقتی عددی بیشتر از مقدار فعلی وارد کنید<br /><b>-1</b> نامحدود میکند');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT','بیشترین تعداد تغذیه کننده های RSS/ATOM نمایش داده شده در محتوا');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', 'بیشترین تعداد تغذیه کننده های RSS/ATOM را که در محتوا نمایش داده میشود وارد کنید.');
define('_AM_RSSC_CONF_SHOW_BLOG_LID','ID لینک برای نمایش در blog');
//define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'ID لینک را برای نمایش در blog وارد کنید');

define('_AM_RSSC_TABLE_MANAGE','مدیریت جداول پایگاه داده ها');

// === 2006-11-08 ===
// proxy server
define('_AM_RSSC_FORM_PROXY', 'مدیریت پروکسی سرور');
define('_AM_RSSC_CONF_PROXY_USE',  'استفاده از پروکسی سرور');
define('_AM_RSSC_CONF_PROXY_HOST', 'هاست پروکسی');
define('_AM_RSSC_CONF_PROXY_PORT', 'پورت پروکسی');
define('_AM_RSSC_CONF_PROXY_USER', 'نام کاربری  پروکسی');
define('_AM_RSSC_CONF_PROXY_USER_DESC', 'نام کاربری را وارد کنید, اگر سرور پروکسی شما نیاز به تاید اطلاعات پایه دارد, <br />در غیر این صورت کادر مقابل را خالی بگذارید');
define('_AM_RSSC_CONF_PROXY_PASS', 'واژه ی رمز پروکسی');
define('_AM_RSSC_CONF_PROXY_PASS_DESC', 'واژه ی رمز را وارد کنید, اگر سرور پروکسی شما نیاز به اطلاعات پایه دارد <br />در غیر این صورت کادر مقابل را خالی بگذارید');

define('_AM_RSSC_CONF_HIGHLIGHT', 'استفاده از واژه های کلیدی های لایت');

}
// --- define language begin ---

?>