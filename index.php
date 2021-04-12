<?php
Header('Content-Type: text/html; charset=utf-8');
//print date_default_timezone_get();
date_default_timezone_set("Europe/Moscow");
Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //Дата в прошлом
Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
Header("Pragma: no-cache"); // HTTP/1.1
Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");


define("LIB_DIR",   "lib");
require_once("conf/db.php");
require_once("conf/site.php");

if(DEBUGGING)
{
    ini_set('display_errors','On');
    error_reporting(E_ALL ^ E_DEPRECATED);
}

require_once("conf/admin.php");
require_once("lib/include.php");
require_once("core/function.php");
require_once("core/connect_db.php");

lib_javascript::add('/javascript/jquery.min.js');
lib_javascript::add('/javascript/mcms.windows.jquery.js');
lib_css::add('/themes/monster_cms/css/ui.css');


$BODY = "";
$HEAD = "";
$ADMIN_TOOLS = "";
$TITLE = "";
$TPL = new lib_littletempl("themes/".THEME, "themes/monster_cms");

$USER      = new lib_users("user");
$USER_INFO = false;
$USER_IS   = $USER->is_user();

$TYPE = (!empty($_REQUEST['type'])) ? $_REQUEST['type'] : 'main';

if($USER_IS) $USER_INFO = $USER->info();


if(!$USER_IS && isset($_GET['admin'])) {
     $tags = array("buttons" => $USER->entryForm());
    $ADMIN_TOOLS = $TPL->get("admin_tools.php", $tags);



}
elseif (isset($_GET['entry'])) $USER->reload();
elseif (isset($_GET['exit'])) $USER->uexit("/");

if($USER_IS)
{
    $ADMIN_TOOLS = admin_tools($ADMIN_BUTTONS);

}



$TAGS = array();


//module_load();

/* Downloadable Modules (Load event) */

$dir  = opendir(MODULE_DIR);

while ($module = readdir($dir))
{
    $load = MODULE_DIR . DS . $module . DS . MODULE_LOAD_SCRIPT;

    if(file_exists($load))
    {
        require_once($load);
    }
}


/* подкючаем файлы */
require_once("core/route.php");

$TAGS['BODY']        = $BODY;
$TAGS['JS']          = lib_javascript::get();
$TAGS['CSS']         = lib_css::get();
$TAGS['THEME_PATH']  = "themes/".THEME."/";
$TAGS['HEAD']        = $HEAD;
$TAGS['BASE']        = SITE_URL."/themes/".THEME.'/';
$TAGS['ADMIN_TOOLS'] = $ADMIN_TOOLS;
$TAGS['TITLE']       = $TITLE;
$TAGS['SLIDERS']     = $SLIDERS;
$TAGS['MENUS']       = $MENU;


switch($TYPE)
{
    case 'ajax':
        print $BODY;
        break;

    case 'dialog':
        print $TPL->get("dialog.php", $TAGS);
        break;

    default:
        print $TPL->get("index.php", $TAGS);
        break;
}


?>