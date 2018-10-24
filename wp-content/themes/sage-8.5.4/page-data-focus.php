<?php
/**
 * Template Name: Data Focus
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
  	<div class="container">
	  	<div class="page-content-container<?php if($has_sidebar): ?> has-sidebar<?php else: ?> no-sidebar<?php endif; ?>">
			<div class="main-page-content"> 
				<div class="main-page-content__inner row">
					<?php if(get_the_content()): ?>
					<div class="main-page-content__content rte rte--georgia rte--large">
						<?php the_content(); ?>
					</div>
					<?php endif; ?>
					<?php get_template_part('templates/flexible-content'); ?>
				</div>
			</div>
		  	<?php if($has_sidebar): ?>
			<div class="page-sidebar">
				<?php get_template_part('templates/sidebar-content'); ?>
			</div>
		  	<?php endif; ?>
		</div>
	</div>
<?php endwhile; ?> 
