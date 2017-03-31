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
				      		<img src="<?php echo $img_src; ?>" />
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

					<?php 
						$current_page_url = get_permalink();
						$property_name = get_the_title();
						bbc_display_social_icons($current_page_url, $property_name); 
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

		<?php
		$location = bbc_get_custom_field('location') ? bbc_get_custom_field('location') : 'Boise';
		?>
		<input type="hidden" class="idaho_location" name="location0" value="<?php echo $location; ?>" />
		<div id="community-map" style="width: 100%; height: 300px;"></div>
	</div>
<?php
get_footer();
