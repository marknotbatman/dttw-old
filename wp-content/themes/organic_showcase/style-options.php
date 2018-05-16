<style type="text/css" media="screen">
<?php 
	$background_stretch = of_get_option('background_stretch');
	$site_width = of_get_option('site_width');
	$center_site = of_get_option('center_site'); 
	$nav_hover = of_get_option('nav_hover'); 
	$heading_link_color = of_get_option('heading_link_color');
	$heading_link_hover_color = of_get_option('heading_link_hover_color');
	$link_color = of_get_option('link_color'); 
	$link_hover_color = of_get_option('link_hover_color');
	$highlight_color = of_get_option('highlight_color'); 
?>

body {
<?php 
	if ($background_stretch == '1') {
	    echo '-webkit-background-size: cover !important;';
	    echo '-moz-background-size: cover !important;;';
	    echo '-o-background-size: cover !important;;';
	    echo 'background-size: cover !important;;';
    }; 
?>
}

.container {
<?php 
	if ($site_width) {
	    echo 'max-width: ' .$site_width. ';';
    }; 
?>
}

#wrap .container {
<?php 
	if ($center_site == '1') {
	    echo 'margin: 0px auto 0px;';
    }; 
?>
}

.menu a:focus, .menu a:hover, .menu a:active,
.menu li.sfHover:hover, .menu li.sfHover:hover li, .menu li li,
#navigation .menu .current_page_item .sub-menu a,
#navigation .menu .current_page_ancestor .sub-menu a,
#navigation .menu .current-menu-item .sub-menu a,
#navigation .menu .current-cat .sub-menu a,
#navigation .menu .current-menu-ancestor .sub-menu a {
<?php 
	if ($nav_hover) {
	    echo 'background-color: ' .$nav_hover. ';';
    }; 
?>
}

.container h1 a, .container h2 a, .container h3 a, .container h4 a, .container h5 a, .container h6 a,
.container h1 a:link, .container h2 a:link, .container h3 a:link, .container h4 a:link, .container h5 a:link, .container h6 a:link,
.container h1 a:visited, .container h2 a:visited, .container h3 a:visited, .container h4 a:visited, .container h5 a:visited, .container h6 a:visited {
<?php 
	if ($heading_link_color) {
	    echo 'color: ' .$heading_link_color. ';';
    }; 
?>
}

.container h1 a:hover, .container h2 a:hover, .container h3 a:hover, .container h4 a:hover, .container h5 a:hover, .container h6 a:hover,
.container h1 a:focus, .container h2 a:focus, .container h3 a:focus, .container h4 a:focus, .container h5 a:focus, .container h6 a:focus,
.container h1 a:active, .container h2 a:active, .container h3 a:active, .container h4 a:active, .container h5 a:active, .container h6 a:active,
.container .slide-info .headline a:hover, .container .slide-info .headline a:focus, .container .slide-info .headline a:active,
#wrap .site-title a:hover, #wrap .site-title a:focus, #wrap.site-title a:active {
<?php 
	if ($heading_link_hover_color) {
	    echo 'color: ' .$heading_link_hover_color. ';';
    }; 
?>
}

.container a, .container a:link, .container a:visited {
<?php 
	if ($link_color) {
	    echo 'color: ' .$link_color. ';';
    }; 
?>
}

.sidebar ul.menu li a, .sidebar ul.menu li a:visited, .sidebar ul.menu li a:link {
<?php 
	if ($link_color) {
	    echo 'color: ' .$link_color. ' !important;';
    }; 
?>
}

.container a:hover, .container a:focus, .container a:active {
<?php 
	if ($link_hover_color) {
	    echo 'color: ' .$link_hover_color. ';';
    }; 
?>
}

.sidebar ul.menu li a:hover, .sidebar ul.menu li a:active, .sidebar ul.menu li a:focus,
.sidebar ul.menu .current_page_item a, .sidebar ul.menu .current-menu-item a {
<?php 
	if ($link_hover_color) {
	    echo 'color: ' .$link_hover_color. ' !important;';
    }; 
?>
}

.btn:hover, .button:hover, .more-link:hover, .portfolio .more-link:hover, .article .more-link:hover, .reply a:hover, 
#searchsubmit:hover, #submit:hover, #comments #respond input#submit:hover, #wrap .gform_wrapper input.button:hover, 
.container #portfolio-filter li a.current, .container #portfolio-filter li a:hover, .container .gallery a:hover {
<?php 
	if ($highlight_color) {
	    echo 'background-color: ' .$highlight_color. ';';
    }; 
?>
}
</style>