<?php
/*
Template Name: APL Grid
*/

// layer fields
$items = $layer['items'];
$columns = count( $items );
$breakpoint = ( isset( $layer['breakpoint'] ) && !is_array( $layer['breakpoint'] ) ) ? $layer['breakpoint'] : 'md';
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );

foreach( $items as $item ) {
	$item_content = ( isset( $item['content'] ) ) ? $item['content'] : null;
	$item_classes = ( isset( $item['item_classes'] ) ) ? $item['item_classes'] : null;
	?>

	<div class="grid-item col-<?php echo $breakpoint; ?> <?php echo $item_classes; ?>">

		<?php echo $item_content; ?>

	</div>

	<?php
}
          
apl_close_layer();
