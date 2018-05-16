	<?php 
		get_header(); 
		$hide_ttl="no";
		add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
		/*
		 * Return a new number of maximum columns for shop archives
		 * @param int Original value
		 * @return int New number of columns
		 */
		function wc_loop_shop_columns( $number_columns ) {
		  $woo_col_nr=3;
		  return $woo_col_nr;
		}
	?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40 pixia_cols-3">
    	<?php pirenko_main_before(); ?>
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40 prk-woocommerce" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
        	<div class="colored_bg boxed_shadow">
            	<?php 
					if ($hide_ttl=="no")
					{
						?>
						<div class="page-header">
							<h3>
								<header_font><?php echo get_the_title(wc_get_page_id('shop')); ?></header_font>
							</h3>
						</div>
						<?php
					}
					else
					{
						?>
						<div style="height:20px"></div>
						<?php
					}
				?>
                <div class="padded_text on_colored">
					<?php woocommerce_content(); ?>
					<div class="clearfix"></div>
                </div>
            </div>
      	</div><!-- /#main -->
    	<?php pirenko_main_after(); ?>
    </div><!-- /#content -->
	<?php get_footer(); ?>