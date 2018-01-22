<div id="<?php echo $apl_unique_id; ?>-carousel" class="carousel slide w-100" data-ride="carousel">
	<div class="carousel-inner">

		<?php
		$count = 0;
		$column_count = 0;
		?>

		<?php foreach( $images as $image_object ): ?>

			<?php if( $column_count == 0 ): ?>

				<div class="carousel-item w-100 <?php echo ( $count == 0 ) ? 'active' : ''; ?>">
					<div class="gallery gallery-columns-<?php echo $columns; ?>">

			<?php endif; ?>

			<figure class="gallery-item">

				<div class="gallery-icon">
					<?php
					// full image tag
					echo wp_get_attachment_image( $image_object['ID'], 'full-size', false, array( 'class' => 'd-block mx-auto' ) );
					?>
				</div>
				
				<?php if( $show_titles ): ?>
					<h3><?php echo $image_object['title']; ?></h3>
				<?php endif; ?>
				
				<?php if( $show_captions ): ?>
					<p><?php echo $image_object['caption']; ?></p>
				<?php endif; ?>

			</figure>

			<?php $count++; ?>

			<?php $column_count++; ?>

			<?php if( $column_count == $columns || $count == count( $images ) ): ?>

					</div>
				</div>
				
				<?php $column_count = 0; ?>
				
			<?php endif; ?>

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
