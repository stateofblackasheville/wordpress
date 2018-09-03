<?php
	$classes = 'grid-item visualization';

	if(get_sub_field('width')):
		$classes .= ' grid-item--width-'.get_sub_field('width');
	elseif(get_field('width', $post_item->ID)):
		$classes .= ' grid-item--width-'.get_field('width', $post_item->ID);
	else:
		$classes .= ' grid-item--width-one-third';
	endif;

	$display_mode = false;

	if(get_sub_field('use_display_mode')):
		$classes .= ' display-mode';
	endif;

	$title_link = get_field('call_to_action', $post_item->ID);

	$sources = get_field('sources', $post_item->ID);

	$categories = get_the_category($post_item->ID);

	$student_papers = get_field('student_papers', $post_item->ID);


	if($categories):
		$category_name = $categories[0]->slug;
	endif;

	$fast_fact = false;

	if(get_field('fast_fact') == true):
		$fast_fact = true;
		$classes .= ' visualization--fast-fact';
	endif;
?>
<div class="<?php echo $classes; ?>">
	<div class="visualization__header grid-item-header">
		<h3>
			<?php if($categories): ?>
				<ion-icon src="<?= get_template_directory_uri(); ?>/dist/images/<?php echo $category_name; ?>.svg"></ion-icon>
			<?php endif; ?>
			<span class="grid-item__title">
				<?php echo get_the_title($post_item->ID); ?>
			</span>
			<?php if($title_link): ?>
				<a href="<?php echo $title_link['url']; ?>" target="<?php echo $title_link['target']; ?>">
					<span class="title-link">
						<?php echo $title_link['title']; ?>
					</span>
				</a>
			<?php endif; ?>
		</h3>
	</div>
	<div class="visualization__content grid-item-content">
		<?php if(has_post_thumbnail($post_item->ID)): ?>
		<div class="grid-item-content__image rte rte--georgia">
			<a href="<?php echo get_the_post_thumbnail_url($post_item->ID, 'large'); ?>" data-fancybox data-caption="<?php echo $post_item->post_content; ?>">
				<?php echo get_the_post_thumbnail($post_item->ID); ?>
			</a>
		</div>
		<?php endif; ?>
		<div class="content rte rte--georgia">
			<?php echo $post_item->post_content; ?>
		</div>
		<?php if(get_field('embed', $post_item->ID)): ?>
		<div class="visualization__container">
			<?php the_field('embed', $post_item->ID); ?> 	
		</div>
		<?php endif; ?>

		<div class="sources rte rte--small">
			<?php

			// check if the repeater field has rows of data
			if( have_rows('sources', $post_item->ID) ):
			?>
			<h4>
				Sources:
			</h4>
			<?php

			 	// loop through the rows of data
			    while ( have_rows('sources', $post_item->ID) ) : the_row();
			    	$source_title = get_sub_field('source_title');
			    	$source_link = get_sub_field('source_link');
			    	$source_file = get_sub_field('source_file');
			    	$student_paper = get_sub_field('source_student_paper');
			?>
			  	<?php if($source_title): ?>
			  		<div>
			  			<span>
			  				<?php echo $source_title; ?>
			  			</span>
			  			<?php if($source_link): ?>
			  				<br>
			  				<br>
			  				<span>
			  					Link:&nbsp;
			  				</span>
			  				<a href="<?php echo $source_link['url']; ?>" target="<?php echo $source_link['target']; ?>">
			  					<?php echo $source_link['title']; ?>
			  				</a>
			  			<?php endif; ?>
			  			<?php if($source_file): ?>
			  				<br>
			  				<br>
			  				<span>
			  					Downloads:&nbsp;
			  				</span>
			  				<?php //var_dump($source_file); ?>
			  				<a href="<?php echo $source_file['url']; ?>">
			  					<?php echo $source_file['title']; ?> <ion-icon name="document"></ion-icon>
			  				</a>
			  			<?php endif; ?>
			  			<?php if($student_paper): ?>
			  				<br>
			  				<br>
			  				<span>
			  					Student Paper:&nbsp;
			  				</span>
			  				<?php //var_dump($source_file); ?>
			  				<a href="<?php echo get_the_permalink($student_paper->ID); ?>">
			  					<?php echo $student_paper->post_title; ?>
			  				</a>
			  			<?php endif; ?>			  			
			  		</div>
			  	<?php endif; ?>

			<?php 
				endwhile;

			else :

			    // no rows found

			endif;

			?>	
		</div>
	</div>
	<?php //if(false): ?>
		<div class="tags rte rte--small">		
			<?php Roots\Sage\Extras\render_tags($post_item); ?>
		</div>	
	<?php //endif; ?>
</div>