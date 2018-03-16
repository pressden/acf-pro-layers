<?php if( $name ): ?>

	<div class="directory-name">

		<?php if( $link ): ?>
			<a href="<?php echo $link; ?>">
		<?php endif; ?>

			<?php echo $name; ?>

		<?php if( $link ): ?>
			</a>
		<?php endif; ?>

	</div>

<?php endif; ?>
