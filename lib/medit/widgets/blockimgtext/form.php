<?


$form_items = array
(


        array(
              'type'=>'tab',
              'label' => 'Текст',
              'items' =>array
             (
                    //элементы формы
                  array
                  (
                      'name' => "heading",
                      'type' => 'text',
                      'label' => 'Заголовок:',

                  ),
                  array
                  (
                      'name' => "text",
                      'type' => 'markdown',
                      'pos' =>2,
                      'label' => ''
                  )
              )
            ),
        array(
              'type'=>'tab',
              'label' => 'Картинка',
              'items' =>array
             (
                  array
                  (
                      'name'  =>  "image",
                      'type'  =>  'images_upload',
                      'label' => 'Фото:',
                      'path'  => $widget_conf['path'],
                      'valid' =>  array
                      (
                          'file_type' => 'jpg, png, jpeg'
                      ),
                      'img_default' => 'empty_image.gif'
                  ),
                  array
                      (
                          'name' => "image_position",
                          'type' => 'select',
                          'label' => 'Расположение изображения',
                          'options' => array
                          (
                            'left'  =>'Слева',
                            'right' =>'Справа'
                          )
                      ),
                  array
                  (
                          'name' => "image_width",
                          'after'=>'%',
                          'type' => 'text',
                          'label' => 'Размер изображения',
                          'valid' => array
                          (

                          ),
                          'style'=>'width:80px;'
                  ),
                  array
                      (
                          'name'           => "image_zoom",
                          'type'           => 'checkbox',
                          'check_value'    => '1',
                          'no_check_value' => '0',
                          'label' => 'Увеличивать',

                      ),
              )
            ),
        array(
            'type'=>'tab',
            'label' => 'Ссылка',
            'items' =>array
            (
                array
                (
                        'name' => "link_url",
                        'type' => 'text',
                        'label' => 'URL',
                        'valid' => array
                        (

                        ),
                ),
                array
                (
                    'name' => "link_text",
                    'type' => 'text',
                    'label' => 'Текст ссылки',
                    'valid' => array
                    (

                    ),
                ),
            )
        ),


)
?>