<?
$image_width = (!empty($image)) ? $image_width : 0;
if($image_width > 100) $image_width = 100;

$width_text = 100 - $image_width;

if($image_position != "right") $image_position = 'left';
$text_position = 'right';
if($image_position != "right") $text_position = 'left';

?>

<?if(!empty($image)):?>

    <div class="img" style="width: <?=$image_width?>%;float:<?=$image_position?>;">
        <?if($image_zoom == 1):?><a href="/<?=$conf['widgets']['blockimgtext']['path'].$image?>" target="_blank"><?endif?>
        <img src="/<?=$conf['widgets']['blockimgtext']['path'].$image?>" />
        <?if($image_zoom == 1):?></a><?endif?>
    </div>
<?endif?>
<div class="text" style="width:<?=$width_text?>%;float:<?=$text_position?>">
<h3>
    <?if(!empty($link_url) && empty($link_text)):?><a href="<?=$link_url?>"> <?endif;?>
    <?=$heading;?>
        <?if(!empty($link_url) && empty($link_text)):?><a href="<?=$link_url?>"> <?endif;?>
</h3>

<p>
    <?=lib_MarkdownExtra::defaultTransform($text)?>
    <?if(!empty($link_url) && !empty($link_text)):?>
    <div class="link">
        <a href="<?=$link_url?>"><?=$link_text?></a>
    </div>
    <?endif;?>
    </p>
</div>