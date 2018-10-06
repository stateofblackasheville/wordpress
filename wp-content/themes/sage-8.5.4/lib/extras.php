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


function filter_archive( $query ) {
  
  // do not modify queries in the admin
  if( is_admin() ) {
    
    return $query;
    
  } 
  
  // only modify queries for 'event' post type
  if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'visualization' && $query->is_main_query() ):

    if(isset($_GET['visualization_status']) ):
      if($_GET['visualization_status'] == 'All'):

      elseif($_GET['visualization_status'] == 'Created'):
        $meta_query[] = array(
          'relation' => 'AND',
          array(
            'key'   => '_thumbnail_id',
            'compare' => 'NOT EXISTS'
          ),
          array(
            'key'     => 'embed',
            'compare' => '=',
            'value'   => ''        
          )
        );
      elseif($_GET['visualization_status'] == 'Static'):
        $meta_query[] = array(
          'relation' => 'AND',
          array(
            'key'   => '_thumbnail_id',
          ),
          array(
            'key'     => 'embed',
            'compare' => '=',
            'value'   => ''        
          )
        );        
      elseif($_GET['visualization_status'] == 'Dynamic'):
        $meta_query[] = array(
          'relation' => 'AND',
          array(
            'key'     => 'embed',
            'compare' => '!=',
            'value'   => ''        
          )
        ); 
      endif;
    endif;     

  endif;

  if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'student_paper' && $query->is_main_query()):

    // allow the url to alter the query
    if(isset($_GET['index_status']) ):
      if($_GET['index_status'] == 'All'):

      elseif($_GET['index_status'] == 'Created'):
        $meta_query[] = array(
            'relation'  => 'AND',
            array(
              'key' => 'document_reference',
              'compare' => 'NOT EXISTS',
              // 'value'   => ''  
            ),
            array(
              'key' => 'index_document',
              'compare' => '=',
              'value'   => ''  
            )
        );

      elseif($_GET['index_status'] == 'Indexed'):
        $meta_query[] = array(
            'relation'  => 'AND',
            array(
              'key' => 'document_reference',
              'compare' => 'NOT EXISTS'  
            ),
            array(
              'key' => 'index_document',
              'compare' => '!=',
              'value'   => ''  
            )
        );       
      elseif($_GET['index_status'] == 'Visualized'):
        $meta_query[] = array(
            'relation'  => 'AND',
            array(
              'key' => 'document_reference',
              'compare' => 'EXISTS'  
            ),
            array(
              'key' => 'index_document',
              'compare' => '!=',
              'value'   => ''  
            )
        );  
      endif;
    endif;             

  
  endif;  

  if( isset($query->query_vars['post_type']) && ($query->query_vars['post_type'] == 'student_paper' || $query->query_vars['post_type'] == 'visualization') && $query->is_main_query()):

    $query->set('posts_per_page', 10);

    if(isset($_GET['archive_search']) && $_GET['archive_search'] !== null && $_GET['archive_search'] !== ''):
      $query->set('s', $_GET['archive_search']);
        $query->set('posts_per_page', -1);
    endif;     
    
    if(isset($_GET['tags'])):
      $query->set('tag__and', $_GET['tags']);
      $query->set('posts_per_page', -1);
    endif;    
    
    if(isset($_GET['category']) ):
      $current_cat = get_category_by_slug($_GET['category']);
      if($current_cat):
        $query->set('cat', $current_cat->term_id);
      endif;
    endif;

    if(isset($meta_query)):
      $query->set('meta_query', $meta_query);
    endif;
    // var_dump($query);

  endif;

  if(isset($_GET['index_status']) && $_GET['index_status'] !== 'All'):
    
  endif;  
  
  // return
  return $query;

}
add_action('pre_get_posts', __NAMESPACE__ . '\\filter_archive');

function bidirectional_acf_update_value($value, $post_id, $field) {
  
  // vars
  $field_name = $field['name'];
  $field_key = $field['key'];
  $global_name = 'is_updating_' . $field_name;
  
  
  // bail early if this filter was triggered from the update_field() function called within the loop below
  // - this prevents an inifinte loop
  if( !empty($GLOBALS[ $global_name ]) ) return $value;
  
  
  // set global variable to avoid inifite loop
  // - could also remove_filter() then add_filter() again, but this is simpler
  $GLOBALS[ $global_name ] = 1;
  
  
  // loop over selected posts and add this $post_id
  if( is_array($value) ) {
  
    foreach( $value as $post_id2 ) {
      
      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);
      
      
      // allow for selected posts to not contain a value
      if( empty($value2) ) {
        
        $value2 = array();
        
      }
      
      
      // bail early if the current $post_id is already found in selected post's $value2
      if( in_array($post_id, $value2) ) continue;
      
      
      // append the current $post_id to the selected post's 'related_posts' value
      $value2[] = $post_id;
      
      
      // update the selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);
      
    }
  
  }
  
  
  // find posts which have been removed
  $old_value = get_field($field_name, $post_id, false);
  
  if( is_array($old_value) ) {
    
    foreach( $old_value as $post_id2 ) {
      
      // bail early if this value has not been removed
      if( is_array($value) && in_array($post_id2, $value) ) continue;
      
      
      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);
      
      
      // bail early if no value
      if( empty($value2) ) continue;
      
      
      // find the position of $post_id within $value2 so we can remove it
      $pos = array_search($post_id, $value2);
      
      
      // remove
      unset( $value2[ $pos] );
      
      
      // update the un-selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);
      
    }
    
  }
  
  
  // reset global varibale to allow this filter to function as per normal
  $GLOBALS[ $global_name ] = 0;
  
  
  // return
    return $value;
    
}

add_filter('acf/update_value/name=document_reference', __NAMESPACE__ . '\\bidirectional_acf_update_value', 10, 3);

function get_page_template(){
  $template = get_page_template_slug();
  return $template;
}

function render_badges($post_item){
  if($post_item):
    include(locate_template('templates/badges.php'));
  endif;  
}

function render_tags($post_item){
    $tags = get_the_tags($post_item->ID);
    if($tags):
      echo '<div class="tags rte rte--small">';
      echo '<h4 data-drop-container><a href="#">Tags <ion-icon name="ios-arrow-down"></ion-icon>
      <ion-icon name="ios-arrow-up"></ion-icon></a></h4>';
      echo '<div data-drop-target class="tags__inner">';
      foreach($tags as $tag):
        echo '<span class="tag">'.$tag->name.'</span>';
      endforeach;
      echo '</div>';
      echo '</div>';
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

function check_sidebar(){
  if( have_rows('sidebar_content') ): 
    return true;
  else: 
    return false;
  endif; 
}

function render_content_grid_item($post_item, $index = 0){
  if($post_item):
    include(locate_template('templates/content-'.get_post_type($post_item).'.php'));
  endif;
}


function render_content_sidebar($post_item, $index = 0){
  if($post_item):
    include(locate_template('templates/'.get_post_type($post_item).'-sidebar.php'));
  endif;
}

function render_template($template = null, $args = null){
    include(locate_template('templates/'.$template.'.php'));
}

function render_sources($template, $post_item = null){
    include(locate_template('templates/'.$template.'.php'));
}


function render_student_paper($template, $post_item = null){
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
add_filter('acf/fields/flexible_content/layout_title/name=sidebar_content', __NAMESPACE__.'\\flex_content_title', 10, 4);

function render_acf_image_alt($field, $options = false){
  if($options){
    $image = get_field($field, 'options');
  }else{
    $image = get_field($field);
  }

  $image_alt = $image['alt'];
  
  echo $image_alt;
}


// TALLY STUFF
// if (!wp_next_scheduled('check_stats')) {
//   wp_schedule_event( time(), 'daily', 'check_stats' );
// }

// add_action('check_stats', __NAMESPACE__.'\\tally_stats');

// global $all_visualizations;
// global $visualizations_complete;
// global $all_student_papers;
// global $student_papers_with_index;

function content_totals() {
  $all_visualizations = get_posts(array(
    'post_type' =>  'visualization',
    'posts_per_page'  => -1,
    'suppress_filters' => true
  ));
  $visualizations_complete = get_posts(array(
    'post_type' =>  'visualization',
    'posts_per_page'  => -1,
    'suppress_filters' => true,
    'meta_query' => array(
      array(
        'key'     => 'embed',
        'compare' => '!=',
        'value'   => ''        
      )
    )    
  ));  
  $all_student_papers = get_posts(array(
    'post_type' =>  'student_paper',
    'posts_per_page'  => -1,
    'suppress_filters' => true,
  ));
  $student_papers_with_index = get_posts(array(
    'post_type' =>  'student_paper',
    'posts_per_page'  => -1,
    'suppress_filters' => true,
    'meta_query' => array(
      // 'relation' => 'OR',
      array(
        'key'     => 'index_document',
        'compare' => '!=',
        'value'   => ''
      )
    )    
  ));
  include(locate_template('templates/content-totals.php'));
} 

// add_action( 'wp_loaded', __NAMESPACE__.'\\content_totals' );
// 

// CREATE OPTIONS PAGE
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings'
  ));
  acf_add_options_page(array(
    'page_title'  => 'Site Messages',
    'menu_title'  => 'Site Messages'
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
