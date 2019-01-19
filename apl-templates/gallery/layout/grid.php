<div id="<?php echo $apl_unique_id; ?>-gallery" class="gallery gallery-columns-<?php echo $columns; ?> col">

	<?php
	$count = 0;

	// force grid and carousel to link to slider if one is available
	$link_to = ( in_array( $layout, array( 'slider-carousel', 'slider-grid' ) ) ) ? 'Slider' : $link_to;
	?>

	<?php foreach( $images as $image_object ): ?>

    <figure class="gallery-item">

      <?php
      // full image tag
      $image = wp_get_attachment_image( $image_object['ID'], $size, false, array( 'class' => 'attachment-thumbnail size-thumbnail ' . $image_classes ) );

      // default media link
      $media_href = $image_object['url'];

      // modify media defaults based on the link to behavior
      switch( $link_to ) {
        case 'Media Page':
          $media_href = get_the_permalink( $image_object['ID'] );
        break;

        case 'Full Size Image':
        break;

				case 'Slider':
					$media_href = null;
					$carousel_navigation = 'data-target="#' .  $apl_unique_id . '-slider" data-slide-to="' . $count . '"';
        case 'No Links':
          $media_href = null;
        break;

        // Shadowbox default behavior
        default:
          $media_classes = 'thickbox';
        break;
      }

      // if we have a URL wrap markup around it
      $media_href = ( $media_href ) ? 'href="' . $media_href . '"' : null;
      ?>

			<div <?php echo $carousel_navigation; ?> class="gallery-icon media-container <?php echo $media_classes; ?>">

				<?php if( $media_href ) : ?>
					<a <?php echo $media_href; ?>>
				<?php endif; ?>

	        <?php echo $image; ?>

				<?php if( $media_href ) : ?>
					</a>
				<?php endif; ?>

			</div>

    </figure>

		<?php $count++; ?>

  <?php endforeach; ?>

</div>
