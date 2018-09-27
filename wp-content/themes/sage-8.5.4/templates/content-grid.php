<div class="content-section__inner">
	<div class="row">
	<?php $content_section_type = get_sub_field('type'); ?>

	<?php if($content_section_type == 'Custom'): ?>
		<div class="content-section__custom-container rte georgia">
			<?php the_sub_field('content'); ?>
		</div>
	<?php //elseif($content_section_type == 'Relational Dynamic'): ?>
		<?php 

		$dynamic_content_type = get_sub_field('dynamic_content_type');
		$dynamic_content_category = get_sub_field('dynamic_content_category');
		$dynamic_content_tag = get_sub_field('dynamic_content_tag');

		if(get_sub_field('limit')):
			$post_limit = get_sub_field('limit');
		else:
			$post_limit = 3;
		endif; 

		$content_arr = get_posts(array(
			'post_type' => $dynamic_content_type,
			'cat'	=> $dynamic_content_category,
			'tag__and' => $dynamic_content_tag,
			'numberposts' => $post_limit
		));

		//var_dump($content_arr);

		?>

		<?php if($content_arr): ?>
			<?php foreach($content_arr as $content): ?>
				<?php Roots\Sage\Extras\render_content_grid_item($content); ?>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php elseif( $content_section_type == 'Relational Curated'): ?>
		<?php $content = get_sub_field('curated_content_custom', false, false); ?>

		<?php 	

			if(isset($_GET['data_year'])):
				$data_year = $_GET['data_year'];
			else:
				$data_year = '';
			endif;

			$args = array(
				'post_type' => 'any',
			    'post__in' => $content,
			    'tag' => $data_year,
			    'orderby' => 'post__in'
			); 

			$content_filtered = get_posts($args);

			//var_dump($content); 

		?>

		<?php foreach($content_filtered as $content): ?>
			<?php Roots\Sage\Extras\render_content_grid_item($content); ?>
		<?php endforeach; ?>
	<?php elseif( $content_section_type == 'Tabs'): ?>
		<div class="tab-container">
			<?php if( have_rows('tabs') ): ?>
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			    <?php while ( have_rows('tabs') ) : the_row(); ?>
					<?php $content = get_sub_field('tab_content', false, false); ?>
					<?php $tab_id = sanitize_title(get_sub_field('tab_title')); ?>
				  	<li class="nav-item">
				  		<a class="nav-link <?php if(get_row_index() == 1): ?>active<?php endif; ?>" id="tab_<?php echo $tab_id; ?>" data-toggle="pill" href="#tab_content_<?php echo $tab_id; ?>" role="tab" aria-controls="tab_<?php echo $tab_id; ?>" <?php if(get_row_index() == 1): ?>aria-selected="true"<?php endif; ?>>
				    		<?php the_sub_field('tab_title'); ?>
				    	</a> 
				  	</li>			
			    <?php endwhile; ?>
				</ul>
				<div class="tab-content" id="pills-tabContent">
			    <?php while ( have_rows('tabs') ) : the_row(); ?>
					<?php $content = get_sub_field('tab_content', false, false); ?>
					<?php $tab_id = sanitize_title(get_sub_field('tab_title')); ?>
					<?php 	

						if(isset($_GET['data_year'])):
							$data_year = $_GET['data_year'];
						else:
							$data_year = '';
						endif;

						$args = array(
							'post_type' => 'any',
						    'post__in' => $content,
						    'tag' => $data_year,
						    'orderby' => 'post__in'
						); 

						$content_filtered = get_posts($args);
						// var_dump($content_filtered);

					?>		    	
			    	<div class="tab-pane fade show<?php if(get_row_index() == 1): ?> active<?php endif; ?>" id="tab_content_<?php echo $tab_id; ?>" role="tabpanel" aria-labelledby="pills-home-tab">
			    		<div class="tab-pane__inner">
				    		<div class="tab-description rte">
				    			<h3>
				    				<?php the_sub_field('tab_title'); ?>
				    			</h3>				    			
				    			<?php the_sub_field('tab_description'); ?>
				    			<hr>
				    		</div>
							<?php foreach($content_filtered as $content): ?>
								<?php Roots\Sage\Extras\render_content_grid_item($content); ?>
							<?php endforeach; ?>
						</div>
					</div>				
				<?php endwhile; ?>	
				</div>		
			<?php endif; ?>
		</div>
	<?php endif; ?>
	</div>				       	
</div>