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

	$all_content_ids = wp_list_pluck($all_content->posts, 'ID'); 

	$available_tags = wp_get_object_terms($all_content_ids, 'post_tag');
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
		<div class="archive-listings-filters archive-listings-filters--visualization">
			<form action="/visualizations" method="get">
				<div class="form-group">
					<input type="text" class="form-control" name="archive_search" value="<?php if(isset($_GET['archive_search'])): ?><?php echo $_GET['archive_search']; ?><?php endif; ?>" placeholder="Search by title or content...">				
				</div>	
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="needs-visualization" name="visualization_needed" value="true" <?php if($visualization_needed_mode): ?>checked<?php endif; ?>>			
					<label class="form-check-label filter filter--needs-visualization" for="needs-index">
						Work in Progress
						<br>
						<small class="form-text text-muted">
							You can help build tools for community analysis by creating a Google Sheet that we will turn into interactive visualization. <a href="#intercom">Contact us to get started</a>.
						</small>
					</label>
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
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="<?php echo sanitize_title($tag->name); ?>" name="tags[]" value="<?php echo $tag->term_id; ?>" 
							<?php if(isset($_GET['tags']) && in_array($tag->term_id, $_GET['tags'])): ?>checked<?php endif; ?>>			
							<label class="filter filter--needs-visualization" for="<?php echo sanitize_title($tag->name); ?>">
								<?php echo $tag->name; ?>
							</label>
						</div>
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
			<div class="row">
				<?php if(have_posts()): ?>
					<?php while (have_posts()) : the_post(); ?>
					  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
					<?php endwhile; ?>
				<?php else: ?>
					<div class="alert soba-alert">
						Sorry! We couln't find any visualizations with this search and filter applied. Try adjusting the search or filters, or <a href="/visualizations">reset</a>.
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php the_posts_navigation(); ?>	
</div>
