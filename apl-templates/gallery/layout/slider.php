<div id="<?php echo $apl_unique_id; ?>-slider" class="carousel slide w-100" data-ride="carousel">
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

	<?php if( $count > 1 ): ?>

		<a class="carousel-control-prev" href="#<?php echo $apl_unique_id; ?>-slider" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#<?php echo $apl_unique_id; ?>-slider" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>

	<?php endif; ?>

</div>
