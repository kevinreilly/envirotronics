<?php
/* Template Name: Location Page */
?>

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
							</div>
						</div>
					</div><!-- .container -->
				</nav><!-- .site-navigation -->
				<br><br>
			</div>
			<div class="col-md-9">
				<div class="breadcrumbs">
					Home / Locations / <?php echo '<span class="single-cat">'. $post->post_title . '</span>';?>
				</div>
				<div class="location-content">
					<div class="row">
						<div class="col-md-12">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<?php the_field('column_1') ?>
						</div>
						<div class="col-md-6">
							<?php the_field('column_2') ?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
	<br><br>
</div>

<?php get_footer(); ?>