<?php
  $related_visualizations = get_field('document_reference', $post_item->ID);

  if(!empty($related_visualizations)): 
  	$visualized = true;
  else:
  	$visualized = false;
  endif;	
?>

<div class="badges">
	<span class="badge badge--active badge--stage-one">
		Created &nbsp; <ion-icon name="checkmark-circle-outline"></ion-icon>
	</span>	
	<ion-icon name="arrow-forward"></ion-icon>
	<?php if(get_post_type($post_item) == 'student_paper'): ?>
			<span class="badge badge--stage-two <?php if(get_field('index_document', $post_item->ID)): ?>badge--active<?php else: ?>badge--inactive<?php endif; ?>" data-toggle="tooltip"  <?php if(get_field('index_document', $post_item->ID)): ?>title="The index for this student paper has been completed!"<?php else: ?>title="The index for this student paper has not yet been completed."<?php endif; ?>>
				Indexed
				<?php if(get_field('index_document', $post_item->ID)): ?> 
					&nbsp; <ion-icon name="checkmark-circle-outline"></ion-icon>
				<?php endif; ?>
			</span>
			<ion-icon name="arrow-forward"></ion-icon>
			<span class="badge badge--stage-three <?php if($visualized): ?>badge--active<?php else: ?>badge--inactive<?php endif; ?>" data-toggle="tooltip" <?php if($visualized): ?>title="One or more visualizations within this paper have been created."<?php else: ?>title="The visualizations within this paper have not yet been created."<?php endif; ?>>
				Visualized
				<?php if($visualized): ?>
					&nbsp; <ion-icon name="checkmark-circle-outline"></ion-icon> 
				<?php endif; ?>
			</span>			
	<?php endif; ?>
	<?php if(get_post_type($post_item) == 'visualization'): ?>
		<span class="badge badge--stage-two <?php if(has_post_thumbnail($post_item->ID) || get_field('embed', $post_item->ID) || get_field('data_source_id', $post_item->ID)): ?>badge--active<?php endif; ?>" data-toggle="tooltip">
			Visualization
			<?php if(has_post_thumbnail($post_item->ID) || get_field('embed', $post_item->ID) || get_field('data_source_id', $post_item->ID)): ?>
				&nbsp; <ion-icon name="checkmark-circle-outline"></ion-icon> 
			<?php endif; ?>
		</span>
		<ion-icon name="arrow-forward"></ion-icon>
		<span class="badge badge--stage-three <?php if(get_field('embed', $post_item->ID) || get_field('data_source_id', $post_item->ID)): ?>badge--active<?php endif; ?>" data-toggle="tooltip">
			Dynamic
			<?php if(get_field('embed', $post_item->ID) || get_field('data_source_id', $post_item->ID)): ?>
				&nbsp; <ion-icon name="checkmark-circle-outline"></ion-icon> 
			<?php endif; ?>
		</span>		
	<?php endif; ?>	
</div>