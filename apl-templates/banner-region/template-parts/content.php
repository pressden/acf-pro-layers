<?php
// the post object
$related_post = ( isset( $related['banner'] ) ) ? $related['banner'] : null;

// the post title
$related_post_title = null;

// the post image
$related_post_image = null;

// the post URL
$related_post_url = null;

// the CSS classes
$related_css_classes = null;

// get initial values from the post object
if( $related_post ) {
	$related_post_link = get_field( 'link', $related_post->ID );
	$related_post_title = $related_post_link['link_text'];
	$related_post_url = $related_post_link['url'];
	$related_post_target = $related_post_link['target'];
	$related_post_no_follow = get_field( 'no_follow', $related_post->ID );

	// @TODO: explore options for lazy loading images (especially slider images) - e.g. https://coderwall.com/p/6qaeya/lazy-carousel-in-bootstrap
	$related_post_image = get_the_post_thumbnail( $related_post->ID, 'post_thumbnail', array( 'class' => 'img-fluid mx-auto d-block' ) );
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
		$related_classes.= ' col-lg-' . $column_size;
	break;
}

// custom classes
$related_classes.= ' ' . $related_css_classes;

$related_post_href = ( $related_post_url ) ? 'href="' . $related_post_url . '"' : null;
$related_post_target = ( $related_post_target == '_blank' ) ? 'target="' . $related_post_target . '"' : null;
$related_post_rel = ( $related_post_no_follow ) ? 'rel="nofollow"' : null;
?>

<div class="<?php echo $related_classes; ?>">
	<a <?php echo $related_post_href . ' ' . $related_post_target . ' ' . $related_post_rel; ?> class="banner-wrap">
		<div class="banner-image media-container">
			<?php echo $related_post_image; ?>
		</div>
	</a>
</div>

<?php $count++; ?>
