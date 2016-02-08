<?php

/**
* Display the Style 7 header
* Hooks mostly, markup loaded through own template
*/

// Flexbox scheme override
$flexbox_scheme = array(
    'main' => array(
        'left' => array(
            'stretch' => 'fxb-basis-auto fxb-grow-0 fxb-sm-full',
        ),
        'center' => array(
            'stretch' => 'fxb-basis-auto fxb-sm-half',
        ),
        'right' => array(
            'stretch' => 'fxb-basis-auto fxb-sm-half',
        ),
    ),
);

// Class added to siteheader-container
$siteheader_container_class = '';
// Sticky classes
$sticky_class = 'sticky-top-area';

// Add gradient BG
add_action( 'zn_before_siteheader_inside', 'zn_header_gradient_bg', 10 );

// SOCIAL ICONS
add_action( 'zn_head__top_left', 'zn_header_social_icons', 10 );
// CUSTOM TEXT
add_action( 'zn_head__top_left', 'zn_header_head_text', 10 );


// WPML LANGUAGE SWITCHER
add_action( 'zn_head__top_right', 'zn_wpml_language_switcher', 10 );
// HEADER NAVIGATION
add_action( 'zn_head__top_right', 'zn_add_navigation', 20 );
// REGISTER TEXT
add_action( 'zn_head__top_right', 'zn_register_text', 20 );
// LOGIN/LOGOUT TEXT
add_action( 'zn_head__top_right', 'zn_login_text', 30 );
// HIDDEN PANEL LINK
add_action( 'zn_head__top_right', 'zn_hidden_pannel_link', 40 );
// search box
add_action( 'zn_head__top_right', 'zn_header_searchbox_def', 60 );

// Add separator after top
add_action( 'zn_head__after__top', 'zn_header_separator' );

// LOGO MARKUP
add_action( 'zn_head__main_left', 'zn_header_display_logo', 10 );

// Add separator (visible only on XS)
add_action( 'zn_head__main_left', 'zn_header_separator_xs', 20 );

// MAIN NAVIGATION
add_action( 'zn_head__main_center', 'zn_header_main_menu', 20 );


// CART PANEL
if( function_exists('zn_woocomerce_cart') ){
    add_action( 'zn_head__main_right', 'zn_woocomerce_cart', 1 );
}
// CALL TO ACTION BUTTON
add_action( 'zn_head__main_right', 'zn_header_calltoaction', 2 );


// Add markup
include(locate_template('components/theme-header/header-markup.php'));