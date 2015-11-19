<?php get_header(); ?>
<div class="container"><div class="row"><div class="col-md-12 no-padding"><img class="img-responsive" src="<?php echo get_site_url() . '/wp-content/themes/_tk-child/img/news.jpg'?>" /></div></div></div>
<div  class="container" style="background-color: #ffffff; padding-top:2em;padding-bottom:2em;">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12 products product-side-nav">
						<div class="sidebar-title">
							News &amp; Events
							<?php
							$thisCat = get_category(get_query_var('cat'));
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="product-menu">
							<div class="panel list-group">
						 		<?php
									$terms = get_terms('category', 'order=DESC');
									
									foreach($terms as $term){
										$active = '';
										//if($term->slug == $thisCat->slug)
										if(in_category($term, $post ))
										{
											$active = "list-group-item-active";
										}
										$term_link = get_term_link($term);
										echo '<a href="' . $term_link . '" class="list-group-item large ' . $active . '" data-toggle="collapse" data-target="#sm" data-parent="#menu">' . $term->name . '</a>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="breadcrumbs">
					Home / News & Events / <?php echo '<span class="single-cat">' . get_the_title() . '</span>'; ?>
				</div>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="row">
						<div class="col-md-12">
							<h2><?php the_title(); ?></h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
								<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
								<div class="col-md-3"><img class="img-responsive" src="<?php echo $url; ?>"></div>
								<?php the_content(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>