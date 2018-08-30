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


<?php if(get_sub_field('image_alignment')): ?>
	<?php $classes .= 'image-align--'.get_sub_field('image_alignment'); ?>
<?php endif; ?>
<?php if(get_sub_field('header_width')): ?>
	<?php $classes .= 'header-width--'.get_sub_field('header_width'); ?>
<?php endif; ?>
<?php if(get_sub_field('header_alignment')): ?>
	<?php $classes .= ' header-align--'.get_sub_field('header_alignment'); ?>
<?php endif; ?>
<?php if(get_sub_field('content_alignment')): ?>
	<?php $classes .= ' content-align--'.get_sub_field('content_alignment'); ?>
<?php endif; ?>
<?php if(get_sub_field('padding_amount')): ?>
	<?php $classes .= ' padding--'.get_sub_field('padding_amount'); ?>
<?php endif; ?>
<?php if(get_sub_field('full_width')): ?>
	<?php $classes .= ' full-width'; ?>
<?php endif; ?>    	


<?php $link = get_sub_field('section_link'); ?>	


<div class="content-section background-type__<?php the_sub_field('background_type'); ?> content-section__<?php echo get_row_layout(); ?> <?php echo $classes; ?>">
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
					<h2 style="<?php echo $header_color_styles; ?>">
						<?php the_sub_field('title'); ?>
					</h2>
					<div style="<?php echo $content_color_styles; ?>" class="rte rte--georgia">
						<?php the_sub_field('description'); ?>
					</div>
					<?php if(get_sub_field('call_to_action')): ?>
						<?php $link = get_sub_field('call_to_action'); ?>
						<a href="<?php echo $link['url'] ?>" class="soba-btn <?php if(get_sub_field('button_color') == 'white'): ?>soba-btn--white<?php endif; ?>">
							<?php echo $link['title'] ?>
						</a>					
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