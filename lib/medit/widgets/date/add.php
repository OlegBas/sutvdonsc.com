<?
//���� ������ ��������� ��� ������, ��������� ����������
if(!isset($this)) exit();
//��������� ������������ �����

    $element_art = $this->save_element_art($widget, $parameters);

    $element_id = $element_art['id'];
    if($add_in_page) $this->add_element_art_in_page($element_art['id'], $widget, $element_art['cache'] , $element_art['pos']);




?>