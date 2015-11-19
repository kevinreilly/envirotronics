<?php get_header(); ?>
<?php
	$postslug = $post->post_name;	
?>
<div class="container main-content">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3 sidebar-menu">
				<div class="row">
					<div class="col-md-12 products product-side-nav">
						<div class="sidebar-title">
							Career Listings
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="product-menu">
							<div class="panel list-group">
							<?php
							$args = array(
								'post_type' => 'career',
								'order' => 'DESC',
							);

							$the_query = new WP_Query( $args );

							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$active = '';
									if($post->post_name == $postslug){
										$active = 'active';
									}
									echo '<a href="'. get_permalink() .'" class="list-group-item large ' . $active . '">' . get_the_title() . '</a>';
								}
							} else {
								echo 'No careers';
							}
							wp_reset_postdata();
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="breadcrumbs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>careers">&laquo; Careers</a>
					</div>
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>