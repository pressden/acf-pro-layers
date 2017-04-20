<?php
/*
Template Name: APL Related Content (Simple)
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
      
  <?php foreach( $related_posts as $related_post ) : ?>
    
    <?php
    $related_post_image = get_the_post_thumbnail( $related_post->ID, 'post_thumbnail', array( 'class' => 'img-responsive center-block related-post-image' ) );
    ?>
    
    <div class="related-post col-sm-<?php echo $column_size; ?>">
      
      <?php if( $show_titles ): ?>
        <h3 class="related-post-title">
          <?php echo $related_post->post_title; ?>
        </h3>
      <?php endif; ?>
      
      <?php if( $show_images && $related_post_image ): ?>
        <div class="related-post-image-container image-container <?php /*content-box-image*/ ?>">
          <?php echo $related_post_image; ?>
        </div>
      <?php endif; ?>
      
      <?php if( $show_excerpts ): ?>
        <div class="related-post-excerpt">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      <?php endif; ?>
      
    </div>
    
  <?php endforeach; ?>
            
<?php apl_close_layer(); ?>




<!--Module 1a (Boxes)-->
<h6>Module 1a (Boxes)</h6>
<section id="%dynamically-generated-id%" class="main-content-area-wrapper layer-wrapper">
    <div class="main-content-area-container layer-container">
        <div class="main-content-area-layer layer row">


            <div class="col-sm-12 col-md-12 col-lg-12 offerings">
                <ul class="col-sm-12 col-md-12 col-lg-12">
                    <li class="content-box content-box-border col-sm-3 col-md-3 col-lg-3">
                        <div class="content-box-image col-sm-12 col-md-12 col-lg-12">
                            <img src="img/program-icons/programs-icons-9.png">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </li>
                    <li class="content-box content-box-border col-sm-3 col-md-3 col-lg-3">
                        <div class="content-box-image col-sm-12 col-md-12 col-lg-12">
                            <img src="img/program-icons/programs-icons-9.png">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </li>
                    <li class="content-box content-box-border col-sm-3 col-md-3 col-lg-3">
                        <div class="content-box-image col-sm-12 col-md-12 col-lg-12">
                            <img src="img/program-icons/programs-icons-9.png">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </li>
                    <li class="content-box content-box-border col-sm-3 col-md-3 col-lg-3">
                        <div class="content-box-image col-sm-12 col-md-12 col-lg-12">
                            <img src="img/program-icons/programs-icons-10.png">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div> <!-- .prefix-layer layer -->
    </div> <!-- .prefix-container layer-container -->
</section> <!-- #prefix-wrapper layer-wrapper -->