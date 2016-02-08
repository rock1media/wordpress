<?php
/**
 * Theme options > General Options  > Favicon options
 */

$desc = sprintf(
    '%s ( <a href="%s" target="_blank" title="%s">%s</a>).',
    __( 'These options below are related to site\'s favicon.', 'zn_framework' ),
    esc_url( 'http://hogash.d.pr/H7o5' ),
    __( 'Click to open screenshot', 'zn_framework' ),
    __( 'Open screenshot', 'zn_framework' )
);
$admin_options[] = array (
    'slug'        => 'favicon_options',
    'parent'      => 'general_options',
    "name"        => __( 'FAVICON OPTIONS', 'zn_framework' ),
    "description" => $desc,
    "id"          => "info_title4",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
	'slug'        => 'favicon_options',
    'parent'      => 'general_options',
    "name"        => __( "Favicon Image", 'zn_framework' ),
    "description" => __( "Upload your desired favicon image.", 'zn_framework' ),
    "id"          => "custom_favicon",
    "std"         => '',
    "type"        => "media"
);

$admin_options[] = array (
    'slug'        => 'favicon_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "fvo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#ddDqQHSdeLw', __( 'Click here to access video tutorial for this options section.', 'zn_framework' ), array(
    'slug'        => 'favicon_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'favicon_options',
    'parent'      => 'general_options',
));