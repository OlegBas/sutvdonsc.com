<?php

return array(
    array
    (
            'name' => "name",
            'type' => 'text',
            'label' => 'Название*:',
            'valid' => array
            (
                'required'
            ),
    ),
    array
    (
        'name' => "max_width",
        'type' => 'number',
        'label' => 'Макс. ширина картинки*:',
        'valid' => array
        (
            'required'
        ),
    ),
    array
    (
        'name' => "max_height",
        'type' => 'number',
        'label' => 'Макc. высота картинки*:',
        'valid' => array
        (
            'required'
        ),
    ),
    array
    (
        'name' => "css_class",
        'type' => 'text',
        'label' => 'CSS class:',

    ),
    array
        (
            'type' => 'submit',
            'value' => ' OK '
        ),
);