<?php
/**
 * Created by PhpStorm.
 * User: bioma_000
 * Date: 16.11.2015
 * Time: 22:58
 */

$ADMIN_BUTTONS = array
(
    array
    (
        'type'=>'button',
        'action'=>'/?module=articles&action=add',
        'ico' => 'fa-plus-circle',
        'text' => 'Добавить статью',
        'align' => 'left',
        'target' => 'dialog',
        'window_size' => '800x600'
    ),
    array
    (
        'type'=>'button',
        'action'=>'/?module=catalog&action=menu_list',
        'ico' => 'fa-sitemap',
        'text' => 'Разделы сайта',
        'align' => 'left',
        'target' => 'dialog',
        'window_size' => '800x600'

    ),
    array
    (
        'type'=>'button',
        'action'=>'/?module=sliders&action=list',
        'ico' => 'fa-picture-o',
        'text' => 'Слайдеры',
        'align' => 'left',
        'target' => 'dialog',
        'window_size' => '800x600'

    ),
    array
    (
        'type'=>'button_ico',
        'action'=>'/?exit&admin',
        'ico' => 'fa-sign-out',
        'text' => 'Выход',
        'align' => 'right',
        'target' => '_top'
    )

);