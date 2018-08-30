<?php if( have_rows('content') ): ?>
	<?php while ( have_rows('content') ) : the_row(); ?>
			<?php Roots\Sage\Extras\render_template('common-flex-content'); ?>
			<!-- END COMMON CONTENT SECTION STUFF -->	
    <?php endwhile; ?>
	<?php else : ?>
	<!-- NOTHINGNESS -->
<?php endif; ?>