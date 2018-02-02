<?php
/*
Template Name: APL Related Content
*/

// layer fields
$related_posts = $layer['posts'];
$layout = ( isset( $layer['layout'] ) ) ? $layer['layout'] : 'grid';
$columns = $layer['columns'];
$column_size = 12 / $columns;
$show_titles = $layer['show_titles'];
$show_images = $layer['show_images'];
$show_excerpts = $layer['show_excerpts'];
$show_buttons = $layer['show_buttons'];
$button_text = $layer['button_text'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes );

switch( $layout ) {
	case 'carousel':
	case 'grid':
	case 'slider':
		include( 'layout/' . $layout . '.php' );
	break;

	// catch all in case an invalid layout is requested
	default:
		include( 'layout/grid.php' );
	break;
}
            
apl_close_layer();
