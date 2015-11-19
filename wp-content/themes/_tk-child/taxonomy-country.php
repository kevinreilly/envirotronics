<?php get_header(); ?>
<div class="container">
	<div class="row">
		<img src="<?php the_field('banner_image') ?>">
	</div>
</div>
<div class="container main-content">
	<div class="row">
		<div class="col-md-3">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 products product-side-nav">
						Locations
					</div>
					<?php
					$term_name = single_term_title('', false);
					$term_slug = strtolower(str_replace(' ','-',$term_name));
					?>
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
									<?php
										$active = '';
										if($term_slug == $country->slug){
											$active = 'active';
										}	
									?>
									<a href="<?php echo esc_url(home_url()) .'/country/'. $country->slug; ?>" class="list-group-item large <?php echo $active;?>">
										<?php echo $country->name; ?>
									</a>

								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="products product-side-nav">
					<?php $country = single_cat_title( '', false ); ?>
					<a href="<?php echo esc_url(home_url()) ?>">Home</a> / <a href="<?php echo esc_url(home_url()) .'/locations' ?>">Locations</a> / <?php echo $country; ?>
				</div>
			</div>
			<div class="row">
				<h3><?php echo $country; ?></h3>
				<?php 
					// vars
					$queried_object = get_queried_object();  

					$instructions = get_field('instructions', $queried_object);
					echo $instructions;
					?>
				<?php
					$countrySlug = str_replace(" ", "-", $country);
					$countrySlug = strtolower($countrySlug);
				?>
				<div class="form-group">
					<?php
					$args = array(
						'post_type' => 'location',
						'tax_query' => array(
							array(
								'taxonomy' => 'country',
								'field'    => 'name',
								'terms'    => $country,
							),
						),
						'posts_per_page' => -1,
						'orderby' => 'name',
						'order' => 'ASC',
					);
					$the_query = new WP_Query( $args );
					if($the_query->have_posts()):
					?>
						<form id="page-changer-mobile" action="" method="post">
							<select class="form-control" name="location">
								<option>Select a location</option>

							<?php while($the_query->have_posts()):
								$the_query->the_post(); ?>

							    <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>

							<?php endwhile; ?>

							</select>
							<input type="submit" value="Go" id="submit" />
						</form>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-3 contactInfo">
			<div class="col-md-12">
				<?php
				$location = $_GET["loc"];
				if($location):
				 ?>
					<span class="location"><?php echo get_the_title($location) ?></span>
					<br><br>
					<?php
					if($sales_contact == null){
						the_content();
					}
					else{
						$sales_contact = get_field('sales_representative',$location);
						if($sales_contact):
							$post = $sales_contact;
							setup_postdata($post);
							?>
							<div class="row">
								<div class="col-md-12">
									<h3 class="contactType">Sales Representative</h3>
									<span class="contactName"><?php the_title(); ?></span><br>
									<span class="contactPosition"><?php echo get_field('position') ?></span><br>
									<span class="contactPhone"><?php echo get_field('phone') ?></span><br>
									<span class="contactEmail"><?php echo get_field('email') ?></span><br>
									<span class="contactPosition">test</span><br />
									<?php /*
										$additional_info_1 = get_field('additional_info_1');
										$additional_info_2 = get_field('additional_info_2');
										echo 'test'
										if(strlen($additional_info_1) > 0){
											echo '<span class="contactPosition">' . $additional_info_1 . '</span><br>';
										}
										if(strlen($additional_info_2) > 0){
											echo '<span class="contactPosition">' . $additional_info_2 . '</span><br>';
										}
										*/
									?>
									
								</div>
							</div>
							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
						<?php
						$service_contact = get_field('service_technician',$location);
						if($service_contact):
							$post = $service_contact;
							setup_postdata($post);
							?>
							<div class="row">
								<div class="col-md-12">
									<h3 class="contactType">Service Technician</h3>
									<span class="contactName"><?php the_title(); ?></span><br>
									<span class="contactPosition"><?php echo get_field('position') ?></span><br>
									<span class="contactPhone"><?php echo get_field('phone') ?></span><br>
									<span class="contactEmail"><?php echo get_field('email') ?></span><br>
								</div>
							</div>
							<?php wp_reset_postdata(); ?>
						<?php endif; } ?>
					<?php else: ?>
					<p>Select a location</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(function() {
			$("#submit").hide();
			$("#page-changer-mobile select").change(function() {
				window.location = '<?php echo get_site_url() . "/country/" . $countrySlug; ?>/?loc=' + $("#page-changer-mobile select option:selected").val();
			})
		});
	});
</script>

<?php get_footer(); ?>