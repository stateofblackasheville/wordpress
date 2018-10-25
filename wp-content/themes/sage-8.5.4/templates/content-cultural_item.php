<article <?php post_class(); ?>>
	<div class="item-content item-content--cultural-item">
		<div class="item-content__inner">
			<?php if(!is_single() && get_post_type() !== 'cultural_item'): ?>
				<header class="rte rte--georgia">
					<?php //Roots\Sage\Extras\render_badges(get_post()); ?>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				</header>
			<?php endif; ?>
			<br>
			<div class="entry-summary rte rte--georgia">
				<?php if(is_single() && get_post_type() == 'cultural_item'): ?>
					<?php the_content(); ?>
				<?php else: ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div>					
		    <?php if(is_single() && get_post_type() == 'cultural_item'): ?>
				<?php 

				$images = get_field('images');

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
</article>
