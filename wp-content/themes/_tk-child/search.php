<?php include('header.php'); ?>

<div class="container main-content">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<?php if ( have_posts() ) : ?>

				<header>
					<h2 class="page-title"><?php printf( __( 'Search Results for: %s', '_tk' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</header><!-- .page-header -->

				<?php // start the loop. ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="row">
						<div class="col-md-12">
							<div class="search-result">
								<h2><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h2>
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>

				<?php endwhile; ?>

				<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

				<?php endif; // end of loop. ?>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>