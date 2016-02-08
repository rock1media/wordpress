<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Buttons
 Description: Create and display as many buttons as you want
 Class: TH_Buttons
 Category: content
 Level: 3
*/
/**
 * Class TH_Buttons
 *
 * Create and display as many buttons as you want
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Buttons extends ZnElements
{
	public static function getName(){
		return __( "Buttons", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{

		echo '<div class="zn_buttons_element '.$this->data['uid'].' text-'.$this->opt('el_alignment','left').' '.$this->opt('css_class','').'">';

			$buttons = $this->opt('single_btn');

			if( is_array($buttons) && !empty( $buttons ) ){
				foreach( $buttons as $b ){

					//Class
					$classes = array();
					$classes[] = 'btn-element btn';
					$classes[] = $b['button_style'];
					$classes[] = $b['button_size'];
					$classes[] = $b['button_width'];
					$classes[] = isset($b['button_block']) ? $b['button_block'] : '';
					$classes[] = 'btn-icon--'.$b['button_icon_pos'];
					$classes[] = isset($b['button_corners']) && !empty($b['button_corners']) ? $b['button_corners'] : 'btn--rounded';

					// Styles
					$style = !empty($b['button_margin']) ? ' style="margin:'.$b['button_margin'].';"' : '';

					// Icon
					$icon = $b['button_icon_enable'] == 1 ? '<span '.zn_generate_icon( $b['button_icon'] ).'></span>':'';

					if( isset($b['button_text']) && !empty($b['button_text']) ){

						$text = '<span>'.$b['button_text'].'</span>';

						// Icon position
						if( $b['button_icon_pos'] == 'before' ){
							$text = $icon.$text;
						} else{
							$text = $text.$icon;
						}

						// extract link and add attributes and classes
						$link = zn_extract_link( $b['button_link'], implode(' ', $classes), $style );

						echo $link['start'] . $text . $link['end'];
					}

				}
			}

		echo '</div>';

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Element Alignment", 'zn_framework' ),
						"description" => __( "Please select the alignment of the button/s.", 'zn_framework' ),
						"id"          => "el_alignment",
						"std"         => "left",
						"options"     => array (
							'left' => __( 'Left (default)', 'zn_framework' ),
							'right'          => __( 'Right', 'zn_framework' ),
							'center'          => __( 'Center', 'zn_framework' )
						),
						"type"        => "select",
						'live' => array(
						   'type'           => 'class',
						   'css_class'      => '.'.$uid,
						   'val_prepend'   => 'text-',
						),
					),

					array(
						"name"           => __( "Button", 'zn_framework' ),
						"description"    => __( "Add Button.", 'zn_framework' ),
						"id"             => "single_btn",
						"element_title" => "button_text",
						"std"            => "",
						"type"           => "group",
						"add_text"       => __( "Button", 'zn_framework' ),
						"remove_text"    => __( "Button", 'zn_framework' ),
						"group_sortable" => true,
						"subelements"    => array (

							array (
								"name"        => __( "Text", 'zn_framework' ),
								"description" => __( "Text inside the button", 'zn_framework' ),
								"id"          => "button_text",
								"std"         => "",
								"type"        => "text",
							),

							array (
								"name"        => __( "Link", 'zn_framework' ),
								"description" => __( "Attach a link to the button", 'zn_framework' ),
								"id"          => "button_link",
								"std"         => "",
								"type"        => "link",
								"options"     => zn_get_link_targets(),
							),
							array (
								"name"        => __( "Style", 'zn_framework' ),
								"description" => __( "Select a style for the button", 'zn_framework' ),
								"id"          => "button_style",
								"std"         => "btn-fullcolor",
								"type"        => "select",
								"options"     => zn_get_button_styles(),
								'live' => array(
								   'type'           => 'class',
								   'css_class'      => '.'.$uid.' .btn-element',
								),
							),
							array (
								"name"        => __( "Size", 'zn_framework' ),
								"description" => __( "Select a size for the button", 'zn_framework' ),
								"id"          => "button_size",
								"std"         => "",
								"type"        => "select",
								"options"     => array (
									''          => __( "Default", 'zn_framework' ),
									'btn-lg'    => __( "Large", 'zn_framework' ),
									'btn-md'    => __( "Medium", 'zn_framework' ),
									'btn-sm'    => __( "Small", 'zn_framework' ),
									'btn-xs'    => __( "Extra small", 'zn_framework' ),
								),
								'live' => array(
								   'type'           => 'class',
								   'css_class'      => '.'.$uid.' .btn-element',
								),
							),

							array (
								"name"        => __( "Button Corners", 'zn_framework' ),
								"description" => __( "Select the button corners type for this button", 'zn_framework' ),
								"id"          => "button_corners",
								"std"         => "btn--rounded",
								"type"        => "select",
								"options"     => array (
									'btn--rounded'  => __( "Smooth rounded corner", 'zn_framework' ),
									'btn--round'    => __( "Round corners", 'zn_framework' ),
									'btn--square'   => __( "Square corners", 'zn_framework' ),
								),
								'live' => array(
								   'type'           => 'class',
								   'css_class'      => '.'.$uid.' .btn-element',
								),
							),

							array (
								"name"        => __( "Width", 'zn_framework' ),
								"description" => __( "Select a size for the button", 'zn_framework' ),
								"id"          => "button_width",
								"std"         => "",
								"type"        => "select",
								"options"     => array (
									''                          => __( "Default", 'zn_framework' ),
									'btn-block btn-fullwidth'   => __( "Full width (100%)", 'zn_framework' ),
									'btn-halfwidth'             => __( "Half width (50%)", 'zn_framework' ),
									'btn-third'                 => __( "One-Third width (33%)", 'zn_framework' ),
									'btn-forth'                 => __( "One-forth width (25%)", 'zn_framework' ),
								),
								'live' => array(
								   'type'           => 'class',
								   'css_class'      => '.'.$uid.' .btn-element',
								),
							),


							array (
								"name"        => __( "Make button as block?", 'zn_framework' ),
								"description" => __( "Transform the button and make it a block?", 'zn_framework' ),
								"id"          => "button_block",
								"std"         => "",
								"value"       => "btn-block",
								"type"        => "toggle2",
								'live' => array(
								   'type'           => 'class',
								   'css_class'      => '.'.$uid.' .btn-element',
								),
							),

							array (
								"name"        => __( "Margins", 'zn_framework' ),
								"description" => __( "Add css margins to the buttons for distancing. The css syntax is [top right bottom left].", 'zn_framework' ),
								"id"          => "button_margin",
								"std"         => "",
								"type"        => "text",
								"placeholder" => "ex: 10px 10px 10px 10px",
							),

							array (
								"name"        => __( "Add icon?", 'zn_framework' ),
								"description" => __( "Add an icon to the button?", 'zn_framework' ),
								"id"          => "button_icon_enable",
								"std"         => "0",
								"value"       => "1",
								"type"        => "toggle2",
							),
							array (
								"name"        => __( "Icon position", 'zn_framework' ),
								"description" => __( "Select the position of the icon", 'zn_framework' ),
								"id"          => "button_icon_pos",
								"std"         => "before",
								"type"        => "select",
								"options"     => array (
									'before'  => __( "Before text", 'zn_framework' ),
									'after'   => __( "After text", 'zn_framework' ),
								),
								"dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
							),

							array (
								"name"        => __( "Select icon", 'zn_framework' ),
								"description" => __( "Select an icon to add to the button", 'zn_framework' ),
								"id"          => "button_icon",
								"std"         => "0",
								"type"        => "icon_list",
								'class'       => 'zn_full',
								"dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
							),

						)
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#ZZa-J_ls8WY',
				'docs'    => 'http://support.hogash.com/documentation/buttons/',
				'copy'    => $uid,
				'general' => true,
			)),
		);
		return $options;
	}
}
