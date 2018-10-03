<?php

	$classes = 'content-totals rte rte--georgia';

	if(is_archive()):
		$classes .= ' content-totals--archive';
	endif;

	// $current_query = get_posts();

	global $wp_query;

	// var_dump(count($wp_query->posts));

?>

<div class="<?php echo $classes; ?>">
	<div class="inner">
		<?php if(is_post_type_archive('student_paper')): ?>

			Showing <?php echo count($wp_query->posts); ?> student papers of <?php echo count($all_student_papers); ?> total. 

		<?php elseif(is_post_type_archive('visualization')): ?>

			Showing <?php echo count($wp_query->posts); ?> visualization of <?php echo count($all_visualizations); ?> total. 

		<?php else: ?>

			The State of Black Asheville has
			<span class="content-total content-total--all-visualizations">
				<?php echo count($all_visualizations); ?>
			</span>
			total visualizations.
			With
			<span class="content-total content-total--visualizations-complete">
				<?php echo count($visualizations_complete); ?>
			</span>
			dynamic, interactive visualizations.
			We have published
			<span class="content-total content-total--all-student-papers">
				<?php echo count($all_student_papers); ?>
			</span>
			Student Papers. Community members have helped us index
			<span class="content-total content-total--student-papers-with-index">
				<?php echo count($student_papers_with_index); ?>
			</span>	
			of them.

		<?php endif; ?>
	</div>
</div>