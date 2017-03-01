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
<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
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
						<p><?php echo $company_desc; ?></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="our-team margin80">
					<h3>Our Team</h3>
					<div class="wrapper">
						<div class="col-md-6 col-xs-12 text-center">
							<img src="<?php echo bbc_get_custom_field('team_member_1'); ?>" class="portfolio">
							<div class="social-icons">
								<a href="https://www.facebook.com/boisebuildingco">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-1.png'?>">
								</a>
								<a href="https://twitter.com/BoiseBuildingCo">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-2.png'?>">
								</a>
								<a href="http://pinterest.com/">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-3.png'?>">
								</a>
								<a href="http://www.linkedin.com/profile/view?id=96482539">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-4.png'?>">
								</a>
								<a href="mailto:mike@boisebuilding.co">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-5.png'?>">
								</a>
								<a href="/contact">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-6.png'?>">
								</a>
							</div>
							<p class="text-justify"><?php echo bbc_get_custom_field('team_member_1_description'); ?></p>
						</div>
						<div class="col-md-6 col-xs-12 text-center">
							<img src="<?php echo bbc_get_custom_field('team_member_2'); ?>" class="portfolio">
							<div class="social-icons">
								<a href="https://www.facebook.com/boisebuildingco">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-1.png'?>">
								</a>
								<a href="https://twitter.com/BoiseBuildingCo">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-2.png'?>">
								</a>
								<a href="http://pinterest.com/">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-3.png'?>">
								</a>
								<a href="http://www.linkedin.com/profile/view?id=96482539">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-4.png'?>">
								</a>
								<a href="mailto:mike@boisebuilding.co">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-5.png'?>">
								</a>
								<a href="/contact">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/t-6.png'?>">
								</a>
							</div>
							<p class="text-justify"><?php echo bbc_get_custom_field('team_member_2_description'); ?></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="divider"></div>
				<div class="image-group">
					<div class="col-md-3 col-xs-6 text-center"><img src="<?php echo bbc_get_custom_field('item1'); ?>"></div>
					<div class="col-md-3 col-xs-6 text-center"><img src="<?php echo bbc_get_custom_field('item2'); ?>"></div>
					<div class="col-md-3 col-xs-6 text-center"><img src="<?php echo bbc_get_custom_field('item3'); ?>"></div>
					<div class="col-md-3 col-xs-6 text-center"><img src="<?php echo bbc_get_custom_field('item4'); ?>"></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();