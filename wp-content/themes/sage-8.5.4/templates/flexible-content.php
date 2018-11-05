<?php if( have_rows('content') ): ?>
	<?php $flex_count = 0; ?>
	<?php while ( have_rows('content') ) : the_row(); ?>
			<?php $flex_count++; ?>
			<?php Roots\Sage\Extras\render_template('common-flex-content', $flex_count); ?>
			<!-- END COMMON CONTENT SECTION STUFF -->	
    <?php endwhile; ?>
    <?php reset_rows(); ?>
<?php else : ?>
	<!-- NOTHINGNESS -->
<?php endif; ?>