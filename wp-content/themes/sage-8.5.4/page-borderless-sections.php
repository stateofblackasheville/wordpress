<?php
/**
 * Template Name: Borderless Section Page
 */
?>

<?php 
	$has_sidebar = false;
	if( have_rows('sidebar_content') ): 
		$has_sidebar = true;
	endif; 
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  	<div class="page-content-container">
		<div class="main-page-content"> 
			<?php if(get_the_content()): ?>
			<div class="main-page-content__content rte rte--georgia rte--large">
				<div class="container">
					<div class="row">
						<div class="main-page-content__inner">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php get_template_part('templates/flexible-content'); ?>
		</div>
	</div>
<?php endwhile; ?> 
