<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package BBC
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="nav-container">
			<div class="container-fluid bbc-top">
				<div class="container">
					Contact Us:  208.939.3945 |<a href="#">Online</a>
				</div>
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="container nav-bar">
					<div class="row">
						<div class="module left site-title-container">
							<?php bbc_get_header_logo(); ?>
						</div>
						<div class="module widget-handle mobile-toggle right visible-sm visible-xs">
							<i class="fa fa-bars"></i>
						</div>
						<div class="module-group right">
							<div class="module left">
								<?php bbc_header_menu(); // main navigation ?>
							</div>
							<!--end of menu module-->
						</div>
						<!--end of module group-->
					</div>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
	<?php 
		if (is_front_page()) {
			echo do_shortcode('[URIS id=39]');
			//masterslider(1);
		}
	?>
	<div id="content" class="main-container">
		<section class="content-area">
			<div id="main" role="main">