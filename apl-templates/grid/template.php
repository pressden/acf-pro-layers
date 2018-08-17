<?php
/*
Template Name: APL Grid
*/

// layer fields
$items = $layer['items'];
$columns = count( $items );
$breakpoint = ( isset( $layer['breakpoint'] ) && !is_array( $layer['breakpoint'] ) ) ? $layer['breakpoint'] : 'md';
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

// @TODO: Removing the wrapper via 'include_wrapper' checks (like in other layers) results in very unexpected results.
apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );


foreach( $items as $item ) {
	$item_type = ( isset( $item['item_type'] ) ) ? $item['item_type'] : 'content';
	$item_layer_posts = ( isset( $item['layer_posts'] ) ) ? $item['layer_posts'] : null;
	$item_content = ( isset( $item['content'] ) ) ? $item['content'] : null;
	$item_classes = ( isset( $item['item_classes'] ) ) ? $item['item_classes'] : null;
	?>

	<div class="grid-item col-<?php echo $breakpoint; ?> <?php echo $item_classes; ?>">

		<?php
		switch( $item_type ) {
			case 'layer_posts':
				foreach( $item_layer_posts as $item_layer_post ) {
					$layers = get_field_object( 'content_layers', $item_layer_post->ID );

					if( $layers ) {
						// remove the wrapper and column as that will be handled by grid
						$args = array(
							'include_wrapper' => false,
							'include_column' => false,
						);

						echo apl_buffer_layers( $layers, null, $args );
					}
				}
				break;

			default:
				echo $item_content;
				break;
		}
		?>

	</div>

	<?php
}

	apl_close_layer();
