<script type="text/javascript">
// ==========  RESPONSIVE MENU ========== //
  (function($) { "use strict";
$(window).on('resize load', function() {
  if ($(window).width() < <?php echo $skyline_data['mobile_menu']; ?>) {
     $('.header1').addClass('nav-closed');
	 $('.mobile-menu-bg').removeClass('open');
	 $('.mobile-menu-bar').removeClass('fade');
  }
 else {
	 $('.mobile-menu-bg').removeClass('open');
 }
});
	 })(jQuery);
	 
	 </script>
	 <script type="text/javascript">
// ========== MOBILE MENU FUNCTIONS ==== Links stop working when this is active ====== //
// ========== CLOSE MENU WHEN FINAL LINK IS CLICKED - NECESSARY FOR ONE PAGER ========== //
(function($) { "use strict";
$(window).on('resize load', function() {
  if ($(window).width() < <?php echo $skyline_data['mobile_menu']; ?>) {
$('li.menu-item a').click(function(e){
if ($(this).parent('li').hasClass('menu-item-has-children')) {
} else {
	 $('.header1').addClass('nav-closed');
	 $('.mobile-menu-bg').removeClass('open');
	 $('.mobile-menu-bar').removeClass('fade');
}
});
}
 });
 })(jQuery);
</script>

<script type="text/javascript">
// ==========  OPEN/CLOSE FUNCTION FOR MENU ========== //
// REQUIRED TO LOAD AFTER THE RESPONSIVE OPTIONS ABOVE //
// LEFT MENU
(function($) { "use strict";
$(window).on('load resize', function() {
// Open-Close Menu When Button is Clicked//
$('.header1 .mobile-menu-bar i.menu-bars-icon').click(function() {
	$('.header1').removeClass('nav-closed');
	$('.mobile-menu-bg').addClass('open');
	$('.mobile-menu-bar').addClass('fade');
});
$('.header1 a.close-icon').click(function() {
	$('.header1').addClass('nav-closed');
	$('.mobile-menu-bg').removeClass('open');
	$('.mobile-menu-bar').removeClass('fade');
	$('.mobile-menu-bar').css('display','block');
});
 });
 })(jQuery);
 </script>