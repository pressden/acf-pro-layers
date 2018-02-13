<?php
/*
Template Name: APL Snippet
*/

// layer fields
$code = $layer['code'];
$include_wrapper = ( isset( $layer['include_wrapper'] ) ) ? $layer['include_wrapper'] : null;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

if( $include_wrapper ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes );
}

echo $code;

if( $include_wrapper ) {
	apl_close_layer();
}
