.nav-top .main-navigation li a {
	padding: 0.65em 0;
	margin-left: 0;
    margin-right: 0;
	border-radius: 0;
	border-bottom: <?php echo $skyline_data['main_nav_border_width']; ?>px solid transparent;
}
.nav-top.nav-transparent .main-navigation li.current-menu-item a {
border-color: #FFF;
padding: 0.65em 0;
color: #FFF !important;
}
.nav-top.nav-transparent.nav-scrolled .main-navigation li.current-menu-item a,
.nav-top.nav-scrolled .main-navigation li.current-menu-item a,
.nav-top .main-navigation ul.menu > li.current-menu-ancestor > a {
color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
border-color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
border-bottom: <?php echo $skyline_data['main_nav_border_width']; ?>px solid;
padding: 0.65em 0;
}
.nav-top .main-navigation li {
	padding-top: <?php echo $skyline_data['main_nav_height'] / 2 ?>px;
	padding-bottom: <?php echo $skyline_data['main_nav_height'] / 2 ?>px;
	margin-left: 14px;
    margin-right: 14px;
}
.nav-top .main-navigation li:nth-last-child(3) {
    margin-right: 0 !important;
}
.nav-top .main-navigation li.current-menu-item a {
border-bottom: <?php echo $skyline_data['main_nav_border_width']; ?>px solid <?php echo $skyline_data['main_nav_font_hover_color']; ?>;
}
.nav-top.nav-transparent.nav-scrolled .main-navigation .sub-menu li.current-menu-item a,
.nav-top.nav-scrolled .main-navigation .sub-menu li.current-menu-item a,
.nav-top .main-navigation .sub-menu li.current-menu-item a {
	border-bottom: 1px solid <?php echo $skyline_data['main_nav_drop_menu_border']; ?> !important;
	border-right: 1px solid <?php echo $skyline_data['main_nav_drop_menu_border']; ?> !important;
}
.nav-top.nav-scrolled .main-navigation li {
    padding-top: 18px;
    padding-bottom: 18px;
}
.nav-top.nav-scrolled .main-navigation li a {
	padding: 0.65em 0;
	margin-left: 0;
    margin-right: 0;
	border-radius: 0;
}
.nav-top.nav-scrolled .main-navigation li.current-menu-item li a,
.nav-top .main-navigation li.current-menu-item li a {
    border: none;
}
.nav-top.nav-scrolled .main-navigation li.current-menu-item li a {
color: <?php echo $skyline_data['main_nav_drop_menu_font']; ?> !important;
}
.nav-top.nav-scrolled .main-navigation li.current-menu-item li a:hover {
color: <?php echo $skyline_data['main_nav_drop_menu_font_hover']; ?> !important;
}