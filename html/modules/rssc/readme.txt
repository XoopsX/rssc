$Id: readme.txt,v 1.1 2011/12/29 14:37:04 ohwada Exp $

=================================================
Version: 1.02
Date:   2009-05-17
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
1. bug fix
(1) not valid "Maximum number of RSS/ATOM feeds displayed content" in block
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=947&forum=9

(2) not show site title in blog block


=================================================
Version: 1.01
Date:   2009-03-22
=================================================

* Changes *
1. bug fix
(1) cannot install
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=934&forum=9


=================================================
Version: 1.00
Date:   2009-02-25
=================================================

* Changes *
1. Supoort GeoRSS
http://georss.org/

2. Supoort MediaRSS
http://search.yahoo.com/mrss

3. Supoort GoogleMap 
require webmap module.
show in main and block

4. Set the icon each link

œ DB table structure
(1) link table
add following fields
icon, gicon_id

(2) feed table
add following fields
geo_lat, geo_long, 
media_content_url, media_content_type, media_content_medium, 
media_content_filesize, media_content_width, media_content_height,
media_thumbnail_url, media_thumbnail_width, media_thumbnail_height,


=================================================
Version: 0.91
Date:   2009-01-04
=================================================

* Changes *
(1) typo
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=880&forum=9

(2) "Not version xx"
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=894&forum=9


=================================================
Version: 0.90
Date:   2008-02-24
=================================================

* Changes *
1. supported the URL of RSS exceeded 255 characters.

2. lang pack
(1) added new Arabic
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=385&forum=5

3. bug fix
(1) fatal error when showing feed in weblinks


* DB table structure *
(1) modify field in feed table
link : varchar(255) -> text


* requirement *
(1) happy_linux module 1.40 is required.


* Update *
(1) Overwrite the files below rssc directory. 

(2) Update rssc module in XOOPS management. 
the rssc's update script is executed at the same time.


=================================================
Version: 0.80
Date:   2008-01-30
=================================================

* Changes *
1. strengthened to invalid JavaScript
(1) added "HTML Output Setting" in admin page
added option to remove script tag and style tag

2. strengthened plugin feature
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=771&forum=9

2.1 specificatio
2.1.1 prepared 4 hook
pre-process (from read RSS to save DB)
(1) common hook
(2) hook for each link (same in v0.70)

post-process (from read DB to output HTML)
(3) hook for each link
(4) common hook

2.1.2 added feature plugin combination 
specify like as UNIX pipe
-----
plugin_a | plugin_b | plugin_c
-----

2.1.3 added feature parameter into plugin
specify like as PHP function
-----
plugin_a ( param_a, param_b, param_c )
-----

2.2 implement
2.2.1 prepared 5 plugins
(1) yahoo (same in v0.70)
(2) strip_tags (thanks photosite)
(3) implode
(4) latest_feeds
(5) mail

2.2.2 added 2 menu in admin page
(1) Custom Plugins
(2) Plugin List (include plugin test)

2.2.3 added 1 demo program
(1) mailto.php : get leatest feeds, and send mail to login user

3. changed install script
http://linux.ohwada.jp/modules/newbb/viewforum.php?forum=8

4. changed template variable xoops_module_heade
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=772&forum=9

5. bug fix
(1) in "Parse RDF/RSS/ATOM" clear XOOPS cache
(2) not save xml


* DB table structure *
(1) add field in link table
  post_plugin

* requirement *
(1) happy_linux module 1.30 is required.

* Update *
(1) Overwrite the files below rssc directory. 

(2) Update rssc module in XOOPS management. 
the rssc's update script is executed at the same time.


=================================================
Version: 0.72
Date:   2008-01-18
=================================================

* Changes *
1. langugae
(1) added German.
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=377&forum=5

(2) updated French.
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=177&forum=5

2. bug fix
(1) Only variables should be assigned by reference
(2) Fatal error in Weblinks
(3) double definition in English admin.php


=================================================
Version: 0.71
Date:   2007-11-26
Author: Kenichi OHWADA
URL:    http://linux2.ohwada.net/
Email:  webmaster@ohwada.net
=================================================

* Changes *
1. DB Table Management
added to check config table, other tables

2. bug fix
(1) TEXT columns cannot have DEFAULT values
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=732&forum=5


=================================================
Version: 0.70
Date:   2007-11-11
=================================================

* Changes *
1. RSS cache
(1) has the RSS cache in anoymous user mode, to reduce the server load.
(2) clear the cache in the admin page.

2. supported onInstall onUpdate

3. show memory usage

4. show site tilte in block
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=685&forum=9

5. set to handle enclosure tag in every link.
becuase the title include "AD:" for the advertisement, it removes this.

6. set words to censor in every link
because entered the icon in enclosure tag, it doesn't show this.

7. set plugin in every link
because the following form in link tag, 
  http://xxx/123*http%3A//yyy/456.
it changes into the original form
 http://yyy/456

8. replace empty if all space code when build summary
9. added module management
10. added to check xoops block table
11. added new class for import other module
12. allow optional url form if a regular expression when add black list
13. defeat errors in PHP5 E_STRICT level

14. search feeds for black list
(1) support the following link form
  http://xxx/*http://yyy/
(2) has cache for reducee search time

15. language
(1) added Italian lang pack
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=337&forum=2

(2) updated French lang pack
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=177&forum=5

16. bugfix
(1) in MySQL 3.23, cannot update module
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=714&forum=9

(2) dont work checkbox in "Reject Word List"
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=726&forum=9

(3) cannot import from weblinks module
(4) fatal error in single link UTF-8
(5) show in block if set not-show

* DB table structure *
(1) add field in link table
enclosure censor

* requirement *
(1) happy_linux module 1.20 is required.

* Update *
(1) Overwrite the files below rssc directory. 

(2) Update rssc module in XOOPS management. 
the rssc's update script is executed at the same time,
because rssc supported onUpdate since this version 0.70 . 
You MUST do it, since the template files are changed. 


=================================================
Version: 0.61
Date:   2007-08-01
=================================================

* Changes *
1. Supported MySQL 4.1/5.x
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=9&topic_id=631
For exsample in Japanese, program fixed ujis (EUC-JP) in character code of MySQL.
Administrator can change character code, setting happy_linux/preload/charset.php.

2. HTML style
(1) base on W3C
checked mainly pages on W3C Markup Validator
http://validator.w3.org/

(2) xoops module header
added to show style sheet in header tag using xoops module header

3. 4650: site description in the headline
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4650&group_id=1300&atid=1356

4. Bug fix
(1) rssc0.sql is same as rssc.sql
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=650

(2) content:encoded error in RSS
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=8&topic_id=661


=================================================
Version: 0.60
Date:   2007-06-09
=================================================

* main changes *
1. 4510: not view option
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4510&group_id=1300&atid=1356

2. 4570: divid to execute RSS feeds update in command line
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4570&group_id=1300&atid=1356

add command line option
usage is following
-----
php -q -f XOOPS/modules/rssc/bin/refresh.php  pass
php -q -f XOOPS/modules/rssc/bin/refresh.php -pass=pass [ -limit=0 -offset=0 ]
-----

3. 4577: content spam filter
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4577&group_id=1300&atid=1356

(1) add reject word list (word table)
(2) judge black when total point of word list exceed reject level
(3) do the following operation when judge black
(3-1) not store feed in database
(3-2) count up the matching record when match with reject word list
(3-3) add URL in black list
(3-4) extract words in the content, and add words in reject word list
(3-5) write in log file

4. 4582: show next page
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4582&group_id=1300&atid=1356

5. performance improvement
separate xml part which is unnecessary for usual display from link table.
add xml table for storeing xml part.

6. support MySQL 4.1
urlencode xml data as RSS feed, when storing in databese
since v4.1, it seems that MySQL can not store different character code

7. add block manage in admin page
(1) absorption of the difference by Major version of XOOPS
show menu to support 2.0 / 2.1 / 2.2.
judge version automatically, and reload page 10 seconds later automatically .

(2) adopt GIJOE's myblocksadmin
valid in xoops 2.0

8. add following informations in "Modify Link" in admin page
- user name
- submitter's module name
- formated date of updated
- detail of channel
- detail of xml

9. change "Add Keyword" in admin page
(1) add google for blog search site in English
(2) add google and yahoo in Japanese

10. multi language
(1) add Japanese UTF-8 files

11. bug fix
(1) in "clear archive", clear all records, if the numbers of records is same as the limit value.


* DB table structure *
(1) add xml table and word table
(2) add following fields in black table and white table
  act reg count
(3) add act field in feed table


* requirement *
(1) happy_linux module 0.90 is required.

(2) kakasi is required, when extracting words in Japanese.
extracting words by space or symbol, when NOT using kakasi
http://kakasi.namazu.org/


* update *
(1) MUST execute following, because change templates
Update rssc module in XOOPS management. 



=================================================
Version: 0.51
Date:   2007-05-20
=================================================

* main changes *
bug fix
(1) NOT show admin's frame in updating RSS feed
(2) NOT show RDF/RSS/ATOM with happy_linux v0.8
(3) NOT show module name in xoops.org XOOPS 2.0.16

* update *
(1) MUST execute following, because change templates
Update rssc module in XOOPS management. 
(2) happy_linux module 0.80 is required.


=================================================
Version: 0.50
Date:   2006-11-08
=================================================

* main changes *
(1) 4319: get rss feeds via proxy
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4319&group_id=1300&atid=1356
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=233&forum=5

(2) 4360: chang number of feeds in single_link
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4360&group_id=1300&atid=1356
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=247&forum=5

(3) added option which turn on/off keyword highlight
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=226&forum=5

(4) assigned fid into block template
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=225&forum=5

(5) added wordwrap modifier into template


* update *
(1) MUST execute following, because change templates
Update rssc module in XOOPS management. 
(2) happy_linux module 0.40 is indispensabe necessary.


=================================================
Version: 0.40
Date:   2006-09-10
=================================================

* main changes *
(1) happy_linux module
moved class function of RDF/RSS/ATOM genaretion into happy_linux module

(2) weblinks module
changed some, becuase prepares for the integration with weblinks module,

(3) RSS parse
(3-1) supported RSS without link tag
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4146&group_id=1300&atid=1356

(3-2) supported RSS which has twe or more enclosure tag

(3-2) supported RSS which has guid tag with non URL format.
for rssc_headline

(4) search
(4-1) show context in search result, 
corresponding to search module to be distributing in Amethyst Blue
http://www.suin.jp/

(4-2) highlight keywords in search result

(4-3) added fuzzy search (Japanese only)
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=503&forum=9

(5) added page title
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=494&forum=9

(6) added option to show content with html or not
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=199&forum=5

(7) add "show blog" block

(8) added conf_valuetype field into config table

(9) supported stylesheet

(10) admin page
(10-1) show bread crumb in table manage.
(10-2) strengthened to ckeck parameter in table manage.
(10-3) show error message, if cannot parse RSS feed, when add new link.
(10-4) added to check overlapping RSS URL

(11) used session ticket class (XoopsGTicket)
reffer Perk's Tinyd module

(12) bug fixed
(12-1) 'blong link' jump always 'rssc' directory
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4145&group_id=1300&atid=1353

(12-2) Fatal error occured when can not parse RSS

(12-3) link of search result was not found


=================================================
Version: 0.30
Date:   2006-07-10
=================================================

* main changes *
(1) happy_linux module
happy_linux module was created as the common function,
ane independent from this RSS Center module.
Becuase prepares for the integration with weblinks module,
happy_linux module is necessary, to use this RSS center module. 

(2) rssc_headline module.
added cooperation feature with rssc_headline module.
rssc_headline is based on xoopsheadline,
modify to use RSS management function of RSSC module.

(3) supported podcast.
When there are enclosure tag in RSS feed, 
assume as podcast and display the link of podcast.

(4) added check to exist same link
check to exist link which has same RDF/RSS/ATOM URL, when admin will add new link.
show message which there are twe or more links which has same RDF/RSS/ATOM URL, 
when admin will modify link.

(5) displayed bread crumb.
(6) added an description in main page.
(7) changed the default value of command line (bin_refresh).
(8) saved image tag of RSS feed into link table.
(9) corrected the bug which pagenavi doesn't work in feed management.

It changed an innards roughly.
(1) added fileds for podcast into feed table.


* requirement *
happy_linux module is necessary.


* Notice *
I change almost all files. 
Although there are no big problem, but I think that there are any small problem. 
Welcome a bug report, a bug solution, and your hack, etc.


* TODO *
(1) Make the function which cooperates with weblinks module.
(2) Make the structure which shares a blacklist. 
(3) Add search result block
(4) Add the list of headlines link in admin page.


=================================================
Version: 0.20
Date:   2006-06-08
=================================================

* main changes *
1. Function for users 
(1) added single link view (single_link). 
(2) added single link view with UTF-8 encoding (single_link_utf8). 
(3) strengthened inspection of javascript at permission HTML tags. 
(4) changed from the debug mode to the usual mode, when an administrator views builded RSS.

(5) assigned site_tile and site_link for block templates.
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=432&forum=9

2. Function for Administrators 
(1) abolished "feed registration". 
(2) added viewing builded RSS in debug mode. 
(3) added updating RSS feeds after registering and editing a link record. 

(4) assumed UTF-8 into default encoding, if cannot detect the encoding automatically.
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3875&group_id=1300&atid=1353
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=145&forum=5

(5) added icon which be view single link or single feed. 
(6) cut down the overhead in executing command line. 
handling DB directly, not to use XOOPS core files.

3. Implementation and internal structure 
(1) adopted "magpie RSS" for RSS parser. 
abolished selection of parsers, only use magpie RSS.
added some items to parse and view RSS in admin page.

(2) used object class after parsing RSS feeds. 
(3) changed to "serialize" function for saving channel and rows. 

4. PHP 5
(1) corrected following notices. 
Only variable references should be returned by reference

5. Language pack
(1)  Add French. 
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=177&forum=5

6. Bug fixed
(1) BUG 3622: cannot modify blacklist
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3622&group_id=1300&atid=1353

(2) BUG 3864: suppress Notice Undefined offset: 0
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3864&group_id=1300&atid=1353


* Notice *
I change almost all files. 
Although there are no big problem, but I think that there are any small problem. 
Welcome a bug report, a bug solution, and your hack, etc.


* TODO *
(1) Make the sample which cooperates with other modules.
(2) Make the structure which shares a blacklist. 
(3) Add search result block
(4) Add the list of headlines link in admin page.


=================================================
Version: 0.11
Date:   2006-01-21
=================================================

* changes *
(1) add module number to block name
(2) add descent id order to record list
(3) change method to update record
(4) correct broken link of menu.php

=================================================
Version: 0.10
Date:   2006-01-01
=================================================

* Module Outline *
This module collects RDF/RSS/ATOM feeds from the registered sites, and stores in a database.
This module searchs feeds in database, and carries out the search results in RDF/RSS/ATOM form.

This module becomes independent from the RDF/RSS/ATOM function of WebLinks module,
and enhances more powerful.

This module aims the platform of RDF/RSS/ATOM feeds.
As an example of application, like a headline module, like the Web Service http://sf.livedoor.com/.

Now, it is the beta version. 
From now on, the specification and implementation may change sharply. 
Even if some problems come out, only those who can do somehow personally need to use. 
Welcome the proposal of specification or the example of application, a bug report, a bug solution, and your hack, etc.


* Main Function * 
1. Site Registration 
Enter A site name, site URL, URL of RDF/RSS/ATOM, cash time, etc.

2. RDF/RSS/ATOM Auto Discovery 
If a site corresponds to "RDF/RSS/ATOM Auto Discovery",
when you register the URL of a site,
this module will detect automatically the URL of RDF/RSS/ATOM, and register it. 

3. Blacklist 
If you register Blog Search Sites, such as http://sf.livedoor.com/,
this module may collect feeds which you dont desire. 
If you register the URL of undesirable site into a blacklist, 
this module will stop to collect feeds from this site.

4. How to collect RDF/RSS/ATOM feeds
This module supports three methods. 

4.1 Someone accesses by WEB browser. 
When someone accesses a simple headline page or block.
this module collects automatically RDF/RSS/ATOM feeds.
This module collects feeds form the only sites to show in the simple headline. 
A timeout may be carried out, if there are many sites to show in the simple headline. 

4.2  An administrator collects manually. 
This module supports "archive management" in admin page. 

4.3  Automatically in the command line mode. 
Look "setup of a command line".

5. XML Parser of RDF/RSS/ATOM feed
5.1  Character Code 
This module can correspond to many character codes. 
However, if there is no specification of a character code in XML format,
or XML use character code which PHP multi-byte function does not support,
this module may not parse it correctly.
Since PHP XML parser function support only US-ASCII or UTF-8,
this module converts another character code to UTF-8, and parses it.

5.2  Parser Selection 
According to XML form as RDF or RSS or ATOM,
this module will select XML parser automatically. 
Furthermore, this module support two or more parser,
you can select a favorite parser.
this module support the XOOPS core's RSS parser and this module's original parser.
The original parser can parse many items than XOOPS parser.

6. Show of RDF/RSS/ATOM feeds
(1) allow to use HTML tags, or not
You can choice to use HTML tags, or not, in Title and Content.
If you choise use HTML tags and Content contains Java Script, 
this module may sanitaize JS, and JS will become invalid. 

7. Processing of a deficient RDF/RSS/ATOM feeds 
(1) no title
If feed have no tile,
this module substituted by "---", and show it

(2) no date
If feed have no date, this feed may be shown always in the tail end.
This module substitute by present time, and store it to database.

(3) future date
If feed have future date, this feed may be shown  always in top line.
This module show feeds except more than 3 days future.

8. Server environment 
(1) This module corresponds to PHP allow_url_fopen is off. 

9. Import from other Module 
9.1 XoopsHeadline Module
This module can import the data from XoopsHeadline Module,
such as headline table. 

9.2 WebLinks Module
This module can import the data from WebLinks Module,
such as link table, feed table, and blacklist. 
A present, there is no cooperation function with RSSC and WebLinks.
You MUST continue to use WebLinks RSS/ATOM function.

10. Module Duplicate 
This module can be duplicated only by copying. 
It is the same function as TinyD module, etc. 
Currently prepared module name are "rssc" and "rssc0" . 
When you want touse another name,
please create necessary files in sql, templates, and images directory. 


* Installation *
(1) Unzip rssc.zip.
    The directory "rssc" will be made. 
(2) Install RSSC module in XOOPS admin page. 
(3) Click RSSC icon, and goto the management page of RSSC module. 
(4) In first time, some warning are displayed.
  (i) The config table is not initialized 
      Click save, and initialize. 
  (ii) Not writable the directory. 
       Permit to write in rssc/cache directory. 
(5) Confirm that "xoops.org" is registered by "Link List" 
(6) Execute "Refresh Archive" in "Archive Management"
(7) Click "Goto Module", and show the top page of RSSC module.
(8) The latest feeds is showing, it will be OK.
(9) If necessity, import data from XoopsHeadline module or WebLinks module. 

* setup of a command line *
This function is assumed to execute a command line periodically by Cron. 
Please delete bin directory, if unnecessary. 

(1) Goto admin page.
(2) Execute "Create Config File" in "Command Manage".
(3) Execute "Test to execute bin/refresh.php".

(4) Add the following to crontab. 
-----
22 3 * * * /usr/bin/php -q -f /home/***/html/modules/rssc/bin/refresh.php password 
-----
password is displayed "password" at "Command Config" in "Module Configration".


* TODO *
(1) In XML parser, add magpieRSS and PEAR RSS. 
(2) Make the structure which shares a blacklist. 
(3) Make the sample which cooperates with other modules.
(4) Add search result block
(5) show whith HTML tag ina headline. 
(6) Add the list of headlines link in admin page.

