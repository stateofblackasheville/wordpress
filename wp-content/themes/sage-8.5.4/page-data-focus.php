<?php
/**
 * Template Name: Data Focus
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  	<div class="container">
	  	<div class="page-content-container">
		  <div class="main-page-content"> 
		  	<div class="main-page-content__content rte rte--georgia rte--large">
		  		<?php the_content(); ?>
		  	</div>
		  	<?php get_template_part('templates/flexible-content'); ?>
		  </div>
		  <div class="page-sidebar">
		  	<?php get_template_part('templates/sidebar-content'); ?>
		  </div>
		</div>
	</div>
<?php endwhile; ?> 
