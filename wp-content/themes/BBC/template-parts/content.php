<?php
/**
 * Template part for displaying posts.
 *
 * @package BBC
 */

$layout_class = ( function_exists( 'bbc_get_layout_class' ) ) ? bbc_get_layout_class() : '';
?>
<article id="post-<?php the_ID(); ?>" class="post-content post-grid-wide <?php echo esc_attr( $layout_class ); ?>">
	<?php if (!is_front_page()): ?>
	<h2 class="post-title">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
	</h2>
	<?php endif;?>
	<?php the_content(); ?>
</article>