<?php
/*
Template Name: APL Content
*/

// layer fields
$headline = $layer['headline'];
$content = $layer['content'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>

  <div class="col-xs-12">
    
    <?php if( $headline ): ?>
      <h3 class="content-headline"><?php echo $headline; ?></h3>
    <?php endif; ?>

    <?php echo $content; ?>
    
  </div>

<?php apl_close_layer(); ?>
