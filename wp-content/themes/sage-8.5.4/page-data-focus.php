<?php
/**
 * Template Name: Data Focus
 */
?>
<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part('templates/page', 'header'); ?>

	<!-- <div class="container"> -->
		<div class="row">
			<?php //get_template_part('templates/content', 'page-data-focus'); ?>

			<?php $content_arr = get_field('visualizations'); ?>
			<?php if($content_arr): ?>
				<?php foreach($content_arr as $content): ?>
					<?php Roots\Sage\Extras\render_content_grid_item($content); ?>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php get_template_part('templates/flexible-content'); ?>
		</div>
	<!-- </div> -->

<?php endwhile; ?> 
