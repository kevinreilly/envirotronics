<?php /* Template Name: Contact */ ?>

<?php include('header.php'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="container main-content">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 pull-right">
				<?php the_field('contact_info') ?>
			</div>
			<div class="col-md-8">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>

<?php endwhile; ?>

<?php include('footer.php'); ?>

<script type="text/javascript">
/*
	jQuery(".wpcf7-form").submit(function(){
		var requiredFields = jQuery(".wpcf7-validates-as-required").val();
		var captcha = jQuery(".wpcf7-captchar").val();
		if(requiredFields && captcha){
			jQuery(".form-output").text('Thank you for your submission!');
		}
	});
*/
</script>