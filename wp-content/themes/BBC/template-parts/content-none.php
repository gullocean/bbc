<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

?>

<section class="no-results not-found">
	<div class="page-content">
		<header class="entry-header nolist">
			<h1 class="page-title"><?php esc_html_e( 'No Results matching above conditions.', 'BBC' ); ?></h1>

			<?php
			
			if (isset($_REQUEST['price']) && isset($_REQUEST['search'])) {
				$no_results_msg = 'Please search available homes with other conditions';
			} elseif (!isset($_REQUEST['price']) && isset($_REQUEST['search'])) {
				$no_results_msg = 'Please search home designs with other conditions';
			} else {
				$no_results_msg = '';
			}

			?>
			<h4><?php echo $no_results_msg; ?></h4>
		</header><!-- .page-header -->
	</div><!-- .page-content -->
</section><!-- .no-results -->
