<?php
/*
Template Name: Energy Star Template
*/
get_header(); ?>


<?php 
// Get the custom fields for about template.
$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail_size' );

?>
	<div class="row">
		<div class="banner"><img src="<?php echo $banner_src[0]; ?>"></div>
		<div id="primary" class="col-md-12 mb-xs-24 energy-star-template">
			<div class="container">
				<div class="energy-content">
					<div class="col-md-8 col-xs-12 energy-desc text-justify">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content' );

						endwhile; // End of the loop.
						?>
					</div>
					<div class="col-md-4 col-xs-12 energy-img text-center">
						<img src="<?php echo bbc_get_custom_field('energy_mark'); ?>">
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="divider"></div>
				<?php bbc_include_image_group(); ?>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();