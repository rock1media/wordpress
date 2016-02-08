<?php
/**
 * Displays the main header
*/
global $post;

if ( !isset( $post ) || empty( $post ) ) {
	$pid = get_option( 'page_for_posts' );
	$post = get_post( $pid );
}

$style = "";
$show_header = true;
if( is_singular() && get_post_meta( get_the_ID() , 'show_header', true ) === 'zn_dummy_value') {
	$show_header = false;
	if ( ZNPB()->is_active_editor ){
		$show_header = true;
		$style = ' style="display:none" ';
	}
}

// Bail early if we don't have to show the header
if( ! $show_header ){ return; }

$header_class = array();

/*
 * Header Layout
 */
$header_class[] = $headerLayoutStyle = zget_option( 'zn_header_layout', 'general_options', false, 'style2' );

// Get classic headers
if(in_array( $headerLayoutStyle, array('style1', 'style2', 'style3', 'style4', 'style5', 'style6') )){

	$header_class[] = 'siteheader-classic';

	if(in_array( $headerLayoutStyle, array('style2', 'style3') )){
		$header_class[] = 'siteheader-classic-split';
	} else {
		$header_class[] = 'siteheader-classic-normal';
	}
}

/*
 * Call to Action button
 */
if ( zget_option( 'head_show_cta', 'general_options', false, 'no' ) == 'yes' ) {
	$header_class[] = 'cta_button';
}

// Sticky menu
$menu_follow = zget_option( 'menu_follow', 'general_options', false, 'no' );
$header_class[] = $stickyMenu = ( 'sticky' == $menu_follow ) ? 'header--sticky js-scroll-event' : '';
$header_class[] = $follow_menu = ( 'yes' == $menu_follow ) ? 'header--follow' : '';
$stickyMenuAttrs = $stickyMenu ? ' data-forch="1" data-visibleclass="header--is-sticked"  data-hiddenclass="header--not-sticked"' : '';


// Resize header on sticked mode. Append class;
$header_class[] = zn_resize_sticky_header() ? ' sticky-resize':'';

/*
 * Header Custom Background
 */
$header_style = zget_option( 'header_style', 'general_options', false, 'default' );
$headerStyleScheme = $header_style == 'image_color' ? 'headerstyle--' . $header_style : 'headerstyle--default'; // the default value
$header_class[] = $headerStyleScheme;
/*
 * Header text colors
 */
$headerTextScheme = 'sh--default'; // the default value
$header_text_scheme = zget_option( 'header_text_scheme', 'general_options' );

// Header styles scheme defaults
$light_hl = array('style1', 'style2', 'style3', 'style4', 'style5', 'style7', 'style8');
if( in_array($headerLayoutStyle, $light_hl )) {
	$headerTextScheme = 'sh--light';
}
$dark_hl = array('style6', 'style9');
if( in_array($headerLayoutStyle, $dark_hl ) ) {
	$headerTextScheme = 'sh--dark';
}
// If Custom bg selected, make sure it's not default text scheme
if ( $header_text_scheme && $header_style == 'image_color' ) {
	if($header_text_scheme != 'default' && $header_text_scheme != ''){
		$headerTextScheme = 'sh--' . $header_text_scheme;
	}
}
$header_class[] = $headerTextScheme;

// Absolute / Relative header (from 4.0.3)
$header_class[] = zget_option( 'head_position', 'general_options', false, '1' ) != 1 ? 'site-header--relative' : 'site-header--absolute';

// General dropdown color scheme
$nav_color_theme = 'nav-th--' . ( zget_option( 'nav_color_theme', 'general_options', false, '' ) == '' ?
		zget_option( 'zn_main_style', 'color_options', false, 'light' ) :
		zget_option( 'nav_color_theme', 'general_options', false, '' ) );
$header_class[] = $nav_color_theme;

// Imploded
$hc = implode( ' ', $header_class );

if ( ZN()->pagebuilder->is_active_editor ) {
	echo '<a href="#" class="toggle-header" title="Hide header to access the first element."><span class="glyphicon glyphicon-chevron-up"></span></a>';
}

do_action('th_display_site_header'); // Used for backwards compatility. It will be removed in a future version

// Add a hook before the header display
do_action('zn_before_siteheader');
?>
<header id="header" class="site-header <?php echo $hc; ?>" <?php echo $stickyMenuAttrs; ?> <?php echo $style;?>>
	<?php
		// Load the header style
		include(locate_template('components/theme-header/header-'. $headerLayoutStyle .'.php'));
	?>
</header>
<?php
// Add a hook after the header display
do_action('zn_after_siteheader');