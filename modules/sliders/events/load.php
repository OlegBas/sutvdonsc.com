<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 17.07.2016
 * Time: 10:43
 */


$sliders_config = include_once("modules/sliders/config.php");





class Sliders
{


    public function view($id, $css="", $show = 1, $navigation=true, $pagination = false)
    {
        global $sliders_config, $DB, $TPL;

        $id = intval($id);

        $sql = "SELECT * FROM `" . $sliders_config['db_table_sliders_items'] . "` WHERE slider_id=".$id.' ORDER BY pos, id DESC';

        $result = $DB->query($sql);
        $items = array();

        while( $row = $DB->fetch_assoc($result)) $items[] = $row;

        return $TPL->get("slider.php", array('items' => $items,
            'css'=>$css,
            'path'=>$sliders_config['path'],
            'id' => $id,
            'show'=>$show,
            'navigation' => ($navigation) ? "true" : "false",
            'pagination' => ($pagination) ? "true" : "false"

            )
        );
    }
}
$SLIDERS = new Sliders();

