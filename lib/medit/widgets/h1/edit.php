<?
//���� ������ ��������� ��� ������, ��������� ����������
if(!isset($this)) exit();
//��������� ������������ �����
if(empty($_POST['heading']))
{
    $this->form_error("heading","�� ��������� ����");
}
else
{


    $element_art = $this->save_element_art($widget, $parameters, $element_art_id);

    $this->update_element_art_in_page($element_art['id'], $widget, $element_art['cache']);

}


?>