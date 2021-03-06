<?php
	/*
		Plugin Name: Pirenko Portfolio Tags
		Plugin URI: http://www.munto.net
		Description: A widget to show in a different way tags or categories for portfolio.
		Version: 1.0
		Author: Pirenko
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', 'load_pirenko_tags_portfolio' );
	//REGISTER WIDGET
	function load_pirenko_tags_portfolio() {
		register_widget( 'pirenko_tags_portfolio_widget' );
	}
	//CREATE CLASS TO CONTROL EVERYTHING
	class pirenko_tags_portfolio_widget extends WP_Widget 
	{
		//SET UP WIDGET
		function pirenko_tags_portfolio_widget() 
		{
			$widget_ops = array( 'classname' => 'pirenko-tags-portfolio-widget', 'description' => ('A widget to add Tag or Categories Links for Portfolio posts.') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'pirenko-tags-portfolio-widget' );
			parent::__construct( 'pirenko-tags-portfolio-widget', __('Pirenko: Portfolio Tag Links', 'pirenko-tags-portfolio-widget'), $widget_ops, $control_ops );
			wp_enqueue_style('pirenko-tags-portfolio-css', ''.get_bloginfo('template_directory'). '/inc/theme_widgets/pirenko-tags_portfolio/tags.css', null, '1.0');
		}

		//SET UP WIDGET OUTPUT
		function widget( $args, $instance ) 
		{
			extract($args);
			//BEFORE WIDGET CODE
			echo $before_widget;	
			//DISPLAY TITLE IF NECESSARY
			if (!empty( $instance['title'] ) )
					echo $before_title . $instance['title'] . $after_title;
			?>
			<div class="pirenko_tags cf" class="">
                <ul class="theme_tags">
                    <?php
						if ( $instance['link_type']=='both')
							$links_type=array('portfolio_tag','pirenko_skills');
						else
							$links_type=$instance['link_type'];
						$args=array(
						'taxonomy'  => $links_type, 
						'format' => 'array',
						'orderby' => 'count',
						'order' => 'DESC',
						'unit'=>'px',
						'smallest' => 12,
                        'largest'=>12,
					   ); 
   
                       	$tag_cloud=wp_tag_cloud($args);
                        if (!empty($tag_cloud))
						{
							foreach($tag_cloud as $tags) :
								echo "<li>";
								echo $tags;
								echo "</li>";
							endforeach; 
						}
						else
						{
							echo ("Tags not found!");	
						}
                    ?>
                </ul>
			</div>
			<?php
			//AFTER WIDGET CODE
			echo $after_widget;
		}
		//UPDATE WIDGET SETTINGS
		function update( $new_instance, $old_instance ) 
		{
			return $new_instance;
		}
		//SET UP WIDGET FORM ON THE CONTROL PANEL
		function form( $instance ) 
		{
			if (isset($instance['title']))
				$title = $instance['title'] ;
			else
				$title="";
			if (isset($instance['min_size']))
				$min_size = $instance['min_size'] ;
			else
				$min_size="12";
			if (isset($instance['max_size']))
				$max_size = $instance['max_size'] ;
			else
				$max_size="12";
			if (isset($instance['link_type']))
				$link_type = $instance['link_type'];
			else
				$link_type="tags";
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'spw'); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" style="width:89%;" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('link_type'); ?>"><?php _e('Use skills or categories?', 'spw'); ?></label><br />
				<select id="<?php echo $this->get_field_id('link_type'); ?>" name="<?php echo $this->get_field_name('link_type'); ?>" style="width:69%;">
					<?php   
						if ( $link_type == 'category' ) // Make default first in list
                        	echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='pirenko_skills'>Skills</option>";
                       	else
                          	echo "\n\t<option style=\"padding-right: 10px;\" value='pirenko_skills'>Skills</option>";
                      	if ( $link_type == 'portfolio_tag' ) // Make default first in list
                        	echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='portfolio_tag'>Tags</option>";
                       	else
                         	echo "\n\t<option style=\"padding-right: 10px;\" value='portfolio_tag'>Tags</option>";
						if ( $link_type == 'both' ) // Make default first in list
                        	echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='both'>Both</option>";
                       	else
                         	echo "\n\t<option style=\"padding-right: 10px;\" value='both'>Both</option>";
							
                    ?>
              	</select>
			</p>
			<?php
			
		}
	}
?>