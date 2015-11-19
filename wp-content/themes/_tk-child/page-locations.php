<?php /* Template Name: Locations */ ?>

<?php get_header(); ?>

<div class="container location-banner">
	<div class="row">
		<img src="<?php the_field('banner_image',129) ?>">
	</div>
</div>
<div class="container main-content location-page">
	<div class="row">
		<div class="col-md-12">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="sidebar-title">
							Locations
						</div>
					</div>
				</div>
				<nav class="sidebar-navigation">
					<div class="container-fluid navbar-custom">
						<div class="row">
							<div class="sidebar-navigation-inner col-sm-12">
								<div class="navbar navbar-default">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
											<span class="sr-only"><?php _e('Toggle navigation','_tk') ?></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
										<a class="navbar-brand" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
									</div>
									<?php wp_nav_menu(
										array(
											'menu' 	=> 'locations',
											'depth'             => 1,
											'container'         => 'div',
											'container_class'   => 'collapse sidebar-navbar-collapse',
											'menu_class' 		=> 'nav navbar-nav',
											'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
											'menu_id'			=> 'sidebar-menu',
											'walker' 			=> new wp_bootstrap_navwalker()
										)
									);
									?>
								</div>
								<br><br>
							</div>
						</div>
					</div><!-- .container -->
				</nav><!-- .site-navigation -->
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumbs">
							Home / <strong>Locations</strong>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<?php the_content(); ?>
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
									<h3><a href="<?php echo esc_url(home_url()) .'/'.$countrySlug ?>">
										<?php echo $countryName; ?>
									</a></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<a href="<?php echo esc_url(home_url()) .'/'. $countrySlug ?>">
										<img src="<?php echo get_field('image', 'country_'. $countryID) ?>">
									</a>
								</div>
								<div class="col-md-9">
									<?php echo get_field('description', 'country_'. $countryID) ?>
									<a href="<?php echo esc_url(home_url()) .'/'. $countrySlug ?>" class="btn btn-default"><?php echo get_field('button_text', 'country_'. $countryID) ?></a>
								</div>
							</div>
							<br><br>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>