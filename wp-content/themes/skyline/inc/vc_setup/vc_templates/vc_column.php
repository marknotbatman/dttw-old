<?php
$output = $font_color = $el_class = $width = $animate = $offset = $animation = $col_align = $col_vert_align = '';
extract(shortcode_atts(array(
	'font_color'      => '',
	'col_align'      => '',
	'col_vert_align'      => '',
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
	'animate' => '',
	'offset' => '',
	'animation' => '',
	'delay' => '',
), $atts));
$animate = ($animate);
if ($animate == 1) {
$animate = "ae";
} else {
$animate = "";
}
$animation = ($animation);
$delay = ($delay);
$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);
$el_class .= ' wpb_column vc_column_container';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div class="' . esc_attr($css_class) . ' ' . esc_attr($animate) . ' ' . esc_attr($col_align) .'" data-animation="' . esc_attr($animation) . '" data-delay="' . esc_attr($delay) . '"  style="color:' . esc_attr($font_color).'">';
$output .= "\n\t\t".'<div class="wpb_wrapper ' . esc_attr($col_vert_align) . '">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;