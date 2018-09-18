<?php
/*
Template Name: APL Banner Region
*/

// layer fields
$selection_method = ( isset( $layer['selection_method'] ) && !is_array( $layer['selection_method'] ) ) ? $layer['selection_method'] : 'manual';
$layout = ( isset( $layer['layout'] ) ) ? $layer['layout'] : 'grid';
$columns = ( isset( $layer['columns'] ) && !is_array( $layer['columns'] ) ) ? $layer['columns'] : 3;
$columns = ( $layout == 'slider' ) ? 1 : $columns; // force sliders to one column
$column_size = 12 / $columns;
$show_images = 1;
$randomize = $layer['randomize'];
$limit = $layer['limit'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$css_classes.= ' ' . $layer_name . '-layout-' . $layout;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$entry_wrap = 'a';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;
$count = 0; // count is required for some templates

switch( $selection_method ) {
	case 'manual':
	$related_posts = $layer['banners'];

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
	$post_type = array( 'banner' );
	$posts_per_page = ( isset( $query_settings['result_limit'] ) ) ? $query_settings['result_limit'] : 3;
	$require_images = 1;
	$taxonomies = ( isset( $query_settings['taxonomies'] ) ) ? $query_settings['taxonomies'] : null;
	$preset = ( isset( $query_settings['preset'] ) ) ? $query_settings['preset'] : null;
	$preset_array = ( $preset ) ? explode( ',', $preset ) : array();
	$preset_file_array = array();

	// locate the preset file by looking in childtheme followed by the plugin directory
	if( $preset ) {
		foreach( $preset_array as $preset_string ) {
			if( file_exists( get_stylesheet_directory() . '/apl-templates/banner-region/queries/' . $preset_string . '.php' ) ) {
				$preset_file_array[] = get_stylesheet_directory() . '/apl-templates/banner-region/queries/' . $preset_string . '.php';
			}
			else if( file_exists( plugin_dir_path( __FILE__ ) . 'queries/' . $query_settings['preset'] . '.php' ) ) {
				$preset_file_array[] = plugin_dir_path( __FILE__ ) . 'queries/' . $query_settings['preset'] . '.php';
			}
		}
	}

	// if no preset files were found there are no presets
	if( empty( $preset_file_array ) ) {
		$preset = null;
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
	if( $preset ) {
		foreach( $preset_file_array as $preset_file ) {
			include( $preset_file );
		}
	}

	// query the database with our custom $args
	$query = new WP_Query( $args );

	// if the query has posts
	if( $query->have_posts() ) {
		// convert the query results into an ACF friendly format
		$related_posts = array_map( function( $post ) { return array( 'banner' => $post ); }, $query->posts );
	}

	break;
}

// exit early if there are no related posts
if( !$related_posts ) {
	return;
}

if( $args['include_wrapper'] ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );
}

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

if( $args['include_wrapper'] ) {
	apl_close_layer();
}
