<?php
/*
Template Name: About Template
*/
get_header(); ?>


<?php 
// Get the custom fields for about template.
$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail_size' );
$company_headline = bbc_get_custom_field('company_headline');
$company_desc = bbc_get_custom_field('company_description');

?>
	<div class="row">
		<div class="banner"><img src="<?php echo $banner_src[0]; ?>"></div>
		<div id="primary" class="col-md-12 mb-xs-24 about-template">
			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; // End of the loop.
				?>

				<div class="about-company">
					<div class="col-md-6 col-xs-12 company-slider">
						<?php echo do_shortcode('[URIS id=219]'); ?>
					</div>
					<div class="col-md-6 col-xs-12 company-desc">
						<h3><?php echo $company_headline; ?></h3>
						<p class="text-justify"><?php echo $company_desc; ?></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="our-team margin80">
					<h3>Our Team</h3>
					<div class="wrapper">
						<div class="col-md-6 col-xs-12 text-center">
							<img src="<?php echo bbc_get_custom_field('team_member_1'); ?>" class="portfolio">
							<?php bbc_include_social_icons(); ?>
							<p class="text-justify"><?php echo bbc_get_custom_field('team_member_1_description'); ?></p>
						</div>
						<div class="col-md-6 col-xs-12 text-center">
							<img src="<?php echo bbc_get_custom_field('team_member_2'); ?>" class="portfolio">
							<?php bbc_include_social_icons(); ?>
							<p class="text-justify"><?php echo bbc_get_custom_field('team_member_2_description'); ?></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="divider"></div>
				<?php bbc_include_image_group(); ?>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();