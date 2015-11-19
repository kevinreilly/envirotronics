<?php get_header(); ?>

<div class="container">
	<div class="row">
		<?php $banner_image = get_field('banner_image'); ?>
		<?php
			if($banner_image): ?>
				<img src="<?php echo get_field('banner_image'); ?>">
		<?php else: ?>
				<img src="<?php echo get_field('banner_image', 132); ?>">
		<?php endif; ?>
	</div>
</div>
<div class="container main-content category-body">
	<div class="row">
		<div class="col-md-12">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="sidebar-title">
							About Us
						</div>
					</div>
				</div>
				<nav class="sidebar-navigation">
					<div class="container-fluid navbar-about">
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
											'theme_location' 	=> 'about',
											'depth'             => 2,
											'container'         => 'div',
											'container_class'   => 'collapse sidebar-navbar-collapse',
											'menu_class' 		=> 'nav navbar-nav about-nav',
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
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12 products">
						<div class="breadcrumbs">
							Home / About Us / <?php echo '<strong>'. $post->post_title . '</strong>';?>
						</div>
					</div>
					<div class="col-md-12">
						<h1 class="page-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
	<br><br>
</div>

<?php get_footer(); ?>