<?php$im_id = rand();if ($icon_link2 == "") {$icon_link2 = "";} else {$icon_link2 = "<a class='icon-style-button-".$im_id."' href='".esc_url($icon_link2)."'>".esc_html($icon_link2_text)."</a>";}if ($icon_border_style2 == "1") {$icon_border_style2 = "2px solid transparent";$icon_border_radius = "15px";$icon_button_radius = "25px";} elseif ($icon_border_style2 == "2") {$icon_border_style2 = "2px solid transparent";$icon_border_radius = "0px";$icon_button_radius = "0px";} elseif ($icon_border_style2 == "3") {$icon_border_style2 = "2px solid transparent";$icon_border_radius = "3px";$icon_button_radius = "3px";} elseif ($icon_border_style2 == "4") {$icon_border_style2 = "2px dotted transparent";$icon_border_radius = "15px";$icon_button_radius = "25px";} elseif ($icon_border_style2 == "5") {$icon_border_style2 = "2px dotted transparent";$icon_border_radius = "0px";$icon_button_radius = "0px";} elseif ($icon_border_style2 == "6") {$icon_border_style2 = "2px dotted transparent";$icon_border_radius = "3px";$icon_button_radius = "3px";} elseif ($icon_border_style2 == "7") {$icon_border_style2 = "2px dashed transparent";$icon_border_radius = "15px";$icon_button_radius = "25px";} elseif ($icon_border_style2 == "8") {$icon_border_style2 = "2px dashed transparent";$icon_border_radius = "0px";$icon_button_radius = "0px";} elseif ($icon_border_style2 == "9") {$icon_border_style2 = "2px dashed transparent";$icon_border_radius = "3px";$icon_button_radius = "3px";} elseif ($icon_border_style2 == "10") {$icon_border_style2 = "none";$icon_border_radius = "0px";$icon_button_radius = "3px";} // If Themify Iconif ($icon2_themify == "") {	// No Themify Icon Code} else {	$icon_code2 = $icon2_themify;}// For Solid BG button fixif ($icon_color2 == "#ffffff") {$icon_color_replace = $icon_color2;} else {	$icon_color_replace = $icon_color2;}?><style type="text/css">a.icon-style-button-<?php echo $im_id; ?> {color: <?php echo esc_attr($icon_color2); ?> !important;background-color: <?php echo esc_attr($icon_bg_color2);?>;border-color: <?php echo esc_attr($icon_bg_color2);?>;border-radius: <?php echo esc_attr($icon_button_radius);?>;-webkit-transition: all .35s;    -moz-transition: all .35s;    -o-transition: all .35s;    transition: all .35s;}a.icon-style-button-<?php echo $im_id; ?>:hover {color: <?php echo esc_attr($icon_bg_color2);?> !important;background-color: <?php echo esc_attr($icon_color2);?>;border-color: <?php echo esc_attr($icon_color2);?>;}</style><div class="icon-style2" style="background-color: <?php echo esc_attr($icon_boxbg_color2); ?>; border: <?php echo esc_attr($icon_border_style2); ?>; border-color: <?php echo esc_attr($icon_border_color2); ?> !important; border-radius: <?php echo esc_attr($icon_border_radius); ?>;"><i style="color: <?php echo esc_attr($icon_color2); ?>; background-color: <?php echo esc_attr($icon_bg_color2); ?>" class="<?php echo esc_attr($icon_code2); ?>"></i><h3 style="color: <?php echo esc_attr($icon_heading_color2); ?>"><?php echo esc_html($icon_heading2); ?></h3><p><?php echo $content; ?></p><?php echo $icon_link2; ?></div>