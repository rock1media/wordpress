<?php
/**
 * Theme options > General Options  > Navigation options
 */


$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( 'NAVIGATION OPTIONS', 'zn_framework' ),
    "description" => __( 'These options below are related to site\'s navigations. For example the header contains 2 registered menus: "Main Navigation" and "Header Navigation".', 'zn_framework' ),
    "id"          => "info_title7",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array(
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    'id'          => 'header_res_width',
    'name'        => __( 'Header responsive width', 'zn_framework'),
    'description' => __( 'Choose the desired width when the responsive menu should appear.', 'zn_framework' ),
    'type'        => 'slider',
    'class'       => 'zn_full',
    'std'        => '992',
    'helpers'     => array(
        'min' => '50',
        'max' => '1200'
    )
);

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Scrolling menu or sticky header?", 'zn_framework' ),
    "description" => __( "The scrolling menu will only display a simple cloned main navigation, upon scrolling.<br> The Sticky header, upon scrolling, will fix the entire menu to top even when scrolling to the bottom.", 'zn_framework' ),
    "id"          => "menu_follow",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Scrolling Menu (a.k.a. Chaser / Follow menu)", 'zn_framework' ), 'sticky' => __( "Sticky Header", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);

// $admin_options[] = array (
//     'slug'        => 'nav_options',
//     'parent'      => 'general_options',
//     "name"        => __( "Enable Scroll-Spy?", 'zn_framework' ),
//     "description" => __( "If you're trying to have a <strong>ONE-PAGE</strong> functionality, this option will enable the menu to move it's <em>Active</em> state, according to the section/zone associated with it.", 'zn_framework' ),
//     "id"          => "scrollspy_menu",
//     "std"         => 'no',
//     "value"       => 'yes',
//     "type"        => "toggle2",
//     'dependency'  => array ( 'element' => 'menu_follow', 'value' => array ( 'yes', 'sticky') ),
// );

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( "Header Dropdowns color scheme", 'zn_framework' ),
    "description" => __( "Select the color scheme for the dropdown menus in the site header (topnav, cart container, language dropdown etc.)", 'zn_framework' ),
    "id"          => "nav_color_theme",
    "std"         => '',
    'options'        => array(
        '' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
        'light' => 'Light (default)',
        'dark' => 'Dark'
    ),
    "type"        => "select"
);

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( "Main menu Dropdowns color scheme", 'zn_framework' ),
    "description" => __( "Select the color scheme for the MAIN MENU in the site header", 'zn_framework' ),
    "id"          => "navmain_color_theme",
    "std"         => '',
    'options'        => array(
        '' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
        'light' => 'Light (default)',
        'dark' => 'Dark'
    ),
    "type"        => "select"
);

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( "Enable dropdown Top Header Navigation? Only available for smartphones.", 'zn_framework' ),
    "description" => __( "This option will enable a dropdown menu for the header-navigation (not main-menu!). If you have for example lots of menu items in header, this option will fallback nicely in the header.", 'zn_framework' ),
    "id"          => "header_topnav_dd",
    "std"         => "yes",
    "value"         => "yes",
    "type"        => "toggle2",
);


// HELP STARTS HERE

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "nvo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'footer_options',
    'parent'      => 'general_options',
));