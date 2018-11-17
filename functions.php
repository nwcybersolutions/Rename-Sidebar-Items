<?php

/*
Plugin Name: Rename Sidebar Items
Plugin URI: https://github.com/nwcybersolutions/Rename-Sidebar-Items
Description: Ranames Specific Sidebar Items in the Admin Dashboard
Author: Northwest Cyber Solutions
Author URI: https://nwcybersolutions.com
Version: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: Rename SpecificSidebar Items
Domain Path: /languages
*/
add_action( 'admin_menu', 'rename_sidebar_items', 999 );

function rename_sidebar_items() 
{
    global $menu;

    // Pinpoint menu item
    $woo = recursive_array_search_php_91365( 'WooCommerce', $menu );
    $bookings = recursive_array_search_php_91365( 'Bookings', $menu );

    // Change Woocommerce
    
    if( !$woo )
        return;

    $menu[$woo][0] = 'Store Settings';
    
    // Change Bookings
    
    if( !$bookings)
        return;

    $menu[$bookings][0] = 'Appointments';
}


function recursive_array_search_php_91365( $needle, $haystack ) 
{
    foreach( $haystack as $key => $value ) 
    {
        $current_key = $key;
        if( 
            $needle === $value 
            OR ( 
                is_array( $value )
                && recursive_array_search_php_91365( $needle, $value ) !== false 
            )
        ) 
        {
            return $current_key;
        }
    }
    return false;
}
