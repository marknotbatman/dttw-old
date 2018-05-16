.nav-top .main-navigation li a {
	padding: .82em 1em;
	margin-left: 0;
    margin-right: 0;
	border-radius: 0;
	border: 2px solid transparent;
}
.nav-top .main-navigation li.current-menu-item a {
border-color: #FFF;
}
.nav-top.nav-transparent.nav-scrolled .main-navigation li.current-menu-item a,
.nav-top.nav-scrolled .main-navigation li.current-menu-item a,
.nav-top .main-navigation ul.menu > li.current-menu-ancestor > a,
.nav-top .main-navigation li.current-menu-item a {
color: <?php echo $skyline_data['main_nav_bgcolor']; ?> !important;
background-color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
border-color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
border: 2px solid;
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
.nav-top .main-navigation li {
	padding-top: <?php echo $skyline_data['main_nav_height'] / 2 ?>px;
	padding-bottom: <?php echo $skyline_data['main_nav_height'] / 2 ?>px;
	margin-left: 0;
    margin-right: 0;
}
.nav-top .main-navigation li:nth-last-child(3) a {
    padding-right: 0 !important;
}
.nav-top .main-navigation li.current-menu-item:nth-last-child(3) a,
.nav-top .main-navigation li.current-menu-ancestor:nth-last-child(3) a {
    padding-right: 1em !important;
}
.nav-top .main-navigation li:nth-last-child(3) .sub-menu li a {
    padding-right: 30px !important;
}
.nav-top .main-navigation li:nth-last-child(3) .sub-menu li a:hover {
	padding-left: 29px !important;
	padding-right: 25px !important;
}
.nav-top.nav-transparent.nav-scrolled .main-navigation .sub-menu li.current-menu-item a,
.nav-top.nav-scrolled .main-navigation .sub-menu li.current-menu-item a,
.nav-top .main-navigation .sub-menu li.current-menu-item a {
	border: none !important;
	border-bottom: 1px solid <?php echo $skyline_data['main_nav_drop_menu_border']; ?> !important;
	border-right: 1px solid <?php echo $skyline_data['main_nav_drop_menu_border']; ?> !important;
}
.nav-top.nav-scrolled .main-navigation li {
    padding-top: 14px;
    padding-bottom: 14px;
}
.nav-top.nav-scrolled .main-navigation li a {
	padding: .82em 1em;
	margin-left: 0;
    margin-right: 0;
	border-radius: 0;
}
.nav-top.nav-scrolled .main-navigation li.current-menu-item li a,
.nav-top .main-navigation li.current-menu-item li a {
    border: none;
}
.nav-top .main-navigation li .sub-menu li a {
    border-bottom-width: 1px !important;
    border-top-width: 0 !important;
    border-right-width: 0 !important;
    border-left-width: 1px !important;
}
.nav-top.nav-scrolled .main-navigation li.current-menu-item li a {
color: <?php echo $skyline_data['main_nav_drop_menu_font']; ?> !important;
}
.nav-top.nav-scrolled .main-navigation li.current-menu-item li a:hover {
color: <?php echo $skyline_data['main_nav_drop_menu_font_hover']; ?> !important;
}