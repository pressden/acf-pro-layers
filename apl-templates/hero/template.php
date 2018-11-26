<?php
/*
Template Name: APL Hero
*/

// layer fields
$title = $layer['title'];
$excerpt = $layer['excerpt'];
$button_text = $layer['button_text'];
$button_link = $layer['button_link'];
$background_image = $layer['background_image'];
$title_tag = ( isset( $layer['title_tag'] ) && !is_array( $layer['title_tag'] ) ) ? $layer['title_tag'] : 'h1';
$background_video = $layer['background_video_grp'];
$background_video_fallback_img = $background_video['video_fallback_image']['url'];
$background_video_url = $background_video['video_url'];
$background_video_type = $background_video['video_type'];

$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;


if( $args['include_wrapper'] ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );
}

?>

<?php
    $video_fallback_image = '<div class="d-sm-none"><img src="' .$background_video_fallback_img . '"/></div>';
    if ( $background_video_type == 'HTML5' ) {
        $videoLayout = '<video class="d-none d-sm-block d-md-block" width="100%" autoplay muted><source src="' . $background_video_url . '" type="video/mp4"></video>' . $video_fallback_image;
    } else if ( $background_video_type == 'YouTube' ){
        $videoLayout = '<div class="d-none d-sm-block embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="' . $background_video_url . '" allowfullscreen></iframe></div>' . $video_fallback_image;
    }
?>

<div class="hero-col px-0 <?php echo ( $args['include_column'] ) ? 'col' : ''; ?>">
    <div class="hero-image media-container card">

        <?php/* 
            // if ($video_url) {

            } else if () {
                // background image (hero image)
            } else {
                // color picker
            }
        
        
        
        */?>

     <?php
            $background_image_tag = wp_get_attachment_image( $background_image['ID'], 'full-size', false, array( 'class' => 'img-fluid mx-auto d-block card-img', 'style' => 'width: 100%' ) );
            if ( $background_image_tag && !$background_video_url ){
                echo $background_image_tag;
            } else if ( $background_video_url && $background_image_tag ){
                echo $videoLayout;
            } else if ( $background_video_url ) {
                echo $videoLayout;
            }
        ?>     
        <?php if ( $title || $excerpt || $button_link ): ?>
            <div class="hero-info card-img-overlay d-flex justify-content-center align-items-center flex-column">
                <div class="hero-text-inner-container">
                    <?php if ( $title ): ?>
                        <h3 class="hero-title">
                            <?php if( $title ) { echo '<' . $title_tag . '>' . $title . '</' . $title_tag . '>'; } ?>
                        </h3>
                    <?php endif ?>
                    <?php if ( $excerpt ): ?>
                        <div class="hero-excerpt">
                            <p><?php echo $excerpt;?></p>
                        </div>
                    <?php endif ?>
                    <?php if ( $button_link ): ?>
                        <div class="hero-button btn btn-primary">
                            <a href="<?php echo $button_link['url'];?>" class=""><?php echo $button_text; ?></a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>    
    </div>
</div>

<?php
if( $args['include_wrapper'] ) {
	apl_close_layer();
}
