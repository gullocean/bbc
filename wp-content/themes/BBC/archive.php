<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bbc
 */
get_header(); ?>
<?php $layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : ''; ?>
	<div class="row">
		<div id="primary" class="col-md-8 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>"><?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php esc_html( single_post_title() ); ?></h1>
					</header>

					<?php
				endif;

				$layout_type = get_theme_mod( 'blog_layout_view', 'grid' );

				get_template_part( 'template-parts/layouts/blog', $layout_type );

				if ( function_exists( "bbc_pagination" ) ):
					bbc_pagination();
				endif;

			else :
				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		</div><!-- #primary -->
	</div>
<?php
get_footer();
