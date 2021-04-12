<?
class multiline_start extends form_item
{


    public $default_grup = array('tpl'=>
                                 '
                                 <td  ><div {item_attr}> {label} {input}
                                 <span id="error_{id}">{error}</span></div></td>');



    public $javascript = array
    (
        "rowsInput.jquery.js"
    );



    public function __toString()
    {

        $it = $this->item;

        $html = '<div ';


        if(!empty($it['class'])) $html .='class="'.$it['class'].'" ';
        if(!empty($it['style'])) $html .='style="'.$it['style'].'" ';
        if(!empty($it['id']))    $html .='id="'.$it['id'].'" ';

        $html .= '>';

        /*
        $html .= '<script>
            $(function (){$("#multiline'.$it['id'].'").rowsInput();});
            </script>';
        */
        $html .= '<label >'.$it['label'].'</label>';
        $html .= '<table><tbody id="multiline'.$it['id'].'"> <tr>';


        if (!empty($_REQUEST[$it['name']])) {
            return $html;
        }

        $val = '';

        if (!empty($it['db'])    &&
            is_object($it['db']) &&
            !empty($it['sql'])   &&
            is_array($it['cols_name'])
        ) {
            $val =  $this->getInputDb($it['db'], $it['sql'], $it['cols_name']);
        }

        lib_javascript::add('$("#multiline'.$this->item['id'].'").rowsInput('.$val.');');






        return $html;
    }



    /**
     * Настройки элемента формы по умолчанию
     */

    public function item_default()
    {
        return array
        (
            'attributes'   => array(),
            'style'        => '',
            'class'        => ''
        );
    }


    private function getInput($value)
    {
        $out = '';
        $max = 0;

        foreach ($this->item['items'] as $item) {
            $colsName[] = preg_replace('/^[a-z0-9_-]*\[([a-z0-9_-]*)].*/',
                '$1', $item['name']);
        }
        foreach ($value as $key => $val) {
            if (sizeof($val) > $max) {
                $max = sizeof($val);
            }
        }



        for ($i=0; $i < $max; $i++) {
            $list ="";

            for ($j=0; $j < sizeof($colsName); $j++) {

                $val = '';

                if(isset($value[$colsName[$j]][$i])) {
                    $val = $value[$colsName[$j]][$i];
                }

                //$val = str_replace('"','&quot;', $val);
                $val = str_replace("'",'&#039;', $val);

                $list .= '"'.$val.'",';
            }

            $list = trim($list, ',');
            $out .= '['.$list.'],';
        }

        $out = trim($out, ',');
        $out = '['.$out.']';

        return $out;
    }

    static public function getInputDb($db, $sql, $colsName = array())
    {
        $out = '';

        $result = $db->query($sql);

        while ($row = $db->fetch_array($result)) {
            $list ="";

            foreach ($colsName as $key => $values) {
                //$key = str_replace("%", "", $key);
                $val = str_replace('"','&quot;', $row[$values]);
                $val = str_replace("'",'&#039;', $val);
                $list .= '"'.$val.'",';

            }
            $list = trim($list, ',');


            $out .= '['.$list.'],';
        }
        $out = trim($out, ',');
        $out = '['.$out.']';

        return $out;

    }

    public function setValue($value)
    {
        $this->item['value'] = $value;

        lib_javascript::add('$("#multiline'.$this->item['id'].'").rowsInput('.
            $this->getInput($value).');');


    }
}
