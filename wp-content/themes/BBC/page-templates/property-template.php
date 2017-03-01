<?php
/*
Template Name: Property Template
*/
get_header(); ?>

<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div id="primary" class="col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
			<div class="container">
				<div class="gallery-section">
					<div class="col-md-4 col-xs-12 custom-properties"></div>
					<div class="col-md-8 col-xs-12 gallery">
					</div>
				</div>
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; // End of the loop.
				?>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();