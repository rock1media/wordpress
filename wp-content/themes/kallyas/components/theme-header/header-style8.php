<?php

/**
* Display the Style 8 header
* Hooks mostly, markup loaded through own template
*/

// Flexbox scheme override
$flexbox_scheme = array();
// Class added to siteheader-container
$siteheader_container_class = '';
// Sticky classes
$sticky_class = 'sticky-main-area';

// LOGO MARKUP
add_action( 'zn_head__main_left', 'zn_header_display_logo' );


// SEARCH
add_action( 'zn_head__main_center', 'zn_header_searchbox_inp' );


// CUSTOM TEXT
add_action( 'zn_head__main_right', 'zn_header_head_text', 10 );
// WPML LANGUAGE SWITCHER
add_action( 'zn_head__main_right', 'zn_wpml_language_switcher', 20 );
// SOCIAL ICONS
add_action( 'zn_head__main_right', 'zn_header_social_icons', 30 );


// HEADER NAVIGATION
add_action( 'zn_head__main_right_ext', 'zn_add_navigation', 10 );
// HIDDEN PANEL LINK
add_action( 'zn_head__main_right_ext', 'zn_hidden_pannel_link', 20 );
// LOGIN/LOGOUT TEXT
add_action( 'zn_head__main_right_ext', 'zn_login_text', 30 );
// REGISTER TEXT
add_action( 'zn_head__main_right_ext', 'zn_register_text', 40 );


// MAIN NAVIGATION
add_action( 'zn_head__bottom_left', 'zn_header_main_menu' );

// CART PANEL
if( function_exists('zn_woocomerce_cart') ){
    add_action( 'zn_head__bottom_right', 'zn_woocomerce_cart', 1 );
}
// CALL TO ACTION BUTTON
add_action( 'zn_head__bottom_right', 'zn_header_calltoaction', 2 );


// Add markup
include(locate_template('components/theme-header/header-markup.php'));