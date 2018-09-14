<?php
/*
Template Name: APL Image
*/

// layer fields
$image = $layer['image'];
$link = $layer['link'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

if( $args['include_wrapper'] ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );
}
?>

<div class="image-col <?php echo ( $args['include_column'] ) ? 'col' : ''; ?>">

	<?php
	$image_tag = wp_get_attachment_image( $image['ID'], 'full-size', false, array( 'class' => 'img-fluid mx-auto d-block' ) );
	?>

	<div class="media-container">

		<?php
		if( $link ) {
			$link_title = ( $link['title'] ) ? 'title="' . $link['title'] . '"' : null;
			$link_target = ( $link['target'] ) ? 'target="' . $link['target'] . '"' : null;

			echo '<a href="' . $link['url'] . '" ' . $link_title . ' ' . $link_target . '>';
		}

		echo $image_tag;

		if( $link ) {
			echo '</a>';
		}
		?>

	</div>

</div>

<?php
if( $args['include_wrapper'] ) {
	apl_close_layer();
}
