<?php
foreach( $related_posts as $related ) {
	$template_part = plugin_dir_path( __DIR__ ) . 'template-parts/content.php';

	if( file_exists( $template_part ) ) {
		include( $template_part );
	}
}
