<?
class multiline_end extends form_item
{

    public function __toString()
    {
        $it = $this->item;
        $html = '<td>
            <input type="button" value="+" class="addbut">
            <input type="button" value="-" class="addbut">

        </td></tr></tbody></table></div>';
        return $html;
    }


}
?>