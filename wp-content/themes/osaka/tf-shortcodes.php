<?php 
class MtShortcode
{
    public static function grid($attr, $content)
    {
        $content    = self::remove_trailing_pragraphs($content);
        $content    = "<div class='columns'>". do_shortcode($content) ."</div>";
        
        return $content;
    }
    
    public static function column($attr, $content)
    {
        $width      = 4;
        if(!empty($attr['width']))
        {
            $width  = (is_numeric($attr['width']))? (int) abs($attr['width']) : $width;
        }
        $width      = ($width > 0 and $width < 13)? $width : 4;
        
        $classes    = '';
        if(isset($attr['clear']))
        {
            $classes .= ' col-clear';
        }
        
        $content    = self::remove_trailing_pragraphs($content);
        $content    = "<div class='col-{$width}{$classes}'>". do_shortcode($content) ."</div>";
        
        return $content;
    }
    
    private static function remove_trailing_pragraphs($content)
    {
        if ( '</p>' == substr( $content, 0, 4 ) and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        {
            $content = substr( $content, 4, strlen( $content ) - 7 );
        }
        
        return $content;
    }
}

add_shortcode('grid',   array('MtShortcode', 'grid'));
add_shortcode('column', array('MtShortcode', 'column'));