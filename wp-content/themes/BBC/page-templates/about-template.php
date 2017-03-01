<?php
/*
Template Name: About Template
*/
get_header(); ?>

<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div class="banner"></div>
		<div id="primary" class="col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
			<div class="container">
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