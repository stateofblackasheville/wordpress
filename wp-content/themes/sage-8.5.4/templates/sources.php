<div class="sources rte rte--small">
	<h4 data-drop-container>
		<a href="#">
			Sources
			<ion-icon name="ios-arrow-down"></ion-icon>
			<ion-icon name="ios-arrow-up"></ion-icon>
		</a>
	</h4>	

	<?php
	$other_sources = get_field('use_another_visualizations_sources', $post_item->ID);
	if($other_sources):
		$other_sources_post = $other_sources[0]->ID;
	endif;
	$sources_post = $post_item->ID;	
	?>
	<?php if(have_rows('sources', $sources_post) || have_rows('sources', $other_sources_post)): ?>
	<div class="sources-list-container" data-drop-target>
		<ol class="sources-list">
		<!-- Loop through this post's sources -->
		<?php if(have_rows('sources', $sources_post)): ?>
			<?php

			 	// loop through the rows of data
				$count = 0;

			    while ( have_rows('sources', $sources_post) ) : the_row();
			    	$source = array(
			    		'title' => get_sub_field('source_title'),
			    		'link'	=> get_sub_field('source_link'),
			    		'file'	=> get_sub_field('source_file')
			    	);
			    	$count++;
			?>
			  		<?php Roots\Sage\Extras\render_single_source($source); ?>	

			<?php endwhile; ?>
		<?php endif; ?>
		<!-- Loop through other post's sources -->
		<?php if(isset($other_sources_post) && have_rows('sources', $other_sources_post)): ?>
			<?php

			 	// loop through the rows of data
				$count = 0;

			    while ( have_rows('sources', $other_sources_post) ) : the_row();
			    	$source = array(
			    		'title' => get_sub_field('source_title'),
			    		'link'	=> get_sub_field('source_link'),
			    		'file'	=> get_sub_field('source_file')
			    	);
			    	$count++;
			?>
			  		<?php Roots\Sage\Extras\render_single_source($source); ?>	

			<?php endwhile; ?>		
		<?php endif; ?>
		</ol>
	</div>	
	<?php
	else :
	?>
	<div class="need-sources" data-drop-target>
		<p>
			This content needs a source. If you know where it came from and can provide further details,
			<a href="#intercom">
				please help us source this content.
			</a>					
		</p>
	</div>
	<?php

	endif;

	?>	
</div>	