<?php get_header(); ?>
<div class="container"><div class="row"><div class="col-md-12 no-padding"><img class="img-responsive" src="<?php echo get_site_url() . '/wp-content/themes/_tk-child/img/news.jpg'?>" /></div></div></div>
<div style="padding-top: 2em; padding-bottom:2em; background-color: #ffffff;" class="container">
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
										if($term->slug == $thisCat->slug)
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
				<div class="row">
					<div class="col-md-12 products">
						<div class="breadcrumbs">
							Home / News & Events / <?php echo '<span class="single-cat">' . $thisCat->name . '</span>'; ?>
						</div>
					</div>
				</div>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="row news-section">
							<div class="col-md-12 post-article">
								<div style="border-bottom: 1px solid #D1D1D1;padding-bottom:2em;">
									<div class="row">
										<div class="col-md-12 app-product-title">
											<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<?php $imageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
											<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $imageURL; ?>"></a>
										</div>
										<div class="col-md-9 news-content">
											<?php the_excerpt(); ?>
											<a class="btn btn-default" href="<?php echo get_permalink(); ?>" role="button">More Info</a>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>