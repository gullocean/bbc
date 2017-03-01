<?php
/*
Template Name: Contact Template
*/
get_header(); ?>

<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div class="banner"><iframe src="<?php echo bbc_get_custom_field('map_embed_url'); ?>" width="100%" height="309"></iframe></div>
		<div id="primary" class="col-md-12 mb-xs-24 contact-template">
			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; // End of the loop.
				?>

				<div class="contact-section">
					<div class="col-md-8 col-xs-12 cf">
						<?php echo do_shortcode('[contact-form-7 id="225" title="Contact Form"]'); ?>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="service-availability">
							<h2 class="headline"><?php echo bbc_get_custom_field('service_availability_headline'); ?></h2>
							<p class="desc"><?php echo bbc_get_custom_field('service_availability_description'); ?></p>
						</div>
						<div class="office-info">
							<h2 class="headline"><?php echo bbc_get_custom_field('office_headline'); ?></h2>
							<ul class="list-info">
								<li><strong>Address: </strong><?php echo bbc_get_custom_field('office_address'); ?></li>
								<li><strong>Phone: </strong><?php echo bbc_get_custom_field('office_phone'); ?></li>
								<li><strong>Email: </strong><?php echo bbc_get_custom_field('office_email'); ?></li>
							</ul>
						</div>
						<div class="business-hours">
							<h2 class="headline"><?php echo bbc_get_custom_field('business_hours_headline'); ?></h2>
							<ul class="list-info">
								<li><strong>Monday - Friday: </strong><?php echo bbc_get_custom_field('monday_to_friday'); ?></li>
								<li><strong>Saturday: </strong><?php echo bbc_get_custom_field('saturday'); ?></li>
								<li><strong>Sunday: </strong><?php echo bbc_get_custom_field('sunday'); ?></li>
							</ul>
						</div>
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