<!DOCTYPE html>
<html lang="ru">
  <head>
      <base href="<?=$BASE;?>" />
    <?php include $THEME_PATH."head_part.php" ?>

	<?=$HEAD;?>
    <?=$CSS?>
  </head>
  <body>

    <?=$ADMIN_TOOLS?>



    <?php include $THEME_PATH."modal_info.html" ?>

    <?php include $THEME_PATH."top_block_part.html" ?>
    <div class="container slides">
      <div id="slides">
<?
print $SLIDERS->view(5, "base-slider owl-carousel owl-theme");
?>
      </div>
    </div>


    <?php include $THEME_PATH."menu_part.php" ?>

    <div class="main_block">
      <?php include $THEME_PATH."main_block_left_part.php" ?>

      <?php include $THEME_PATH."main_block_center_part.html" ?>


      <?php include $THEME_PATH."main_block_right_part.php" ?>
    </div>

    <?php include $THEME_PATH."bottom_part.php" ?>
    <?=$JS;?>
    <?php include $THEME_PATH."js_part.html" ?>



    <script type="text/javascript" src="//vk.com/js/api/openapi.js?144"></script>

<!--    <!-- VK Widget -->-->
<!--    <div id="vk_community_messages"></div>-->
<!--    <script type="text/javascript">-->
<!--        VK.Widgets.CommunityMessages("vk_community_messages", 31007147, {expanded: "1",tooltipButtonText: "Мы можем Вам чем-то помочь?"});-->
<!--    </script>-->
  </body>
</html>
