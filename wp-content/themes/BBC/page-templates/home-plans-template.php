<?php
/*
Template Name: Home Plans Template
*/
get_header(); 
$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail_size' );
?>

<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div class="banner"><img src="<?php echo $banner_src[0]; ?>"></div>
		<div id="primary" class="col-md-12 mb-xs-24 home-plans">
			<div class="home-plans">
				<div class="container">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content' );

					endwhile; // End of the loop.
					?>
					<?php 
					$args = array(
						'order'       => 'ASC',
						'post_type'   => 'home_plans', 
						'post_status' => 'publish' 
					);
					$home_plans = get_children( $args );

					?>
					<div class="home-plan-gallery">
						<?php

						foreach ($home_plans as $key => $home_plan) {
							$plan_id = $home_plan->ID;
							$plan_url = get_permalink($plan_id);
							$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($plan_id), 'thumbnail_size' );
						?>
						<div class="col-md-6 col-xs-12 text-center">
							<a href="<?php echo $plan_url; ?>"><img src="<?php echo $thumb_src[0]; ?>"></a>
							<a href="javascript:;" class="plan-title"><?php echo $home_plan->post_title; ?></a>
						</div>
						<?php
						}
						?>
						<div class="clearfix"></div>
					</div>

					<div class="divider"></div>
					<?php bbc_include_image_group(); ?>
				</div>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();