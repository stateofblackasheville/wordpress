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

		<?php //if($content_arr): ?>
			<?php //foreach($content_arr as $content): ?>
				<?php //Roots\Sage\Extras\render_content_grid_item($content); ?>
			<?php //endforeach; ?>
		<?php //endif; ?>
	<?php elseif( $content_section_type == 'Relational Curated'): ?>
		<?php $content = get_sub_field('curated_content_custom', false, false); ?>

		<?php 	

			if(isset($_GET['data_year'])):
				$data_year = $_GET['data_year'];
			else:
				$data_year = '';
			endif;

			$args = array(
				'post_type' => 'visualization',
			    'post__in' => $content,
			    'tag' => $data_year,
			    'orderby' => 'post__in'
			); 

			$content_filtered = get_posts($args);

			//var_dump($content); 

		?>

		<?php foreach($content_filtered as $content): ?>
			<?php //var_dump($content['post_title']); ?>
			<?php Roots\Sage\Extras\render_content_grid_item($content); ?>
		<?php endforeach; ?>

		<?php //if( have_rows('curated_content_custom') ): ?>
    		<?php //while ( have_rows('curated_content_custom') ) : the_row(); ?>
				<?php //$content = get_sub_field('content'); ?>
				<?php //var_dump($content); ?>
				<?php //Roots\Sage\Extras\render_content_grid_item($content[0]); ?>
        	<?php //endwhile; ?>
    	<?php //endif; ?>
	<?php endif; ?>
	</div>				       	
</div>