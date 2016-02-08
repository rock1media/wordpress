<?php
/**
 * Theme options > General Options
 */

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( 'GENERAL SETTINGS', 'zn_framework' ),
    "description" => __( 'These settings below are related to theme itself.', 'zn_framework' ),
    "id"          => "info_title1",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( "Use page preloader?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to show a page preloader.", 'zn_framework' ),
    "id"          => "page_preloader",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( "Hide page subheader?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to hide the page subheader ( including sliders ). Please note that this option can be overridden from each page/post", 'zn_framework' ),
    "id"          => "zn_disable_subheader",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);


$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( "Enable Smooth Scroll?", 'zn_framework' ),
    "description" => __( "This option will hijack the page default scroll and add an ease effect. It's very appealing with parallax scrolls and general nativation.", 'zn_framework' ),
    "id"          => "smooth_scroll",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);


$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "go_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#u0uQWA-kJOY', __( 'Click here to access video tutorial for this options section.', 'zn_framework' ), array(
    'slug'        => 'general_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'general_options',
    'parent'      => 'general_options',
));
