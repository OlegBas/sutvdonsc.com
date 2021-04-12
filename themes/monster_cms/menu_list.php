

<table class="table">

    <?foreach($MENUS as $id=>$name):?>
    <tr><td><a href="/?module=catalog&action=edit&menu=<?=$id?>&type=dialog"><?=$name?></a></td></tr>
    <?endforeach;?>


</table>
