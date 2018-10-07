<div class="sources rte rte--small">
	<h4 data-drop-container>
		<a href="#">
			Sources
			<ion-icon name="ios-arrow-down"></ion-icon>
			<ion-icon name="ios-arrow-up"></ion-icon>
		</a>
	</h4>			
	<?php

	// check if the repeater field has rows of data
	if( have_rows('sources', $post_item->ID) ):
	?>
	<div class="sources-list-container" data-drop-target>
		<ol class="sources-list">
		<?php

		 	// loop through the rows of data
			$count = 0;

		    while ( have_rows('sources', $post_item->ID) ) : the_row();
		    	$source_title = get_sub_field('source_title');
		    	$source_link = get_sub_field('source_link');
		    	$source_file = get_sub_field('source_file');
		    	$count++;
		?>
		  	
		  		<li class="sources-list__item">
	<!-- 		  				<span class="source-item__count">
	  					(<?php //echo $count; ?>)
	  				</span>	 -->		  			
		  			<?php if($source_title): ?>
		  			<span class="item__title">
		  				<?php echo $source_title; ?>
		  			</span>
		  			<?php endif; ?>
		  			<?php if($source_link): ?>
		  				<a href="<?php echo $source_link['url']; ?>" target="<?php echo $source_link['target']; ?>">
		  					<?php if(!empty($source_link['title'])): ?>
		  						<?php echo $source_link['title']; ?>
		  					<?php else: ?>
		  						<?php echo $source_link['url']; ?>
		  					<?php endif; ?>
		  				</a>
		  			<?php endif; ?>
		  			<?php if($source_file): ?>
		  				<a href="<?php echo $source_file['url']; ?>" target="_blank">
		  					<?php echo $source_file['title']; ?> <ion-icon name="document"></ion-icon>
		  				</a>
		  			<?php endif; ?>		  			
		  		</li>
		  	<?php //endif; ?>

		<?php 
			endwhile;
		?>
		</ol>
		<?php if(get_field('document_reference', $post_item->ID)): ?>
			<?php $student_papers = get_field('document_reference', $post_item->ID); ?>
			<div class="visualization__student-paper">
				<div class="visualization__student-paper-inner">
					<h4>
						Student Paper(s):
					</h4>
					<?php foreach($student_papers as $student_paper): ?>
						<a href="<?php echo get_the_permalink($paper->ID); ?>">
							<?php echo $student_paper->post_title; ?>
						</a>
						<br>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>	
	<?php
	else :
	?>
	<div class="need-sources">
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