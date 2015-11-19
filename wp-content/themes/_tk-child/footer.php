<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _tk
 */
?>
<div class="container footer-top">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3">
				<h3>Products</h3>
				<?php 	
					$args = array(
						    'orderby'           => 'name', 
						    'order'             => 'ASC',
						    'hide_empty'        => true, 
						    'exclude'           => array(), 
						    'exclude_tree'      => array(), 
						    'include'           => array(),
						    'number'            => '', 
						    'fields'            => 'all', 
						    'slug'              => '',
						    'parent'            => '0',
						    'hierarchical'      => false, 
						    'child_of'          => 0,
						    'childless'         => false,
						    'get'               => '', 
						    'name__like'        => '',
						    'description__like' => '',
						    'pad_counts'        => false
						);
						$terms = get_terms('categories', $args);
						echo '<ul class="footer-one">';
						foreach($terms as $term){
							echo '<li><a style="font-size:1em;" href="' . get_site_url() . '/categories/' . $term->slug . '">' . $term->name . '</a></li>';
							//echo '<a href="#" class="list-group-item large ' . $active . '" data-toggle="collapse" data-target="#sm' . $i . '" data-parent="#menu">' . $term->name . '</a>';
						}
						echo '</ul>';
					
					/*
					wp_nav_menu(
					array(
						'theme_location'  => '_tk-child',
						'menu'            => 'Footer Column One Top - Products',
						'container'       => 'ul',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu-footer',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s footer-one">%3$s</ul>',
						'depth'           => 2,
						'walker'          => ''
					));*/
				?>
				
				<h3>Controllers & Software</h3>
				<?php	
					$args = array(
					'post_type' => 'product',
					'tax_query' => array(
						array(
							'taxonomy' => 'categories',
							'field'    => 'slug',
							'terms'    => 'controllers-and-software'
						),
					),
				);
				$the_query = new WP_Query( $args );

				if($the_query->have_posts()): ?>
					<ul class="footer-one">
					<?php while($the_query->have_posts()):
						$the_query->the_post(); ?>
						<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
			<div class="col-md-3">
				<h3>Special Application Chambers</h3>
				<?php
				$special_apps = get_terms('categories','parent=5');
				if($special_apps):
					echo '<ul class="ia-footer">';
					foreach($special_apps as $special_app):
						$special_app_link = get_term_link($special_app);
						echo '<li><a href="'. $special_app_link .'">'. $special_app->name .'</a></li>';
					endforeach;
					echo '</ul>';
				endif;
				?>
			</div>
			<div class="col-md-3">
				<h3>Industry Applications</h3>
				<?php
					$items = get_terms( 'applications', 'parent=0&orderby=name&hide_empty=0' );
					echo '<ul class="ia-footer">';		
					foreach($items as $item){
						echo '<li><a style="font-size:1em;" href="' . get_site_url() . '/applications/' . $item->slug . '">' . $item->name . '</a></li>';
					}
					echo '</ul>';	
				?>
				<h3>Service</h3>
				<?php	
					$args = array(
					'post_type' => 'service',
					'posts_per_page' => -1,
				);
				$the_query = new WP_Query( $args );

				if($the_query->have_posts()): ?>
					<ul class="footer-one">
					<?php while($the_query->have_posts()):
						$the_query->the_post(); ?>
						<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
			<div class="col-md-3">
			<h3>Locations</h3>
			<?php wp_nav_menu(
					array(
						'theme_location'  => '_tk-child',
						'menu'            => 'Footer Column Four - Locations',
						'container'       => 'ul',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu-footer',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '<span style="color:#8A9400">&rsaquo;</span>&nbsp;',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s submenu-custom">%3$s</ul>',
						'depth'           => 2,
						'walker'          => ''
					)
				); ?>
				<h3>Contact Us</h3>
				<div class="col-md-12 site-map" style="display:none;">
					<a href="#"><img style="float:left;" src="<?php echo get_stylesheet_directory_uri(); ?>/img/facebook.png" /></a>
					<a href="#"><img style="float:left;padding-left:10px;" src="<?php echo get_stylesheet_directory_uri(); ?>/img/linkedin.png" /></a>
					<a href="#"><img style="float:left;padding-left:10px;" src="<?php echo get_stylesheet_directory_uri(); ?>/img/twitter.png" /></a>
				</div>
				<div class="col-md-12 site-map">
					<a href="<?php echo home_url(); ?>/sitemap">Site Map</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container footer-bottom">
	<div class="col-md-12">
		<div class="col-md-offset-8 col-md-4" style="text-align:right;">
			&copy; <?php echo date("Y");?> Weiss Envirotronics, Inc. All rights reserved.
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
