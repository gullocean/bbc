<?php
/*
Template Name: Design Template
*/
get_header(); ?>


<?php 
// Get the custom fields for about template.
$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail_size' );

?>
	<div class="row">
		<div class="banner"><img src="<?php echo $banner_src[0]; ?>"></div>
		<div id="primary" class="col-md-12 mb-xs-24 design-template">
			<div class="container">
				<div class="design-content">
					<div class="col-md-8 col-xs-12 design-desc text-justify">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content' );

						endwhile; // End of the loop.
						?>
					</div>
					<div class="col-md-4 col-xs-12 design-img text-center">
						<img src="<?php echo bbc_get_custom_field('design_mark'); ?>">
					</div>
					<div class="clearfix"></div>
				</div>

				<h3 class="design-process-headline"><?php echo bbc_get_custom_field('design_process_headline'); ?></h3>
				<div class="design-process">
					<div class="col-md-8 col-xs-12 process-content text-justify">
						<?php echo bbc_get_custom_field('design_process_description'); ?>
					</div>
					<div class="col-md-4 col-xs-12 design-pdf">
						<a href="<?php echo bbc_get_custom_field('pdf_link'); ?>" target="blank">
							<img src="<?php echo bbc_get_custom_field('pdf_image'); ?>">
						</a>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="design-step">
					<div class="col-md-6 col-xs-12 step-process">
						<h4>The following items are selections that will be made during this process:</h4>
						<ul class="list-info">
						<?php
						for ($i=1; $i < 11; $i++) { 
							$process_item = bbc_get_custom_field('process' . $i);
							echo '<li>' . $process_item . '</li>';
						}
						?>
						</ul>
					</div>
					<div class="col-md-6 col-xs-12 step-started">
						<h4>Getting Started</h4>
						<ol>
						<?php
						for ($i=1; $i < 8; $i++) { 
							$process_item = bbc_get_custom_field('started' . $i);
							echo '<li>' . $process_item . '</li>';
						}
						?>
						</ol>
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