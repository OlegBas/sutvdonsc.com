<?php
class menu
{
    function view($menu_id)
    {
        $catalog = new lib_catalog("article_catalog", "article_catalog_cash", "article_catalog_link", "", $menu_id);
        return $catalog->getCash();
    }

}
$MENU = new menu();