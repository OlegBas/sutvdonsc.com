<?

/*функция вызывается при добавлении каталога */
function event_function_add($id)
{
    if(!empty($_POST['url'])) {
        $options = array
        (
            'modul' => 'articles',
            'action' => 'route',
		    'cat_id'=> intval($id)
        );
        $url_id = null;

        $route = new lib_SemanticURL($_POST['url']);
        if(!$route->is()) $url_id = $route->insert($options);

        if(!is_null($url_id))
        {
            $cat_obj = new lib_object('article_catalog', $id, "id_catalog");
            $cat_obj->url_id = $url_id;
            $cat_obj->url    = $_POST['url'];

            $cat_obj->menu_id = $_POST['menu_id'];
            $cat_obj->no_active_item  = isset($_POST['no_active_item']);
            $cat_obj->save();
        }



    }
}
/*функция вызывается при редактирования каталога */
function event_function_edit($id)
{
    if(!empty($_POST['url_id']) && !empty($_POST['url']))
    {
        $url_obj = new lib_object('urls', $_POST['url_id']);
        $url_obj->url = $_POST['url'];

        $url_obj->save();

        $cat_obj = new lib_object('article_catalog', $id, "id_catalog");


        $cat_obj->url = $_POST['url'];



        $cat_obj->menu_id = $_POST['menu_id'];
        $cat_obj->show_menu  = 1;
        $cat_obj->no_active_item  = isset($_POST['no_active_item']);

        $cat_obj->save();
    }
}
/*функция вызывается до удалении каталога */
function event_function_del($id)
{
    global $DB;

    $cat_obj = new lib_object('article_catalog', $id, "id_catalog");

    $url_id = intval($cat_obj->url_id);
    if($url_id == 0) return null;

    $sql = 'DELETE FROM urls WHERE id=?';
    $DB->query($sql, $cat_obj->url_id);

}

function add_fields()
{
    global $MENUS;
    $url = '';
    $url_id = null;
    $menu_id = intval($_GET['menu']);
    $no_active_item = 0;
    if(!empty($_GET['editcat']))
    {
        $catalog_id = intval($_GET['editcat']);
        $cat_obj = new lib_object('article_catalog', $catalog_id, "id_catalog");

        if(!is_null($cat_obj->url_id))
        {

            $url_obj = new lib_object('urls', $cat_obj->url_id);
            $url     = $url_obj->url;
            $url_id  = $cat_obj->url_id;
            $menu_id  = $cat_obj->menu_id;
            $no_active_item = $cat_obj->no_active_item;
        }
    }



    return array
    (
        array
        (
            'name' => "url",
            'type' => 'text',
            'label' => 'URL*:',
            'value' => $url,
            'valid' => array
            (

                'cell' => array
                (
                    array( 'is_url', array( 'url_id' => $url_id) ),
                    'Такая web страница уже есть, введите другой адрес'
                ),
                'required'
            )
        ),
        array
        (
            'name' => "url_id",
            'type' => 'hidden',
            'value' => $url_id
        ),

        array
            (
                'name'           => "no_active_item",
                'type'           => 'checkbox',
                'check_value'    => '1',
                'no_check_value' => '0',
                'value' => $no_active_item,
                'label' => 'Пункт в меню не активен',

            ),

        array
            (
                'name'  => "menu_id",
                'type'  => 'hidden',
                'label' => '',
                'value' => $menu_id,

            ),
    );
}

function is_url($url,  $param=array())
{
    $route = new lib_SemanticURL($url);
    $url_id = $param[1]['url_id'];
    if(!$route->is()) return true;

    //редактирование
    if(!is_null($url_id))
    {
        //если был изменен
        if($route->getId() != $url_id) return false;
        //if(!$route->is() && $route->getId() != $url_id) return false;
    }
    elseif($route->is()) return false;

    return true;
}























?>