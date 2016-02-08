<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Comments
 Description: Create and display the current page content
 Class: TH_Comments
 Category: content
 Level: 3
*/

/**
 * Class TH_Comments
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Comments extends ZnElements
{
	public static function getName(){
		return __( "Comments", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		echo '<div class="zn_page_comments_element '.$this->data['uid'].' '.$this->opt('css_class','').'">';
			comments_template();
		echo '</div>';
	}

	function options(){

		$uid = $this->data['uid'];
		return array(

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
				'video'   => 'http://support.hogash.com/kallyas-videos/#mWRmLnuEz1E',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	// function element_edit()
	// {
	//     echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
	// }

}
