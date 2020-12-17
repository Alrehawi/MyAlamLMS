<?php

defined('DSO') ? null : define('DSO', DIRECTORY_SEPARATOR);
defined('DS') ? null : define('DS', '/');
defined('LIB_PATH') ? null : define('LIB_PATH', __DIR__);

//Main Controls
require_once(dirname(__FILE__) . DS . "config.php");  // Assigning Username , Password and DB_Name
require_once(dirname(__FILE__) . DS . "functions.php");
require_once(dirname(__FILE__) . DS . "session.php"); // Login ,Logout and Etc.. About Sessions
require_once(dirname(__FILE__) . DS . "protection.php"); //Protect URLs
//Infrastructure Classes

require_once(dirname(__FILE__) . DS . "action.php"); // Edit , Delete , Move , Publish , Assign , Translate , Etc.. Actions
require_once(dirname(__FILE__) . DS . "database.php"); // Open , Close and Etc.. Mysql
require_once(dirname(__FILE__) . DS . "database_object.php"); // Insert , Update , Delete and Select MYSQL Statments
require_once(dirname(__FILE__) . DS . "translator.php"); // Translates Objects on other langs
//CMS Parts
require_once(dirname(__FILE__) . DS . "site_config.php");
require_once(dirname(__FILE__) . DS . "language.php");
require_once(dirname(__FILE__) . DS . "persec.php");
require_once(dirname(__FILE__) . DS . "permission.php");
require_once(dirname(__FILE__) . DS . "role.php");
require_once(dirname(__FILE__) . DS . "per2role.php");

require_once(dirname(__FILE__) . DS . "user.php");
require_once(dirname(__FILE__) . DS . "photograph.php");
require_once(dirname(__FILE__) . DS . "module.php");
require_once(dirname(__FILE__) . DS . "plugin.php");
require_once(dirname(__FILE__) . DS . "page.php");
require_once(dirname(__FILE__) . DS . "part.php");
require_once(dirname(__FILE__) . DS . "ads_section.php");
require_once(dirname(__FILE__) . DS . "ad.php");

require_once(dirname(__FILE__) . DS . "menu.php");
require_once(dirname(__FILE__) . DS . "file_manager.php");
require_once(dirname(__FILE__) . DS . "layout.php");
require_once(dirname(__FILE__) . DS . "gallery.php");
require_once(dirname(__FILE__) . DS . "media.php");
require_once(dirname(__FILE__) . DS . "main.php");
require_once(dirname(__FILE__) . DS . "subject.php");
require_once(dirname(__FILE__) . DS . "mail_group.php");
require_once(dirname(__FILE__) . DS . "mail.php");
require_once(dirname(__FILE__) . DS . "mail_message.php");

//CMS Object Plugins
require_once(dirname(__FILE__) . DS . "pagination.php");
require_once(dirname(__FILE__) . DS . "search.php");

require_once(dirname(__FILE__) . DS . 'file.php');
require_once(dirname(__FILE__) . DS . 'subscription.php');
require_once(dirname(__FILE__) . DS . 'event.php');
require_once(dirname(__FILE__) . DS . 'event_config.php');
require_once(dirname(__FILE__) . DS . 'votequestion.php');
require_once(dirname(__FILE__) . DS . 'voteanswer.php');
require_once(dirname(__FILE__) . DS . 'vote.php');
require_once(dirname(__FILE__) . DS . 'join_request.php');
require_once(dirname(__FILE__) . DS . 'job_request.php');
require_once(dirname(__FILE__) . DS . 'contacts.php');
require_once(dirname(__FILE__) . DS . 'activity_log.php');
