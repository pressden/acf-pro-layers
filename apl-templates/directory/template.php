<?php
/*
Template Name: APL Directory
*/

// layer fields
$contacts = $layer['contacts'];
$columns = $layer['columns'];
$column_size = 12 / $columns;
$display = $layer['display'];
$show_images = $layer['show_images'];
$bio_length = ( isset( $layer['bio_length'] ) && !is_array( $layer['bio_length'] ) ) ? $layer['bio_length'] : 'content';
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );

foreach( $contacts as $contact ) {
	$link = get_the_permalink( $contact->ID );
	$image = ( $show_images ) ? get_the_post_thumbnail( $contact->ID, 'post_thumbnail', array( 'class' => 'img-fluid mx-auto d-block' ) ) : null;
	$name = get_field( 'name', $contact->ID );
	$title = get_field( 'title', $contact->ID );
	$company = get_field( 'company', $contact->ID );
	$email = get_field( 'email', $contact->ID );
	$phone = get_field( 'phone', $contact->ID );
	$fax = get_field( 'fax', $contact->ID );
	$address = get_field( 'address', $contact->ID );
	$website = get_field( 'website', $contact->ID );
	$bio = ( $bio_length == 'excerpt' && has_excerpt( $contact->ID ) ) ? get_the_excerpt( $contact->ID ) : $contact->post_content;
	$social = ( is_array( get_field( 'social', $contact->ID ) ) ) ? get_field( 'social', $contact->ID ) : null;
	?>

	<div class="directory-contact col-sm-<?php echo $column_size; ?>">

		<?php
		// show the image
		include( plugin_dir_path( __FILE__ ) . 'template-parts/image.php' );

		// show the contact information
		if( count( $display ) ) {
			?>

			<div class="directory-details mb-5">

				<?php
				foreach( $display as $part ) {
					$template_part = plugin_dir_path( __FILE__ ) . 'template-parts/' . $part . '.php';

					if( file_exists( $template_part ) ) {
						include( $template_part );
					}
				}
				?>

			</div>

			<?php
		}
		?>

	</div>

	<?php
}

apl_close_layer();
