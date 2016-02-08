<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Recent Work 3
 Description: Create and display a Recent Work 3 element
 Class: TH_RecentWork3
 Category: content
 Level: 3
 Scripts: true
*/
/**
 * Class TH_RecentWork3
 *
 * Create and display a Recent Work 3 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_RecentWork3 extends ZnElements
{
	public static function getName(){
		return __( "Recent Work 3", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		$saved_alt = $saved_title = '';
		$rwheight = (int)$this->opt('rw_height',165);

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = $this->opt('css_class','');

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'recentwork3--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		// [wpk]
		// @since 4.0.9
		$autoplay = ($this->opt('rw3_slider_autoplay', 1) == 1 ? 1 : 0);
		$timeout = $this->opt('rw3_slider_timeout', 5000);
		?>

			<div class="recentwork_carousel recentwork_carousel_v3 <?php echo implode(' ', $elm_classes); ?>">

				<div class="container recentwork_carousel__top-container">
					<div class="row">
						<div class="col-sm-12">
							<?php
								// ELEMENT TITLE
								if ( ! empty ( $options['rw_title'] ) ) {
									echo '<h3 class="recentwork_carousel__title element-scheme__hdg1">' . $options['rw_title'] . '</h3>';
								}

								// PORTFOLIO PAGE LINK
								if ( ! empty ( $options['rw_port_link'] ) ) {
									echo '<a href="' . $options['rw_port_link'] . '" class="btn btn-link">'. $this->opt('rw_port_link_text', 'VIEW ALL') .'</a>';
								}
							?>

							<div class="controls recentwork_carousel__controls">
								<a href="#" class="prev recentwork_carousel__prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
								<a href="#" class="next recentwork_carousel__next"><span class="glyphicon glyphicon-chevron-right"></span></a>
							</div>
						</div>
					</div>
				</div>

				<div class="work-carousel recentwork_carousel__crsl-wrapper">
					<ul class="recent_works3 recentwork_carousel__crsl clearfix"
						data-autoplay="<?php echo $autoplay;?>"
						data-timeout="<?php echo $timeout;?>">
						<?php
							global $post;
							$posts_per_page = $this->opt('ports_per_page', '6');
							$portfolio_categories = $this->opt('portfolio_categories');

							// Start the query
							$queryArgs = array (
								'post_type'      => 'portfolio',
								'post_status'    => 'publish',
								'posts_per_page' => $posts_per_page,
							);

							if( ! empty( $portfolio_categories ) ){
								$queryArgs['tax_query'] = array(
									array(
										'taxonomy' => 'project_category',
										'field'    => 'term_id',
										'terms'    => $portfolio_categories
									)
								);
							}

							$theQuery = new WP_Query($queryArgs);

							// Start the loop
							if( $theQuery->have_posts() ) {

								while($theQuery->have_posts()){
									$theQuery->the_post();

									echo '<li>';

									echo '<a href="' . get_permalink() . '" class="recentwork_carousel__link">';

										$pevents = false;
										$port_media = get_post_meta( $post->ID, 'zn_port_media', true );
										if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
											$size      = zn_get_size( 'four' );
											$has_image = false;
											if ( $portfolio_image = $port_media[0]['port_media_image_comb'] ) {
												if ( is_array( $portfolio_image ) ) {
													$saved_image = $portfolio_image['image'];
													$saved_title = 'title="' . $portfolio_image['title'] . '"';
												}
												else {
													$saved_image = $portfolio_image;
													$saved_title = '';
												}
											}

											// Check to see if we have video
											if ( $portfolio_media = $port_media[0]['port_media_video_comb'] ) {
											}

											// IMAGE
											if ( ! empty( $saved_image ) ) {
												echo '<div style="height: '.$rwheight.'px; background-image:url(' . $saved_image . ');" ' . $saved_title . ' class="recentwork_carousel__img"></div>';
											}
											elseif ( $portfolio_media ) {
												echo get_video_from_link( $portfolio_media, '', '100%', $rwheight );
												$pevents = true;
											}
										}
										// Details
										echo '<div class="details recentwork_carousel__details '.($pevents ? 'nopointer':'').'">';

											// GET ALL POST CATEGORIES
											echo '<span class="recentwork_carousel__cat">' . strip_tags( get_the_term_list( $post->ID, 'project_category', '', ' , ', '' ) ) . '</span>';

											// GET THE POST TITLE
											echo '<h4 class="recentwork_carousel__crsl-title">' . get_the_title() . '</h4>';

										echo '</div>';

									echo '</a>';

									echo '</li>';
								} // end while
								// wp_reset_query();
								wp_reset_postdata();
							} // end if has posts

						?>
					</ul>
				</div>
		</div><!-- end -->

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
						"name"        => __( "Recent Works Items Height", 'zn_framework' ),
						"description" => __( "Enter a height for the carousel items", 'zn_framework' ),
						"id"          => "rw_height",
						"std"         => "165",
						"type"        => "text",
						"placeholder" => "ex: 165px"
					),
					array (
						"name"        => __( "Recent Works Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Recent Works element", 'zn_framework' ),
						"id"          => "rw_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Portfolio page link", 'zn_framework' ),
						"description" => __( "Please enter the link to your portfolio page.", 'zn_framework' ),
						"id"          => "rw_port_link",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Portfolio text button", 'zn_framework' ),
						"description" => __( "Please enter the text for the link to your portfolio page.", 'zn_framework' ),
						"id"          => "rw_port_link_text",
						"std"         => "VIEW ALL",
						"type"        => "text"
					),
					array (
						"name"        => __( "Portfolio Category", 'zn_framework' ),
						"description" => __( "Select the portfolio category to show items", 'zn_framework' ),
						"id"          => "portfolio_categories",
						"multiple"    => true,
						"std"         => '0',
						"type"        => "select",
						"options"     => WpkZn::getPortfolioCategories(),
					),
					array (
						"name"        => __( "Number of portfolio Items", 'zn_framework' ),
						"description" => __( "Please enter how many portfolio items you want to load.", 'zn_framework' ),
						"id"          => "ports_per_page",
						"std"         => '6',
						"type"        => "text"
					),
					array (
						"name"        => __( "Autoplay carousel?", 'zn_framework' ),
						"description" => __( "Does the carousel autoplay itself?", 'zn_framework' ),
						"id"          => "rw3_slider_autoplay",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),
					array (
						"name"        => __( "Timout duration", 'zn_framework' ),
						"description" => __( "The amount of milliseconds the carousel will pause", 'zn_framework' ),
						"id"          => "rw3_slider_timeout",
						"std"         => "5000",
						"type"        => "text"
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
									'val_prepend'  => 'recentwork3--',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#LQGGXfZhi_8',
				'docs'    => 'http://support.hogash.com/documentation/recent-work/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
