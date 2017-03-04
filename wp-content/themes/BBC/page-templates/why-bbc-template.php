<?php
/*
Template Name: Why BBC Template
*/
get_header(); ?>


<?php 
// Get the custom fields for about template.
$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail_size' );

?>
	<div class="row">
		<div class="banner"><img src="<?php echo $banner_src[0]; ?>"></div>
		<div id="primary" class="col-md-12 mb-xs-24 why-bbc-template">
			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; // End of the loop.
				?>

				<div class="why-company">
					<div class="col-md-6 col-xs-12 img relative">
						<img src="<?php echo bbc_get_custom_field('why_bbc_logo'); ?>" class="center-position" />
					</div>
					<div class="col-md-6 col-xs-12 desc">
						<h3><?php echo bbc_get_custom_field('why_bbc_headline'); ?></h3>
						<p class="text-justify"><?php echo bbc_get_custom_field('why_bbc_desc'); ?></p>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="treasure-legacy">
					<h3><?php echo bbc_get_custom_field('treasure_legacy_headline'); ?></h3>
					<p class="text-justify"><?php echo bbc_get_custom_field('treasure_legacy_desc'); ?></p>
					<ul class="list-info">
						<li><?php echo bbc_get_custom_field('desc1'); ?></li>
						<li><?php echo bbc_get_custom_field('desc2'); ?></li>
						<li><?php echo bbc_get_custom_field('desc3'); ?></li>
						<li><?php echo bbc_get_custom_field('desc4'); ?></li>
						<li><?php echo bbc_get_custom_field('desc5'); ?></li>
					</ul>
				</div>

				<div class="peace-mind">
					<div class="col-md-6 col-xs-12 desc">
						<h3><?php echo bbc_get_custom_field('peace_mind_headline'); ?></h3>
						<p class="text-justify"><?php echo bbc_get_custom_field('peace_mind_desc'); ?></p>
					</div>
					<div class="col-md-6 col-xs-12 img relative">
						<img src="<?php echo bbc_get_custom_field('peace_mind_logo'); ?>" class="center-position" />
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="divider"></div>
				<?php bbc_include_image_group(); ?>
			</div>
		</div><!-- #primary -->
	</div>
<?php
get_footer();