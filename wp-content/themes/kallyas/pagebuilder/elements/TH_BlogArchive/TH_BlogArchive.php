<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Blog Archive
 Description: Create and display the current post content
 Class: TH_BlogArchive
 Category: content
 Level: 3
*/

/**
 * Class TH_BlogArchive
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_BlogArchive extends ZnElements
{
	public static function getName(){
		return __( "Blog archive", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		/*
		 * Load resources in footer
		 */
		wp_enqueue_script('isotope');

	}



	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		global $zn_config, $query_string, $wp_query, $paged;

		// Get the proper page - this resolves the pagination on static frontpage
		if( get_query_var('paged') ){ $paged = get_query_var('paged'); }
		elseif( get_query_var('page') ){ $paged = get_query_var('page'); }
		else{ $paged = 1; }

		$zn_config['blog_style'] = $this->opt( 'blog_style', '' );

		$zn_config['blog_columns'] = $this->opt( 'blog_columns', '1' );
		$category = $this->opt('category') ? $this->opt('category') : '';
		$count = $this->opt('count')  ? $this->opt('count') : '4';

		$args = array(
			'posts_per_page' => ( int )$count,
			'post_status' => 'publish',
			'paged' => $paged
		);

		if( !empty( $category ) ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => $category
				),
			);
		}


		// PERFORM THE QUERY
		query_posts( $args );

		echo '<div class="zn_blog_archive_element '.$this->data['uid'].' '.$this->opt('css_class','').'">';
			if ( $zn_config['blog_columns'] > 1 ) {
				get_template_part( 'blog', 'columns' );
			}
			else {
				get_template_part( 'blog', 'default' );
			}
		echo '</div>';
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();
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

	function options() {

		$args = array(
			'type' => 'post'
		);

		$post_categories = get_categories($args);

		$option_post_cat = array();

		foreach ($post_categories as $category) {
			$option_post_cat[$category->cat_ID] = $category->cat_name;
		}

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'          => 'blog_columns',
						'name'        => 'Blog columns',
						'description' => 'Select the number of columns to use',
						'type'        => 'select',
						'std'		  => '1',
						'options'        => array(
							'1' => '1 column',
							'2' => '2 column',
							'3' => '3 column',
							'4' => '4 column',
						),
					),
					array(
						'id'          => 'category',
						'name'        => 'Categories',
						'description' => 'Select your desired categories for post items to be displayed.',
						'type'        => 'select',
						'options'	  => $option_post_cat,
						'multiple'	  => true
						),
					array(
						'id'          => 'count',
						'name'        => 'Number of items per page',
						'description' => 'Please choose the desired number of items that will be shown on a page. Please note that if you set this element on the page you use as your posts page in Settings > Reading, you will need to set the Blog pages show at most option to match the value set in this option or you will get 404 errors when using the pagingation.',
						'type'        => 'slider',
						'std'		  => '4',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '1',
							'max' => '50',
							'step' => '1'
						),
					),
					array(
						'id'          => 'blog_style',
						'name'        => 'Blog color scheme',
						'description' => 'Select the style of this blog page',
						'type'        => 'select',
						'std'		  => '',
						'options'        => array(
							'' => 'Inherit from Blog Options (Kallyas options)',
							'light' => 'Light',
							'dark' => 'Dark'
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#2dkIHxjdCG4',
				'docs'    => 'http://support.hogash.com/documentation/blog-archive/',
				'copy'    => $uid,
				'general' => true,
			)),
		);
		return $options;
	}

}