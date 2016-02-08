<?php

/**
* Display the default header
* Hooks mostly, markup loaded through own template
*/

// Flexbox scheme override
$flexbox_scheme = array();
// Class added to siteheader-container
$siteheader_container_class = 'header--oldstyles';
// Sticky classes
$sticky_class = 'sticky-top-area';

// LOGO MARKUP
add_action( 'zn_head__side_left', 'zn_header_display_logo' );

// HEADER NAVIGATION
add_action( 'zn_head__top_right', 'zn_add_navigation', 10 );
// HIDDEN PANEL LINK
add_action( 'zn_head__top_right', 'zn_hidden_pannel_link', 20 );
// REGISTER TEXT
add_action( 'zn_head__top_right', 'zn_register_text', 30 );
// LOGIN/LOGOUT TEXT
add_action( 'zn_head__top_right', 'zn_login_text', 40 );
// SOCIAL ICONS
add_action( 'zn_head__top_right', 'zn_header_social_icons', 70, 1 );
// SEARCH BOX
add_action( 'zn_head__top_right', 'zn_header_searchbox_def', 80 );

// Add separators only for XS breakpoint
add_action( 'zn_head__before__top', 'zn_header_separator_xs', 10 );
add_action( 'zn_head__after__top', 'zn_header_separator_xs', 10 );


// If style 2 or 3, move languages and cart to left area
if($headerLayoutStyle == 'style2' || $headerLayoutStyle == 'style3'){
    // WPML LANGUAGE SWITCHER
    add_action( 'zn_head__top_left', 'zn_wpml_language_switcher', 10 );
    // CART PANEL
    if( function_exists('zn_woocomerce_cart') ){
        add_action( 'zn_head__top_left', 'zn_woocomerce_cart', 20 );
    }
    // CUSTOM TEXT
    add_action( 'zn_head__top_left', 'zn_header_head_text', 80 );
}
elseif($headerLayoutStyle == 'style5'){
    // Add separator after top
    add_action( 'zn_head__after__main_wrapper', 'zn_header_separator' );
}
// If style 1, 4, 5 and 6
else {
    // WPML LANGUAGE SWITCHER
    add_action( 'zn_head__top_right', 'zn_wpml_language_switcher', 50 );
    // CUSTOM TEXT
    add_action( 'zn_head__top_right', 'zn_header_head_text', 2 );
    // CART PANEL
    if( function_exists('zn_woocomerce_cart') ){
        add_action( 'zn_head__top_right', 'zn_woocomerce_cart', 60 );
    }
}


// MAIN NAVIGATION
add_action( 'zn_head__main_right', 'zn_header_main_menu', 10 );
// CALL TO ACTION BUTTON button
add_action( 'zn_head__main_right', 'zn_header_calltoaction', 20 );

// Add markup
include(locate_template('components/theme-header/header-markup.php'));