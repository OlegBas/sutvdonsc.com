<?
class select_tree extends form_item
{
    private $tree = '';

    public function item_special()
    {
        return array
        (
            'table'          => '',
            'parent_row'     => '',
            'where'          => '',
            'prefix'         => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            'order_by'       => '',
            'id_row'         => '',
            'text_row'       => '',
            'root'           => true,
            'root_name'      => 'Корень',
            'root_value'      => 0,
            'value'           => 0
        );
    }

    public function __toString()
    {
        $it = $this->item;
        $input  = '<select ';
        $input .= 'id="'.$it['id'].'" ';

        if(!empty($it['name']))       $input .= 'name="'.$it['name'].'" ';
        if(!empty($it['style']))      $input .= 'style="'.$it['style'].'" ';
        if($it['autofocus'])          $input .= 'autofocus ';
        if(!empty($it['attributes'])) $input .= $this->attributes($it['attributes']);
        $input  .= '>';

        if($it['root'])
        {
            $input  .= "<option value='" . $it['root_value'] . "'";
            if($it['value'] == $it['root_value']) $input  .= " selected";
            $input  .= " >" . $it['root_name'] . "</option>";
            $input  .= $this->tree(0, $it['prefix']);
        }
        else $input  .= $this->tree(0);


        /*
        foreach($it['options'] as $key => $value)
        {
            $input  .= '<option ';
            $input  .= 'value="'.$key.'" ';
            if($it['value'] == $key) $input  .= 'selected ';
            $input  .= '>';
            $input  .= $value;
            $input .='</option>';
        }
        */

        $input .='</select>';
        $this->item['input'] = $input;

        return $this->template($it['tpl'], $this->item );
    }


    private function sql($parent)
    {
        $it = $this->item;

        $sql = "SELECT * FROM ".$it['table']." WHERE ".$it['parent_row']." = '".intval($parent)."'";
        if(!empty($it['where']))     $sql .= ' AND ' . $it['where'];
        if(!empty($it['order_by']))  $sql .= ' ORDER BY '.$it['order_by'];

        return $sql;
    }


    private function tree($parent_id = 0, $prefix = null)
    {
        $it = $this->item;
        $query = $this->sql($parent_id);

        $result = mysql_query($query);

        while ($row = mysql_fetch_array($result))
        {

            $this->tree .= "<option value=\"".$row[$it['id_row']]."\" ";
            if($it['value'] == $row[$it['id_row']]) $this->tree .= "selected";
            $this->tree .= " >".$prefix.$row[$it['text_row']]."</option>";
            $this->tree($row[$it['id_row']], $prefix.$it['prefix']);

        }

        return $this->tree;
    }



}
?>