<?php
/*
Template Name: Floor Plans Template
*/
get_header(); ?>

<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div id="primary" class="col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
			<div class="floor-plans">
				<h3 class="page-title text-center"><?php echo $post->post_title; ?></h3>
				<div class="container">
					<?php 
					$args = array(
						//'order' => 'asc',
						'post_parent' => $post->ID,
						'post_type'   => 'page', 
						'post_status' => 'publish' 
					);
					$children_pages = get_children( $args );

					foreach ($children_pages as $children_page) {
						$child_id = $children_page->ID;
						$child_url = get_permalink($child_id);
						$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($child_id), 'thumbnail_size' );
					?>
					<div class="col-md-4 col-sm-6 col-xs-12 text-cener">
						<a href="<?php echo $child_url; ?>"><img src="<?php echo $thumb_src[0]; ?>"></a>
						<a href="<?php echo $child_url; ?>" class="plan-title"><?php echo $children_page->post_title; ?></a>
					</div>
					<?php
					}
					?>
					</div>
				</div>
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content' );

			endwhile; // End of the loop.
			?>
		</div><!-- #primary -->
	</div>
<?php
get_footer();