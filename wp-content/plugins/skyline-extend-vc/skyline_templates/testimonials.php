<style type="text/css">.carousel-indicators li {    border: 2px solid <?php echo esc_attr($testimonial_text_color); ?>;}.carousel-indicators .active {    background-color: <?php echo esc_attr($testimonial_text_color); ?>;}</style><!-- Build the Testimonials --><?php$testimonial2 = $testimonial3 = '';if ($testimonial_text2 != "") {$testimonial2 = "<div class='item'>					<p style='color:".esc_attr($testimonial_text_color)."'>".esc_html($testimonial_text2)."</p>						<h5 style='color: ".esc_attr($testimonial_text_color)."'>- ".esc_html($testimonial_author2)."</h5>					</div>";}if ($testimonial_text3 != "") {$testimonial3 = "<div class='item'>					<p style='color:".esc_attr($testimonial_text_color)."'>".esc_html($testimonial_text3)."</p>						<h5 style='color: ".esc_attr($testimonial_text_color)."'>- ".esc_html($testimonial_author3)."</h5>					</div>";}?><div id="carousel-testimonials" class="carousel slide testimonial-slider text-center" style="color: <?php echo $testimonial_text_color; ?>">								<!-- Wrapper for slides -->				<div class="carousel-inner">					<!-- Slide 1 -->					<div class="item active">					<p style="color: <?php echo esc_attr($testimonial_text_color); ?>"><?php echo esc_html($testimonial_text); ?></p>						<h5 style="color: <?php echo esc_attr($testimonial_text_color); ?>">- <?php echo esc_html($testimonial_author); ?></h5>					</div>					<!-- Slide 2 -->					<?php echo $testimonial2; ?>					<!-- Slide 3 -->					<?php echo $testimonial3; ?>				</div>				<!-- Indicators -->				<!-- Controls -->				<div class="testimonial-slider-controls">  <a class="left carousel-control" href="#carousel-testimonials" role="button" data-slide="prev">  <i class="fa-chevron-left"></i>  </a>  <a class="right carousel-control" href="#carousel-testimonials" role="button" data-slide="next">    <i class="fa-chevron-right"></i>  </a>  </div>			</div>