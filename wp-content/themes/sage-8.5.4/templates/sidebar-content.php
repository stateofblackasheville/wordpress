<?php if($template = 'page-data-focus.php'): ?>
	<?php 

	$args = array(
	    'post_type'=> 'visualization',
	    'actor'    => get_the_tag_list(),
	    'order'    => 'ASC'
	);
	$posts_array = get_posts( $args ); 

	?>
<?php endif; ?>