<?php
/**
 * This file is autoloaded by framework/addons/plugins/class-plugins.php
 */

$plugins = array(
	array (
		'name'               => 'Revolution Slider',
		'slug'               => 'revslider',
		'source'             => 'http://kallyas.net/0f5afa285cb7d34ee6fa41b23bd51e61/a22ce5d69768192ed534fcb4335c9d19516.zip',
		'source_type'		 => 'external',
		'required'           => false,
		'version'            => '5.1.6',
		'force_activation'   => false,
		'force_deactivation' => false,
		'external_url'       => '',
		'z_plugin_icon'		 => THEME_BASE_URI . '/template_helpers/plugins/rev_slider.png',
		'z_plugin_author'        => 'themepunch',
		'z_plugin_description'       => 'Slider Revolution is not only for "Sliders". You can now build a beautiful one-page web presence with absolutely no coding knowledge required.',
		'zn_plugin'           => 'revslider/revslider.php',
	),
	/*
	 * Since the plugin is not maintained anymore by its author and we don't provide full support
	 * for its development, then there's no need to have it marked as a MUST HAVE installed plugin.
	*/
	array (
		'name'               => 'Cute Slider',
		'slug'               => 'CuteSlider',
		'source'             => THEME_BASE_URI . '/template_helpers/plugins/cutesliderwp.zip',
		'source_type'		 => 'external',
		'required'           => false,
		'version'            => '1.1.16',
		'force_activation'   => false,
		'force_deactivation' => false,
		'external_url'       => '',
		'z_plugin_icon'      => THEME_BASE_URI . '/template_helpers/plugins/cute_slider.png',
		'z_plugin_author'    => 'Averta and Kreatura Media',
		'z_plugin_description'=> 'Cute Slider is a unique and easy to use slider with awesome 3D and 2D transition effects, captions, 4 ready to use templates, video (youtube and vimeo) support and more impressive features',
		'zn_plugin'           => 'CuteSlider/cuteslider.php',
	),
	/*
	 * Since the plugin is not maintained anymore by its author and we don't provide full support
	 * for its development, then there's no need to have it marked as a MUST HAVE installed plugin.
	*/
	// array (
	// 	'name'               => 'Kallyas Child Theme',
	// 	'slug'               => 'kallyaschild',
	// 	'source'             => THEME_BASE_URI . '/template_helpers/plugins/kallyas-child.zip',
	// 	'source_type'		 => 'external',
	// 	'required'           => false,
	// 	'version'            => '4.0.0',
	// 	'force_activation'   => false,
	// 	'force_deactivation' => false,
	// 	'external_url'       => '',
	// 	'z_plugin_icon'      => THEME_BASE_URI . '/template_helpers/plugins/kallyas-child.png',
	// 	'z_plugin_author'    => 'Hogash Studio',
	// 	'z_plugin_description'=> 'Kallyas Child theme is a "protection" layer for your customisations over the main Kallyas theme so your work won\'t be overwritten when you will update Kallyas theme.',
	// 	'zn_theme'           => 'kallyas-child/style.css',
	// ),
);

