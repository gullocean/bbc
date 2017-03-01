<?php
/*
Template Name: Home Template
*/
get_header(); ?>

<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div id="primary" class="col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; // End of the loop.
				?>

				<div class="page-blogs">
					<?php bbc_page_blogs(); ?>
				</div><!-- List page blogs -->

				<div class="contact-form-section margin60">
					<div class="contact-wrapper">
						<div class="col-md-9 col-xs-12 email-us"><h3>For more information, email us at <a href="mailto:<?php echo bbc_get_custom_field('contact_email_address') ? bbc_get_custom_field('contact_email_address') : 'info@boisebuilding.co'; ?>"><?php echo bbc_get_custom_field('contact_email_address') ? bbc_get_custom_field('contact_email_address') : 'info@boisebuilding.co'; ?></a> or give us a call <span><?php echo bbc_get_custom_field('phone_number') ? bbc_get_custom_field('phone_number') : '(208).939.3945'; ?></span></h3></div>	
						<div class="col-md-3 col-xs-12 contact-form"><a href="<?php echo bbc_get_custom_field('contact_form_link') ? bbc_get_custom_field('contact_form_link') : '/contact' ;?>" class="btn"><?php echo bbc_get_custom_field('contact_form') ? bbc_get_custom_field('contact_form') : 'Contact Form' ;?></a></div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="testimonial-section margin40">
				<div class="headline">
					<h3><?php echo bbc_get_custom_field('what_people_are_saying') ? bbc_get_custom_field('what_people_are_saying') : 'WHAT PEOPLE ARE SAYING'; ?></h3>
					<span class="bordered-icon"><i class="fa fa-th-large"></i></span>
				</div>
				<div class="tms-content margin50">
					<div class="container">
						<?php bbc_testimonials(); ?>
					</div>
				</div>
			</div>

			<?php 
			// Get attached images.
			$bca_src = bbc_get_custom_field('bca') ? bbc_get_custom_field('bca') : get_template_directory_uri() . '/assets/images/building-contractors-association-southwestern-idaho.png';
			$nahb_src = bbc_get_custom_field('nahb') ? bbc_get_custom_field('nahb') : get_template_directory_uri() . '/assets/images/national-association-of-home-builders.png';
			$ibca_src = bbc_get_custom_field('idaho_building_contractors_association') ? bbc_get_custom_field('idaho_building_contractors_association') : get_template_directory_uri() . '/assets/images/idaho-building-contractors-association.png';
			$ab_src = bbc_get_custom_field('accredited_business') ? bbc_get_custom_field('accredited_business') : get_template_directory_uri() . '/assets/images/better-business-bureau.png';
			?>

			<div class="gallery-section">
				<div class="container">
					<div class="col-md-3 col-xs-6 text-center">
						<img src="<?php echo $bca_src; ?>">
					</div>
					<div class="col-md-3 col-xs-6 text-center">
						<img src="<?php echo $nahb_src; ?>">
					</div>
					<div class="col-md-3 col-xs-6 text-center">
						<img src="<?php echo $ibca_src; ?>">
					</div>
					<div class="col-md-3 col-xs-6 text-center">
						<img src="<?php echo $ab_src; ?>">
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();