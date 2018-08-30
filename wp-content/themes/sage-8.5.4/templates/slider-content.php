<?php if( have_rows('slider_content__items') ): ?>
	<div class="content-section__slider slick-slider">
	    <?php while ( have_rows('slider_content__items') ) : the_row(); ?>

		<?php $background_image_styles = ''; ?>
		<?php $background_color_styles = ''; ?>
		<?php $content_color_styles = ''; ?>
    	<?php if(get_sub_field('background_image')): ?>
    		<?php $background_image = get_sub_field('background_image'); ?>
    		<?php $background_image_styles.= 'background-image: url('.$background_image['sizes']['featured'].');'; ?>
    	<?php endif; ?>
    	<?php if(get_sub_field('background_color')): ?>
    		<?php $background_color = get_sub_field('background_color'); ?>
    		<?php $background_color_styles .= ' background-color: '.$background_color.';'; ?>
    	<?php endif; ?>   
    	<?php $content_color = get_sub_field('content_color'); ?>
    	<?php if($content_color): ?>
    		<?php $content_color_styles .= ' color: '.$content_color.';'; ?>
    	<?php endif; ?>  			    	
    	<?php if(get_sub_field('background_opacity')): ?>
    		<?php $background_opacity = get_sub_field('background_opacity'); ?>
    		<?php $background_color_styles .= ' opacity: '.$background_opacity.';'; ?>
    	<?php endif; ?> 

		<?php $link = get_sub_field('link'); ?>			    	

		<?php $classes = ''; ?>

		<?php if(get_sub_field('image_position')): ?>
			<?php $image_position = get_sub_field('image_position'); ?>
			<?php $classes .= 'image-position__'.$image_position; ?>
		<?php endif; ?>
	    <div class="content-section__item content-section__item--slider background-type__<?php the_sub_field('background_type'); ?> <?php echo $classes; ?>">
			<?php if($background_image): ?>
				<div class="content-section__bg content-section__bg--image" style="<?php echo $background_image_styles; ?>">
				</div>
			<?php endif; ?>
			<?php if($background_color): ?>
				<div class="content-section__bg content-section__bg--color" style="<?php echo $background_color_styles; ?>">
				</div>
			<?php endif; ?>	
			<div class="slider__inner">
		    	<?php if(get_sub_field('content_image')): ?>
		    		<?php $image = get_sub_field('content_image'); ?>
			    	<div class="slider-image" style="background-image: url(<?php echo $image['sizes']['large-square']; ?>);">
			    	</div>
		    	<?php endif; ?>						
				<div class="slider-content">
			    	<?php if(get_sub_field('title')): ?>
			    	<h3 style="<?php echo $content_color_styles; ?>">
			        	<?php the_sub_field('title'); ?>
			        </h3>
			    	<?php endif; ?>
			    	<?php if(get_sub_field('description')): ?>
			        <p style="<?php echo $content_color_styles; ?>">
			        	<?php the_sub_field('description'); ?>
			        </p>
			    	<?php endif; ?>
					<?php if( $link ): ?>
						<div class="section__link">
							<a class="button" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
								<?php echo $link['title']; ?>
							</a>
						</div>
					<?php endif; ?>						    	
			    </div>
			</div>
		</div>			    	
	    <?php endwhile; ?>
    </div>