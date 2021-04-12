<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 11.11.2015
 * Time: 21:57
 */

if(!is_admin()) $BODY = $TPL->get("error_authorization.php");
else {
    if(empty($_GET['article_id'])) exit();
    $id = intval($_GET['article_id']);

    require_once("modules/articles/init.php");

    $article = new article(DB_TABLE_ARTICLE);

    $cat_list = catalogs_list($id );

    $BODY .= $article->edit($id, article_form($id, $cat_list));

}

