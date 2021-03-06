<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Revolution Slider
 Description: Create and display a Recent Work 3 element
 Class: TH_RevolutionSlider
 Category: content
 Level: 3
*/

/**
 * Class TH_RevolutionSlider
 *
 * Create and display a Revolution Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_RevolutionSlider extends ZnElements
{
	public static function getName(){
		return __( "Revolution Slider", 'zn_framework' );
	}


	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$style = $this->opt('ww_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';
		?>
		<div class="kl-slideshow <?php echo $style; ?> kl-revolution-slider portfolio_devices <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
			<div class="bgback"></div>

			<?php
				if(isset($options['revslider_id']) && !empty($options['revslider_id']) ){
					echo do_shortcode( '[rev_slider alias="' . $options['revslider_id'] . '"]' );
				}
			?>

			<div class="th-sparkles"></div>

			<?php
				WpkPageHelper::zn_bottommask_markup($bottom_mask);
			?>
		</div>
		<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		global $wpdb;
		$revslider_options = array ();
		if(! function_exists('is_plugin_active')) {
			include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		}
		if ( is_plugin_active( 'revslider/revslider.php' ) ) {
			// Table name
			$table_name = $wpdb->prefix . "revslider_sliders";
			// Get sliders
			$rev_sliders = $wpdb->get_results( "SELECT title,alias FROM $table_name" );
			// Iterate over the sliders
			if(! empty($rev_sliders)) {
				foreach ($rev_sliders as $key => $item) {
					if (isset($item->alias) && isset($item->title)) {
						$revslider_options[$item->alias] = $item->title;
					}
				}
			}
		}

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Background Style", 'zn_framework' ),
						"description" => __( "Select the background style you want to use. Please note that styles can be created
									from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
						"id"          => "ww_header_style",
						"std"         => "",
						"type"        => "select",
						"options"     => WpkZn::getThemeHeaders(true),
						"class"       => ""
					),
					array (
						"name"        => __( "Select slider", 'zn_framework' ),
						"description" => __( "Select the desired slider you want to use. Please note that the slider can be created
									from inside the Revolution Slider options page.", 'zn_framework' ),
						"id"          => "revslider_id",
						"std"         => "",
						"type"        => "select",
						"options"     => $revslider_options
					),
					array (
						"name"        => __( "Use Paralax effect", 'zn_framework' ),
						"description" => __( "Select yes if you have used the paralax classes
											when you created your slider.", 'zn_framework' ),
						"id"          => "revslider_paralax",
						"std"         => "0",
						"type"        => "select",
						"options"     => array ( 0 => __( 'No', 'zn_framework' ), 1 => __( 'Yes', 'zn_framework' ) )
					),

					// Bottom masks overrides
					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
						"id"          => "hm_header_bmasks",
						"std"         => "none",
						"type"        => "select",
						"options"     => array (
							'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
							'shadow' => __( 'Shadow Up', 'zn_framework' ),
							'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
							'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
							'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
							'mask3' => __( 'Vector Mask 3 CENTER (New! From v4.0)', 'zn_framework' ),
							'mask3 mask3l' => __( 'Vector Mask 3 LEFT (New! From v4.0)', 'zn_framework' ),
							'mask3 mask3r' => __( 'Vector Mask 3 RIGHT (New! From v4.0)', 'zn_framework' ),
							'mask4' => __( 'Vector Mask 4 CENTER (New! From v4.0)', 'zn_framework' ),
							'mask4 mask4l' => __( 'Vector Mask 4 LEFT (New! From v4.0)', 'zn_framework' ),
							'mask4 mask4r' => __( 'Vector Mask 4 RIGHT (New! From v4.0)', 'zn_framework' ),
							'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
							'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
						),
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#pP-ktSGJabg',
				'docs'    => 'http://support.hogash.com/documentation/revolution-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
