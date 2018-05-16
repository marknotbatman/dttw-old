<?php 
	global $pixia_frontend_options; 
	 if (!isset($pixia_frontend_options['ganalytics_text']))
		$pixia_frontend_options['ganalytics_text']="";
?>
	</div><!-- /#wrap -->
    <div class="push"></div>
    </div><!-- #ultra_wrapper -->
    <div class="footer">
    </div>
    <?php echo $pixia_frontend_options['ganalytics_text']; ?>
 	<?php wp_footer(); ?>
</body>
</html>