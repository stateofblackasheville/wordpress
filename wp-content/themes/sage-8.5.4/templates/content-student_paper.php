<article <?php post_class(); ?>>
	<div class="student-paper-content">
		<header>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="archive__student-paper-inner">
				<?php if(get_field('author')): ?>
				<span>by <?php the_field('author'); ?></span>
				<br>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>" class="soba-btn">
					Download Paper
				</a>
			</div>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
