<?
include("modules/catalog/function.php");


    if(!is_admin()) $BODY = $TPL->get("error_authorization.php");
    else
    {
        $catalog = new lib_catalog("article_catalog", "article_catalog_cash", "article_catalog_link");
        $catalog->event_function_add = 'event_function_add';
        $catalog->event_function_edit = 'event_function_edit';
        $catalog->event_function_del = 'event_function_del';
        $catalog->add_fields = add_fields();
        $BODY = $catalog->edit();
    }



?>