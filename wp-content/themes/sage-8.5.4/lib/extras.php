<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


function get_page_template(){
  $template = get_page_template_slug();
  return $template;
}

function render_tags($post_item){
    $tags = get_the_tags($post_item->ID);
    if($tags):
      echo '<h4>Tags:</h4>';
      foreach($tags as $tag):
        echo '<span class="tag">'.$tag->name.'</span>';
      endforeach;
    endif;
}

function render_acf_image_url($field, $size = false, $options = false){
  if($options){
    $image = get_field($field, 'options');
  }else{
    $image = get_field($field);
  }

  // var_dump($image);

  if($size){
      $image_url = $image['sizes'][$size];
  }else{
      $image_url = $image['url'];
  }
  
  echo $image_url;
}

function render_content_grid_item($post_item, $index = 0){
  if($post_item):
    include(locate_template('templates/'.get_post_type($post_item).'-grid-item.php'));
  endif;
}

function render_template($template = null, $args = null){
    include(locate_template('templates/'.$template.'.php'));
}

function flex_content_title( $title, $field, $layout, $i ) {
    if(get_sub_field('title')):
        $title = '';
        return get_sub_field('title');
    else:
        return $title;
    endif; 
}
add_filter('acf/fields/flexible_content/layout_title/name=content', __NAMESPACE__.'\\flex_content_title', 10, 4);

function render_acf_image_alt($field, $options = false){
  if($options){
    $image = get_field($field, 'options');
  }else{
    $image = get_field($field);
  }

  $image_alt = $image['alt'];
  
  echo $image_alt;
}

// CREATE OPTIONS PAGE
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings'
  ));
}

/**
 * Add automatic image sizes
 */
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'featured', 1500, 750, true ); //(cropped)
  add_image_size( 'featured-tall', 1500, 1000, true );
  add_image_size('large-square', 1000, 1000, true);
  add_image_size( 'square', 600, 600, true );
}
