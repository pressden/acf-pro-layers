<?php
/*
Template Name: APL Menu
*/

// @TODO: Add validation / condition check logic throughout as needed
// @TODO: Break template into smaller parts (as needed) to allow for template part overrides

// layer fields
$menu_type = ( isset( $layer['menu_type'] ) ) ? $layer['menu_type'] : 'wordpress';
// @TODO: Make this a select field to pull all available menus (requires a conversion to PHP based ACF fields)
$wordpress_menu = ( isset( $layer['wordpress_menu'] ) ) ? $layer['wordpress_menu'] : null;
// @TODO: Add custom menu functionality
$custom_menu = ( isset( $layer['custom_menu'] ) ) ? $layer['custom_menu'] : null;
// @TODO: Rename option to "Context Menu" here and in the widget code
$display = ( isset( $layer['display'] ) && !is_array( $layer['display'] ) ) ? $layer['display'] : 'full';
// @TODO: Add "fluid" or "justified" layout options
$layout = ( isset( $layer['layout'] ) && !is_array( $layer['layout'] ) ) ? $layer['layout'] : 'vertical';
// @TODO: Confirm pills and buttons work as expected
$menu_style = ( isset( $layer['menu_style'] ) && !is_array( $layer['menu_style'] ) ) ? $layer['menu_style'] : 'links';
// @TODO: Add the mobile toggle logic
$mobile_toggle = ( isset( $layer['mobile_toggle'] ) && !is_array( $layer['mobile_toggle'] ) ) ? $layer['mobile_toggle'] : 1;
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
// @TODO: Test container-fluid after implementing horizontal (with fluid and/or justified)
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
			// @TODO: Rename $auto_menu to $context_menu for consistency
			$auto_menu = array();

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

				// fill the auto menu based on child relationships first, sibling relationships next
				$auto_menu = ( ! empty( $child_menu_items ) ) ? $child_menu_items : $sibling_menu_items;
			}

			$menu = $auto_menu;
		}
		break;
}

if( ! empty( $menu ) ) {
	// initialize required variables
	$menu_class_array = array();

	// add menu layout classes
	if( $layout == 'vertical' ) {
		$menu_class_array[] = 'flex-column';
	}

	// add menu style classes
	if( $menu_style == 'pills' ) {
		$menu_class_array[] = 'nav-pills';
	}

	$menu_class_string = implode( ' ', $menu_class_array );
	?>

	<ul class="nav <?php echo $menu_class_string; ?>">

		<?php
		foreach( $menu as $menu_item ) {
			// initialize required variables
			$item_class_array = array();
			$link_class_array = array();

			if( $menu_item->url == get_the_permalink( $post ) ) {
				$link_class_array[] = 'active';
			}

			$item_class_string = implode( ' ', $item_class_array );
			$link_class_string = implode( ' ', $link_class_array );
			?>

			<li class="nav-item <?php echo $item_class_string; ?>"><a href="<?php echo $menu_item->url; ?>" title="<?php echo $menu_item->title; ?>" class="nav-link <?php echo $link_class_string; ?>"><?php echo $menu_item->title; ?></a></li>

			<?php
		}
		?>

	</ul>

	<?php
}

if( $args['include_wrapper'] ) {
	apl_close_layer();
}
