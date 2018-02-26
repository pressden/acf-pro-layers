<?php
/*
Template Name: APL Image
*/

// layer fields
$image = $layer['image'];
$link = $layer['link'];
$external_url = ( isset( $layer['external_url'] ) ) ? 'target="_blank"' : null;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container ); ?>

	<div class="col">

		<?php
		$image_tag = wp_get_attachment_image( $image['ID'], 'full-size', false, array( 'class' => 'img-fluid mx-auto d-block' ) );
		?>

		<div class="media-container">
			<a href="<?php echo $link; ?>" <?php echo $external_url; ?>>
				<?php echo $image_tag; ?>
			</a>
		</div>

	</div>

<?php apl_close_layer(); ?>
