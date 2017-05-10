<?php
/*
Template Name: APL Image
*/

// layer fields
$image = $layer['image'];
$link = $layer['link'];
$external_url = ( isset( $layer['external_url'] ) ) ? 'target="_blank"' : null;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>

  <div class="col-xs-12">
    
    <?php
    $image_tag = wp_get_attachment_image( $image['ID'], 'post_thumbnail', false, array( 'class' => 'img-responsive center-block' ) );
    ?>
    
    <div class="media-container">
      <a href="<?php echo $link; ?>" <?php echo $external_url; ?>>
        <?php echo $image_tag; ?>
      </a>
    </div>
    
  </div>

<?php apl_close_layer(); ?>
