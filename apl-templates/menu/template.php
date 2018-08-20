<?php
/*
Template Name: APL Menu
*/

// @TODO: Add validation / condition check logic throughout as needed
// @TODO: Break template into smaller parts (as needed) to allow for template part overrides
// @TODO: Add a title so the meny can be labeled

// layer fields
$menu_type = ( isset( $layer['menu_type'] ) ) ? $layer['menu_type'] : 'wordpress';
// @TODO: Make this a select field to pull all available menus (requires a conversion to PHP based ACF fields)
$wordpress_menu = ( isset( $layer['wordpress_menu'] ) ) ? $layer['wordpress_menu'] : null;
// @TODO: Add custom menu functionality
$custom_menu = ( isset( $layer['custom_menu'] ) ) ? $layer['custom_menu'] : null;
$display = ( isset( $layer['display'] ) && !is_array( $layer['display'] ) ) ? $layer['display'] : 'full';
$orientation = ( isset( $layer['orientation'] ) && !is_array( $layer['orientation'] ) ) ? $layer['orientation'] : 'vertical';
$menu_alignment = ( isset( $layer['menu_alignment'] ) && !is_array( $layer['menu_alignment'] ) ) ? $layer['menu_alignment'] : 'left';
$text_alignment = ( isset( $layer['text_alignment'] ) && !is_array( $layer['text_alignment'] ) ) ? $layer['text_alignment'] : null;
$menu_style = ( isset( $layer['menu_style'] ) && !is_array( $layer['menu_style'] ) ) ? $layer['menu_style'] : 'links';
$mobile_toggle = ( isset( $layer['mobile_toggle'] ) && !is_array( $layer['mobile_toggle'] ) ) ? $layer['mobile_toggle'] : 'md';
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
$container = ( isset( $layer['container'] ) && !is_array( $layer['container'] ) ) ? $layer['container'] : 'container';
$attributes = ( isset( $layer['attributes'] ) ) ? $layer['attributes'] : null;

if( $args['include_wrapper'] ) {
	apl_open_layer( $layer_name, $apl_unique_id, $css_classes, $attributes, $container );
}

switch( $menu_type ) {
	case 'anchor':
		// @TODO: Add anchor menu functionality
		// @TODO: Format this output so it can pass directly into the render logic below
		break;

	case 'custom':
		// @TODO: Add custom menu functionality
		// @TODO: Format this output so it can pass directly into the render logic below
		break;

	// case: wordpress
	default:
		// get the nav menu object
		$nav_menu = wp_get_nav_menu_object( $wordpress_menu );
		$menu_id = $apl_unique_id . '-' . $nav_menu->slug;
		$menu_items = ( ! empty( $nav_menu ) ) ? wp_get_nav_menu_items( $nav_menu ) : null;
		$menu = array();

		if( $display == 'full' ) {
			// use the full menu
			$menu = $menu_items;
		}
		else {
			// @TODO: Abstract the widget logic out so we don't have to duplicate this code

			// get the post to establish context
			$post = get_queried_object();

			// extract a contextual sub menu
			$context_menu = array();

			// check for a valid menu
			if( ! empty( $nav_menu ) ) {
				// variable defaults
				$nav_menu_item = null;
				$child_menu_items = array();
				$sibling_menu_items = array();

				// if we have some menu items, loop through them to find the item corresponding to $post
				if( ! empty( $menu_items ) ) {
					foreach( $menu_items as $menu_item ) {
						// find the menu item for the current page
						if( $menu_item->object_id == $post->ID ) {
							$nav_menu_item = $menu_item;
							break;
						}
					}
				}

				// if we found a match, loop through again to find child and sibling menu items
				if( $nav_menu_item ) {
					foreach( $menu_items as $menu_item ) {
						// child relationship check
						if( $menu_item->menu_item_parent == $nav_menu_item->ID ) {
							$child_menu_items[] = $menu_item;
						}
						// sibling relationship check
						else if( $menu_item->menu_item_parent == $nav_menu_item->menu_item_parent ) {
							$sibling_menu_items[] = $menu_item;
						}
					}
				}

				// fill the context menu based on child relationships first, sibling relationships next
				$context_menu = ( ! empty( $child_menu_items ) ) ? $child_menu_items : $sibling_menu_items;
			}

			$menu = $context_menu;
		}
		break;
}

if( ! empty( $menu ) ) {
	// initialize required variables
	$nav_class_array = array();
	$div_class_array = array();

	// apply w-100 to ensure a maximum range of options
	$nav_class_array[] = 'w-100';

	// define a toggle class if we need one
	if( $mobile_toggle ) {
		$toggle_class = 'navbar-expand';
		$toggle_class.= ( $mobile_toggle != 1 ) ? '-' . $mobile_toggle : '';
		$nav_class_array[] = $toggle_class;
	}

	// add menu orientation classes
	if( $orientation == 'vertical' ) {
		$div_class_array[] = 'navbar-vertical';
	}

	// add menu style classes
	if( $menu_style == 'pills' ) {
		$nav_class_array[] = 'nav-pills';
	}
	else if( $menu_style == 'tabs' && $orientation == 'horizontal' ) {
		$div_class_array[] = 'nav-tabs';
	}

	// add alignemnt classes
	switch( $menu_alignment ) {
		case 'justify':
			$div_class_array[] = 'nav-justified';
			break;

		case 'center':
			$div_class_array[] = 'justify-content-center';
			break;

		case 'right':
			$div_class_array[] = 'justify-content-end';
			$div_class_array[] = 'align-items-end';
			break;

		default:
			// left is the bootstrap default
			break;
	}

	$nav_class_string = implode( ' ', $nav_class_array );
	$div_class_string = implode( ' ', $div_class_array );
	?>

	<nav class="navbar navbar-light p-0 <?php echo $nav_class_string; ?>">

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#<?php echo $menu_id; ?>" aria-controls="<?php echo $menu_id; ?>" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div id="<?php echo $menu_id; ?>" class="collapse navbar-collapse <?php echo $div_class_string; ?>">

			<?php
			foreach( $menu as $menu_item ) {
				// initialize required variables
				$link_class_array = array();

				// ensure vertical menu items run full width of their container
				if( $orientation == 'vertical' ) {
					$link_class_array[] = 'w-100';
				}

				// add button styles
				if( $menu_style == 'buttons' ) {
					$link_class_array[] = 'btn';
					$link_class_array[] = 'btn-light';

					if( $orientation == 'vertical' ) {
						$link_class_array[] = 'my-1';
					}
					else {
						$link_class_array[] = 'mx-1';
					}
				}

				// add alignemnt classes
				switch( $text_alignment ) {
					case 'center':
						$link_class_array[] = 'text-center';
						break;

					case 'right':
						$link_class_array[] = 'text-right';
						break;

					default:
						// left is the bootstrap default
						break;
				}

				if( $menu_item->url == get_the_permalink( $post ) ) {
					$link_class_array[] = 'active';
				}

				$link_class_string = implode( ' ', $link_class_array );
				?>

				<a href="<?php echo $menu_item->url; ?>" title="<?php echo $menu_item->title; ?>" class="nav-item nav-link <?php echo $link_class_string; ?>"><?php echo $menu_item->title; ?></a></li>

				<?php
			}
			?>

		</div>

	</ul>

	<?php
}

if( $args['include_wrapper'] ) {
	apl_close_layer();
}
