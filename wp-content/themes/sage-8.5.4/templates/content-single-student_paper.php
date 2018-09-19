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
        <?php if ( function_exists('yoast_breadcrumb') ): ?>
          <?php yoast_breadcrumb('<div class="breadcrumbs rte rte--georgia">','</div>'); ?>
        <?php endif; ?>        
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="student-paper-content__inner">
          <?php if(get_field('author')): ?>
          <span>by <?php the_field('author'); ?></span>
          <br>
          <?php endif; ?>
        </div>
      </header>

      <div class="entry-content rte">
        <?php the_content(); ?>
      </div>
      <br>
      <div>
        <a href="<?php echo $file['url']; ?>" class="soba-btn">
          Download Paper
        </a>
      </div>
      <?php if(get_field('status') == 'Needs Index'): ?> 
        <br>
        <div class="rte soba-alert">
          <p>
            This paper has not yet been indexed. You can help us bring the visualizations within this paper to the public by indexing it!
          </p>
          <?php if(get_field('index_document')): ?>
            <a href="<?php the_field('index_document'); ?>">
              Start indexing 
            </a>
            – or –
            <a href="/how-to-index-student-papers">
              Learn how to index student papers
            </a>
          <?php else: ?>
            <a href="#intercom">Contact us</a> to index this document. 
            <br>
            <br>
            You can also
            <a href="/how-to-index-student-papers">
              learn how to index our documents
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>              

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
                  <?php if(get_field('page_number', $visualization->ID)): ?>
                  <span class="rte rte--georgia">
                    Page <?php the_field('page_number', $visualization->ID); ?>
                  </span>
                  <?php else: ?>
                  <span class="rte rte--georgia">
                    Page number not specified (<a href="#intercom">help us specify the page number</a>).
                  </span>
                  <?php endif; ?>
                </div>
                <?php Roots\Sage\Extras\render_content_grid_item($visualization); ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
    </div>
  </article>
<?php endwhile; ?>
