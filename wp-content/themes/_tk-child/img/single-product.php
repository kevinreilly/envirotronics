<?php
/**
 * The template for displaying Single products.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _tk
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class="container">
		<div class="row white-bg">
			<div class="col-md-3">
				Products
				<div id="menu" class="product-menu">
					<div class="panel list-group">
					
				<?php
					$post_title = $post->post_title;
					$post_slug = $post->post_name;
									
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
					$child_sub_name = '';
					$child_name = '';
					$parent_name = ''; 
					$term_name = '';
					//$grandchild = array ('name' => '', 'id' => '', 'slug' => '');
					//$child = array ('name' => '', 'id' => '', 'slug' => '');
					//$parent = array ('name' => '', 'id' => '', 'slug' => '');
					foreach($terms as $term){	
						//echo var_dump($term);
						$term_name = $term->slug;
						$parent_name = $term->name;
						$child_cats = get_term_children($term->term_id, 'categories');
						if ( empty( $child_cats ) && !is_wp_error( $child_cats ) ){
							$posts_arg = array(
									'post_type' => 'product',
									'tax_query' => array(
										array(
											'taxonomy' => 'categories',
											'field'    => 'term_id',
											'terms'    => $term->term_id
										),
									),
								);	
								$the_query = new WP_Query($posts_arg);
								// The Loop
								if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										if($post_slug == $post->post_name){
											wp_reset_postdata();
											break 2;
										}
									}
								} else {
								}
								wp_reset_postdata();
						}
						else
						{
							foreach($child_cats as $child_cat){
								$child = get_term_by("id", $child_cat, 'categories');
								
								$child_name = $child->name;
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
																
								$child_sub_cats = get_term_children($child_id, 'categories');
								if ( empty( $child_sub_cats ) && !is_wp_error( $child_sub_cats ) ){
									$the_query = new WP_Query($posts_arg);
									// The Loop
									if ( $the_query->have_posts() ) {
										
										while ( $the_query->have_posts() ) {
											
											$the_query->the_post();
											//echo $post->post_name;
											//echo $post_slug;
											//echo $post->post_name;
											if($post_slug == $post->post_name){
												wp_reset_postdata();
												break 3;
											}
										}
									}
									wp_reset_postdata();
								} else {
									foreach($child_sub_cats as $child_sub_cat){
										$sub_child = get_term_by("id", $child_sub_cat, 'categories');
										
										$sub_child_name = $sub_child->name;
										$sub_child_id = $sub_child->term_id;
										$sub_posts_arg = array(
											'post_type' => 'product',
											'tax_query' => array(
												array(
													'taxonomy' => 'categories',
													'field'    => 'term_id',
													'terms'    => $sub_child_id
												),
											),
										);
										$the_query = new WP_Query($sub_posts_arg);
										$child_sub_name = $sub_child_name;
										if ( $the_query->have_posts() ) {
											while ( $the_query->have_posts() ) {
											
												$the_query->the_post();
												//echo $post->post_name;
												//echo $post_slug;
												//echo $post->post_name;
												if($post_slug == $post->post_name){
													wp_reset_postdata();
													break 4;
												}
											}
										}			
									}
									
								}
							}
						}
					}
					//echo $parent_name . ' / ' . $child_name . ' / ' . $sub_child_name  ; 
					
					foreach($terms as $term){
						
						$id = '#sm' . $i;
						$active = '';
						
						if($term->slug == $term_name){
							$active = "list-group-item-active";
						}
						
						echo '<a href="' . get_site_url() . '/categories/' . $term->slug . '" class="list-group-item large ' . $active . '" data-toggle="collapse" data-target="#sm' . $i . '" data-parent="#menu">' . $term->name . '</a>';
						
						$child_cats = get_term_children($term->term_id, 'categories');
						$collapse = 'collapse';
						if($term->slug == $term_name){
							$collapse = '';
						}
						
						echo '<div id="sm' . $i . '" class="sublinks ' . $collapse . '">';
						foreach($child_cats as $child_cat){
							$child = get_term_by("id", $child_cat, 'categories');
							
							echo '<a href="' . get_term_link($child_cat, 'categories') . '" class="list-group-item light-list">' . $child->name . '</a>';
							
							if($child_name == $child->name)
							{
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
									echo '<div class="list-prod product-menu-list">';
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$active = '';
										
										if($post->post_name == $post_slug)
										{
											$active = 'sub-active';
										}
										echo '<a style="color:#454749;" class="list-group-item light-list ' . $active . '" href="' . get_permalink() . '">' . get_the_title() . '</a>';
									}
									echo '</div>';
								} else {
									// no posts found
								}
								/* Restore original Post Data */
								wp_reset_postdata();
							}
						}	
						
						$i++;
						if ( empty( $child_cats ) && !is_wp_error( $child_cats ) ){
							$child_id = $term->term_id;
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
									echo '<div class="list-prod product-menu-list">';
									
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$active = '';
										
										if($post->post_title == $post_title)
										{
											$active = 'sub-active';
										}
										//echo '<li>' . get_the_title() . '</li>';
										echo '<a style="color:#454749;" class="list-group-item light-list ' . $active . '" href="' . get_permalink() . '">' . get_the_title() . '</a>';
									}
									echo '</div>';
								} else {
									// no posts found
								}
								/* Restore original Post Data */
								wp_reset_postdata();
						}
						echo '</div>';
					}	
				 ?>
					</div>
				</div>
			</div>
			<?php	
				$b_object = get_field('brochure');
				if($b_object){
					echo '<div class="col-md-7">';
				}
				else{
					echo '<div class="col-md-9">';	
				}
			?>
				<?php 
					$spacer = '';
					if($child_name != ''){
						$spacer = ' / ';
					}  
					
				?>
				Home / Products / <?php echo $parent_name . $spacer . $child_name; ?> / <?php echo get_the_title(); ?>
				<div class="product-menu">
					<?php
					$row = get_field('product_images');
					if($row){
						$product_thumb = true;
					?>
					<div class="col-md-3">
						<img class="img-responsive" src="<?php echo $row[0]['product_image'] ?>"/>
					</div>
					<?php } ?>
					<div class="<?php if($product_thumb == true){ echo 'col-md-9'; }else{ echo 'col-md-12'; } ?>">
						<h3 class="product-title"><?php echo get_the_title(); ?></h3>
						<?php echo get_the_content(); ?>
					</div>
					<div class="col-md-12">
						<div id="exTab1" class="mini-nav-prod">	
							<ul  class="nav nav-pills nav-justified border-bottom-green">
								<?php 
									if(get_post_meta(get_the_ID(), 'product_features')[0])
									{
										echo '<li class="active prod-pills"><a  href="#1a" data-toggle="tab">Product Features</a></li>';		
									}
								?>
								<?php 
									if(get_post_meta(get_the_ID(), 'additional_options')[0])
									{
										echo '<li class="prod-pills"><a href="#2a" data-toggle="tab">Additional Options</a></li>';		
									}
								?>
								<?php
									$fetch_args = array(
									    'orderby'           => '', 
									    'order'             => 'ASC'
									);
									$fetches = wp_get_post_terms($post->ID, 'applications', $fetch_args);
									if($fetches){ echo '<li class="prod-pills"><a href="#3a" data-toggle="tab">Industry Applications</a></li>';}
								?>
								
								<?php
								// check if the repeater field has rows of data
								if( have_rows('product_images') ): ?>
								<li class="prod-pills"><a href="#4a" data-toggle="tab">Images</a></li>
								<?php
								endif;
								?>
		  					
							</ul>
						</div>
						<div class="tab-content clearfix">
							<?php 
							if(get_post_meta(get_the_ID(), 'product_features')[0])
							{
								echo '<div class="tab-pane active" id="1a">'. get_post_meta(get_the_ID(), 'product_features')[0] .'</div>';
							}
							?>
							<?php 
							if(get_post_meta(get_the_ID(), 'additional_options')[0])
							{
								echo '<div class="tab-pane" id="2a">' . get_post_meta(get_the_ID(), 'additional_options')[0] . '</div>';	
							}
							?>
		        			
	          				<?php 

								$taxonomy     = 'applications';
								$orderby      = 'name'; 
								$show_count   = 0;      // 1 for yes, 0 for no
								$pad_counts   = 0;      // 1 for yes, 0 for no
								$hierarchical = 1;      // 1 for yes, 0 for no
								$title        = '';
								
								$args = array(
								  'taxonomy'     => $taxonomy,
								  'orderby'      => $orderby,
								  'show_count'   => $show_count,
								  'pad_counts'   => $pad_counts,
								  'hierarchical' => $hierarchical,
								  'title_li'     => $title
								);
								
								?>
								<div class="tab-pane" id="3a"><ul class="ia-list">
									<?php wp_list_categories( $args ); ?>
								</ul></div>
											
							<?php
							// check if the repeater field has rows of data
							if( have_rows('product_images') ): ?>
								<div class="tab-pane" id="4a">
								<?php $count = 1; ?>
							 	<?php // loop through the rows of data
							    while ( have_rows('product_images') ) : the_row(); ?>
							        <div class="col-md-4">
							        	<img style="cursor:pointer;" src="<?php echo get_sub_field('product_image') ?>" data-toggle="modal" data-target="#myModal<?php echo $count ?>">
							        	<div class="modal fade" id="myModal<?php echo $count ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													</div>
													<div class="modal-body" style="text-align:center;">
														<img class="img-resonsive" data-toggle="magnify" src="<?php echo get_sub_field('product_image') ?>"/>
													</div>
												</div>
											</div>
										</div>
							        	
							        </div>
								<?php $count++ ?>
							    <?php endwhile; ?>
								</div>
							<?php else :
							
							    // no rows found
							
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
			
					<?php 
						$b_object = get_field('brochure');
						if($b_object)
						{
							echo '<div class="col-md-2">Brochures<div class="product-menu">';
							$post = $b_object;
							setup_postdata($post);
							
							echo '<a href="'. get_field('brochure_file'). '" class="brochure">' . $post_title . ' Brochure</a>';	
							wp_reset_postdata();
							echo '</div></div>';
						}
					?>
		</div>
	</div>
<?php endwhile ?>

<?php get_footer(); ?>