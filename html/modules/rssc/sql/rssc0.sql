# $Id: rssc0.sql,v 1.3 2012/04/08 23:42:21 ohwada Exp $

# 2012-04-02 K.OHWADA
# link table
#   varchar -> text
#   url, rdf_url, rss_url, atom_url
# feed table
#   varchar -> text
#   site_link, entry_id, guid, author_uri, enclosure_url, 
#   media_content_url, media_thumbnail_url

# 2011-12-29 K.OHWADA
# TYPE=MyISAM -> ENGINE=MyISAM

# 2010-04-18 K.OHWADA
# BLOB/TEXT column 'link' can't have a default value

# 2009-09-27 K.OHWADA
# KEY act_time udi_time in feed table

# 2009-03-14 K.OHWADA
# change INSERT

# 2009-02-20 K.OHWADA
# gicon_id in link table
# geo_lat in feed table

# 2008-02-24 K.OHWADA
# change varchar to text (64KB)
#   link in feed

# 2008-01-20 K.OHWADA
# add field post_plugin in link
# change attribute censor plugin in link

# 2007-11-26 K.OHWADA
# BLOB and TEXT columns cannot have DEFAULT values.

# 2007-11-01 K.OHWADA
# add field enclosure censor plugin in link
# add field cache ctime in black, white

# 2007-06-01 K.OHWADA
# add table xml, word
# add field act in feed
# add field act reg count in black, white

# 2006-09-01 K.OHWADA
# add conf_valuetype

# 2006-07-08 K.OHWADA
# corresponding to podcast

# =========================================================
# RSS Center Module
# 2006-01-01 K.OHWADA
# =========================================================

#
# Table structure for table `rssc_config`
# modify from system `config`
#

CREATE TABLE rssc_config (
  id smallint(5) unsigned NOT NULL auto_increment,
  conf_id smallint(5) unsigned NOT NULL default 0,
  conf_name varchar(255) NOT NULL default '',
  conf_valuetype varchar(255) NOT NULL default '',
  conf_value text NOT NULL,
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  PRIMARY KEY (id),
  KEY conf_id (conf_id)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_link`
#

CREATE TABLE rssc_link (
  lid int(11) unsigned NOT NULL auto_increment,
  uid int(11) unsigned default '0',
  mid int(11) unsigned default '0',
  p1  int(11) unsigned default '0',
  p2  int(11) unsigned default '0',
  p3  int(11) unsigned default '0',
  title  varchar(255)    default '',
  url text NOT NULL,
  ltype  tinyint(2) unsigned default '0',
  refresh   mediumint(8) unsigned default '3600',
  headline  mediumint(8) unsigned default '0',
  mode      tinyint(3)   default '0',
  rdf_url  text NOT NULL,
  rss_url  text NOT NULL,
  atom_url text NOT NULL,
  encoding  varchar(15)  default '',
  updated_unix int(10) default'0',
  channel text    NOT NULL,
  xml  mediumtext NOT NULL,
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  enclosure tinyint(2) default '1',
  censor      text NOT NULL,
  plugin      text NOT NULL,
  post_plugin text NOT NULL,
  icon varchar(255) default '',
  gicon_id int(10) default'0',
  PRIMARY KEY  (lid),
  KEY mid (mid),
  KEY p (p1, p2, p3)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_xml`
#

CREATE TABLE rssc_xml (
  xid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned default '0',
  xml  mediumtext NOT NULL,
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  PRIMARY KEY  (xid),
  KEY lid (lid)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_feed`
#

CREATE TABLE rssc_feed (
  fid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned NOT NULL default '0',
  uid int(11) unsigned default '0',
  mid int(11) unsigned default '0',
  p1  int(11) unsigned default '0',
  p2  int(11) unsigned default '0',
  p3  int(11) unsigned default '0',
  site_title varchar(255) default '',
  site_link  text NOT NULL,
  title  varchar(255) NOT NULL default '',
  link   text NOT NULL,
  entry_id  text NOT NULL,
  guid      text NOT NULL,
  updated_unix   int(10) default '0',
  published_unix int(10) default '0',
  category  varchar(255) default '',
  author_name  varchar(255) default '',
  author_uri   text NOT NULL,
  author_email varchar(255) default '',
  type_cont    varchar(255) default '',
  raws    text NOT NULL,
  content text NOT NULL,
  search  text NOT NULL,
  enclosure_url  text NOT NULL,
  enclosure_type varchar(255) default '',
  enclosure_length int(5) default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  act   tinyint(1) default '1',
  geo_lat  double(10,8) NOT NULL default '0',
  geo_long double(11,8) NOT NULL default '0',
  media_content_url    text NOT NULL,
  media_content_type   varchar(255) default '',
  media_content_medium varchar(255) default '',
  media_content_filesize int(10) default '0',
  media_content_width    int(10) default '0',
  media_content_height   int(10) default '0',
  media_thumbnail_url    text NOT NULL,
  media_thumbnail_width  int(10) default '0',
  media_thumbnail_height int(10) default '0',
  PRIMARY KEY  (fid),
  KEY lid (lid),
  KEY mid (mid),
  KEY p   (p1, p2, p3),
  KEY act_time (act, updated_unix, published_unix),
  KEY uid_time (uid, updated_unix, published_unix),
  KEY link (link(10)),
  KEY updated   (updated_unix),
  KEY published (published_unix)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_black`
#

CREATE TABLE rssc_black (
  bid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned default '0',
  uid int(11) unsigned default '0',
  mid int(11) unsigned default '0',
  p1  int(11) unsigned default '0',
  p2  int(11) unsigned default '0',
  p3  int(11) unsigned default '0',
  title varchar(255) default '',
  url   varchar(255) NOT NULL default '',
  memo text NOT NULL,
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  act   tinyint(1) default '1',
  reg   tinyint(1) default '0',
  count int(11) unsigned default '0',
  cache int(11) unsigned default '0',
  ctime int(11) unsigned default '0',
  PRIMARY KEY  (bid)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_white`
#

CREATE TABLE rssc_white (
  wid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned default '0',
  uid int(11) unsigned default '0',
  mid int(11) unsigned default '0',
  p1  int(11) unsigned default '0',
  p2  int(11) unsigned default '0',
  p3  int(11) unsigned default '0',
  title varchar(255) default '',
  url   varchar(255) NOT NULL default '',
  memo text NOT NULL,
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  act   tinyint(1) default '1',
  reg   tinyint(1) default '0',
  count int(11) unsigned default '0',
  cache int(11) unsigned default '0',
  ctime int(11) unsigned default '0',
  PRIMARY KEY  (wid)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_word`
#

CREATE TABLE rssc_word (
  sid   int(11) unsigned NOT NULL auto_increment,
  word  varchar(255) default '',
  reg   tinyint(1) default '0',
  point int(11) unsigned default '0',
  count int(11) unsigned default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  PRIMARY KEY  (sid),
  KEY point (point, count)
) ENGINE=MyISAM;
# --------------------------------------------------------

INSERT INTO rssc_link VALUES (1, 1, 0, 0, 0, 0, 'XOOPS.org', 'http://www.xoops.org/', 2, 3600, 1, 2, '', 'http://www.xoops.org/backend.php', '', 'utf-8', 0, '', '', 0, 0, '', '', 1, '', '', '', '', 0 );
INSERT INTO rssc_xml VALUES (1, 1, '', 0, 0, '', '');
