

<div class="<?=$css?>" id="sliders_<?=$id?>">
    <?foreach ($items as $item):?>

    <div class="item">
        <?if(!empty($item['link'])) :?>
            <a href="<?=$item['link'];?> " >
        <?endif;?>
        <?if(!empty($item['text'])) :?>
           <div class="slide-text"><?=$item['text']?></div>
        <?endif;?>
        <img src="/<?=$path?>/<?=$item['images']?>" >

        <?if(!empty($item['link'])) :?>
           </a>
        <?endif;?>
        </div>

    <?endforeach?>


</div>
<script>
    $(function() {
        $('#sliders_<?=$id?>').owlCarousel({

            slideSpeed: 200,
            paginationSpeed: 1000,
            singleItem: <?if($show == 1){print "true";}else {print "false";} ?>,
            autoPlay: 5000,
            navigation: <?=$navigation?>,
            pagination: <?=$pagination?>,
            lazyLoad: true,
            items: <?=$show?>

        });
    });
</script>