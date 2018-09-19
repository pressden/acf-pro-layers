<div id="<?php echo $apl_unique_id; ?>-carousel" class="carousel slide w-100" data-ride="carousel">
	<div class="carousel-inner">

		<?php
		$count = 0;
		$column_count = 0;
		?>

		<?php
		foreach( $related_posts as $related ) {
			if( $column_count == 0 ) {
				?>

				<div class="carousel-item w-100 <?php echo ( $count == 0 ) ? 'active' : ''; ?>">
					<div class="gallery gallery-columns-<?php echo $columns; ?>">

				<?php
			}

			$template_part = plugin_dir_path( __DIR__ ) . 'template-parts/content.php';

			if( file_exists( $template_part ) ) {
				include( $template_part );
			}

			$count++;
			$column_count++;

			if( $column_count == $columns || $count == count( $images ) ) {
				?>

					</div>
				</div>

				<?php
				$column_count = 0;
			}
		}
		?>

	</div>

	<?php if( $count > 1 ): ?>

		<a class="carousel-control-prev" href="#<?php echo $apl_unique_id; ?>-carousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#<?php echo $apl_unique_id; ?>-carousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>

	<?php endif; ?>

</div>
