<?php
	$classes = 'grid-item sidebar-item visualization';

	$classes .= ' grid-item--width-one-whole';

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
	<div class="grid-item__inner">
		<div class="visualization__content">
			<div class="content rte rte--georgia">
				<?php echo $post_item->post_content; ?>
			</div>
			<?php if(get_field('embed', $post_item->ID)): ?>
			<div class="visualization__container">
				<?php the_field('embed', $post_item->ID); ?> 	
			</div>
			<?php endif; ?>

			<?php Roots\Sage\Extras\render_sources('sources', $post_item); ?>
		</div>
		<?php Roots\Sage\Extras\render_tags($post_item); ?>	
	</div>
</div>