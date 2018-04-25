<footer class="content-info">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <div class="footer-menus">
    	<div class="footer-menus__menu">
	        <?php if (has_nav_menu('footer_menu_1')) : ?>
	        	<?php $footer_menu_1 = wp_get_nav_menu_object(3); ?> 
	        	<h3>
	        		<?php echo $footer_menu_1->name; ?>
	        	</h3>
	        	<?php wp_nav_menu(['theme_location' => 'footer_menu_1', 'menu_class' => 'footer-nav']); ?>
	        <?php endif; ?> 
	    </div> 
	    <?php if (has_nav_menu('footer_menu_2')) : ?>
    	<div class="footer-menus__menu">
        	<?php $footer_menu_1 = wp_get_nav_menu_object(22); ?> 
        	<h3>
        		<?php echo $footer_menu_1->name; ?>
        	</h3>    		
	        <?php
	        if (has_nav_menu('footer_menu_2')) :
	          wp_nav_menu(['theme_location' => 'footer_menu_2', 'menu_class' => 'footer-nav']);
	        endif;
	        ?> 
	    </div> 
		<?php endif; ?>
		<?php if (has_nav_menu('footer_menu_3')) : ?>
    	<div class="footer-menus__menu">
        	<?php $footer_menu_1 = wp_get_nav_menu_object(23); ?> 
        	<h3>
        		<?php echo $footer_menu_1->name; ?>
        	</h3>      		
	        <?php
	        if (has_nav_menu('footer_menu_3')) :
	          wp_nav_menu(['theme_location' => 'footer_menu_3', 'menu_class' => 'footer-nav']);
	        endif;
	        ?> 
	    </div> 
	    <?php endif; ?>	    	     	
    </div>
  </div>
</footer>
