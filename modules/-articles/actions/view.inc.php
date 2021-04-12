<?
require_once("modules/articles/init.php");

$article_id = intval($_GET['id']);

$article_info = new lib_object(DB_TABLE_ARTICLE, $article_id);




if(intval($article_info->id) == 0) require_once("modules/articles/404.php");

$cat_id = get_catalog_id($article_id);

print $cat_id;
$bread_crumbs = '';
if($cat_id !== null && DEFAULT_CATALOG != $cat_id)
    $bread_crumbs = '<a href="/">Главная</a> / ' . $catalog->bread_crumbs($cat_id);


$edit = ($USER_IS) ? true : false;

$conf_medit['widgets']['images']['path'] = 'images/'.$article_id;

$TITLE = $article_info->title;

$medit = new lib_medit($article_info->id, $conf_medit, $edit);
$html = str_replace("../files/", "/files/", $medit->html);

$BODY .= $TPL->get("article_top.php",array('id' => $article_id, 'bread_crumbs'=>$bread_crumbs));

$BODY .= $html;
if($edit) $BODY .= $TPL->get("setting_buttons.php",array('id' => $article_id));
$this_url = lib_path::this_url();
$site = 'http://'.$_SERVER['HTTP_HOST'];
$vars = array
(
    'art_info' => $article_info,
    'this_url' => $this_url,
    'site'     => $site
);
$BODY .= $TPL->get("article_bottom.php", $vars);


?>