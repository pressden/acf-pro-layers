<?php
/*
Template Name: Related Layer
*/

// layer fields
$layer_post = $layer['layer_post'];
$include_wrapper = ( isset( $layer['include_wrapper'] ) ) ? $layer['include_wrapper'] : true;
//$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
//$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

$layers = get_field_object( 'content_layers', $layer_post->ID );

$args = array(
	'include_wrapper' => $include_wrapper,
	'include_column' => $include_wrapper,
);

echo apl_buffer_layers( $layers, null, $args );
