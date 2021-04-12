<?php
/**
 * Created by PhpStorm.
 * User: Danila
 * Date: 24.12.2015
 * Time: 16:59
 */

require_once("modules/articles/init.php");

$year  = intval($_REQUEST['year']);
$month = intval($_REQUEST['month']);
print '["'.dates_event("d.m.Y", '","', $year, $month).'"]';
exit();