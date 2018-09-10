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

<?php
	$categories = get_field('data_focus_category');

	if($categories):
		$category = get_category($categories[0]);

		$category_name = $category->slug;
	endif;
?>

<?php 
$featured_image = false;
if(is_single() && has_post_thumbnail() || is_page() && $background_image):
	$featured_image = true;
endif;

?>

<?php
	$page_template = Roots\Sage\Extras\get_page_template();

	$data_focus = false;

	if($page_template == 'page-data-focus.php'):
		$data_focus = true;
	endif;
?>

<div class="page-header <?php if($featured_image): ?>page-header--featured<?php else: ?>page-header--basic<?php endif; ?>">
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
		  	<h1 style="<?php echo $content_color_styles; ?>">
		  		<?php if($data_focus && $categories): ?>
		  			<ion-icon src="<?= get_template_directory_uri(); ?>/dist/images/<?php echo $category_name; ?>.svg"></ion-icon>&nbsp;
		  		<?php endif; ?>
		  		<span>
		  			<?= Titles\title(); ?>
		  		</span>
		  	</h1>
		  	<?php if(get_field('lead_paragraph')): ?>
			  	<p style="<?php echo $content_color_styles; ?>">
			  		<?php the_field('lead_paragraph'); ?>
			  	</p>
		  	<?php endif; ?>
		</div>			
	</div>
</div>
