<?php
require_once("modules" . DS .  "articles" . DS .  "init.php");
$KW = htmlspecialchars(stripslashes($_GET['keyword']),ENT_QUOTES);


$search    = new lib_search();
$res       = $search->result($_GET['keyword']);
$core_word = $search->words_core_array($keyword);


$vars = array('cat_id' => null,
    'catalog_name' => 'Результат поиска по ключевому слову "'.$KW.'" ');

$BODY     .= $TPL->get("section_top.php", $vars );
$page_list = "";
if(!empty($res))
{

    $db_tables = " `". DB_TABLE_ARTICLE . "` art ";

    $sql = 'SELECT * FROM  ' . $db_tables .
        ' WHERE art.id  in(' . $res . ')  ORDER BY FIELD(art.id, ' . $res . ')';


    $pl = new lib_pageList($sql, 10);


    $vars = array('admin' => is_admin(), 'position' => true);
    $BODY .= $DB->row_list_tpl($pl->result, $TPL, 'art_announcement.php', $vars);
    $page_list = $pl->get();
}
else
{
    $BODY .= $TPL->get( 'not_found.php', $vars);
}


$vars = array("page_list" => $page_list);
$BODY .= $TPL->get("section_bottom.php", $vars);