<?php
if(!is_admin()) {
    $BODY = $TPL->get("error_authorization.php");
    exit();
}

$config = include("modules/sliders/config.php");

$slider_id = intval($_GET['id']);

$slide_info = new lib_object($config['db_table_sliders'], $slider_id);

$sql = "SELECT * FROM `" . $config['db_table_sliders_items'] . "` WHERE slider_id = ".$slider_id." ORDER BY pos, id DESC";
$result = $DB->query($sql);
$items = array();

while( $row = $DB->fetch_assoc($result)) $items[] = $row;
$BODY .= $TPL->get("sliders_items.php", array('items' => $items,
    'slider_id' =>  $slider_id, 'path'=>$config['path'], 'slider_info'=>$slide_info));