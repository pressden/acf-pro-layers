<?php if( $show_images ): ?>

	<div class="directory-image media-container">

		<?php if( $link ): ?>
			<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
		<?php endif; ?>

		<?php echo $image; ?>

		<?php if( $link ): ?>
			</a>
		<?php endif; ?>

	</div>

<?php endif; ?>
