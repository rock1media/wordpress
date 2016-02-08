<?php

$desc = sprintf(
    '%s ( <a href="%s" target="_blank" title="%s">%s</a>).',
    __( 'These options below are related to site\'s call to action button in header.', 'zn_framework' ),
    esc_url( 'http://hogash.d.pr/1leyL' ),
    __( 'Click to open screenshot', 'zn_framework' ),
    __( 'Open screenshot', 'zn_framework' )
);
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( 'HEADER\'S CALL TO ACTION BUTTON OPTIONS', 'zn_framework' ),
    "description" => $desc,
    "id"          => "info_title6",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

// Show Call to Action Button In header
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Call to Action button in header", 'zn_framework' ),
    "description" => __( "Please choose if you want to display the call to action button or not.", 'zn_framework' ),
    "id"          => "head_show_cta",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    )
);

// Style Call to Action Button In header
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Call to Action button style", 'zn_framework' ),
    "description" => __( "Select a style.", 'zn_framework' ),
    "id"          => "head_show_cta_style",
    "std"         => "ribbon",
    "type"        => "select",
    "options"     => array (
        "ribbon" => __( "Ribbon style", 'zn_framework' ),
        "lined"  => __( "Lined button (Not recommended, use Custom)", 'zn_framework' ),
        "custom"  => __( "Custom Button ( Multiple )", 'zn_framework' )
    ),
    // TODO: Remove comment when multi-dependency is developed (to also hide when CTA disabled)
    // 'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
);

// Add link to Call to Action Button
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Set the link for the Call to Action button in header", 'zn_framework' ),
    "description" => __( "Set the URL to link the Call to Action button to.", 'zn_framework' ),
    "id"          => "head_add_cta_link",
    "std"         => "",
    "type"        => "link",
    "options"     => zn_get_link_targets(),
    // TODO: Remove comment when multi-dependency is developed (to also hide when CTA disabled)
    // 'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
    'dependency'  => array ( 'element' => 'head_show_cta_style', 'value' => array ( 'ribbon', 'lined' ) ),
);

// Set text for Call to Action Button In header
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Set the text for the Call to Action button", 'zn_framework' ),
    "description" => __( "Select the text you want to display int the call to action button.", 'zn_framework' ),
    "id"          => "head_set_text_cta",
    "type"        => "text",
    "std"         => __( "<strong>FREE</strong>QUOTE", 'zn_framework' ),
    // TODO: Remove comment when multi-dependency is developed (to also hide when CTA disabled)
    // 'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
    'dependency'  => array ( 'element' => 'head_show_cta_style', 'value' => array ( 'ribbon', 'lined' ) ),
);

// BG Color
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Select background color", 'zn_framework' ),
    "description" => __( "Select Call to action (ribbon style) background color.", 'zn_framework' ),
    "id"          => "wpk_cs_bg_color",
    "std"         => '#cd2122',
    "type"        => "colorpicker",
    // TODO: Remove comment when multi-dependency is developed (to also hide when CTA disabled)
    // 'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
    'dependency'  => array ( 'element' => 'head_show_cta_style', 'value' => array ( 'ribbon', 'lined' ) ),
);


// FG Color
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Select text color", 'zn_framework' ),
    "description" => __( "Select text color.", 'zn_framework' ),
    "id"          => "wpk_cs_fg_color",
    "std"         => '#fff',
    "type"        => "colorpicker",
    // TODO: Remove comment when multi-dependency is developed (to also hide when CTA disabled)
    // 'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
    'dependency'  => array ( 'element' => 'head_show_cta_style', 'value' => array ( 'ribbon', 'lined' ) ),
);


$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Hide button on mobiles?", 'zn_framework' ),
    "description" => __( "Do you want to hide this button on mobile screens (-767px and below)", 'zn_framework' ),
    "id"          => "cta_hide_xs",
    "std"         => "",
    "value"       => "1",
    "type"        => "toggle2",
    'dependency'  => array ( 'element' => 'head_show_cta_style', 'value' => array ( 'ribbon', 'lined' ) ),
);

$admin_options[]         = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Buttons", 'zn_framework' ),
    "description" => __( "Here you can add up to <strong>3 Buttons</strong>.", 'zn_framework' ),
    "id"          => "cta_custom",
    "std"         => "",
    "type"        => "group",
    "max_items"     => 3,
    "element_title"    => "cta_text",
    "add_text"    => __( "Button", 'zn_framework' ),
    "remove_text" => __( "Button", 'zn_framework' ),
    'dependency'  => array ( 'element' => 'head_show_cta_style', 'value' => array ( 'custom' ) ),
    "subelements" => array (
        array (
            "name"        => __( "Text", 'zn_framework' ),
            "description" => __( "Text inside the button", 'zn_framework' ),
            "id"          => "cta_text",
            "std"         => "",
            "type"        => "text",
        ),

        array (
            "name"        => __( "Link", 'zn_framework' ),
            "description" => __( "Attach a link to the button", 'zn_framework' ),
            "id"          => "cta_link",
            "std"         => "",
            "type"        => "link",
            "options"     => zn_get_link_targets(),
        ),
        array (
            "name"        => __( "Style", 'zn_framework' ),
            "description" => __( "Select a style for the button", 'zn_framework' ),
            "id"          => "cta_style",
            "std"         => "btn-fullcolor",
            "type"        => "select",
            "options"     => zn_get_button_styles(),
        ),
        array (
            "name"        => __( "Size", 'zn_framework' ),
            "description" => __( "Select a size for the button", 'zn_framework' ),
            "id"          => "cta_size",
            "std"         => "",
            "type"        => "select",
            "options"     => array (
                ''          => __( "Default", 'zn_framework' ),
                // 'btn-lg'    => __( "Large", 'zn_framework' ),
                'btn-md'    => __( "Medium", 'zn_framework' ),
                'btn-sm'    => __( "Small", 'zn_framework' ),
                'btn-xs'    => __( "Extra small", 'zn_framework' ),
            ),
        ),

        array (
            "name"        => __( "Button Corners", 'zn_framework' ),
            "description" => __( "Select the button corners type for this button", 'zn_framework' ),
            "id"          => "cta_corners",
            "std"         => "btn--rounded",
            "type"        => "select",
            "options"     => array (
                'btn--rounded'  => __( "Smooth rounded corner", 'zn_framework' ),
                'btn--round'    => __( "Round corners", 'zn_framework' ),
                'btn--square'   => __( "Square corners", 'zn_framework' ),
            ),
        ),

        array (
            "name"        => __( "Add icon?", 'zn_framework' ),
            "description" => __( "Add an icon to the button?", 'zn_framework' ),
            "id"          => "cta_icon_enable",
            "std"         => "0",
            "value"       => "1",
            "type"        => "toggle2",
        ),
        array (
            "name"        => __( "Icon position", 'zn_framework' ),
            "description" => __( "Select the position of the icon", 'zn_framework' ),
            "id"          => "cta_icon_pos",
            "std"         => "before",
            "type"        => "select",
            "options"     => array (
                'before'  => __( "Before text", 'zn_framework' ),
                'after'   => __( "After text", 'zn_framework' ),
            ),
            "dependency"  => array( 'element' => 'cta_icon_enable' , 'value'=> array('1') ),
        ),

        array (
            "name"        => __( "Select icon", 'zn_framework' ),
            "description" => __( "Select an icon to add to the button", 'zn_framework' ),
            "id"          => "cta_icon",
            "std"         => "0",
            "type"        => "icon_list",
            'class'       => 'zn_full',
            "dependency"  => array( 'element' => 'cta_icon_enable' , 'value'=> array('1') ),
        ),

        array (
            "name"        => __( "Hide button on mobiles?", 'zn_framework' ),
            "description" => __( "Do you want to hide this button on mobile screens (-767px and below)", 'zn_framework' ),
            "id"          => "cta_hide_xs",
            "std"         => "0",
            "value"       => "hidden-xs",
            "type"        => "toggle2",
        ),
    ),
    "class"       => ""
);


$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "cto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#TuXcJu9jl7c', __( 'Click here to access video tutorial for this options section.', 'zn_framework' ), array(
    'slug'        => 'cta_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
));