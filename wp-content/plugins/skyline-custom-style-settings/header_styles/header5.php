 
<script type="text/javascript">
 // ==========  ADD STICKY HEADER ON SCROLL - FOR TOP NAV ========== //
  (function($) { "use strict";

$(window).on('load scroll', function() {
  if ($(document).scrollTop() < 1 ) {
            $('.nav-top .site-header').css('position', 'fixed').css('opacity', '1');
			$('.nav-top').removeClass('nav-scrolled');
		    $('.nav-transparent .site-header').removeClass('show-nav');
        }
        if ($(document).scrollTop() > 5) {
			$('.nav-top').addClass('nav-scrolled');
			$('.nav-transparent .site-header').addClass('show-nav');
		 }
	 });
	
	 })(jQuery);
</script>

<script type="text/javascript">
	 // TOP - WHEN IN MOBILE VIEW
(function($) { "use strict";      
$(window).on('resize load', function() {
// Sub-Menu Activation //
$('.nav-right .main-navigation li.menu-item-has-children > a').click(function(e) {
    e.preventDefault();
	$('ul.menu').addClass('second-level');
    $(this).parent('li').addClass('active');
});
// Back Button 1 //
$('.nav-right .main-navigation li.back-button a').click(function(e) {
	e.preventDefault();
	$('ul.menu').removeClass('second-level');
    $('ul.menu li').removeClass('active');
});
// Third-Menu Activation //
$('.nav-right .main-navigation ul ul li.menu-item-has-children > a').click(function(e) {
	e.preventDefault();
	$('ul.menu').addClass('third-level');
	$('ul.menu').removeClass('second-level');
});
// Back Button 1 //
$('.nav-right .main-navigation li.back-button2 a').click(function(e) {
	e.preventDefault();
	$('ul.menu').removeClass('third-level');
	$('ul.menu').addClass('second-level');
});
}); 
})(jQuery);
</script>
 <script type="text/javascript">
// ==========  RESPONSIVE MENU ========== //
  (function($) { "use strict";
     $(window).on('load', function() {
  var navHeight = $('header').outerHeight(true);
$('.nav-top .header-holder').css('height', navHeight);
	 });
$(window).on('resize load', function() {
  if ($(window).width() < <?php echo $skyline_data['mobile_menu']; ?>) {
     $('.header5').addClass('nav-closed');
	 $('.header5').removeClass('nav-top');
	 $('.header5').addClass('nav-right');
	 $('.header5').addClass('is-mobile');
	 $('.mobile-menu-bg').removeClass('open');
	 $('.mobile-menu-bar').removeClass('fade');
  }
 else {
	 $('.header5').removeClass('nav-closed');
	 $('.header5').removeClass('nav-right');
	 $('.header5').removeClass('is-mobile');
	 $('.header5').addClass('nav-top');
	 $('.mobile-menu-bg').removeClass('open');
	 $('.mobile-menu-bar').addClass('fade');
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
	 $('.header5').addClass('nav-closed');
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
$('.header5 .mobile-menu-bar i.menu-bars-icon').click(function() {
	$('.header5').removeClass('nav-closed');
	$('.mobile-menu-bg').addClass('open');
	$('.mobile-menu-bar').addClass('fade');
});
$('.header5 a.close-icon').click(function() {
	$('.header5').addClass('nav-closed');
	$('.mobile-menu-bg').removeClass('open');
	$('.mobile-menu-bar').removeClass('fade');
	$('.mobile-menu-bar').css('display','block');
});
 });
 })(jQuery);
 </script>