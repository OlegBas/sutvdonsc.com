<?
$MODULE = (!empty($_REQUEST['module'])) ? $_REQUEST['module'] : DEFAULT_MODULE;
$ACTION = (!empty($_REQUEST['action'])) ? $_REQUEST['action'] : DEFAULT_ACTION;

$URL_OPTION = array();

if(!empty($_GET['url']))
{
    $surl = new lib_SemanticURL($_GET['url']);
    $URL_OPTION = $surl->getOptions();



    if(!empty($URL_OPTION))
    {
        $MODULE = $URL_OPTION['modul'];
        $ACTION = $URL_OPTION['action'];

    }
    else
    {
        require_once("modules/articles/404.php");
    }

}
/*
else
{


    $MODULE = $_REQUEST['module'];
    $ACTION = $_REQUEST['action'];

    if(empty($MODULE)) $MODULE = DEFAULT_MODULE;
    if(empty($ACTION)) $ACTION = DEFAULT_ACTION;

}
*/

$file = "modules" . DS . $MODULE . DS . ACTION_DIR . DS . $ACTION . ".inc.php";



if(is_file($file)) require_once($file);

?>