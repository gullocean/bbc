<?php

/**
 * Useful Links Menu
 */

if ( ! function_exists( 'bbc_useful_links' ) ) :
	/**
	 * Display useful links in footer
	 *
	 * @package bbc
	 */
	function bbc_useful_links() {
		if ( has_nav_menu( 'useful-links' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'useful-links',
					'container'       => 'nav',
					'container_id'    => 'useful-links',
					'container_class' => 'useful-links',
					'menu_id'         => 'menu-useful-items',
					'menu_class'      => 'useful-list',
					'depth'           => 1,
				)
			);
		}
	}
endif;