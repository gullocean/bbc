<?php
get_header();
// Get the custom fields for community post template.
$location = get_post_meta(get_the_ID(), 'location', true);

$img_group = array();
for ($i=1; $i < 4; $i++) { 
	$gallery_img_src = bbc_get_custom_field('community_gallery' . $i);
	if (!empty($gallery_img_src)) {
		array_push($img_group, $gallery_img_src);
	}
}

?>
	<div class="row">
		<div id="primary" class="col-md-12 mb-xs-24 community-template">
			<div class="container">
				<div class="community-info">
					<div class="col-md-6 col-xs-12 community-slider text-center">
						<div class="flexslider">
							<ul class="slides">
							<?php
							foreach ($img_group as $img_src) {
								?>
						    	<li>
						      		<img src="<?php echo $img_src; ?>" />
						    	</li>
								<?php
							}
							?>	
							</ul>
						</div>
						<a href="<?php echo bbc_get_custom_field('community_download_pdf'); ?>" target="blank" class="btn-blue">See community plat and available lots</a>
					</div>
					<div class="col-md-6 col-xs-12 community-desc">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content' );

						endwhile; // End of the loop.
						?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div><!-- #primary -->

		<input type="hidden" class="idaho_location" name="location0" value="<?php echo $location; ?>" />
		<div id="community-map" style="width: 100%; height: 300px;"></div>
	</div>
<?php
get_footer();