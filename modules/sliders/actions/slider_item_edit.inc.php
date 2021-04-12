<?php
if(!is_admin()) {
    $BODY = $TPL->get("error_authorization.php");
    exit();
}

$slider_id = intval($_GET['slider_id']);
$item_id = intval($_GET['id']);

$config = include("modules/sliders/config.php");

include("modules/sliders/slider_item.php");
$path = "/".$config['path'];
$form_items = include("modules/sliders/form_slider_item.php");

$slider_item = new SliderItem($config['db_table_sliders_items']);
$slider_item->config = $config;

$BODY .= $slider_item->edit($item_id, $form_items);