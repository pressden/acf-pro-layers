<?php
/*
Template Name: APL Related Content
*/

// layer fields
$related_posts = $layer['posts'];
$layout = ( isset( $layer['layout'] ) ) ? $layer['layout'] : 'grid';
$columns = ( isset( $layer['columns'] ) && !is_array( $layer['columns'] ) ) ? $layer['columns'] : 3;
$column_size = 12 / $columns;
$show_titles = $layer['show_titles'];
$title_tag = ( isset( $layer['title_tag'] ) && !is_array( $layer['title_tag'] ) ) ? $layer['title_tag'] : 'h3';
$show_images = $layer['show_images'];
$show_excerpts = $layer['show_excerpts'];
$show_buttons = $layer['show_buttons'];
$button_text = $layer['button_text'];
$button_classes = ( isset( $layer['button_classes'] ) ) ? $layer['button_classes'] : null;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

// count is required for some templates
$count = 0;

apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );

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
