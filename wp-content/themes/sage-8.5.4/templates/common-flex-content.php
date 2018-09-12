<!-- COMMON CONTENT SECTION STUFF -->
<?php $background_image_styles = ''; ?>
<?php $background_color_styles = ''; ?>
<?php $content_color_styles = ''; ?>
<?php $classes = ''; ?>
<?php $section_description_classes = ''; ?>

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
	<?php $classes .= ' custom-content-color '; ?>
<?php endif; ?>  

<?php $header_color = get_sub_field('header_color'); ?>
<?php if($header_color): ?>
	<?php $header_color_styles = ' color: '.$header_color.';'; ?>
<?php else: ?>
	<?php $header_color_styles = ' color: '.$content_color.';'; ?>
<?php endif; ?>      	     	

<?php if(get_sub_field('background_opacity')): ?>
	<?php $background_opacity = get_sub_field('background_opacity'); ?>
	<?php $background_color_styles .= ' opacity: '.$background_opacity.';'; ?>
<?php endif; ?>    

<?php if(get_sub_field('top_level_section') && is_string(get_sub_field('header_width'))): ?>
	<?php $classes .= 'level--top'.get_sub_field('top_level'); ?>
<?php else: ?>
	<?php $classes .= 'level--sub'.get_sub_field('top_level'); ?>	
<?php endif; ?>
<?php if(get_sub_field('image_alignment') && is_string(get_sub_field('image_alignment'))): ?>
	<?php $classes .= ' image-align--'.get_sub_field('image_alignment'); ?>
<?php endif; ?>
<?php if(get_sub_field('header_width') && is_string(get_sub_field('header_width'))): ?>
	<?php $classes .= ' header-width--'.get_sub_field('header_width'); ?>
<?php endif; ?>
<?php if(get_sub_field('header_alignment') && is_string(get_sub_field('header_alignment'))): ?>
	<?php $classes .= ' header-align--'.get_sub_field('header_alignment'); ?>
<?php endif; ?>
<?php if(get_sub_field('content_alignment') && is_string(get_sub_field('content_alignment'))): ?>
	<?php $classes .= ' content-align--'.get_sub_field('content_alignment'); ?>
<?php endif; ?>
<?php if(get_sub_field('padding_top') && is_string(get_sub_field('padding_top'))): ?>
	<?php $classes .= ' padding-top--'.get_sub_field('padding_top'); ?>
<?php endif; ?>
<?php if(get_sub_field('padding_bottom') && is_string(get_sub_field('padding_bottom'))): ?>
	<?php $classes .= ' padding-bottom--'.get_sub_field('padding_bottom'); ?>
<?php endif; ?>
<?php if(get_sub_field('full_width') && is_string(get_sub_field('full_width'))): ?>
	<?php $classes .= ' full-width'; ?>
<?php endif; ?>  
<?php if(get_sub_field('header_border') && is_string(get_sub_field('header_border'))): ?>
	<?php $classes .= ' header-border'; ?> 
<?php endif; ?>    
<?php if(get_sub_field('additional_classes') && is_string(get_sub_field('additional_classes'))): ?>
	<?php $classes .= ' '.get_sub_field('additional_classes'); ?> 
<?php endif; ?>  

<?php if(get_sub_field('section_description_classes') && is_string(get_sub_field('section_description_classes'))): ?>
	<?php $section_description_classes .= ' '.get_sub_field('section_description_classes'); ?> 
<?php endif; ?>    	


<?php $link = get_sub_field('section_link'); ?>	


<div class="content-section background-type__<?php the_sub_field('background_type'); ?> content-section--<?php echo get_row_layout(); ?> <?php echo $classes; ?>">
	<div class="content-section__inner-container">
		<div class="content-section__row">
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
					<?php if(get_sub_field('top_level_section') || get_row_layout() == 'banner_content'): ?>
						<h2 style="<?php echo $header_color_styles; ?>">
					<?php else: ?>
						<h3 style="<?php echo $header_color_styles; ?>">
					<?php endif; ?>
						<?php the_sub_field('title'); ?>
					<?php if(get_sub_field('top_level_section')): ?>						
						</h2>
					<?php else: ?>
						</h3>
					<?php endif; ?>	
					<?php if(get_sub_field('description')): ?>
						<div style="<?php echo $content_color_styles; ?>" class="rte rte--georgia <?php echo $section_description_classes; ?>">
							<?php the_sub_field('description'); ?>
						</div>
					<?php endif; ?>
					<?php if(get_sub_field('call_to_action')): ?>
						<div class="content-section__call-to-action">
							<?php $link = get_sub_field('call_to_action'); ?>
							<a href="<?php echo $link['url'] ?>" class="soba-btn <?php if(get_sub_field('button_color') == 'white'): ?>soba-btn--white<?php endif; ?>">
								<?php echo $link['title'] ?> <ion-icon name="ios-arrow-forward"></ion-icon>
							</a>
						</div>					
					<?php endif; ?>
				</div>
				<?php if(get_sub_field('content_image')): ?>
					<?php $content_image = get_sub_field('content_image'); ?>
					<div class="content-section__image">
						<img src="<?php echo $content_image['url']; ?>"/>
					</div>
				<?php endif; ?>
			<?php endif; ?>	
			<?php if( get_row_layout() == 'content_grid' ): ?>
				<?php Roots\Sage\Extras\render_template('content-grid'); ?>
			<?php elseif( get_row_layout() == 'slider_content' ): ?>
				<?php Roots\Sage\Extras\render_template('slider-content'); ?>	
			<?php else : ?> 

			<?php endif; ?> 
		</div>
	</div>
</div>