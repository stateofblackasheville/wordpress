<?php if( have_rows('sidebar_content') ): ?>
	<?php while ( have_rows('sidebar_content') ) : the_row(); ?>
			<?php Roots\Sage\Extras\render_template('common-flex-sidebar'); ?>
    <?php endwhile; ?>
	<?php else : ?>
	<!-- NOTHINGNESS -->
<?php endif; ?>