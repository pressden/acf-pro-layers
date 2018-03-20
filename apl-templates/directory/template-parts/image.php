<?php if( $show_images ): ?>

	<div class="directory-image media-container mb-2">

		<?php if( $link ): ?>
			<a href="<?php echo $link; ?>">
		<?php endif; ?>

		<?php echo $image; ?>

		<?php if( $link ): ?>
			</a>
		<?php endif; ?>

	</div>

<?php endif; ?>
