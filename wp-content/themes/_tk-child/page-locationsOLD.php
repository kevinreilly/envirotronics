<?php /* Template Name: Locations */ ?>

<?php get_header(); ?>
<div class="container">
	<div class="row">
		<img src="<?php the_field('banner_image') ?>">
	</div>
</div>
<div class="container main-content">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12 products product-side-nav">
						Locationsdsds
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="product-menu">
							<div class="panel list-group">
								<?php
								$args = array(
									'hide_empty' => false
								);

								?>
								<?php $countries = get_terms('country', $args); ?>
								<?php foreach($countries as $country): ?>

									<a href="<?php echo esc_url(home_url()) .'/country/'. $country->slug; ?>" class="list-group-item large">
										<?php echo $country->name; ?>
									</a>

								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					</div>
				</div>
				<?php
				$args = array(
					'hide_empty' => false,
				);
				?>
				<?php $countries = get_terms('country', $args); ?>
				<?php foreach($countries as $country): ?>
					<div class="row">
						<div class="col-md-12">
							<?php $countrySlug = $country->slug; ?>
							<?php $countryID = $country->term_id; ?>
							<?php $countryName = $country->name; ?>
							<?php $countryObject = get_term_by('id',$countryID); ?>
							<div class="row country-listing">
								<div class="col-md-12">
									<hr>
									<h3><a href="<?php echo esc_url(home_url()) .'/country/'. $countrySlug ?>">
										<?php echo $countryName; ?>
									</a></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<a href="<?php echo esc_url(home_url()) .'/country/'. $countrySlug ?>">
										<img src="<?php echo get_field('image', 'country_'. $countryID) ?>">
									</a>
								</div>
								<div class="col-md-9">
									<?php echo get_field('description', 'country_'. $countryID) ?>
									<a href="<?php echo esc_url(home_url()) .'/country/'. $countrySlug ?>" class="btn btn-default"><?php echo get_field('button_text', 'country_'. $countryID) ?></a>
								</div>
							</div>
						</div>
					</div>

				<?php endforeach; ?>
				<?php $variable = get_field('field_name', 'product-cat_23'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>