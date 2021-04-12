<?php

define("IMAGE_PATH",   "images");
define("DB_TABLE_ARTICLE",   "article");
define("DB_TABLE_ARTICLE_IMAGES",   "article_images");
define("DB_TABLE_ARTICLE_CATALOG_LINK",   "article_catalog_link");
define("DB_TABLE_ARTICLE_CATALOG",   "article_catalog");
define("DB_ARTICLE_WIDGETS",   "article_widgets");
define("DB_ARTICLE_POSITION",   "article_position");
define("MODUL_PATH",   "modules" . DS .  "articles" . DS);

$widget_conf =array('dbRow'      => 'image',  // имя столбеца в таблице бд с именем изображения
    'dbTable'    => DB_TABLE_ARTICLE_IMAGES, // таблица в бд
    'dbId_group' => 'widgets_id',     // имя столбеца в таблице бд с идифекатором группы изображений
    'path'       => 'images/'. 0 .'/',  // путь для загрузки изображений
    'width'      => 570,      // ширена
    'height'     => 600,      // высота
    );

$conf = array('upload_script' => lib_path::this_url());
$widget_conf =
    array_merge($conf, $widget_conf);


$img_uploader = new lib_mUploadImages($widget_conf, 0);
$BODY.= $img_uploader->html();


