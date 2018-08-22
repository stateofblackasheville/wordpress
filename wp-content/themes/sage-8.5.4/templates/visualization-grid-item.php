<?php
	if(get_field('width', $post_item->ID)):
		$width = get_field('width', $post_item->ID);
	else:
		$width = 'one-third';
	endif;

	$title_link = get_field('title_link', $post_item->ID);

	$sources = get_field('sources', $post_item->ID);

	$categories = get_the_category($post_item->ID);

	if($categories):
		$category_name = $categories[0]->slug;
	endif;
?>
<div class="grid-item visualization grid-item--width-<?php echo $width; ?>">
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
	<div class="content">
		<?php echo $post_item->post_content; ?>
	</div>
	<div class="sources rte rte--small">
		<h4>
			Sources
		</h4>
		<?php

		// check if the repeater field has rows of data
		if( have_rows('sources', $post_item->ID) ):

		 	// loop through the rows of data
		    while ( have_rows('sources', $post_item->ID) ) : the_row();
		    	$source_title = get_sub_field('source_title');
		    	$source_link = get_sub_field('source_link');
		    	$source_file = get_sub_field('source_file');
		?>
		  	<?php if($source_title): ?>
		  		<p>
		  			<?php echo $source_title; ?>
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
		  		</p>
		  	<?php endif; ?>

		<?php 
			endwhile;

		else :

		    // no rows found

		endif;

		?>	
	</div>
</div>