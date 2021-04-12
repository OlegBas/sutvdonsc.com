<?php

$valid = array
(
    'is_file'  ,
    'file_type' => 'jpg, png, jpeg, gif'
);

if(isset($item_id))  $valid = array
(

    'file_type' => 'jpg, png, jpeg, gif'
);

return array(
    array
    (
            'name' => "images",
            'type' => 'images_upload',
            'label' => '',
            'img_default' => 'lib/medit/themes/classic/empty_image.gif',
            'path'=> $path,
            'valid' => $valid

    ),

    array
    (
        'name' => "pos",
        'type' => 'number',
        'label' => 'Поз.:',

    ),
    array
    (
        'name'  => "text",
        'type'  => 'text',
        'label' => 'Текст:'
    ),
    array
    (
        'name'  => "link",
        'type'  => 'text',
        'label' => 'Ссылка:'
    ),

    array
    (
        'name' => "slider_id",
        'type' => 'hidden',
        'label' => '',
        'value' => $slider_id,
        'valid' => array
        (
            'required'
        ),
    ),
    array
        (
            'type' => 'submit',
            'value' => ' OK '
        ),

);