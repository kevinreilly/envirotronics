<?php 
	get_header();
	$postslug = $post->post_name;	
?> 

<div class="container">
	<div class="row">
		<img src="<?php echo get_field('banner_image', 130) ?>">
	</div>
</div>
<div class="container main-content service-page">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3 sidebar-menu">
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
									$active = '';
									if($post->post_name == $postslug){
										$active = 'active';
									}
									echo '<a href="'. get_permalink() .'" class="list-group-item large ' . $active . '">' . get_the_title() . '</a>';
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
						<div class="breadcrumbs">
							Home / Services / <strong><?php the_title(); ?></strong>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title"><?php the_title(); ?></h2>
					</div>
				</div>
				<div class="row">
					<?php
						$pdf_img = get_field('image');
						if($pdf_img):
					?>
					<div class="col-md-2">
						<img src="<?php echo $pdf_img; ?>">
					</div>
					<div class="col-md-10">
						<?php the_content(); ?>
					</div>
					<?php else: ?>
					<div class="col-md-12">
						<?php the_content(); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
							$pdf_url = get_field('pdf');
							if($pdf_url):
						?>
						<br>
						<a class="btn btn-default" href="<?php echo $pdf_url ?>"><?php the_title(); ?> PDF</a>
						<?php endif; ?>
						<?php
							$button_link = get_field('button_link');
							if($button_link): ?>
								<br>
								<a class="btn btn-default" href="<?php echo $button_link; ?>"><?php the_field('button_text'); ?></a>
							<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>