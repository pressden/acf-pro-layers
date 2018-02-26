<?php
/*
Template Name: APL Content
*/

// layer fields
$headline = $layer['headline'];
$headline_tag = ( isset( $layer['headline_tag'] ) && !is_array( $layer['headline_tag'] ) ) ? $layer['headline_tag'] : 'h3';
$wordpress_content = ( isset( $layer['wordpress_content'] ) ) ? $layer['wordpress_content'] : null;
$content = ( $wordpress_content ) ? $layer['wp_content'] : $layer['content'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container ); ?>

	<div class="col">

		<?php
		if( $headline ) {
			echo '<' . $headline_tag . ' class="content-headline">' . $headline . '</' . $headline_tag . '>';
		}

		echo $content;
		?>

	</div>

<?php apl_close_layer(); ?>
