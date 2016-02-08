<?php
	$zn_main_color = zget_option( 'zn_main_color', 'color_options', false, '#cd2122' );
?>
/* HEADINGS */
h1,
.page-title{

	<?php
		$h1_typo = zget_option( 'h1_typo', 'font_options', false, array() );
		foreach ($h1_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

h2,
.page-subtitle,
.subtitle {

	<?php
		$h2_typo = zget_option( 'h2_typo', 'font_options', false, array() );
		foreach ($h2_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>

}

h3 {

	<?php
		$h3_typo = zget_option( 'h3_typo', 'font_options', false, array() );
		foreach ($h3_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>

}

h4 {

	<?php
		$h4_typo = zget_option( 'h4_typo', 'font_options', false, array() );
		foreach ($h4_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>

}

h5 {

	<?php
		$h5_typo = zget_option( 'h5_typo', 'font_options', false, array() );
		foreach ($h5_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

h6 {

	<?php
		$h6_typo = zget_option( 'h6_typo', 'font_options', false, array() );
		foreach ($h6_typo as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

/* Body */
body{

	<?php
		// Check if font option has body color included
		$body_tcolor_fonts = '';
		// Add body fonts values
		$body_font = zget_option( 'body_font', 'font_options', false, array() );
		foreach ($body_font as $key => $value) {
			echo $key .':'. $value.';';
			if( $key == 'color' ){
				$body_tcolor_fonts = $value;
			}
		}
	?>
}

/* Footer Area */
.site-footer {

	<?php
		$footer_font = zget_option( 'footer_font', 'font_options', false, array() );
		foreach ($footer_font as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

/* Add Text Color, but check first if the Color option from Body Fonts exists and use that one */
body {
	<?php
		if(empty( $body_tcolor_fonts )){
			if($zn_body_def_textcolor = zget_option( 'zn_body_def_textcolor', 'color_options' )){
				echo 'color:'.$zn_body_def_textcolor.';';
			}
		}
	?>
}
/* Link Color */
a {
	<?php
		if($zn_body_def_linkscolor = zget_option( 'zn_body_def_linkscolor', 'color_options' )){
			echo 'color:'.$zn_body_def_linkscolor.';';
		}
	?>
}
/* Link Hover Color */
a:focus,
a:hover {
	<?php
		if($zn_body_def_linkscolor_hov = zget_option( 'zn_body_def_linkscolor_hov', 'color_options' )){
			echo 'color:'.$zn_body_def_linkscolor_hov.';';
		} elseif( $zn_main_color ) {
			echo 'color:'.$zn_main_color.';';
		}
	?>
}

<?php
// Light text colors
$default_light_color = '#535353';
$zn_body_light_textcolor = zget_option( 'zn_body_def_textcolor', 'color_options', false, $default_light_color );
$zn_body_light_linkscolor = zget_option( 'zn_body_def_linkscolor', 'color_options', false, '#000' );
$zn_body_light_linkscolor_hov = zget_option( 'zn_body_def_linkscolor_hov', 'color_options', false, $zn_main_color );

?>
/* Light text scheme */
.element-scheme--light {color: <?php echo $zn_body_light_textcolor; ?>;}
.element-scheme--light a {color: <?php echo $zn_body_light_linkscolor; ?>;}
.element-scheme--light a:hover,
.element-scheme--light .element-scheme__linkhv:hover {color: <?php echo $zn_body_light_linkscolor_hov; ?>;}
.element-scheme--light .element-scheme__hdg1 { color:<?php echo adjustBrightness( $default_light_color , 40); ?> }
.element-scheme--light .element-scheme__hdg2 { color:<?php echo adjustBrightness( $default_light_color , 10); ?> }
.element-scheme--light .element-scheme__faded { color:<?php echo zn_hex2rgba_str( $default_light_color , 70); ?> }

<?php
// Dark text colors
$default_dark_color = '#dcdcdc';
$zn_body_dark_textcolor = zget_option( 'zn_body_def_textcolor_dark', 'color_options', false, $default_dark_color );
$zn_body_dark_linkscolor = zget_option( 'zn_body_def_linkscolor_dark', 'color_options', false, '#ffffff' );
$zn_body_dark_linkscolor_hov = zget_option( 'zn_body_def_linkscolor_hov_dark', 'color_options', false, $zn_main_color );

?>
/* Dark text scheme */
.element-scheme--dark {color: <?php echo $zn_body_dark_textcolor; ?>;}
.element-scheme--dark a {color: <?php echo $zn_body_dark_linkscolor; ?>;}
.element-scheme--dark a:hover,
.element-scheme--dark .element-scheme__linkhv:hover {color: <?php echo $zn_body_dark_linkscolor_hov; ?>;}
.element-scheme--dark .element-scheme__hdg1 { color:<?php echo adjustBrightness( $default_dark_color , -40); ?> }
.element-scheme--dark .element-scheme__hdg2 { color:<?php echo adjustBrightness( $default_dark_color , -10); ?> }
.element-scheme--dark .element-scheme__faded { color:<?php echo zn_hex2rgba_str( $default_dark_color , 70); ?> }


body #page_wrapper ,
body.boxed #page_wrapper {

	<?php

	// Color
	$zn_body_def_color = zget_option( 'zn_body_def_color', 'color_options' );
	if ( isset($zn_body_def_color) && !empty($zn_body_def_color) ) {
		echo 'background-color:'.$zn_body_def_color.';';
	}

	// Image
	$body_back_image = zget_option( 'body_back_image', 'color_options', false, array() );

	if( !empty( $body_back_image['image'] ) ) { echo 'background-image:url("'.$body_back_image['image'].'");'; }
	if( !empty( $body_back_image['repeat'] ) ) { echo 'background-repeat:'.$body_back_image['repeat'].';'; }
	if( !empty( $body_back_image['position'] ) ) { echo 'background-position:'.$body_back_image['position']['x'].' '.$body_back_image['position']['y'].';'; }
	if( !empty( $body_back_image['attachment'] ) ) { echo 'background-attachment:'.$body_back_image['attachment'].';'; }
	?>
}

/* Force background color for sections after Fixed Position IOS Slider */
.ios-fixed-position-scr ~ .zn_section { background-color:<?php echo $zn_body_def_color;?>}

.kl-bottommask .bmask-bgfill { fill: <?php echo $zn_body_def_color;?>; }

<?php
/* LAYOUT OPTIONS - BOXED */
if(zget_option( 'zn_width' , 'layout_options', false, '1170' ) == '960'){
	echo '@media screen and (min-width: 1200px) { .container {width: 970px; } }';
}

/* RESPONSIVE MENU TRIGGER */
$menu_trigger = zget_option( 'header_res_width', 'general_options', false, 992 );
$menu_trigger2 = $menu_trigger + 1;
echo "
@media (max-width: {$menu_trigger}px) {
	#main-menu { display: none !important;}
}
@media (min-width: {$menu_trigger2}px) {
	.zn-res-menuwrapper { display: none;}
}
";

$zn_header_layout = zget_option( 'zn_header_layout' , 'general_options', false, 'style2' );



/* CUSTOM HEADER WIDTH */
$zn_head_width = (int)zget_option( 'header_width' , 'general_options', false, '1170' );
if( !empty($zn_head_width) && $zn_head_width != '1170px' ){
	$zn_head_width_extra = $zn_head_width+30;
	echo '@media (min-width: '.$zn_head_width_extra.'px) {.site-header .siteheader-container {width:'.$zn_head_width.'px;} }';
	echo '@media (min-width:1200px) and (max-width: '.($zn_head_width_extra-1).'px) {.site-header .siteheader-container {width:100%;} }';
}


/*----------------------  Logo --------------------------*/
if( $logo_image = zget_option( 'logo_upload', 'general_options' ) ) {

	$logo_saved_size_type = zget_option( 'logo_size', 'general_options', false, 'yes' );
		$logo_width = '';
		$logo_height = '';

	if( $logo_saved_size_type == 'yes'){

		$logo_size = getimagesize($logo_image);

		if (isset($logo_size[0]) && isset($logo_size[1])) {
			$logo_width = 'width:auto;';
			$logo_height = 'height:auto;';
		}

	}
	elseif( $logo_saved_size_type == 'no'){

		$logo_saved_sizes = zget_option( 'logo_manual_size', 'general_options', false, 'false' );

		if ( !empty( $logo_saved_sizes['width'] ) ) {
			$logo_width = 'width:'.$logo_saved_sizes['width'].'px;';
		}
		if( !empty( $logo_saved_sizes['height'] ) ) {
			$logo_height = 'height:'.$logo_saved_sizes['height'].'px;';
		}
	}
?>
.site-logo-img {
	max-width:none;
	<?php echo $logo_width; ?>
	<?php echo $logo_height; ?>
}

<?php }
else { ?>
.site-logo,
.site-logo-anch  {
	text-decoration:none;
	<?php
		$logo_font_option = zget_option( 'logo_font', 'general_options', false, array() );
		foreach ($logo_font_option as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}

.site-logo-anch:hover {
	<?php if ( $logo_hover_color = zget_option( 'logo_hover', 'general_options', false, array() ) ) {
		foreach ($logo_hover_color as $key => $value) {
			echo $key .':'. $value.';';
		}
	} ?>
}

<?php } ?>

/*----------------------  Header --------------------------*/

.uh_zn_def_header_style ,
.zn_def_header_style ,
.page-subheader.zn_def_header_style ,
.kl-slideshow.zn_def_header_style ,
.page-subheader.uh_zn_def_header_style ,
.kl-slideshow.uh_zn_def_header_style {
<?php if ( $def_header_color = zget_option( 'def_header_color', 'general_options' ) ) { echo 'background-color:'.$def_header_color.';'; } ?>
}

.page-subheader.zn_def_header_style .bgback ,
.kl-slideshow.zn_def_header_style .bgback ,
.page-subheader.uh_zn_def_header_style .bgback ,
.kl-slideshow.uh_zn_def_header_style .bgback{
<?php if ( $def_header_background = zget_option( 'def_header_background', 'general_options', false, false ) ) { echo 'background-image:url("'.$def_header_background.'");'; } ?>
}

<?php

/* PAGE SUBHEADER */

	// Default Height
	$def_header_height = zget_option( 'def_header_custom_height', 'general_options', false, '300' );
	if( ! empty( $def_header_height ) ){
		echo "
			.page-subheader.zn_def_header_style,
			.page-subheader.uh_zn_def_header_style {
				min-height: {$def_header_height}px;
				height: {$def_header_height}px;
			}
		";
	}

	// Default top padding
	$def_header_top_padding = zget_option( 'def_header_top_padding', 'general_options', false, '170' );
	if( ! empty( $def_header_top_padding ) ){
		echo "
			.page-subheader.zn_def_header_style .ph-content-wrap,
			.page-subheader.uh_zn_def_header_style .ph-content-wrap { padding-top: {$def_header_top_padding}px; }
		";
	}

	echo '
		.page-subheader.zn_def_header_style ,
		.kl-slideshow.zn_def_header_style,
		.page-subheader.uh_zn_def_header_style ,
		.kl-slideshow.uh_zn_def_header_style {';
		// GRADIENT OVER COLOR
		if ( zget_option( 'def_grad_bg', 'general_options', false, 1 ) ) {
			echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,transparent), color-stop(100%,rgba(0,0,0,0.5)));';
			echo 'background-image: -webkit-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
			echo 'background-image: linear-gradient(to bottom, transparent 0%,rgba(0,0,0,0.5) 100%);';
		}
	echo '}';

	// GLARE EFFECT
	if ( zget_option( 'def_glare', 'general_options', false, 0 ) ) {
			echo '
			.page-subheader.zn_def_header_style .bgback:after,
			.kl-slideshow.zn_def_header_style .bgback:after,
			.page-subheader.uh_zn_def_header_style .bgback:after,
			.kl-slideshow.uh_zn_def_header_style .bgback:after {';
			echo 'content:""; position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1;background-image: url('.get_template_directory_uri().'/images/glare-effect.png); background-repeat: no-repeat; background-position: center top;';
		echo '}';
	}

	// Animation
	if ( zget_option( 'def_header_animate', 'general_options', false, 0 ) ) {
		echo '
		.zn_def_header_style .th-sparkles,
		.kl-slideshow.zn_def_header_style .th-sparkles,
		.uh_zn_def_header_style .th-sparkles,
		.kl-slideshow.uh_zn_def_header_style .th-sparkles {display:block}';
	}

	// Default SHADOW
	$def_bottom_style = zget_option( 'def_bottom_style', 'general_options', false, false );
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	// $zn_main_style = zget_option( 'zn_main_style', 'color_options', false, 'light' );
	$zn_main_style = 'light';

	if ( $def_bottom_style == 'shadow' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:after,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:after {';
			echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
		echo '}';

		echo '.page-subheader.zn_def_header_style, .kl-slideshow.zn_def_header_style,';
		echo '.page-subheader.uh_zn_def_header_style, .kl-slideshow.uh_zn_def_header_style {';
			echo 'border-bottom:6px solid #FFFFFF';
		echo '}';

	}


	// SHADOW UP AND DOWN
	if ( $def_bottom_style == 'shadow_ud' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:after,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:after , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:after {';
			echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
		echo '}';

		echo '.page-subheader.zn_def_header_style, .kl-slideshow.zn_def_header_style,';
		echo '.page-subheader.uh_zn_def_header_style, .kl-slideshow.uh_zn_def_header_style {';
			echo 'border-bottom:6px solid #FFFFFF';
		echo '}';

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style:before , .kl-slideshow.zn_def_header_style .zn_header_bottom_style:before,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style:before , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style:before {';
			echo 'content:\'\'; position:absolute; bottom:-26px; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-down.png) no-repeat center top; opacity:.6; filter:alpha(opacity=60);';
		echo '}';

	}

	// MASK 1
	if ( $def_bottom_style == 'mask1' && $zn_main_style == 'light' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask.png) no-repeat center top;';
		echo '}';

	}
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	 elseif ( $def_bottom_style == 'mask1' && $zn_main_style == 'dark' )  {
	 	echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style {';
	 		echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask_dark.png) no-repeat center top;';
	 	echo '}';
	 }

	// MASK 2
	if ( $def_bottom_style == 'mask2' && $zn_main_style == 'light' ) {

		echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style,';
		echo '.page-subheader.uh_zn_def_header_style .zn_header_bottom_style , .kl-slideshow.uh_zn_def_header_style .zn_header_bottom_style {';
			echo 'position:absolute; bottom:0; left:0; width:100%; z-index:99; ';
			echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2.png) no-repeat center top;';
		echo '}';

	}
	/*
		Commented as per https://github.com/hogash/kallyas/issues/386
	*/
	 elseif ( $def_bottom_style == 'mask2' && $zn_main_style == 'dark' ) {
	 	echo '.page-subheader.zn_def_header_style .zn_header_bottom_style , .kl-slideshow.zn_def_header_style .zn_header_bottom_style {';
	 		echo 'position:absolute; bottom:0; left:0; width:100%;  z-index:99; ';
	 		echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2_dark.png) no-repeat center top;';
	 	echo '}';
	 }
?>



/*----------------------  Unlimited Headers --------------------------*/

<?php
	$saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );
	foreach ( $saved_headers as $header ) {

		if ( isset ( $header['uh_style_name'] ) && !empty ( $header['uh_style_name'] ) ) {
			$header_name = strtolower ( str_replace(' ','_',$header['uh_style_name'] ) );

			// Background type
			$bg_type = isset($header['uh_bg_type']) && !empty($header['uh_bg_type']) ? $header['uh_bg_type'] : 'simple_bg';

			// Page header + BGBACK
			echo '.page-subheader.uh_'.$header_name.' .bgback , .kl-slideshow.uh_'.$header_name.' .bgback {';

			if($bg_type == 'simple_bg'){

				if ( isset ( $header['uh_background_image'] ) && !empty ( $header['uh_background_image'] ) ) {
					echo 'background-image:url("'.$header['uh_background_image'].'");';
				}

			} else if($bg_type == 'advanced_bg'){
				$advanced_bg = $header['uh_background_image_advanced'];

				if ( isset ( $advanced_bg ) && !empty ( $advanced_bg ) ) {

	                $background_image = $advanced_bg['image'];

	                $background_styles = array();
	                $background_styles[] = 'background-image:url('.$background_image.')';
	                $background_styles[] = 'background-repeat:'.$advanced_bg['repeat'];
	                $background_styles[] = 'background-attachment:'.$advanced_bg['attachment'];
	                $background_styles[] = 'background-position:'.$advanced_bg['position']['x'].' '.$advanced_bg['position']['y'];
	                $background_styles[] = 'background-size:'.$advanced_bg['size'];

	                if ( !empty($background_image) ) {
	                    echo implode(';', $background_styles);
	                }

				}
			}

			echo '}';

			// Animate - Page header + SPARKLES
			if ( !empty ( $header['uh_anim_bg'] ) ) {
				echo '.uh_'.$header_name.' .th-sparkles , .kl-slideshow.uh_'.$header_name.' .th-sparkles {display:block}';
			}
			else {
				echo '.uh_'.$header_name.' .th-sparkles , .kl-slideshow.uh_'.$header_name.' .th-sparkles{display:none}';
			}

			// COLOR - Page header
			echo '.page-subheader.uh_'.$header_name.' , .kl-slideshow.uh_'.$header_name.' {';

			if ( isset ( $header['uh_header_color'] ) && !empty ( $header['uh_header_color'] ) ) {
				echo 'background-color:'.$header['uh_header_color'].';';
			}

			// GRADIENT OVER COLOR
			if ( isset ( $header['uh_grad_bg'] ) && !empty ( $header['uh_grad_bg'] ) ) {
				echo 'background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,transparent), color-stop(100%,rgba(0,0,0,0.5)));';
				echo 'background-image: -webkit-linear-gradient(top, transparent 0%,rgba(0,0,0,0.5) 100%);';
				echo 'background-image: linear-gradient(to bottom, transparent 0%,rgba(0,0,0,0.5) 100%);';
			}

			echo '}';

			// GLARE EFFECT
			if ( isset ( $header['uh_glare'] ) && !empty ( $header['uh_glare'] ) ) {

				echo '.page-subheader.uh_'.$header_name.' .bgback:after , .kl-slideshow.uh_'.$header_name.' .bgback:after {';
					echo 'content:""; position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1;background-image: url('.get_template_directory_uri().'/images/glare-effect.png); background-repeat: no-repeat; background-position: center top;';
				echo '}';

			}

			// Intentionally skipped "kl-slideshow" class
			echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
				// Custom Height
				if ( isset ( $header['uh_header_height'] ) && !empty ( $header['uh_header_height'] ) ) {
					$header_height = $header['uh_header_height'];
						echo 'height:'.$header_height.'px; min-height:'.$header_height.'px;';
				}
			echo '}';
			echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
				// Custom Top Padding
				if ( isset ( $header['uh_top_padding'] ) && !empty ( $header['uh_top_padding'] ) ) {
					$subheader_top_padding = $header['uh_top_padding'];
						echo 'padding-top:'.$subheader_top_padding.'px;';
				}
				// Custom Bottom Padding
				if ( isset ( $header['uh_bottom_padding'] ) && !empty ( $header['uh_bottom_padding'] ) ) {
					$subheader_bottom_padding = $header['uh_bottom_padding'];
						echo 'padding-bottom:'.$subheader_bottom_padding.'px;';
				}
			echo '}';

			// Subheader height & padding for MEDIUM
			echo '@media screen and (min-width:992px) and (max-width:1199px) {';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
					// Custom Height
					if ( isset ( $header['uh_header_height_md'] ) && !empty ( $header['uh_header_height_md'] ) ) {
						$header_height_md = $header['uh_header_height_md'];
						if($header_height_md != 300){
							echo 'height:'.$header_height_md.'px; min-height:'.$header_height_md.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
					// Custom Top Padding
					if ( isset ( $header['uh_top_padding_md'] ) && !empty ( $header['uh_top_padding_md'] ) ) {
						$subheader_top_padding_md = $header['uh_top_padding_md'];
						if($subheader_top_padding_md != 170){
							echo 'padding-top:'.$subheader_top_padding_md.'px;';
						}
					}
					// Custom Bottom Padding
					if ( isset ( $header['uh_bottom_padding_md'] ) && !empty ( $header['uh_bottom_padding_md'] ) ) {
						$subheader_bottom_padding_md = $header['uh_bottom_padding_md'];
						if($subheader_bottom_padding_md != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_md.'px;';
						}
					}
				echo '}';
			echo '}';

			// Subheader height & padding for SMALL
			echo '@media screen and (min-width:768px) and (max-width:991px) {';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
					// Custom Height
					if ( isset ( $header['uh_header_height_sm'] ) && !empty ( $header['uh_header_height_sm'] ) ) {
						$header_height_sm = $header['uh_header_height_sm'];
						if($header_height_sm != 300){
							echo 'height:'.$header_height_sm.'px; min-height:'.$header_height_sm.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
					// Custom Top Padding
					if ( isset ( $header['uh_top_padding_sm'] ) && !empty ( $header['uh_top_padding_sm'] ) ) {
						$subheader_top_padding_sm = $header['uh_top_padding_sm'];
						if($subheader_top_padding_sm != 170){
							echo 'padding-top:'.$subheader_top_padding_sm.'px;';
						}
					}
					// Custom Bottom Padding
					if ( isset ( $header['uh_bottom_padding_sm'] ) && !empty ( $header['uh_bottom_padding_sm'] ) ) {
						$subheader_bottom_padding_sm = $header['uh_bottom_padding_sm'];
						if($subheader_bottom_padding_sm != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_sm.'px;';
						}
					}
				echo '}';
			echo '}';

			// Subheader height & padding for EXTRA SMALL
			echo '@media screen and (max-width:767px) {';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp{';
					// Custom Height
					if ( isset ( $header['uh_header_height_xs'] ) && !empty ( $header['uh_header_height_xs'] ) ) {
						$header_height_xs = $header['uh_header_height_xs'];
						if($header_height_xs != 300){
							echo 'height:'.$header_height_xs.'px; min-height:'.$header_height_xs.'px;';
						}
					}
				echo '}';
				echo '.page-subheader.uh_'.$header_name.'.page-subheader--inherit-hp .ph-content-wrap {';
					// Custom Top Padding
					if ( isset ( $header['uh_top_padding_xs'] ) && !empty ( $header['uh_top_padding_xs'] ) ) {
						$subheader_top_padding_xs = $header['uh_top_padding_xs'];
						if($subheader_top_padding_xs != 170){
							echo 'padding-top:'.$subheader_top_padding_xs.'px;';
						}
					}
					// Custom Bottom Padding
					if ( isset ( $header['uh_bottom_padding_xs'] ) && !empty ( $header['uh_bottom_padding_xs'] ) ) {
						$subheader_bottom_padding_xs = $header['uh_bottom_padding_xs'];
						if($subheader_bottom_padding_xs != 0){
							echo 'padding-bottom:'.$subheader_bottom_padding_xs.'px;';
						}
					}
				echo '}';
			echo '}';



			// Default SHADOW
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'shadow' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:after , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:after {';
					echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.', .kl-slideshow.uh_'.$header_name.' {';
					echo 'border-bottom:6px solid #FFFFFF';
				echo '}';

			}


			// SHADOW UP AND DOWN
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'shadow_ud' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-up.png) no-repeat center bottom; z-index: 2;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:after , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:after {';
					echo 'content:\'\'; position:absolute; bottom:-18px; left:50%; border:6px solid transparent; border-top-color:#fff; margin-left:-6px;';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.', .kl-slideshow.uh_'.$header_name.' {';
					echo 'border-bottom:6px solid #FFFFFF';
				echo '}';

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style:before , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style:before {';
					echo 'content:\'\'; position:absolute; bottom:-26px; left:0; width:100%; height:20px; background:url('.get_template_directory_uri().'/images/shadow-down.png) no-repeat center top; opacity:.6; filter:alpha(opacity=60);';
				echo '}';

			}

			// MASK 1
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask1' && $zn_main_style == 'light' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask.png) no-repeat center top;';
				echo '}';

			}
			/*
				Commented as per https://github.com/hogash/kallyas/issues/386
			*/
			 elseif ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask1' && $zn_main_style == 'dark' )  {
			 	echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
			 		echo 'position:absolute; bottom:0; left:0; width:100%; height:27px; z-index:99; background:url('.get_template_directory_uri().'/images/bottom_mask_dark.png) no-repeat center top;';
			 	echo '}';
			 }

			// MASK 2
			if ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask2' && $zn_main_style == 'light' ) {

				echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
					echo 'position:absolute; bottom:0; left:0; width:100%; z-index:99; ';
					echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2.png) no-repeat center top;';
				echo '}';

			}
			/*
				Commented as per https://github.com/hogash/kallyas/issues/386
			*/
			 elseif ( isset ( $header['uh_bottom_style'] ) && $header['uh_bottom_style'] == 'mask2' && $zn_main_style == 'dark' ) {
			 	echo '.page-subheader.uh_'.$header_name.' .zn_header_bottom_style , .kl-slideshow.uh_'.$header_name.' .zn_header_bottom_style {';
			 		echo 'position:absolute; bottom:0; left:0; width:100%;  z-index:99; ';
			 		echo 'height:33px; background:url('.get_template_directory_uri().'/images/bottom_mask2_dark.png) no-repeat center top;';
			 	echo '}';
			 }

		}

	}

?>
/* GENERAL COLOR */

/* Text - Main Color */
.text-custom,
.text-custom-hover:hover,
.text-custom-after:after,
.text-custom-before:before,
.text-custom-parent .text-custom-child,
.text-custom-parent .text-custom-child-hov:hover,
.text-custom-parent-hov:hover .text-custom-child,
.text-custom-parent-act.active .text-custom-active,
.text-custom-a>a,
.btn-lined.lined-custom,
.latest_posts--4.default-style .latest_posts-link:hover .latest_posts-readon,
.grid-ibx__item:hover .grid-ibx__icon
{color:<?php echo $zn_main_color; ?>;}

/* Darker text color */
.btn-lined.lined-custom:hover
{ color: <?php echo adjustBrightness($zn_main_color, 20); ?>;}

/**** Background Color - Main Color ****/
.kl-main-bgcolor,
.kl-main-bgcolor-after:after,
.kl-main-bgcolor-before:before,
.kl-main-bgcolor-hover:hover,
.kl-main-bgcolor-parenthover:hover .kl-main-bgcolor-child
{background-color:<?php echo $zn_main_color;?>;}

/* BgColor Site components */
.main-nav > ul > li > a:before,
.main-nav .zn_mega_container li a:not(.zn_mega_title):before,
.social-icons.sc--normal .social-icons-item:hover,
.kl-cart-button .glyphicon:after,
.site-header.style7 .kl-cart-button .glyphicon:after,
.site-header.style8 .kl-main-header .kl-cta-lined,
.site-header.style9 .kl-cta-lined,
.kl-cta-ribbon,
.cart-container .buttons .button.wc-forward,
.chaser-main-menu li.active > a
{background-color:<?php echo $zn_main_color;?>;}

/* BgColor PB elements */
.action_box,
.action_box.style3:before,
.action_box.style3 .action_box-inner,
.action_box.style3 .action_box-inner:before,
.btn-fullcolor,
.btn-fullcolor:focus,
.btn-fullcolor.btn-skewed:before,
.circle-text-box.style3 .wpk-circle-span,
.circle-text-box.style2 .wpk-circle-span::before,
.circle-text-box:not(.style3) .wpk-circle-span:after,
.elm-social-icons.sc--normal .elm-sc-icon:hover,
.elm-searchbox--normal .elm-searchbox__submit,
.elm-searchbox--transparent .elm-searchbox__submit,
.hover-box:hover,
.how_to_shop .number,
.image-boxes.image-boxes--4 .image-boxes-title:after,
.kl-flex--classic .zn_simple_carousel-arr:hover,
.kl-flex--modern .flex-underbar,
.kl-blog-item-overlay-more:hover,
.kl-blog-related-post-link:after,
.kl-ioscaption--style1 .more:before,
.kl-ioscaption--style1 .more:after,
.kl-ioscaption--style2 .more,
.kl-ioscaption--style3.s3ext .main_title::before,
.kl-ios-selectors-block.bullets2 .item.selected::before,
.kl-ioscaption--style5 .klios-separator-line span,
.kl-ptfcarousel-carousel-arr:hover,
.kl-ptfsortable-nav-link:hover,
.kl-ptfsortable-nav-item.current .kl-ptfsortable-nav-link,
.latest_posts3-post-date,
.latest_posts--style4.kl-style-2 .latest_posts-elm-titlew,
.latest_posts--style4.kl-style-2 .latest_posts-title:after,
.latest_posts--style4.default-style .latest_posts-readon,
.ls__nav-item.selected,
.lt-offers-item:after,
.media-container__link--style-borderanim1 > i,
.nivo-directionNav a:hover,
.pricing-table-element .plan-column.featured .subscription-price .inner-cell,
.process_steps--style1 .process_steps__intro,
.process_steps--style2 .process_steps__intro,
.process_steps--style2 .process_steps__intro:before,
.recentwork_carousel--1 .recentwork_carousel__bg,
.recentwork_carousel--2 .recentwork_carousel__title:after,
.recentwork_carousel--2 .recentwork_carousel__cat,
.recentwork_carousel_v2 .recentwork_carousel__plus,
.recentwork_carousel_v3 .btn::before,
.recentwork_carousel_v3 .recentwork_carousel__cat,
.timeline_box:hover:before,
.title_circle,
.title_circle:before,
.services_box--classic:hover .services_box__icon,
.spp-el-item.active .spp-el-nav-link:before,
.stepbox2-box--ok:before,
.stepbox2-box--ok:after,
.stepbox2-box--ok,
.stepbox3-content:before,
.stepbox4-number:before,
.tbk--color-theme.tbk-symbol--line .tbk__symbol span,
.tbk--color-theme.tbk-symbol--line_border .tbk__symbol span,
.th-wowslider a.ws_next:hover,
.th-wowslider a.ws_prev:hover,
.zn-acc--style4 .acc-title,
.zn-acc--style4 .acc-tgg-button .acc-icon:before,
.zn-acc--style3 .acc-tgg-button:before,
.zn_badge_sale,
.zn_badge_sale:after,
/* Deprecated */
.shop-features .shop-feature:hover,
.feature_box.style3 .box:hover,
.services_box_element:hover .box .icon
{background-color:<?php echo $zn_main_color;?>;}

/* Alpha BG */
.kl-ioscaption--style4 .more:before { background: <?php echo zn_hex2rgba_str($zn_main_color, 70); ?> }
.kl-ioscaption--style4 .more:hover:before { background: <?php echo zn_hex2rgba_str($zn_main_color, 90); ?> }

/* plugins */
.woocommerce a.button,
.woocommerce button.button,
.woocommerce button.button.alt,
.woocommerce input.button,
.woocommerce input#button,
.woocommerce #review_form #submit,
.product-list-item .kw-actions a,
.woocommerce ul.products li.product .product-list-item .kw-actions a,
#bbpress-forums div.bbp-search-form input[type=submit],
#bbpress-forums .bbp-submit-wrapper button,
#bbpress-forums #bbp-your-profile fieldset.submit button
{background-color:<?php echo $zn_main_color;?>;}

/* Hover Background color - Main Color */
.btn-fullcolor:hover,
.btn-fullcolor.btn-skewed:hover:before,
.cart-container .buttons .button.wc-forward:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button:hover,
.woocommerce input#button:hover,
.woocommerce #review_form #submit:hover
{ background-color: <?php echo adjustBrightness($zn_main_color, 20); ?> }

/**** END Background Color - Main Color ****/

/* Border - Main Color */
.border-custom,
.border-custom-after:after,
.border-custom-before:before,
.kl-blog-item-overlay-more:hover,
.acc--style4,
.acc--style4 .acc-tgg-button .acc-icon,
.kl-ioscaption--style4 .more:before,
.btn-lined.lined-custom,
.btn-bordered
{ border-color: <?php echo $zn_main_color;?>;  }

/* Alpha Border color */
.fake-loading:after
{ border-color: <?php echo zn_hex2rgba_str($zn_main_color, 15); ?>;}

/* Border Top - Main Color */
.action_box:before,
.action_box:after,
.site-header.style1,
.site-header.style2 .site-logo-anch,
.site-header.style3 .site-logo-anch,
.site-header.style6,
.tabs_style1 > ul.nav > li.active > a,
.offline-page-container:after,
.latest_posts3-post-date:after,
.fake-loading:after
{ border-top-color:<?php echo $zn_main_color;?>; }

/* Border Right - Main Color */
.stepbox3-box[data-align=right] .stepbox3-content:after,
.vr-tabs-kl-style-1 .vr-tabs-nav-item.active .vr-tabs-nav-link,
.kl-ioscaption--style2.klios-alignright .title_big,
.kl-ioscaption--style2.klios-alignright .title_small,
.fake-loading:after
{ border-right-color:<?php echo $zn_main_color;?>; }

/* Border Bottom - Main Color */
.image-boxes.image-boxes--4.kl-title_style_bottom .imgboxes-border-helper,
.image-boxes.image-boxes--4.kl-title_style_bottom:hover .imgboxes-border-helper,
.kl-blog-full-image-link,
.kl-blog-post-image-link,
.site-header.style8 .kl-main-header,
.site-header.style9,
.spp-el-item.active .spp-el-nav-link:after,
.statistic-box__line,
.zn-sidebar-widget-title:after,
.tabs_style5 > ul.nav > li.active > a,
.offline-page-container,
.keywordbox.keywordbox-2,
.keywordbox.keywordbox-3
{border-bottom-color:<?php echo $zn_main_color;?>}

/* Border left - Main Color */
.breadcrumbs li:after,
.infobox2-inner,
.kl-flex--classic .flex-caption,
.ls--laptop .ls__item-caption,
.nivo-caption,
.process_steps--style1 .process_steps__intro:after,
.stepbox3-box[data-align=left] .stepbox3-content:after,
.th-wowslider .ws-title,
.kl-ioscaption--style2 .title_big,
.kl-ioscaption--style2 .title_small
{border-left-color:<?php echo $zn_main_color;?>; }


/* Various properties - Main Color */

.kl-cta-ribbon .trisvg path,
.kl-bottommask .bmask-customfill,
.kl-slideshow .kl-loader svg path,
.kl-slideshow  .kl-loadersvg rect,
.kl-diagram circle { fill: <?php echo $zn_main_color;?>; }

.borderanim2-svg__shape {stroke: <?php echo $zn_main_color;?>;}

.hoverBorder:hover:after {box-shadow:0 0 0 5px <?php echo $zn_main_color;?> inset;}

/* Services boxes (modern style) */
.services_box--modern .services_box__icon { box-shadow:inset 0 0 0 2px <?php echo $zn_main_color;?>; }
.services_box--modern:hover .services_box__icon {box-shadow:inset 0 0 0 40px <?php echo $zn_main_color;?>;}
.services_box--modern .services_box__list li:before {box-shadow: 0 0 0 2px <?php echo $zn_main_color;?>;}
.services_box--modern .services_box__list li:hover:before {box-shadow: 0 0 0 3px <?php echo $zn_main_color;?>;}

.portfolio-item-overlay-imgintro:hover .portfolio-item-overlay {box-shadow: inset 0 -8px 0 0 <?php echo $zn_main_color;?>;}


/* Contrast Color */
<?php $zn_main_color_contrast = zget_option( 'zn_main_color_contrast', 'color_options', false, '#fff' ); ?>
.main-nav > ul > li.active > a,
.main-nav > ul > li > a:hover,
.main-nav > ul > li:hover > a,
.btn-fullcolor, .btn-fullcolor:focus,
.chaser-main-menu li.active > a,
.kl-cart-button .glyphicon:after,
.logo-infocard, .logo-infocard a,
.logo-infocard .social-icons-item,
.logo-infocard .glyphicon,
.kl-ptfsortable-nav-link:hover,
.kl-ptfsortable-nav-item.current .kl-ptfsortable-nav-link,
.circlehover,
.circle-text-box .wpk-circle-span,
.imgboxes_style1 .hoverBorder h6,
.btn-flat ,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce button.button.alt,
.woocommerce input.button,
.woocommerce input#button,
.woocommerce #review_form #submit,
.product-list-item .kw-actions a,
.woocommerce ul.products li.product .product-list-item .kw-actions a
{color:<?php echo $zn_main_color_contrast;?> !important;}

/* Contrast color without important flag */
.latest-posts-crs-readon,
.latest_posts--4.default-style .latest_posts-readon
{color:<?php echo $zn_main_color_contrast;?>;}


/* Plugin based */
#bbpress-forums .bbp-topics li.bbp-body .bbp-topic-title > a,
.product-list-item:hover .kw-details-title,
.woocommerce ul.products li.product .product-list-item:hover .kw-details-title,
.woocommerce ul.product_list_widget li .star-rating,
.woocommerce .woocommerce-product-rating .star-rating,
.widget.buddypress div.item-options a.selected ,
#buddypress div.item-list-tabs ul li.selected a,
#buddypress div.item-list-tabs ul li.current a ,
#buddypress div.activity-meta a ,
#buddypress div.activity-meta a:hover,
#buddypress .acomment-options a
{color:<?php echo $zn_main_color; ?>;}

#buddypress form#whats-new-form p.activity-greeting:after {border-top-color: <?php echo $zn_main_color;?>;}
#buddypress input[type=submit],
#buddypress input[type=button],
#buddypress input[type=reset],
#buddypress .activity-list li.load-more a {background: <?php echo $zn_main_color;?>;}
#buddypress div.item-list-tabs ul li.selected a,
#buddypress div.item-list-tabs ul li.current a {border-top: 2px solid <?php echo $zn_main_color;?>;}
#buddypress form#whats-new-form p.activity-greeting,
.widget.buddypress ul.item-list li:hover {background-color: <?php echo $zn_main_color;?>;}

/***** End Main Color */

/* Call to action header */
<?php $cta_bg = zget_option( 'wpk_cs_bg_color', 'general_options', false, $zn_main_color ); ?>
.kl-cta-ribbon { background-color: <?php echo $cta_bg; ?> }
.kl-cta-ribbon .trisvg path { fill: <?php echo $cta_bg; ?> }
.ctabutton { color: <?php echo zget_option( 'wpk_cs_fg_color', 'general_options', false, '#fff' ); ?> }

/* Infocard */
.logo-container .logo-infocard {background: <?php echo zget_option( 'infocard_bg_color', 'general_options', false, $zn_main_color ); ?>}

/* Hidden panel */
.support-panel {background: <?php echo zget_option( 'hidden_panel_bg', 'general_options', false, '#fff' ); ?>; }
.support-panel,
.support-panel * {color:<?php echo zget_option( 'hidden_panel_fg', 'general_options', false, '#000000' ); ?>;}

/* Custom blog post image width */
<?php
if( $zn_bpost_img = zget_option( 'sb_bp_def_cwidth', 'blog_options', false, '' ) ){
	echo '.zn-bg-post--default-view {max-width:'.(int)$zn_bpost_img.'px;}';
}
?>

/* Custom background color for header */
<?php
    if( zget_option( 'header_style', 'general_options', false, 'default' ) == 'image_color'):

    	$header_style_color = zget_option( 'header_style_color', 'general_options', false, '#000' );

        $header_style_bg_image = 'background-image:none;';
        $header_style_image = zget_option( 'header_style_image', 'general_options', false, array() );
        if( !empty( $header_style_image['image'] ) ){
            $header_style_bg_image .= 'background-image:url("'.$header_style_image['image'].'");';
        }
        if(isset( $header_style_image['repeat']) && !empty( $header_style_image['repeat'])){
            $header_style_bg_image .= 'background-repeat:'.$header_style_image['repeat'].';';
        }
        if(isset( $header_style_image['position']) && !empty( $header_style_image['position'])){
            $header_style_bg_image .= 'background-position:'.$header_style_image['position']['x'].' '. $header_style_image['position']['y'].';';
        }
        if(isset( $header_style_image['attachment']) && !empty( $header_style_image['attachment'])){
            $header_style_bg_image .= 'background-attachment:'. $header_style_image['attachment'].';';
        }
    ?>
.site-header {background-color:<?php echo $header_style_color; ?>; <?php echo $header_style_bg_image; ?> }
.site-header.style8 .kl-top-header {background:<?php echo zn_hex2rgba_str($header_style_color, 70); ?>;}
.site-header.style8 .kl-main-header {background:<?php echo zn_hex2rgba_str($header_style_color, 60); ?>;}
<?php
    endif;
?>

<?php

/* Social Header */
if ( zget_option( 'social_icons_visibility_status', 'general_options', false, 'yes' ) == 'yes' ) {
	$header_which_icons_set = zget_option( 'header_which_icons_set', 'general_options', false, 'normal' );
	if($header_which_icons_set != 'normal' && $header_which_icons_set != 'clean'){
		if ( $header_social_icons = zget_option( 'header_social_icons', 'general_options', false, array() ) ) {
			foreach ( $header_social_icons as $key => $icon ):
				$hhover = $header_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['header_social_color']) && !empty($icon['header_social_color'])){
					echo '.scheader-icon-'.$icon['header_social_icon']['unicode'].$hhover.' { background-color: '.$icon['header_social_color'].'; }';
				}
			endforeach;
		}
	}
}

/* Social Footer */
if ( zget_option( 'footer_social_icons_enable', 'general_options', false, 'yes' ) == 'yes' ) {
	$footer_which_icons_set = zget_option( 'footer_which_icons_set', 'general_options', false, 'normal' );
	if($footer_which_icons_set != 'normal' && $footer_which_icons_set != 'clean'){
		if ( $footer_social_icons = zget_option( 'footer_social_icons', 'general_options', false, array() ) ) {
			foreach ( $footer_social_icons as $key => $icon ):
				$fhover = $footer_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['footer_social_color']) && !empty($icon['footer_social_color'])){
					echo '.scfooter-icon-'.$icon['footer_social_icon']['unicode'].$fhover.' { background-color: '.$icon['footer_social_color'].'; }';
				}
			endforeach;
		}
	}
}

/* Social icons in Coming Soon page */
if ( zget_option( 'cs_social_icons_enable', 'coming_soon_options', false, 'yes' ) == 'yes' && zget_option( 'cs_enable', 'coming_soon_options', false, 'no' ) == 'yes' ) {
	$cs_which_icons_set = zget_option( 'cs_which_icons_set', 'coming_soon_options', false, 'normal' );
	if($cs_which_icons_set != 'normal' && $cs_which_icons_set != 'clean'){
		if ( $cs_social_icons = zget_option( 'cs_social_icons', 'coming_soon_options', false, array() ) ) {
			foreach ( $cs_social_icons as $key => $icon ):
				$chover = $cs_which_icons_set == 'colored_hov' ? ':hover':'';
				if(isset($icon['cs_social_color']) && !empty($icon['cs_social_color'])){
					echo '.sccsoon-icon-'.$icon['cs_social_icon']['unicode'].$chover.' { background-color: '.$icon['cs_social_color'].'; }';
				}
			endforeach;
		}
	}
}

?>

.site-footer {
	<?php
	$footer_top_padding = zget_option( 'footer_top_padding', 'general_options', false, '60' );
	if ( $footer_top_padding != '' && $footer_top_padding != 60 ) {
			echo 'padding-top:'. $footer_top_padding .'px;';
	}

	if ( $footer_border_color_top = zget_option( 'footer_border_color_top', 'general_options', false, '#FFFFFF' ) ) {
	echo 'border-top-color:'. $footer_border_color_top .';'; }

	// Footer Styles
	$footer_style = zget_option( 'footer_style', 'general_options', false, 'default' );

	if( $footer_style == 'image_color' ){

		// Color
		$footer_style_color = zget_option( 'footer_style_color', 'general_options', false, '#000' );
		if ( !empty( $footer_style_color ) ){
			echo 'background-color:'.$footer_style_color.';';
		}

		// Image
		$footer_style_image = zget_option( 'footer_style_image', 'general_options', false, array() );

		if( !empty( $footer_style_image['image'] ) ) { echo 'background-image:url("'.$footer_style_image['image'].'");'; }
		if( !empty( $footer_style_image['repeat'] ) ) { echo 'background-repeat:'.$footer_style_image['repeat'].';'; }
		if( !empty( $footer_style_image['position'] ) ) { echo 'background-position:'.$footer_style_image['position']['x'].' '.$footer_style_image['position']['y'].';'; }
		if( !empty( $footer_style_image['attachment'] ) ) { echo 'background-attachment:'.$footer_style_image['attachment'].';'; }

	} ?>
}
.site-footer-bottom { <?php if ( $footer_border_color = zget_option( 'footer_border_color', 'general_options', false, '#484848' ) ) {
	echo 'border-top-color:'. $footer_border_color .';'; } ?>
}

/* Main menu font */
.main-nav ul li a {
	<?php
		$menu_font = zget_option( 'menu_font', 'font_options', false, array() );
		foreach ($menu_font as $key => $value) {
			echo $key .':'. $value.';';
		}
	?>
}
/* Alternative font - Several elements using other font */
.ff-alternative,
.kl-font-alt,
.kl-fontafter-alt:after,
/* Page Title and Subtitle */
<?php
	$h1_pgtitle = zget_option( 'h1_pgtitle', 'font_options', false, '' );
	if( $h1_pgtitle != '1' ) echo '.page-title, .page-subtitle, .subtitle,';
?>
.topnav-item,
.topnav .menu-item > a,
.zn-sidebar-widget-title,
/* JS Generated */
.nivo-caption,
.th-wowslider .ws-title,
/* WooCommerce un-classed content */
.cart-container .cart_list li a:not(.remove) {
<?php
	$alternative_font = zget_option( 'alternative_font', 'font_options', false, $menu_font );
	if ( !empty ( $alternative_font['font-family'] ) ) {
		echo 'font-family:"' .$alternative_font['font-family'].'" , "Helvetica Neue", Helvetica, Arial, sans-serif;';
	}
 ?>
}

/* Add Custom fonts classes */
<?php
if ( $google_fonts = zget_option('zn_google_fonts_setup', 'google_font_options') ){
	foreach ( $google_fonts as $key => $font ) {
		if(isset($font['font_family']) && !empty($font['font_family'])){
			echo '.ff-'.strtolower(str_replace(' ', '_', $font['font_family'])).'{font-family:"'.$font['font_family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;}';
		}

	}
}
?>

<?php
if ( zget_option( 'zn_boxed_layout', 'layout_options', false, 'no' ) == 'yes') {
	?>
	body {

		<?php
		// Color
		$boxed_style_color = zget_option( 'boxed_style_color', 'layout_options', false, '#fff' );
		if ( !empty( $boxed_style_color ) ){
			echo 'background-color:'.$boxed_style_color.';';
		}

		// Image
		$boxed_style_image = zget_option( 'boxed_style_image', 'layout_options', false, array() );

		if( !empty( $boxed_style_image['image'] ) ) { echo 'background-image:url("'.$boxed_style_image['image'].'");'; }
		if( !empty( $boxed_style_image['repeat'] ) ) { echo 'background-repeat:'.$boxed_style_image['repeat'].';'; }
		if( !empty( $boxed_style_image['position'] ) ) { echo 'background-position:'.$boxed_style_image['position']['x'].' '.$boxed_style_image['position']['y'].';'; }
		if( !empty( $boxed_style_image['attachment'] ) ) { echo 'background-attachment:'.$boxed_style_image['attachment'].';'; }
		?>
	}
	<?php
}

// Top Navigation Colors
if( $zn_top_nav_color = zget_option( 'zn_top_nav_color', 'color_options' ) ){
	echo '.topnav-item, .topnav .menu-item a { color:'.$zn_top_nav_color.' ;}';
}
if ( $zn_top_nav_h_color = zget_option( 'zn_top_nav_h_color', 'color_options' ) ) {
	echo '.topnav-item:hover, .topnav .menu-item a:hover { color:'.$zn_top_nav_h_color.' ;}';
}

// Various usages of the body color
if ( isset($zn_body_def_color) && !empty($zn_body_def_color) ) {
	// Static content fade mask
	echo '.sc__fade-mask, .portfolio-item-desc-inner:after { background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.zn_hex2rgba_str($zn_body_def_color, 0).'), color-stop(100%, '.$zn_body_def_color.')); background: -webkit-linear-gradient(top, '.zn_hex2rgba_str($zn_body_def_color, 0).' 0%, '.$zn_body_def_color.' 100%); background: linear-gradient(to bottom, '.zn_hex2rgba_str($zn_body_def_color, 0).' 0%, '.$zn_body_def_color.' 100%); }
	 ';
	// Laptop Slider Mask
	echo '.ls-source__mask-front {background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.zn_hex2rgba_str($zn_body_def_color, 60).'), color-stop(50%, '.$zn_body_def_color.')); background: -webkit-linear-gradient(top,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%); background: linear-gradient(to bottom,  '.zn_hex2rgba_str($zn_body_def_color, 60).' 0%, '.$zn_body_def_color.' 50%);}';
}

// Header background & text color for smaller than 480px devices

echo '@media (max-width: 767px) {';
if($zn_header_resp_color = zget_option( 'zn_header_resp_color', 'color_options',  false, '' )){
	echo '.site-header {background-color: '.$zn_header_resp_color.' !important;}';
}

/**
 * It seems it's not ok to force colors as there are 3 color presets already.
 */
// $header_resp_textcolor = zget_option( 'zn_header_resp_textcolor', 'color_options',  false, '#fff' );
// echo '
// .site-header {color: '.$header_resp_textcolor.';}
// .site-header .xs-icon,
// 	.site-header .glyphicon-remove-circle,
// 	.site-header .kl-header-toptext,
// 	.site-header .kl-header-toptext a,
// 	.topnav-no-hdnav .topnav-item {color: '.$header_resp_textcolor.' !important;}
// 	.topnav-no-hdnav .topnav-item:hover { color:'.zget_option( 'zn_header_resp_textcolor_hov', 'color_options',  false, '#fff' ).' !important;}
// 	.zn-res-menuwrapper .zn-res-trigger:after { background: '.$header_resp_textcolor.' !important; box-shadow: 0 8px 0 '.$header_resp_textcolor.', 0 16px 0 '.$header_resp_textcolor.' !important;}
// 	.headernav-trigger:before { background: '.$header_resp_textcolor.' !important; box-shadow: 0 6px 0 '.$header_resp_textcolor.', 0 12px 0 '.$header_resp_textcolor.' !important;}';
//
echo '}';
