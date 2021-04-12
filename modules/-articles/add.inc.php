<?
if(!is_admin()) $BODY = $TPL->get("error_authorization.php");
else {
    require_once("modules/articles/init.php");


    $article = new article(DB_TABLE_ARTICLE);

    $BODY .= $article->add(article_form(), "/article.html?id=");



}
?>