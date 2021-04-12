<?
include("modules/catalog/function.php");


    if(!is_admin()) $BODY = $TPL->get("error_authorization.php");
    else
    {
        if(isset($MENUS[$_GET['menu']]))
            $BODY = '<a href="/?module=catalog&action=menu_list&type=dialog">Разделы сайта</a> / ' . $MENUS[$_GET['menu']].'<br /><br />';

        $catalog = new lib_catalog("article_catalog", "article_catalog_cash", "article_catalog_link", "", $_GET['menu']);
        $catalog->event_function_add = 'event_function_add';
        $catalog->event_function_edit = 'event_function_edit';
        $catalog->event_function_del = 'event_function_del';
        $catalog->add_fields = add_fields();
        $BODY .= '<div class="structure_site">'.$catalog->edit().'</div>';
    }



?>