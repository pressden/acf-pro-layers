<?php
/*
Template Name: APL Image
*/

// layer fields
$images = $layer['images'];
$display = $layer['display'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>

  <div class="col-xs-12">
    
    <?php foreach( $images as $image_object ): ?>
      
      <?php
      $image = wp_get_attachment_image( $image_object['ID'], 'post_thumbnail', false, array( 'class' => 'img-responsive center-block' ) );
      ?>
      
      <div class="media-container">
        <?php echo $image; ?>
      </div>
      
    <?php endforeach; ?>
    
    <?php /*
    @TODO:  Implement gallery and slideshow support (module 4) -->
    @CLASSES: .photo-gallery-wrapper .photo-gallery-container .photo-gallery-layer .photo-gallery-block
    @MARKUP: <div class="photo-gallery"><img src="http://placehold.it/1200x500?text=Photo+Gallery+Placeholder"></div>
    */ ?>
    
  </div>

<?php apl_close_layer(); ?>

