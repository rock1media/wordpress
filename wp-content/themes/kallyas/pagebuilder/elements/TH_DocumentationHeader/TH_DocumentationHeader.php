<?php if (!defined('ABSPATH')) {
	return;
}
/*
Name: Documentation Header
Description: Create and display a Documentation Header element
Class: TH_DocumentationHeader
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_DocumentationHeader
 *
 * Create and display a Documentation Header element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_DocumentationHeader extends ZnElements
{
	public static function getName(){
		return __( "Documentation Header", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$style = $this->opt('hm_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		?>
		<div id="page_header" class="page-subheader <?php echo $style; ?> <?php echo $bm_class ?> zn_documentation_page <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
			<div class="bgback"></div>
			<div class="th-sparkles"></div>
			<div class="container kl-slideshow-safepadding">
				<div class="row">
					<div class="zn_doc_search">
						<form method="get" id="" action="<?php echo home_url(); ?>">
							<label class="screen-reader-text"
								   for="s"><?php _e("Search for:", 'zn_framework'); ?></label>
							<input type="text" value="" name="s" id="s"
								   placeholder="<?php _e("Search the Documentation", 'zn_framework'); ?>">
							<input type="submit" id="searchsubmit" class="btn"
								   value="<?php _e('Search', 'zn_framework');?>">
							<input type="hidden" name="post_type" value="documentation">
						</form>
					</div>
				</div>
				<!-- end row -->
			</div>
			<?php
				WpkPageHelper::zn_bottommask_markup($bottom_mask);
			?>
		</div><!-- end page-subheader -->
	<?php
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

					array(
						"name" => __("Header Style", 'zn_framework'),
						"description" => __("Select the header style you want to use for this page.Please note that
											  header styles can be created from the theme's admin page.", 'zn_framework'),
						"id" => "hm_header_style",
						"std" => "",
						"type" => "select",
						"options" => WpkZn::getThemeHeaders(true),
						"class" => ""
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#Yl7l2SVgyRU',
				'docs'    => 'http://support.hogash.com/documentation/documentation-header/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;
	}
}
