<?php
/*
Template Name: APL Gallery
*/

// layer fields
$images = $layer['images'];
$columns = $layer['columns'];
$size = ( in_array( $layer['size'], get_intermediate_image_sizes() ) ) ? $layer['size'] : 'thumbnail';
$link_to = $layer['link_to'];
$image_classes = ( isset( $layer['image_classes'] ) ) ? $layer['image_classes'] : null;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
// default media container
$media_container = 'a';

// default media classes
$media_classes = null;
?>

<?php apl_open_layer( $layer_name, $apl_unique_id, $css_classes, 'gallery gallery-columns-' . $columns, $attributes  ); ?>

	<?php if( $link_to == 'Carousel' ): ?>

		<div id="<?php echo $apl_unique_id; ?>-carousel" class="carousel slide w-100" data-ride="carousel">
		  <div class="carousel-inner">

				<?php
				$count = 0;
				?>

				<?php foreach( $images as $image_object ): ?>

			    <div class="carousel-item w-100 <?php echo ( $count == 0 ) ? 'active' : ''; ?>">

			      <?php
			      // full image tag
			      echo wp_get_attachment_image( $image_object['ID'], 'full-size', false, array( 'class' => 'd-block mx-auto' ) );
						?>

			    </div>

					<?php $count++; ?>

			  <?php endforeach; ?>

		  </div>
		  <a class="carousel-control-prev" href="#<?php echo $apl_unique_id; ?>-carousel" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#<?php echo $apl_unique_id; ?>-carousel" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

	<?php endif; ?>

  <div id="<?php echo $apl_unique_id; ?>-gallery" class="gallery gallery-columns-<?php echo $columns; ?>">

		<?php
		$count = 0;
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

					case 'Carousel':
						$media_href = null;
						$carousel_navigation = 'data-target="#' .  $apl_unique_id . '-carousel" data-slide-to="' . $count . '"';
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

<?php apl_close_layer(); ?>
