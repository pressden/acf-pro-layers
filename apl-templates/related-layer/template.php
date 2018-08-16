<?php
/*
Template Name: Related Layer
*/

// layer fields
$layer_post = $layer['layer_post'];
//$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
//$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

$layers = get_field_object( 'content_layers', $layer_post->ID );

echo apl_buffer_layers( $layers );
