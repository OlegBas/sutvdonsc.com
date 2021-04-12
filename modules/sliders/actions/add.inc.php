<?php
if(!is_admin()) {
    $BODY = $TPL->get("error_authorization.php");
    exit();
}
$config = include("modules/sliders/config.php");


$sliders = new lib_crud($config['db_table_sliders']);


$form_items =  include("modules/sliders/form_slider.php");

$BODY .= $sliders->add($form_items, '/?module=sliders&action=list&type=dialog');