<?php

	if(is_archive()):
		$post_item = $post;
	endif;

	if(is_single() && get_post_type() == 'visualization'):
		$post_item = $post;
	endif;	

	$images = get_field('images', $post->ID);

	// var_dump($post);

	if(is_single() && get_post_type($post->ID) !== 'cultural_item')

?>
<div class="item-content item-content--cultural-item">
	<div class="item-content__inner">
		<?php if(!is_singular('cultural_item')): ?>
			<header class="rte rte--georgia">
				<a class="hover--bg-enlarge" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $images[0]['sizes']['medium']; ?>)">
					<?php //Roots\Sage\Extras\render_badges(get_post()); ?>
					<h2 class="entry-title">
						<?php echo get_the_title($post->ID); ?>
					</h2>
					<i class="rte rte--georgia rte--large">
						<?php echo count($images); ?> Images
					</i>
				</a>
			</header>
		<?php endif; ?>
		<div class="entry-summary rte rte--georgia">
			<?php if(is_single() && get_post_type($post->ID) == 'cultural_item'): ?>
				<?php get_the_content($post->ID); ?>
			<?php else: ?>
				<?php get_the_excerpt($post->ID); ?>
			<?php endif; ?>
		</div>					
	    <?php if(is_singular('cultural_item')): ?>
			<?php 
			if( $images ): ?>
			    <div class="masonry">
			        <?php foreach( $images as $image ): ?>
			            <div class="masonry-item">
			                <a href="<?php echo $image['url']; ?>" data-fancybox="gallery" data-caption="<?php echo $image['caption']; ?>">
			                     <img src="<?php echo $image['sizes']['square']; ?>" alt="<?php echo $image['alt']; ?>" />
			                </a>
			                <?php if(!empty($image['caption'])): ?>
			                	<p><?php echo $image['caption']; ?></p>
			                <?php endif; ?>
			            </div>
			        <?php endforeach; ?>
			    </div>
			<?php endif; ?>
	    <?php endif; ?>	
	</div>	
</div>
