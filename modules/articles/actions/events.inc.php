<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 27.12.2015
 * Time: 10:03
 */

//require_once("modules/articles/init.php");


if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $_REQUEST['date'])) require_once("modules/articles/404.php");


$date = strtotime($_REQUEST['date']);


//$date_end = strtotime($_REQUEST['date']."  00:00:00");




$db_tables = "`". DB_TABLE_ARTICLE ."` art ";
$sql = 'SELECT *, id as article_id FROM  ' . $db_tables .
       ' WHERE calendar = 1 AND `date`='.$date;


$catalog_info = new lib_object(DB_TABLE_ARTICLE_CATALOG, $cat_id, 'id_catalog');

$pl = new lib_pageList($sql, 10);

$BODY .= $TPL->get("section_top.php",array('cat_id' => $cat_id, 'catalog_name' => $catalog_info->name ));

$vars  = array('admin'=>is_admin(), 'position'=>true);
$BODY .= $DB->row_list_tpl($pl->result, $TPL, 'art_announcement.php', $vars);

$vars = array( "page_list" => $pl->get());
$BODY .= $TPL->get("section_bottom.php", $vars);