<?
function article_form($id = null, $catalogs = array())
{
    global $catalog;


    if(isset($_POST['catid']) && is_array($_POST['catid'])) $catalogs = $_POST['catid'];


    $path = "";
    if($id) $path = "/" . IMAGE_PATH . "/" .$id;


    $url = '';
    $url_id = null;




    return array
    (
        array(
              'type'=>'tab',
              'label' => 'Основные',
              'items' =>array
             (
                  array
                  (
                      'name'  => "title",
                      'type'  => 'text',
                      'label' => 'Заголвок*:',
                      'style' => 'width:500px;',
                      'valid' => array
                      (
                          'required'
                      ),

                  ),
                  array
                  (
                      'name' => "date",
                      'type' => 'date',
                      'label' => 'Дата:',
                      'valid' => array
                      (
                          'pattern' => '\d{2}\.\d{2}\.\d{4}'
                      ),
                      'help' => 'Формат: 00.00.0000',
                      'format' => array('type'=>'timestamp'),
                      'dete_format' => "d.m.Y"

                  ),

                  array
                  (
                      'name' => "calendar",
                      'type' => 'checkbox',
                      'label' => 'Отображать в календаре',
                      /* Значение при отмеченном элементе*/
                      'check_value'       => '1',
                      /* Значение при не отмеченном элементе*/
                      'no_check_value'    => '0',

                  ),
                  array
                  (
                      'name' => "pin_to_main",
                      'type' => 'checkbox',
                      'label' => 'Закрепить на главной',
                      /* Значение при отмеченном элементе*/
                      'check_value'       => '1',
                      /* Значение при не отмеченном элементе*/
                      'no_check_value'    => '0',

                  )
              )
            ),
        array(
            'type'=>'tab',
            'label' => 'Каталог',
            'items' =>array
            (
                //элементы формы
                array
                (
                    'type' => 'html',
                    'html' => 'Каталог: <div class="checklist">' . $catalog->multi_select_catalog(null, null, $catalogs)."</div>"
                )
            )
        ),
        array(
              'type'=>'tab',
              'label' => 'Снипет',
              'items' =>array
             (
                  array
                  (
                      'name' => "description",
                      'type' => 'markdown',
                      'label' => 'Вступление:',
                      'style' => 'height:200px;'

                  ),

                  array
                  (
                      'name'  =>  "image",
                      'type'  =>  'images_upload',
                      'label' => 'Фото:',
                      'path' => $path,
                      'valid' =>  array
                      (
                          'file_type' => 'jpg, png, jpeg'
                      ),
                      'img_default' => 'lib/medit/themes/classic/empty_image.gif'
                  ),
              )
            ),






        array
        (
            'type' => 'submit',
            'value' => ' Сохранить '
        )
    );
}

function catalogs_list($article)
{
    global $DB;

    $sql = 'SELECT * FROM ' . DB_TABLE_ARTICLE_CATALOG_LINK . ' WHERE id_article = ?';
    $reselt = $DB->query($sql, $article);
    $out = array();

    while($row = $DB->fetch_array($reselt)) $out[] = $row['id_cat'];

    return $out;
}

function add_widget($element_art, $widget_conf, $art_id)
{
    $search = new lib_search();
    $search->index($element_art['cache'], $art_id, 5);
}
function edit_widget($element_art, $widget_conf, $art_id)
{
    $search = new lib_search();
    article_search_index($art_id);
}
function delete_widget($element_art, $widget_conf, $art_id)
{
    $search = new lib_search();
    $search->delete_index($art_id);
}
function article_search_index($art_id)
{

    global $DB;

    $search = new lib_search();

    $sql = "SELECT `cache` FROM `article_widgets` WHERE group_id= ?";

    $result = $DB->query($sql, $art_id);

    $search->delete_index($art_id);

    while($row = $DB->fetch_array($result)) $search->index($row['cache'], $art_id, 5);
}

function dates_event($format = "d.m.Y", $separator = ",", $year = null, $month = null)
{
    global $DB;


    $month ++;

    if($month < 10) $month = "0".$month;

    $last_day= last_dey($year, $month);

    $start_date = strtotime("01.".$month.'.'.$year);
    $end_date   = strtotime($last_day.'.'.$month.'.'.$year);

    if(empty($start_date) || empty($end_date)) return '';

    $sql = 'SELECT DISTINCT `date` FROM `article` WHERE `calendar`=1 AND  `date` >= '.$start_date.' AND `date` <='.$end_date;


    $result = $DB->query($sql);

    $out = '';

    while($row= $DB->fetch_array($result))
    {
        $date = date($format, $row['date']);
        $out .= $date.$separator;
    }

    $out = trim($out,$separator);

    return $out;
}

function last_dey($year, $month)
{

    return date("t", strtotime($year.'-'.$month.'-01'));

}


/**
 * функция возвращает идентификатор каталога
 * @param $article_id - id статьи
 * @return null|int - id каталога
 */
function get_catalog_id($article_id)
{
    global $DB, $URL_OPTION;

    if(isset($URL_OPTION['cat_id']) && intval($URL_OPTION['cat_id']) != 0) return $URL_OPTION['cat_id'];

    $sql = 'SELECT * FROM '.DB_TABLE_ARTICLE_CATALOG_LINK.' WHERE id_article=?';


    $result = $DB->query($sql, $article_id);

    $cat_id = null;
    /*
    if($DB->num_rows($result) > 1 && !empty($_SERVER['HTTP_REFERER']))
    {
        preg_match('/([\d\w-_]*)\.html/', $_SERVER['HTTP_REFERER'], $matchs);



        if(!empty($matchs[1]))
        {

            $surl = new lib_SemanticURL($matchs[1]);
            $cat_id_supposed = $surl->getId();
            print $cat_id_supposed;
            if($cat_id_supposed)
            {

                while ($cat = $DB->fetch_array($result))
                    if ($cat['id_cat'] == $cat_id_supposed) $cat_id = $cat['id_cat'];
                if(!$cat_id && $cat_id_supposed) $cat_id = $cat_id_supposed;
            }
        }
    }
    elseif($DB->num_rows($result) == 1)
    {
        $cat = $DB->fetch_array($result);
        $cat_id = $cat['id_cat'];

    }
    */
    $cat = $DB->fetch_array($result);
    $cat_id = $cat['id_cat'];


    return $cat_id;
}
?>