<?php
// =============================== TS Recent Posts widget ======================================
class TS_RecentPostWidget extends WP_Widget {
    /** constructor */

	function TS_RecentPostWidget() {
		$widget_ops = array('classname' => 'widget_ts_recent_posts', 'description' => __('TS - Recent Posts','templatesquare') );
		$this->WP_Widget('ts-recent-posts', __('TS - Recent Posts','templatesquare'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('TS Recent Posts','templatesquare') : $instance['title']);
		$category = apply_filters('widget_category', $instance['category']);
		$showpost = apply_filters('widget_showpost', $instance['showpost']);
		$disabledate = apply_filters('widget_disabledate', isset($instance['disabledate']));
		$disablethumb = apply_filters('widget_disablethumb', isset($instance['disablethumb']));
		$showtext = apply_filters('widget_showtext', isset($instance['showtext']));
		$instance['category'] = esc_attr(isset($instance['category'])? $instance['category'] : "");
		global $wp_query;
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                        
								<?php  if (have_posts()) : ?>
                                
                                <ul class="ts-recent-post-widget">
									<?php $querycat = get_cat_name($category);?>
                                    <?php 
                                        if($showpost==""){$showpost=3;}
										$temp = $wp_query;
										$wp_query= null;
										$wp_query = new WP_Query();
										$wp_query->query("showposts=".$showpost."&category_name=" . $querycat);
										global $post;
                                    ?>
                                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                                    <li>
                                    	<?php if($disablethumb!="true") {?>
                                        <?php
                                        $custom = get_post_custom($post->ID);
                                        $cf_thumb = (isset($custom["thumb-small"][0]))? $custom["thumb-small"][0] : "";
                                        
                                        if($cf_thumb!=""){
                                            $thumb = '<img src='. $cf_thumb .' alt=""  class="alignleft"/>';
                                        }elseif(has_post_thumbnail($post->ID) ){
                                            $thumb = get_the_post_thumbnail($post->ID, 'post-thumb-small', array('alt' => '', 'class' => 'alignleft'));
                                        }else{
                                            $thumb ="";
                                        }
                                        echo  $thumb;
                                        ?>
                                        <?php } ?>
                                        <h3>
                                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'templatesquare');?> <?php the_title_attribute(); ?>">
                                        <?php the_title();?>
                                        </a>
                                        </h3>
                                        <?php if($showtext=="true") {?>
										<span class="lp-text"><?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,15);?></span>
                                        <?php } ?>
                                        <?php if($disabledate!="true") {?>
                                        <span class="smalldate"><?php  the_time('M d, Y') ?> <span class="auth"><?php _e('by','templatesquare');?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a></span></span>
                                        <?php } ?>
                                        <span class="clear"></span>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                                
                                <?php $wp_query = null; $wp_query = $temp; wp_reset_query();?>
                                
								<?php endif; ?>

								
								
              <?php echo $after_widget; ?>
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$instance['title'] = (isset($instance['title']))? $instance['title'] : "";
		$instance['category'] = (isset($instance['category']))? $instance['category'] : "";
		$instance['showpost'] = (isset($instance['showpost']))? $instance['showpost'] : "";
		$instance['disabledate'] = (isset($instance['disabledate']))? $instance['disabledate'] : "";
		$instance['disablethumb'] = (isset($instance['disablethumb']))? $instance['disablethumb'] : "";
		$instance['showtext'] = (isset($instance['showtext']))? $instance['showtext'] : "";
					
        $title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
		$showpost = esc_attr($instance['showpost']);
		$disabledate = esc_attr($instance['disabledate']);
		$disablethumb = esc_attr($instance['disablethumb']);
		$showtext = esc_attr($instance['showtext']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'templatesquare'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
            <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'templatesquare'); ?><br />
			<?php 
			$args = array(
			'selected'         => $category,
			'echo'             => 1,
			'name'             =>$this->get_field_name('category')
			);
			wp_dropdown_categories( $args );
			?>
			</label></p>
			
            <p><label for="<?php echo $this->get_field_id('showpost'); ?>"><?php _e('Number of Post:', 'templatesquare'); ?> <input class="widefat" id="<?php echo $this->get_field_id('showpost'); ?>" name="<?php echo $this->get_field_name('showpost'); ?>" type="text" value="<?php echo $showpost; ?>" /></label></p>
            
            
            <p><label for="<?php echo $this->get_field_id('disablethumb'); ?>"><?php _e('Disable Thumb:', 'templatesquare'); ?> 
			
			<?php if($instance['disablethumb']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('disablethumb'); ?>" id="<?php echo $this->get_field_id('disablethumb'); ?>" value="true" <?php echo $checked; ?> />			</label></p>
                            
            <p><label for="<?php echo $this->get_field_id('disabledate'); ?>"><?php _e('Disable Date:', 'templatesquare'); ?> 
			
			<?php if($instance['disabledate']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('disabledate'); ?>" id="<?php echo $this->get_field_id('disabledate'); ?>" value="true" <?php echo $checked; ?> />			</label></p>
                            
            <p><label for="<?php echo $this->get_field_id('showtext'); ?>"><?php _e('Show Text:', 'templatesquare'); ?> 
			
			<?php if($instance['showtext']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('showtext'); ?>" id="<?php echo $this->get_field_id('showtext'); ?>" value="false" <?php echo $checked; ?> />			</label></p>  
                            
        <?php 
    }

} // class  Widget
?>