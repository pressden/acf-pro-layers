<div id="<?php echo $apl_unique_id; ?>-slider" class="carousel slide w-100" data-ride="carousel">
	<div class="carousel-inner">

		<?php
		foreach( $related_posts as $related ) {
			$template_part = plugin_dir_path( __DIR__ ) . 'template-parts/content.php';

			if( file_exists( $template_part ) ) {
				include( $template_part );
			}
		}
		?>

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
