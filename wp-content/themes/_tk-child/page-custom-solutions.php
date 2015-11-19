<?php /* Template Name: Custom Solutions */ ?>

<?php get_header(); ?>

<div class="container">
	<div class="row">
		<img src="<?php echo get_field('banner_image'); ?>">
	</div>
</div>
<div class="container main-content custom-solutions">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="sidebar-title sidebar-custom-solutions">
							Custom Solutions
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="breadcrumbs">
					Home / <strong>Custom Solutions</strong>
				</div>
				<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php endwhile; ?>
				<br>
				<?php
				$args = array(
					'post_type' => 'customsolutions'
				);
				$the_query = new WP_Query( $args );

				if($the_query->have_posts()):
					$count = 1;
					while($the_query->have_posts()):
						$the_query->the_post(); ?>
						<div class="col-md-4 custom_solution_image">
							<div class="row">
								<div class="col-md-12">
									<img style="cursor:pointer;" src="<?php the_field('image') ?>" data-toggle="modal" data-target="#myModal<?php echo $count ?>">
									<div class="modal fade" id="myModal<?php echo $count ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body" style="text-align:center;">
													<img class="img-resonsive" data-toggle="magnify" src="<?php the_field('image') ?>"/>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h3><?php echo get_the_title() ?></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?php the_content() ?>
								</div>
							</div>
						</div>
						<?php $count++ ?>
					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>