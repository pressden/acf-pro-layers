<?php
/*
Template Name: Content
*/

// layer fields
$content = $layer['content'];
?>

<?php apl_open_layer( $layer_name, $apl_unique_id ); ?>

  <div class="col-xs-12 <?php echo $layer_name; ?>">
    <?php echo $content; ?>
  </div>

<?php apl_close_layer(); ?>
