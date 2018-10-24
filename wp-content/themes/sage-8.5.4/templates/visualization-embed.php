<div class="visualization__content grid-item-content">	
	<?php if(get_field('data_source_id', $post_item->ID)): ?>
			TEST

	<!-- <div class="soba-visualization" data-title="Buncombe County Schools: EOG Science Grades 5&8" data-spreadsheetid="1MHvrDrSnQsPMksW7zAmS2QbyOmuB6qADs10cssrMqk0" data-charttype="bar" data-showcharttypeselect="1"></div> -->
		<?php 

			$visualization_title = get_field('visualization_title', $post_item->ID); 
			$data_source_id = get_field('data_source_id', $post_item->ID);
			$chart_type = get_field('chart_type', $post_item->ID);
			$show_chart_controls = get_field('show_chart_select', $post_item->ID);
			if($show_chart_controls == true):
				$show_chart_controls = 1;
			else:
				$show_chart_controls = 0;
			endif;

		?>
		<div class="soba-visualization" data-title="<?php echo $visualization_title ; ?>" data-spreadsheetid="<?php echo $data_source_id; ?>" data-charttype="<?php echo $chart_type; ?>" data-showcharttypeselect="<?php echo $show_chart_controls; ?>"></div>
	<?php elseif(get_field('embed', $post_item->ID)): ?>
		<div class="visualization__container">
			<div class="visualization__inner" id="visualization-<?php echo $post_item->ID; ?>">
				<?php the_field('embed', $post_item->ID); ?> 	
			</div>
		</div>
		<a class="rte rte--georgia rte--small" data-fancybox data-options='{"caption" : "<?php echo wp_strip_all_tags($post_item->post_content, true); ?>" }' data-src="#visualization-<?php echo $post_item->ID; ?>" href="javascript:;">
			[+] Expand Visualization
		</a>					
	<?php elseif(has_post_thumbnail($post_item->ID)): ?>
		<div class="grid-item-content__image rte rte--georgia">
			<?php echo get_the_post_thumbnail($post_item->ID); ?>
		</div>
		<a class="rte rte--georgia rte--small" href="<?php echo get_the_post_thumbnail_url($post_item->ID, 'large'); ?>" data-fancybox data-caption="<?php echo wp_strip_all_tags($post_item->post_content); ?>">
			[+] Expand Visualization
		</a>			
	<?php endif; ?>						
</div>