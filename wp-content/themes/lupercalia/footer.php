<?php wp_footer(); ?> 

			</div> <!-- #main -->
			
			<?php lupercalia_footer_section_callback(); ?>

			<div class="footer-wrap">

				<footer id="footer" class="footer" role="contentinfo">
				
					<?php echo bloginfo('name'); ?> &copy; <?php echo date('Y') ?>. <?php esc_attr_e('All rights reserved', 'lupercalia') ?>.<br />
					
					<?php esc_attr_e('Powered by', 'lupercalia') ?> <a href="http://wordpress.org/">WordPress</a> &amp; <a href="http://wordpress.org/themes/lupercalia">Lupercalia Theme</a>.
				
				</footer> <!-- #footer -->

			</div>	<!-- .footer-wrap -->

		</div> <!-- #page -->
	
	</body>
	
</html>

