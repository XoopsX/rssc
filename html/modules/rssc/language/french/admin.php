<?php
// $Id: admin.php,v 1.1 2011/12/29 14:37:09 ohwada Exp $
// 2008-01-19 15:34:47 ken

//=========================================================
// RSS Center Module
// Language for Admin
//=========================================================

// =========================================================
// Traduit par jbaudin
// Version 0.71
// 09/01/2008
// jeromebaudin@jbnet.fr
// www.jbnet.fr
// =========================================================


// --- define language begin ---
if( !defined("RSSC_LANG_AM_LOADED") )
{

define("RSSC_LANG_AM_LOADED", "1");
define("_AM_RSSC_CONF", "RSS Center Management");
define("_AM_RSSC_LIST_LINK", "Liste des liens");
define("_AM_RSSC_LIST_BLACK", "Liste noire");
define("_AM_RSSC_LIST_WHITE", "Liste blanche");
define("_AM_RSSC_LIST_FEED", "Liste des flux d'informations");
define("_AM_RSSC_ADD_LINK", "Ajouter un lien");
define("_AM_RSSC_ADD_BLACK", "Ajouter liste noire");
define("_AM_RSSC_ADD_WHITE", "Ajouter liste blanche");
define("_AM_RSSC_ADD_KEYWORD", "Ajouter mots cl&eacute;s");
define("_AM_RSSC_ARCHIVE_MANAGE", "Gestion des archives");
// define("_AM_RSSC_COMMAND_MANAGE", "Gestion du rafra&icirc;chissement auto");
define("_AM_RSSC_UPDATE_MANAGE", "Importation");
define("_AM_RSSC_VIEW_RSS", "Voir RDF/RSS/ATOM");
// define("_AM_RSSC_GOTO_MODULE", "Afficher le module");
define("_AM_RSSC_FORM_BASIC", "Configuration basique");
define("_AM_RSSC_FORM_BASIC_DESC", "Configuration par d&eacute;faut lors de l'ajout d'un lien");
define("_AM_RSSC_FORM_MAIN", "Configuration principale");
define("_AM_RSSC_FORM_MAIN_DESC", "Utilis&eacute;e sur la page principale du module");
define("_AM_RSSC_FORM_BLOCK", "Configuration du bloc");
define("_AM_RSSC_FORM_BLOCK_DESC", "Utilis&eacute; par le bloc du module");
// define("_AM_RSSC_FORM_BIN", "Configuration de la commande");
// define("_AM_RSSC_FORM_BIN_DESC", "Utilis&eacute; pour la commande");
// define("_AM_RSSC_INIT_NOT", "La table de configuration n'est pas initialis&eacute;e");
// define("_AM_RSSC_INIT_EXEC", "Initialisation de la table de configuration");
// define("_AM_RSSC_VERSION_NOT", "Ce n'est pas la version %s");
// define("_AM_RSSC_UPGRADE_EXEC", "MAJ de la table de configuration");
// define("_AM_RSSC_WARNING_NOT_WRITABLE", "Le r&eacute;pertoire n'est pas en configur&eacute; en &eacute;criture");
// define("_AM_RSSC_CONF_NAME", "Item");
define("_AM_RSSC_DBUPDATED", "Base de donn&eacute;es mise &agrave; jour avec succ&egrave;s!");
define("_AM_RSSC_FAILUPDATE", "Probl&egrave;me lors de l'enregistrement des donn&eacute;es dans la base");
define("_AM_RSSC_FAILDELETE", "Probl&egrave;me lors de l'effacement des donn&eacute;es dans la base");
define("_AM_RSSC_THERE_ARE_LINKS", "Il y a <b>%s</b> liens dans la base");
define("_AM_RSSC_THERE_ARE_FEEDS", "Il y a <b>%s</b> flux d'informations dans la base");
define("_AM_RSSC_LINK_MANAGE", "Gestion des liens");
define("_AM_RSSC_MOD_LINK", "Modifier le lien");
define("_AM_RSSC_DEL_LINK", "Effacer le lien");
define("_AM_RSSC_SHOW_RSS", "Voir RSS");
define("_AM_RSSC_SHOW_FEED", "Voir le flux d'informations");
define("_AM_RSSC_FEED_BELONG_LINK", "Montrer les flux d'informations appartenant &agrave; ce lien");
define("_AM_RSSC_ERROR_FILL", "Erreur: saisir %s");
define("_AM_RSSC_ERROR_ILLEGAL", "Erreur: ill&eacute;gal %s");
define("_AM_RSSC_BLACK_MANAGE", "Gestion de la blacklist");
define("_AM_RSSC_MOD_BLACK", "Modifier la blacklist");
define("_AM_RSSC_DEL_BLACK", "Effacer la blacklist");
define("_AM_RSSC_FEED_MATCH_LINK", "Voir les flux d'informations qui correspondent &agrave; cette liste");
define("_AM_RSSC_WHITE_MANAGE", "Gestion de la Whitelist");
define("_AM_RSSC_MOD_WHITE", "Modifier la whitelist");
define("_AM_RSSC_DEL_WHITE", "Effacer la whitelist");
define("_AM_RSSC_ADD_FEED", "Ajouter un fil d'informations");
define("_AM_RSSC_MOD_FEED", "Modifier un fil d'informations");
define("_AM_RSSC_DEL_FEED", "Effacer un fil d'informations");
define("_AM_RSSC_THERE_ARE_MATCH", "Il y a <b>%s</b> donn&eacute;es qui correspondent &agrave; ces conditions");
define("_AM_RSSC_CONDITION", "Condition");
define("_AM_RSSC_REFRESH", "R&eacute;g&eacute;n&eacute;rer les archives ");
define("_AM_RSSC_REFRESH_NEXT", "V&eacute;rifier apr&egrave;s  %s");
define("_AM_RSSC_LINK_LIMIT", "Limite de lien ");
define("_AM_RSSC_LINK_OFFSET", "Offset du lien");
define("_AM_RSSC_FEED_CLEAR", "Archives");
define("_AM_RSSC_FEED_CLEAR_OLD", "Effacer les vieux enregistrements");
define("_AM_RSSC_FEED_CLEAR_NUM", "Effacer les enregistrements si ils sont plus vieux de <b>x</b> jours");
define("_AM_RSSC_NO_REFRESH", "Pas de lien &agrave; mettre &agrave; jour");
define("_AM_RSSC_TIME_START", "Heure de d&eacute;part");
define("_AM_RSSC_TIME_END", "Heure de fin");
define("_AM_RSSC_TIME_ELAPSE", "Temps d'ex&eacute;cution");
define("_AM_RSSC_MIN_SEC", "%s min %s sec");
define("_AM_RSSC_NUM_LINK_TOTAL", "Total");
define("_AM_RSSC_NUM_LINK_TARGET", "Nb de liens cibles");
define("_AM_RSSC_NUM_LINK_BROKEN", "Nb de liens bris&eacute;s");
define("_AM_RSSC_NUM_LINK_UPDATED", "Nb de liens MAJ");
define("_AM_RSSC_NUM_FEED_UPDATED", "Nb de flux d'informations MAJ");
define("_AM_RSSC_NUM_FEED_CLEARED", "Nb de flux d'informations enlev&eacute;s");
define("_AM_RSSC_NUM_LINKS", "liens");
define("_AM_RSSC_NUM_FEEDS", "flux d'informations");
define("_AM_RSSC_FAILGET", "Ne peut pas r&eacute;cup&eacute;rer le fichier XML de %s");
define("_AM_RSSC_GOTOTOP", "En haut");
define("_AM_RSSC_CONF_FEED_LIMIT", "Nb max de flux d'informations");
define("_AM_RSSC_CONF_FEED_LIMIT_DESC", "Saisir le nb max de flux d'informations enregistr&eacute;s dans la table<br />Efface les vieux enregistrement si le nb d&eacute;passe cette valeur.<br /><b>0</b> : pas de limite");
define("_AM_RSSC_CONF_RSS_ATOM", "Priorit&eacute; RSS ou ATOM");
define("_AM_RSSC_CONF_RSS_ATOM_DESC", "Selectionne RSS ou ATOM, si les 2 sont d&eacute;tect&eacute;s");
define("_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM", "ATOM");
define("_AM_RSSC_CONF_RSS_ATOM_SEL_RSS", "RSS");
define("_AM_RSSC_CONF_RSS_PARSER", "Choisir l'analyseur de RSS (parser)");
define("_AM_RSSC_CONF_RSS_PARSER_SELF", "Analyseur RSSC");
define("_AM_RSSC_CONF_RSS_PARSER_XOOPS", "Analyseur RSS XOOPS");
define("_AM_RSSC_CONF_ATOM_PARSER", "Selectionne l'analyseur ATOM");
define("_AM_RSSC_CONF_ATOM_PARSER_0", "Analyseur RSSC");
define("_AM_RSSC_CONF_ATOM_PARSER_1", "");
define("_AM_RSSC_CONF_RSS_MODE", "Valeur initiale du mode RSS");
define("_AM_RSSC_CONF_XML_SAVE", "Sauvegarde XML");
define("_AM_RSSC_CONF_XML_SAVE_DESC", "Sauvegarde le fichier XML dans la table de liens");
define("_AM_RSSC_CONF_FUTURE_DAYS", "Nb de jours");
define("_AM_RSSC_CONF_FUTURE_DAYS_DESC", "Ne pas montrer les flux d'informations si ils datent de plus de <b>x</b> jours");
define("_AM_RSSC_CONF_SHOW_ORDER", "Ordre d'affichage");
define("_AM_RSSC_CONF_SHOW_ORDER_UPDATED", "Derni&egrave;res MAJ");
define("_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED", "Dernieres publications");
define("_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE", "Nb de liens par page");
define("_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE", "Nb de flux d'informations par page");
define("_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK", "Nb de flux d'informations par lien");
define("_AM_RSSC_CONF_SHOW_MAX_TITLE", "Nb max de caract&egrave;res du titre");
define("_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC", "Le HTML sera toujours &eacute;pur&eacute;<br><b>-1</b> : pas de limite");
define("_AM_RSSC_CONF_SHOW_MAX_SUMMARY", "Nb max de caract&egrave;res du r&eacute;sum&eacute;");
define("_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC", "<b>-1</b> : pas de limite");
define("_AM_RSSC_CONF_MAIN_SEARCH_MIN", "Nb min de caract&egrave;res pour la recherche par mots cl&eacute;s");
// define("_AM_RSSC_CONF_BIN_PASS", "Mot de passe");
// define("_AM_RSSC_CONF_BIN_SEND", "Envoyer un email");
// define("_AM_RSSC_CONF_BIN_MAILTO", "Adresse email de destination");
define("_AM_RSSC_VIEW_RSS_OPTION", "Option Setting");
define("_AM_RSSC_NOT_SELECT_LINK", "Le liens n'est pas s&eacute;lectionn&eacute;");
define("_AM_RSSC_PLEASE_SELECT_LINK", "S&eacute;lectionnez &agrave; partir de la liste des liens, ou saisissez un id");
define("_AM_RSSC_VIEW_PARSER", "Param&egrave;tres de l'analyseur");
define("_AM_RSSC_VIEW_SAVE_ETC", "Sauvegarder dans la table, etc");
define("_AM_RSSC_VIEW_MODE", "Mode de visualisation");
define("_AM_RSSC_VIEW_MODE_DESC", "Ne pas sauvegarder dans la table si le mode est &agrave; 0");
define("_AM_RSSC_VIEW_MODE_CURRENT", "mode 0: r&eacute;cup&egrave;re les donn&eacute;es XML");
define("_AM_RSSC_VIEW_MODE_LINK", "mode 1: donn&eacute;es XML enregistr&eacute;es dans la table des liens");
define("_AM_RSSC_VIEW_MODE_FEED", "mode 2: donn&eacute;es enregistr&eacute;es dans la table des flux d'informations");
define("_AM_RSSC_VIEW_SANITIZE", "Epurer le HTML");
define("_AM_RSSC_VIEW_TITLE_HTML", "Voir le titre en HTML");
define("_AM_RSSC_VIEW_TITLE_HTML_DESC", "Si OUI, les balises HTML sont gard&eacute;es.<br />Si NON, le titre est affich&eacute; en texte brut.");
define("_AM_RSSC_VIEW_CONTENT_HTML", "Afficher le contenu au format HTML");
define("_AM_RSSC_VIEW_CONTENT_HTML_DESC", "Si OUI, affiche le contenu avec les balises HTML.<br />Si NON, affiche le contenu sans les balises HTML. ");
define("_AM_RSSC_VIEW_MAX_CONTENT", "Nb max de caract&egrave;res du contenu");
define("_AM_RSSC_VIEW_MAX_CONTENT_DESC", "Le HTML sera &eacute;pur&eacute;, si la longueur d&eacute;passe ce nombre<br /><b>-1</b> : pas de limite");
define("_AM_RSSC_VIEW_LINK_UPDATE", "MAJ de la table de liens");
define("_AM_RSSC_VIEW_FEED_UPDATE", "MAJ de la table des flux d'informations");
define("_AM_RSSC_VIEW_FORCE_DISCOVER", "Force la d&eacute;couverte des URL RSS");
define("_AM_RSSC_VIEW_FORCE_DISCOVER_DESC", "Remplace les URLs RDF/RSS/ATOM si le lien RSS donn&eacute; n'est pas au format RSS");
define("_AM_RSSC_VIEW_FORCE_UPDATE", "Force la MAJ des archives");
define("_AM_RSSC_VIEW_FORCE_UPDATE_DESC", "Remplace les archives si les URLs RDF/RSS/ATOM n'ont pas d'intervalle de rafraichissement");
define("_AM_RSSC_VIEW_FORCE_OVERWRITE", "Force la MAJ de la table des flux d'informations");
define("_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC", "Remplace la table des flux d'informations, m&ecirc;me si les donn&eacute;es des RDF/RSS/ATOM existent d&eacute;j&agrave;");
define("_AM_RSSC_VIEW_PRINT_LOG", "Voir la Log");
define("_AM_RSSC_VIEW_PRINT_LOG_DESC", "Voir les logs simultan&eacute;ment pendant l'ex&eacute;cution");
define("_AM_RSSC_VIEW_PRINT_ERROR", "Voir les erreurs");
define("_AM_RSSC_VIEW_PRINT_ERROR_DESC", "Voir les erreurs simultan&eacute;ment pendant l'ex&eacute;cution");
// define("_AM_RSSC_CREATE_CONFIG", "Cr&eacute;er le fichier config");
// define("_AM_RSSC_TEST_BIN_REFRESH", "Tester l'ex&eacute;cution de bin/refresh.php");
define("_AM_RSSC_IMPORT_XOOPSHEADLINE", "Importer de XoopsHeadline");
define("_AM_RSSC_IMPORT_WEBLINKS", "Importer de WebLinks");
define("_AM_RSSC_VIEW_FEED_PERPAGE", "Nb de flux d'informations par page");
define("_AM_RSSC_VIEW_MAX_TITLE", "Nb max de caract&egrave;res du titre");
define("_AM_RSSC_VIEW_MAX_TITLE_DESC", "Le HTML sera toujours &eacute;pur&eacute;<br><b>-1</b> : pas de limite");
define("_AM_RSSC_VIEW_MAX_SUMMARY", "Nb max de caract&egrave;res du r&eacute;sum&eacute;");
define("_AM_RSSC_VIEW_MAX_SUMMARY_DESC", "<b>-1</b> : pas de limite");
define("_AM_RSSC_VIEW_XML_SAVE", "Sauvegarde XML");
define("_AM_RSSC_VIEW_XML_SAVE_DESC", "Sauvegarde le fichier XML dans la table de liens");
define("_AM_RSSC_ID_ASC", "ID A->Z");
define("_AM_RSSC_ID_DESC", "ID Z->A");
// define("_AM_RSSC_BUILD", "Construire RDF/RSS/ATOM");
// define("_AM_RSSC_BUILD_DSC", "Construire et voir RDF/RSS/ATOM pour debug");
// define("_AM_RSSC_BUILD_RDF", "Construire RDF");
// define("_AM_RSSC_BUILD_RSS", "Construire RSS");
// define("_AM_RSSC_BUILD_ATOM", "Construire ATOM");
define("_AM_RSSC_PARSE_RSS", "Parse RDF/RSS/ATOM");
define("_AM_RSSC_CONF_INDEX_DESC", "Description sur la page d'accueil");
define("_AM_RSSC_CONF_INDEX_DESC_DSC", "Saisir la description qui sera affich&eacute;e sur la page d'accueil.");
define("_AM_RSSC_CONF_INDEX_DESC_DEFAULT", "<div align=\"center\" style=\"color: #0000ff\">Ici une description.<br />Vous pouvez l'&eacute;diter dans la partie \"Configuration\".<br /></div><br />");
define("_AM_RSSC_LINK_DESC", "Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br />when you dont fill, <br />if web site support \"RSS Auto Discovery\"");
define("_AM_RSSC_LINK_FORCE", "Force la sauvegarde");
define("_AM_RSSC_BLACK_MEMO", "Memo");
define("_AM_RSSC_CONF_SHOW_TITLE_HTML", "Utilise le HMTL dans le titre");
define("_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC", "Si \"OUI\", affiche le titre au format HTML, si le titre contient du code HTML.<br />Si \"NON\", affiche le titre d&eacute;pouill&eacute; du HTML. ");
define("_AM_RSSC_CONF_SHOW_CONTENT_HTML", "Utilise le HTML dans le contenu");
define("_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC", "Si \"OUI\", affiche le contenu au format HTML, si le contenu contient du code HTML.<br />Si \"NON\", affiche le contenu d&eacute;pouill&eacute; du HTML. ");
define("_AM_RSSC_CONF_SHOW_MAX_CONTENT", "Le nombre maximum de charact&egrave;res du contenu");
define("_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC", "Les balises HTML sont supprim&eacute;es si le contenu contient plus que ce nombre<br /><b>-1</b> : pas de limite");
define("_AM_RSSC_CONF_SHOW_NUM_CONTENT", "Nombre maximum de contenu de flux RSS/ATOM affich&eacute;s");
define("_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC", "Saisir le nombre maximum de contenu RSS/ATOM feeds &agrave; afficher.");
define("_AM_RSSC_CONF_SHOW_BLOG_LID", "ID du lien pour afficher le blog");
define("_AM_RSSC_TABLE_MANAGE", "Gestionnaire de base de donn&eacute;es");
define("_AM_RSSC_FORM_PROXY", "Configuration du serveur Proxy");
define("_AM_RSSC_CONF_PROXY_USE", "Utiliser un serveur Proxy");
define("_AM_RSSC_CONF_PROXY_HOST", "Nom du serveur Proxy");
define("_AM_RSSC_CONF_PROXY_PORT", "Port du serveur Proxy");
define("_AM_RSSC_CONF_PROXY_USER", "Nom d'utilisateur du serveur Proxy");
define("_AM_RSSC_CONF_PROXY_USER_DESC", "Saisir un nom d'utilisateur, si votre proxy demande une authentification simple, <br />sinon, laissez &agrave; blanc.");
define("_AM_RSSC_CONF_PROXY_PASS", "Mot de passe du Proxy.");
define("_AM_RSSC_CONF_PROXY_PASS_DESC", "Saisir le mot de passe si votre proxy demande une authentification simple, <br />sinon, laissez &agrave; blanc.");
define("_AM_RSSC_CONF_HIGHLIGHT", "Appliquer la surbrillance de mots cl&eacute;s");
define("_AM_RSSC_LIST_WORD", "Liste de mots rejet&eacute;s");
define("_AM_RSSC_WORD_MANAGE", "Gestion des mots rejet&eacute;s");
define("_AM_RSSC_ADD_WORD", "Ajouter un mot rejet&eacute;");
define("_AM_RSSC_MOD_WORD", "Modifier un mot rejet&eacute;");
define("_AM_RSSC_DEL_WORD", "Effacer un mot rejet&eacute;");
define("_AM_RSSC_POINT_ASC", "Little Point Order");
define("_AM_RSSC_POINT_DESC", "Much Point Order");
define("_AM_RSSC_COUNT_ASC", "Little Frequency Count Order");
define("_AM_RSSC_COUNT_DESC", "Much Frequency Count Order");
define("_AM_RSSC_WORD_ASC", "A-Z");
define("_AM_RSSC_WORD_DESC", "Z-A");
define("_AM_RSSC_NON_ACT", "Liste non visualis&eacute;e");
define("_AM_RSSC_NON_ACT_ASC", "Tri ascendant ID non consult&eacute;s");
define("_AM_RSSC_NON_ACT_DESC", "Tri descendant ID non consult&eacute;s");
define("_AM_RSSC_WORD_ALREADY", "Ce mot est d&eacute;j&agrave; rejet&eacute;");
define("_AM_RSSC_WORD_SEARCH", "Recherche de synonyme");
define("_AM_RSSC_FORM_FILTER", "Param&egrave;tres du filtre");
define("_AM_RSSC_FORM_FILTER_DESC", "Ce filtre juge d'enregistrer ou pas dans la base de donn&eacute;es lors de la collecte automatique des flux d'informations");
define("_AM_RSSC_CONF_LINK_USE", "Utilise une table de liens");
define("_AM_RSSC_CONF_LINK_USE_DESC", "Enregistre quand \"Type\" de la table de liens est \"Normal\"");
define("_AM_RSSC_CONF_WHITE_USE", "Utilise la liste blanche");
define("_AM_RSSC_CONF_WHITE_USE_DESC", "Enregistre si pr&eacute;sence dans la liste blanche.");
define("_AM_RSSC_CONF_BLACK_USE", "Utilise la liste noire");
// double definition in English
define("_AM_RSSC_CONF_BLACK_USE_DESC", "Ne pas enregistrer si pr&eacute;sence dans la liste noire<br />When select \"Use\", interrupt filtering process, if judge black<br />When select \"Learning\", continue filtering process, for purpose extracting words, if judge black');define('_AM_RSSC_CONF_BLACK_USE_NO','Ne pas utiliser");
define("_AM_RSSC_CONF_BLACK_USE_NO", "Ne pas utiliser");
define("_AM_RSSC_CONF_BLACK_USE_YES", "Utiliser");
define("_AM_RSSC_CONF_BLACK_USE_LEARN", "Apprendre");
define("_AM_RSSC_CONF_WORD_USE", "Utilise la liste de mot rejet&eacute;s");
define("_AM_RSSC_CONF_WORD_USE_DESC", "Ne pas enregistrer si le nombre total de mots est sup&eacute;rieur au niveau de rejet");
define("_AM_RSSC_CONF_WORD_LEVEL", "Niveau de rejet");
define("_AM_RSSC_CONF_FEED_SAVE", "Sauvegarde des flux d'informations");
define("_AM_RSSC_CONF_FEED_SAVE_DESC", "Enregsitre ou pas dans la table des flux d'informations si le flux est jug&eacute; non d&eacute;sir&eacute;.<br />Si \"Save\", enregistre avec le statut \"Non vu\".");
define("_AM_RSSC_CONF_FEED_SAVE_NO", "Ne pas sauvegarder");
define("_AM_RSSC_CONF_FEED_SAVE_YES", "Sauvegarder");
define("_AM_RSSC_CONF_LOG_USE", "Utilise un fichier log");
define("_AM_RSSC_CONF_LOG_USE_DESC", "Ecrit dans une log si le flux est jug&eacute; non d&eacute;sir&eacute;");
define("_AM_RSSC_CONF_WHITE_COUNT", "Compte la liste blanche");
define("_AM_RSSC_CONF_WHITE_COUNT_DESC", "Compte le nombre d'enregistrements trouv&eacute;s si un mot se trouve dans la liste blanche");
define("_AM_RSSC_CONF_BLACK_COUNT", "Compte la liste noire");
define("_AM_RSSC_CONF_BLACK_COUNT_DESC", "Compte le nombre d'enregistrements trouv&eacute;s si un mot se trouve dans la liste noire");
define("_AM_RSSC_CONF_WORD_COUNT", "Compte les mots rejet&eacute;s");
define("_AM_RSSC_CONF_WORD_COUNT_DESC", "Incr&eacute;mente le compteur des mots rejet&eacute;s quand un mot trouv&eacute; fait parti de la liste des mots rejet&eacute;s");
define("_AM_RSSC_CONF_BLACK_AUTO", "Ajouter dans la liste noire");
define("_AM_RSSC_CONF_BLACK_AUTO_DESC", "aJOUTE L'URL dans la liste noire automatiquement si le flux est jug&eacute; non d&eacute;sir&eacute;<br /><b>Attention</b> Le \"statut\" est \"invalide\"<br />Changer &agrave; \"valide\" si utilisation");
define("_AM_RSSC_CONF_WORD_AUTO", "Ajouter dans la liste des mots rejet&eacute;s");
define("_AM_RSSC_CONF_WORD_AUTO_DESC", "Extrait les mots dans le contenu automatiquement, et ajouter les mots dans la liste des mots rejet&eacute;s automatiquement, si les mots sont jug&eacute;s non d&eacute;sir&eacute;s<br /><b>Attention</b> \"point\" est &agrave; 0<br />Changer \"point\" si utilisation");
define("_AM_RSSC_CONF_WORD_AUTO_NON", "Pas d'ajout");
define("_AM_RSSC_CONF_WORD_AUTO_SYMBOL", "Extract by the symbol pause");
define("_AM_RSSC_CONF_WORD_AUTO_KAKASI", "Extract by KAKASI: Japanese Only");
define("_AM_RSSC_FORM_WORD", "Param&egrave;tres d'extraction de mots");
define("_AM_RSSC_CONF_JOIN_PREV", "Word Join");
define("_AM_RSSC_CONF_JOIN_PREV_DESC", "join to forword and backword word, and make a phrase");
define("_AM_RSSC_CONF_JOIN_GLUE", "Caract&egrave;re d'espacement");
define("_AM_RSSC_CONF_JOIN_GLUE_DESC", "En japonnais, aucun caract&egrave;re");
define("_AM_RSSC_CONF_KAKASI_PATH", "Command Path of KAKASI");
define("_AM_RSSC_CONF_KAKASI_MODE", "Mode of KAKASI");
define("_AM_RSSC_CONF_KAKASI_MODE_FILE", "Use temporary file");
define("_AM_RSSC_CONF_KAKASI_MODE_PIPE", "Use UNIX pipe");
define("_AM_RSSC_CONF_CHAR_LENGTH", "The minimum number of characters");
define("_AM_RSSC_CONF_CHAR_LENGTH_DESC", "The minimum number of characters to extact word");
define("_AM_RSSC_CONF_WORD_LIMIT", "The maxmum number of reject words");
define("_AM_RSSC_CONF_WORD_LIMIT_DESC", "Enter the maximum number of word stored in word table<br />Clears the older records, when it becomes more than this value<br /><b>0</b> is umlimited");
define("_AM_RSSC_KAKASI_EXECUTABLE", "kakasi is executable");
define("_AM_RSSC_KAKASI_NOT_EXECUTABLE", "kakasi is not executable");
define("_AM_RSSC_CONF_HTML_GET", "R&eacute;cup&eacute;r&eacute; le HTML");
define("_AM_RSSC_CONF_HTML_GET_DESC", "get origin HTML data automatically, when judge with reject word list<br />When select \"Use\", the precision of the judgment is improved , but the execution time become long");
define("_AM_RSSC_CONF_HTML_GET_NO", "Non utilis&eacute;");
define("_AM_RSSC_CONF_HTML_GET_YES", "Utilis&eacute;");
define("_AM_RSSC_CONF_HTML_GET_BLACK", "Utilis&eacute; si jug&eacute; non d&eacute;sir&eacute;");
define("_AM_RSSC_CONF_HTML_LIMIT", "Maximum de charact&egrave;res HTML");
define("_AM_RSSC_CONF_HTML_LIMIT_DESC", "Nombre maximum de charact&egrave;res HTML qui peuvent être automatiquement r&eacute;cup&eacute;r&eacute;s<br />Sur certains sites, la quantit&eacute; de code HTML est tr&egrave;s gros et leur &eacute;x&eacute;cution est tr&egrave;s longue");
define("_AM_RSSC_LEAN_BLACK", "Apprendre dans la liste noire");
define("_AM_RSSC_LEAN_BLACK_DESC", "Analyser la liste noire, pour extraire automatiquement les mots du contenu et ajouter ces mots dans la liste des mots rejet&eacute;s");
define("_AM_RSSC_NUM_FEED_ALL", "Le nombre de tous les flux d'informations");
define("_AM_RSSC_NUM_FEED_SKIP", "Le nombre de flux d'informations toujours enregsitr&eacute;s");
define("_AM_RSSC_NUM_FEED_REJECT", "Le nombre de flux d'informations jug&eacute;s non d&eacute;sir&eacute;s");
define("_AM_RSSC_THEREARE_TITLE", "en relation <b>%s</b> il y a <b>%s</b>");
define("_AM_RSSC_CONF_SHOW_MODE_DATE", "Date Mode");
define("_AM_RSSC_CONF_SHOW_MODE_DATE_NON", "Not Show");
define("_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT", "court");
define("_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE", "moyen");
define("_AM_RSSC_CONF_SHOW_MODE_DATE_LONG", "long");
define("_AM_RSSC_CONF_SHOW_SITE", "Information du site");
define("_AM_RSSC_CONF_SHOW_SITE_DSC", "Si \"OUI\", affiche le titre du site et l'URL");
define("_AM_RSSC_LINK_CENSOR_DESC", "S&eacute;pare chaun avec un <b>|</b><br />Sensible &agrave; la casse");


}
// --- define language end ---

?>