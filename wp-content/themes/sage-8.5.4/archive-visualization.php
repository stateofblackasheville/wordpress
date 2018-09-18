<?php
	$visualization_needed_mode = false;
	if(isset($_GET['visualization_needed'])):
		$visualization_needed_mode = true;
	endif;
	$available_categories = get_categories();

	// var_dump($available_categories);
?>

<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div class="container">
	<div class="row">
		<div class="archive-listings-filters archive-listings-filters--visualization">
			<form action="/visualizations" method="get">
				<h3 class="rte">
					Filters:
				</h3>
				<input type="checkbox" id="needs-visualization" name="visualization_needed" value="true" <?php if($visualization_needed_mode): ?>checked<?php endif; ?>>			
				<label class="filter filter--needs-visualization" for="needs-visualization">
					Interactive Visualization Needed
				</label>
				<select name="category">
					<option value="all">
						All
					</option>						
					<?php foreach($available_categories as $category): ?>
					<!-- <option -->					
						<?php if($category->slug !== 'uncategorized'): ?>
							<option value="<?php echo $category->slug; ?>" <?php if(isset($_GET['category']) && $_GET['category'] == $category->slug): ?>selected<?php endif; ?>>
								<?php echo $category->name; ?>
							</option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
				<br>
				<input type="submit" class="soba-btn" value="Filter">
			</form>
		</div>
		<div class="archive-listings archive-listings--visualization rte">
			<div class="row">
				<?php while (have_posts()) : the_post(); ?>
				  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<?php the_posts_navigation(); ?>	
</div>
