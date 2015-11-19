<?php
/* Template Name: Homepage */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="container">
	<div class="row">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
	        <ul class="nav nav-pills nav-justified slider-nav">
				<?php
					$args = array(
						'post_type' => 'slide',
						'posts_per_page' => 11
					);
					$the_query = new WP_Query( $args );
					
					if ( $the_query->have_posts() ) {
						$i = 0;
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							
							$active = '';
							if($i == 0){$active = ' class="active"';}
							echo '<li><a data-target="#myCarousel" data-slide-to="' . $i . '"' . $active . ' class="slider-tab" href="#">' . get_the_title() . '</a></li>';
							$i++;
						}
					}
					wp_reset_postdata();
				?>
	        </ul>
	        <!-- Wrapper for slides -->
	        <div class="carousel-inner">
				<?php
					$args = array(
						'post_type' => 'slide',
						'posts_per_page' => 11
					);
					// The Query
					$the_query = new WP_Query( $args );
					
					// The Loop
					if ( $the_query->have_posts() ) {
						$i = 0;
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$active = '';
							if($i == 0){$active = ' active';}
							$link = get_field('link');
							echo '<div class="item' . $active . '"><img src="' . get_field('image') . '"><div class="carousel-caption"><h3>' . get_the_title() . '</h3><p style="color: #4A4442;">' . get_the_content() . '</p><a class="btn btn-default" role="button" href="' . get_site_url() . '/' . $link->taxonomy . '/' . $link->slug . '">More Info</a></div></div>';
							$i++;
						}
					}
					wp_reset_postdata();
				?>
	        </div>
			
	        <!-- End Carousel Inner -->
			<a class="left carousel-control" id="left-control-1" href="#myCarousel" role="button" data-slide="prev">
		    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/left-slider-button.png"></span>
		  	</a>
		  	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/right-slider-button.png"></span>
		  	</a>
	    </div>
		<div id="myCarousel2" class="carousel slide carousel-sync" data-ride="carousel">
			<div class="carousel-inner">
				<?php
					$args = array(
						'post_type' => 'slide',
						'posts_per_page' => 11
					);
					// The Query
					$the_query = new WP_Query( $args );
					
					// The Loop
					if ( $the_query->have_posts() ) {
						$i = 0;
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$active = '';
							if($i == 0){$active = ' active';}
							$link = get_field('link');
							echo '<div class="item' . $active . '"><img style="width:100%;" src="' . get_field('mobile') . '"></div>';
							$i++;
						}
					}
					wp_reset_postdata();
				?>
	        </div>
			<!-- End Carousel Inner -->
			<a class="left carousel-control" id="left-control-2" href="#myCarousel2" role="button" data-slide="prev">
		    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/left-slider-button.png"></span>
		  	</a>
		  	<a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
		    	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/right-slider-button.png"></span>
		  	</a>
		</div>
		<div class="mobile-slider-caption">
			<div id="myCarousel3" class="carousel slide carousel-sync" data-ride="carousel">
				<div class="carousel-inner">
					<?php
						$args = array(
							'post_type' => 'slide',
							'posts_per_page' => 11
						);
						// The Query
						$the_query = new WP_Query( $args );
						
						// The Loop
						if ( $the_query->have_posts() ) {
							$i = 0;
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$active = '';
								if($i == 0){$active = ' active';}
								$link = get_field('link');
								echo '<div style="height:140px;" class="item' . $active . '"><div class="carousel-caption carousel-caption-two"><h3>' . get_the_title() . '</h3><p style="color: #4A4442;">' . get_the_content() . '</p></div></div>';
								$i++;
							}
						}
						wp_reset_postdata();
					?>
				</div>
				<ol class="carousel-indicators">
			<?php
				$args = array(
					'post_type' => 'slide',
					'posts_per_page' => 11
				);
				$the_query = new WP_Query( $args );
				
				if ( $the_query->have_posts() ) {
					$i = 0;
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$active = '';							
						if($i == 0){$active = 'class="active"';}
						echo '<li ' . $active . ' data-target="#myCarousel2" data-slide-to="' . $i . '"></li>';
						
						$i++;
					}
				}
				wp_reset_postdata();
			?>
			</ol>
			</div>
		</div>
		<div id="myCarousel4" class="carousel slide carousel-sync" data-ride="carousel">
			<div class="carousel-inner">
				<?php
					$args = array(
						'post_type' => 'slide',
						'posts_per_page' => 11
					);
					// The Query
					$the_query = new WP_Query( $args );
					
					// The Loop
					if ( $the_query->have_posts() ) {
						$i = 0;
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$active = '';
							if($i == 0){$active = ' active';}
							$link = get_field('link');
							echo '<div style="height:70px;" class="item' . $active . '"><div class="carousel-caption carousel-caption-two"><a class="btn btn-default" role="button" href="' . get_site_url() . '/' . $link->taxonomy . '/' . $link->slug . '">More Info</a></div></div>';
							$i++;
						}
					}
					wp_reset_postdata();
				?>
			</div>
		</div>
		<!-- End Carousel -->
	</div>
</div>
<div class="mobile-accordion">
	<div class="accordion" id="leftMenu">
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseOne">
						<div class="mobile-wrapper"><span class="mobile-nav-one">Custom Solutions</span></div><span class="mobile-plus">+</span>
					</a>
					<div id="collapseOne" class="accordion-body collapse" style="height: 0px; ">
						<div id="miniCarousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner carousel-mini">
							<?php
								$args = array(
									'post_type' => 'custom solutions',
									'posts_per_page' => 10
								);
								$the_query = new WP_Query( $args );
								
								if ( $the_query->have_posts() ) {
									$i = 0;
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$active = '';							
										if($i == 0){$active = ' active';}
										echo '<div class="item' . $active . '"><img class="img-responsive width-100" src="' . get_field('image') . '"></div>';
										$i++;
									}
								}
								wp_reset_postdata();
							?>
							</div>
							<ol class="carousel-indicators">
								<?php
								$args = array(
									'post_type' => 'custom solutions',
									'posts_per_page' => 10
								);
								$the_query = new WP_Query( $args );
								
								if ( $the_query->have_posts() ) {
									$i = 0;
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$active = '';							
										if($i == 0){$active = 'class="active"';}
										echo '<li ' . $active . ' data-target="#miniCarousel" data-slide-to="' . $i . '"></li>';
										$i++;
									}
								}
								wp_reset_postdata();
							?>
							</ol>
							<div style="padding:1em 0;" class="carousel-caption-two">
							<a class="btn btn-default" role="button" href="<?php echo esc_url( home_url( '/' ) ); ?>custom-solutions">More Info</a>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseTwo">
					<div class="mobile-wrapper"><span class="mobile-nav-one">Special Application Chambers</span></div>
					
					<span class="mobile-plus">+</span>
				</a>
			</div>
			<div id="collapseTwo" class="accordion-body collapse" style="height: 0px; ">
				<div class="accordion-inner">
					<?php
							$term = term_exists('specialty-solutions', 'categories');
							
							$specialty_solutions = get_term_children( $term['term_id'] , 'categories');
							$args = array(
							    'child_of' => $term['term_id'],
							    'taxonomy' => 'categories',
							    'hide_empty' => 0,
							    'hierarchical' => true,
							    'depth'  => 1,
								'parent' => $term['term_id'],
							    );
							$cats = get_categories( $args );
							echo '<ul class="sa">';
							foreach ( $cats as $child ) {
								echo '<li class="mobile-list"><a href="' . get_site_url() . '/categories/' . $child->slug . '">' . $child->name . '</a></li>';
							}
							echo "</ul>";
						?>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseThree">
					<div class="mobile-wrapper"><span class="mobile-nav-one">News and Events</span></div>
					<span class="mobile-plus">+</span>
				</a>
			</div>
			<div id="collapseThree" class="accordion-body collapse" style="height: 0px; ">
				<div class="accordion-inner">
		    		<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3
				);
				// The Query
				$the_query = new WP_Query( $args );
				
				// The Loop
				if ( $the_query->have_posts() ):
					while ( $the_query->have_posts() ):
						$the_query->the_post(); ?>
						
						<div class="col-md-4 news-article">
							<div class="row">
								<div class="col-md-12">
									<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
									<a href="<?php echo get_permalink() ?>">
										<img class="img-responsive" src="<?php echo $url ?>">
									</a>
								</div>
								<div class="col-md-12">
									<a href="<?php echo get_permalink() ?>">
										<?php echo get_the_title() ?>
									</a>
								</div>
								<div class="col-md-12">
									<?php echo get_the_excerpt() ?>
								</div>
							</div>
						</div>
					<?php
					endwhile;
				endif;
				wp_reset_postdata();
			?>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#leftMenu" href="#collapseFour">
					<div class="mobile-wrapper"><span class="mobile-nav-one">Areas of Focus</span></div>
					<span class="mobile-plus">+</span>
				</a>
			</div>
			<div id="collapseFour" class="accordion-body collapse" style="height: 0px; ">
				<div class="accordion-inner">
					<?php
						$args = array(
							'orderby'           => 'none', 
							'order'             => 'ASC',
							'hide_empty'        => false, 
							'exclude'           => array(), 
							'exclude_tree'      => array(), 
							'include'           => array(),
						);
						$focuses = get_terms('focuses', $args);
						foreach($focuses as $focus): ?>
							<div class="col-md-3 aof-col">
								<div class="row">
									<div class="col-md-12 aof-focus">
										Focus:
									</div>
									<div class="col-md-12 aof-title">
										<?php echo $focus->name ?>
									</div>
									<div class="col-md-12">
										<img class="img-responsive hidden-xs hidden-sm" src="<?php echo get_field('cat_image', 'focuses_' . $focus->term_id) ?>" />
										<img class="img-responsive hidden-md hidden-lg" src="<?php echo get_field('image', 'focuses_' . $focus->term_id) ?>" />
									</div>
									<div class="col-md-12 aof-copy">
										<?php echo $focus->description ?>
									</div>
									<div class="col-md-12 aof-button">
										<a class="btn btn-default pull-right" role="button" href="<?php echo get_site_url() . '/focuses/' . $focus->slug ?>">More Info</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container home-half hide-mobile">
	<div class="row white-bg">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<div class="half-header">
						Custom Solutions
					</div>
					<div id="miniCarousel" class="carousel slide" data-ride="carousel">
			        	<div class="carousel-inner carousel-mini">
						<?php
							$args = array(
								'post_type' => 'custom solutions',
								'posts_per_page' => 10
							);
							$the_query = new WP_Query( $args );
							
							if ( $the_query->have_posts() ) {
								$i = 0;
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$active = '';							
									if($i == 0){$active = ' active';}
									echo '<div class="item' . $active . '"><img class="img-responsive width-100" src="' . get_field('image') . '"></div>';
									$i++;
								}
							}
							wp_reset_postdata();
						?>
			        	</div>
						<ol class="carousel-indicators">
							<?php
							$args = array(
								'post_type' => 'custom solutions',
								'posts_per_page' => 10
							);
							$the_query = new WP_Query( $args );
							
							if ( $the_query->have_posts() ) {
								$i = 0;
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$active = '';							
									if($i == 0){$active = 'class="active"';}
									echo '<li ' . $active . ' data-target="#miniCarousel" data-slide-to="' . $i . '"></li>';
									$i++;
								}
							}
							wp_reset_postdata();
						?>
						</ol>
						<div class="col-md-12">
							<div class="row">			
								<a class="btn btn-default pull-right" role="button" href="<?php echo esc_url( home_url( '/' ) ); ?>custom-solutions">More Info</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<div class="half-header">
						Special Application Chambers
					</div>
						<?php
							$term = term_exists('specialty-solutions', 'categories');
							
							$specialty_solutions = get_term_children( $term['term_id'] , 'categories');
							$args = array(
							    'child_of' => $term['term_id'],
							    'taxonomy' => 'categories',
							    'hide_empty' => 0,
							    'hierarchical' => true,
							    'depth'  => 1,
								'parent' => $term['term_id'],
							    );
							$cats = get_categories( $args );
							echo '<ul class="sa">';
							foreach ( $cats as $child ) {
								echo '<li><a href="' . get_site_url() . '/categories/' . $child->slug . '">' . $child->name . '</a></li>';
							}
							echo "</ul>";
						?>
					<div class="col-md-12">	
						<div class="row">
							<a class="btn btn-default pull-right" href="<?php echo esc_url( home_url( '/' ) ); ?>categories/specialty-solutions/" role="button">More Info</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container std-header hide-mobile">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3 std-header-text">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>category/news/">News and Events</a>
			</div>
			<div class="col-md-offset-5 col-md-4 std-header-link">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>category/news/">&rsaquo; See all News and Upcoming Events</a>
			</div>
		</div>
	</div>
</div>
<div class="container news hide-mobile">
	<div class="row row-same-height">
		<div class="col-md-12">
			<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3
				);
				// The Query
				$the_query = new WP_Query( $args );
				
				// The Loop
				if ( $the_query->have_posts() ):
					while ( $the_query->have_posts() ):
						$the_query->the_post(); ?>
						
						<div class="col-md-4 news-article">
							<div class="row">
								<div class="col-md-12">
									<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
									<a href="<?php echo get_permalink() ?>">
										<img class="img-responsive" src="<?php echo $url ?>">
									</a>
								</div>
								<div class="col-md-12">
									<a href="<?php echo get_permalink() ?>">
										<?php echo get_the_title() ?>
									</a>
								</div>
								<div class="col-md-12">
									<?php echo get_the_excerpt() ?>
								</div>
							</div>
						</div>
					<?php
					endwhile;
				endif;
				wp_reset_postdata();
			?>
		</div>
	</div>
</div>
<div class="container hide-mobile">
	<div class="row">
		<div class="col-md-12 std-header">
			<div class="col-md-3 std-header-text">
				<a href="<?php echo get_site_url() . '/areas-of-focus'; ?>">Areas of Focus</a>
			</div>
			<div class="col-md-offset-5 col-md-4 std-header-link">
				<a href="<?php echo get_site_url() . '/areas-of-focus'; ?>">&rsaquo; See all Areas of Focus</a>
			</div>
		</div>
	</div>
	<div class="row aof-body">
		<div class="col-md-12">
			<?php
				$args = array(
				    'orderby'           => 'none', 
				    'order'             => 'ASC',
				    'hide_empty'        => false, 
				    'exclude'           => array(), 
				    'exclude_tree'      => array(), 
				    'include'           => array(),
				);
				$focuses = get_terms('focuses', $args);
				foreach($focuses as $focus): ?>
					<div class="col-md-3 aof-col">
						<div class="row">
							<div class="col-md-12 aof-focus">
								Focus:
							</div>
							<div class="col-md-12 aof-title">
								<?php echo $focus->name ?>
							</div>
							<div class="col-md-12">
								<img class="img-responsive hidden-xs hidden-sm" src="<?php echo get_field('cat_image', 'focuses_' . $focus->term_id) ?>" />
								<img class="img-responsive hidden-md hidden-lg" src="<?php echo get_field('image', 'focuses_' . $focus->term_id) ?>" />
							</div>
							<div class="col-md-12 aof-copy">
								<?php echo $focus->description ?>
							</div>
							<div class="col-md-12 aof-button">
								<a class="btn btn-default pull-right" role="button" href="<?php echo get_site_url() . '/focuses/' . $focus->slug ?>">More Info</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
		</div>
	</div>
</div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>