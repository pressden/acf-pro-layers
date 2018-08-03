<?php
// the post object
$related_post = ( isset( $related['post'] ) ) ? $related['post'] : null;

// the post title
$related_post_title = null;

// the post image
$related_post_image = null;

// the post icon
$related_post_icon = null;

// the post excerpt
$related_post_excerpt = null;
$is_excerpt_truncated = false;

// the post URL
$related_post_url = null;
$related_post_external_url = false;

// the CSS classes
$related_css_classes = null;

// get initial values from the post object
if( $related_post ) {
	$related_post_title = $related_post->post_title;

	if( $show_excerpts ) {
		// @TODO: check for a better way to get the excerpt or an exerpt of the content ( i.e. get_the_excerpt() vs. apply_filters() )

		// get the excerpt if one exists
		if( has_excerpt( $related_post->ID ) ) {
			$related_post_excerpt = get_post_field( 'post_excerpt', $related_post->ID );
		}
		// otherwise fallback to genesis settings for content excerpts
		else if( 'excerpts' === genesis_get_option( 'content_archive' ) ) {
			// get the post content
			$related_post_excerpt = get_post_field( 'post_content', $related_post->ID );

			// strip tags and shortcodes so the content truncation count is done correctly
			$related_post_excerpt = strip_tags( strip_shortcodes( $related_post_excerpt ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

			// remove inline styles / scripts
			$related_post_excerpt = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $related_post_excerpt ) );

			// truncate content to the content archive limit
			$related_post_excerpt = genesis_truncate_phrase( $related_post_excerpt, (int) genesis_get_option( 'content_archive_limit' ) );
			$is_excerpt_truncated = true;
		}
		// if the excerpt is still empty get the content instead
		else {
			$related_post_excerpt = get_post_field( 'post_content', $related_post->ID );
		}
	}

	$related_post_image = get_the_post_thumbnail( $related_post->ID, 'post_thumbnail', array( 'class' => 'img-fluid mx-auto d-block' ) );
	$related_post_url = get_the_permalink( $related_post );
}

$related_post_title = ( $related['title'] ) ? $related['title'] : $related_post_title;
$related_post_excerpt = ( $related['excerpt'] ) ? $related['excerpt'] : $related_post_excerpt;
$is_excerpt_truncated = ( $related['excerpt'] ) ? false : $is_excerpt_truncated; // manually entered excerpts are never truncated
// @TODO: explore options for lazy loading images (especially slider images) - e.g. https://coderwall.com/p/6qaeya/lazy-carousel-in-bootstrap
$related_post_image = ( $related['image'] ) ? wp_get_attachment_image( $related['image']['ID'], 'post_thumbnail', false, array( 'class' => 'img-fluid mx-auto d-block' ) ) : $related_post_image;
$related_post_icon = ( $related['icon'] ) ? '<i class="material-icons">' . $related['icon'] . '</i>' : null;
$related_post_button_text = ( $related['button_text'] ) ? $related['button_text'] : $button_text;
$related_post_button_classes = ( $related['button_classes'] ) ? $related['button_class'] : $button_classes;
if( $related['link'] ) {
	$related_post_link = $related['link'];
	$related_post_url = $related_post_link['url'];
	$related_post_target = $related_post_link['target'];
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
$related_post_target = ( $related_post_target == '_blank' ) ? 'target="' . $related_post_target . '"' : null;
$related_post_anchor_open = ( $related_post_href ) ? '<a ' . $related_post_href . ' ' . $related_post_target . '>' : '';
$related_post_anchor_close = ( $related_post_href ) ? '</a>' : '';
$related_post_button_open = ( $related_post_href ) ? '<a ' . $related_post_href . ' class="' . $related_post_button_classes . '" ' . $related_post_target . '>' : '';
$related_post_button_close = ( $related_post_href ) ? '</a>' : '';
?>

<div class="<?php echo $related_classes; ?>">

	<?php if( $show_images && ( $related_post_image || $related_post_icon ) ): ?>
		<div class="related-post-image media-container">
			<?php echo $related_post_anchor_open; ?>
			<?php echo ( $related_post_icon ) ? $related_post_icon : $related_post_image; ?>
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

				<?php
				if( $is_excerpt_truncated ) {
					// add ellipis
					$ellipsis_link = ' ... ';
					// add a read more link if buttons are turned off
					$ellipsis_link.= ( !$show_buttons ) ? $related_post_anchor_open . $related_post_button_text . $related_post_anchor_close : '';
				}

				echo apply_filters( 'the_excerpt', $related_post_excerpt . $ellipsis_link );
				?>

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
