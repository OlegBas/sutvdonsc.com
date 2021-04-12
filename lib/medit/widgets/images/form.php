<?
if(!isset($this)) exit();
$url = lib_path::this_url();

$conf = array('upload_script' => $url);
$widget_conf =
    array_merge($conf, $widget_conf);




$img_uploader = new lib_mUploadImages($widget_conf, $id);
$html = $img_uploader->html();


$form_items = array
(


);

?>
