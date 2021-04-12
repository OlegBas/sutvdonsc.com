<?php
if(!is_admin()) {
    $BODY = $TPL->get("error_authorization.php");
    exit();
}

$config = include("modules/sliders/config.php");

$id = intval($_GET['id']);

$sliders = new lib_crud($config['db_table_sliders']);

$form_items =  include("modules/sliders/form_slider.php");

$sql = "SELECT * FROM `" . $config['db_table_sliders_items'] . "` WHERE slider_id=".$id;
$result = $DB->query($sql);

while($row = $DB->fetch_array($result))
    @unlink($config['path'].'/'.$row['images']);


$sql = 'DELETE FROM '.$config['db_table_sliders_items']. ' WHERE slider_id='.$id;
$DB->query($sql);


$BODY .= $sliders->delete($id, $form_items,  '/?module=sliders&action=list&type=dialog');


