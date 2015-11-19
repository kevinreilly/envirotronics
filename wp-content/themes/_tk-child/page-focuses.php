<?php
/* Template Name: Areas of Focus */

get_header(); ?>


<div class="container">
	<div class="row">
		<img src="<?php the_field('banner_image') ?>">
	</div>
</div>
<div class="container main-content service-page">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12 products product-side-nav">
						<div class="sidebar-title">
							Areas of Focus
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="product-menu">
							<div class="panel list-group">
								<?php $focuses = get_terms('focuses'); ?>
								<?php foreach($focuses as $focus): ?>
									<?php 
										$active = '';
										$title = single_term_title('',false);
										if(strtolower($title) == $focus->slug){
											$active ='active';
										} 
									?>
									<a href="<?php echo esc_url(home_url()) .'/focuses/'. $focus->slug; ?>" class="list-group-item large <?php echo $active; ?>">
										<?php echo $focus->name; ?>
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
						<div class="breadcrumbs products">
							Home / <strong>Areas of Focus</strong>
						</div>
						<?php $focuses = get_terms('focuses'); ?>
						<?php foreach($focuses as $focus): ?>
							<div class="focus-row">
								<div class="row">
									<div class="col-md-12">
										<h3>
											<a style="font-weight:bold;" href="<?php echo esc_url(home_url()) .'/focuses/'. $focus->slug; ?>">
												<?php echo $focus->name; ?>
											</a>
										</h3>
									</div>
									<div class="col-md-4">
										<?php $thumbnail = get_field('cat_image', 'focuses_' . $focus->term_id); ?>
										<a href="<?php echo esc_url(home_url()) .'/focuses/'. $focus->slug; ?>">
											<img src="<?php echo $thumbnail; ?>">
										</a>
									</div>
									<div class="col-md-8">
										<?php echo term_description($focus->term_id,'focuses'); ?>
										<a class="btn btn-default" href="<?php echo esc_url(home_url()) .'/focuses/'. $focus->slug; ?>">More Info</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>