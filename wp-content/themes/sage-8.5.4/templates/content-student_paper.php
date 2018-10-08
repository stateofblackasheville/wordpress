<?php
  $file = get_field('files');

  // $related_visualizations = get_posts(array(
  //   'post_type' => 'visualization',
  //   'meta_key'      => 'page_number',
  //   'orderby'     => 'meta_value',
  //   'order'       => 'ASC',    
  //   'meta_query' => array(
  //     array(
  //       'key' => 'document_reference', // name of custom field
  //       'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
  //       'compare' => 'LIKE'
  //     )
  //   )
  // ));

  $related_visualizations_field = get_field('document_reference');

  $related_visualizations = false;

  if(!empty($related_visualizations_field)):

	$related_visualization_ids = wp_list_pluck($related_visualizations_field, 'ID');
	$related_visualizations = get_posts(array(
	'post_type' => 'visualization',
	'post__in'	=> $related_visualization_ids
	));  


  endif;
  // var_dump($related_visualizations);

  $post_type_name = get_post_type_object(get_post_type());

?>

<article <?php post_class(); ?>>
	<?php if(is_single() && get_post_type() == 'student_paper'): ?>
		<?php if ( function_exists('yoast_breadcrumb') ): ?>
			<?php yoast_breadcrumb('<div class="breadcrumbs rte rte--georgia">','</div>'); ?>
		<?php endif; ?> 
	<?php endif; ?>  	
	<div class="student-paper-content">
		<div class="student-paper-content__inner">
			<header class="rte rte--georgia">
				<?php Roots\Sage\Extras\render_badges(get_post()); ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="archive__student-paper-inner rte rte--georgia rte--small">
				<?php if(get_field('author')): ?>
					<i>Authored by <b><?php the_field('author'); ?></b></i>
					<br>
				<?php endif; ?>
				<?php if(get_field('date_of_publication')): ?>
					<i>Original Date of Publication: <b><?php the_field('date_of_publication'); ?></b></i>
					<br>
				<?php endif; ?>	
				<?php if(get_field('indexed_by') && get_field('index_document')): ?>
					<i>Special thanks to <b><?php the_field('indexed_by'); ?></b> for <a href="<?php the_field('index_document'); ?>">indexing this paper</a></i>
					<br>
				<?php endif; ?>								
			</div>
			<br>
			<div class="entry-summary rte rte--georgia">
				<?php if(is_single() && get_post_type() == 'student_paper'): ?>
					<?php the_content(); ?>
				<?php else: ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div>
			<?php if(get_field('files')): ?>
				<a href="<?php echo $file['url'] ?>" class="soba-btn">
					View & Download Paper
				</a>	
			<?php endif; ?>						
		</div>	
	</div>
    <?php if(is_single() && get_post_type() == 'student_paper'): ?>
      <div class="student-paper-index">
      	<h2>
      		Document Index
      	</h2>  
      	<div class="student-paper-index__inner">
      		<?php if(get_field('index_document')): ?>
      			<p>
	      			Paper index:
	      			<a href="<?php the_field('index_document'); ?>">
	      				<?php the_field('index_document'); ?>
	      			</a>
	      		</p>
      			<i>
      				Our process for visualizing existing research includes documenting where each visualization lives in each student paper. This is an important step in bringing important information to the public.
      				You can help with this process! <a href="/how-to-index-student-papers">Learn how to index student papers.</a>
      			</i>
      		<?php else: ?>
      			<p>
      				This paper doesn't seem to have an index document, but you can help create one!
      			</p>
      			<a href="/how-to-index-student-papers">Learn how to index student papers.</a>
      		<?php endif; ?>
      	</div>
      </div>   
      <div class="visualization-listings">
        <div class="visualization-listings__header">
          <h2>
            Visualizations within this <?php echo $post_type_name->labels->singular_name ?>
          </h2>
        </div>
        <?php if($related_visualizations): ?>
	        <div class="visualizations-listings__listings">
	          <?php foreach($related_visualizations as $visualization): ?>
	            <div class="visualization-listings__item">
	              <div class="visualization-listings__page-number">
	                <?php if(get_field('page_number', $visualization->ID)): ?>
	                <span class="rte rte--georgia">
	                  Page <?php the_field('page_number', $visualization->ID); ?>
	                </span>
	                <?php else: ?>
	                <span class="rte rte--georgia">
	                  Page number not specified (<a href="#intercom">help us specify the page number</a>).
	                </span>
	                <?php endif; ?>
	              </div>
	              <?php Roots\Sage\Extras\render_content_grid_item($visualization); ?>
	            </div>
	          <?php endforeach; ?>
	        </div>
	    <?php else: ?>
	    	<div class="visulizations-listings__no-results">
	    		<div class="inner">
	      			<p>
	      				This paper doesn't seem to have any associated visualizations. Right now the State of Black Asheville team is responsible for creating them, but if you'd like to become a contributor, we'd love to have you!
	      			</p>
	      			<a href="#intercom">Contact us to learn more!</a>	 
	      		</div>   		
	    	</div>
	    <?php endif; ?>
      </div>
    <?php endif; ?>	
</article>
