<?

class html extends form_item
{
    public $tpl = '<div {item_attr} id="{id}">{html}</div>';

    public function item_special()
    {
        return array('html'=>'');
    }
}
?>