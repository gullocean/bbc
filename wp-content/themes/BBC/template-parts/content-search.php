<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bbc
 */

?>
<?php 
	$location   = get_post_meta(the_ID(), 'location', true);
	$bedrooms   = get_post_meta(the_ID(), 'bedrooms', true);
	$bathrooms  = get_post_meta(the_ID(), 'bathrooms', true);
	$price      = get_post_meta(the_ID(), 'price', true);
	$car_garage = get_post_meta(the_ID(), 'car_garage', true);

	$floor_src  = get_permalink(the_ID());
	$thumb_src  = wp_get_attachment_image_src( get_post_thumbnail_id(the_ID()), 'thumbnail_size' );
?>
<div class="row">
	<article id="post-<?php the_ID(); ?>" class="post-content post-grid-wide col-md-12">
		<div class="col-md-4 col-sm-6 col-xs-12 text-center">
			<a href="<?php echo $floor_src; ?>"><img src="<?php echo $thumb_src[0]; ?>"></a>
			<div class="plan-info">
				<h2 class="location">Location: <?php echo $location; ?></h2>
				<h5 class="price">Price: <?php echo $price; ?></h5>
				<h6 class="other">
					<span><?php echo $bedrooms;   ?>Bedrooms   | </span>
					<span><?php echo $bathrooms;  ?>Bathrooms  | </span>
					<span><?php echo $car_garage; ?>Car Garage   </span>
				</h6>
			</div>
		</div>
	</article><!-- #post-## -->
</div>