<?php
/*
Template Name: APL Gallery
*/

// layer fields
$images = $layer['images'];
$columns = $layer['columns'];
$column_size = 12 / $columns;
$size = ( in_array( $layer['size'], get_intermediate_image_sizes() ) ) ? $layer['size'] : 'thumbnail';
$link_to = $layer['link_to'];
$image_classes = ( isset( $layer['image_classes'] ) ) ? $layer['image_classes'] : null;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;

// default media container
$media_container = 'a';

// default media classes
$media_classes = null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>

  <?php foreach( $images as $image_object ): ?>
    
    <div class="gallery-item col-sm-<?php echo $column_size; ?>">
    
      <?php
      // full image tag
      $image = wp_get_attachment_image( $image_object['ID'], $size, false, array( 'class' => 'img-responsive center-block ' . $image_classes ) );
      
      // default media link
      $media_href = $image_object['url'];
      
      // modify media defaults based on the link to behavior
      switch( $link_to ) {
        case 'Media Page':
          $media_href = get_the_permalink( $image_object['ID'] );
        break;
        
        case 'Full Size Image':
        break;
        
        case 'No Links':
          $media_href = null;
        break;
          
        // Shadowbox default behavior
        default:
          $media_classes = 'thickbox';
        break;
      }
      
      // if we have a URL wrap markup around it
      $media_href = ( $media_href ) ? 'href="' . $media_href . '"' : null;
      ?>

      <<?php echo $media_container; ?> <?php echo $media_href; ?> class="media-container <?php echo $media_classes; ?>">

        <?php echo $image; ?>

      </<?php echo $media_container; ?>>
    
    </div>
      
  <?php endforeach; ?>

<?php apl_close_layer(); ?>
