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

  <div class="col-xs-12">
    <h1><?php echo $title; ?></h1>
    <h3><?php echo $dek; ?></h3>
  </div>

<?php apl_close_layer(); ?>
