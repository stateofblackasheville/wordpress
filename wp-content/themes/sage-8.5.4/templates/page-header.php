<?php use Roots\Sage\Titles; ?>

<!-- COMMON CONTENT SECTION STUFF -->
<?php $background_image_styles = ''; ?>
<?php $background_color_styles = ''; ?>
<?php $content_color_styles = ''; ?>

<?php $background_image = get_field('background_image'); ?>
<?php if($background_image): ?>	
	<?php $background_image_styles.= 'background-image: url('.$background_image['url'].');'; ?>
<?php endif; ?>

<?php $background_color = get_field('background_color'); ?>
<?php if($background_color): ?>
	<?php $background_color_styles .= ' background-color: '.$background_color.';'; ?>
<?php endif; ?>   

<?php if(get_field('background_opacity')): ?>
	<?php $background_opacity = get_field('background_opacity'); ?>
	<?php $background_color_styles .= ' opacity: '.$background_opacity.';'; ?>
<?php endif; ?>     

<?php $content_color = get_field('content_color'); ?>
<?php if($content_color): ?>
	<?php $content_color_styles .= ' color: '.$content_color.';'; ?>
<?php endif; ?>  

<div class="page-header">
	<?php if(is_single() && has_post_thumbnail() || is_page() && has_post_thumbnail()): ?>
		<div class="content-section background-type__<?php the_field('background_type'); ?> content-section__<?php echo get_row_layout(); ?>">
			<?php if($background_image): ?>
				<div class="content-section__bg content-section__bg--image" style="<?php echo $background_image_styles; ?>">
				</div>
			<?php endif; ?>
			<?php if($background_color): ?>
				<div class="content-section__bg content-section__bg--color" style="<?php echo $background_color_styles; ?>">
				</div>
			<?php endif; ?>	
			<div class="container page-header__content">
			  	<h1 style="<?php echo $content_color_styles; ?>"><?= Titles\title(); ?></h1>
			  	<?php if(get_field('lead_paragraph')): ?>
				  	<p style="<?php echo $content_color_styles; ?>">
				  		<?php the_field('lead_paragraph'); ?>
				  	</p>
			  	<?php endif; ?>
			</div>			
		</div>
	<?php else: ?>
	<div class="container">
	  	<h1><?= Titles\title(); ?></h1>
	</div>
	<?php endif; ?>
</div>