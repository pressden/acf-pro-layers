<?php if( $phone ): ?>

	<div class="directory-phone">
		<span class="directory-label phone-label">Phone:</span>
		<a href="tel:<?php echo $phone; ?>">
			<?php echo $phone; ?>
		</a>

		<?php echo ( $extension ) ? 'x' . $extension : ''; ?>

	</div>

<?php endif; ?>
