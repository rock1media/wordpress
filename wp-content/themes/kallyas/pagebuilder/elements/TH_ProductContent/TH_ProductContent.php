<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Product item content
 Description: Create and display the current post content
 Class: TH_ProductContent
 Category: content, post
 Level: 3
 Dependency_class: WooCommerce
*/

/**
 * Class TH_ProductContent
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ProductContent extends ZnElements
{
	public static function getName(){
		return __( "Portfolio item content", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		// Prevent the elemnt from being accessible on other pages
		if( ! is_singular( 'product' ) ){
			echo '<div class="zn-pb-notification">This element only works on single product pages created with WooCommerce. Please delete it.</div>';
			return false;
		}

		echo '<div class="zn_post_content_elemenent '.$this->data['uid'].' '.$this->opt('css_class','').'">';
			wc_get_template_part( 'content', 'single-product' );
		echo '</div>';
	}

	function options(){
		$uid = $this->data['uid'];
		$options = array(
			'has_tabs'  => true,
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
		);
		return $options;
	}

	// TODO : Uncomment this if JS errors appears because of clients shortcodes/plugins
	// /**
	//  * This method is used to display the output of the element.
	//  * @return void
	//  */
	// function element_edit()
	// {
	//     echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
	// }

}
