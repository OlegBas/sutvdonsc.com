<?php
require_once("modules/articles/init.php");



$db_tables = "`" . DB_TABLE_ARTICLE_CATALOG_LINK . "` link, `".
                   DB_TABLE_ARTICLE ."` art, `article_position` pos";

$sql = 'SELECT * FROM  ' . $db_tables .
       ' WHERE link.id_article = art.id AND  pos.article_id=art.id  AND pos.catalog_id=' . $cat_id . ' AND link.id_cat=' . $cat_id .
       ' GROUP BY link.id_article ORDER BY pos.position DESC';



$catalog_info = new lib_object(DB_TABLE_ARTICLE_CATALOG, $cat_id, 'id_catalog');

$pl = new lib_pageList($sql, 10);

$BODY .= $TPL->get("section_top.php",array('cat_id' => $cat_id, 'catalog_name' => $catalog_info->name ));

$vars  = array('admin'=>is_admin(), 'position'=>true);
$BODY .= $DB->row_list_tpl($pl->result, $TPL, 'art_announcement.php', $vars);

$vars = array( "page_list" => $pl->get());
$BODY .= $TPL->get("section_bottom.php", $vars);