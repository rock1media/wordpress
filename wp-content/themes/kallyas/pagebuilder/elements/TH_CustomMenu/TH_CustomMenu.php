<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Custom Menu
 Description: Display WordPress menus in various styles.
 Class: TH_CustomMenu
 Category: content
 Level: 3
*/

/**
 * @since    4.0.9
 */
class TH_CustomMenu extends ZnElements
{
	public static function getName(){
		return __( "Custom Menu", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$icon_type = $this->opt('ibx_type', 'icon');

		// Title Styles
		$cmf = '';

		$cm_fontstyles = $this->opt('cm_fontstyles');
		if( is_array($cm_fontstyles) && !empty($cm_fontstyles) ){
			foreach ($cm_fontstyles as $key => $value) {
				if(!empty($value)){
					$cmf .= $key .':'. $value.';';
				}
			}
		}
		if(!empty($cmf)){
			$css .= '.'.$uid.' > ul > li > a {'.$cmf.'} ';
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		if( empty( $options ) ) { return; }

		// Menu Style
		$cmstyle = $this->opt('cm_style', 'normal');

		// Container
		$elm_classes=array();
		// Basic
		$elm_classes[] = 'elm-custommenu';
		$elm_classes[] = 'clearfix';
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = $this->opt('css_class','');
		// Elm. style
		$elm_classes[] = 'elm-custommenu--'.$cmstyle;


		// List Classes
		$list_classes=array();
		$list_classes[] = 'elm-cmlist';
		$list_classes[] = 'clearfix';

		// Color Scheme
		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$list_classes[] = 'elm-cmlist--skin-'.$color_scheme;
		$list_classes[] = 'element-scheme--'.$color_scheme;

		// Toggle Uppercase
		$list_classes[] = $this->opt('cm_ucase', '');

		// Check Vertical Styles
		$vertical_styles = in_array( $cmstyle, array('normal', 'v1', 'v2', 'v3', 'v3ext') );

		$list_classes[] = 'elm-cmlist--'.$cmstyle;
		// Add columns, but only for vertical styles
		$cmcols = $this->opt('cm_cols', 1);
		if($vertical_styles  && $cmcols != 1) {
			$list_classes[] = ' elm-cmlist-cols elm-cmlist--cols-'.$cmcols;
		}
		// Check if depth is supported
		$depth = $vertical_styles ? $this->opt('cm_depth', 1) : 1;

		// Whoa, no menus?
		$nav_menu = $this->opt('cm_menu','');
		if ( ! $nav_menu ) {
			return;
		}

		echo '<div class="'.implode(' ', $elm_classes ).'">';

			if($cmstyle == 'dd'){
				echo '<div class="elm-custommenu-pick">'.$this->opt('cm_dd_text','').'</div>';
			}

			// Make Menu
			wp_nav_menu( array (
				'menu'          => $nav_menu,
				'depth'           => $depth,
				'menu_class'      => implode(' ', $list_classes ),
				'menu_id'         => $uid,
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'container'         => false
			) );

		echo '</div>';

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		// Get menus
		$menus = get_terms( 'nav_menu', array ( 'hide_empty' => false ) );
		$menusList = array();
		foreach ( $menus as $menu ) {
			$menusList[$menu->term_id] = $menu->name;
		}

		if ( ! $menus ) {
			$menu_option = array (
				"name"        => __( "Please create Menus!", 'zn_framework' ),
				"description" => sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'zn_framework' ), admin_url( 'nav-menus.php' ) ),
				"id"          => "cm_nomenus",
				"std"         => "",
				"type"        => "zn_title",
			);
		}
		else {
			$menu_option = array (
				"name"        => __( "Choose a menu", 'zn_framework' ),
				"description" => __( "Choose a menu to display.", 'zn_framework' ),
				"id"          => "cm_menu",
				"std"         => "",
				"type"        => "select",
				"options"     => $menusList,
			);
		}


		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					$menu_option,

					array (
						"name"        => __( "Menu Depth", 'zn_framework' ),
						"description" => __( "Choose the maximum depth of the menu.", 'zn_framework' ),
						"id"          => "cm_depth",
						"std"         => "1",
						"type"        => "select",
						"options"     => array(
							"1" => "1 Level",
							"2" => "2 Levels",
							"3" => "3 Levels",
							"4" => "4 Levels",
							"5" => "5 Levels (Not recommended, better restructure it)"
						),
						'dependency' => array( 'element' => 'cm_style' , 'value'=> array('normal', 'v1', 'v2', 'v3', 'v3ext') ),
					),

					array (
						"name"        => __( "Menu Style", 'zn_framework' ),
						"description" => __( "Choose the style of the menu.", 'zn_framework' ),
						"id"          => "cm_style",
						"std"         => "normal",
						"type"        => "select",
						"options"     => array(
							"normal" => "Minimal (Default)",
							"v1" => "Vertical Menu - Style 1",
							"v2" => "Vertical Menu - Style 2",
							"v3" => "Vertical Menu - Style 3",
							"v3ext" => "Vertical Menu - Style 3 Extended!",
							"h1" => "Horizontal Menu - Style 1 (Minimal)",
							"h2" => "Horizontal Menu - Style 2",
							"dd" => "Custom Drop-Down",
							// TODO: These styles below
							// "dd_btn" => "Custom DropDown with Button",
							// "vert_mm" => "Vertical Mega Menu",
							// "mmlvl_eff" => "Multi-level with effect",
						),
						// TODO: DropDown has custom markup and live isn't an option
						//
						// 'live'        => array(
						//     'multiple' => array(
						//         array(
						//             'type'      => 'class',
						//             'css_class' => '.'.$uid.' .elm-cmlist',
						//             'val_prepend'  => 'elm-cmlist--',
						//         ),
						//         array(
						//             'type'      => 'class',
						//             'css_class' => '.'.$uid,
						//             'val_prepend'  => 'elm-custommenu--',
						//         )
						//     )
						// ),
					),
					array(
						'id'          => 'cm_cols',
						'name'        => 'Menu on columns',
						'description' => 'Make vertical menu on columns.',
						'type'        => 'select',
						'std'         => '1',
						"options"     => array(
							"1" => "1 Column (Default)",
							"2" => "2 Columns",
							"3" => "3 Columns",
							"4" => "4 Columns",
						),
						'dependency' => array( 'element' => 'cm_style' , 'value'=> array('normal', 'v1', 'v2', 'v3', 'v3ext') ),
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' .elm-cmlist',
							'val_prepend'  => 'elm-cmlist-cols elm-cmlist--cols-',
						)
					),
					array(
						'id'          => 'cm_dd_text',
						'name'        => 'Default Dropdown Text',
						'description' => 'Add the default dropdown text.',
						'type'        => 'text',
						'std'         => '',
						'placeholder' => __( 'eg: --Choose Menu Item--', 'zn_framework' ),
						'dependency' => array( 'element' => 'cm_style' , 'value'=> array('dd') ),
					),
					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid.' .elm-cmlist',
									'val_prepend'  => 'elm-cmlist--skin-',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid.' .elm-cmlist',
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					array(
						'id'          => 'cm_ucase',
						'name'        => 'Force Uppercase',
						'description' => 'Make all links in the menu with uppercase letters',
						'type'        => 'toggle2',
						'std'         => '',
						'value'         => 'uppercase',
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' .elm-cmlist',
						)
					),
					array (
						"name"        => __( "Menu item font-styles (1st level only!)", 'zn_framework' ),
						"description" => __( "Specify the typography properties for menu items of the first level.", 'zn_framework' ),
						"id"          => "cm_fontstyles",
						"std"         => array (
							'font-size'   => '14px',
							'font-family'   => 'Open Sans',
							'line-height' => '26px',
						),
						'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
						"type"        => "font",
					),
				),
			),

			'other' => array(
				'title' => 'Other Options',
				'options' => array(

					array(
						'id'          => 'css_class',
						'name'        => 'CSS class',
						'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
						'type'        => 'text',
						'std'         => '',
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
