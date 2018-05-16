<?php
/*
 * Saves new field to postmeta for navigation
 */
 $custom_value = $icon_value = $icon_value2 = "";
add_action('wp_update_nav_menu_item', 'custom_nav_update',10, 3);
function custom_nav_update($menu_id, $menu_item_db_id, $args ) {
    if (isset($_REQUEST['menu-item-custom']) && is_array($_REQUEST['menu-item-custom']) ) {
        $custom_value = $_REQUEST['menu-item-custom'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_custom', $custom_value );
    }
	  if (isset($_REQUEST['menu-item-icon']) && is_array($_REQUEST['menu-item-icon']) ) {
        $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, 'icon', $icon_value );
    }
	  if (isset($_REQUEST['menu-item-icon2']) && is_array($_REQUEST['menu-item-icon2']) ) {
        $icon_value2 = $_REQUEST['menu-item-icon2'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, 'icon2', $icon_value2 );
    }
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','custom_nav_item' );
function custom_nav_item($menu_item) {
    $menu_item->custom = get_post_meta( $menu_item->ID, '_menu_item_custom', true );
    return $menu_item;
}

add_filter( 'wp_edit_nav_menu_walker', 'custom_nav_edit_walker',10,2 );
function custom_nav_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_Custom';
}

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
/**
 * @see Walker_Nav_Menu::start_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function start_lvl(&$output) {}

/**
 * @see Walker_Nav_Menu::end_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function end_lvl(&$output) {
}

/**
 * @see Walker::start_el()
 * @since 3.0.0
 *
 * @param string $output Passed by reference. Used to append additional content.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param object $args
 */
function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    ob_start();
    $item_id = esc_attr( $item->ID );
    $removed_args = array(
        'action',
        'customlink-tab',
        'edit-menu-item',
        'menu-item',
        'page-tab',
        '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
        if ( is_wp_error( $original_title ) )
            $original_title = false;
    } elseif ( 'post_type' == $item->type ) {
        $original_object = get_post( $item->object_id );
        $original_title = $original_object->post_title;
    }

    $classes = array(
        'menu-item menu-item-depth-' . $depth,
        'menu-item-' . esc_attr( $item->object ),
        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
    );

    $title = $item->title;

  if ( ! empty( $item->_invalid ) ) {
        $classes[] = 'menu-item-invalid';
        /* translators: %s: title of menu item which is invalid */
        $title = sprintf( esc_html__( '%s (Invalid)','skyline' ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( esc_html__( '%s (Pending)','skyline'), $item->title );
    }

    $title = empty( $item->label ) ? $title : $item->label;

    ?>
    <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-up-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-up"><abbr title="<?php echo esc_html_e('Move up','skyline'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-down-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-down"><abbr title="<?php echo esc_html_e('Move down','skyline'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php echo esc_html_e('Edit Menu Item','skyline'); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php echo esc_html__( 'Edit Menu Item','skyline' ); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                        <?php echo esc_html__( 'URL','skyline' ); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'Navigation Label','skyline' ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'Title Attribute','skyline' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php echo esc_html__( 'Open link in a new window/tab','skyline' ); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'CSS Classes (optional)','skyline' ); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'Link Relationship (XFN)','skyline' ); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'Description','skyline' ); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description"><?php echo esc_html_e('The description will be displayed in the menu if the current theme supports it.','skyline'); ?></span>
                </label>
            </p>        
            <?php
            /*
             * This is the added field
             */
            ?>      
           <p class="field-css-icon description description-wide">
                <label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'Icon Code for in Front of Menu Item','skyline' ); ?><br />
                    <input type="text" id="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-icon" name="menu-item-icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->icon ); ?>" />
					    <span class="description">
					  <?php 
					  $font_awesome = esc_url('https://fortawesome.github.io/Font-Awesome/icons/');
					  echo esc_html_e('Font Awesome Icon Code. Example: "fa-home"','skyline');
					  echo '<br/><a href="'.$font_awesome.'" target="_blank">';
					  echo esc_html_e('Font Awesome Icon Code Link (opens in new window)','skyline');
					  echo '</a>';?></span>
                </label>
            </p>
			
			 <p class="field-css-icon2 description description-wide">
                <label for="edit-menu-item-icon2-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'Icon Code for End of Menu Item','skyline' ); ?><br />
                    <input type="text" id="edit-menu-item-icon2-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-icon2" name="menu-item-icon2[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->icon2 ); ?>" />
					  <span class="description">
					  <?php 
					  echo esc_html_e('Font Awesome Icon Code. Example: "fa-home"','skyline');
					   echo '<br/><a href="'.$font_awesome.'" target="_blank">';
					  echo esc_html_e('Font Awesome Icon Code Link (opens in new window)','skyline');
					  echo '</a>';?></span>
                </label>
            </p>
			
            <p class="field-custom field-megamenu description description-wide">
                <label for="edit-menu-item-custom-<?php echo esc_attr($item_id); ?>">
                    <?php echo esc_html__( 'Mega Menu','skyline' ); ?><br />
					<?php
		$megamenu_off = $col3 = $col4 = $col5 = $col6 = "";
		$selected = esc_attr( $item->custom );
      if ($selected == "") {
        $megamenu_off = "selected='selected'";   
      } elseif ($selected == "megamenu col3") {
        $col3 = "selected='selected'";  
      } elseif ($selected == "megamenu col4") {
        $col4 = "selected='selected'";  
      } elseif ($selected == "megamenu col5") {
        $col5 = "selected='selected'";  
      } elseif ($selected == "megamenu col6") {
        $col6 = "selected='selected'";  
      }
	  ?>
					<select id="edit-menu-item-custom-<?php echo esc_attr($item_id); ?>" name="menu-item-custom[<?php echo esc_attr($item_id); ?>]"> 
<option value="" <?php echo esc_attr($megamenu_off); ?>><?php echo esc_html__('Mega Menu Off','skyline');?></option> 
<option value="megamenu col3" <?php echo esc_attr($col3); ?>><?php echo esc_html__('3 Column Mega Menu','skyline');?></option> 
<option value="megamenu col4" <?php echo esc_attr($col4); ?>><?php echo esc_html__('4 Column Mega Menu','skyline');?></option>
<option value="megamenu col5" <?php echo esc_attr($col5); ?>><?php echo esc_html__('5 Column Mega Menu','skyline');?></option>
<option value="megamenu col6" <?php echo esc_attr($col6); ?>><?php echo esc_html__('6 Column Mega Menu','skyline');?></option>
</select>
                </label>
            </p>
            <?php
            /*
             * end added field
             */
            ?>
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( esc_html__( 'Original: %s','skyline'), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    ),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php echo esc_html_e('Remove','skyline'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php echo esc_html_e('Cancel','skyline'); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
    <?php
    $output .= ob_get_clean();
    }
}
?>