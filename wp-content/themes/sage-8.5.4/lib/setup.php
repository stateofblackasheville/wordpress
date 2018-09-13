<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'footer_menu_1' => __('Footer Menu 1', 'sage'),
    'footer_menu_2' => __('Footer Menu 2', 'sage'),
    'footer_menu_3' => __('Footer Menu 3', 'sage'),    
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
    is_page(),
    is_single(),
    is_archive()
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/** 
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css?v=1.0.5'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js?v=1.0.5'), ['jquery'], null, true);

  // IONICONS
  wp_enqueue_script('ionicons', 'https://unpkg.com/ionicons@4.4.2/dist/ionicons.js', ['jquery'], null, true);
  wp_enqueue_style('ionicons_css', 'https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css', false, null);

  // REACT JS
  wp_enqueue_script('react', 'https://unpkg.com/react@16/umd/react.development.js', ['jquery'], null, true);
  wp_enqueue_script('react_dom', 'https://unpkg.com/react-dom@16/umd/react-dom.development.js', ['jquery'], null, true);
  wp_enqueue_script('react_soba', 'https://unpkg.com/soba-visualization@latest/umd/soba-visualization.js', ['jquery'], null, true);
  wp_enqueue_script('visualization', Assets\asset_path('scripts/visualization.js'),['react_soba'], null, true);

  // INTERCOM
  wp_enqueue_script('intercom', Assets\asset_path('scripts/intercom.js'), ['jquery'], null, true);

  // REACT CSS
  // wp_enqueue_style('soba_visualization', 'https://unpkg.com/soba-visualization@1.3.1/umd/main.a96e0308.css', false, null);
  wp_enqueue_style('visualization', Assets\asset_path('styles/visualization.css'), false, null);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
