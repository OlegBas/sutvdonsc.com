<?
//если скрипт подключен вне класса, блокируем выполнение
if(!isset($this)) exit();

/*Загружаем фотографию*/

$dir = $widget_conf['path'].'/'.$this->group_id;

$types =   str_replace(" ", "", $widget_conf['types']);
$types = str_split($types, ",");

$upload = new lib_upload('image', $dir, false, $types);

if($upload->error == 0) $parameters['image'] = $this->group_id . '/' . $upload->file;



$element_art = $this->save_element_art($widget, $parameters);
$element_id = $element_art['id'];

if($add_in_page) $this->add_element_art_in_page($element_art['id'], $widget, $element_art['cache'] , $element_art['pos']);




?>