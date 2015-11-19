<?php
/* Template Name: Service */

get_header(); ?>


<div class="container">
	<div class="row">
		<img src="<?php the_field('banner_image') ?>">
	</div>
</div>
<div class="container main-content service-page">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12 products product-side-nav">
						<div class="sidebar-title">
							Services
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="product-menu">
							<div class="panel list-group">
							<?php
							$args = array(
								'post_type' => 'service',
								'order' => 'ASC',
								'posts_per_page' => -1,
							);

							$the_query = new WP_Query( $args );

							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									echo '<a href="'. get_permalink() .'" class="list-group-item large">' . get_the_title() . '</a>';
								}
							} else {
								echo 'No services';
							}
							wp_reset_postdata();
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumbs products">
							Home / <strong>Services</strong>
						</div>
						<?php while ( have_posts() ) : the_post(); ?>
							<div>
								<?php the_content(); ?>
								<br>
							</div>
							<?php
							$args = array(
								'post_type' => 'service',
								'order' => 'ASC',
								'posts_per_page' => -1,
							);

							$the_query = new WP_Query( $args );

							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post(); ?>
									<div class="service-post">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-12">
														<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="row">
												<?php
													$service_img = get_field('image');
													if($service_img): ?>
													<div class="col-md-2">
														<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $service_img; ?>"></a>
													</div>
													<div class="col-md-10">
														<?php the_content(); ?>
														<?php
															$pdf_url = get_field('pdf');
															if($pdf_url):
														?>
														<br>
														&raquo; <a href="<?php echo $pdf_url ?>"><?php the_title(); ?> PDF</a>
														<?php endif; ?>
														<?php
															$button_link = get_field('button_link');
															if($button_link): ?>
																<br>
																<a class="btn btn-default" href="<?php echo $button_link; ?>"><?php the_field('button_text'); ?></a>
															<?php endif; ?>
													</div>
												<?php else: ?>
													<div class="col-md-12">
														<?php the_content(); ?>
														<?php
															$pdf_url = get_field('pdf');
															if($pdf_url):
														?>
														<br>
														&raquo; <a href="<?php echo $pdf_url ?>"><?php the_title(); ?> PDF</a>
														<?php endif; ?>
														<?php
															$button_link = get_field('button_link');
															if($button_link): ?>
																<br>
																<a class="btn btn-default" href="<?php echo $button_link; ?>"><?php the_field('button_text'); ?></a>
															<?php endif; ?>
													</div>
												<?php endif; ?>
												</div>
											</div>
										</div>
									</div>

								<?php }
							} else {
								echo 'No services';
							}
							wp_reset_postdata();
							?>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>