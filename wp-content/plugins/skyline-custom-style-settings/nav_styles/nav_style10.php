.nav-top .main-navigation ul li a,
.nav-top.nav-scrolled .main-navigation ul li a {
	padding-top: 0px;
	padding-bottom: 0px;

}
.nav-top .main-navigation li {
	padding-top: <?php echo $skyline_data['main_nav_height'] / 2 - 3 ?>px;
	padding-bottom: <?php echo $skyline_data['main_nav_height'] / 2 ?>px;
}
.nav-top.nav-scrolled .main-navigation li {
padding-top: 24px;
padding-bottom: 21px;
}
.nav-top .main-navigation li {
	margin-left: 14px;
    margin-right: 14px;
	border-bottom: 3px solid transparent;
}
.nav-top .main-navigation li:nth-last-child(3) {
    margin-right: 0 !important;
}
.nav-top .main-navigation li.current-menu-item,
.nav-top.nav-transparent.nav-scrolled .main-navigation li.current-menu-item {
color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}
.nav-top.nav-transparent .main-navigation li.current-menu-item {
    border-bottom: 3px solid #FFF;
	color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}
.nav-top .main-navigation .sub-menu li.current-menu-ancestor {
	border-bottom: none !important;
}
.nav-top.nav-transparent.nav-scrolled .main-navigation li.current-menu-item {
border-color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}
.nav-top.nav-transparent.nav-scrolled .main-navigation li.current-menu-item a {
color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}
.nav-top .main-navigation li.current-menu-item,
.nav-top .main-navigation li.current-menu-ancestor {
    border-bottom: 3px solid <?php echo $skyline_data['main_nav_font_hover_color']; ?>;
	color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}
.nav-top .main-navigation li.current-menu-item a,
.nav-top .main-navigation li.current-menu-ancestor a {
	color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}
.nav-top.nav-transparent .main-navigation li.current-menu-item a,
.nav-top.nav-transparent .main-navigation li.current-menu-ancestor a {
	color: #FFF !important;
}
.nav-top .main-navigation .sub-menu li a,
.nav-top .main-navigation .sub-menu li.current-menu-item a,
.nav-top .main-navigation li.current-menu-item .sub-menu li a,
.nav-top.nav-scrolled .main-navigation .sub-menu li.current-menu-item a {
	color: <?php echo $skyline_data['main_nav_drop_menu_font']; ?> !important;
background-color: <?php echo $skyline_data['main_nav_drop_menu_bg']; ?> !important;
}
.nav-top .main-navigation .sub-menu li a:hover,
.nav-top .main-navigation .sub-menu li.current-menu-item a:hover,
.nav-top.nav-scrolled .main-navigation .sub-menu li.current-menu-item a:hover,
.nav-top .main-navigation li.current-menu-item .sub-menu li a:hover {
	color: <?php echo $skyline_data['main_nav_drop_menu_font_hover']; ?> !important;
background-color: <?php echo $skyline_data['main_nav_drop_menu_bg']; ?> !important;
}
.nav-top .main-navigation li .sub-menu li a {
    border-bottom-width: 1px;
    border-top-width: 0;
    border-right-width: 0;
    border-left: 1px solid <?php echo $skyline_data['main_nav_drop_menu_border']; ?> !important;
}