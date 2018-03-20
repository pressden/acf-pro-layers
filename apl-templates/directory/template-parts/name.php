<?php if( $name ): ?>

	<div class="directory-name">

		<?php if( $link ): ?>
			<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
		<?php endif; ?>

			<?php echo $name; ?>

		<?php if( $link ): ?>
			</a>
		<?php endif; ?>

	</div>

<?php endif; ?>
