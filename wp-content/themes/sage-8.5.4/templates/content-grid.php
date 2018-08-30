<div class="content-section__inner">
	<div class="container">
		<div class="row">
		<?php $content_section_type = get_sub_field('type'); ?>

		<?php if($content_section_type == 'Custom'): ?>
			<?php the_sub_field('content'); ?>
		<?php elseif($content_section_type == 'Relational Dynamic'): ?>
			<?php 

			$dynamic_content = get_sub_field('dynamic_content');

			if(get_sub_field('limit')):
				$post_limit = get_sub_field('limit');
			else:
				$post_limit = 3;
			endif; 

			$content_arr = get_posts(array(
				'post_type' => $dynamic_content,
				'numberposts' => $post_limit
			));

			// var_dump($dynamic_content);

			?>

			<?php if($content_arr): ?>
				<?php foreach($content_arr as $content): ?>
					<?php Roots\Sage\Extras\render_content_grid_item($content); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php elseif( $content_section_type == 'Relational Curated'): ?>
			<?php if( have_rows('curated_content_custom') ): ?>
	    		<?php while ( have_rows('curated_content_custom') ) : the_row(); ?>
	    			<?php $content = get_sub_field('content'); ?>
	    				<?php Roots\Sage\Extras\render_content_grid_item($content); ?>
	        	<?php endwhile; ?>
	    	<?php endif; ?>
		<?php endif; ?>
		</div>	
	</div>				       	
</div>