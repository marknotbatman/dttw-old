<?php
/**
 * The template for displaying search forms in Goodways
 *
 * @package WordPress
 * @subpackage Goodways
 * @since Goodways 1.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<div class="searcharea">
    <input type="text" name="s" id="s" value="<?php _e('Enter the keyword...','templatesquare');?>" onfocus="if (this.value == '<?php _e('Enter the keyword...','templatesquare');?>')this.value = '';" onblur="if (this.value == '')this.value = '<?php _e('Enter the keyword...','templatesquare');?>';" />
    <input type="submit" class="searchbutton" value="" />
</div>
</form>

