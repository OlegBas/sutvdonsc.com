<?

class submit extends form_item
{
    public $tpl = '<p class="submit"><br /><br /><label for="{id}"></label> {input}</p>';


    public function item_default()
    {
        return array
        (

            'class'        => 'btn btn-primary',

            'tpl'          => $this->tpl,

            /* HTML 5 */
            'autofocus'    => false,
            'autocomplete' => true,
            'placeholder'  => '',
            'min'  => '',
            'max'  => '',


        );
    }
}
?>