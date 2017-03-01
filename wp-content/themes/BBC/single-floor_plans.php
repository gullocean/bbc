<?php
/**
 * The template for displaying all single posts.
 *
 * @package bbc
 */

get_header(); 

$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail_size' );
?>
<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row floor-plan-custom-post">
		<div class="spec-section">
			<div class="col-md-4 col-xs-12 plan-info text-center">
				<div class="wrap">
					<h1 class="plan-title"><?php echo get_the_title(); ?></h1>
					<h4 class="plan-feet"><?php echo get_post_meta(get_the_ID(), 'square_feet', true); ?></h4>
					<a href="/contact" class="btn more-info">Request More Information</a>
					<a target="blank" href="<?php echo bbc_get_custom_field('download_pdf_link'); ?>" class="btn download-plan">Download Floor Plan</a>
				</div>
			</div>
			<div class="col-md-8 col-xs-12 plan-picture">
				<img src="<?php echo $thumb_src[0]; ?>">
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="primary">
			<div class="container">
				<div class="col-md-6 col-xs-12 description">
					<h1>Description</h1>
					<?php
						while ( have_posts() ) : the_post();

							the_content();

						endwhile; // End of the loop. 
					?>
				</div>
				<div class="col-md-6 col-xs-12 virtual-tour">
					<h1>Virtual Tour</h1>
					<div class="youtube"><iframe src="<?php echo get_post_meta(get_the_ID(), 'virtual_tour', true); ?>" width="100%" height="300"></iframe></div>

					<h1>Floor Plans</h1>
					<div class="plans-panel">
						<ul class="nav nav-pills">
							<li class="active"><a  href="#1st" data-toggle="tab">1st Floor</a></li>
							<li><a href="#2nd" data-toggle="tab">2nd Floor</a></li>
							<li><a href="#details" data-toggle="tab">Details</a></li>
						</ul>
						<div class="tab-content clearfix">
							<div class="tab-pane active" id="1st">
								<img src="<?php echo bbc_get_custom_field('1st_floor'); ?>">
							</div>
							<div class="tab-pane" id="2nd">
								<img src="<?php echo bbc_get_custom_field('2nd_floor'); ?>">
							</div>
					        <div class="tab-pane" id="details">
					        	<p><?php echo bbc_get_custom_field('details'); ?></p>
							</div>						
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();
