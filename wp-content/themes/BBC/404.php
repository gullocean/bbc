<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bbc
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div class="container">
			<main id="main" class="site-main default-template" role="main">

				<section class="error-404 not-found">
					<header class="page-header text-center">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bbc' ); ?></h1>
						<h4>Maybe you can search any floor plans from below search form.</h4>
					</header><!-- .page-header -->

					<div class="page-content">

						<?php
							get_search_form();
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div>
	</div><!-- #primary -->

<?php
get_footer();
