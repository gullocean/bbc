<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bbc
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function bbc_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( get_theme_mod( 'bbc_sidebar_position' ) == "pull-right" ) {
		$classes[] = 'has-sidebar-left';
	} else if ( get_theme_mod( 'bbc_sidebar_position' ) == "no-sidebar" ) {
		$classes[] = 'has-no-sidebar';
	} else if ( get_theme_mod( 'bbc_sidebar_position' ) == "full-width" ) {
		$classes[] = 'has-full-width';
	} else {
		$classes[] = 'has-sidebar-right';
	}

	return $classes;
}

add_filter( 'body_class', 'bbc_body_classes' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 *
 * @return array
 */
function bbc_page_menu_args( $args ) {
	$args['show_home'] = true;

	return $args;
}

add_filter( 'wp_page_menu_args', 'bbc_page_menu_args' );

// Mark Posts/Pages as Untiled when no title is used
add_filter( 'the_title', 'bbc_title' );

function bbc_title( $title ) {
	if ( $title == '' ) {
		return __( 'Untitled', 'bbc' );
	} else {
		return $title;
	}
}

/**
 * Password protected post form using Boostrap classes
 */
add_filter( 'the_password_form', 'bbc_custom_password_form' );

function bbc_custom_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<form class="protected-post-form" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post">
  <div class="row">
    <div class="col-lg-10">
        <p>' . esc_html__( "This post is password protected. To view it please enter your password below:", 'bbc' ) . '</p>
        <label for="' . esc_attr( $label ) . '">' . esc_html__( "Password:", 'bbc' ) . ' </label>
      <div class="input-group">
        <input class="form-control" value="' . get_search_query() . '" name="post_password" id="' . esc_attr( $label ) . '" type="password">
        <span class="input-group-btn"><button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="' . esc_attr__( "Submit", 'bbc' ) . '">' . esc_html__( "Submit", 'bbc' ) . '</button>
        </span>
      </div>
    </div>
  </div>
</form>';

	return $o;
}

// Add Bootstrap classes for table
add_filter( 'the_content', 'bbc_add_custom_table_class' );
function bbc_add_custom_table_class( $content ) {
	return preg_replace( '/(<table) ?(([^>]*)class="([^"]*)")?/', '$1 $3 class="$4 table table-hover" ', $content );
}

if ( ! function_exists( 'bbc_header_menu' ) ) :
	/**
	 * Header menu (should you choose to use one)
	 */
	function bbc_header_menu() {
		// display the WordPress Custom Menu if available
		wp_nav_menu( array(
			             'menu_id'         => 'menu',
			             'theme_location'  => 'primary',
			             'depth'           => 3,
			             'container'       => 'div',
			             'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',
			             'menu_class'      => 'menu',
			             //'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
			             //'walker'          => new wp_bootstrap_navwalker()
		             ) );
	} /* end header menu */
endif;

if ( ! function_exists( 'get_bbc_theme_options' ) ) {
	/**
	 * Get information from Theme Options and add it into wp_head
	 */
	function get_bbc_theme_options() {

		echo '<style type="text/css">';

		if ( get_theme_mod( 'link_color' ) ) {
			echo 'a {color:' . esc_attr( get_theme_mod( 'link_color' ) ) . '}';
		}
		if ( get_theme_mod( 'link_hover_color' ) ) {
			echo 'a:hover, a:active, .post-title a:hover,
        .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover,
        .woocommerce nav.woocommerce-pagination ul li span.current  { color: ' . esc_attr( get_theme_mod( 'link_hover_color' ) ) . ';}';
		}

		if ( get_theme_mod( 'button_color' ) ) {
			echo '.btn-filled, .btn-filled:visited, .woocommerce #respond input#submit.alt,
          .woocommerce a.button.alt, .woocommerce button.button.alt,
          .woocommerce input.button.alt, .woocommerce #respond input#submit,
          .woocommerce a.button, .woocommerce button.button,
          .woocommerce input.button { background:' . esc_attr( get_theme_mod( 'button_color' ) ) . ' !important; border: 2px solid' . esc_attr( get_theme_mod( 'button_color' ) ) . ' !important;}';
		}
		if ( get_theme_mod( 'button_hover_color' ) ) {
			echo '.btn-filled:hover, .woocommerce #respond input#submit.alt:hover,
          .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover,
          .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover,
          .woocommerce a.button:hover, .woocommerce button.button:hover,
          .woocommerce input.button:hover  { background: ' . esc_attr( get_theme_mod( 'button_hover_color' ) ) . ' !important; border: 2px solid' . esc_attr( get_theme_mod( 'button_hover_color' ) ) . ' !important;}';
		}

		if ( get_theme_mod( 'social_color' ) ) {
			echo '.social-icons li a {color: ' . esc_attr( get_theme_mod( 'social_color' ) ) . ' !important ;}';
		}

		echo '</style>';
	}
}
add_action( 'wp_head', 'get_bbc_theme_options', 10 );

/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function bbc_caption( $output, $attr, $content ) {
	if ( is_feed() ) {
		return $output;
	}

	$defaults = array(
		'id'      => 'bbc_caption_' . rand( 1, 192282 ),
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	);

	$attr = shortcode_atts( $defaults, $attr );

	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
	if ( $attr['width'] < 1 || empty( $attr['caption'] ) ) {
		return $content;
	}

	$output = '<figure id="' . esc_attr( $attr['id'] ) . '" class="thumbnail wp-caption ' . esc_attr( $attr['align'] ) . ' style="width: ' . ( esc_attr( $attr['width'] ) + 10 ) . 'px">';
	$output .= do_shortcode( $content );
	$output .= '<figcaption class="caption wp-caption-text">' . esc_html( $attr['caption'] ) . '</figcaption>';
	$output .= '</figure>';

	return $output;
}

add_filter( 'img_caption_shortcode', 'bbc_caption', 10, 3 );

/**
 * Adds the URL to the top level navigation menu item
 */
function bbc_add_top_level_menu_url( $atts, $item, $args ) {
	if ( ! wp_is_mobile() && isset( $args->has_children ) && $args->has_children ) {
		$atts['href'] = ! empty( $item->url ) ? esc_url( $item->url ) : '';
	}

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'bbc_add_top_level_menu_url', 99, 3 );

/**
 * Makes the top level navigation menu item clickable
 */
function bbc_make_top_level_menu_clickable() {
	if ( ! wp_is_mobile() ) { ?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				if ( $(window).width() >= 767 ) {
					$('.navbar-nav > li.menu-item > a').click(function () {
						window.location = $(this).attr('href');
					});
				}
			});
		</script>
	<?php }
}

add_action( 'wp_footer', 'bbc_make_top_level_menu_clickable', 1 );

/*
 * Add Read More button to post archive
 */
function bbc_excerpt_more( $more ) {
	return '<div><a class="btn-filled btn" href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '">' . esc_html_x( 'Read More', 'Read More', 'bbc' ) . '</a></div>';
}

add_filter( 'excerpt_more', 'bbc_excerpt_more' );

/*
 * Pagination
 */
if ( ! function_exists( 'bbc_pagination' ) ) {

	function bbc_pagination() {
		?>
		<div class="text-center">
			<nav class="pagination">
				<?php
				the_posts_pagination( array(
					                      'mid_size'  => 2,
					                      'prev_text' => '<icon class="fa fa-angle-left"></icon>',
					                      'next_text' => '<icon class="fa fa-angle-right"></icon>',
				                      ) ); ?>
			</nav>
		</div>
		<?php
	}
}


/*
 * Author bio on single page
 */
if ( ! function_exists( 'bbc_author_bio' ) ) {

	function bbc_author_bio() {

		if ( ! get_the_ID() ) {
			return;
		}

		$author_displayname = get_the_author_meta( 'display_name' );
		$author_nickname    = get_the_author_meta( 'nickname' );
		$author_fullname    = ( get_the_author_meta( 'first_name' ) != "" && get_the_author_meta( 'last_name' ) != "" ) ? get_the_author_meta( 'first_name' ) . " " . get_the_author_meta( 'last_name' ) : "";
		$author_email       = get_the_author_meta( 'email' );
		$author_description = get_the_author_meta( 'description' );
		$author_name = ( trim( $author_nickname ) != "" ) ? $author_nickname : ( trim( $author_displayname ) != "" ) ? $author_displayname : $author_fullname ?>

		<div class="author-bio">
			<div class="row">
				<div class="col-sm-2">
					<div class="avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
					</div>
				</div>
				<div class="col-sm-10">
					<b class="fn"><?php echo esc_html( $author_name ); ?></b>
					<p><?php
						if ( trim( $author_description ) != "" ) {
							echo esc_html( $author_description );
						} ?>
					</p>
					<a class="author-email"
					   href="mailto:<?php echo esc_attr( $author_email ); ?>"><?php echo esc_html( $author_email ); ?></a>
					<ul class="list-inline social-list author-social">
						<?php
						$twitter_profile = get_the_author_meta( 'twitter' );
						if ( $twitter_profile && $twitter_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $twitter_profile ); ?>">
								<i class="fa fa-twitter"></i>
							</a>
							</li><?php
						}

						$fb_profile = get_the_author_meta( 'facebook' );
						if ( $fb_profile && $fb_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $fb_profile ); ?>">
								<i class="fa fa-facebook"></i>
							</a>
							</li><?php
						}

						$dribble_profile = get_the_author_meta( 'dribble' );
						if ( $dribble_profile && $dribble_profile != '' ) { ?>
							<li>
								<a href="<?php echo esc_url( $dribble_profile ); ?>">
									<i class="fa fa-dribbble"></i>
								</a>
							</li>
							<?php
						}

						$github_profile = get_the_author_meta( 'github' );
						if ( $github_profile && $github_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $github_profile ); ?>">
								<i class="fa fa-vimeo"></i>
							</a>
							</li><?php
						}

						$vimeo_profile = get_the_author_meta( 'vimeo' );
						if ( $vimeo_profile && $vimeo_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $vimeo_profile ); ?>">
								<i class="fa fa-github"></i>
							</a>
							</li><?php
						} ?>
					</ul>
				</div>
			</div>
		</div>
		<!--end of author-bio-->
		<?php

	}
}
if ( ! function_exists( 'bbc_author_bio' ) ) {

	function bbc_author_bio() {

		if ( ! get_the_ID() ) {
			return;
		}

		$author_displayname = get_the_author_meta( 'display_name' );
		$author_nickname    = get_the_author_meta( 'nickname' );
		$author_fullname    = ( get_the_author_meta( 'first_name' ) != "" && get_the_author_meta( 'last_name' ) != "" ) ? get_the_author_meta( 'first_name' ) . " " . get_the_author_meta( 'last_name' ) : "";
		$author_email       = get_the_author_meta( 'email' );
		$author_description = get_the_author_meta( 'description' );
		$author_name = ( trim( $author_nickname ) != "" ) ? $author_nickname : ( trim( $author_displayname ) != "" ) ? $author_displayname : $author_fullname ?>

		<div class="author-bio">
			<div class="row">
				<div class="col-sm-2">
					<div class="avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
					</div>
				</div>
				<div class="col-sm-10">
					<b class="fn"><?php echo esc_html( $author_name ); ?></b>
					<p><?php
						if ( trim( $author_description ) != "" ) {
							echo esc_html( $author_description );
						} ?>
					</p>
					<a class="author-email"
					   href="mailto:<?php echo esc_attr( $author_email ); ?>"><?php echo esc_html( $author_email ); ?></a>
					<ul class="list-inline social-list author-social">
						<?php
						$twitter_profile = get_the_author_meta( 'twitter' );
						if ( $twitter_profile && $twitter_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $twitter_profile ); ?>">
								<i class="fa fa-twitter"></i>
							</a>
							</li><?php
						}

						$fb_profile = get_the_author_meta( 'facebook' );
						if ( $fb_profile && $fb_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $fb_profile ); ?>">
								<i class="fa fa-facebook"></i>
							</a>
							</li><?php
						}

						$dribble_profile = get_the_author_meta( 'dribble' );
						if ( $dribble_profile && $dribble_profile != '' ) { ?>
							<li>
								<a href="<?php echo esc_url( $dribble_profile ); ?>">
									<i class="fa fa-dribbble"></i>
								</a>
							</li>
							<?php
						}

						$github_profile = get_the_author_meta( 'github' );
						if ( $github_profile && $github_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $github_profile ); ?>">
								<i class="fa fa-vimeo"></i>
							</a>
							</li><?php
						}

						$vimeo_profile = get_the_author_meta( 'vimeo' );
						if ( $vimeo_profile && $vimeo_profile != '' ) { ?>
							<li>
							<a href="<?php echo esc_url( $vimeo_profile ); ?>">
								<i class="fa fa-github"></i>
							</a>
							</li><?php
						} ?>
					</ul>
				</div>
			</div>
		</div>
		<!--end of author-bio-->
		<?php

	}
}
/**
 * Custom comment template
 */
function bbc_cb_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'ul' == $args['style'] ) {
		$tag       = 'ul';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
			<?php endif; ?>
			<div class="avatar">
				<?php if ( $args['avatar_size'] != 0 ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				} ?>
			</div>
			<div class="comment">
				<b class="fn"><?php echo esc_html( get_comment_author() ); ?></b>
				<div class="comment-date">
					<time datetime="2016-01-28T12:43:17+00:00">
						<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'bbc' ), get_comment_date(), get_comment_time() ); ?></time><?php edit_comment_link( __( 'Edit', 'bbc' ), '  ', '' );
					?>
				</div>

				<?php comment_reply_link( array_merge( $args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bbc' ); ?></em>
						<br/>
					</p>
				<?php endif; ?>

				<?php comment_text(); ?>

			</div>
			<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	</li>
	<?php
}

/*
 * Filter to replace
 * Reply button class
 */
function bbc_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='btn btn-sm comment-reply", $class );

	return $class;
}

/*
 * Comment form template
 */
function bbc_custom_comment_form() {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$fields    = array(
		'author' =>
			'<input id="author" placeholder="' . __( 'Your Name', 'bbc' ) . ( $req ? '*' : '' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30" ' . $aria_req . ' required="required" />',

		'email' =>
			'<input id="email" name="email" type="email" placeholder="' . __( 'Email Address', 'bbc' ) . ( $req ? '*' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' required="required" />',

		'url' =>
			'<input placeholder="' . __( 'Your Website (optional)', 'bbc' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" />',
	);

	$comments_args = array(
		'label_submit'  => __( 'Leave Comment', 'bbc' ),
		'comment_field' => '<textarea placeholder="' . _x( 'Comment', 'noun', 'bbc' ) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required">' .
		                   '</textarea>',
		'fields'        => apply_filters( 'comment_form_default_fields', $fields )
	);


	return $comments_args;
}

/*
 * Header Logo
 */
function bbc_get_header_logo() {
	$logo_id = get_theme_mod( 'custom_logo', '' );
	$logo    = wp_get_attachment_image_src( $logo_id, 'full' ); ?>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
	if ( $logo[0] != '' ) { ?>
		<img src="<?php echo esc_url( $logo[0] ); ?>" class="logo"
		     alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>"><?php
	} else { ?>
		<span class="site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span><?php
	} ?>
	</a><?php
}

/*
 * Get layout class from single page
 * then from themeoptions
 */
function bbc_get_layout_class() {
	if ( is_singular() ) {
		$template     = get_page_template_slug();
		$layout_class = '';
		switch ( $template ) {
			case 'page-templates/home-template.php':
				$layout_class = 'home-template';
				break;
			case 'page-templates/property-template.php':
				$layout_class = 'property-template';
				break;
			default:
				$layout_class = 'default-template';
				break;
		}
	} else {
		$layout_class = get_theme_mod( 'blog_layout_template', 'sidebar-right' );
	}

	return $layout_class;
}

/*
 * Show Sidebar or not
 */
function bbc_show_sidebar() {
	global $post;
	$show_sidebar = true;
	if ( is_singular() && ( get_post_meta( $post->ID, 'site_layout', true ) ) ) {
		if ( get_post_meta( $post->ID, 'site_layout', true ) == 'no-sidebar' || get_post_meta( $post->ID, 'site_layout', true ) == 'full-width' ) {
			$show_sidebar = false;
		}
	} elseif ( get_theme_mod( 'bbc_sidebar_position' ) == "no-sidebar" || get_theme_mod( 'bbc_sidebar_position' ) == "full-width" ) {
		$show_sidebar = false;
	}

	return $show_sidebar;
}

/*
 * Top Callout
 */
function bbc_top_callout() {
	if ( get_theme_mod( 'top_callout', true ) ) {
		$header = get_header_image();
		?>
	<section
		class="page-title-section bg-secondary <?php echo $header ? 'header-image-bg' : '' ?>" <?php echo $header ? 'style="background-image:url(' . $header . ')"' : '' ?>>
		<div class="container">
			<div class="row">
				<?php
				$breadcrumbs_enabled = false;
				$title_in_post       = true;
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					$options             = get_option( 'wpseo_internallinks' );
					$breadcrumbs_enabled = ( $options['breadcrumbs-enable'] === true );
					$title_in_post       = get_theme_mod( 'hide_post_title', false );
				}
				$header_color = get_theme_mod( 'header_textcolor', false );
				?>
				<?php if ( $title_in_post ): ?>
					<div
						class="<?php echo $breadcrumbs_enabled ? 'col-md-6 col-sm-6 col-xs-12' : 'col-xs-12'; ?>">
						<h3 class="page-title" <?php echo $header_color ? 'style="color:#' . esc_attr( $header_color ) . '"' : '' ?>>
							<?php
							if ( is_home() ) {
								_e( ( get_theme_mod( 'blog_name' ) ) ? get_theme_mod( 'blog_name' ) : 'Blog', 'bbc' );
							} else if ( is_search() ) {
								_e( 'Search', 'bbc' );
							} else if ( is_archive() ) {
								echo ( is_post_type_archive( 'jetpack-portfolio' ) ) ? __( 'Portfolio', 'bbc' ) : get_the_archive_title();
							} else {
								echo ( is_singular( 'jetpack-portfolio' ) ) ? __( 'Portfolio', 'bbc' ) : get_the_title();
							} ?>
						</h3>
					</div>
				<?php endif; ?>
				<?php if ( function_exists( 'yoast_breadcrumb' ) ) { ?>
					<?php
					if ( $breadcrumbs_enabled ) { ?>
						<div class="<?php echo $title_in_post ? 'col-md-6 col-sm-6' : ''; ?> col-xs-12 text-right">
							<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
						</div>
					<?php } ?>
				<?php } ?>

			</div>
			<!--end of row-->
		</div>
		<!--end of container-->
		</section><?php
	} else { ?>
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) { ?>
			<div class="container mt20"><?php
			yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
			</div><?php
		}
	}
}

/*
 * Load page blogs on homepage
 */
function bbc_page_blogs() {
	$blog_args = array(
		'sort_order' => 'desc',
		'sort_column' => 'post_title',
		'meta_key' => 'homepage-blog',
		'meta_value' => 'true',
		'post_type' => 'page',
		'post_status' => 'publish'
	);
	$home_blog_pages = get_pages($blog_args);

	foreach ($home_blog_pages as $key => $blog_page) {
		$blog_page_id = $blog_page->ID;
		$blog_url = get_permalink($blog_page_id);
		$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($blog_page_id), 'thumbnail_size' );

		if ($blog_page->post_title == 'Move-In Ready Homes') {
			$see_more_link = get_field('ready_home_see_more_link', get_the_ID());
		} elseif ($blog_page->post_title == 'Floor Plans') {
			$see_more_link = get_field('floor_plans_see_more_link', get_the_ID());
		} else if ($blog_page->post_title == 'Communities') {
			$see_more_link = get_field('communities_see_more_link', get_the_ID());
		} else {
			$see_more_link = $blog_url;
		}
	?>
	<div class="col-md-4 col-xs-12">
		<div class="blog_thumb">
			<a href="<?php  echo $blog_url; ?>">
				<img src="<?php echo $thumb_src[0]; ?>">
			</a>		
		</div>
		<div class="blog_info">
			<p class="blog_title"><a href="<?php  echo $blog_url; ?>"><?php echo $blog_page->post_title; ?></a></p>
			<p class="blog_more_link"><a href="<?php  echo $see_more_link; ?>">See More</a></p>
		</div>
	</div>
	<?php
		if ($key == (count($home_blog_pages) - 1)) {
			echo '<div class="clearfix"></div>';
		}
	}
}

/*
 * Display testimonials
 */
function bbc_testimonials() {
	$tms_args = array(
		'sort_order' => 'asc',
		'sort_column' => 'post_date',
		'post_type' => 'testimonial',
		'post_status' => 'publish'
	);

	$tms_pages = get_posts($tms_args);

	foreach ($tms_pages as $key => $tms_page) {
	?>
	<div class="col-md-6 col-xs-12">
		<div class="tms_wrapper">
			<div class="tms_content">
				<?php echo $tms_page->post_content; ?>
			</div>
		</div>
		<div class="tms_author">
			<?php echo $tms_page->post_title; ?>
		</div>
	</div>
	<?php
		if ($key == (count($tms_pages) - 1)) {
			echo '<div class="clearfix"></div>';
		}
	}
}

/*
 * Display Social Icons
 */
function bbc_include_social_icons() {
	$social_icons = array(
		't-1' => 'https://www.facebook.com/boisebuildingco',
		't-2' => 'https://twitter.com/BoiseBuildingCo',
		't-3' => 'http://pinterest.com',
		't-4' => 'http://www.linkedin.com/profile/view?id=96482539',
		't-5' => 'mailto:mike@boisebuilding.co',
		't-6' => '/contact'
	);

	?>
	<div class="social-icons">
	<?php
	foreach ($social_icons as $key => $value) {
		?>
		<a href="<?php echo $value; ?>">
			<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/' . $key . '.png'?>">
		</a>
		<?php	
	}
	?>
	</div>
	<?php
}
/*
 * Display Image Group
 */
function bbc_include_image_group() {

	$img_items = array('item1', 'item2', 'item3', 'item4');

	?>
	<div class="image-group">
	<?php
	foreach ($img_items as $item) {
		?>
		<div class="col-md-3 col-xs-6 text-center"><img src="<?php echo bbc_get_custom_field($item); ?>"></div>
		<?php	
	}
	?>
	<div class="clearfix"></div>
	</div>
	<?php
}

/*
 * Display social icons in custom post template.
 */
function bbc_display_social_icons() {
	$social_icons = array(
		'facebook' => 'https://www.facebook.com/boisebuildingco',
		'twitter' => 'https://twitter.com/BoiseBuildingCo',
		'mail' => 'mailto:mike@boisebuilding.co',
		'instagram' => 'https://www.instagram.com/boisebuildingco',
	);

	?>
	<div class="sharing-icons margin30">
	<?php
	foreach ($social_icons as $key => $value) {
		?>
		<a href="<?php echo $value; ?>">
			<img src="<?php echo get_template_directory_uri() . '/assets/images/social_icons/' . $key . '.png'?>">
		</a>
		<?php	
	}
	?>
	</div>
	<?php
}
/*
 * Get data from custom field.
 */
function bbc_get_custom_field($field_name) {
	$custom_field_val = get_field($field_name, get_the_ID());

	return $custom_field_val;
}
