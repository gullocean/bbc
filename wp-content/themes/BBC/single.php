<?php
/**
 * The template for displaying all single posts.
 *
 * @package bbc
 */

get_header(); ?>
<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div id="primary">
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
