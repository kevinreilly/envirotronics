<?php
/**
 * The template for displaying Single pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _tk
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class="container">
		<div class="row white">
			<div class="col-md-3">
				Products
				<div id="menu" class="product-menu">
					<div class="panel list-group">
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
					$i = 0;
					foreach($terms as $term){
						$id = '#sm' . $i;
						echo '<a href="#" class="list-group-item large list-group-item-active" data-toggle="collapse" data-target="#sm' . $i . '" data-parent="#menu">' . $term->name . '</a>';
						
						$child_cats = get_term_children($term->term_id, 'categories');
						echo '<div id="sm' . $i . '" class="sublinks">';
						foreach($child_cats as $child_cat){
							$child = get_term_by("id", $child_cat, 'categories');
							
							echo '<a href="' . get_term_link($child_cat, 'categories') . '" class="list-group-item small">' . $child->name . '</a>';
							$child_id = $child->term_id;
							$posts_arg = array(
								'post_type' => 'product',
								'tax_query' => array(
									array(
										'taxonomy' => 'categories',
										'field'    => 'term_id',
										'terms'    => $child_id
									),
								),
							);
							
							$the_query = new WP_Query($posts_arg);
							// The Loop
							if ( $the_query->have_posts() ) {
								echo '<ul>';
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									echo '<li>' . get_the_title() . '</li>';
								}
								echo '</ul>';
							} else {
								// no posts found
							}
							/* Restore original Post Data */
							wp_reset_postdata();
						}	
						echo '</div>';
						$i++;
						//echo var_dump$post_data->name . '<br>';
					}	
				 ?>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				Home / Products / <?php ?> / <?php echo get_the_title(); ?>
				<div class="product-menu">
					<div class="col-md-3">
						<img src="" />
					</div>
					<div class="col-md-9">
						<?php echo get_the_content(); ?>
					</div>
					<div class="col-md-12">
						<div id="exTab1">	
							<ul  class="nav nav-pills nav-justified border-bottom-green">
								<li class="active prod-pills"><a  href="#1a" data-toggle="tab">Product Features</a></li>
								<li class="prod-pills"><a href="#2a" data-toggle="tab">Additional Options</a></li>
								<li class="prod-pills"><a href="#3a" data-toggle="tab">Industry Applications</a></li>
		  						<li class="prod-pills"><a href="#4a" data-toggle="tab">Images</a></li>
							</ul>
						</div>
						<div class="tab-content clearfix">
					 		<div class="tab-pane active" id="1a">
								 <?php echo get_post_meta(get_the_ID(), 'product_features')[0]; ?>
							</div>
							<div class="tab-pane" id="2a">
								<?php echo get_post_meta(get_the_ID(), 'additional_options')[0]; ?>
							</div>
		        			<div class="tab-pane" id="3a">
		          				
							</div>
		          			<div class="tab-pane" id="4a">
		          				<?php /*echo var_dump(get_post_meta(get_the_ID())); */?>
								 <?php echo get_post_meta(get_the_ID(), 'images')[0]; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				Brochures and Manuals
				<div class="product-menu">
					
				</div>
			</div>
		</div>
	</div>
<?php endwhile ?>

<?php get_footer(); ?>