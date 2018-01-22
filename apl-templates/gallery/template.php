<?php
/*
Template Name: APL Gallery
*/

// layer fields
$images = $layer['images'];
$columns = $layer['columns'];
$size = ( in_array( $layer['size'], get_intermediate_image_sizes() ) || $layer['size'] == 'full' ) ? $layer['size'] : 'thumbnail';
$show_titles = $layer['show_titles'];
$show_captions = $layer['show_captions'];
$layout = $layer['layout'];
$link_to = $layer['link_to'];
$image_classes = ( isset( $layer['image_classes'] ) ) ? $layer['image_classes'] : null;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
// default media container
$media_container = 'a';

// default media classes
$media_classes = null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes, 'gallery gallery-columns-' . $columns, $attributes  ); ?>

	<?php
	switch( $layout ) {
		case 'carousel':
			include( 'layout/carousel.php' );
		break;

		case 'gallery':
			include( 'layout/gallery.php' );
		break;

		case 'slider':
			include( 'layout/slider.php' );
		break;

		case 'slider-carousel':
			include( 'layout/slider.php' );
			include( 'layout/carousel.php' );
		break;

		case 'slider-gallery':
			include( 'layout/slider.php' );
			include( 'layout/gallery.php' );
		break;

		default:
		// nothing to do here
		break;
	}
	?>

<?php apl_close_layer(); ?>
