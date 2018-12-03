<?php
/**
 * Template Name: Visualization Form
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>

  <?php 

  $settings = array(
  	'post_id' => 'new_post',
	'new_post'		=> array(
		'post_type'	=> 'visualization',
		'post_status'		=> 'draft'
	),
  );

  ?>

  <?php acf_form( $settings ); ?>

<?php endwhile; ?>
