<?php
	$index_needed_mode = false;
	
	if(isset($_GET['index_needed'])):
		$index_needed_mode = true;
	endif;

	$all_content = new WP_Query( array (
	    'post_type'             => 'student_paper',
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
		<div class="archive-listings-filters archive-listings-filters--student-papers">
			<?php //get_search_form(); ?>
			<form action="/student-papers" method="get">
				<div class="form-group">
					<input type="text" class="form-control" name="archive_search" value="<?php if(isset($_GET['archive_search'])): ?><?php echo $_GET['archive_search']; ?><?php endif; ?>" placeholder="Search by title or content...">
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="needs-index" name="index_needed" value="true" <?php if($index_needed_mode): ?>checked<?php endif; ?>>			
					<label class="form-check-label filter filter--needs-visualization" for="needs-index">
						Needs to be indexed
						<br>
						<small class="form-text text-muted">
							We are creating digital, interactive visualizations from the content of these papers. You can help us by <a href="/how-to-index-student-papers/">indexing a student paper</a>.
						</small>
					</label>
				</div>
				<br>	
				<h3 class="rte">
					Tags:
				</h3>				
				<?php if(!empty($available_tags)): ?>					
					<?php foreach($available_tags as $tag): ?>
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="<?php echo sanitize_title($tag->name); ?>" name="tags[]" value="<?php echo $tag->term_id; ?>" 
						<?php if(isset($_GET['tags']) && in_array($tag->term_id, $_GET['tags'])): ?>checked<?php endif; ?>>			
						<label class="form-check-label filter filter--needs-visualization" for="<?php echo sanitize_title($tag->name); ?>">
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
		<div class="archive-listings archive-listings--student-papers rte">
			<?php if (have_posts()) : ?>			
				<?php while (have_posts()) : the_post(); ?> 
				  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
				<?php endwhile; ?>
			<?php else: ?>
				<div class="alert soba-alert">
					Sorry! We couln't find any student papers with this search and filter applied. Try adjusting the search or filters, or <a href="/student-papers">reset</a>.
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php the_posts_navigation(); ?>
