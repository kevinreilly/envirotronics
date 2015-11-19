<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _tk
 */

get_header();

$post_name = get_the_title();
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
$slug = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$i = 0;
$child_name = '';
$term_name = $slug->name;
$parent_name = '';

$grandchild = array ('name' => '', 'id' => '', 'slug' => '');
$child = array ('name' => '', 'id' => '', 'slug' => '');
$parent = array ('name' => '', 'id' => '', 'slug' => '');


foreach($terms as $term){
	$parent_name = $term->name;
	$banner = get_field('image', $term);
	
	$parent['name'] = $term->name;
	$parent['id']   = $term->term_id;
	$parent['slug'] = $term->slug;
	
	$banner = get_field('image', $term);
	
	if($slug->slug == $term->slug){
		break 1;
	}
	else
	{
		$child_cats = get_term_children($term->term_id, 'categories');
		if ( !empty( $child_cats ) && !is_wp_error( $child_cats ) ){
			foreach($child_cats as $child_cat){
				$subparent = get_term_by("id", $child_cat, 'categories');
				//echo $subparent->parent . ' ' .  $term->term_id . '<br>';
				if($subparent->parent == $term->term_id)
				{
					//echo var_dump($subparent);
					$child['name'] = $subparent->name;
					$child['id'] = $subparent->term_id;
					$child['slug'] = $subparent->slug;
					
					if($subparent->slug == $slug->slug)
					{
						break 2;
					}
					
					$grandchild_cats = get_term_children($subparent->term_id, 'categories');
					
					if ( !empty( $grandchild_cats ) && !is_wp_error( $grandchild_cats ) ){
						
						foreach($grandchild_cats as $grandchild_cat){
							
							$subchild = get_term_by("id", $grandchild_cat, 'categories');
							
							if($subchild->slug == $slug->slug){
								$grandchild['name'] = $subchild->name;
								$grandchild['id'] = $subchild->term_id;
								$grandchild['slug'] = $subchild->slug;
								break 3;
							}
						}
					}
					$child['name'] = '';
					$child['id'] = '';
					$child['slug'] = '';
				}
			}
		}	
	}
}		
if($banner){echo '<div class="container"><div class="row"><div class="col-md-12 no-padding"><img class="img-responsive" src="' . $banner . '" /></div></div></div>';}								
?>
	<div class="container category-body">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 products product-side-nav">
					<div class="row">
						<div class="col-md-12">
							<div class="sidebar-title">
								Products
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="menu" class="product-menu">
								<div class="panel list-group tax-menu">
									<?php
									$post_type = 'product';
									$taxonomy = 'categories';

									$current_term_id = get_queried_object()->term_id;
									$current_term = get_term($current_term_id,$taxonomy);

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

																	$termObject = get_term_by('id',$term_grandchild_id,$taxonomy);
																	$termOverride = $termObject->slug;

																	echo '<li><a href="'. get_permalink() .'?category='. $termOverride .'">' . get_the_title() . '</a></li>';
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

																$termObject = get_term_by('id',$term_child_id,$taxonomy);
																$termOverride = $termObject->slug;

																echo '<li><a href="'. get_permalink() .'?category='. $termOverride .'">' . get_the_title() . '</a></li>';
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

														$termObject = get_term_by('id',$term_id,$taxonomy);
														$termOverride = $termObject->slug;

														echo '<li><a href="'. get_permalink() .'?category='. $termOverride .'">' . get_the_title() . '</a></li>';
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
					</div>
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12 products">
							<div class="breadcrumbs">
							<?php
								$slash = '';
								$single_cat = single_cat_title('', false);
								if($parent_name)
								{
									if($parent_name == $single_cat){
										$parent_name = '';
									}
									else{
										$slash = ' / ';	
									}
								}	
							?>
							Home / Products / 
							<?php 
							if($grandchild['name'] != ''){
								echo $parent['name'] .' / ' . $child['name'] .' / <strong>' . $grandchild['name'] .'</strong>';
							}
							elseif($child['name'] != ''){
								echo $parent['name'] .' / <strong>' . $child['name'] .'</strong>';
							}
							else {
								echo '<strong>'. $parent['name'] .'</strong>';
							}
							?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<?php if ( have_posts() ) : ?>

							<header>
								<div class="row">
									<div class="col-md-12 products-right-panel">
										<h1 class="page-title">
											<?php echo single_cat_title('', false); ?>
										</h1>
									</div>
									<?php
										// Show an optional term description.
										$term_description = term_description();
										if ( ! empty( $term_description ) ) :
											printf( '<div class="taxonomy-description">%s</div>', $term_description );
										endif;
									?>
								</div>
							</header><!-- .page-header -->

							<?php
							global $wp_query;
							query_posts(
								array_merge(
									$wp_query->query,
									array(
									'order' => 'ASC',
									'orderby'=>'title',
									'posts_per_page' => -1,
									)
								)
							);
							?>

							<?php while(have_posts()): the_post(); ?>

								<?php
									$product_img = '';
									$row = get_field('product_images');
									if($row)
									{
										$product_img = '<img class="img-responsive prod-cat-img-top-em" src="' . $row[0]['product_image'] . '"/>'; 
									} ?>
									
									<div class="col-md-12 product-post">
										<div class="row">
											<div class="col-md-12">
												<a class="product-title" href="<?php echo get_permalink() .'?category='. $termOverride; ?>">
													<?php echo get_the_title() ?>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<a href="<?php echo get_permalink() .'?category='. $termOverride; ?>">
													<?php echo $product_img ?>
												</a>
											</div>
											<div class="col-md-9 product-copy">
												<?php echo get_the_excerpt() ?>
												<div class="more-info">
													<a href="<?php echo get_permalink() .'?category='. $termOverride; ?>">
														&nbsp;<br />&#8594; More Info About <?php echo get_the_title() ?>
													</a>
												</div>
											</div>
										</div>
									</div>
								<?php
														
								?>

							<?php endwhile; ?>

							<?php else : ?>
					
								<?php get_template_part( 'no-results', 'archive' ); ?>
					
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
