<?php
/*
Template Name: APL Related Content
*/

// layer fields
$related_posts = $layer['posts'];
$columns = $layer['columns'];
$column_size = 12 / $columns;
$show_titles = $layer['show_titles'];
$show_images = $layer['show_images'];
$show_excerpts = $layer['show_excerpts'];
$show_buttons = $layer['show_buttons'];
$button_text = $layer['button_text'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>
      
  <?php foreach( $related_posts as $related ) : ?>
    
    <?php
    // the post object
    $related_post = ( isset( $related['post'] ) ) ? $related['post'] : null;
    $customize = ( isset( $related['customize'] ) ) ? $related['customize'] : null;
    
    // the post title
    $related_post_title = null;
    
    // the post image
    $related_post_image = null;
    
    // the post excerpt
    $related_post_excerpt = null;
    
    // the post URL
    $related_post_url = null;
    $related_post_external_url = false;
    
    // the CSS classes
    $related_css_classes = null;
    
    // the container
    $related_post_container = 'div';
    
    // get initial values from the post object
    if( $related_post ) {
      $related_post_title = $related_post->post_title;
      $related_post_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_content', $related_post->ID ) );
      $related_post_image = get_the_post_thumbnail( $related_post->ID, 'post_thumbnail', array( 'class' => 'img-fluid rounded mx-auto d-block' ) );
      $related_post_url = get_the_permalink( $related_post );
    }
    
    if( $customize ) {
      $related_post_title = ( $related['title'] ) ? $related['title'] : $related_post_title;
      $related_post_excerpt = ( $related['excerpt'] ) ? apply_filters( 'the_excerpt', $related['excerpt'] ) : $related_post_excerpt;
      $related_post_image = ( $related['image'] ) ? wp_get_attachment_image( $related['image']['ID'], 'post_thumbnail', false, array( 'class' => 'img-fluid rounded mx-auto d-block' ) ) : $related_post_image;
      if( $related['external_url'] ) {
        $related_post_url = $related['external_url'];
        $related_post_external_url = true;
      }
      $related_css_classes = $related['css_classes'];
    }
    
    $related_post_container = ( !$show_buttons && $related_post_url ) ? 'a' : 'div';
    $related_post_href = ( $related_post_url ) ? 'href="' . $related_post_url . '"' : null;
    $related_post_target = ( $related_post_external_url ) ? 'target="_blank"' : null;
    
    ?>
    
    <<?php echo $related_post_container; ?> <?php echo ( $related_post_container == 'a' ) ? $related_post_href . ' ' . $related_post_target : ''; ?> class="related-post <?php echo $related_css_classes; ?> col-sm-<?php echo $column_size; ?>">
      
      <?php if( $show_images && $related_post_image ): ?>
        <div class="related-post-image media-container">
          <?php echo $related_post_image; ?>
        </div>
      <?php endif; ?>
      
      <?php if( $show_titles ): ?>
        <h3 class="related-post-title text-center">
          <?php echo $related_post_title; ?>
        </h3>
      <?php endif; ?>
      
      <?php if( $show_excerpts && $related_post_excerpt ): ?>
        <div class="related-post-excerpt text-center">
          <?php echo $related_post_excerpt; ?>
        </div>
      <?php endif; ?>
      
      <?php if( $show_buttons && $related_post_url ): ?>
        <div class="related-post-button text-center">
          <a <?php echo $related_post_href; ?> <?php echo $related_post_target; ?> class="btn btn-primary">
            <?php echo $button_text; ?>
          </a>
        </div>
      <?php endif; ?>
      
    </<?php echo $related_post_container; ?>>
    
  <?php endforeach; ?>
            
<?php apl_close_layer(); ?>
