<?php
if(!is_admin()) {
    $BODY = $TPL->get("error_authorization.php");
    exit();
}

$config = include("modules/sliders/config.php");

$sql = "SELECT * FROM `" . $config['db_table_sliders'] . "`";
$result = $DB->query($sql);
$items = array();

while( $row = $DB->fetch_assoc($result)) $items[] = $row;



$BODY .= $TPL->get("sliders_list.php", array('items' => $items));