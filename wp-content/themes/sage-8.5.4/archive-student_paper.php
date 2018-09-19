<?php
	$index_needed_mode = false;
	if(isset($_GET['index_needed'])):
		$index_needed_mode = true;
	endif;
?>

<?php get_template_part('templates/page', 'header'); ?>
<div class="container">
	<?php if (!have_posts()) : ?>
	  <div class="alert alert-warning">
	    <?php _e('Sorry, no results were found.', 'sage'); ?>
	  </div>
	  <?php get_search_form(); ?>
	<?php endif; ?>	
	<div class="row">
		<div class="archive-listings-filters archive-listings-filters--student-papers">
			<form action="/student-papers" method="get">
				<h3 class="rte">
					Filters:
				</h3>
				<input type="checkbox" id="needs-index" name="index_needed" value="true" <?php if($index_needed_mode): ?>checked<?php endif; ?>>			
				<label class="filter filter--needs-visualization" for="needs-index">
					Needs to be indexed
				</label>
				<br>
				<input type="submit" class="soba-btn" value="Filter">
			</form>
		</div>		
		<div class="archive-listings archive-listings--student-papers rte">
			<?php while (have_posts()) : the_post(); ?> 
			  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php the_posts_navigation(); ?>
