<?php
/* Template Name: Resources */

get_header(); ?>

<div class="container">
	<div class="row">
		<img src="<?php echo get_field('banner_image'); ?>">
	</div>
</div>
<div class="container category-body">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3">
				<div class="products product-side-nav">
					<div class="sidebar-title">
						Resources
					</div>
				</div>
				<div id="menu" class="product-menu">
					<div class="panel list-group">
						<?php if($post->post_title == 'Brochures'){ $active = "list-group-item-active"; } ?>
						<?php echo '<a href="' . esc_url( home_url( '/' ) ) . 'brochures' . '" class="list-group-item large ' . $active . ' " data-parent="#menu">Brochures</a>'; $active = '';?>
						<?php if($post->post_title == 'Manuals'){ $active = "list-group-item-active"; } ?>
						<?php echo '<a href="' . esc_url( home_url( '/' ) ) . 'manuals' . '" class="list-group-item large ' . $active . ' " data-parent="#menu">Manuals</a>';?>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12 products">
						<div class="breadcrumbs">
							Home / Resources / <?php echo '<span class="single-cat">'. $post->post_title . '</span>';?>
						</div>
					</div>
				</div>
					<?php
		
					$post_type = $post->post_name;
					$post_type = substr($post_type, 0, -1);
		
						$cats = get_terms($post_type .'_cat');
		
						foreach($cats as $cat):
							$cat_name = $cat->name;
							$cat_id = $cat->term_id;
							echo '<div class="col-md-12 products-right-panel resources-items">';
							echo '<h5>'. $cat_name .'</h5>';
							
							$args = array(
								'post_type' => $post_type,
								'tax_query' => array(
									array(
										'taxonomy' => $post_type .'_cat',
										'field'    => 'id',
										'terms'    => $cat_id,
									),
								),
							);
							$the_query = new WP_Query( $args );
		
							if ( $the_query->have_posts() ) {
								echo '<ul class="resources-ul">';
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									echo '<li><a href="'. get_field($post_type .'_file') .'">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							}
							wp_reset_postdata();
							echo '</div>';
						endforeach;
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>