<?

$url = $v_url;
$width = $conf['widgets']['video']['width'];
$height = $conf['widgets']['video']['height'];

if(lib_vkVideo::isVkUrl($url)){
    print lib_vkVideo::getPlayer($url, $width, $height);
}
elseif(lib_youtubeVideo::isYoutubeUrl($url))
{
    print lib_youtubeVideo::getPlayer($url, $width, $height);
}



?>
