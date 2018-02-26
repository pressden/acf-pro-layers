<?php
/*
Template Name: APL Headline
*/

// layer fields
$title = $layer['title'];
$title_tag = ( isset( $layer['title_tag'] ) && !is_array( $layer['title_tag'] ) ) ? $layer['title_tag'] : 'h1';
$dek = $layer['dek'];
$dek_tag = ( isset( $layer['dek_tag'] ) && !is_array( $layer['dek_tag'] ) ) ? $layer['dek_tag'] : 'h2';
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container ); ?>

	<?php if( $title || $dek ): ?>

		<div class="col">

			<?php
			if( $title ) {
				echo '<' . $title_tag . '>' . $title . '</' . $title_tag . '>';
			}

			if( $dek ) {
				echo '<' . $dek_tag . '>' . $dek . '</' . $dek_tag . '>';
			}
			?>

		</div>

	<?php endif; ?>

<?php apl_close_layer(); ?>
