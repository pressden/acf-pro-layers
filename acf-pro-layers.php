<?php
/*
Plugin Name: ACF Pro Layers
Plugin URI: https://github.com/pressden/acf-pro-layers
Description: ACF Pro Layers (APL) is a WordPress plugin that extends ACF Pro with pre-defined content modules for complex page layouts.
Version: 1.0.0
Author: D.S. Webster
Author URI: http://pressden.com/
License: GPLv2 or later
Text Domain: acf_pro_layers
*/

add_filter( 'the_content', 'apl_content_layers_filter' );
function apl_content_layers_filter ( $content ) {
  // get the layers field from ACF
  $layers = get_field_object( 'content_layers' );
  
  // initialize the output variable
  $output = '';
  
  // if there are no layers wrap the WordPress content in APL markup for consistency
  if( !$layers || ( isset( $layers['value'] ) && !$layers['value'] ) ) {
    $layers['value'] = array(
      0 => array(
        'acf_fc_layout' => 'wordpress_content',
        'content' => $content,
      ),
    );
  }
  
  foreach( $layers['value'] as $key => $layer ) {
    // layer_name = template name and CSS prefix
    // @TODO: template_name may need some formatting depending on how ACF handles multi-word names
    $layer_name = str_replace( '_', '-', $layer['acf_fc_layout'] );
    
    // store the layer name for later use
    $layer['apl-layer-name'] = $layer_name;
    
    // generate a unique ID for direct targeting
    $layer['apl-unique-id'] = 'apl-content-' . $key++ . '-' . $layer_name;
    
    // make our content available to APL so it can be inserted into the WordPress Content template
    if( $layer_name == 'wordpress-content' )
    {
      $layer['content'] = $content;
    }
    
    // get the template
    $template = apl_get_template( $layer_name );
    
    // buffer the template content
    $output .= apl_get_template_buffer( $template, $layer );
  }
  
  return $output;
}

function apl_get_open_layer( $layer_name, $layer_id, $css_classes = null ) {
  $output = '
    <section id="' . $layer_id . '" class="' . $layer_name . '-wrapper layer-wrapper ' . $css_classes . '">
      <div class="' . $layer_name . '-layer layer">
  ';
  
  return $output;
}

function apl_open_layer( $layer_name, $layer_id, $css_classes = null ) {
  echo apl_get_open_layer( $layer_name, $layer_id, $css_classes );
}

function apl_get_close_layer() {
  $output = '
      </div>
    </section>
  ';
  
  return $output;
}

function apl_close_layer() {
  echo apl_get_close_layer();
}

function apl_get_template( $layer_name ) {
  $path = 'apl-templates/' . $layer_name . '/template.php';
  
  $template = null;
  
  if( is_file( get_stylesheet_directory() . '/' . $path ) ) {
    $template = get_stylesheet_directory() . '/' . $path;
  }
  else if( is_file( get_template_directory() . '/' . $path ) ) {
    $template = get_template_directory() . '/' . $path;
  }
  else if( is_file( plugin_dir_path( __FILE__ ) . $path ) ) {
    $template = plugin_dir_path( __FILE__ ) . $path;
  }
  
  return $template;
}

function apl_get_template_buffer( $template, $layer ) {
  if( is_file( $template ) ) {
    // define required template variables
    $apl_unique_id = $layer['apl-unique-id'];
    $layer_name = $layer['apl-layer-name'];
    
    ob_start();
    include $template;
    return ob_get_clean();
  }
  
  return null;
}
