<?php
/*
Template Name: APL Related Content
*/

// layer fields
$related_posts = $layer['posts'];
$related_post_count = count( $related_posts );
$column_size = 12 / $related_post_count;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes ); ?>
      
  <?php foreach( $related_posts as $related_post ) : ?>
    
    <div class="col-sm-<?php echo $column_size;?>">
      <?php echo $related_post->post_title; ?>
    </div>
    
  <?php endforeach; ?>
            
<?php apl_close_layer(); ?>
