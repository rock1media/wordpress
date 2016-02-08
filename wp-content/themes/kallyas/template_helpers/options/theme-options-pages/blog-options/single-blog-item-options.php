<?php
/**
 * Theme options > Blog Options  > Single blog item options
 */
global $sidebar_option;

if(!isset($sidebar_option) || empty($sidebar_option)){
    $sidebar_option = WpkZn::getThemeSidebars();
}

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Use full width image", 'zn_framework' ),
    "description" => __( "Choose Use full width image option if you want the images to be full widht rather then the default layout", 'zn_framework' ),
    "id"          => "sb_use_full_image",
    "std"         => 'no',
    "type"        => "select",
    "options"     => array (
        'yes' => __( 'Use full width image', 'zn_framework' ),
        'no'  => __( 'Use default layout', 'zn_framework' ),
    )
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Image Maximum Width (px)", 'zn_framework' ),
    "description" => __( "Add a custom maximum width for the image in the blog post. Leave blank for default value.", 'zn_framework' ),
    "id"          => "sb_bp_def_cwidth",
    "std"         => "",
    "type"        => "text",
    "placeholder" => "eg: 400px",
    'dependency'   => array( "element" => 'sb_use_full_image', 'value' => array( 'no' ) ),
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Show author info ?", 'zn_framework' ),
    "description" => __( "Choose if you want to show the author info section on single post item.", 'zn_framework' ),
    "id" => "zn_show_author_info",
    "std" => 'yes',
    "type" => "toggle2",
    "value" => "yes"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Show related posts ?", 'zn_framework' ),
    "description" => __( "Choose if you want to show related posts section.", 'zn_framework' ),
    "id" => "zn_show_related_posts",
    "std" => 'yes',
    "type" => "toggle2",
    "value" => "yes"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Show Social Share Buttons?", 'zn_framework' ),
    "description" => __( "Choose if you want to show the social share buttons bellow the post's content.", 'zn_framework' ),
    "id"          => "show_social",
    "std"         => "show",
    "type"        => "select",
    "options"     => array (
        'show' => __( 'Show social buttons', 'zn_framework' ),
        'hide' => __( 'Do not show social buttons', 'zn_framework' ),
    )
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( 'Other options', 'zn_framework' ),
    "description" => '',
    "id"          => "sbo_title_main",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Display posts on multiple columns?", 'zn_framework' ),
    "description" => __( "Please select if you want .", 'zn_framework' ),
    "id"          => "sbo_multicolumns",
    "std"         => "1",
    "type"        => "select",
    "options"     => array (
        '1' => __( '1 Column (default)', 'zn_framework' ),
        '2' => __( '2 Columns', 'zn_framework' ),
    )
);


$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "sbio_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#Kd0a0kDrg1s', __( 'Click here to access video tutorial for this options section.', 'zn_framework' ), array(
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options'
));
$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/setting-up-blog/', array(
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
));