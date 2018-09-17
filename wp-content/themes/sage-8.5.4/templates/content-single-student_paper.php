<?php while (have_posts()) : the_post(); ?>

<?php
  $file = get_field('files');

  $related_visualizations = get_posts(array(
    'post_type' => 'visualization',
    'meta_key'      => 'page_number',
    'orderby'     => 'meta_value',
    'order'       => 'ASC',    
    'meta_query' => array(
      array(
        'key' => 'document_reference', // name of custom field
        'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
        'compare' => 'LIKE'
      )
    )
  ));

  $post_type_name = get_post_type_object(get_post_type());

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

      <?php if($related_visualizations): ?>
        <div class="visualization-listings">
          <div class="visualization-listings__header">
            <h2>
              Visualizations within this <?php echo $post_type_name->labels->singular_name ?>
            </h2>
          </div>
          <div class="visulizations-listings__listings">
            <?php foreach($related_visualizations as $visualization): ?>
              <div class="visualization-listings__item">
                <div class="visualization-listings__page-number">
                  <h3>
                    Page <?php the_field('page_number', $visualization->ID); ?>
                  </h3>
                </div>
                <?php Roots\Sage\Extras\render_content_grid_item($visualization); ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php else: ?>
        <div class="visualization-no-results rte rte--large">
          This <?php echo $post_type_name->labels->singular_name ?> does not currently have any associated visualizations, but you can help us by indexing them! It's not super hard and it will make important research information more accessible.<br>
          <a href="#intercom">I'd like to index this paper</a>
        </div>
      <?php endif; ?>

      <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
    </div>
  </article>
<?php endwhile; ?>
