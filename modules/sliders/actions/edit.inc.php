<?php

if(!is_admin()) {
    $BODY = $TPL->get("error_authorization.php");
    exit();
}

$config = include("modules/sliders/config.php");

$id = intval($_GET['id']);

$sliders = new lib_crud($config['db_table_sliders']);


$form_items =  include("modules/sliders/form_slider.php");

$BODY .= $sliders->edit($id, $form_items, '/?module=sliders&action=list&type=dialog');