<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 22.11.2015
 * Time: 12:09
 */

require_once("modules/articles/init.php");

$cat_id = (empty($URL_OPTION['cat_id'])) ? DEFAULT_CATALOG : $URL_OPTION['cat_id'];


//require_once("modules" . DS .  "articles" . DS .  "init.php");

$article = new article(DB_TABLE_ARTICLE);




$article_count = $article->article_count($cat_id);


switch($article_count)
{
    case 1:
        $_GET['id'] = $article->getArtIdByCatId($cat_id);
        require_once(MODUL_PATH . "view.inc.php");
        break;

    case 0:
        $BODY .= 'В разделе нет статей';
        break;

    default:
        require_once(MODUL_PATH . "preview_section.inc.php");

}
