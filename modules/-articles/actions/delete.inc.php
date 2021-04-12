<?php
if(!is_admin()) $BODY = $TPL->get("error_authorization.php");
else {
    if(empty($_GET['article_id'])) exit();
    $id = intval($_GET['article_id']);

    require_once("modules/articles/init.php");

    $article = new article(DB_TABLE_ARTICLE);

    $DB->query("DELETE FROM ".DB_ARTICLE_WIDGETS." WHERE  	group_id=?", $id);
    $DB->query("DELETE FROM ".DB_TABLE_ARTICLE_CATALOG_LINK." WHERE id_article=?", $id);
    $DB->query("DELETE FROM ".DB_ARTICLE_POSITION." WHERE article_id=?", $id);


    $BODY .= $article->delete($id, article_form($id));


}