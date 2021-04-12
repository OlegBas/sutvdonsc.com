<?
/* last edit 03.09.2015*/

class crud
{
    private $db_table  = 'test';
    private $db_row_id = 'id';
    private $js;


    function __construct($db_table, $db_row_id = 'id')
    {
        $this->db_table = $db_table;
        $this->db_row_id = $db_row_id;
    }

    //функция отображает форму добавления данных в бд
    public function add($form_items, $location = '')
    {
        $form = new mForm('');
        $form->add_items($form_items);
        $html = '';
        //если форма не была заполнена, выводим ее
        if(!$form->is_submit())
        {
            $html  = $form->render();
        }
        else if(!$form->is_valid())
        {
            $html = $form->error();
        }

        else
        {
            //если форма была заполнена без ошибок
            //1 создаем массив для записи в бд
            $fields =  self::list_fields($this->db_table);


            $list = '';

            foreach($form_items as $item)
            {
                if(!empty($item['items'])) $form_items = array_merge($form_items, $item['items']);
            }

            foreach($form_items as $item)
            {

                if(!empty($item['name']) && in_array($item['name'], $fields))
                {
                    $list[$item['name']] = $form->data($item['name']);
                }
            }


            //2 Записываем в бд
            self::insert_array($list, $this->db_table);
            $this->event_add(mysql_insert_id(), $form);

            if(!empty($location))
            {
                Header("Location: ".$location);
            }
        }

        $this->js = $form->js();

        return $html;
    }

    //удаление из бд
    public function delete($id, $form_items,  $location = '')
    {
        $id     = intval($id);

        $where  = '`'.$this->db_row_id.'` = '.$id;

        $sql = 'DELETE FROM `'.$this->db_table.'` WHERE '.$where;
        mysql_query($sql);

        $this->event_edit($id, $form_items);

        if(!empty($location)) Header("Location: ".$location);

    }

    //форма редактирования данных из бд
     public function edit($id, $form_items, $location = '')
    {
        $id     = intval($id);
        $where  = '`'.$this->db_row_id.'` = '.$id;

        $sql    = 'SELECT * FROM `'.$this->db_table.'` WHERE '.$where;

        $result = mysql_query($sql);
        $row    = mysql_fetch_array($result);

        $form_items_value = array();




        foreach($form_items as $key=>$item)
        {

            if(isset($form_items[$key]['items']) && sizeof($form_items[$key]['items']) > 0)
            {
                foreach($form_items[$key]['items'] as $key2=>$item2)
                {
                    $name = $item2['name'];
                    if(!empty($name) && !empty($row[$name])) $form_items[$key]['items'][$key2]['value'] = $row[$name];
                    //$form_items_value[] = $item;
                }
            }
            else
            {
                $name = $item['name'];
                if(!empty($name) && !empty($row[$name])) $form_items[$key]['value'] = $row[$name];
                //$form_items_value[] = $item;
            }

        }

        $form = new mForm('');

        $form->add_items($form_items);

        $html = '';

        //если форма не была заполнена, выводим ее
        if(!$form->is_submit())
        {
            $html  = $form->render();
        }
        else if(!$form->is_valid()) $html = $form->error();
        else
        {
            //если форма была заполнена без ошибок
            //1 создаем массив для записи в бд
            $fields =  self::list_fields($this->db_table);

            $list = '';

            foreach($form_items as $item)
            {
                if(!empty($item['items'])) $form_items = array_merge($form_items, $item['items']);
            }

            foreach($form_items as $item)
            {
                if(!empty($item['name']) && in_array($item['name'], $fields))
                {
                    $list[$item['name']] = $form->data($item['name']);
                }
            }

            //2 Записываем в бд



            self::update_array($list, $this->db_table, $where);

            $this->event_edit($id, $form);

            if(!empty($location)) Header("Location: ".$location);
        }

        $this->js = $form->js();

        return $html;



    }

    public function js()
    {
        return $this->js;
    }

    public function event_add($id, $form)
    {

    }

    public function event_edit($id, $form)
    {

    }

    public function event_delete($id, $form)
    {

    }

    ////////// эти методы можно перенести в класс db  ///////

    /*
 *  insert_array($list,$table) - Вставляет в таблицу данные из массива
 */


    static function insert_array($list, $table)
    {
        $cols="";
        $values="";
        $s=0;
        $sizeList = sizeof($list);
        $reg_word = Array
        (
            "NULL", "NOW()","UNIX_TIMESTAMP()"
        );

        foreach($list as $key=>$value)
        {
            $cols   .= "`".mysql_real_escape_string($key)."`";

            if(!in_array(strtoupper($value), $reg_word))
            {
                $values .= "'".mysql_real_escape_string($value)."'";
            }
            else
            {
                $values .= $value;
            }


            $s++;

            if($s != $sizeList)
            {
                $cols   .= ", ";
                $values .= ", ";
            }
        }


        $sql = "INSERT INTO `".$table."` (".$cols.") VALUES(".$values.")";

        return mysql_query($sql);

    }


    static function list_fields($table)
    {
        $table = mysql_real_escape_string($table);
        $sql = 'SHOW COLUMNS FROM '.$table;

        $result = mysql_query($sql);
        $fields = array();
        while($field = mysql_fetch_array($result))
        {
            $fields[] = $field['Field'];
        }

        return $fields;
    }

    static function update_array($list, $table, $where="")
    {

        $values="";

        $s=0;
        $reg_word = Array
        (
            "NULL", "NOW()","UNIX_TIMESTAMP()"
        );


        foreach($list as $key=>$value)
        {
            if(!in_array(strtoupper($value), $reg_word))
            {
                $values .= "`".mysql_real_escape_string($key)."` = '".mysql_real_escape_string($value)."'";
            }
            else
            {
                $values .= "`".mysql_real_escape_string($key)."` = ".$value;
            }

            $s++;

            if($s != sizeof($list))
            {
                $values .= ", ";
            }
        }


        $sql = "UPDATE `".$table."` SET $values";
        if($where!=="")
        {

            $sql.=" WHERE ".$where;

        }

        //print $sql;
        return mysql_query($sql);

    }



}
?>