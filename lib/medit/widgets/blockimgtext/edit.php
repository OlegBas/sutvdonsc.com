<?
//если скрипт подключен вне класса, блокируем выполнение
if(!isset($this)) exit();

    /*Загружаем фотографию*/


    $param  = $this->getParameters($id);

    $dir = $widget_conf['path'].'/'.$this->group_id;

    $types =   str_replace(" ", "", $widget_conf['types']);
    $types = str_split($types, ",");

    $upload = new lib_upload('image', $dir, false, $types);

    $parameters['image'] = $param['image'];

    if($upload->error == 0){
        $parameters['image'] = $this->group_id . '/' . $upload->file;

        @unlink($widget_conf['path'].$param['image']);
    }




    $element_art = $this->save_element_art($widget, $parameters, $element_art_id);

    $this->update_element_art_in_page($element_art['id'], $widget, $element_art['cache']);




?>