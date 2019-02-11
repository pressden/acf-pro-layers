<?php
/*
Template Name: APL Directory
*/

// layer fields
$contacts = $layer['contacts'];
$columns = $layer['columns'];
$column_size = 12 / $columns;
$show_images = $layer['show_images'];
$link_to = ( isset( $layer['link_to'] ) && !is_array( $layer['link_to'] ) ) ? $layer['link_to'] : 'post';
$display = $layer['display'];
$bio_length = ( isset( $layer['bio_length'] ) && !is_array( $layer['bio_length'] ) ) ? $layer['bio_length'] : 'content';
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

// override the wrapper and column checks if columns are required
if( $columns > 1 ) {
	$args['include_wrapper'] = true;
	$args['include_column'] = true;
}

if( $args['include_wrapper'] ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );
}

foreach( $contacts as $contact ) {
	$image = ( $show_images ) ? get_the_post_thumbnail( $contact->ID, 'post_thumbnail', array( 'class' => 'img-fluid mx-auto d-block' ) ) : null;
	$name = get_field( 'name', $contact->ID );
	$title = get_field( 'title', $contact->ID );
	$company = get_field( 'company', $contact->ID );
	$email = get_field( 'email', $contact->ID );
	$phone = get_field( 'phone', $contact->ID );
	$extension = get_field( 'extension', $contact->ID );
	$fax = get_field( 'fax', $contact->ID );
	$address = get_field( 'address', $contact->ID );
	$website = get_field( 'website', $contact->ID );
	$bio = ( $bio_length == 'excerpt' && has_excerpt( $contact->ID ) ) ? get_the_excerpt( $contact->ID ) : $contact->post_content;
	$social = ( is_array( get_field( 'social', $contact->ID ) ) ) ? get_field( 'social', $contact->ID ) : null;

	switch( $link_to ) {
		// link to the post
		case 'post':
		$link = array(
			'url' => get_the_permalink( $contact->ID ),
			'target' => null,
		);
		break;

		// link to the website if a URL is provided
		case 'website':
		$link = ( $website ) ? $website : 'null';
		break;

		// suppress links
		default:
		$link = null;
		break;
	}
	?>

	<div class="directory-contact <?php echo ( $args['include_column'] ) ? 'col-lg-' . $column_size : ''; ?>">

		<?php
    // show the image template part
    $template_part = apl_get_template_part( 'apl-templates/directory/template-parts/image.php' );

    // include the template part
    if( $template_part ) {
      include( $template_part );
    }

		// show the contact information
		if( count( $display ) ) {
			?>

			<div class="directory-details mb-5">

				<?php
				foreach( $display as $part ) {
          // get the template part
          $template_part = apl_get_template_part( 'apl-templates/directory/template-parts/' . $part . '.php' );

          // include the template part
          if( $template_part ) {
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

if( $args['include_wrapper'] ) {
	apl_close_layer();
}
