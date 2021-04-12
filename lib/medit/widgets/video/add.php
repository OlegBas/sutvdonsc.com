<?
//если скрипт подключен вне класса, блокируем выполнение
if(!isset($this)) exit();

$url    = $parameters['v_url'];


if(lib_vkVideo::isVkUrl($url))
{
    $vkVideo = new lib_vkVideo($url );
    $url = $vkVideo->getUrlForIframe();
    $parameters['v_url'] = $url;
}


$element_art = $this->save_element_art($widget, $parameters);
$element_id = $element_art['id'];

$element_art['cache'] .= "";
if($add_in_page) $this->add_element_art_in_page($element_art['id'], $widget, $element_art['cache'] , $element_art['pos']);




?>