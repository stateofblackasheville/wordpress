<header class="banner">
  <nav class="nav-primary navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="brand" href="<?= esc_url(home_url('/')); ?>">
        <img src="<?php Roots\Sage\Extras\render_acf_image_url('logo', 'medium', true); ?>" alt="<?php Roots\Sage\Extras\render_acf_image_alt('logo', true); ?>"/>
        <?php //bloginfo('name'); ?>
      </a>      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'depth' => 5, 'walker' => new WP_Bootstrap_Navwalker()]);
        endif;
        ?>
        <?php //get_search_form(true); ?>
      </div>
    </div>
  </nav>
</header>
