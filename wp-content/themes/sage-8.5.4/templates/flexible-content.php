<?php if( have_rows('content') ): ?>
	<?php while ( have_rows('content') ) : the_row(); ?>
		<!-- COMMON CONTENT SECTION STUFF -->
		<?php $background_image_styles = ''; ?>
		<?php $background_color_styles = ''; ?>
		<?php $content_color_styles = ''; ?>
		<?php $classes = ''; ?>

    	<?php $background_image = get_sub_field('background_image'); ?>
    	<?php if($background_image): ?>	
    		<?php $background_image_styles.= 'background-image: url('.$background_image['url'].');'; ?>
    	<?php endif; ?>
 
    	<?php $background_color = get_sub_field('background_color'); ?>
    	<?php if($background_color): ?>
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

    	<?php if(get_sub_field('no_padding')): ?>
    		<?php $classes .= 'no-padding'; ?>
    	<?php endif; ?>
    	<?php if(get_sub_field('full_width')): ?>
    		<?php $classes .= 'full-width'; ?>
    	<?php endif; ?>    	


		<?php $link = get_sub_field('section_link'); ?>	

		<div class="content-section background-type__<?php the_sub_field('background_type'); ?> content-section__<?php echo get_row_layout(); ?>">
			<?php if($background_image): ?>
				<div class="content-section__bg content-section__bg--image" style="<?php echo $background_image_styles; ?>">
				</div>
			<?php endif; ?>
			<?php if($background_color): ?>
				<div class="content-section__bg content-section__bg--color" style="<?php echo $background_color_styles; ?>">
				</div>
			<?php endif; ?>		
			<?php if(get_sub_field('title') || get_sub_field('description')): ?>
				<div class="content-section__header">
					<h2 style="<?php echo $content_color_styles; ?>">
						<?php the_sub_field('title'); ?>
					</h2>
					<p style="<?php echo $content_color_styles; ?>">
						<?php the_sub_field('description'); ?>
					</p>
				</div>
			<?php endif; ?>	
			<!-- END COMMON CONTENT SECTION STUFF -->
        <?php if(get_row_layout() == 'grid_content' ): ?>
			<?php if( have_rows('grid_content__items') ): ?>
				<div class="content-section__grid">
				    <?php while ( have_rows('grid_content__items') ) : the_row(); ?>
				    <div class="content-section__item" style="<?php echo $content_color_styles; ?>">
				    	<?php if(get_sub_field('title')): ?>
				    	<h3 style="<?php echo $content_color_styles; ?>">
				        	<?php the_sub_field('title'); ?>
				        </h3>
				    	<?php endif; ?>
				    	<?php if(get_sub_field('icon')): ?>
				    		<?php $image = get_sub_field('icon'); ?>
				    		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
				    	<?php endif; ?>
				    	<?php if(get_sub_field('description')): ?>
				        <p style="<?php echo $content_color_styles; ?>">
				        	<?php the_sub_field('description'); ?>
				        </p>
				    	<?php endif; ?>
					</div>			    	
				    <?php endwhile; ?>
			    </div>
			<?php else : ?>

			<?php endif; ?> 
			<?php if( $link ): ?>
			<div class="section__link">
				<a class="button" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
					<?php echo $link['title']; ?>
				</a>
			</div>
			<?php endif; ?>				       	
        	
        <?php elseif( get_row_layout() == 'slider_content' ): ?>
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
			<?php elseif( get_row_layout() == 'slider_content' ): ?>
				<div class="content-section__inner">
					<h2 style="<?php echo $content_color_styles; ?>">
						<?php the_sub_field('title'); ?>
					</h2>
					<?php the_sub_field('description'); ?>
					<?php if( $link ): ?>
						<div class="section__link">
							<a class="button" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
								<?php echo $link['title']; ?>
							</a>
						</div>					
					<?php endif; ?>						
				</div>			
			<?php else : ?>

			<?php endif; ?>   

        <?php endif; ?>
    	</div>    	
    <?php endwhile; ?>
	<?php else : ?>
	<!-- NOTHINGNESS -->
<?php endif; ?>