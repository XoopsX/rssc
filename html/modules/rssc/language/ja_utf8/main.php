<?php
// $Id: main.php,v 1.1 2011/12/29 14:37:07 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

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
// Japanese UTF-8
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_MB_LOADED') ) 
{

define('RSSC_LANG_MB_LOADED', 1);

// global
//define('_ADDED','追加した');
//define('_DELETED','削除した');
//define('_UPDATE', '更新');
//define('_UPDATED','更新した');
//define('_MODIFY',  '変更');
//define('_MODIFIED','変更した');
//define('_SAVE', '保存');
//define('_SAVED','保存した');
//define('_CLEAR',  'クリア');
//define('_CLEARED','クリアした');
//define('_EXECUTE', '実行');
//define('_EXECUTED','実行した');
//define('_CREATE', '生成');
//define('_CREATED','生成した');
//define('_VISIT','訪問');
//define('_SHOW','表示');
//define('_KEYWORD','キーワード');
//define('_NUM','件');
//define('_NO_ACTION','何もしない');
//define('_NO_RECORD','該当するレコードが存在しません');

// index & search
//define('_RSSC_MAIN','メイン');

define('_RSSC_SEARCH','検索');
define('_RSSC_LATEST_FEEDS','最新 RDF/RSS/ATOM 記事');
define('_RSSC_THEREARE','現在データベースには <b>%s</b> 件のデータが登録されています。');

// headline
define('_RSSC_HEADLINE','簡易ヘッドライン');
define('_RSSC_LASTUPDATE','最終更新日');

// single
define('_RSSC_SINGLE','FEED 単体表示');

// common
define('_RSSC_SITE_TITLE','サイト名');
define('_RSSC_SITE_LINK', 'サイトURL');

//define('_RSSC_SITE_DESCRIPTION', 'サイトの説明');
//define('_RSSC_SITE_PUBLISHED', 'サイト公開日');
//define('_RSSC_SITE_UPDATED',   'サイト更新日');
//define('_RSSC_SITE_DATE',      'サイト作成日');
//define('_RSSC_SITE_COPYRIGHT', 'サイト著作権');
//define('_RSSC_SITE_GENERATOR', 'サイト生成元');
//define('_RSSC_SITE_CATEGORY',  'サイト・カテゴリ');
//define('_RSSC_SITE_WEBMASTER', 'サイト管理者');
//define('_RSSC_SITE_LANGUAGE',  'サイト言語');
//define('_RSSC_TITLE', 'タイトル');
//define('_RSSC_LINK',  'URL');
//define('_RSSC_DESCRIPTION', '説明'); 
//define('_RSSC_SUMMARY', '要約'); 
//define('_RSSC_CONTENT', '内容');
//define('_RSSC_PUBLISHED', '公開日');

define('_RSSC_UPDATED',   '更新日');

//define('_RSSC_CATEGORY',  'カテゴリ');
//define('_RSSC_RIGHTS', '著作権');
//define('_RSSC_SOURCE', '情報源');
//define('_RSSC_AUTHOR_NAME', '作者名');
//define('_RSSC_AUTHOR_URI',  '作者URL');
//define('_RSSC_AUTHOR_EMAIL','作者メール');
//define('_RSSC_IMAGE_TITLE',  '画像タイトル');
//define('_RSSC_IMAGE_URL',    '画像URL');

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
//define('_RSSC_RSS_SITE_MANAGINGEDITOR', 'サイト編集者');
//define('_RSSC_RSS_SITE_DOCS','サイト文書');
//define('_RSSC_RSS_SITE_CLOUD', 'サイト・クラウド');
//define('_RSSC_RSS_SITE_TTL', 'サイト生存時間');
//define('_RSSC_RSS_SITE_RATING', 'サイト評価');
//define('_RSSC_RSS_SITE_TEXTINPUT', 'サイト・テキスト入力');
//define('_RSSC_RSS_SITE_SKIPHOURS', 'サイト・スキップ時間');
//define('_RSSC_RSS_SITE_SKIPDAYS',  'サイト・スキップ日数');
//define('_RSSC_RSS_IMAGE_TITLE',  _RSSC_IMAGE_TITLE);
//define('_RSSC_RSS_IMAGE_URL',    _RSSC_IMAGE_URL);
//define('_RSSC_RSS_IMAGE_WIDTH',  '画像の幅');
//define('_RSSC_RSS_IMAGE_HEIGHT', '画像の高さ');
//define('_RSSC_RSS_IMAGE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_RSS_TITLE',_RSSC_TITLE);
//define('_RSSC_RSS_LINK', _RSSC_LINK);
//define('_RSSC_RSS_DESCRIPTION', _RSSC_DESCRIPTION); 
//define('_RSSC_RSS_PUBDATE',  _RSSC_PUBLISHED);
//define('_RSSC_RSS_CATEGORY', _RSSC_CATEGORY);
//define('_RSSC_RSS_SOURCE',   _RSSC_SOURCE);
//define('_RSSC_RSS_GUID',   'RSS guid');
//define('_RSSC_RSS_AUTHOR', '作者');
//define('_RSSC_RSS_COMMENTS','コメント');
//define('_RSSC_RSS_ENCLOSURE', '同封');

// RDF
//define('_RSSC_RDF_SITE_TITLE', _RSSC_SITE_TITLE);
//define('_RSSC_RDF_SITE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_RDF_SITE_DESCRIPTION', _RSSC_SITE_DESCRIPTION);
//define('_RSSC_RDF_SITE_PUBLISHER',   _RSSC_SITE_WEBMASTER);
//define('_RSSC_RDF_SITE_RIGHT', _RSSC_SITE_COPYRIGHT);
//define('_RSSC_RDF_SITE_DATE',  _RSSC_SITE_PUBLISHED );
//define('_RSSC_RDF_SITE_TEXTINPUT', 'サイト・テキスト入力');
//define('_RSSC_RDF_SITE_IMAGE',  'サイト画像');
//define('_RSSC_RDF_IMAGE_TITLE', _RSSC_IMAGE_TITLE);
//define('_RSSC_RDF_IMAGE_URL',   _RSSC_IMAGE_URL);
//define('_RSSC_RDF_IMAGE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_RDF_TITLE',_RSSC_TITLE);
//define('_RSSC_RDF_LINK', _RSSC_LINK);
//define('_RSSC_RDF_DESCRIPTION', _RSSC_DESCRIPTION); 
//define('_RSSC_RDF_TEXTINPUT', 'テキスト入力');

// ATOM
//define('_RSSC_ATOM_SITE_TITLE', _RSSC_SITE_TITLE);
//define('_RSSC_ATOM_SITE_LINK',  _RSSC_SITE_LINK);
//define('_RSSC_ATOM_SITE_PUBLISHED', _RSSC_SITE_PUBLISHED);
//define('_RSSC_ATOM_SITE_UPDATED',   _RSSC_SITE_UPDATED);
//define('_RSSC_ATOM_SITE_RIGHTS',    _RSSC_SITE_COPYRIGHT);
//define('_RSSC_ATOM_SITE_GENERATOR', _RSSC_SITE_GENERATOR);
//define('_RSSC_ATOM_SITE_CATEGORY',  _RSSC_SITE_CATEGORY);
//define('_RSSC_ATOM_SITE_LINK_ALTERNATE', _RSSC_SITE_LINK);
//define('_RSSC_ATOM_SITE_LINK_SELF', 'ATOM自身のURL');
//define('_RSSC_ATOM_SITE_ID','サイトID');
//define('_RSSC_ATOM_SITE_CONTRIBUTOR','サイト貢献者');
//define('_RSSC_ATOM_SITE_SUBTITLE','サイト副題');
//define('_RSSC_ATOM_SITE_ICON', 'サイト・アイコン');
//define('_RSSC_ATOM_SITE_LOGO', 'サイト・ロゴ');
//define('_RSSC_ATOM_SITE_SOURCE', 'サイト情報源');
//define('_RSSC_ATOM_SITE_AUTHOR_NAME', _RSSC_SITE_WEBMASTER);
//define('_RSSC_ATOM_SITE_AUTHOR_URI',  '管理者URL');
//define('_RSSC_ATOM_SITE_AUTHOR_EMAIL','管理者メール');
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
//define('_RSSC_ATOM_CONTRIBUTOR','貢献者');
//define('_RSSC_ATOM_AUTHOR_NAME', _RSSC_AUTHOR_NAME);
//define('_RSSC_ATOM_AUTHOR_URI',  _RSSC_AUTHOR_URI);
//define('_RSSC_ATOM_AUTHOR_EMAIL',_RSSC_AUTHOR_EMAIL);

// Dublin Core
//define('_RSSC_DC_TITLE',_RSSC_TITLE);
//define('_RSSC_DC_DESCRIPTION', _RSSC_DESCRIPTION); 
//define('_RSSC_DC_RIGHTS', _RSSC_RIGHTS);
//define('_RSSC_DC_PUBLISHER', '発行者');
//define('_RSSC_DC_CREATOR', '著者');
//define('_RSSC_DC_DATE', '作成日');
//define('_RSSC_DC_FORMAT', '形式');
//define('_RSSC_DC_RELATION', '関係');
//define('_RSSC_DC_IDENTIFIER', 'ID');
//define('_RSSC_DC_COVERAGE', '範囲');
//define('_RSSC_DC_AUDIENCE', '観客');
//define('_RSSC_DC_SUBJECT', '主題');
//define('_RSSC_CONTENT_ENCODED', _RSSC_CONTENT);

// link table item
define('_RSSC_LINK_ID','リンクID');
define('_RSSC_USER_ID','ユーザID');
define('_RSSC_MOD_ID', 'モジュールID');
define('_RSSC_LTYPE','タイプ');
define('_RSSC_REFRESH_INTERVAL','更新間隔');
define('_RSSC_HEADLINE_ORDER','ヘッドラインの並び順');
define('_RSSC_ENCODING','エンコード');
define('_RSSC_RDF_URL', 'RDF URL');
define('_RSSC_RSS_URL', 'RSS URL');
define('_RSSC_ATOM_URL','ATOM URL');
define('_RSSC_RSS_MODE','RSS モード');
define('_RSSC_RSS_MODE_NON',  '未使用');
define('_RSSC_RSS_MODE_RDF',  'RDF形式');
define('_RSSC_RSS_MODE_RSS',  'RSS形式');
define('_RSSC_RSS_MODE_ATOM', 'ATOM形式');
define('_RSSC_RSS_MODE_AUTO', '自動検出');

// feed table item
define('_RSSC_FEED_ID','Feed ID');
define('_RSSC_MODE_CONT','内容のモード');
define('_RSSC_RAWS','生データ');
define('_RSSC_SEARCH_FIELD','検索エリア');

// black table item
define('_RSSC_BLACK_ID','Black ID');
define('_RSSC_WHITE_ID','White ID');

// 2006-04-16 K.OHWADA
define('_RSSC_NO_HEADLINK','ヘッドライン・リンクが選択されていない');
define('_RSSC_NO_FEED','feedデータがない');

// === 2006-06-04 ===
// single link
define('_RSSC_SINGLE_LINK',  'リンク 単体表示');
define('_RSSC_SINGLE_LINK_UTF8', 'リンク 単体表示 UTF-8 形式');
//define('_RSSC_SINGLE_SUMMARY', '概要');
//define('_RSSC_SINGLE_CONTENT', '本文 HTMLタグ 許可');
//define('_RSSC_UTF8_SUMMARY', '概要 UTF-8 形式');
//define('_RSSC_UTF8_CONTENT', '本文 HTMLタグ 許可 UTF-8 形式');

// detect encoding
define('_RSSC_ASSUME_ENCODING', 'エンコードを自動的に検出できなかったので、<br />エンコードを %s と仮定した。<br />');

// rss item
//define('_RSSC_CREATED', '作成日');
//define('_RSSC_ATOM_CONTRIBUTOR_NAME', '貢献者');
//define('_RSSC_ATOM_CONTRIBUTOR_URI',  '貢献者URL');
//define('_RSSC_ATOM_CONTRIBUTOR_EMAIL','貢献者メール');

// === 2006-07-08 ===
// bread crumb
//define('_HOME', 'ホーム');

// podcast
define('_RSSC_PODCAST', 'ポッドキャスト');
//define('_RSSC_ENCLOSURE_URL',    '同封ファイル Url');
//define('_RSSC_ENCLOSURE_TYPE',   '同封ファイル Type');
//define('_RSSC_ENCLOSURE_LENGTH', '同封ファイル Length');

// === 2006-09-01 ===
// conflict with weblinks
//if( !defined('_SAVE') ) 
//{
//	define('_HOME', 'ホーム');
//	define('_SAVE', '保存');
//	define('_SAVED','保存した');
//	define('_EXECUTE', '実行');
//	define('_EXECUTED','実行した');
//	define('_CREATE', '生成');
//	define('_CREATED','生成した');
//}

// error message
define('_RSSC_DB_ERROR',           'RSSC DB エラー');
define('_RSSC_DISCOVER_SUCCEEDED', 'RSS の自動検出が成功した');
define('_RSSC_DISCOVER_FAILED',    'RSS の自動検出 (Auto Discovery) が出来なかった');
define('_RSSC_PARSE_MSG',     'RSS 解析メッセージ');
define('_RSSC_PARSE_FAILED',  'RSS の解析が出来なかった');
define('_RSSC_PARSE_NOT_READ_XML_URL',  'RSS 解析失敗: RSS URL が読み出せなかった');
define('_RSSC_PARSE_NOT_FIND_ENCODING', 'RSS 解析失敗: encoding の検出が出来なかった');
define('_RSSC_REFRESH_ERROR', 'RSS の更新エラー');
define('_RSSC_LINK_NOT_EXIST',  'RSSCモジュール内に対応するリンクが存在していない');
define('_RSSC_LINK_EXIST_MORE', '同じ"RDF/RSS/ATOM URL"を持つ複数のリンクが見つかりました');
define('_RSSC_LINK_ALREADY',    'この"RDF/RSS/ATOM URL"は登録済みです');

// for other module
define('_RSSC_RSSC_LID', 'RSSCモジュールのリンクID');
define('_RSSC_RSSC_LID_UPDATE', 'RSSCモジュールのリンクIDを変更する');
define('_RSSC_GOTO_RSSC_ADMIN_LINK', 'RSSCモジュールの管理画面へ');

// refresh link
define('_RSSC_REFRESH_LINK', 'feed 記事の更新');
define('_RSSC_REFRESH_LINK_DSC', '引き続いて、RDF/RSS/ATOM の feed 記事を更新します。<br />もし設定されていなければ、<br /> <b>RDF/RSS/ATOM URL</b> と <b>エンコード</b> を自動的に検出します。');
define('_RSSC_REFRESH_LINK_FINISHED', 'feed 記事を更新した');

// === 2007-06-01 ===
// word table
define('_RSSC_WORD_ID','Word ID');
define('_RSSC_WORD_WORD','禁止語');
define('_RSSC_WORD_POINT','点数');
define('_RSSC_ACT','状態');
define('_RSSC_ACT_NON','無効');
define('_RSSC_ACT_ACT','有効');
define('_RSSC_REG','URLの表現');
define('_RSSC_REG_NORMAL','通常');
define('_RSSC_REG_EXP','正規表現');
define('_RSSC_FREQ_COUNT','出現回数');

// feed table
define('_RSSC_FEED_ACT',     '表示状態');
define('_RSSC_FEED_ACT_NON', '非表示');
define('_RSSC_FEED_ACT_VIEW','表示');

// link table
define('_RSSC_LTYPE_NON','feed を取得しない');
define('_RSSC_LTYPE_SEARCH','検索サイト');
define('_RSSC_LTYPE_NORMAL','通常');

define('_RSSC_XML_URL','RDF/RSS/ATOM URL');

// === 2007-10-10 ===
// link table
define('_RSSC_LINK_ENCLOSURE','enclusure タグの扱い');
define('_RSSC_LINK_ENCLOSURE_NON','未使用');
define('_RSSC_LINK_ENCLOSURE_POD','PodCastと見なす');
define('_RSSC_LINK_CENSOR','タイトルの禁止用語');
define('_RSSC_LINK_PLUGIN','プラグイン');

// black & white table
define('_RSSC_BW_CACHE','feed カウントのキャッシュ');
define('_RSSC_BW_CTIME','feed カウントのキャッシュ時刻');

// keyword manage
define('_RSSC_KEYWORD','キーワード');

// === 2008-01-20 ===
// plugin list
define('_RSSC_PLUGIN_LIST', 'プラグイン一覧');
define('_RSSC_PLUGIN_NAME', 'プラグイン名');
define('_RSSC_PLUGIN_DESCRIPTION', '説明');
define('_RSSC_PLUGIN_USAGE', '使い方');

// link table
define('_RSSC_PRE_PLUGIN', '前処理プラグイン');
define('_RSSC_POST_PLUGIN','後処理プラグイン');

// === 2009-02-20 ===
// map
define('_RSSC_MAP','Googleマップ');

// link table
define('_RSSC_LINK_ICON',  'アイコン');
define('_RSSC_LINK_GICON_ID', 'Googleアイコン番号');

// feed table
define('_RSSC_FEED_GEO_LAT',  '緯度');
define('_RSSC_FEED_GEO_LONG', '経度');
define('_RSSC_FEED_MEDIA_CONTENT_URL',    'コンテントURL');
define('_RSSC_FEED_MEDIA_CONTENT_TYPE',   'コンテント・タイプ');
define('_RSSC_FEED_MEDIA_CONTENT_MEDIUM', 'コンテント・メディア');
define('_RSSC_FEED_MEDIA_CONTENT_WIDTH',  'コンテント横幅');
define('_RSSC_FEED_MEDIA_CONTENT_HEIGHT', 'コンテント高さ');
define('_RSSC_FEED_MEDIA_THUMBNAIL_URL',    'サムネイルURL');
define('_RSSC_FEED_MEDIA_THUMBNAIL_WIDTH',  'サムネイル横幅');
define('_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT', 'サムネイル高さ');

}
// --- define language end ---

?>