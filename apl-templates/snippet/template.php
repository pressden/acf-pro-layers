<?php
/*
Template Name: APL Snippet
*/

// layer fields
$code = $layer['code'];
$include_wrapper = ( isset( $layer['include_wrapper'] ) ) ? $layer['include_wrapper'] : false;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

if( $include_wrapper && $args['include_wrapper'] ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );
}

echo $code;

if( $include_wrapper && $args['include_wrapper'] ) {
	apl_close_layer();
}
