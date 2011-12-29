$Id: readme_ja.txt,v 1.1 2011/12/29 14:37:04 ohwada Exp $

=================================================
Version: 1.02
Date:   2009-05-17
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

● 変更内容
1. バグ対策
(1) ブロックにて、要約を表示をする件数設定が効かない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=947&forum=9

(2) blog ブロックにて、サイトタイトルが表示されない


=================================================
Version: 1.01
Date:   2009-03-22
=================================================

● 変更内容
1. バグ対策
(1) インストールできない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=934&forum=9


=================================================
Version: 1.00
Date:   2009-02-25
=================================================

● 変更内容
1. GeoRSS に対応した
http://georss.org/

2. MediaRSS に対応した
http://search.yahoo.com/mrss

3. GoogleMap に対応した
webmap モジュールが必要です。
メイン表示とブロック表示

4. リンク毎にアイコンを設定する

● テーブル構造
(1) link テーブル
下記の項目を追加した
icon, gicon_id

(2) feed テーブル
下記の項目を追加した
geo_lat, geo_long, 
media_content_url, media_content_type, media_content_medium, 
media_content_filesize, media_content_width, media_content_height,
media_thumbnail_url, media_thumbnail_width, media_thumbnail_height,


=================================================
Version: 0.91
Date:   2009-01-04
=================================================

● 変更内容
(1) typo
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=880&forum=9

(2) バージョン xx ではない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=894&forum=9


=================================================
Version: 0.90
Date:   2008-02-24
=================================================

● 変更内容
1. RSS の URL が255文字を超える場合に対応した

2. 言語ファイル
(1) アラビア語を新設した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=385&forum=5

3. バグ対策
(1) weblinks にて feed を表示するとき fatal error になる


● テーブル構造
(1) feed テーブル
属性を変更した
link : varchar(255) -> text


● 要求事項
(1) happy_linux モジュール 1.40 が必要です。


● アップデート
(1) rssc ディレクトリ以下のファイルを上書きする。

(2) XOOPS 管理画面より、rssc モジュールのアップデートをする。
onUpdate に対応しているので、rssc 独自のアップデート・スクリプトも同時に実行される。


=================================================
Version: 0.80
Date:   2008-01-30
=================================================

● 変更内容
1. JavaScript 関連の無効化の処理を強化した
(1) 管理者画面に「HTML出力設定」を追加した
script タグと style タグを削除するモードを追加した

2. プラグイン機能を強化した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=771&forum=9

2.1 仕様面
2.1.1 フックを４つ用意した
前処理 (RSSの読出しから、DBに格納するまで)
(1) 共通プラグイン
(2) リンク別プラグイン (v0.70と同じ)

後処理 (DBからの読出しから、HTML表示まで)
(3) リンク別プラグイン
(4) 共通プラグイン

2.1.2 プラグインの連結を可能にした
UNIX パイプのように指定する
-----
plugin_a | plugin_b | plugin_c
-----

2.1.3 プラグインへのパラメータ指定を可能にした
関数のパラメータのように指定する
-----
plugin_a ( param_a, param_b, param_c )
-----

2.2 実装面
2.2.1 プラグインを５つ用意した
(1) yahoo (v0.70と同じ)
(2) strip_tags (photosite さん提案)
(3) implode
(4) latest_feeds
(5) mail

2.2.2 管理者画面を２つ追加した
(1) カスタム・プラグイン
(2) プラグイン一覧 (プラグインのテストを含む)

2.2.3 デモを１つ用意した
(1) mailto.php : 最新のfeed記事を読み出し、ログインユーザにメールする

3. インストール処理の変更
http://linux.ohwada.jp/modules/newbb/viewforum.php?forum=8

4. テンプレート変数 xoops_module_heade の変更
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=772&forum=9

5. バグ変更
(1) 「RDF/RSS/ATOM の解析」にて XOOPS cache がクリアされることがある
(2) xml が保存されない


● テーブル構造
(1) link テーブル に下記の項目を追加した
  post_plugin

● 要求事項
(1) happy_linux モジュール 1.30 が必要です。

● アップデート
(1) rssc ディレクトリ以下のファイルを上書きする。

(2) XOOPS 管理画面より、rssc モジュールのアップデートをする。
onUpdate に対応しているので、rssc 独自のアップデート・スクリプトも同時に実行される。


=================================================
Version: 0.72
Date:   2008-01-18
=================================================

● 変更内容
1. 言語
(1) ドイツ語 追加
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=377&forum=5

(2) フランス語 更新
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=177&forum=5

2. バグ対策
(1) Only variables should be assigned by reference
(2) Fatal error in Weblinks
(3) 英語ファイルにて、２重定義


=================================================
Version: 0.71
Date:   2007-11-26
=================================================

● 変更内容
1. DBテーブル管理
config テーブルの検査などを追加した

2. バグ対策
(1) TEXT 型のカラムには DEFAULT 値は設定できない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=732&forum=5


=================================================
Version: 0.70
Date:   2007-11-11
=================================================

● 主な変更内容
1. RSS キャッシュ
(1) サーバーの負荷低減のため、ゲストモードのときだけ、キャッシュした。
(2) 管理者画面にキャッシュ・クリアを設けた。

2. onInstall onUpdate に対応した

3. メモリ使用量を表示した

4. ブロック表示にサイト名を表示する
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=685&forum=9

5. リンク毎に禁止語を設定する
朝日新聞 対策
広告記事が "AD:" というタイトルで入っているので、これを排除する

6. リンク毎に enclosure タグの扱いを設定する
Yahoo 対策
"photo.gif" というアイコンが enclosure に記載されているので、これを表示しない

7. リンク毎にプラグインを設定する
Yahoo 対策
link タグが下記の形式になっているので、
 http://xxx/123*http%3A//yyy/456
本来の形式に変換する
 http://yyy/456

8. 要約作成時に全て空白文字ならば空にする
9. モジュール管理を追加した
10. xoops block table の検査を追加した
11. データ・インポート用のクラスを新設した
12. black 登録時に、正規表現なら、任意の形式の url を登録を許す
13. PHP 5.2 対応： E_STRICT レベルのエラーを潰した

14. black 一覧における feed 記事の検索
(1) 下記の形式に一致するように、後方一致も行う
  http://xxx/*http://yyy/
(2) 検索時間の短縮のためキャシュを持たせた

15. 各国語
(1) イタリア語を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=337&forum=2

(2) フランス語を更新した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=177&forum=5

16. バグ対策
(1) MySQL 3.23 でモジュール・アップデートできない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=714&forum=9

(2) 禁止語一覧にて、チェックボックスが効かない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=726&forum=9

(3) weblinks モジュールからのデータ・インポートが出来ない
(4) UTF-8 単体表示 が fatal error になる
(5) 非表示にしても、ブロックに表示される


● テーブル構造
(1) link テーブルに下記の項目を追加した
enclosure censor
(2) black テーブルと white テーブルに下記の項目を追加した
cache ctime

● 要求事項
(1) happy_linux モジュール 1.20 が必要です。

● アップデート
(1) rssc ディレクトリ以下のファイルを上書きする。

(2) XOOPS 管理画面より、rssc モジュールのアップデートをする。
今回のバージョンより、onUpdate に対応したので、
rssc のアップデート・スクリプトも同時に実行される。
テンプレートを変更したので必ず実施のこと。


=================================================
Version: 0.61
Date:   2007-08-05
=================================================

● 主な変更内容
1. MySQL 4.1/5.x の対応
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=9&topic_id=631
日本語では、MySQL の文字コードは ujis (EUC-JP) に固定にしていた。
管理者が happy_linux/preload/charset.php を設置して、任意の文字コードが指定できるように変更した。

2. HTML スタイル
(1) W3C 準拠に変更した
主なページは W3C Markup Validator のチェックを通した
http://validator.w3.org/

(2) xoops module header
xoops module header を使用して、header タグ内に スタイルシートを表示した

3. 4650: 簡易ヘッドラインにサイトの説明を追加した
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4650&group_id=1300&atid=1356

4. バグ対策
(1) rssc0.sql が rssc.sql と同じ
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=650

(2) RSS配信の content:encoded がエラーになる
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=8&topic_id=661


=================================================
Version: 0.60
Date:   2007-06-09
=================================================

● 主な変更内容
1. 4510: not view option
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4510&group_id=1300&atid=1356
feed 記事の表示/非表示を追加した

2. 4570: divid to execute RSS feeds update in command line
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4570&group_id=1300&atid=1356

コマンドラインに分割実行するオプションを追加した
オプションは下記の形式です
-----
php -q -f XOOPS/modules/rssc/bin/refresh.php  pass
php -q -f XOOPS/modules/rssc/bin/refresh.php -pass=pass [ -limit=0 -offset=0 ]
-----

3. 4577: content spam filter
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4577&group_id=1300&atid=1356

コンテンツ・フィルタを追加した
(1) 禁止語リスト (word テーブル) を追加した
(2) 禁止語リストの合計得点が判定レベルを超えると、ブラックと判定する
(3) ブラックと判定されたとき、下記の動作を行う
(3-1) feed 記事を保存しない
(3-2) 該当した単語の出現回数をカウントアップする
(3-3) URLをブラックリストに追加登録する
(3-4) コンテンツに含まれる単語を抽出して、禁止語リストに追加登録する
(3-5) ログファイルに記録する

4. 4582: show next page
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4582&group_id=1300&atid=1356
ページ送りを追加した

5. 処理性能の向上
link テーブルから 通常の表示に不要な xmlデータ部 を分離した。
xml データ部を格納するため xml テーブルを新設した。

6. MySQL 4.1 対応
取得した RSS の xml データを 格納するときに、urlencode した
4.1以降では異なる文字コードは格納できなくなったようだ。

7. 管理者画面にブロック管理を追加した
(1) XOOPS のメジャー・バージョンによる違いの吸収
XOOPS 2.0 / 2.1 / 2.2 に対応したメニューを表示する
バージョン判定を自動的に行い、10秒後の自動的にページを移動する

(2) GIJOE さんの myblocksadmin を採用した
xoops 2.0 系で有効です。

8. 管理者画面の「リンクの修正」に下記の情報を追加した
- ユーザ名
- 投稿元のモジュール名
- 更新日の西暦表示
- channel の詳細情報
- xml の詳細情報

9. 管理者画面の「キーワード追加」の変更
(1) ブログ検索サイトに google と yahoo を追加した
(2) 最近 調子が悪いので bulkfeeds を外した
(3) 英語版 google を追加した

10. 多言語
(1) 日本語 UTF-8 ファイルを追加した

11. バグ対策
(1) 「アーカイブのクリア」にて、レコード数と制限値と同じだと、全て削除となっていた


● テーブル構造
(1) xml テーブル と word テーブルを新設した
(2) black テーブルと white テーブルに下記の項目を追加した
  act reg count
(3) feed テーブルに下記の項目を追加した
  act


● 要求事項
(1) happy_linux モジュール 0.90 が必要です。

(2) 単語の抽出には、kakasi が必要です。
kakasi の使えない環境では、空白や英数字以外の文字を区切りにして、単語に分割します。
http://kakasi.namazu.org/


● アップデート
(1) テンプレートを変更したので、下記を実施のこと。
XOOPS管理画面より、rssc モジュールのアップデートをする。


=================================================
Version: 0.51
Date:   2007-05-20
=================================================

● 主な変更内容
バグ修正
(1) RSS feed の更新にて、管理者画面が表示されない
(2) happy_linux v0.8 との組み合わせにて、RDF/RSS/ATOM の表示が出来きない
(3) xoops.org XOOPS 2.0.16: モジュール名が表示されない

● アップデート
(1) テンプレートを変更したので、下記を実施のこと。
XOOPS管理画面より、rssc モジュールのアップデートをする。
(2) happy_linux モジュール 0.80 が必要です。


=================================================
Version: 0.50
Date:   2006-11-08
=================================================

● 主な変更内容
(1) 4319: プロキシ・サーバーに対応した
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4319&group_id=1300&atid=1356
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=233&forum=5

(2) 4360: single link の表示件数などのオプションを追加した
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4360&group_id=1300&atid=1356
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=247&forum=5

(3) キーワードのハイライトの有効/無効のオプションを追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=226&forum=5

(4) ブロックのテンプレート変数に fid を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=225&forum=5

(5) テンプレートに wordwrap 修飾を追加した


● アップデート
(1) テンプレートを変更したので、下記を実施のこと。
XOOPS管理画面より、rssc モジュールのアップデートをする。
(2) happy_linux モジュール 0.40 が必要です。


=================================================
Version: 0.40
Date:   2006-09-10
=================================================

● 主な変更内容
(1) happy_linux モジュール
RDF/RSS/ATOM 生成 のクラス関数を移動した

(2) weblink モジュール
weblink との統合に備えて、一部変更した。

(3) RSS解析
(3-1) link タグのない RSS に対応した
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4146&group_id=1300&atid=1356

(3-2) enclosure タグが複数ある RSS に対応した

(3-3) URL形式ではない guid タグを持つ RSS に対応した
rssc_headline モジュール用

(4) 検索
(4-1) Amethyst Blue にて配布している検索モジュールに対応して、検索結果に本文を表示した
http://www.suin.jp/

(4-2) 検索結果のキーワードをハイライト表示した

(4-3) ゆらぎ検索 を追加した（日本語のみ）
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=503&forum=9

Amethyst Blue にて配布している検索モジュールを参考にした
- 半角英数のとき 全角英数も検索対象にする
- 全角英数のとき 半角英数も検索対象にする
- 半角カタカナのとき 全角カタカナと全角ひらがなも検索対象にする
- 全角カタカナのとき 半角カタカナと全角ひらがなも検索対象にする
- 全角ひらがなのとき 半角カタカナと全角ひらがなも検索対象にする

(5) ページタイトル を追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=494&forum=9

(6) 本文をHTML表示する/しないのオプションを追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=199&forum=5

(7) ブログ表示のブロックを追加した

(8) config テーブルに conf_valuetype 項目を追加した

(9) スタイルシートを採用した

(10) 管理者画面
(10-1) テーブルの管理画面にて、「パンくず」を表示した
(10-2) テーブルの管理画面にて、パラメータの検査を強化した
(10-3) リンクの登録・変更画面にて、RSSが解析出来ないときは、その旨を表示した
(10-4) RSS URL の重複の検査を追加した

(11) セッションチケット・クラス (XoopsGTicket) を採用した
Peak にて配布している Tinyd から流用した

(12) バグ対策
(12-1)「このリンクに属するfeedを表示する」が常に「RSSC」ディレクトリになる
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4145&group_id=1300&atid=1353

(12-2) パースできないときに、Fatal error になる

(12-3) 検索結果のリンク先がない


=================================================
Version: 0.30
Date:   2006-07-10
================================================

● 主な変更内容
(1) happy_linux モジュール
weblink との統合に備えて、共通の処理を happy_linux モジュールとして独立した。
このRSSセンター・モジュールを使用するには、happy_linux モジュールが必要となります。

(2) rssc_headline モジュール
rssc_headline モジュールとの連携機能を追加した
rssc_headline は xoopsheadline をベースに、
RSSの管理機能を RSSCモジュールを利用するように改版したものです。

(3) podcast に対応した
RSS feed に enclosure タグがあると、podcast と見なし、そのリンクを表示する

(4) 同じリンクがあるかのチェック
リンクの登録時に、同じ「RDF/RSS/ATOM URL」を持つリンクがあるかチェックを追加した
リンクの変更画面で、同じ「RDF/RSS/ATOM URL」を持つリンクが複数あるときは、その旨を表示した

(5) パンくずを表示した
(6) メインに説明文を追加した
(7) コマンドライン(bin_refresh) の初期値を変更した 
(8) RSS の image タグを link テーブル に保存した
(9 feed 管理で pagenavi が効かないバグを修正した

内部構造を大きく変更した
(1) feed テーブルに podcast用の項目を追加した

● 要求事項
happy_linux モジュールが必要です。

● 注意
ほぼ全てのファイルを変更しています。
大きな問題はないはずですが、小さな問題はあると思います。
バグ報告やバグ解決などは歓迎します。

● TODO
(1) weblinksモジュールと連携する
(2) ブラックリストを共有する仕組みを作る
(3) 検索結果のブロックを追加する
(4) 管理画面にヘッドラインの一覧が追加する


=================================================
Version: 0.20
Date:   2006-06-08
=================================================

● 主な変更内容
１．ユーザー向けの機能
(1) 単体リンク表示 (single_link) を追加した
(2) 単体リンク UTF-8 表示 (single_link_utf8) を追加した
(3) HTMLタグ許可のとき、javascript の検査を強化した
(4) RSS表示にて、管理者のとき、debug モード を表示していたが、通常の表示モード に変更した。
debug モードの表示を管理者画面に移動した

(5) ブロック表示のテンプレート用に site_tile と site_link をアサインした
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=432&forum=9

２．管理者向けの機能
(1) feed の登録を廃止した
(2) RSSの debug モードの生成・表示を追加した
(3) リンクを登録・編集した後に、RSSを更新するようにした

(4) エンコードが自動検出できなかったときに、デフォルト値として UTF-8 を設定した
BUG 3875: 
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3875&group_id=1300&atid=1353
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=145&forum=5

(5) single_link と single_feed へのリンク用にアイコンを表示した
(6) コマンド実行時のオーバーヘッドを削減した
DB操作を直接行い、XOOPS コア・ファイルを使用しないようにした

３．実装面、内部構造
(1) RSSパーサーに magpie を採用した
パーサーの選択を廃止し、magpie のみにした
管理者画面のRSS解析にて 表示する項目を増やした

(2) RSS 解析後のデータをオブジェクト・クラス化した
(3) channel と rows の保存形式を serialize 関数に変更した

４．PHP 5 対応
(1) 下記の notice を修正した
Only variable references should be returned by reference

５．言語対応
(1) フランス語を追加
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=177&forum=5

６．バグ修正
(1) BUG 3622: cannot modify blacklist
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3622&group_id=1300&atid=1353

(2) BUG 3864: suppress Notice Undefined offset: 0
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3864&group_id=1300&atid=1353

● 注意
ほぼ全てのファイルを変更しています。
大きな問題はないはずですが、小さな問題はあると思います。
バグ報告やバグ解決などは歓迎します。

● TODO
(1) 他のモジュールと連携するサンプルを作る
(2) ブラックリストを共有する仕組みを作る
(3) 検索結果のブロックを追加する
(4) 管理画面にヘッドラインの一覧が追加する


=================================================
Version: 0.11
Date:   2006-01-21
=================================================

* 主な変更内容 *
(1) ブロック名にモジュールの識別番号を追加した
(2) レコードの一覧にID逆順を追加した
(3) レコードの更新方法を変更した
(4) menu.php のリンク切れを修正した

=================================================
Version: 0.10
Date:   2006-01-01
=================================================

● モジュール概要
このモジュールは、 登録されたサイトを巡回し、RDF/RSS/ATOM 記事を収集し、データベースに格納する。
格納されたデータは検索が可能であり、検索結果をRDF/RSS/ATOM形式で出力することも可能である。

このモジュールは、 WebLinks の RDF/RSS/ATOM 記事収集機能を独立し、機能拡張したものである。
RDF/RSS/ATOM 収集のプラットホームとなる方向を目指している。
応用例としては、ヘッドライン・モジュール や 未来検索 http://sf.livedoor.com/ を想定している。

現在、ベータ版です。
今後、大幅に仕様や実装が変わる可能性があります。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
仕様や応用例の提案、またはバグ報告やバグ解決やハックなどは歓迎します。


● 機能概要
１．サイト登録
サイト名、サイトURL、RDF/RSS/ATOM のURL、キャッシュ時間などを入力する。

２．「RDF/RSS/ATOM Auto Discovery」
サイトが「RDF/RSS/ATOM Auto Discovery」に対応してるときは、
サイトのURLを登録すると、RDF/RSS/ATOM のURL を自動検出し登録される。

３．ブラックリスト登録
未来検索などのブログ検索サイトを登録すると、好ましくない記事が収集されることがある。
好ましくない記事のURLをブラックリストに登録すると、以降の収集は停止される。
なお「好ましくない記事」は人により異なる。

４．RDF/RSS/ATOM記事の取得
どういう契機でRSS/ATOM記事を取得するか。
３つの方法を用意しています。

４．１ 誰かが WEBブラウザでアクセスしたときに、取得する
誰かが簡易ヘッドラインのページやブロックにアクセスしたときに実行されます。
巡回するサイトは簡易ヘッドラインに表示しているサイトだけです。
表示するサイトが多いと、タイムアウトする可能性があります。

４．２ 管理者が手動で取得する
管理者画面にアーカイブ更新があります。

４．３ コマンドラインモードで、自動的に取得する。
「コマンドラインの設定」を参照ください。

５．RDF/RSS/ATOM記事のXML解析
５．１ 文字コード
任意の文字コードに対応している。
ただし、XMLデータに文字コードの指定がないか、
PHPのマルチバイト関数が対応していない文字コードでは、文字化けすることがある。
また、日本語版では、ドイツ語やフランス語のウムラウトなどは文字化けすることがある。
なお、PHPのXMLパーサー関数は US-ASCII あるいは UTF-8 しか使用できないため、
EUC-JPなどはUTF-8に変換してから、解析している。

５．２ パーサーの選択
XMLデータの形式に応じて、RDF/RSS/ATOMのパーサーを自動的に選択する。
さらに、パーサーは複数 用意され、好きなものが選択できる。
XOOPSコアのRSSパーサーと、RSSCモジュール独自のパーサーが用意されている。
後者の方がパースできる項目が多い。

６．RDF/RSS/ATOM記事の表示
(1) HTMLタグの有効・無効
タイトルや本文にHTMLタグの使用をするか/しないかが選択できる。
使用する場合でも、JavaScript が含まれていると、サニタイズされ無効になる。

７．不備なRDF/RSS/ATOM記事の処理
(1) タイトルなし
タイトルがないものは、「---」を表示する。

(2) 日付なし
日付がないものは、常に最下位に表示される。
DBに格納するときに、現在の時刻を設定する。

(3) 未来の日付
未来の日付になっていると、常に上位に表示される。
表示するときに、３日以上未来のものを省いている。

８．サーバー環境
(1) PHP環境変数 allow_url_fopen off に対応した。

９．データの移行
９．１ XoopsHeadline モジュール
XoopsHeadline モジュール からヘッドライン・テーブルの過去のデータを移行できる。

９．１ WebLinks モジュール
WebLinks モジュールから、リンク・テーブル、フィード・テーブル、ブラックリストなどの過去のデータを移行できる。
現時点では、WebLinksとの連携機能がないので、
WebLinks側でも継続してRDF/RSS/ATOM記事を収集する必要がある。

１０．モジュール複製
コピーするだけでモジュールが複製できます。
TinyD モジュールなどで実装されているものと同じ機能です。
用意されているモジュール名は "rssc" と "rssc0" の２つです。
それ以外の場合は、sql と templates と images ディレクトリに必要なファイルを作成してください。


● インストール
(1) 解凍すると、「rssc」というディレクトリが出来る。
(2) XOOPS管理画面にて、モジュールのインストールをする。
(3) RSSCアイコンをクリックし、RSSCモジュールの管理者画面にする。
(4) 一番最初はいくつか警告が出る。
  (i) 設定テーブルが初期化されていない
     「保存」をクリックして、初期化する。
  (ii) cacheデイレクトリの書込み許可がない
      rssc/cache デイレクトリに書込み許可を与える
(5)「リンク一覧」にて「xoops.org」が登録されていることを確認する。
(6)「アーカイブ管理」にて「アーカイブの更新」を実行する
(7)「モジュールへ」をクリックし、RSSCモジュールのトップページを表示する。
(8) 最新のfeed記事が表示されれば、OK。
(9) 必要に応じて、 XoopsHeadline モジュールやWebLinks モジュールからデータを移行する。

● コマンドラインの設定
コマンドラインは、cron から定期的に実行することを想定しています。
不要であれば、bin ディレクトリを削除してください。

(1) 管理者画面にする
(2)「コマンド管理」にて「設定ファイルの生成」を実行する。
(3)「bin/refresh.php のテスト実行」を実行する。

(4) crontab に下記のような設定を加える。
-----
22 3 * * * /usr/bin/php4 -q -f /home/***/html/modules/rssc/bin/refresh.php password
-----
password は、「モジュール設定」画面の「コマンド設定」「パスワード 」に表示されている。


● TODO
(1) パーサーに magpieRSS と PEAR RSS を追加する。
(2) ブラックリストを共有する仕組みを作る
(3) 他のモジュールと連携するサンプルを作る
(4) 検索結果のブロックを追加する
(5) ヘッドラインにHTMLありを表示する
(6) 管理画面にヘッドラインの一覧が追加する

