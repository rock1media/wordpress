<?php

/**
* Display the Style 9 header
* Hooks mostly, markup loaded through own template
*/

// Flexbox scheme override
$flexbox_scheme = array(
    'main' => array(
        'left' => array(
            'stretch' => 'fxb-basis-20',
        ),
        'right' => array(
            'stretch' => 'fxb-basis-20',
        ),
    ),
);
// Class added to siteheader-container
$siteheader_container_class = '';
// Sticky classes
$sticky_class = 'sticky-top-area sticky-main-area';

// HEADER NAVIGATION
add_action( 'zn_head__top_left', 'zn_add_navigation', 10 );
// LOGIN/LOGOUT TEXT
add_action( 'zn_head__top_left', 'zn_login_text', 20 );
// REGISTER TEXT
add_action( 'zn_head__top_left', 'zn_register_text', 30 );
// HIDDEN PANEL LINK
add_action( 'zn_head__top_left', 'zn_hidden_pannel_link', 40 );
// CUSTOM TEXT
add_action( 'zn_head__top_left', 'zn_header_head_text', 50 );


// WPML LANGUAGE SWITCHER
add_action( 'zn_head__top_right', 'zn_wpml_language_switcher', 10 );
// SOCIAL ICONS
add_action( 'zn_head__top_right', 'zn_header_social_icons', 20 );


// Add separator after top
add_action( 'zn_head__after__top', 'zn_header_separator' );


// SEARCH BOX
add_action( 'zn_head__main_left', 'zn_header_searchbox_inp' );


// LOGO MARKUP
add_action( 'zn_head__main_center', 'zn_header_display_logo' );


// ADD CART PANEL
if( function_exists('zn_woocomerce_cart') ){
    add_action( 'zn_head__main_right', 'zn_woocomerce_cart', 2 );
}

// Add separator before bottom
add_action( 'zn_head__before__bottom', 'zn_header_separator' );

// MAIN NAVIGATION
add_action( 'zn_head__bottom_center', 'zn_header_main_menu', 10 );

// CALL TO ACTION BUTTON
add_action( 'zn_head__bottom_center', 'zn_header_calltoaction', 20 );

// Add markup
include(locate_template('components/theme-header/header-markup.php'));
