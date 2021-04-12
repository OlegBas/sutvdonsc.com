<?
$url = '/?module=sliders';
$name = $slider_info->name;
?>

<a href="<?=$url?>&action=list&type=dialog">Слайдеры</a> / <?=$name?>
<br />
<br />
<a href="<?=$url?>&action=slider_item_add&slider_id=<?=$slider_id?>&type=dialog">Добавить слайд</a>

<table class="table">
    <tr>
        <th>поз.</th>
        <th>Картинка</th>
        <th>Текст</th>
        <th>Ссылка</th>
        <th></th>
        <th></th>
    </tr>
    <?foreach ($items as $item ):?>
        <tr>
            <td><?=$item['pos']?></td>
            <td><img src="/<?=$path?>/<?=$item['images']?>" width="100"></td>
            <td><?=$item['text']?></td>
            <td><?=$item['link']?></td>
            <td><a href="<?=$url?>&action=slider_item_edit&id=<?=$item['id']?>&slider_id=<?=$slider_id?>&type=dialog" title="Редактировать"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            <td><a href="<?=$url?>&action=slider_item_delete&id=<?=$item['id']?>&slider_id=<?=$slider_id?>&type=dialog" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a></td>
        </tr>
    <?endforeach?>
</table>
