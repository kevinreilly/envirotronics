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

<?php
/*
$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;  

// load thumbnail for this taxonomy term (term object)
$thumbnail = get_field('image', $queried_object);

// load thumbnail for this taxonomy term (term string)
$thumbnail = get_field('iamge', $taxonomy . '_' . $term_id);
*/
?>

<?php
$post_terms = wp_get_post_terms($post->ID,'categories');
$first = true;
foreach($post_terms as $post_term):
		$args = array(
			'parent' => 0,
			'search' => $post_term->slug,
		);
		$terms = get_terms('categories',$args);
		foreach($terms as $term):
			if($first==true): ?>
			<div class="container">
				<div class="row">
					<img src="<?php the_field('image',$term) ?>">
				</div>
			</div>
		<?php
			$first = false;
			endif;
		endforeach;
endforeach;
?>

	<div class="container">
		<div class="row white-bg" style="padding-top:30px;">
			<div class="col-md-12">
				<div class="col-md-3">
					<div class="sidebar-title">
						Products
					</div>
					<div id="menu" class="product-menu">
						<div class="panel list-group tax-menu">
							<?php
							$post_type = 'product';
							$taxonomy = 'categories';
							$post_id = get_the_ID();

							$post_terms = wp_get_post_terms($post_id,$taxonomy);

							foreach($post_terms as $post_term){
								$post_term_id = $post_term->term_id;
							}

							$override_slug = $_GET["category"];
							$termOverride = $override_slug;
							if($override_slug):
								$current_term = get_term_by('slug',$override_slug,$taxonomy);
								$current_term_id = $current_term->term_id;
							else:
								$current_term_id = $post_term_id;
								$current_term = get_term($current_term_id,$taxonomy);
							endif;

							/*
							$current_term_id = $post_term_id;
							$current_term = get_term($current_term_id,$taxonomy);
							*/

							$parent_term = get_term($current_term->parent,$taxonomy);
							$parent_term_id = $parent_term->term_id;

							$grandparent_term = get_term($parent_term->parent,$taxonomy);
							$grandparent_term_id = $grandparent_term->term_id;

							$args = array(
								'orderby' => 'name',
								'order' => 'ASC',
								'parent' => 0,
							);

							$terms = get_terms($taxonomy,$args);

							/* ---- START PARENT ---- */
							if($terms):
								echo '<ul>';
								foreach($terms as $term):
									$active = '';
									$term_id = $term->term_id;
									$term_name = $term->name;
									$term_link = get_term_link($term);

									if($term_id==$current_term_id || $term_id==$parent_term_id || $term_id==$grandparent_term_id):
										$active = ' class="active"';
									endif;

									echo '<li'. $active .'><a href="'. $term_link .'">'. $term_name .'</a>';

									/* ---- START CHILD ---- */
									$args = array(
										'orderby' => 'name',
										'order' => 'ASC',
										'parent' => $term_id,
									);
									$term_children = get_terms($taxonomy,$args);

									if($term_children && $active):
										echo '<ul>';
										foreach($term_children as $term_child):
											$active_child = '';
											$term_child_id = $term_child->term_id;
											$term_child_name = $term_child->name;
											$term_child_link = get_term_link($term_child);

											if($term_child_id==$current_term_id || $term_child_id==$parent_term_id || $term_child_id==$grandparent_term_id):
												$active_child = ' class="active"';
											endif;

											echo '<li'. $active_child .'><a href="'. $term_child_link .'">'. $term_child_name .'</a>';

											/* ---- START GRANDCHILD ---- */
											$args = array(
												'orderby' => 'name',
												'order' => 'ASC',
												'parent' => $term_child_id,
											);
											$term_grandchildren = get_terms($taxonomy,$args);

											if($term_grandchildren && $active_child):
												echo '<ul>';
												foreach($term_grandchildren as $term_grandchild):
													$active_grandchild = '';
													$term_grandchild_id = $term_grandchild->term_id;
													$term_grandchild_name = $term_grandchild->name;
													$term_grandchild_link = get_term_link($term_grandchild);

													if($term_grandchild_id==$current_term_id || $term_grandchild_id==$parent_term_id || $term_grandchild_id==$grandparent_term_id):
														$active_grandchild = ' class="active"';
													endif;

													echo '<li'. $active_grandchild .'><a href="'. $term_grandchild_link .'">'. $term_grandchild_name .'</a>';

													/* ---- START PRODUCTS ---- */
													$args = array(
														'post_type' => $post_type,
														'tax_query' => array(
															array(
																'taxonomy' => $taxonomy,
																'field'    => 'id',
																'terms'    => $term_grandchild_id,
															),
														),
														'orderby' => 'name',
														'order' => 'ASC',
														'posts_per_page' => -1,
													);
													$the_query = new WP_Query( $args );

													if($the_query->have_posts() && $active_grandchild):
														echo '<ul>';
														while($the_query->have_posts()):
															$the_query->the_post();
															$active_post = '';
															$postID = get_the_ID();

															if($postID==$post_id):
																$active_post = ' class="active"';
															endif;
															echo '<li'. $active_post .'><a href="'. get_permalink() .'?category='. $termOverride .'">' . get_the_title() . '</a></li>';
														endwhile;
														echo '</ul>';
													endif;
													wp_reset_postdata();

													/* ---- END PRODUCTS ---- */

													echo '</li>';

												endforeach;
												echo '</ul>';
											else:
												/* ---- START PRODUCTS ---- */
												$args = array(
													'post_type' => $post_type,
													'tax_query' => array(
														array(
															'taxonomy' => $taxonomy,
															'field'    => 'id',
															'terms'    => $term_child_id,
														),
													),
													'orderby' => 'name',
													'order' => 'ASC',
													'posts_per_page' => -1,
												);
												$the_query = new WP_Query($args);

												if($the_query->have_posts() && $active_child):
													echo '<ul>';
													while($the_query->have_posts()):
														$the_query->the_post();
														$active_post = '';
														$postID = get_the_ID();

														if($postID==$post_id):
															$active_post = ' class="active"';
														endif;
														echo '<li'. $active_post .'><a href="'. get_permalink() .'?category='. $termOverride .'">' . get_the_title() . '</a></li>';
													endwhile;
													echo '</ul>';
												endif;
												wp_reset_postdata();

												/* ---- END PRODUCTS ---- */
											endif;
											/* ---- END GRANDCHILD ---- */

											echo '</li>';

										endforeach;
										echo '</ul>';
									else:
										/* ---- START PRODUCTS ---- */
										$args = array(
											'post_type' => $post_type,
											'tax_query' => array(
												array(
													'taxonomy' => $taxonomy,
													'field'    => 'id',
													'terms'    => $term_id,
												),
											),
											'orderby' => 'name',
											'order' => 'ASC',
											'posts_per_page' => -1,
										);
										$the_query = new WP_Query($args);

										if($the_query->have_posts() && $active):
											echo '<ul>';
											while($the_query->have_posts()):
												$the_query->the_post();
												$active_post = '';
												$postID = get_the_ID();

												if($postID==$post_id):
													$active_post = ' class="active"';
												endif;

												echo '<li'. $active_post .'><a href="'. get_permalink() .'?category='. $termOverride .'">' . get_the_title() . '</a></li>';
											endwhile;
											echo '</ul>';
										endif;
										wp_reset_postdata();

										/* ---- END PRODUCTS ---- */
									endif;
									/* ---- END CHILD ---- */
									echo '</li>';
								endforeach;
								echo '</ul>';
							endif;
							/* ---- END PARENT ---- */
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
					<div class="breadcrumbs">
						Home / Products / 
						<?php
						if($grandparent_term->name):
							echo $grandparent_term->name .' / ';
						endif;
						if($parent_term->name):
							echo $parent_term->name .' / ';
						endif;
						echo $current_term->name .' / <strong>'. get_the_title() .'</strong>';
						?>
					</div>
					<div class="row product-menu">
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
											$slider_counter = 1;
											$active1 = 'active';
										}
									?>
									<?php 
										if(get_post_meta(get_the_ID(), 'additional_options')[0])
										{
											if($slider_counter == 0){
												$slider_counter = 2;
												$active2 = 'active';
											}
											echo '<li class="prod-pills ' . $active2 . '"><a href="#2a" data-toggle="tab">Additional Options</a></li>';		
										}
									?>
									<?php
										$fetch_args = array(
										    'orderby'           => '', 
										    'order'             => 'ASC'
										);
										$fetches = wp_get_post_terms($post->ID, 'applications', $fetch_args);
										if($fetches){
											if($slider_counter == 0){
												$slider_counter = 3;
												$active3 = 'active';
											}		
											echo '<li class="prod-pills ' . $active3 . '"><a href="#3a" data-toggle="tab">Industry Applications</a></li>';
										}
									?>
									
									<?php
									// check if the repeater field has rows of data
									if( have_rows('product_images') ): ?>
									<?php 
										if($slider_counter == 0){
											$slider_counter = 4;
											$active4 ='active';
										} 
									?>
									<li class="prod-pills <?php echo $active4;?>"><a href="#4a" data-toggle="tab">Images</a></li>
									<?php
									endif;
									?>
			  					
								</ul>
							</div>
							<div class="tab-content clearfix">
								<?php 
								if(get_post_meta(get_the_ID(), 'product_features')[0])
								{
									echo '<div class="tab-pane ' . $active1 . '" id="1a">'. get_post_meta(get_the_ID(), 'product_features')[0] .'</div>';
								}
								?>
								<?php 
								if(get_post_meta(get_the_ID(), 'additional_options')[0])
								{
									echo '<div class="tab-pane ' . $active2 . '" id="2a">' . get_post_meta(get_the_ID(), 'additional_options')[0] . '</div>';	
								}
								?>
			        			
		          				<?php 
		          					/*
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
									*/
									?>
									<div class="tab-pane <?php echo $active3;?>" id="3a">
										<ul class="ia-list">
											<?php echo get_the_term_list( $post->ID, 'applications', '<li>', '</li><li>', '</li>' ); ?>
										</ul>
									</div>
												
								<?php
								// check if the repeater field has rows of data
								if( have_rows('product_images') ): ?>
									<div class="tab-pane <?php echo $active4;?> images-panel" id="4a">
										<div class="row">
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
							echo '<div class="col-md-2"><div class="right-sidebar-title">Brochures</div><div class="product-menu">';
							$post = $b_object;
							setup_postdata($post);
							
							echo '<a href="'. get_field('brochure_file'). '" class="brochure">Brochure &raquo;</a>';	
							wp_reset_postdata();
							//echo '<br><br><strong><a href="'. home_url() .'/manuals">Manuals &raquo;</strong></a>';
							echo '</div></div>';
						}
					?>
			</div>
		</div>
	</div>
<?php endwhile ?>

<?php get_footer(); ?>