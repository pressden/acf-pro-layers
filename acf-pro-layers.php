<?php
/*
Plugin Name: ACF Pro Layers
Plugin URI: https://github.com/pressden/acf-pro-layers
Description: ACF Pro Layers (APL) is a WordPress plugin that extends ACF Pro with pre-defined content modules for complex page layouts.
Version: 1.0.0
Author: D.S. Webster
Author URI: http://pressden.com/
License: GPLv2 or later
Text Domain: acf_pro_layers
*/

add_filter( 'the_content', 'apl_content_layers_filter' );
function apl_content_layers_filter( $content ) {
	// only hook the content on the main query of pages and posts
	if( !is_page() && !is_singular( 'post' ) || !is_main_query() ) {
		return $content;
	}
	
	// get the layers field from ACF
	$layers = get_field_object( 'content_layers' );

	// initialize the output variable
	$output = '';

	// if there are no layers wrap the WordPress content in APL markup for consistency
	if( !$layers || ( isset( $layers['value'] ) && !$layers['value'] ) ) {
		$layers['value'] = array(
			0 => array(
				'acf_fc_layout' => 'content',
				'content' => $content,
			),
		);
	}

	foreach( $layers['value'] as $key => $layer ) {
		// layer_name
		$layer_name = str_replace( '_', '-', $layer['acf_fc_layout'] );

		// @DEPRECATION WARNING: The WordPress Content layer has been removed. The Content layer
		// now includes a toggle to embed WordPress content instead of custom content. The line
		// below provides backwards compatibility to existing WordPress Content layers.
		$layer_name = ( $layer_name == 'wordpress_content' ) ? 'content' : $layer_name;

		// store the layer name for later use
		$layer['apl-layer-name'] = $layer_name;

		// generate a unique ID for direct targeting
		$layer['apl-unique-id'] = 'apl-content-' . $key++ . '-' . $layer_name;

		// make wordpress content available to APL so it can be inserted as needed
		if( $layer_name == 'wordpress-content' || $layer_name == 'content' )
		{
			$layer['wp_content'] = $content;
		}

		// get the template
		$template = apl_get_template( $layer_name );

		// buffer the template content
		$output .= apl_get_template_buffer( $template, $layer );
	}

	return $output;
}

// BEGIN Layer markup helpers
function apl_get_open_layer( $layer_name, $layer_id, $css_classes = null, $attributes = null, $container = 'container' ) {
	$output = '
		<section id="' . $layer_id . '" class="' . $layer_name . '-wrap layer-wrap ' . $css_classes . '" ' . get_attributes($attributes) . '>
			<div class="' . $container . ' ' . $layer_name . '-container">
				<div class="' . $layer_name . '-layer layer row">
	';

	return $output;
}

function apl_open_layer( $layer_name, $layer_id, $css_classes = null, $attributes = null, $container = 'container' ) {
	echo apl_get_open_layer( $layer_name, $layer_id, $css_classes, $attributes, $container );
}

function apl_get_close_layer() {
	$output = '
				</div>
			</div>
		</section>
	';

	return $output;
}

function apl_close_layer() {
	echo apl_get_close_layer();
}
// END Layer markup helpers

// BEGIN Wrapper markup helpers
function apl_get_open_wrapper( $layer_name, $layer_id, $css_classes = null, $attributes = null ) {
	$output = '<section id="' . $layer_id . '" class="' . $layer_name . '-wrap custom-wrap ' . $css_classes . '" ' . get_attributes($attributes) . '>';

	return $output;
}

function apl_open_wrapper( $layer_name, $layer_id, $css_classes = null, $attributes = null ) {
	echo apl_get_open_wrapper( $layer_name, $layer_id, $css_classes, $attributes );
}

function apl_get_close_wrapper() {
	$output = '</section>';

	return $output;
}

function apl_close_wrapper() {
	echo apl_get_close_wrapper();
}
// END Wrapper markup helpers

function get_attributes( $attributes ) {
	$output = '';

	if( !is_array( $attributes ) ) {
		return $output;
	}

	foreach ( $attributes as $key => $attribute ) {
		$output .= $attribute['attribute'] . '="' . $attribute['value'] . '" ';
	}

	return $output;
}

function apl_get_template( $layer_name ) {
	$path = 'apl-templates/' . $layer_name . '/template.php';

	$template = null;

	if( is_file( get_stylesheet_directory() . '/' . $path ) ) {
		$template = get_stylesheet_directory() . '/' . $path;
	}
	else if( is_file( get_template_directory() . '/' . $path ) ) {
		$template = get_template_directory() . '/' . $path;
	}
	else if( is_file( plugin_dir_path( __FILE__ ) . $path ) ) {
		$template = plugin_dir_path( __FILE__ ) . $path;
	}

	return $template;
}

function apl_get_template_buffer( $template, $layer ) {
	if( is_file( $template ) ) {
		// define required template variables
		$apl_unique_id = $layer['apl-unique-id'];
		$layer_name = $layer['apl-layer-name'];

		ob_start();
		include $template;
		return ob_get_clean();
	}

	return null;
}
