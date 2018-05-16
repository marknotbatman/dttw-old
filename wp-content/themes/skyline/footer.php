<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package skyline
 */
$skyline_data = skyline_redux_data(); 
 
?>
<div class="scrollup">
         <a class="scrolltotop" href="#"><i class="fa-angle-up"></i></a>
      </div>
	</div><!-- #content -->
<?php
	// Determine Navigation Style //
 if ($skyline_data['footer_type'] == "1") {
 require_once(SKYLINE_INCLUDES_PATH . '/footers/footer1.php');
} elseif ($skyline_data['footer_type'] == "2") {
 require_once(SKYLINE_INCLUDES_PATH . '/footers/footer2.php');
} elseif ($skyline_data['footer_type'] == "3") {
 require_once(SKYLINE_INCLUDES_PATH . '/footers/footer3.php');
} elseif ($skyline_data['footer_type'] == "4") {
 require_once(SKYLINE_INCLUDES_PATH . '/footers/footer4.php');
} else {
 require_once(SKYLINE_INCLUDES_PATH . '/footers/footer4.php');
}
?>
<?php
if(function_exists('skyline_custom_styles')){
skyline_custom_styles();
}
?>
</body>
</html>