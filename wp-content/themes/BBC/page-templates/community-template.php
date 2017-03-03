<?php
/*
Template Name: Community Template
*/
get_header(); ?>


<?php 
	// Get all community posts.
	$args = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_type'        => 'community',
		'post_status'      => 'publish',
	);

	$communities = get_posts( $args );
?>
	<div class="row">
		<div id="community-map" style="height: 400px;"></div>
		<div id="primary" class="col-md-12 mb-xs-24 community-template">
			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; // End of the loop.
				?>

				<div class="communities-blog">
				<?php
				foreach ($communities as $key => $community) {

					$community_title    = $community->post_title;
					$thumb_src          = wp_get_attachment_image_src( get_post_thumbnail_id($community->ID), 'thumbnail_size' );
					$location           = get_post_meta($community->ID, 'location', true);
					$start_price        = get_post_meta($community->ID, 'start_price', true);
					$end_price          = get_post_meta($community->ID, 'end_price', true);
					$community_src      = get_permalink($community->ID);

					?>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="wrp">
							<input type="hidden" class="idaho_location" name="location<?php echo $key; ?>" value="<?php echo $location; ?>" />
							<a href="<?php echo $community_src; ?>">
								<h1 class="community-title"><?php echo $community_title; ?></h1>
								<img src="<?php echo $thumb_src[0]; ?>" />
								<span class="community-info">
									<h4 class="community-price">Homes From $<?php echo $start_price; ?> - $<?php echo $end_price; ?></h4>
									<h4 class="community-location"><?php echo $location; ?></h4>
								</span>
							</a>
						</div>
					</div>			
					<?php
				}
				?>
				<div class="clearfix"></div>
				</div>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();