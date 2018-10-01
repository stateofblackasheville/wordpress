<?php while (have_posts()) : the_post(); ?>
  <!-- <article <?php //post_class(); ?>> -->
    <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>    
  <!-- </article> -->
<?php endwhile; ?>
