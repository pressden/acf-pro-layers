<?php
// the post object
$related_post = ( isset( $related['post'] ) ) ? $related['post'] : null;

// the post title
$related_post_title = null;

// the post image
$related_post_image = null;

// the post excerpt
$related_post_excerpt = null;

// the post URL
$related_post_url = null;
$related_post_external_url = false;

// the CSS classes
$related_css_classes = null;

// get initial values from the post object
if( $related_post ) {
	$related_post_title = $related_post->post_title;
	$related_post_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_content', $related_post->ID ) );
	$related_post_image = get_the_post_thumbnail( $related_post->ID, 'post_thumbnail', array( 'class' => 'img-fluid mx-auto d-block' ) );
	$related_post_url = get_the_permalink( $related_post );
}

$related_post_title = ( $related['title'] ) ? $related['title'] : $related_post_title;
$related_post_excerpt = ( $related['excerpt'] ) ? apply_filters( 'the_excerpt', $related['excerpt'] ) : $related_post_excerpt;
$related_post_image = ( $related['image'] ) ? wp_get_attachment_image( $related['image']['ID'], 'post_thumbnail', false, array( 'class' => 'img-fluid mx-auto d-block' ) ) : $related_post_image;
$related_post_button_text = ( $related['button_text'] ) ? $related['button_text'] : $button_text;
$related_post_button_classes = ( $related['button_classes'] ) ? $related['button_class'] : $button_classes;
if( $related['external_url'] ) {
	$related_post_url = $related['external_url'];
	$related_post_external_url = true;
}
$related_css_classes = $related['css_classes'];

// combine all common, layout related and custom classes
// common classes
$related_classes = 'related-post';

// layout related classes
switch( $layout ) {
	case 'slider':
		$related_classes.= ' carousel-item';
		$related_classes.= ( $count == 0 ) ? ' active' : '';
	break;

	case 'grid':
	default:
		$related_classes.= ' col-sm-' . $column_size;
	break;
}

// custom classes
$related_classes.= ' ' . $related_css_classes;

$related_post_href = ( $related_post_url ) ? 'href="' . $related_post_url . '"' : null;
$related_post_target = ( $related_post_external_url ) ? 'target="_blank"' : null;
$related_post_anchor_open = ( $related_post_href ) ? '<a ' . $related_post_href . ' ' . $related_post_target . '>' : '';
$related_post_anchor_close = ( $related_post_href ) ? '</a>' : '';
$related_post_button_open = ( $related_post_href ) ? '<a ' . $related_post_href . ' class="' . $related_post_button_classes . '" ' . $related_post_target . '>' : '';
$related_post_button_close = ( $related_post_href ) ? '</a>' : '';
?>

<div class="<?php echo $related_classes; ?>">

	<?php if( $show_images && $related_post_image ): ?>
		<div class="related-post-image media-container">
			<?php echo $related_post_anchor_open; ?>
			<?php echo $related_post_image; ?>
			<?php echo $related_post_anchor_close; ?>
		</div>
	<?php endif; ?>

	<?php if( $show_titles || $show_excerpts || $show_buttoms ): ?>
		<div class="related-post-info">
	<?php endif; ?>

		<?php if( $show_titles ): ?>
			<<?php echo $title_tag; ?> class="related-post-title">
				<?php echo $related_post_anchor_open; ?>
				<?php echo $related_post_title; ?>
				<?php echo $related_post_anchor_close; ?>
			</<?php echo $title_tag; ?>>
		<?php endif; ?>

		<?php if( $show_excerpts && $related_post_excerpt ): ?>
			<div class="related-post-excerpt">
				<?php echo $related_post_excerpt; ?>
			</div>
		<?php endif; ?>

		<?php if( $show_buttons && $related_post_url ): ?>
			<div class="related-post-button">
				<?php echo $related_post_button_open; ?>
				<?php echo $related_post_button_text; ?>
				<?php echo $related_post_button_close; ?>
			</div>
		<?php endif; ?>

	<?php if( $show_titles || $show_excerpts || $show_buttoms ): ?>
		</div>
	<?php endif; ?>

</div>

<?php $count++; ?>
