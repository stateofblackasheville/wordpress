<?php use Roots\Sage\Titles; ?>

<!-- COMMON CONTENT SECTION STUFF -->
<?php $background_image_styles = ''; ?>
<?php $background_color_styles = ''; ?>
<?php $content_color_styles = ''; ?>

<?php 
if(is_archive() && get_post_type() == 'student_paper'):
	$post_type = get_post_type();
	$background_image = get_field('student_paper_archive_header_background_image', 'options'); 
	$background_color = get_field('student_paper_archive_header_background_color', 'options');
	$background_opacity = get_field('student_paper_archive_header_background_opacity', 'options');
	$content_color = get_field('student_paper_archive_header_content_color', 'options');
	$lead_paragraph = get_field('student_paper_archive_header_lead_paragraph', 'options');
else if(is_archive() && get_post_type() == 'visualization'):
	$post_type = get_post_type();
	$background_image = get_field('visualization_header_background_image', 'options'); 
	$background_color = get_field('visualization_header_background_color', 'options');
	$background_opacity = get_field('visualization_header_background_opacity', 'options');
	$content_color = get_field('visualization_header_content_color', 'options');
	$lead_paragraph = get_field('visualization_header_lead_paragraph', 'options');
else: 	
	$background_image = get_field('background_image'); 
	$background_color = get_field('background_color');
	$background_opacity = get_field('background_opacity');
	$categories = get_field('data_focus_category');
	$content_color = get_field('content_color');
	$lead_paragraph = get_field('lead_paragraph');
endif; 
?>

<?php if($background_image): ?>	
	<?php $background_image_styles.= 'background-image: url('.$background_image['sizes']['featured'].');'; ?>
<?php endif; ?>
<?php  ?>
<?php if($background_color): ?>
	<?php $background_color_styles .= ' background-color: '.$background_color.';'; ?>
<?php endif; ?>   
<?php if($background_opacity): ?>
	<?php $background_color_styles .= ' opacity: '.$background_opacity.';'; ?>
<?php endif; ?>     
<?php if($content_color): ?>
	<?php $content_color_styles .= ' color: '.$content_color.';'; ?>
<?php endif; ?>  

<?php
	if(!empty($categories)):
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
		  	<?php if($lead_paragraph): ?>
			  	<p style="<?php echo $content_color_styles; ?>">
			  		<?php echo $lead_paragraph; ?>
			  	</p>
		  	<?php endif; ?>
		</div>			
	</div>
</div>
