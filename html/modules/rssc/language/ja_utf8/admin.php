<?php
// $Id: admin.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

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
// Japanese UTF-8
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_AM_LOADED') ) 
{

define('RSSC_LANG_AM_LOADED', 1);

// === menu ===
define('_AM_RSSC_CONF', 'RSSセンター管理');
define('_AM_RSSC_LIST_LINK', 'リンク一覧');
define('_AM_RSSC_LIST_BLACK', 'ブラックリスト一覧');
define('_AM_RSSC_LIST_WHITE', 'ホワイトリスト一覧');
define('_AM_RSSC_LIST_FEED', 'feed一覧');
define('_AM_RSSC_ADD_LINK', 'リンクの追加');
define('_AM_RSSC_ADD_BLACK', 'ブラックリストの追加');
define('_AM_RSSC_ADD_WHITE', 'ホワイトリストの追加');
define('_AM_RSSC_ADD_KEYWORD', 'キーワードの追加');
define('_AM_RSSC_ARCHIVE_MANAGE', 'アーカイブ管理');

//define('_AM_RSSC_COMMAND_MANAGE', 'コマンド管理');

define('_AM_RSSC_UPDATE_MANAGE', 'インポート管理');
define('_AM_RSSC_VIEW_RSS', 'RDF/RSS/ATOM の表示');

//define('_AM_RSSC_GOTO_MODULE', 'モジュールへ');

// === index & config ===
define('_AM_RSSC_FORM_BASIC', '基本設定');
define('_AM_RSSC_FORM_BASIC_DESC', '全てのモジュールで共通に使用します');
define('_AM_RSSC_FORM_MAIN', 'メイン表示設定');
define('_AM_RSSC_FORM_MAIN_DESC', 'このモジュールのメイン・ページで使用します');
define('_AM_RSSC_FORM_BLOCK', 'ブロック表示設定');
define('_AM_RSSC_FORM_BLOCK_DESC', 'このモジュールのブロックで使用します');

//define('_AM_RSSC_FORM_BIN', 'コマンド設定');
//define('_AM_RSSC_FORM_BIN_DESC', 'bin コマンドで使用します');
//define('_AM_RSSC_INIT_NOT','設定テーブルが初期化されていない');
//define('_AM_RSSC_INIT_EXEC','設定テーブルを初期化する');
//define('_AM_RSSC_VERSION_NOT','バージョン %s ではない');
//define('_AM_RSSC_UPGRADE_EXEC','設定テーブルをアップグレードする');
//define('_AM_RSSC_WARNING_NOT_WRITABLE','デイレクトリの書込み許可がない');
//define('_AM_RSSC_CONF_NAME','項目');

define('_AM_RSSC_DBUPDATED', 'データベースを更新した');
define('_AM_RSSC_FAILUPDATE', 'データベースの保存ができませんでした');
define('_AM_RSSC_FAILDELETE', 'データベースの削除ができませんでした');
define('_AM_RSSC_THERE_ARE_LINKS','データベースには <b>%s</b> 件のリンクが登録されています。');
define('_AM_RSSC_THERE_ARE_FEEDS','データベースには <b>%s</b> 件の feed が登録されています。');

// === link manage ===
define('_AM_RSSC_LINK_MANAGE','リンクの管理');
define('_AM_RSSC_MOD_LINK','リンクの修正');
define('_AM_RSSC_DEL_LINK','リンクの削除');
define('_AM_RSSC_SHOW_RSS',  'RSS表示');
define('_AM_RSSC_SHOW_FEED', 'feed表示');
define('_AM_RSSC_FEED_BELONG_LINK', 'このリンクに属するfeedを表示する');
define('_AM_RSSC_ERROR_FILL', 'エラー: %s を入力して下さい');
define('_AM_RSSC_ERROR_ILLEGAL','エラー: %s の形式が不正です');

// === black list manage ===
define('_AM_RSSC_BLACK_MANAGE','ブラックリストの管理');
define('_AM_RSSC_MOD_BLACK','ブラックリストの修正');
define('_AM_RSSC_DEL_BLACK','ブラックリストの削除');
define('_AM_RSSC_FEED_MATCH_LINK', 'このリストに一致するfeedを表示する');

// === white list manage ===
define('_AM_RSSC_WHITE_MANAGE','ホワイトリストの管理');
define('_AM_RSSC_MOD_WHITE','ホワイトリストの修正');
define('_AM_RSSC_DEL_WHITE','ホワイトリストの削除');

// === feed list manage ===
define('_AM_RSSC_ADD_FEED','feedの追加');
define('_AM_RSSC_MOD_FEED','feedの修正');
define('_AM_RSSC_DEL_FEED','feedの削除');
define('_AM_RSSC_THERE_ARE_MATCH','条件に一致する <b>%s</b> 件のデータがあります');
define('_AM_RSSC_CONDITION','条件');

// === archive manage ===
define('_AM_RSSC_REFRESH', 'アーカイブの更新');
define('_AM_RSSC_REFRESH_NEXT','次の %s 件を更新する');
define('_AM_RSSC_LINK_LIMIT','リンク数の上限(limit)');
define('_AM_RSSC_LINK_OFFSET','オフセット(offset)');
define('_AM_RSSC_FEED_CLEAR','アーカイブのクリア');
define('_AM_RSSC_FEED_CLEAR_OLD','日付の古い順にクリアする');
define('_AM_RSSC_FEED_CLEAR_NUM','指定した件数以上ならば、日付の古い順にクリアする');

// refresh result
define('_AM_RSSC_NO_REFRESH','更新するリンクがない');
define('_AM_RSSC_TIME_START','開始時刻');
define('_AM_RSSC_TIME_END','終了時刻');
define('_AM_RSSC_TIME_ELAPSE','経過時間');
define('_AM_RSSC_MIN_SEC','%s 分 %s 秒');
define('_AM_RSSC_NUM_LINK_TOTAL','全リンク数');
define('_AM_RSSC_NUM_LINK_TARGET','対象となるリンク数');
define('_AM_RSSC_NUM_LINK_BROKEN','リンク切れのリンク数');
define('_AM_RSSC_NUM_LINK_UPDATED','更新したリンク数');
define('_AM_RSSC_NUM_FEED_UPDATED','更新した FEEDの記事数');
define('_AM_RSSC_NUM_FEED_CLEARED','クリアした FEEDの記事数');
define('_AM_RSSC_NUM_LINKS','件');
define('_AM_RSSC_NUM_FEEDS','件');
define('_AM_RSSC_FAILGET', '%s からの XML の取得ができませんでした。');
define('_AM_RSSC_GOTOTOP', 'トップに戻る');

// === configuration ===
// basic configuration
define('_AM_RSSC_CONF_FEED_LIMIT', 'FEED記事の最大の件数');
define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'feed テーブルに格納するFEED記事の最大の件数を指定する<br />この値を超えると日付の古い方からクリアされる。<br /><b>0</b> は無制限だが、推奨しない。');
define('_AM_RSSC_CONF_RSS_ATOM', 'RSSとATOMの選択');
define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'RSS URLとATOM URLの両方が検出されたときに、どちらを使用するか選択します');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS', 'RSS');
define('_AM_RSSC_CONF_RSS_PARSER', 'RSSパーサーの選択');
define('_AM_RSSC_CONF_RSS_PARSER_SELF',  '内蔵');
define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS Parser');
define('_AM_RSSC_CONF_ATOM_PARSER', 'ATOMパーサーの選択');
define('_AM_RSSC_CONF_ATOM_PARSER_0', '内蔵');
define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
define('_AM_RSSC_CONF_RSS_MODE', 'RSS モードの初期値');
define('_AM_RSSC_CONF_XML_SAVE', 'XMLを保存する');
define('_AM_RSSC_CONF_XML_SAVE_DESC', '読み出したXMLを link テーブルに保存する');
define('_AM_RSSC_CONF_FUTURE_DAYS', '未来の日付け');
define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', '単位は日数<br />この日数よりも未来の記事であれば、表示しない');

// show configuration
define('_AM_RSSC_CONF_SHOW_ORDER','表示する順番');
//define('_AM_RSSC_CONF_SHOW_ORDER_DESC','表示する順番を指定してください');
define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED','新しい更新日 updated');
define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED','新しい発行日 published');
define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE','１ページに表示するリンク件数');
//define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','１ページあたりに表示する最大件数を指定してください');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE','１ページに表示するfeed件数');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','１ページあたりに表示する最大件数を指定してください');
define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK','１リンク毎に表示するfeed件数');
//define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','１リンクあたりに表示する最大件数を指定してください');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE','タイトルの最大文字数');
define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC','この文字数を超えたときは、HTMLタグは削除されます<br /><b>-1</b> のときは、制限なしです');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY','要約の最大文字数');
define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC','<b>-1</b> のときは、制限なしです');

// main configuration
define('_AM_RSSC_CONF_MAIN_SEARCH_MIN','検索のキーワード最低文字数');
//define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','検索を行う際に必要なキーワードの最低文字数を指定してください');

// bin configuration
//define('_AM_RSSC_CONF_BIN_PASS','パスワード');
//define('_AM_RSSC_CONF_BIN_PASS_DESC','パスワードを指定してください');
//define('_AM_RSSC_CONF_BIN_SEND','メールの送信');
//define('_AM_RSSC_CONF_BIN_SEND_DESC','結果をメールを送信するときは「はい」を指定してください');
//define('_AM_RSSC_CONF_BIN_MAILTO','送信先のメールアドレス');
//define('_AM_RSSC_CONF_BIN_MAILTO_DESC','送信先のメールアドレスを指定してください');

// === view rss ===
define('_AM_RSSC_VIEW_RSS_OPTION', 'オプション設定');
define('_AM_RSSC_NOT_SELECT_LINK','リンクが選択されていません');
define('_AM_RSSC_PLEASE_SELECT_LINK','リンク一覧から選択するか。LINK ID を入力してください');
define('_AM_RSSC_VIEW_PARSER', 'パーサーの設定');
define('_AM_RSSC_VIEW_SAVE_ETC', 'テーブル格納の設定、その他');
define('_AM_RSSC_VIEW_MODE', '表示モード');
define('_AM_RSSC_VIEW_MODE_DESC', 'mode 0 のときは、テーブルに格納しない');
define('_AM_RSSC_VIEW_MODE_CURRENT', 'mode 0: 取得した XML データ');
define('_AM_RSSC_VIEW_MODE_LINK', 'mode 1: link テーブルに格納された XML データ');
define('_AM_RSSC_VIEW_MODE_FEED', 'mode 2: feed テーブルに格納されたデータ');
define('_AM_RSSC_VIEW_SANITIZE', 'html サニタイズする');
define('_AM_RSSC_VIEW_TITLE_HTML','タイトルのHTMLタグの表示');
define('_AM_RSSC_VIEW_TITLE_HTML_DESC', '「はい」を選択すると、HTMLタグがあるときは、そのまま表示する。<br />「いいえ」を選択すると、HTMLタグを削除して表示する。');
define('_AM_RSSC_VIEW_CONTENT_HTML','本文のHTMLタグの表示');
define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', '「はい」を選択すると、HTMLタグがあるときは、そのまま表示する。<br />「いいえ」を選択すると、HTMLタグを削除して表示する。');
define('_AM_RSSC_VIEW_MAX_CONTENT','本文の最大文字数');
define('_AM_RSSC_VIEW_MAX_CONTENT_DESC','この文字数を超えたときは、HTMLタグは削除されます<br /><b>-1</b> のときは、制限なしです');
define('_AM_RSSC_VIEW_LINK_UPDATE', 'link テーブルの更新');
define('_AM_RSSC_VIEW_FEED_UPDATE', 'feed テーブルの更新');
define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'RSS URLの強制検出');
define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'RSSモードに関係なく、RDF/RSS/ATOM URL を検出し、URLを上書きまします');
define('_AM_RSSC_VIEW_FORCE_UPDATE', 'アーカイブの強制更新');
define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', '更新間隔に関係なく、RDF/RSS/ATOM を読み出し、アーカイブを上書きまします');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'feed テーブルの強制更新');
define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', '同じ RDF/RSS/ATOM のデータが存在していても、feed テーブルを上書きまします');
define('_AM_RSSC_VIEW_PRINT_LOG', 'ログの表示');
define('_AM_RSSC_VIEW_PRINT_LOG_DESC', '実行時に同時にログを表示する');
define('_AM_RSSC_VIEW_PRINT_ERROR', 'エラーの表示');
define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', '実行時に同時にエラーを表示する');

// === command manage ===
//define('_AM_RSSC_CREATE_CONFIG', '設定ファイルの生成');
//define('_AM_RSSC_TEST_BIN_REFRESH', 'bin/refresh.php のテスト実行');

// === update manage ===
define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'XoopsHeadline からのデータ移行');
define('_AM_RSSC_IMPORT_WEBLINKS', 'WebLinks からのデータ移行');

// === rename ===
define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

// 2006-01-20
define('_AM_RSSC_ID_ASC', 'ID 正順');
define('_AM_RSSC_ID_DESC','ID 逆順');

// === 2006-06-04 ===
// build rss
//define('_AM_RSSC_BUILD', 'RDF/RSS/ATOM の生成');
//define('_AM_RSSC_BUILD_DSC',  'デバック用に RDF/RSS/ATOM を生成し表示する');
//define('_AM_RSSC_BUILD_RDF',  'RDF の生成');
//define('_AM_RSSC_BUILD_RSS',  'RSS の生成');
//define('_AM_RSSC_BUILD_ATOM', 'ATOM の生成');

// parse rss
define('_AM_RSSC_PARSE_RSS', 'RDF/RSS/ATOM の解析');

// refresh link
//define('_AM_RSSC_REFRESH_LINK', 'feed 記事の更新');
//define('_AM_RSSC_REFRESH_LINK_DSC', '引き続いて、RDF/RSS/ATOM の feed 記事を更新します。<br />もし設定されていなければ、<br /> <b>RDF/RSS/ATOM URL</b> と <b>エンコード</b> を自動的に検出します。');
//define('_AM_RSSC_REFRESH_LINK_FINISHED', 'feed 記事を更新した');

// === 2006-07-08 ===
// description at main
define('_AM_RSSC_CONF_INDEX_DESC','メインページの説明');
define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'メインページに表示するときは、説明文を指定してください。');
define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">ここには説明文を表示します。<br />説明文は「モジュールの設定」にて編集できます。<br /></div><br />');

// link table
define('_AM_RSSC_LINK_DESC','登録するWEBサイトが RSS Auto Discovery (自動検出) に対応している場合は、<br /><b>RDF/RSS/ATOM URL</b> と <b>エンコード</b> を記入しなくとも、自動的に設定されます');
//define('_AM_RSSC_LINK_EXIST', 'その「RDF/RSS/ATOM URL」は登録済みです');
//define('_AM_RSSC_LINK_EXIST_MORE','同じ「RDF/RSS/ATOM URL」を持つ複数のリンクが見つかりました');
//define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery  (自動検出) が出来ませんでした');
define('_AM_RSSC_LINK_FORCE','強制保存');

// black & white table
define('_AM_RSSC_BLACK_MEMO','備考');

// === 2006-09-20 ===
// show content with html
define('_AM_RSSC_CONF_SHOW_TITLE_HTML','タイトルのHTMLタグの表示');
define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', '「はい」を選択すると、HTMLタグがあるときは、そのまま表示する。<br />「いいえ」を選択すると、HTMLタグを削除して表示する。');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML','本文のHTMLタグの表示');
define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', '「はい」を選択すると、HTMLタグがあるときは、そのまま表示する。<br />「いいえ」を選択すると、HTMLタグを削除して表示する。');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT','本文の最大文字数');
define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'この文字数を超えたときは、HTMLタグは削除されます<br /><b>-1</b> のときは、制限なしです');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT','本文を表示するfeed件数');
define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', '本文を表示する最大件数を指定してください');
define('_AM_RSSC_CONF_SHOW_BLOG_LID','Bolg を表示する Link ID');
//define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Bolg を表示する Link ID を指定してください');

define('_AM_RSSC_TABLE_MANAGE','DBテーブル管理');

// === 2006-11-08 ===
// proxy server
define('_AM_RSSC_FORM_PROXY', 'プロキシ・サーバー 設定');
define('_AM_RSSC_CONF_PROXY_USE',  'プロキシ・サーバーを使用する');
define('_AM_RSSC_CONF_PROXY_HOST', 'プロキシ・ホスト名');
define('_AM_RSSC_CONF_PROXY_PORT', 'プロキシ・ポート番号');
define('_AM_RSSC_CONF_PROXY_USER', 'プロキシ・ユーザ名');
define('_AM_RSSC_CONF_PROXY_USER_DESC', 'プロキシ・サーバーがBASIC認証を必要とする場合は、ユーザ名を入力する<br />そうでなければ、空欄のままにする');
define('_AM_RSSC_CONF_PROXY_PASS', 'プロキシ・パスワード');
define('_AM_RSSC_CONF_PROXY_PASS_DESC', 'プロキシ・サーバーがBASIC認証を必要とする場合は、パスワードを入力する<br />そうでなければ、空欄のままにする');

define('_AM_RSSC_CONF_HIGHLIGHT', 'キーワードのハイライト表示を使用する');

// === 2007-06-01 ===
// word_list
define('_AM_RSSC_LIST_WORD','禁止語の一覧');
define('_AM_RSSC_WORD_MANAGE','禁止語の管理');
define('_AM_RSSC_ADD_WORD','禁止語の追加');
define('_AM_RSSC_MOD_WORD','禁止語の修正');
define('_AM_RSSC_DEL_WORD','禁止語の削除');
define('_AM_RSSC_POINT_ASC', '点数の少ない順');
define('_AM_RSSC_POINT_DESC','点数の多い順');
define('_AM_RSSC_COUNT_ASC', '出現回数の少ない順');
define('_AM_RSSC_COUNT_DESC','出現回数の多い順');
define('_AM_RSSC_WORD_ASC', 'ABCあいうえお 順');
define('_AM_RSSC_WORD_DESC','ABCあいうえお 逆順');
define('_AM_RSSC_NON_ACT','非表示の一覧');
define('_AM_RSSC_NON_ACT_ASC', '非表示 ID正順');
define('_AM_RSSC_NON_ACT_DESC','非表示 ID逆順');
define('_AM_RSSC_WORD_ALREADY','その禁止語は登録されている');
define('_AM_RSSC_WORD_SEARCH','類似語 検索');

// content filter
define('_AM_RSSC_FORM_FILTER','フィルタ設定');
define('_AM_RSSC_FORM_FILTER_DESC','feed 記事を自動収集するときに、データベースに保存するしないを判定する仕組み');
define('_AM_RSSC_CONF_LINK_USE','リンクテーブルの使用');
define('_AM_RSSC_CONF_LINK_USE_DESC','リンクテーブルの「タイプ」が「通常」であれば、保存する');
define('_AM_RSSC_CONF_WHITE_USE','ホワイトリストの使用');
define('_AM_RSSC_CONF_WHITE_USE_DESC','ホワイトリストにあれば、保存する');
define('_AM_RSSC_CONF_BLACK_USE','ブラックリストの使用');
define('_AM_RSSC_CONF_BLACK_USE_DESC','ブラックリストにあれば、保存しない<br />使用では、ブラックと判定すると、以降の処理を中断する<br />学習モードでは、禁止語を抽出するため、処理を継続する');
define('_AM_RSSC_CONF_BLACK_USE_NO','未使用');
define('_AM_RSSC_CONF_BLACK_USE_YES','使用');
define('_AM_RSSC_CONF_BLACK_USE_LEARN','学習モード');
define('_AM_RSSC_CONF_WORD_USE','禁止語リストの使用');
define('_AM_RSSC_CONF_WORD_USE_DESC','禁止語リストの合計得点が判定レベルを超えると、保存しない');
define('_AM_RSSC_CONF_WORD_LEVEL', '判定レベル');
define('_AM_RSSC_CONF_FEED_SAVE','feed 記事の保存');
define('_AM_RSSC_CONF_FEED_SAVE_DESC','ブラックと判定したときに、feed テーブルに保存するか否か。<br />
「保存する」では、非表示の状態にして保存します。');
define('_AM_RSSC_CONF_FEED_SAVE_NO', '保存しない');
define('_AM_RSSC_CONF_FEED_SAVE_YES','保存する');
define('_AM_RSSC_CONF_LOG_USE','ログファイルの使用');
define('_AM_RSSC_CONF_LOG_USE_DESC','ブラックと判定したときに、ログファイルに保存する');
define('_AM_RSSC_CONF_WHITE_COUNT','ホワイトリストのカウント');
define('_AM_RSSC_CONF_WHITE_COUNT_DESC','ホワイトリストに合致したとき、該当の条件をカウントアップする');
define('_AM_RSSC_CONF_BLACK_COUNT','ブラックリストのカウント');
define('_AM_RSSC_CONF_BLACK_COUNT_DESC','ブラックリストに合致したとき、該当の条件をカウントアップする');
define('_AM_RSSC_CONF_WORD_COUNT','禁止語リストのカウント');
define('_AM_RSSC_CONF_WORD_COUNT_DESC','禁止語リストに合致したとき、該当の条件をカウントアップする');
define('_AM_RSSC_CONF_BLACK_AUTO','ブラックリストの自動登録');
define('_AM_RSSC_CONF_BLACK_AUTO_DESC','ブラックと判定されたURLをブラックリストに自動的に登録する<br /><b>注意</b> 「無効」状態で登録します<br />使用する場合は「有効」に変更してください');
define('_AM_RSSC_CONF_WORD_AUTO','禁止語の自動登録');
define('_AM_RSSC_CONF_WORD_AUTO_DESC','ブラックと判定されたコンテンツに含まれる単語を自動的に抽出して、禁止語リストに自動的に登録する<br /><b>注意</b> 「点数」=0 で登録します<br />使用する場合は点数を設定してください');
define('_AM_RSSC_CONF_WORD_AUTO_NON','自動登録しない');
define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL','空白や記号による単語の抽出');
define('_AM_RSSC_CONF_WORD_AUTO_KAKASI','KAKASIによる単語の抽出');

// word extract
define('_AM_RSSC_FORM_WORD','単語抽出の設定');
define('_AM_RSSC_CONF_JOIN_PREV', '単語の連結');
define('_AM_RSSC_CONF_JOIN_PREV_DESC', '前後の単語と連結し、熟語を作る');
define('_AM_RSSC_CONF_JOIN_GLUE', '単語の連結子');
define('_AM_RSSC_CONF_JOIN_GLUE_DESC', '日本語では何も指定しない<br />英語では半角空白を指定する');
define('_AM_RSSC_CONF_KAKASI_PATH','KAKASIのコマンドパス');
define('_AM_RSSC_CONF_KAKASI_MODE','KAKASIのモード');
define('_AM_RSSC_CONF_KAKASI_MODE_FILE','一時ファイルを使用する');
define('_AM_RSSC_CONF_KAKASI_MODE_PIPE','UNIX pipe を使用する');
define('_AM_RSSC_CONF_CHAR_LENGTH', '単語の最小文字数');
define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', '抽出する単語の最小の(半角)文字数');
define('_AM_RSSC_CONF_WORD_LIMIT', '禁止語の最大の登録数');
define('_AM_RSSC_CONF_WORD_LIMIT_DESC', 'word テーブルに格納する禁止語の最大の登録数を指定する<br />この値を超えると日付の古い方からクリアされる。<br /><b>0</b> は無制限だが、推奨しない。');
define('_AM_RSSC_KAKASI_EXECUTABLE', 'kakasi が実行可能です');
define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'kakasi が実行できません');
define('_AM_RSSC_CONF_HTML_GET','HTMLの自動取得');
define('_AM_RSSC_CONF_HTML_GET_DESC','禁止語リストを使用して判定を行うときに、発言元のHTMLデータを自動取得します<br />HTMLデータを取得すると、判定の精度は向上しますが、実行時間も大きくなります');
define('_AM_RSSC_CONF_HTML_GET_NO','自動取得しない');
define('_AM_RSSC_CONF_HTML_GET_YES','自動取得する');
define('_AM_RSSC_CONF_HTML_GET_BLACK','ブラックと判定されときに自動取得する');
define('_AM_RSSC_CONF_HTML_LIMIT', 'HTMLデータの最大の文字数');
define('_AM_RSSC_CONF_HTML_LIMIT_DESC', '自動取得したHTMLデータの最大の文字数<br />サイトによっては大きなデータとなり、その分 実行時間が長くなります');

// archive manage
define('_AM_RSSC_LEAN_BLACK', 'ブラックリストの学習');
define('_AM_RSSC_LEAN_BLACK_DESC','ブラックリストを巡回し、コンテンツに含まれる単語を自動的に抽出して、禁止語リストに自動的に登録する');
define('_AM_RSSC_NUM_FEED_ALL','全てのFEEDの記事数');
define('_AM_RSSC_NUM_FEED_SKIP','すでに保存されていたFEEDの記事数');
define('_AM_RSSC_NUM_FEED_REJECT','ブラックと判定されたFEEDの記事数');

define('_AM_RSSC_THEREARE_TITLE','<b>%s</b> に関するデータは <b>%s</b> です。');

// === 2007-10-10 ===
// config
define('_AM_RSSC_CONF_SHOW_MODE_DATE', '日付の種類');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON',    '表示しない');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT',  'short');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', 'middle');
define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG',   'long');
define('_AM_RSSC_CONF_SHOW_SITE', 'サイト情報');
define('_AM_RSSC_CONF_SHOW_SITE_DSC', 'サイト名とURLを表示するか');

// link table
define('_AM_RSSC_LINK_CENSOR_DESC', '文字列と文字列の間は <b>|</b> で区切ります<br />大文字小文字は区別します');


// === 2008-01-20 ===
// menu
define('_AM_RSSC_FORM_HTMLOUT',       'HTML出力設定');
define('_AM_RSSC_FORM_HTMLOUT_DESC',  '本文のHTMLタグの表示を「はい」に設定したときの、本文の処理<br />「いいえ」のときは、全てのタグは削除される<br />XSS (クロスサイトスクリプティング) 防止のために、JavaScript 関係の記述は削除するか文字列変換することをお勧めします');
define('_AM_RSSC_FORM_CUSTOM_PLUGIN', 'カスタム・プラグイン');

// html out
define('_AM_RSSC_CONF_HTML_NON',    '何もしない');
define('_AM_RSSC_CONF_HTML_SHOW',   'サニタイズしてHTML表示する');
define('_AM_RSSC_CONF_HTML_REMOVE', '削除する');
define('_AM_RSSC_CONF_HTML_REPLACE', '文字列を変換する');
define('_AM_RSSC_CONF_HTML_SCRIPT', 'script タグ');
define('_AM_RSSC_CONF_HTML_SCRIPT_DESC', '&lt;script&gt;...&lt;/script&gt; の処理');
define('_AM_RSSC_CONF_HTML_STYLE', 'style タグ');
define('_AM_RSSC_CONF_HTML_STYLE_DESC', '&lt;style&gt;...&lt;/style&gt; の処理');
define('_AM_RSSC_CONF_HTML_LINK', 'link タグ');
define('_AM_RSSC_CONF_HTML_LINK_DESC', '&lt;link ... &gt; の処理');
define('_AM_RSSC_CONF_HTML_COMMENT', 'コメント記号');
define('_AM_RSSC_CONF_HTML_COMMENT_DESC', '&lt;!-- ... --&gt; の処理');
define('_AM_RSSC_CONF_HTML_CDATA', 'CDATA 記号');
define('_AM_RSSC_CONF_HTML_CDATA_DESC', '&lt;![CDATA[ ... ]]&gt; の処理');
define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE', 'onMouse 属性');
define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE_DESC', 'onmouseover="..." や onclick="..." の処理<br />「変換」のときは on_mouseover_="..." のようになる');
define('_AM_RSSC_CONF_HTML_ATTR_STYLE', 'style 属性');
define('_AM_RSSC_CONF_HTML_ATTR_STYLE_DESC', 'style="..." や class="..." の処理<br />「変換」のときは style_="..." のようになる');
define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS', 'その他のタグの削除');
define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS_DESC', '&lt;img ... &gt; &lt;a ... &gt; &lt;link ... &gt; などのタグを削除するか');
define('_AM_RSSC_CONF_HTML_OTHER_TAGS', '削除しないタグ');
define('_AM_RSSC_CONF_HTML_OTHER_TAGS_DESC', '「その他のタグの削除」が「はい」のときに、削除しないタグを記入する<br /> 例: <img><a>');
define('_AM_RSSC_CONF_HTML_JAVASCRIPT', 'JavaScriprt 文字列');
define('_AM_RSSC_CONF_HTML_JAVASCRIPT_DESC', 'JavaScriprt という文字列に対する処理<br />「変換」のときは java_script となる');

// plugin
define('_AM_RSSC_PRE_PLUGIN_DESC', 'データベースに格納する前に実行される');
define('_AM_RSSC_POST_PLUGIN_DESC', 'データベースから読み出した後に実行される');
define('_AM_RSSC_PLUGIN_DESC_2', '複数のプラグインを指定する場合は <b>|</b> で区切ります');

define('_AM_RSSC_PLUGIN_TEST', 'プラグインのテスト');
define('_AM_RSSC_PLUGIN', 'プラグイン');
define('_AM_RSSC_PLUGIN_TESTDATA', 'テストデータ');
define('_AM_RSSC_PLUGIN_TESTDATA_DESC', '連想配列の形式で記述する');

// === 2009-02-20 ===
// map
define('_AM_RSSC_FORM_MAP', 'Google マップ 設定');

// config
define('_AM_RSSC_CONF_WEBMAP_DIRNAME', 'webmap dirname');
define('_AM_RSSC_CONF_WEBMAP_DIRNAME_DESC', 'webmap モジュールのディレクトリ名を設定する');
define('_AM_RSSC_CONF_SHOW_INFO_MAX','マーカーの全体の最大文字数');
define('_AM_RSSC_CONF_SHOW_INFO_MAX_DSC', 'HTMLタグは削除されます<br /><b>-1</b> のときは、制限なしです');
define('_AM_RSSC_CONF_SHOW_INFO_WIDTH','マーカーの１行の最大文字数');
define('_AM_RSSC_CONF_SHOW_INFO_WIDTH_DSC', 'この文字数以上のときは改行されます<br /><b>-1</b> のときは、制限なしです');
define('_AM_RSSC_CONF_SHOW_ICON','アイコン表示');
define('_AM_RSSC_CONF_SHOW_ICON_DSC', 'アイコンを表示するか');
define('_AM_RSSC_CONF_SHOW_THUMB','画像表示');
define('_AM_RSSC_CONF_SHOW_THUMB_DSC', 'サムネイル画像を表示するか');

// link form
define('_AM_RSSC_LINK_ICON_SEL',  'アイコンの選択');
define('_AM_RSSC_LINK_GICON_SEL', 'Googleアイコンの選択');

// === 2012-03-01 ===
define('_AM_RSSC_MAP_MANAGE',  'GoogleMap 管理');

// config
define('_AM_RSSC_CONF_WEBMAP_ADDRESS', '住所');
define('_AM_RSSC_CONF_WEBMAP_ADDRESS_DESC', '緯度・経度の場所を示すメモ');
define('_AM_RSSC_CONF_WEBMAP_LATITUDE',  '緯度');
define('_AM_RSSC_CONF_WEBMAP_LONGITUDE', '経度');
define('_AM_RSSC_CONF_WEBMAP_ZOOM',      'ズーム');

}
// --- define language begin ---

?>