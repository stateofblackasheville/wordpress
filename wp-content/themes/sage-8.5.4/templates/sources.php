<div class="sources rte rte--small">
	<h4>
		Sources:
	</h4>			
	<?php

	// check if the repeater field has rows of data
	if( have_rows('sources', $post_item->ID) ):
	?>
	<ol class="sources-list">
	<?php

	 	// loop through the rows of data
		$count = 0;

	    while ( have_rows('sources', $post_item->ID) ) : the_row();
	    	$source_title = get_sub_field('source_title');
	    	$source_link = get_sub_field('source_link');
	    	$source_file = get_sub_field('source_file');
	    	$student_papers = get_sub_field('source_student_paper');
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
	  					<?php echo $source_link['title']; ?>
	  				</a>
	  			<?php endif; ?>
	  			<?php if($source_file): ?>
	  				<a href="<?php echo $source_file['url']; ?>" target="_blank">
	  					<?php echo $source_file['title']; ?> <ion-icon name="document"></ion-icon>
	  				</a>
	  			<?php endif; ?>
	  			<?php if($student_papers): ?>
	  				<?php foreach($student_papers as $student_paper): ?>
	  					<?php $student_paper_download = get_field('files', $student_paper->ID); ?>
	  					<?php //var_dump($student_paper_download); ?>
		  				<a href="<?php echo $student_paper_download['url']; ?>" target="_blank">
		  					<?php echo $student_paper->post_title; ?> (download)
		  				</a>
	  				<?php endforeach; ?>
	  			<?php endif; ?>			  			
	  		</li>
	  	<?php //endif; ?>

	<?php 
		endwhile;
	?>
	</ol>
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