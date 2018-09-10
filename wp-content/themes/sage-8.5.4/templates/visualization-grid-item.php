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
	<div class="grid-item__inner">
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
			<?php if(!get_field('embed', $post_item->ID)): ?>
				<div class="rte rte--georgia rte--small">
					<span class="link" data-toggle="tooltip" title="This visualization hasn't been made dynamic yet, but is in the works!">
						<span>
							Work in progress (?)
						</span> 						
					</span>
				</div>
			<?php endif; ?>				
		</div>
		<div class="visualization__content grid-item-content">
			<?php if(get_field('embed', $post_item->ID)): ?>
				<div class="visualization__container">
					<div class="visualization__inner" id="visualization-<?php echo $post_item->ID; ?>">
						<?php the_field('embed', $post_item->ID); ?> 	
					</div>
				</div>
				<a class="rte rte--georgia rte--small" data-fancybox data-options='{"caption" : "<?php echo $post_item->post_content; ?>" }' data-src="#visualization-<?php echo $post_item->ID; ?>" href="javascript:;">
					[+] Expand Visualization
				</a>					
			<?php elseif(has_post_thumbnail($post_item->ID)): ?>
				<div class="grid-item-content__image rte rte--georgia">
					<?php echo get_the_post_thumbnail($post_item->ID); ?>
				</div>
				<a class="rte rte--georgia rte--small" href="<?php echo get_the_post_thumbnail_url($post_item->ID, 'large'); ?>" data-fancybox data-caption="<?php echo $post_item->post_content; ?>">
					[+] Expand Visualization
				</a>			
			<?php endif; ?>
			<div class="content rte rte--georgia">
				<?php echo $post_item->post_content; ?>
			</div>
			<?php Roots\Sage\Extras\render_sources('sources', $post_item); ?>
		</div>
		<?php //if(false): ?>		
			<?php Roots\Sage\Extras\render_tags($post_item); ?>
				
		<?php //endif; ?>
	</div>
</div>