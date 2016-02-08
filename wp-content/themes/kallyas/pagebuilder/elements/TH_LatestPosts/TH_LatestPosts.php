<?php if(! defined('ABSPATH')){ return; }
/*
Name: Latest Posts
Description: Create and display a Latest Posts element
Class: TH_LatestPosts
Category: content
Level: 3
*/

/**
 * Class TH_LatestPosts
 *
 * Create and display a Latest Posts element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_LatestPosts extends ZnElements
{
	public static function getName(){
		return __( "Latest Posts", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = $this->opt('css_class','');

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'latest_posts-acc--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$title = $this->opt( 'lp_title' ) ? '<h3 class="m_title m_title_ext text-custom latest_posts-acc-elm-title">'.$this->opt( 'lp_title' ).'</h3>' : '' ;

		?>

			<div class="latest_posts acc-style latest_posts-acc <?php echo implode(' ', $elm_classes); ?>">
				<?php echo $title; ?>
				<?php
				if ( ! empty( $options['lp_blog_page'] ) ) {
					echo '<a href="' . $options['lp_blog_page'] . '" class="viewall element-scheme__linkhv latest_posts-acc-viewall">' . __( "VIEW ALL", 'zn_framework' ) . ' -</a>';
				}
				?>
				<div class="css3accordion latest_posts-acc-wrapper">
					<ul class="latest_posts-acc-list">
						<?php
						global $post;
						// Check what categories were selected..if any
						$blog_category = '';
						if ( isset ( $options['lp_blog_categories'] ) ) {
							$blog_category = implode( ',', $options['lp_blog_categories'] );
						}

						// Start the query
						query_posts( array ( 'posts_per_page' => 3, 'cat' => $blog_category ) );

						// GET THE NUMBER OF TOTAL POSTS RETURNED
						global $wp_query;
						$num_posts = $wp_query->post_count;

						$i   = 0;
						$cls = '';

						// Start the loop
						while ( have_posts() ) {
							$i ++;
							the_post();

							if ( $i == $num_posts ) {
								$cls = 'last';
							}

							echo '<li class="' . $cls . ' latest_posts-acc-item">';

							echo '<div class="inner-acc latest_posts-acc-inner">';

							$image = '';
							// Create the featured image html
							if ( has_post_thumbnail( $post->ID ) ) {
								$thumb   = get_post_thumbnail_id( $post->ID );
								$f_image = wp_get_attachment_url( $thumb );
								if ( ! empty ( $f_image ) ) {
									// Make the "alt" attribute available in the front-end
									$alt   = trim( strip_tags( get_post_meta( $thumb, '_wp_attachment_image_alt', true ) ) );
									$image = vt_resize( '', $f_image, 370, 200, true );
									$image = '<a href="' . get_permalink() . '" class="thumb hoverBorder plus latest_posts-acc-link"><img class="latest_posts-acc-img" src="' . $image['url'] . '" alt="' . $alt . '"/></a>';
								}
							}
							echo $image;

							echo '<div class="content latest_posts-acc-content">';

							echo '<em class="element-scheme__faded latest_posts-acc-details">' . get_the_time( 'd F Y' ) . ' ' . __( "by", 'zn_framework' ) . ' ' . get_the_author() . ', ' . __( "in", 'zn_framework' ) . ' ';

							$all_cats = count( get_the_category() );
							$z        = 1;
							foreach ( ( get_the_category() ) as $category ) {
								echo $category->cat_name;
								if ( $all_cats != $z ) {
									echo ',';
								}
								$z ++;
							}
							echo '</em>';

							echo '<h5 class="m_title text-custom latest_posts-acc-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';

								// TEXT
								echo '<div class="text latest_posts-acc-text">';
								$excerpt = get_the_excerpt();
								$excerpt = strip_shortcodes( $excerpt );
								$excerpt = strip_tags( $excerpt );
								$the_str = mb_substr( $excerpt, 0, 80 );
								echo $the_str . '...';

								echo '</div>';

								echo '<a href="' . get_permalink() . '" class="element-scheme__linkhv latest_posts-acc-more">' . __( "READ MORE", 'zn_framework' ) . ' +</a>';

							echo '</div>';
							echo '</div>';
							echo '</li>';
						}
						wp_reset_query();
						?>
					</ul>
				</div>
				<!-- end CSS3 Accordion -->
			</div>
			<!-- end acc-style -->

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
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Latest Posts element", 'zn_framework' ),
						"id"          => "lp_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Blog page Link", 'zn_framework' ),
						"description" => __( "Enter the link to your blog page", 'zn_framework' ),
						"id"          => "lp_blog_page",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Blog Category", 'zn_framework' ),
						"description" => __( "Select the blog category to show items", 'zn_framework' ),
						"id"          => "lp_blog_categories",
						"multiple"    => true,
						"std"         => "0",
						"type"        => "select",
						"options"     => WpkZn::getBlogCategories()
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
									'css_class' => '.'.$uid,
									'val_prepend'  => 'latestposts--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#gFcL4BXQpAs',
				'docs'    => 'http://support.hogash.com/documentation/latest-posts/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
