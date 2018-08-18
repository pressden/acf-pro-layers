<?php
/*
Template Name: APL Layout
*/

// layer fields
$items = $layer['items'];
$columns = count( $items );
// @TODO: Change how "Breakpoint" works with a "none" or "custom" option (allowing the "CSS Classes" to do all the work)
$breakpoint = ( isset( $layer['breakpoint'] ) && !is_array( $layer['breakpoint'] ) ) ? $layer['breakpoint'] : 'lg';
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

// @TODO: Removing the wrapper via 'include_wrapper' checks (like in other layers) yields unexpected results.
apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );

foreach( $items as $item ) {
	$item_type = ( isset( $item['item_type'] ) ) ? $item['item_type'] : 'content';
	$item_layers = ( isset( $item['content_layers'] ) ) ? $item['content_layers'] : null;
	$item_layer_posts = ( isset( $item['layer_posts'] ) ) ? $item['layer_posts'] : null;
	$item_content = ( isset( $item['content'] ) ) ? $item['content'] : null;
	$item_classes = ( isset( $item['item_classes'] ) ) ? $item['item_classes'] : null;
	?>

	<div class="layout-item-col col-<?php echo $breakpoint; ?> <?php echo $item_classes; ?>">
		<div class="layout-item">
			
			<?php
			if( $item_layers ) {
				// create a layers array with the expected structure
				$layers = array( 'value' => $item_layers );

				// remove the wrapper and column as that will be handled by layout
				$args = array(
					'include_wrapper' => false,
					'include_column' => false,
				);

				echo apl_buffer_layers( $layers, null, $args );
			}
			?>

		</div>
	</div>

	<?php
}

apl_close_layer();
