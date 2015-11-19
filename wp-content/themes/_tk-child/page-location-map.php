<?php
/* Template Name: Location with Map */

get_header(); ?>

<div class="container">
	<div class="row">
		<img src="<?php the_field('banner_image',129) ?>">
	</div>
</div>
<div class="container main-content location-page">
	<div class="row">
		<div class="col-md-12">
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
			<div class="col-md-6">
				<?php $location = $_GET["loc"]; ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<div class="breadcrumbs">
						Home / Locations / <strong><?php the_title(); ?></strong>
					</div>
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<?php
					$country = get_field('country');
					$country = get_term_by('id',$country,'country');
					$country = $country->slug;

					$args = array(
						'post_type' => 'location',
						'tax_query' => array(
							array(
								'taxonomy' => 'country',
								'field' => 'slug',
								'terms' => $country,
							),
						),
						'posts_per_page' => -1,
						'orderby' => 'name',
						'order' => 'ASC',
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()): ?>
						<form id="page-changer-mobile" action="" method="post">
							<select class="form-control" name="location">
								<option>Please select a location...</option>
							<?php while($the_query->have_posts()):
								$the_query->the_post();

								$location_id = $post->ID;
								if($location_id == $location):
									$selected = ' selected="selected"';
								else:
									$selected = '';
								endif;
								?>
								<option value="<?php echo $location_id; ?>"<?php echo $selected; ?>>
									<?php the_title(); ?>
								</option>

							<?php endwhile; ?>
							</select>
							<input type="submit" id="submit" value="submit">
						</form>
					<?php endif;
					wp_reset_postdata();
				?>
			</div>
			<div class="col-md-3">
				<div class="right-sidebar-title">
					<?php echo get_the_title($location); ?>
				</div>
				<?php

				$post_object = get_field('sales_representative',$location);
				if($post_object): 
					$post = $post_object;
					setup_postdata($post); ?>

					<h3>Local Salesperson</h3>
					
					<?php $sales_rep_desc = get_field('sales_representative_description',$location); ?>
					
					<p>
						<?php if($sales_rep_desc): echo '<strong>'. $sales_rep_desc .'</strong><br>'; endif; ?>
						<?php the_title(); ?>
						<br>
						<?php the_field('position'); ?>
						<br>
						<?php the_field('phone'); ?>
						<br>
						<a href="mailto:<?php the_field('email'); ?>?cc=sales@envirotronics.com"><?php the_field('email'); ?></a>
						<br>
					</p>
					
					<?php
					// Additional Contacts
					$rows = get_field('additional_sales_representatives',$location);
					if($rows):
						foreach($rows as $row):
														
							$desc = $row['description'];
					        
					        $post_object = $row['sales_representative'];
					        if($post_object):
					        	$post = $post_object;
					        	setup_postdata($post); ?>
					        	
					        	<p>
									<?php if($desc): echo '<strong>'. $desc .'</strong><br>'; endif; ?>
									<?php the_title(); ?>
									<br>
									<?php the_field('position'); ?>
									<br>
									<?php the_field('phone'); ?>
									<br>
									<a href="mailto:<?php the_field('email'); ?>?cc=sales@envirotronics.com"><?php the_field('email'); ?></a>
									<br>
								</p>
					        	
					        	<?php wp_reset_postdata();
					        endif;
						endforeach;
					endif;
					?>
				
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
				<?php
				$post_object = get_field('service_technician',$location);
				if($post_object): 
					$post = $post_object;
					setup_postdata($post); ?>

					<h3>Local Service Technician</h3>
					
					<?php $service_tech_desc = get_field('service_technician_description',$location); ?>
					
					<p>
						<?php if($service_tech_desc): echo '<strong>'. $service_tech_desc .'</strong><br>'; endif; ?>
						<?php the_title(); ?>
						<br>
						<?php the_field('position'); ?>
						<br>
						<?php the_field('phone'); ?>
						<br>
						<a href="mailto:<?php the_field('email'); ?>?cc=sales@envirotronics.com"><?php the_field('email'); ?></a>
						<br>
						<?php
							$additional_info_1 = get_field('additional_info_1');
							$additional_info_2 = get_field('additional_info_2');
							if(strlen($additional_info_1) > 0){
								echo '<span class="contactPosition">' . $additional_info_1 . '</span><br>';
							}
							if(strlen($additional_info_2) > 0){
								echo '<span class="contactPosition">' . $additional_info_2 . '</span><br>';
							}
						?>
					</p>
					
					<?php
					// Additional Contacts
					$rows = get_field('additional_service_technicians',$location);
					if($rows):
						foreach($rows as $row):
														
							$desc = $row['description'];
					        
					        $post_object = $row['service_technician'];
					        if($post_object):
					        	$post = $post_object;
					        	setup_postdata($post); ?>
					        	
					        	<p>
									<?php if($desc): echo '<strong>'. $desc .'</strong><br>'; endif; ?>
									<?php the_title(); ?>
									<br>
									<?php the_field('position'); ?>
									<br>
									<?php the_field('phone'); ?>
									<br>
									<a href="mailto:<?php the_field('email'); ?>?cc=sales@envirotronics.com"><?php the_field('email'); ?></a>
									<br>
								</p>
					        	
					        	<?php wp_reset_postdata();
					        endif;
						endforeach;
					endif;
					?>
				
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
				<br>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(function() {
			$("#submit").hide();
			$("#page-changer-mobile select").change(function() {
				window.location = '<?php echo get_site_url() . "/" . $country; ?>/?loc=' + $("#page-changer-mobile select option:selected").val();
			})
		});
	});
</script>

<?php get_footer(); ?>