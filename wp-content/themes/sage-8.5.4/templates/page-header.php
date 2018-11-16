<?php use Roots\Sage\Titles; ?>

<!-- COMMON CONTENT SECTION STUFF -->
<?php $background_image_styles = ''; ?>
<?php $background_color_styles = ''; ?>
<?php $content_color_styles = ''; ?>

<?php 
if(is_archive()):
	$archive_query = get_queried_object();
	$post_type = $archive_query->name;
	
	$background_image = get_field($post_type.'_archive_header_background_image', 'options'); 
	$background_color = get_field($post_type.'_archive_header_background_color', 'options');
	$background_opacity = get_field($post_type.'_archive_header_background_opacity', 'options');
	$content_color = get_field($post_type.'_archive_header_content_color', 'options');
	$lead_paragraph = get_field($post_type.'_archive_header_lead_paragraph', 'options');
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

	// DETERMINE PAGE CAT
	if(!empty($categories)):
		$category = get_category($categories[0]);
		$category_name = $category->slug;
	endif;

	// CHECK FEATURED IMAGE
	$featured_image = false;
	if(is_single() && has_post_thumbnail() || is_page() && $background_image):
		$featured_image = true;
	endif;

	// PAGE TEMPLATE CHECK
	$page_template = Roots\Sage\Extras\get_page_template();

	$data_focus = false;

	if($page_template == 'page-data-focus.php'):
		$data_focus = true;
	endif;

	// SUBNAVIGATION
	$parent_page_id = wp_get_post_parent_id(get_the_ID());

	if($parent_page_id == 0):
		$parent_page_id = get_the_ID();
	endif;

	$section_pages = get_posts(array(
	    'post_type'      => 'page',
	    'posts_per_page' => -1,
	    'post_parent'    => $parent_page_id,
	    'order'          => 'ASC',
	    'orderby'        => 'menu_order'
	 ));	

	// var_dump($section_pages);

	// var_dump($parent_page_id);

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
		<div class="container page-header__content <?php if(!$background_image): ?>page-header__content--basic<?php endif; ?>">
			<?php if ( function_exists('yoast_breadcrumb') ): ?>
				<?php yoast_breadcrumb('<div class="breadcrumbs rte rte--georgia" style="'.$content_color_styles.';">','</div>'); ?>
			<?php endif; ?>
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
<?php if($data_focus): ?>
<nav id="section-nav" class="navbar navbar-light bg-light">
	<h3 class="current-section">

	</h3>
  <ul class="nav nav-pills">
  	<?php if(false): ?>
		<?php if( have_rows('content') ): ?>
			<?php $flex_count = 0; ?>
			<?php while ( have_rows('content') ) : the_row(); ?>
					<?php $flex_count++; ?>
					<?php $section_id = sanitize_title(get_sub_field('title')); ?>
					<?php if(get_sub_field('title')): ?>
					    <li class="nav-item header">
					      <a class="nav-link" href="#<?php echo $section_id; ?>-<?php echo $flex_count; ?>"><?php echo get_sub_field('title'); ?></a>
					    </li>
					<?php endif; ?>
					<!-- END COMMON CONTENT SECTION STUFF -->	
		    <?php endwhile; ?>
		    <?php reset_rows(); ?>
		<?php else : ?>
			<!-- NOTHINGNESS -->
		<?php endif; ?>
	<?php endif; ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Jump To</a>
      <div class="dropdown-menu">
      	<h6 class="dropdown-header">Current Section:</h6>
      	<a href="<?php echo get_the_permalink($parent_page_id); ?>" class="dropdown-item<?php if($parent_page_id == get_the_ID()): ?> active-page<?php endif; ?>">
      		<span><?php echo get_the_title($parent_page_id); ?></span>
      	</a>
      	<div class="dropdown-divider"></div>
		<?php if($data_focus && !empty($section_pages)): ?>
			<h6 class="dropdown-header">Also In <?php echo get_the_title($parent_page_id); ?>:</h6>
			<?php foreach($section_pages as $section_page): ?>
				<a class="dropdown-item<?php if($section_page->ID == get_the_ID()): ?> active-page<?php endif; ?>" href="<?php the_permalink($section_page->ID); ?>">
					<span><?php echo get_the_title($section_page->ID); ?></span>
				</a>
			<?php endforeach; ?>
			<div class="dropdown-divider"></div>			
		<?php endif; ?>      	
		<?php if( have_rows('content') ): ?>
			<?php $flex_count = 0; ?>
			<h6 class="dropdown-header">Sections on this page:</h6>
			<?php while ( have_rows('content') ) : the_row(); ?>
				<?php $flex_count++; ?>
				<?php $section_id = sanitize_title(get_sub_field('title')); ?>
				<?php if(get_sub_field('title')): ?>
				    <a class="dropdown-item" href="#<?php echo $section_id; ?>-<?php echo $flex_count; ?>">
				    	<?php if(get_sub_field('top_level_section') !== true): ?>
				    		<ion-icon name="ios-arrow-forward"></ion-icon>&nbsp;
				    	<?php endif; ?>
				     	<span><?php echo get_sub_field('title'); ?></span>
				    </a>
				<?php endif; ?>
				<!-- END COMMON CONTENT SECTION STUFF -->	
		    <?php endwhile; ?>
		    <?php reset_rows(); ?>
		<?php else : ?>
			<!-- NOTHINGNESS -->
		<?php endif; ?>
      </div>
    </li>	
  </ul>
</nav>
<?php endif; ?>	
<?php if($data_focus && !empty($section_pages) && false): ?>
<nav class="subnavigation">
	<div class="container">
		<div class="row">
			<div class="subnavigation__inner">
				<ul>
				<?php foreach($section_pages as $section_page): ?>
					<?php //var_dump($section_page); ?>
					<li <?php if($section_page->ID == get_the_ID()): ?>class="active"<?php endif; ?>>
						<a href="<?php the_permalink($section_page->ID); ?>">
							<?php echo get_the_title($section_page->ID); ?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</nav>
<?php endif; ?>
