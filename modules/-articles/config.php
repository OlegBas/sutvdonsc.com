<?
define("IMAGE_PATH",   "images");
define("DB_TABLE_ARTICLE",   "article");
define("DB_TABLE_ARTICLE_IMAGES",   "article_images");
define("DB_TABLE_ARTICLE_CATALOG_LINK",   "article_catalog_link");
define("DB_TABLE_ARTICLE_CATALOG",   "article_catalog");
define("DB_ARTICLE_WIDGETS",   "article_widgets");
define("DB_ARTICLE_POSITION",   "article_position");
define("MODUL_PATH",   "modules" . DS .  "articles" . DS);


$conf_medit = array
(
    'position'              => 'left',
    'db_table_elements_art' => 'article_widgets',
    'path_js'               => '/lib/medit/javascript',
    'widgets_dir'           => LIB_DIR.'/medit/widgets',
    'theme'                 => 'classic',
    'theme_dir'             => '/lib/medit/themes',

    'templates_dir'         => LIB_DIR.'/medit/templates',

    'callback'=>array
    (
        'add'    => 'add_widget',
        'edit'   => 'edit_widget',
        'delete' => 'delete_widget',

    ),
    'widgets'               => array
    (
        'images' => array
        (
            'dbRow'      => 'image',  // имя столбеца в таблице бд с именем изображения
            'dbTable'    => DB_TABLE_ARTICLE_IMAGES, // таблица в бд
            'dbId_group' => 'widgets_id',     // имя столбеца в таблице бд с идифекатором группы изображений
            'path'       => 'images/',  // путь для загрузки изображений
            'width'      => 570,      // ширена
            'height'     => 600,      // высота

        ),
        'feedback' => array
        (
            'key'=>"r3wdf5668)(7678@sa*&fdWDS",
            'send_script'=> '/index.php?action=email_send&module=articles'
        ),
        'video' => array
        (
            'height' => 360,
            'width'  => 640
        ),
        'docfiles' => array
        (
            'path' => $_SERVER['DOCUMENT_ROOT'].'/files',
            'path_link' => '/files',
            'types' => 'zip, doc, docx, pdf, jpg, jpeg, gif, png, ppt'
        )
    )
);

?>