<?php
/**
 * The template for displaying search results pages.
 *
 * @package bbc
 */
get_header();
$layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<section id="primary" class="content-area search-page">
			<div class="container">
				<main id="main" class="site-main" role="main">
					<?php
						get_search_form();
						// Get data from URL into variables
						/*if ($_REQUEST['property_type'] != 'any') {
							$property_type = $_REQUEST['property_type'];
							$property_type_compare = '=';
						} else {
							$property_type = array('floorplan', 'move-in-ready');
							$property_type_compare = 'IN';
						}*/

						if (isset($_REQUEST['price'])) {
							$property_type = 'property';
						} else {
							$property_type = 'floor_plans';
						}

						$bedrooms       = $_REQUEST['bedrooms'] != 'any' ? $_REQUEST['bedrooms'] : 0;
						$bathrooms      = $_REQUEST['bathrooms'] != 'any' ? $_REQUEST['bathrooms'] : 0;
						$price          = $_REQUEST['price'] != 'any' ? $_REQUEST['price'] : 0;
						$garage         = $_REQUEST['garage'] != 'any' ? $_REQUEST['garage'] : 0;
						$square_feet    = $_REQUEST['square_feet'] != 'any' ? $_REQUEST['square_feet'] : 0;

						// Start the Query
						$v_args = array(
						        'post_type'     =>  $property_type,
						        'order'         =>  'ASC',
						        'orderby'       =>  'data', 
						        'meta_query'    =>  array(
						                                array(
						                                    'key'     => 'bedrooms',
						                                    'value'   => $bedrooms,
						                                    'compare' => '>=',
						                                ),
						                                array(
						                                    'key'     => 'bathrooms',
						                                    'value'   => $bathrooms,
						                                    'compare' => '>=',
						                                ),
						                                array(
						                                    'key'     => 'square_feet',
						                                    'value'   => $square_feet,
						                                    'compare' => '>=',
						                                ),
						                                array(
						                                    'key'     => 'car_garage',
						                                    'value'   => $garage,
						                                    'compare' => '>=', 
						                                ),
						                            )
					    );

						if (isset($_REQUEST['price'])) {
							$price_query = array(
	                            'key'     => 'price',
	                            'value'   => $price,
	                            'compare' => '>=',
							);
							array_push($v_args['meta_query'], $price_query);
						}

						$floorSearchQuery = new WP_Query( $v_args );

						// Show the results
						if( $floorSearchQuery->have_posts() ) :
							$filtered_posts = $floorSearchQuery->posts;
							foreach ($filtered_posts as $key => $filtered_post) {
								$square_feet   = get_post_meta($filtered_post->ID, 'square_feet', true);
								$bedrooms   = get_post_meta($filtered_post->ID, 'bedrooms', true);
								$bathrooms  = get_post_meta($filtered_post->ID, 'bathrooms', true);
								$price      = get_post_meta($filtered_post->ID, 'price', true);
								$car_garage = get_post_meta($filtered_post->ID, 'car_garage', true);

								$filtered_post_src  = get_permalink($filtered_post->ID);
								$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($filtered_post->ID), 'thumbnail_size' );
							?>
							<div class="col-md-4 col-sm-6 col-xs-12 text-center floor-plans">
								<a href="<?php echo $filtered_post_src; ?>"><img src="<?php echo $thumb_src[0]; ?>"></a>
								<h1><?php echo $filtered_post->post_title; ?></h1>
								<div class="plan-info">
									<h2 class="square_feet">Square Ft: <?php echo $square_feet; ?></h2>

									<?php if ($property_type == 'property'): ?>
									<h5 class="price">Price: $<?php echo $price; ?></h5>
									<?php endif;?>

									<h6 class="other">
										<span><?php echo $bedrooms;   ?> Bedrooms   | </span>
										<span><?php echo $bathrooms;  ?> Bathrooms  | </span>
										<span><?php echo $car_garage; ?> Car Garage   </span>
									</h6>
								</div>
							</div>
							<?php
							}
						else :
					    	get_template_part( 'template-parts/content', 'none' );
						endif;
						wp_reset_postdata();
					?>
				</main><!-- #main -->
			</div>
		</section><!-- #primary -->
	</div>
<?php
get_footer();
