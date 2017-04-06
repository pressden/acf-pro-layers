<?php
/*
Template Name: APL Related Content
*/

// layer fields
$related_posts = $layer['posts'];
$related_post_count = count( $related_posts );
$column_size = 12 / $related_post_count;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id ); ?>
      
  <div class="<?php echo $layer_name; ?>">
    
    <?php foreach( $related_posts as $related_post ) : ?>
      
      <div class="col-sm-<?php echo $column_size;?>">
        <?php echo $related_post->post_title; ?>
      </div>
      
    <?php endforeach; ?>
      
  </div>
            
<?php apl_close_layer(); ?>
