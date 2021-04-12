<?
$form_items = array
(
    array
    (
            'name' => "file_csv",
            'type' => 'file',
            'label' => 'Файл:',
        'help'=> 'файл CSV, разделитель ";"',
        'valid' => array
        (
            'is_file',
            'file_type' => 'csv, txt'
        ),
    ),
    /*
   array
       (
           'name'           => "first_row_header",
           'type'           => 'checkbox',
           'check_value'    => '1',
           'no_check_value' => '0',
           'label' => 'Первая строка таблицы является заголовком',

       )
    */

)
?>