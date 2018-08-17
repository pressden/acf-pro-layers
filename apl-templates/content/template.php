<?php
/*
Template Name: APL Content
*/

// layer fields
$wordpress_content = ( isset( $layer['wordpress_content'] ) ) ? $layer['wordpress_content'] : null;
$content = ( $wordpress_content ) ? $layer['wp_content'] : $layer['content'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
?>

<?php
if( $args['include_wrapper'] ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );
}
?>

<div class="content-col <?php echo ( $args['include_column'] ) ? 'col' : ''; ?>">

	<?php echo $content; ?>

</div>

<?php
if( $args['include_wrapper'] ) {
	apl_close_layer();
}
