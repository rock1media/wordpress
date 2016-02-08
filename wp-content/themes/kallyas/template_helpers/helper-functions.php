<?php if(! defined('ABSPATH')) { return; }
/**
 * Custom Classes
 *
 * @package  Kallyas
 * @category Custom Classes
 * @author Team Hogash
 * @since 3.8.0
 */

if(! class_exists('WpkZn'))
{
	/**
	 * Class WpkZn
	 *
	 * @category Custom Classes
	 * @author Team Hogash
	 */
	class WpkZn
	{

		/**
		 * Retrieve all sidebars from the theme.
		 * @since 4.0.0
		 * @return array
		 */
		public static function getThemeSidebars(){
			$sidebars = array ();
			$sidebars['defaultsidebar'] = __( 'Default Sidebar', 'zn_framework' );
			if ( $unlimited_sidebars = zget_option( 'unlimited_sidebars', 'unlimited_sidebars' ) ) {
				foreach ( $unlimited_sidebars as $sidebar ) {
					if (isset($sidebar['sidebar_name']) && !empty($sidebar['sidebar_name'])) {
						$sidebars[ $sidebar['sidebar_name'] ] = $sidebar['sidebar_name'];
					}
				}
			}
			return $sidebars;
		}

		/**
		 * Retrieve all headers from the theme.
		 * @since 4.0.0
		 * @return array
		 */
		public static function getThemeHeaders( $addnone = false ){

			$headers = array ();
			if($addnone == true){
				$headers[0] = 'None';
			}
			$headers['zn_def_header_style'] = __( 'Default style', 'zn_framework' );
			$saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );
			foreach ( $saved_headers as $header ) {
				if ( isset ( $header['uh_style_name'] ) && ! empty ( $header['uh_style_name'] ) ) {
					$header_name                   = strtolower( str_replace( ' ', '_', $header['uh_style_name'] ) );
					$headers[ $header_name ] = $header['uh_style_name'];
				}
			}

			return $headers;
		}

		/**
		 * Retrieve all blog categories as an associative array: id => name
		 * @since 4.0.0
		 * @return array
		 */
		public static function getBlogCategories(){
			$args = array (
				'type'         => 'post',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'category',
				'pad_counts'   => false
			);
			$blog_categories = get_categories( $args );

			$categories = array ();
			foreach ( $blog_categories as $category ) {
				$categories[ $category->cat_ID ] = $category->cat_name;
			}
			return $categories;
		}

		/**
		 * Retrieve all shop categories as an associative array: id => name
		 * @requires plugin WooCommerce installed and active
		 * @since 4.0.0
		 * @return array
		 */
		public static function getShopCategories(){
			$args = array (
				'type'         => 'shop',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'product_cat',
				'pad_counts'   => false
			);

			$shop_categories = get_categories( $args );

			$categories = array ();
			if ( ! empty( $shop_categories ) ) {
				foreach ( $shop_categories as $category ) {
					if ( isset( $category->cat_ID ) && isset( $category->cat_name ) ) {
						$categories[ $category->cat_ID ] = $category->cat_name;
					}
				}
			}
			return $categories;
		}

		/**
		 * Retrieve the list of all Portfolio Categories
		 * @since 4.0.0
		 * @return array
		 */
		public static function getPortfolioCategories(){
			$args = array (
				'type'         => 'portfolio',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'project_category',
				'pad_counts'   => false
			);
			$port_categories = get_categories( $args );
			$categories = array ();
			if ( ! empty( $port_categories ) ) {
				foreach ( $port_categories as $category ) {
					if ( isset( $category->cat_ID ) && isset( $category->cat_name ) ) {
						$categories[ $category->cat_ID ] = $category->cat_name;
					}
				}
			}
			return $categories;
		}

        /**
         * Retrieve the list of tags (as links) for the specified post
         * @param int $postID
         * @param string $sep The separator
         * @return string
         */
        public static function getPostTags($postID, $sep = '')
        {
            $out = '';
            $tagsArray = array();
            $tags = wp_get_post_tags($postID, array('orderby' => 'name', 'order' => 'ASC'));
            if(empty($tags)){
                return $out;
            }
            foreach($tags as $tag){
                $tagsArray[$tag->name] = get_tag_link($tag->term_id);
            }
            foreach($tagsArray as $name => $link){
                $out .= '<a class="kl-blog-tag" href="'.$link.'" rel="tag">'.$name.'</a>';
                if(! empty($sep)){
                    $out .= $sep;
                }
            }
            $out = rtrim($out, $sep);
            return $out;
        }
	}

}



if(! class_exists('WpkPageHelper')) {
    /**
     * Class WpkPageHelper
     *
     * Helper class to manage various aspects from pages
     *
     * @package  Kallyas
     * @category UI
     * @author   Team Hogash
     * @since    4.0.0
     */
    class WpkPageHelper
    {

        /**
         * Display the proper sub-header based on the provided arguments
         *
         * @param array $args The list of arguments
         */
        public static function zn_get_subheader( $args = array() )
        {
            $id = zn_get_the_id();

            $defaults = array(
                'headerClass' => 'zn_def_header_style',
                'title' => get_the_title( $id ),
                'layout' => zget_option( 'zn_disable_subheader', 'general_options' ),
                'def_header_bread' => zget_option( 'def_header_bread', 'general_options', false, 1 ),
                'def_header_date' => zget_option( 'def_header_date', 'general_options', false, 1 ),
                'def_header_title' => zget_option( 'def_header_title', 'general_options', false, 1 ),
                'show_subtitle' => zget_option( 'def_header_subtitle', 'general_options', false, true ),
                'extra_css_class' => '',
                'bottommask' => zget_option( 'def_bottom_style', 'general_options', false, 'none' ),
                'bg_source' => '',
                'is_element' => false,
                'inherit_head_pad' => true,
                'title_heading' => 'h2',
           );

            $saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );

            // Combine defaults with the options saved in post meta
            if ( is_singular() ) {
            // if ( is_singular() || is_home() || is_shop() ) {
                $post_defaults = array();
                $title_bar_layout = get_post_meta( $id, 'zn_zn_disable_subheader', true );
                if ( !empty( $title_bar_layout ) ) {
                    $post_defaults = array( 'layout' => $title_bar_layout,
                                            'subtitle' => get_post_meta( $id, 'zn_page_subtitle', true ), );
                    $saved_title = get_post_meta( $id, 'zn_page_title', true );
                    if ( !empty( $saved_title ) ) {
                        $post_defaults['title'] = $saved_title;
                    }
                }
                // Sub-header style
                $zn_subheader_style = get_post_meta( $id, 'zn_subheader_style', true );
                if ( !empty( $zn_subheader_style ) ) {
                    $post_defaults['headerClass'] = 'uh_' . $zn_subheader_style;
                }

                // Get Subheader settings from Unlimited Subheader style
                foreach ( $saved_headers as $header ) {
                    if ( isset ( $header['uh_style_name'] ) && ! empty ( $header['uh_style_name'] ) ) {
                        $header_name = strtolower( str_replace( ' ', '_', $header['uh_style_name'] ) );
                        if($zn_subheader_style == $header_name){
                            $defaults['bottommask'] = $header['uh_bottom_style'];
                        }
                    }
                }

                $defaults = wp_parse_args( $post_defaults, $defaults );
            }
            elseif ( is_tax() || is_category() ) {
                global $wp_query;
                $cat = $wp_query->get_queried_object();
                if ( $cat && isset( $cat->term_id ) ) {
                    $id = $cat->term_id;
                    $ch = get_option( 'wpk_zn_select_custom_header_' . $id, false );
                    if ( !empty( $ch ) ) {

                        if ( 'zn_def_header_style' != $ch ) {
                            $defaults['headerClass'] = 'uh_' . $ch;
                        }

                        // Get Subheader settings from Unlimited Subheader style
                        foreach ( $saved_headers as $header ) {
                            if ( isset ( $header['uh_style_name'] ) && ! empty ( $header['uh_style_name'] ) ) {
                                $header_name = strtolower( str_replace( ' ', '_', $header['uh_style_name'] ) );
                                if($ch == $header_name){
                                    $defaults['bottommask'] = $header['uh_bottom_style'];
                                }
                            }
                        }

                    }
                }
            }
            $args = wp_parse_args( $args, $defaults );
            $args = apply_filters( 'zn_sub_header', $args );

            // If the subheader shouldn't be shown
            if ( $args['layout'] == 'yes' ) {
                return;
            }

            $extra_classes = array();

            $bottom_mask = $args['bottommask'];
            if ( $bottom_mask != 'none' ) {
                $extra_classes[] = 'maskcontainer--' . $bottom_mask;
            }

            $is_element = $args['is_element'];
            if ( $is_element ) {
                $extra_classes[] = 'page-subheader--custom';
            }
            else {
                $extra_classes[] = 'page-subheader--auto';
            }

            // Inherit heading & padding from Unlimited Subheader styles
            // Enabled by default for autogenerated pages and via option in Custom Subheader Element
            $inherit_head_pad = $args['inherit_head_pad'];
            if ( $inherit_head_pad ) {
                $extra_classes[] = 'page-subheader--inherit-hp';
            }

            $extra_classes[] = $args['headerClass'];
            $extra_classes[] = $args['extra_css_class'];

            // Get Site Header's Position (relative | absolute)
            $header_pos = 'psubhead-stheader--absolute';
            $headerLayoutStyle = zget_option( 'zn_header_layout', 'general_options', false, 'style2' );
            if ( zget_option( 'head_position', 'general_options', false, '1' ) != 1 ) {
                if ( $headerLayoutStyle != 'style7' ) {
                    $header_pos = 'psubhead-stheader--relative';
                }
            }
            $extra_classes[] = $header_pos;




            ?>
            <div id="page_header" class="page-subheader <?php echo implode(' ', $extra_classes); ?>">

                <div class="bgback"></div>

                <?php
                $bg_source = $args['bg_source'];
                if ( !empty( $bg_source ) && is_array( $bg_source ) ) {
                    WpkPageHelper::zn_background_source( $bg_source );
                }
                ?>

                <div class="th-sparkles"></div>

                <!-- DEFAULT HEADER STYLE -->
                <div class="ph-content-wrap">
                    <div class="ph-content-v-center">
                        <div>
                            <div class="container">
                                <div class="row">
                                    <?php
                                    $br_date = (int)$args['def_header_bread'] || (int)$args['def_header_date'] ;
                                    $def_cols = $br_date ? 6 : 12;

                                    if($br_date){
                                    ?>
                                    <div class="col-sm-6">
                                        <?php
                                        if ( (int)$args['def_header_bread'] ) {
                                            zn_breadcrumbs();
                                        }
                                        else {
                                            echo '&nbsp;';
                                        }
                                        if ( (int)$args['def_header_date'] ) {
                                            echo '<span id="current-date" class="subheader-currentdate hidden-xs">' .
                                                 date_i18n( get_option( 'date_format' ), strtotime( date( "l M d, Y" ) . get_option( 'gmt_offset' ) ), false ) . '</span>';
                                        }
                                        else {
                                            echo '&nbsp;';
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-sm-<?php echo $def_cols; ?>">
                                        <div class="subheader-titles">

                                            <?php if ( !empty ( $args['def_header_title'] ) ) : ?>
                                                <<?php echo $args['title_heading']; ?> class="subheader-maintitle">
                                                    <?php
                                                    echo $args['title'];
                                                    ?>
                                                </<?php echo $args['title_heading']; ?>>
                                            <?php endif; ?>

                                            <?php
                                            if ( ( isset( $args['show_subtitle'] ) && $args['show_subtitle'] ) &&
                                                 !empty ( $args['subtitle'] )
                                            ): ?>
                                                <h4 class="subheader-subtitle">
                                                    <?php
                                                    echo do_shortcode( $args['subtitle'] );
                                                    ?>
                                                </h4>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                WpkPageHelper::zn_bottommask_markup( $bottom_mask );
                ?>
            </div>
            <?php
        }

        /**
         * Display the custom bottom mask markup
         *
         * @param  [type] $bm The mask ID
         *
         * @return [type]     HTML Markup to be used as mask
         */
        public static function zn_bottommask_markup( $bm, $bgcolor = false )
        {
            $bgfill = isset( $bgcolor ) && !empty( $bgcolor ) ? 'style="fill:' . $bgcolor . '"' : '';
            $mk = '';
            if ( $bm == 'none' ) {
                $mk .= '<div class="zn_header_bottom_style"></div>';
            }
            else {
                $mk .= '<div class="kl-bottommask kl-bottommask--' . $bm . ' kl-mask--' .
                       zget_option( 'zn_main_style', 'color_options', false, 'light' ) . '">';
                if ( $bm == 'mask3' || $bm == 'mask3 mask3l' || $bm == 'mask3 mask3r' ) {
                    $alignment = '';
                    if ( $bm == 'mask3 mask3l' ) {
                        $alignment = 'svgmask-left';
                    }
                    elseif ( $bm == 'mask3 mask3r' ) {
                        $alignment = 'svgmask-right';
                    }
                    $mk .= '
<svg width="5000px" height="57px" class="svgmask ' . $alignment . '" viewBox="0 0 5000 57" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-mask3">
            <feOffset dx="0" dy="3" in="SourceAlpha" result="shadowOffsetInner1"></feOffset>
            <feGaussianBlur stdDeviation="2" in="shadowOffsetInner1" result="shadowBlurInner1"></feGaussianBlur>
            <feComposite in="shadowBlurInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowInnerInner1"></feComposite>
            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.4 0" in="shadowInnerInner1" type="matrix" result="shadowMatrixInner1"></feColorMatrix>
            <feMerge>
                <feMergeNode in="SourceGraphic"></feMergeNode>
                <feMergeNode in="shadowMatrixInner1"></feMergeNode>
            </feMerge>
        </filter>
    </defs>
    <path d="M9.09383679e-13,57.0005249 L9.09383679e-13,34.0075249 L2418,34.0075249 L2434,34.0075249 C2434,34.0075249 2441.89,33.2585249 2448,31.0245249 C2454.11,28.7905249 2479,11.0005249 2479,11.0005249 L2492,2.00052487 C2492,2.00052487 2495.121,-0.0374751261 2500,0.000524873861 C2505.267,-0.0294751261 2508,2.00052487 2508,2.00052487 L2521,11.0005249 C2521,11.0005249 2545.89,28.7905249 2552,31.0245249 C2558.11,33.2585249 2566,34.0075249 2566,34.0075249 L2582,34.0075249 L5000,34.0075249 L5000,57.0005249 L2500,57.0005249 L1148,57.0005249 L9.09383679e-13,57.0005249 Z" class="bmask-bgfill" filter="url(#filter-mask3)" fill="#f5f5f5" ' .
                           $bgfill . '></path>
</svg>
    <i class="glyphicon glyphicon-chevron-down"></i>
    ';
                }
                else if ( $bm == 'mask4' || $bm == 'mask4 mask4l' || $bm == 'mask4 mask4r' ) {
                    $alignment = '';
                    if ( $bm == 'mask4 mask4l' ) {
                        $alignment = 'svgmask-left';
                    }
                    elseif ( $bm == 'mask4 mask4r' ) {
                        $alignment = 'svgmask-right';
                    }
                    $mk .= '
<svg width="5000px" height="27px" class="svgmask ' . $alignment . '" viewBox="0 0 5000 27" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-mask4">
            <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetInner1"></feOffset>
            <feGaussianBlur stdDeviation="1.5" in="shadowOffsetInner1" result="shadowBlurInner1"></feGaussianBlur>
            <feComposite in="shadowBlurInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowInnerInner1"></feComposite>
            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.35 0" in="shadowInnerInner1" type="matrix" result="shadowMatrixInner1"></feColorMatrix>
            <feMerge>
                <feMergeNode in="SourceGraphic"></feMergeNode>
                <feMergeNode in="shadowMatrixInner1"></feMergeNode>
            </feMerge>
        </filter>
    </defs>
    <path d="M3.63975516e-12,-0.007 L2418,-0.007 L2434,-0.007 C2434,-0.007 2441.89,0.742 2448,2.976 C2454.11,5.21 2479,15 2479,15 L2492,21 C2492,21 2495.121,23.038 2500,23 C2505.267,23.03 2508,21 2508,21 L2521,15 C2521,15 2545.89,5.21 2552,2.976 C2558.11,0.742 2566,-0.007 2566,-0.007 L2582,-0.007 L5000,-0.007 L5000,27 L2500,27 L3.63975516e-12,27 L3.63975516e-12,-0.007 Z" class="bmask-bgfill" filter="url(#filter-mask4)" fill="#f5f5f5" ' .
                           $bgfill . '></path>
</svg>';
                }
                else if ( $bm == 'mask5' ) {
                    $mk .= '
<svg width="2700px" height="64px" class="svgmask" viewBox="0 0 2700 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-mask5">
            <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetInner1"></feOffset>
            <feGaussianBlur stdDeviation="1.5" in="shadowOffsetInner1" result="shadowBlurInner1"></feGaussianBlur>
            <feComposite in="shadowBlurInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowInnerInner1"></feComposite>
            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.45 0" in="shadowInnerInner1" type="matrix" result="shadowMatrixInner1"></feColorMatrix>
            <feMerge>
                <feMergeNode in="SourceGraphic"></feMergeNode>
                <feMergeNode in="shadowMatrixInner1"></feMergeNode>
            </feMerge>
        </filter>
    </defs>
    <path d="M1892,0 L2119,44.993 L2701,45 L2701.133,63.993 L-0.16,63.993 L1.73847048e-12,45 L909,44.993 L1892,0 Z" class="bmask-bgfill" fill="#f5f5f5" filter="url(#filter-mask5)" ' .
                           $bgfill . '></path>
    <path d="M2216,44.993 L2093,55 L1882,6 L995,62 L966,42 L1892,0 L2118,44.993 L2216,44.993 L2216,44.993 Z" fill="#cd2122" class="bmask-customfill" filter="url(#filter-mask5)"></path>
</svg>';
                }
                else if ( $bm == 'mask6' ) {
                    $mk .= '
<svg width="2700px" height="57px" class="svgmask" viewBox="0 0 2700 57" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" >
    <defs>
        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-mask6">
            <feOffset dx="0" dy="-2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
            <feGaussianBlur stdDeviation="2" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.5 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1"></feColorMatrix>
            <feMerge>
                <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
            </feMerge>
        </filter>
    </defs>
    <g transform="translate(-1.000000, 10.000000)">
        <path d="M0.455078125,18.5 L1,47 L392,47 L1577,35 L392,17 L0.455078125,18.5 Z" fill="#000000"></path>
        <path d="M2701,0.313493752 L2701,47.2349598 L2312,47 L391,47 L2312,0 L2701,0.313493752 Z" fill="#f5f5f5" class="bmask-bgfill" filter="url(#filter-mask6)" ' .
                           $bgfill . '></path>
        <path d="M2702,3 L2702,19 L2312,19 L1127,33 L2312,3 L2702,3 Z" fill="#cd2122" class="bmask-customfill"></path>
    </g>
</svg>';
                }
                $mk .= '</div>';
            }
            echo $mk;
        }

        /**
         * Display the custom bottom mask markup
         *
         * @param  [type] $bm The mask ID
         *
         * @return [type]     HTML Markup to be used as mask
         */
        public static function zn_background_source( $args = array() )
        {
            $defaults = array( 'source_type' => '',
                               'source_background_image' => array( 'image' => '',
                                                                   'repeat' => 'repeat',
                                                                   'attachment' => 'scroll',
                                                                   'position' => array( 'x' => 'left',
                                                                                        'y' => 'top' ),
                                                                   'size' => 'auto', ),
                               'source_vd_yt' => '',
                               'source_vd_self_mp4' => '',
                               'source_vd_self_ogg' => '',
                               'source_vd_self_webm' => '',
                               'source_vd_embed_iframe' => '',
                               'source_vd_vp' => '',
                               'source_vd_autoplay' => 'yes',
                               'source_vd_loop' => 'yes',
                               'source_vd_muted' => 'yes',
                               'source_vd_controls' => 'yes',
                               'source_vd_controls_pos' => 'bottom-right',
                               'source_overlay' => 0,
                               'source_overlay_color' => '',
                               'source_overlay_opacity' => 30,
                               'source_overlay_color_gradient' => '',
                               'source_overlay_color_gradient_opac' => 30,
                               'source_overlay_gloss' => '',
                               'enable_parallax' => '', );
            $args = wp_parse_args( $args, $defaults );
            $bg_source = '';
            $sourceType = $args['source_type'];
            if ( $sourceType ):
                if ( $sourceType == 'image' ) {
                    $background_styles = array();
                    $background_image = $args['source_background_image']['image'];
                    $background_styles[] = 'background-image:url(' . $args['source_background_image']['image'] . ')';
                    $background_styles[] = 'background-repeat:' . $args['source_background_image']['repeat'];
                    $background_styles[] = 'background-attachment:' . $args['source_background_image']['attachment'];
                    $background_styles[] =
                        'background-position:' . $args['source_background_image']['position']['x'] . ' ' .
                        $args['source_background_image']['position']['y'];
                    $background_styles[] = 'background-size:' . $args['source_background_image']['size'];
                    if ( !empty( $background_image ) ) {
                        $bg_details = 'style="' . implode( ';', $background_styles ) . '"';
                        if ( $args['enable_parallax'] == 'yes' ) {
                            $bg_details = 'data-parallax="scroll" data-image-src="' . $background_image . '"';
                        }
                        $bg_source .= '<div class="kl-bg-source__bgimage" ' . $bg_details . '></div>';
                    }
                }
                else if ( $sourceType == 'video_self' || $sourceType == 'video_youtube' ) {
                    // Source Video
                    $bg_source .= '
                <div class="kl-video-container kl-bg-source__video">
                    <div class="kl-video-wrapper video-grid-overlay">
                ';
                    if ( $sourceType == 'video_self' ) {
                        $bg_source .= '
                        <!-- Self Hosted Video Source -->
                        <div
                            class="kl-video valign halign"
                            style="width: 100%; height: 100%;"
                            data-setup=\'{
                                "position": "absolute",
                                "loop": ' . ( $args['source_vd_loop'] == 'yes' ? 'true' : 'false' ) . ',
                                "autoplay": ' . ( $args['source_vd_autoplay'] == 'yes' ? 'true' : 'false' ) . ',
                                "muted": ' . ( $args['source_vd_muted'] == 'yes' ? 'true' : 'false' ) . ',
                                ' . ( $args['source_vd_self_mp4'] ? '"mp4":"' . $args['source_vd_self_mp4'] . '",' :
                                '' ) . '
                                ' . ( $args['source_vd_self_webm'] ? '"webm":"' . $args['source_vd_self_webm'] . '",' :
                                '' ) . '
                                ' . ( $args['source_vd_self_ogg'] ? '"ogg":"' . $args['source_vd_self_ogg'] . '",' :
                                '' ) . '
                                ' . ( $args['source_vd_vp'] ? '"fallback_image":"' . $args['source_vd_vp'] . '",' :
                                '' ) . '
                                "video_ratio": "1.7778"
                            }\'
                        ></div>';
                    }
                    elseif ( $sourceType == 'video_youtube' ) {
                        $bg_source .= '
                        <!-- Youtube Source -->
                        <div
                            class="kl-video valign halign"
                            style="width: 100%; height: 100%;"
                            data-setup=\'{
                                "position": "absolute",
                                "loop": ' . ( $args['source_vd_loop'] == 'yes' ? 'true' : 'false' ) . ',
                                "autoplay": ' . ( $args['source_vd_autoplay'] == 'yes' ? 'true' : 'false' ) . ',
                                "muted": ' . ( $args['source_vd_muted'] == 'yes' ? 'true' : 'false' ) . ',
                                ' . ( $args['source_vd_yt'] ? '"youtube":"' . $args['source_vd_yt'] . '",' : '' ) . '
                                ' . ( $args['source_vd_vp'] ? '"fallback_image":"' . $args['source_vd_vp'] . '",' :
                                '' ) . '
                                "video_ratio": "1.7778"
                            }\'
                        ></div>';
                    }
                    if ( $args['source_vd_controls'] == 'yes' ) {
                        $bg_source .= '
                    <ul class="kl-video--controls" data-position="' . $args['source_vd_controls_pos'] . '">
                        <li><a href="#" class="btn-toggleplay"><i class="kl-icon glyphicon glyphicon-play circled-icon"></i></a></li>
                        <li><a href="#" class="btn-audio"><i class="kl-icon glyphicon glyphicon-volume-up circled-icon ci-xsmall"></i></a></li>
                    </ul>';
                    }
                    $bg_source .= '
                    </div>
                    <!-- // video-wrapper -->
                </div>
                <!-- // video-container -->
                ';
                }
                else if ( $sourceType == 'embed_iframe' ) {
                    $source_vd_embed_iframe = $args['source_vd_embed_iframe'];
                    if ( !empty( $source_vd_embed_iframe ) ) {
                        // Source Video
                        $bg_source .= '<div class="kl-bg-source__iframe">';
                        $bg_source .= get_video_from_link( $source_vd_embed_iframe, 'no-adjust', '100%' );
                        $bg_source .= '</div>';
                    }
                }
            endif;
            // Overlays
            if ( $args['source_overlay'] != 0 ) {
                $overlay_color = $args['source_overlay_color'];
                $overlay_opac = $args['source_overlay_opacity'];
                $overlay_color_final = zn_hex2rgba_str( $overlay_color, $overlay_opac );
                $ovstyle = 'background-color:' . $overlay_color_final;
                // Gradient
                if ( $args['source_overlay'] == 2 || $args['source_overlay'] == 3 ) {
                    $gr_overlay_color = $args['source_overlay_color_gradient'];
                    $overlay_gr_opac = $args['source_overlay_color_gradient_opac'];
                    $gr_overlay_color_final = zn_hex2rgba_str( $gr_overlay_color, $overlay_gr_opac );
                    // Gradient Horizontal
                    if ( $args['source_overlay'] == 2 ) {
                        $ovstyle = 'background:' . $overlay_color_final . '; background: -moz-linear-gradient(left, ' .
                                   $overlay_color_final . ' 0%, ' . $gr_overlay_color_final .
                                   ' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,' .
                                   $overlay_color_final . '), color-stop(100%,' . $gr_overlay_color_final .
                                   ')); background: -webkit-linear-gradient(left, ' . $overlay_color_final . ' 0%,' .
                                   $gr_overlay_color_final . ' 100%); background: -o-linear-gradient(left, ' .
                                   $overlay_color_final . ' 0%,' . $gr_overlay_color_final .
                                   ' 100%); background: -ms-linear-gradient(left, ' . $overlay_color_final . ' 0%,' .
                                   $gr_overlay_color_final . ' 100%); background: linear-gradient(to right, ' .
                                   $overlay_color_final . ' 0%,' . $gr_overlay_color_final . ' 100%); ';
                    }
                    // Gradient Vertical
                    if ( $args['source_overlay'] == 3 ) {
                        $ovstyle = 'background: ' . $overlay_color_final . '; background: -moz-linear-gradient(top,  ' .
                                   $overlay_color_final . ' 0%, ' . $gr_overlay_color_final .
                                   ' 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' .
                                   $overlay_color_final . '), color-stop(100%,' . $gr_overlay_color_final .
                                   ')); background: -webkit-linear-gradient(top,  ' . $overlay_color_final . ' 0%,' .
                                   $gr_overlay_color_final . ' 100%); background: -o-linear-gradient(top,  ' .
                                   $overlay_color_final . ' 0%,' . $gr_overlay_color_final .
                                   ' 100%); background: -ms-linear-gradient(top,  ' . $overlay_color_final . ' 0%,' .
                                   $gr_overlay_color_final . ' 100%); background: linear-gradient(to bottom,  ' .
                                   $overlay_color_final . ' 0%,' . $gr_overlay_color_final . ' 100%); ';
                    }
                }
                $bg_source .= '<div class="kl-bg-source__overlay" style="' . $ovstyle . '"></div>';
            }
            // Gloss Overlays
            if ( $args['source_overlay_gloss'] == 1 ) {
                $bg_source .= '<div class="kl-bg-source__overlay-gloss"></div>';
            }
            if ( $bg_source != '' ) {
                echo '<div class="kl-bg-source">' . $bg_source . '</div>';
            }
        }

        /**
         * Display the page header for Documentation pages
         * Will be removed in 4.1
         *
         * @internal
         * @deprecated 4.0.11
         */
        public static function zn_get_documentation_header(){}

        /**
         * Display the site header
         * Will be removed in 4.1
         *
         * @since 4.0
         * @deprecated 4.0.10
         */
        public static function displaySiteHeader(){}
    }
}
