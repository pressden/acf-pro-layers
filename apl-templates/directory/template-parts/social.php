<?php if( count( $social ) ): ?>

	<div class="simple-social-icons">
		<ul class="directory-social">

			<?php foreach( $social as $item ): ?>

				<li class="directory-social-<?php echo $item['network']['value']; ?>">
					<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>">

						<svg role="img" class="social-<?php echo $item['network']['value']; ?>" aria-labelledby="social-<?php echo $item['network']['label']; ?>">
							<title><?php echo $item['network']['label']; ?></title>
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo plugins_url( 'simple-social-icons' ); ?>/symbol-defs.svg#social-<?php echo $item['network']['value']; ?>"></use>
						</svg>

					</a>
				</li>

			<?php endforeach; ?>

		</ul>
	</div>

<?php endif; ?>
