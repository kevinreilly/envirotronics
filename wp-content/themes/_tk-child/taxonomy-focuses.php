<?php get_header(); ?>
<?php
	$focuses = get_terms('focuses');	
	
	foreach($focuses as $focus){
		$title = str_replace(' ', '-',single_term_title('',false));
		
		if(strtolower($title) == $focus->slug){
			$banner = get_field('image', $focus);
		}
	}
	if($banner){
		echo '<div class="container"><div class="row"><div class="col-md-12 no-padding"><img class="img-responsive" src="' . $banner . '" /></div></div></div>';
	}
?>

<div class="container main-content category-body">
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
								<?php foreach($focuses as $focus): ?>
									<?php 
										$active = '';
										$title = single_term_title('',false);
										if(strtolower(str_replace(' ','-',$title)) == $focus->slug){
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
			<div class="col-md-6">
				<div class="breadcrumbs">
					Home / Areas of Focus / <strong><?php single_term_title(); ?></strong>
				</div>
				<div class="row">
					<div class="row">
						<div class="col-md-12">
							<?php $term_id = get_queried_object()->term_id;	?>
						</div>
					</div>
					<div class="col-md-3" style="display:none;">
						<h2><img src="<?php echo get_field('cat_image','focuses_'. $term_id); ?>"></h2>
					</div>
					<div class="col-md-9">
						<h2><?php single_term_title(); ?></h2>
						<?php echo term_description( $term_id,'focuses'); ?>
					</div>
				</div>
				<?php
				if(have_posts()):?>
					<h2>Application Sheets/Downloads/White Papers:</h2>
					<br>
					<?php while(have_posts()):
						the_post(); ?>
						<div class="focus-row">
							<div class="row">
								<div class="col-md-12">
									<h3><?php the_title(); ?></h3>
									<a class="btn btn-default" role="button" href="<?php echo get_field('pdf'); ?>">Download PDF</a>
								</div>
							</div>
						</div>
					<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
				<br><br>
			</div>
			<div class="col-md-3 focus-links">
				<div class="sidebar-title">
					Industry Resources: 
				</div>
				<br>
				<?php echo get_field('links','focuses_'. $term_id); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
