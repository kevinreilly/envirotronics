<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _tk
 */

get_header(); ?>

<?php
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

$terms = get_terms('applications', $args);
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
		$child_cats = get_term_children($term->term_id, 'applications');
		if ( !empty( $child_cats ) && !is_wp_error( $child_cats ) ){
			foreach($child_cats as $child_cat){
				$subparent = get_term_by("id", $child_cat, 'applications');
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
					
					$grandchild_cats = get_term_children($subparent->term_id, 'applications');
					
					if ( !empty( $grandchild_cats ) && !is_wp_error( $grandchild_cats ) ){
						
						foreach($grandchild_cats as $grandchild_cat){
							
							$subchild = get_term_by("id", $grandchild_cat, 'applications');
							
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
				<div class="col-md-3">
					<div class="sidebar-title products">
						Applications
					</div>
					<div id="menu" class="product-menu">
						<div class="panel list-group">		
							<?php
								foreach($terms as $term){
						$id = '#sm' . $i;
						$active = '';
						
						if($term->slug == $parent['slug']){
							$active = "list-group-item-active";
						}
						//Old
						//echo '<a href="' . get_site_url() . '/applications/' . $term->slug . '" class="list-group-item large ' . $active . '" data-toggle="collapse" data-target="#sm' . $i . '" data-parent="#menu">' . $term->name . '</a>';
						echo '<a href="' . get_site_url() . '/applications/' . $term->slug . '" class="list-group-item large ' . $active . '" data-toggle="collapse" data-target="#sm" data-parent="#menu">' . $term->name . '</a>';
						
						if($term->slug == $parent['slug'] & $child['slug'] != ''){
							$child_cats = get_term_children($term->term_id, 'applications');
							if ( !empty( $child_cats ) && !is_wp_error( $child_cats ) ){
								echo '<div id="sm' . $i . '" class="sublinks">';
								foreach($child_cats as $child_cat){
									$subparent = get_term_by("id", $child_cat, 'applications');
									
									if($subparent->parent == $term->term_id){
										
										
										$active = '';
										
										if($slug->slug == $subparent->slug){
											$active = 'sub-active';
										}
										echo '<a href="' . get_term_link($child_cat, 'applications') . '" class="list-group-item light-list ' . $active . '">' . $subparent->name . '</a>';
										
			
										if($child['slug'] == $subparent->slug)
										{
											$grandchild_cats = get_term_children($subparent->term_id, 'applications');
											if ( !empty( $grandchild_cats ) && !is_wp_error( $grandchild_cats ) ){
												foreach($grandchild_cats as $grandchild_cat){
													$subchild = get_term_by("id", $grandchild_cat, 'applications');
													
													$active = '';
													if($subchild->slug == $grandchild['slug']){
														$active = 'sub-active';
													}
													
													echo '<a href="' . get_term_link($grandchild_cat, 'applications') . '" class="list-group-item light-list child ' . $active . '">' . $subchild->name . '</a>';
													
													//echo '<a href="' . get_term_link($grandchild_cat, 'applications') . '" class="list-group-item light-list child">' . $subchild->name . '</a>';
													if($subchild->slug == $grandchild['slug']){
	
														$posts_arg = array(
															'post_type' => 'product',
															'tax_query' => array(
																array(
																	'taxonomy' => 'applications',
																	'field'    => 'term_id',
																	'terms'    => $grandchild['id']
																),
															),
														);
													
														$the_query = new WP_Query($posts_arg);
														// The Loop
														if ( $the_query->have_posts() ) {
															echo '<div class="list-prod product-menu-list">';
															while ( $the_query->have_posts() ) {
																$the_query->the_post();
																//echo 'hit';
																$active = '';
																
																if($post->post_name == $child['slug'])
																{
																	$active = 'sub-active';
																}
																echo '<a style="color:#454749;" class="list-group-item light-list grandchild ' . $active . '" href="' . get_permalink() . '">' . get_the_title() . '</a>';
															}
															echo '</div>';
														} else {
															// no posts found
														}
														/* Restore original Post Data */
														wp_reset_postdata();			
													}
												}
											}
											else{
												$child_id = $subparent->term_id;
												$posts_arg = array(
													'post_type' => 'product',
													'tax_query' => array(
														array(
															'taxonomy' => 'applications',
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
														echo '<a style="color:#454749;" class="list-group-item light-list child ' . $active . '" href="' . get_permalink() . '">' . get_the_title() . '</a>';
													}
													echo '</div>';
												} else {
													// no posts found
												}
												/* Restore original Post Data */
												wp_reset_postdata();	
												
											}
										}
									}
								}
							}	
							
							$i++;
							if ( empty( $child_cats ) && !is_wp_error( $child_cats ) ){
								$child_id = $term->term_id;
									$posts_arg = array(
										'post_type' => 'product',
										'tax_query' => array(
											array(
												'taxonomy' => 'applicaiton',
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
						if($term->slug == $parent['slug'] & $child['slug'] == ''){
							
							$child_id = $term->term_id;
							
							$j = 0;
							$child_cats = get_term_children($term->term_id, 'applications');							
							if ( !empty( $child_cats ) && !is_wp_error( $child_cats ) ){
								echo '<div id="sm' . $i . '" class="sublinks">';
								foreach($child_cats as $child_cat){
								$subparent = get_term_by("id", $child_cat, 'applications');
									if($subparent->parent == $term->term_id){
										echo '<a href="' . get_term_link($child_cat, 'applications') . '" class="list-group-item light-list">' . $subparent->name . '</a>';
										$j++;
									}
								}
								echo '</div>';
							}			
			
							if($j == 0){
								$posts_arg = array(
									'post_type' => 'product',
									'tax_query' => array(
										array(
											'taxonomy' => 'applications',
											'field'    => 'term_id',
											'terms'    => $child_id
										),
									),
								);	
								$the_query = new WP_Query($posts_arg);
								// The Loop
								if ( $the_query->have_posts() ) {
									echo '<div id="sm' . $i . '" class="sublinks">';
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$active = '';
										
										if($post->post_title == $post_title)
										{
											$active = 'sub-active';
										}
										//echo '<li>' . get_the_title() . '</li>';
										echo '<a class="list-group-item light-list ' . $active . '" href="' . get_permalink() . '">' . get_the_title() . '</a>';
									}
									echo '</div>';
								} else {
									// no posts found
								}
								/* Restore original Post Data */
								wp_reset_postdata();
							}
						}
					}
					?>
							
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="breadcrumbs products">
						<?php
							if($child['name'] != ''):
								echo 'Home / Industry Applications / '. $parent['name'] .' / <strong>' . $child['name'] .'</strong>';
							else:
								echo 'Home / Industry Applications / <strong>'. $parent['name'] .'</strong>';
							endif;
						?>
					</div>
					
					<?php if ( have_posts() ) : ?>

					<header>
						<div class="products-right-panel">
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
					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							//get_template_part( 'content', get_post_format() );
							/*if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								the_post_thumbnail();
							}*/
							
							$product_img = '';
							$row = get_field('product_images');
							if($row)
							{
								//echo var_dump($row);
								$product_img = '<img class="img-resonsive" src="' . $row[0]['product_image'] . '"/>'; 
							} 
							
							//echo var_dump($post);
							echo '
							<div class="col-md-12 product-post">
								<div class="row">
									<div class="col-md-12 app-product-title">
										<a href="' . get_site_url() . '/product/' . $post->post_name . '">' . get_the_title() . '</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 product-title">'
										 . $product_img . 
									'</div>
									<div class="col-md-9 product-copy">'
										. get_the_content() . 
										'<div class="more-info">
											<a href="' . get_site_url() . '/product/' . $post->post_name . '">&nbsp;<br />&#8594; More Info About ' . get_the_title() . '</a>
										</div>
									</div>
								</div>
							</div>';
							//the_title();
							//the_content();
						?>
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

<?php get_footer(); ?>
