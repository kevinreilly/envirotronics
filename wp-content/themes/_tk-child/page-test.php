<?php
/* Template Name: Test */

get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<?php
			$taxonomy = 'categories';
			$args = array(
				'orderby' => 'name',
				'order' => 'ASC',
				'parent' => 0,
			);

			$terms = get_terms($taxonomy,$args);

			if($terms):
				echo '<ul>';
				foreach($terms as $term):
					$term_id = $term->term_id;
					$term_name = $term->name;
					$term_link = get_term_link($term);
					echo '<li><a href="'. $term_link .'">'. $term_name .'</a></li>';
				endforeach;
				echo '</ul>';
			endif;

			?>
		</div>
		<div class="col-md-9">

		</div>
	</div>
</div>

<?php get_footer(); ?>