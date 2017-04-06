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
  // get the post object from WordPress
  $post = get_post();
  
  // get the layers field from ACF
  $layers = get_field_object( 'header_layers' );
  
  // @TODO: exit early if $layers is empty (either null or empty depending on how ACF handles blank flex fields)
  
  // start the layers output
  // @TODO: consider "before_conent" and "after_content" variables so we can wrap the standard wordpress content region
  $output = '';
  
  $content = apl_get_open_layer( 'wp-content', 'apl-wp-content' ) . '<div class="col-xs-12 wp-content">' . $content . '</div>' . apl_get_close_layer();
  
  foreach( $layers['value'] as $key => $layer ) {
    // layer_name = template name and CSS prefix
    // @TODO: template_name may need some formatting depending on how ACF handles multi-word names
    $layer_name = str_replace( '_', '-', $layer['acf_fc_layout'] );
    
    // store the layer name for later use
    $layer['apl-layer-name'] = $layer_name;
    
    // generate a unique ID for direct targeting
    $layer['apl-unique-id'] = 'apl-' . $key++ . '-' . $layer_name;
    
    // get the template
    $template = apl_get_template( $layer_name );
    
    // buffer the template content
    $output .= apl_get_template_buffer( $template, $layer );
  }
  
  return $output . $content;
}

function apl_get_open_layer( $layer_name, $layer_id ) {
  $output = '
    <section id="' . $layer_id . '" class="' . $layer_name . '-wrapper layer-wrapper">
      <div class="' . $layer_name . '-container layer-container container">
        <div class="' . $layer_name . '-layer layer row">
  ';
  
  return $output;
}

function apl_open_layer( $layer_name, $layer_id ) {
  echo apl_get_open_layer( $layer_name, $layer_id );
}

function apl_get_close_layer() {
  $output = '
        </div>
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


/*
// EXAMPLE: include contents into a variable
$string = get_include_contents('somefile.php');

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}
*/