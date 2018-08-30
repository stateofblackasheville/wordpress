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
	<div class="visualization__header">
		<h3>
			<?php if($categories): ?>
				<ion-icon src="<?= get_template_directory_uri(); ?>/dist/images/<?php echo $category_name; ?>.svg"></ion-icon>
			<?php endif; ?>
			<span class="grid-item__title">
				<?php echo get_the_title($post_item->ID); ?>
			</span>
			<?php if($title_link): ?>
				<a href="<?php echo $title_link['url']; ?>">
					<span class="title-link">
						<?php echo $title_link['title']; ?>
					</span>
				</a>
			<?php endif; ?>
		</h3>
	</div>
	<div class="visualization__content">
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
			?>
			  	<?php if($source_title): ?>
			  		<div>
			  			<span>
			  				<?php echo $source_title; ?> –
			  			</span>
			  			<?php if($source_link): ?>
			  				<a href="<?php echo $source_link['url']; ?>">
			  					<?php echo $source_link['title']; ?>
			  				</a>
			  			<?php endif; ?>
			  			<?php if($source_file): ?>
			  				<span class="divider">
			  					&nbsp;|&nbsp;
			  				</span>
			  				<?php //var_dump($source_file); ?>
			  				<a href="<?php echo $source_file['url']; ?>">
			  					Download files <ion-icon name="document"></ion-icon>
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