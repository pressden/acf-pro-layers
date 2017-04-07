<?php
/*
Template Name: WordPress Content
*/

// layer fields
$content = $layer['content'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>

  <div class="col-xs-12">
    <?php echo $content; ?>
  </div>

<?php apl_close_layer(); ?>
