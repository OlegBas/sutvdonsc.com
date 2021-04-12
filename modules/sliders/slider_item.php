<?php


class SliderItem extends lib_crud
{
    public $config  = '';



    public function event_add($id, $form)
    {
        $this->saveImage($id);
    }

    public function event_edit($id, $form)
    {
        $item_info = new lib_object($this->db_table, $id);
        $old_img = $item_info->images;

        if( $this->saveImage($id) )
        {
            @unlink($this->config['path']. "/" . $old_img);
        }

    }

    public function event_delete($id, $old_image)
    {

            @unlink($this->config['path']. "/" . $old_image);
    }


    private function saveImage($id)
    {
        $dir = $this->config['path']. '/';
        //if(!is_dir($dir)) mkdir($dir);

        $slider_id = intval($_POST['slider_id']);

        $slider_info = new lib_object($this->config['db_table_sliders'], $slider_id);

        $upload = new lib_upload("images", $dir, time(), array("jpg", "jpeg", "png", "gif"));



        $width  = $slider_info->max_width;
        $height = $slider_info->max_height;


        if($upload->error == 0)
        {
            $where = "`".$this->db_row_id."`=".$id;

            $img = new lib_image($dir.$upload->file);
            $img->resize($width,$height,false,true);
            $img->save($dir.$upload->file);

            $this->db->update_array(array('images' => $upload->file), $this->db_table, $where);
            return true;
        }
        return false;
    }
}