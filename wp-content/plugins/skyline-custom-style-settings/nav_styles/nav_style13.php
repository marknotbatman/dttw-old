.nav-top .main-navigation li a,
.nav-top.nav-scrolled .main-navigation li a {
	padding: 0;
	margin-left: 14px;
    margin-right: 14px;
	border-radius: 0;
	position: relative;
}
.nav-top .main-navigation li.current-menu-item a {
border-color: #FFF;
}
.nav-top.nav-transparent .main-navigation li.current-menu-item a {
color: #FFF !important;
}
.nav-top.nav-transparent.nav-scrolled .main-navigation li.current-menu-item a,
.nav-top.nav-scrolled .main-navigation li.current-menu-item a,
.nav-top .main-navigation ul.menu > li.current-menu-ancestor > a {
color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}
.nav-top .main-navigation ul li a {
	padding-top: <?php echo $skyline_data['main_nav_height'] / 2 ?>px;
	padding-bottom: <?php echo $skyline_data['main_nav_height'] / 2 ?>px;
	margin-left: 14px;
    margin-right: 14px;
}
.nav-top .main-navigation ul .sub-menu li,
.nav-top .main-navigation ul .sub-menu li a {
	margin-left: 0;
    margin-right: 0;
}
.nav-top .main-navigation li:nth-last-child(3) {
    margin-right: 0 !important;
}

.nav-top.nav-transparent.nav-scrolled .main-navigation .sub-menu li.current-menu-item a,
.nav-top.nav-scrolled .main-navigation .sub-menu li.current-menu-item a,
.nav-top .main-navigation .sub-menu li.current-menu-item a {
	border-bottom: 1px solid <?php echo $skyline_data['main_nav_drop_menu_border']; ?> !important;
	border-right: 1px solid <?php echo $skyline_data['main_nav_drop_menu_border']; ?> !important;
}
.nav-top.nav-scrolled .main-navigation li a {
    padding-top: 22px;
    padding-bottom: 22px;
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

.current-menu-item a:after {
font-family: 'FontAwesome';
position: absolute;
clear: both;
  content: "\f0D7";
  text-align: center;
  display: block;
  line-height: 1;
font-size: 16.5px;
left: 50%;
margin-left:-5.5px;
top: -5.5px;
}
.nav-top.nav-transparent .current-menu-item a:after {
	color:#FFFFFF !important;
}
.nav-top.nav-transparent.nav-scrolled .current-menu-item a:after,
.nav-top.nav-scrolled .current-menu-item a:after,
.nav-top .current-menu-item a:after {
	color: <?php echo $skyline_data['main_nav_font_hover_color']; ?> !important;
}