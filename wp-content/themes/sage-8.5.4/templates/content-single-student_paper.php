<?php while (have_posts()) : the_post(); ?>

<?php
  $file = get_field('files');
?>

  <article <?php post_class(); ?>>
    <div class="student-paper-content">
      <header class="rte">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="student-paper-content__inner">
          <?php if(get_field('author')): ?>
          <span>by <?php the_field('author'); ?></span>
          <br>
          <?php endif; ?>
          <a href="<?php echo $file['url']; ?>" class="soba-btn">
            Download Paper
          </a>
        </div>
      </header>

      <div class="entry-content rte">
        <?php the_content(); ?>
      </div>
      <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
    </div>
  </article>
<?php endwhile; ?>
