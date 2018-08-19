<?php
/*
Template Name: APL Content
*/

// @TODO: Determine if the $content parameter passed in via apl_buffer_layers() is necessary given the get_queried_object() call below

// layer fields
$wordpress_content = ( isset( $layer['wordpress_content'] ) ) ? $layer['wordpress_content'] : null;
$content = $layer['content'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

// conditionally override $content with content from the WordPress editor
if( $wordpress_content ) {
	// if WordPress content was passed via $layer, use it
	if( isset( $layer['wp_content'] ) && !empty( $layer['wp_content'] ) ) {
		$content = $layer['wp_content'];
	}
	// otherwise retrieve it
	else {
		$post = get_queried_object();

		// temporarily remove 'apl_content_layers_filter' to prevent an infinite loop
		remove_filter( 'the_content', 'apl_content_layers_filter' );

		$content = apply_filters( 'the_content', $post->post_content );

		// add 'apl_content_layers_filter' back into the mix
		add_filter( 'the_content', 'apl_content_layers_filter' );
	}
}

// @TODO: Determine how to handle cases where $content is still empty at this point. Perhaps an admin check to display a notice to admins.

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
