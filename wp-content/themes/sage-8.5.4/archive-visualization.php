<?php
	$visualization_needed_mode = false;
	if(isset($_GET['visualization_needed'])):
		$visualization_needed_mode = true;
	endif;
	$available_categories = get_categories();

	$all_content = new WP_Query( array (
	    'post_type'             => 'visualization',
	    'posts_per_page'        => -1
	));	

	// var_dump($all_content);

	$all_content_ids = wp_list_pluck($all_content->posts, 'ID'); 

	$available_tags = wp_get_object_terms($all_content_ids, 'post_tag');

	// $available_tags = get_terms(array(
	// 	'taxonomy' => 'post_tag'
	// ));

	$all_visualizations = get_posts(array(
		'post_type' =>  'visualization',
		'posts_per_page'  => -1,
	));

	// var_dump(count($all_visualizations));
	if(isset($_GET['visualization_status'])):
		$visualization_status = $_GET['visualization_status'];		
	else:
		$visualization_status = false;
	endif; 

?>

<?php get_template_part('templates/page', 'header'); ?>
<div class="container">
	<?php //if (!have_posts()) : ?>
	  <!-- <div class="alert alert-warning"> -->
	    <?php //_e('Sorry, no results were found.', 'sage'); ?>
	  <!-- </div> -->
	  <?php //get_search_form(); ?>
	<?php //endif; ?>	
	<div class="row">	
		<?php Roots\Sage\Extras\content_totals(); ?>	
		<div class="archive-listings-filters archive-listings-filters--visualization">
			<form action="/visualizations" method="get">
				<div class="form-group">
					<input type="text" class="form-control" name="archive_search" value="<?php if(isset($_GET['archive_search'])): ?><?php echo $_GET['archive_search']; ?><?php endif; ?>" placeholder="Search by title or content...">				
				</div>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="all" name="visualization_status" value="All" <?php if($visualization_status == 'All' || !$visualization_status ): ?>checked<?php endif; ?>>			
					<label class="form-check-label filter filter--needs-visualization" for="all">
						All
					</label>				
				</div>		
				<br>			
				<div class="form-check">
					<input type="radio" class="form-check-input" id="created" name="visualization_status" value="Created" <?php if($visualization_status == 'Created'): ?>checked<?php endif; ?>>			
					<label class="form-check-label filter filter--needs-visualization" for="created">
						Created
					</label>
					<small class="form-text text-muted">
						These items exist, but have not been visualizated.
					</small>					
				</div>	
				<br>				
				<div class="form-check">
					<input type="radio" class="form-check-input" id="static-visualization" name="visualization_status" value="Static" <?php if($visualization_status == 'Static'): ?>checked<?php endif; ?>>			
					<label class="form-check-label filter filter--needs-visualization" for="static-visualization">
						Visualization
					</label>
					<small class="form-text text-muted">
						These items contain a visualization, but it hasn't been made dynamic yet.
					</small>					
				</div>
				<br>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="dynamic-visualization" name="visualization_status" value="Dynamic" <?php if($visualization_status == 'Dynamic'): ?>checked<?php endif; ?>>			
					<label class="form-check-label filter filter--needs-visualization" for="dynamic-visualization">
						Dynamic Visualization
					</label>
					<small class="form-text text-muted">
						These items contain a dynamic visualization, which is the goal for all visualizations on the website.
					</small>					
				</div>											
				<?php if(false): ?>		
					<h3 class="rte">
						Filters:
					</h3>						
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
				<?php endif; ?>
				<br>
				<h3 class="rte">
					Tags:
				</h3>				
				<?php if(!empty($available_tags)): ?>					
					<?php foreach($available_tags as $tag): ?>
						<?php if($tag->count > 0): ?>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="<?php echo sanitize_title($tag->name); ?>" name="tags[]" value="<?php echo $tag->term_id; ?>" 
								<?php if(isset($_GET['tags']) && in_array($tag->term_id, $_GET['tags'])): ?>checked<?php endif; ?>>			
								<label class="filter filter--needs-visualization" for="<?php echo sanitize_title($tag->name); ?>">
									<?php echo $tag->name; ?>
								</label>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php else: ?>
					<small class="form-text text-muted">
						No tags available based on search and filters.
					</small>
				<?php endif; ?>				
				<input type="submit" class="soba-btn" value="Search">
				<br><br>
				<a href="/student-papers">
					Reset Search & Filter <ion-icon name="refresh"></ion-icon>
				</a>				
			</form>
		</div>
		<div class="archive-listings archive-listings--visualization rte">
			<?php if(have_posts()): ?>
				<div class="row">
					<?php while (have_posts()) : the_post(); ?>
					  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
					<?php endwhile; ?>
				</div>
			<?php else: ?>
				<div class="alert soba-alert">
					Sorry! We couln't find any visualizations with this search and filter applied. Try adjusting the search or filters, or <a href="/visualizations">reset</a>.
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php the_posts_navigation(); ?>	
</div>
