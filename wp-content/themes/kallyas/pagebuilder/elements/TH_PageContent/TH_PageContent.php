<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Page content
 Description: Create and display the current page content
 Class: TH_PageContent
 Category: content, post
 Level: 3
*/

/**
 * Class TH_PageContent
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PageContent extends ZnElements
{
	public static function getName(){
		return __( "Page content", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		echo '<div class="zn_page_content_elemenent '.$this->data['uid'].' '.$this->opt('css_class','').'">';
			get_template_part( 'inc/page', 'content-view-page.inc' );
		echo '</div>';
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element_edit()
	{
		echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#xbDEvjZH5Y8',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
