<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package bbc
 */

?>

</div><!-- #main -->
</section><!-- section -->

<footer class="site-footer footer bg-dark" role="contentinfo">
	<div class="main-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 footer-logo">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/footer-logo.png'; ?>">
					<p>Boise Building Company is dedicated to creating QUALITY one home at a time. Building in attractive, desirable communities located throughout Idaho's Treasure Valley.</p>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 useful-links">
					<div class="headline"><h2>Useful Links</h2></div>
					<?php bbc_useful_links();?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 contact-us">
					<div class="headline"><h2>Contact Us</h2></div>
					<div class="company-address">
						<p>1159 E Iron Eagle Dr #120</p>
						<p>Eagle, Idaho 83616</p>
						<p>Phone: 208.939.3945</p>
						<p>Email: <a href="mailto:info@boisebuilding.co">info@boisebuilding.co</a></p>
					</div>
				</div>			
			</div>
		</div>
	</div>
	<div class="copyright-section">
		<div class="container">
			<div class="row">
				<div class="copyright-text col-sm-6 col-xs-12">
					<div class="copyright-text">
						<?php echo wp_kses_post( get_theme_mod( 'bbc_footer_copyright' ) ); ?>
					</div>
				</div>
				<div class="social-icons col-sm-6 col-xs-12 text-right">
					<?php bbc_social_icons(); ?>
				</div>
			</div>
		</div>
	</div>
	<a class="btn btn-sm fade-half back-to-top inner-link" href="#top"><i class="fa fa-angle-up"></i></a>
</footer><!-- #colophon -->
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>