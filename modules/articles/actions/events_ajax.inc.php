<?php

if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $_REQUEST['date'])) require_once("modules/articles/404.php");


$date = strtotime($_REQUEST['date']);


$db_tables = "`". DB_TABLE_ARTICLE ."` art ";
$sql   = 'SELECT *, id as article_id FROM  ' . $db_tables .
       ' WHERE calendar = 1 AND `date`='.$date;
$result = $DB->query($sql);

$BODY .= $DB->row_list_tpl($result, $TPL, 'events_ajax.php');
