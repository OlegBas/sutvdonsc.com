<?
//если скрипт подключен вне класса, блокируем выполнение
if(!isset($this)) exit();
//проверяем правельность формы
if(!empty($_POST['v_url']))

{
    $url = $parameters['v_url'];
    if(lib_vkVideo::isVkUrl($url) && !preg_match("/video_ext\.php/", $url)  )
    {
        $vkVideo = new lib_vkVideo($url);
        $url = $vkVideo->getUrlForIframe();
        $parameters['v_url'] = $url;
    }

    $element_art = $this->save_element_art($widget, $parameters, $element_art_id);

    $this->update_element_art_in_page($element_art['id'], $widget, $element_art['cache']);

}


?>