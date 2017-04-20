<?php
/*
Template Name: APL Headline
*/

// layer fields
$title = $layer['title'];
$dek = $layer['dek'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>

  <?php if( $title || $dek ): ?>
    
    <div class="col-xs-12">
      
      <?php if( $title ): ?>
        <h1><?php echo $title; ?></h1>
      <?php endif; ?>
      
      <?php if( $dek ): ?>
        <h2><?php echo $dek; ?></h2>
      <?php endif; ?>
      
    </div>
    
  <?php endif; ?>

<?php apl_close_layer(); ?>
