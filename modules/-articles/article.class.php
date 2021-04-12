<?php

/**
 * Created by PhpStorm.
 * User: Danila
 * Date: 07.11.2015
 * Time: 14:53
 */
class article extends lib_crud
{
    public $DB_TABLE_ARTICLE_CATALOG_LINK = DB_TABLE_ARTICLE_CATALOG_LINK;
    public $IMAGE_PATH                    = IMAGE_PATH;
    public $DS                            = DIRECTORY_SEPARATOR;
    public $DB_TABLE_ARTICLE_IMAGES      = DB_TABLE_ARTICLE_IMAGES;

    public function event_add($id, $form)
    {

        global $catalog, $conf_medit;
        $id = intval($id);


        $dir = $this->IMAGE_PATH. $this->DS .$id;
        if(!is_dir($dir)) mkdir($dir);


        $upload = new lib_upload("image", $dir, time(), array("jpg", "jpeg", "png", "gif"));


        $width  = $conf_medit['widgets']['images']['width'];
        $height = $conf_medit['widgets']['images']['height'];
        $path   = $conf_medit['widgets']['images']['path'];

        if($upload->error == 0)
        {
            $where = "`".$this->db_row_id."`=".$id;

            $img = new lib_image($dir. $this->DS .$upload->file);
            $img->resize($width,$height,false,true);
            $img->save($dir. $this->DS .$upload->file);

            $this->db->update_array(array('image' => $upload->file), $this->db_table, $where);
        }


        $catalog->save_multi_catalog($id, 'id_article');

        if(!is_array($_POST['catid'])) $_POST['catid'] = array();
        $pos = new lib_position();
        foreach ($_POST['catid'] as $cat) $pos->newItem($id, $cat);


        $this->add_widget($id, "h1",   array('heading'=>$_POST['title']));
        $this->add_widget($id, "date", array('date'=>$_POST['date']));

        if($upload->error == 0)
        {
            $this->add_widget_images($id, $upload->file);


        }

        $this->add_widget($id, "markdown", array('text'=>$_POST['description']));


        header("Location: /article.html?id=".$id);
        exit();
    }

    private function add_widget($art_id, $widget, $value)
    {
        global $conf_medit;

        $conf_medit['widgets']['images']['path'] = $this->IMAGE_PATH.'/'.$art_id.'/';

        //print_r($conf_medit);
        $medit = new lib_medit($art_id, $conf_medit);



        return $medit->add_widget($widget, $value, false);
    }
    private function add_widget_images($art_id, $file)
    {
        global $conf_medit;

        $width  = $conf_medit['widgets']['images']['width'];
        $height = $conf_medit['widgets']['images']['height'];
        $path   = $conf_medit['widgets']['images']['path'];
        $medit  = new lib_medit($art_id, $conf_medit);
        /*
        $list = array
        (
            'widget' => 'images',
            'pos' => $medit->max_pos()+1,
           'group_id'=>$art_id,
        );
        $this->db->insert_array();
        */

        $widget=$medit->save_element_art("images", array());

        $list=array
        (
            'id'         => "NULL",
            'pos'        => 1,
            'image'      => $file,
            'widgets_id' => $widget['id']

        );
/*
        $img = new lib_image($path.$file);
        $img->resize($width,$height,false,true);
        $img->save($path.$file);
*/
        $this->db->insert_array($list,$this->DB_TABLE_ARTICLE_IMAGES );
        $medit->save_element_art("images", array(), $widget['id']);


    }

    public function event_edit($id, $form)
    {
        global $catalog, $conf_medit;
        $id = intval($id);

        $width  = $conf_medit['widgets']['images']['width'];
        $height = $conf_medit['widgets']['images']['height'];
        $path   = $conf_medit['widgets']['images']['path'];

        /**@TODO индексация названия и описания статьи */

        $article_info = new lib_object($this->db_table, $id);



        $old_image = $article_info->image;



        $dir = $this->IMAGE_PATH. $this->DS .$id;
        if(!is_dir($dir)) mkdir($dir);


        $upload = new lib_upload("image", $dir, time(), array("jpg", "jpeg", "png", "gif"));


        if($upload->error == 0)
        {
            $where = "`".$this->db_row_id."`=".$id;

            $img = new lib_image($dir. $this->DS .$upload->file);
            $img->resize($width,$height,false,true);
            $img->save($dir. $this->DS .$upload->file);

            $this->db->update_array(array('image' => $upload->file), $this->db_table, $where);

            @unlink($dir.'/'.$old_image);
        }


        $catalog->save_multi_catalog($id, 'id_article');

    }

    public function event_delete($id, $form)
    {

    }

    /**
     * The number of articles in the section
     *
     * @param $cat_id - section id
     * @return int
     */

    function article_count($cat_id)
    {
        $db = $this->db;

        $sql = 'SELECT `id_cat` FROM '.$this->DB_TABLE_ARTICLE_CATALOG_LINK.' WHERE id_cat=?';

        $result = $db->query($sql, $cat_id);

        return $db->num_rows($result);
    }

    public function getArtIdByCatId($cat_id)
    {
        $db = $this->db;
        $cat_id = intval($cat_id);

        $sql = 'SELECT `id_article` FROM '.$this->DB_TABLE_ARTICLE_CATALOG_LINK.' WHERE id_cat='.$cat_id.' LIMIT 1';

        $result = $db->get_row($sql);

        return $result[0];
    }


}