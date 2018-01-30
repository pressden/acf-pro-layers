<?php
/*
Template Name: APL Wrapper
*/

// layer fields
$wrapper_state = $layer['wrapper_state'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

if( $wrapper_state == 'open' ) {
	apl_open_wrapper( $layer_name, $apl_unique_id, $css_classes, $attributes );
}

else {
	apl_close_wrapper();
}
?>
