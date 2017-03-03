<?php
/**
 * The template for displaying Property.
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
					<h4 class="plan-cost">Cost: $<?php echo get_post_meta(get_the_ID(), 'price', true); ?></h4>
					<h4 class="plan-feet">Square Ft: <?php echo get_post_meta(get_the_ID(), 'square_feet', true); ?></h4>
				</div>
			</div>
			<div class="col-md-8 col-xs-12">
				<div class="flexslider">
				  	<ul class="slides">
				  	<?php
				  	$img_group = array();
				  	for ($i=1; $i < 4; $i++) { 
				  		$gallery_img_src = bbc_get_custom_field('gallery_image' . $i);
				  		if (!empty($gallery_img_src)) {
					  		array_push($img_group, $gallery_img_src);
				  		}
				  	}

				  	foreach ($img_group as $img_src) {
					  	?>
				    	<li>
				      		<img src="<?PHP echo $img_src; ?>" />
				    	</li>
					  	<?php
				  	}
				  	?>
				  </ul>
				</div>			
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

					<?php bbc_display_social_icons(); ?>
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
				<div class="gmap">
					<h1 class="margin20">Map</h1>
					<iframe src="<?php echo bbc_get_custom_field('property_map') ? bbc_get_custom_field('property_map') : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.007618886696!2d-116.33989899999997!3d43.68960499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54afaaadadcf2ef3%3A0xfc1f882504997a5c!2s1159+E+Iron+Eagle+Dr+%23120%2C+Eagle%2C+ID+83616!5e0!3m2!1sen!2sus!4v1436305058721'; ?>" width="100%" height="300"></iframe>
				</div>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();
