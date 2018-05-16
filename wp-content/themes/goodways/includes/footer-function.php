<?php 
// print javascript in the <head />
if(!function_exists("ts_print_javascript")){
	function ts_print_javascript(){
	

?>
<!-- Hook Flexslider -->
<?php 
if(is_front_page()){
$disableSlider = of_get_option('templatesquare_disable_slider' ,'');
if($disableSlider!=true){
$sliderInterval = of_get_option('templatesquare_slider_interval' ,600);
$sliderDisableNav = of_get_option('templatesquare_slider_disable_nav');
$sliderEnablePrevNext = of_get_option('templatesquare_slider_enable_prevnext');

?>
<script type="text/javascript">
jQuery(window).load(function() {
    jQuery('.flexslider').flexslider({
          animation: "fade",
		  animationDuration: <?php echo $sliderInterval; ?>,
		  directionNav: <?php if($sliderEnablePrevNext==true){echo "true";}else{echo "false";} ?>,
		  controlNav: <?php if($sliderDisableNav==true){echo "false";}else{echo "true";} ?>
        });
});
</script>
<?php
	}
}
?>


		
<?php 
	}// end ts_print_javascript()
	add_action("wp_footer","ts_print_javascript",20);
}

	
// get website title
if(!function_exists("ts_get_footer_text")){
	function ts_footer_text(){
	
		$foot= stripslashes(of_get_option('templatesquare_footer'));
		if($foot==""){
		
			_e('Copyright', 'templatesquare'); echo ' &copy;';
			global $wpdb;
			$post_datetimes = $wpdb->get_results("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970");
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes[0]->firstyear;
				$lastpost_year = $post_datetimes[0]->lastyear;
	
				$copyright = $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';
	
				echo $copyright;
				echo '<a href="'.home_url( '/').'">'.get_bloginfo('name') .'.</a>';
			}
			?><?php _e(' Design by', 'templatesquare'); ?>	<a href="<?php echo esc_url( __( 'http://templatesquare.com', 'templatesquare' ) ); ?>" title="">
			<?php _e('TemplateSquare.com','')?></a>
        <?php 
		}else{
        	echo $foot;
        }
		
	}// end ts_get_title()
}
?>