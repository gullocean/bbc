<?php
/*
Template Name: Search Results Template
*/
get_header(); ?>

<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div id="primary" class="col-md-12 mb-xs-24 search-page">
			<div class="container">
				<?php
				get_search_form();
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; // End of the loop.
				?>

				<!-- List floor plans by category. -->
				<div class="list-posts">
				<?php
					$current_page_id = get_the_ID();
					$used_post_type = get_post_meta($current_page_id, 'custom_post_type', true);

					if ($used_post_type == 'property') {
						$post_type = 'property';
					} elseif ($used_post_type == 'floor_plans') {
						$post_type = 'floor_plans';
					} else {
						$post_type = 'post';
					}

					// Get all custom posts such as floor plans and properties.
					$args = array(
						'posts_per_page'   => -1,
						'offset'           => 0,
						'orderby'          => 'date',
						'order'            => 'ASC',
						'post_type'        => $post_type,
						'post_status'      => 'publish',
					);

					if ($post_type == 'property') {
						$args['meta_key'] = 'price';
						$args['orderby'] = 'meta_value';
					}

					$post_lists = get_posts( $args );

					foreach ($post_lists as $post_list) {
						$bedrooms         = get_post_meta($post_list->ID, 'bedrooms', true);
						$bathrooms        = get_post_meta($post_list->ID, 'bathrooms', true);
						$square_feet      = get_post_meta($post_list->ID, 'square_feet', true);
						$car_garage       = get_post_meta($post_list->ID, 'car_garage', true);
						$price            = get_post_meta($post_list->ID, 'price', true);

						$post_list_src    = get_permalink($post_list->ID);
						$thumb_src        = wp_get_attachment_image_src( get_post_thumbnail_id($post_list->ID), 'thumbnail_size' );

				?>
					<div class="col-md-4 col-sm-6 col-xs-12 text-center">
						<a href="<?php echo $post_list_src; ?>"><img src="<?php echo $thumb_src[0]; ?>"></a>
						<h1><?php echo $post_list->post_title; ?></h1>
						<div class="plan-info">
							<h2 class="square-feet">Square Feet: <?php echo $square_feet; ?></h2>
							<?php 
							if (!empty($price) && isset($price)) {
								echo '<h2>Price: $' . $price . '</h2>';
							}
							?>
							<h6 class="other">
								<span><?php echo $bedrooms;   ?> Bedrooms   | </span>
								<span><?php echo $bathrooms;  ?> Bathrooms  | </span>
								<span><?php echo $car_garage; ?> Car Garage   </span>
							</h6>
						</div>
					</div>
				<?php		
					}

					if ( function_exists( "bbc_pagination" ) ):
						bbc_pagination();
					endif;
				?>
				</div>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();