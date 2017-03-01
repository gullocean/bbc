<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package bbc
 */ ?>
    
<?php
if ( ! is_active_sidebar( 'sidebar-1' ) || ( function_exists('bbc_show_sidebar') && !bbc_show_sidebar() ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-md-4 hidden-sm" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
