<?
define("VERSION",   "1.2.1");
define("THEME",   "sut");

define("SITE_URL",   "");
define("SITE",   $_SERVER["SERVER_NAME"]);

define("DS",   DIRECTORY_SEPARATOR);

/* модуль на главной */
define("DEFAULT_MODULE",   "articles");
define("DEFAULT_ACTION",   "route");

define("DEFAULT_CATALOG",   46);



define("MODULE_DIR",           "modules");
define("ACTION_DIR",           "actions");
define("MODULE_LOAD_SCRIPT",   "events" . DS . "load.php");

$MENUS= array(
    '1'=>'Верхнее меню',
    '2'=>'Левое меню',
);



if(isset($_SERVER['WINDIR'])) define("DEBUGGING",   true);
else                          define("DEBUGGING",   false);



define("SMPT_SERVER", "");
define("SMPT_PORT", 587);
define("SMPT_USER", "");
define("SMPT_PASSWOER", "");

?>