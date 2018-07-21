<?php
/*
Template Name: APL Related Content
*/

// layer fields
$selection_method = ( isset( $layer['selection_method'] ) && !is_array( $layer['selection_method'] ) ) ? $layer['selection_method'] : 'manual';
$layout = ( isset( $layer['layout'] ) ) ? $layer['layout'] : 'grid';
$columns = ( isset( $layer['columns'] ) && !is_array( $layer['columns'] ) ) ? $layer['columns'] : 3;
$columns = ( $layout == 'slider' ) ? 1 : $columns; // force sliders to one column
$column_size = 12 / $columns;
$show_titles = $layer['show_titles'];
$title_tag = ( isset( $layer['title_tag'] ) && !is_array( $layer['title_tag'] ) ) ? $layer['title_tag'] : 'h3';
$show_images = $layer['show_images'];
$show_excerpts = $layer['show_excerpts'];
$show_buttons = $layer['show_buttons'];
$button_text = $layer['button_text'];
$button_classes = ( isset( $layer['button_classes'] ) ) ? $layer['button_classes'] : null;
$randomize = $layer['randomize'];
$limit = $layer['limit'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
$count = 0; // count is required for some templates

switch( $selection_method ) {
	case 'manual':
	$related_posts = $layer['posts'];

	// enable randomization
	if( $randomize ) {
		shuffle( $related_posts );

		// limit restricts the output to a random sub-set on each page load
		if( $limit ) {
			$related_posts = array_slice( $related_posts, 0, $limit );
		}
	}

	break;

	case 'query':
	$query_settings = $layer['query_settings'];
	$post_type = ( isset( $query_settings['post_type'] ) ) ? $query_settings['post_type'] : array( 'post' );
	$posts_per_page = ( isset( $query_settings['result_limit'] ) ) ? $query_settings['result_limit'] : 3;
	$require_images = ( isset( $query_settings['result_limit'] ) ) ? $query_settings['result_limit'] : 0;
	$taxonomies = ( isset( $query_settings['taxonomies'] ) ) ? $query_settings['taxonomies'] : null;
	$preset_file = ( isset( $query_settings['preset'] ) ) ? plugin_dir_path( __FILE__ ) . 'queries/' . $query_settings['preset'] . '.php' : null;

	// convert $post_type to an array
	if( is_string( $post_type ) ) {
		// split on comma and trim any whitespace
		$post_type = preg_split( '/[\s*,\s*]*,+[\s*,\s*]*/', $post_type );
	}

	// set some default $args based on ACF values and common queries
	$args['post_type'] = $post_type;
	$args['posts_per_page'] = $posts_per_page;
	$args['orderby'] = ( $randomize ) ? 'rand' : 'date';
	$args['meta_query'] = array();
	$args['tax_query'] = array();

	// only include posts with a featured image
	if( $show_images && $require_images ) {
		$args['meta_query'][] = array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS',
		);
	}

	// add tax_query args
	if( $taxonomies ) {
		foreach( $taxonomies as $tax ) {
			$taxonomy = $tax['taxonomy'];
			$terms = $tax['terms'];
			$field = $tax['field'];
			$operator = $tax['operator'];

			// convert $terms to an array
			if( is_string( $terms ) ) {
				// split on comma and trim any whitespace
				$terms = preg_split( '/[\s*,\s*]*,+[\s*,\s*]*/', $terms );
			}

			// if the taxonomy exists we can query it
			if( taxonomy_exists( $taxonomy ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'field' => $field,
					'terms' => $terms,
					'operator' => $operator,
				);
			}
		}
	}

	// include a preset file which can override any of the above defaults
	if( file_exists( $preset_file ) ) {
		include( $preset_file );
	}

	// query the database with our custom $args
	$query = new WP_Query( $args );

	// if the query has posts
	if( $query->have_posts() ) {
		// convert the query results into an ACF friendly format
		$related_posts = array_map( function( $post ) { return array( 'post' => $post ); }, $query->posts );
	}

	break;
}

apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );

switch( $layout ) {
	case 'carousel':
	case 'grid':
	case 'slider':
		// @TODO: Add a carousel template similar to the gallery layer carousel
		include( 'layout/' . $layout . '.php' );
	break;

	// catch all in case an invalid layout is requested
	default:
		include( 'layout/grid.php' );
	break;
}

apl_close_layer();
