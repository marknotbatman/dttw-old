<?php 
global $NHP_Options;

// set menu json

$menu                       = wp_nav_menu(array('echo' => 0));
$menus_id                   = get_nav_menu_locations();
$menu_items                 = wp_get_nav_menu_items($menus_id['top']);
$menu_data                  = array();
$menu_object_allowed_type   = array('custom', 'page');

if($menu_items)
{
    foreach($menu_items as $_menu_item)
    {
        if($_menu_item->menu_item_parent === '0' and in_array($_menu_item->object, $menu_object_allowed_type))
        {
            if($_menu_item->object == 'page')
            {
                $page_id          = $_menu_item->object_id;
                $page             = get_page($page_id);
                $_menu_item->slug = $page->post_name;
            }
            array_push($menu_data, $_menu_item);
        }
    }
}

foreach($menu_data as &$_menu_data)
{
    if(empty($_menu_data->sub))
        $_menu_data->sub = array();
    
    foreach($menu_items as $_menu_item)
    {
        if($_menu_data->ID == (int) $_menu_item->menu_item_parent)
        {
            if($_menu_item->object == 'page')
            {
                $page_id            = $_menu_item->object_id;
                $page               = get_page($page_id);
                $_menu_item->slug   = $page->post_name;
            }
            
                        
            array_push($_menu_data->sub, $_menu_item);
        }
    }
}