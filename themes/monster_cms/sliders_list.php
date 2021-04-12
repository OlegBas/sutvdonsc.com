<?
$url = '/?module=sliders';
?>

<a href="<?=$url?>&action=add&type=dialog">Добавить слайдер</a>
<br />
<br />
<table class="table">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Размер</th>
        <th></th>
        <th></th>
    </tr>
    <?foreach ($items as $item ):?>
    <tr>
        <td><?=$item['id']?></td>
        <td><a href="<?=$url?>&action=slider_items&id=<?=$item['id']?>&type=dialog"><?=$item['name']?></a></td>
        <td><?=$item['max_width']?>x<?=$item['max_height']?></td>
        <td><a href="<?=$url?>&action=edit&id=<?=$item['id']?>&type=dialog" title="Редактировать"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
        <td><a href="<?=$url?>&action=delete&id=<?=$item['id']?>&type=dialog" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a></td>
    </tr>
    <?endforeach?>
</table>
