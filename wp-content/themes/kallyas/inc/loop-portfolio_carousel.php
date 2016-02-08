<?php
    global $zn_config;
    $frame_style = !empty( $zn_config['frame_style'] ) ? $zn_config['frame_style'] : zget_option( 'frame_style', 'portfolio_options', false, 'classic' );

    // Load scripts required
    wp_enqueue_script( 'caroufredsel');
    wp_enqueue_script( 'isotope');

    // Check if PB Element has style selected, if not use Portfolio style option. If no blog style option, use Global site skin.
    $portfolio_scheme_global = zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) != '' ? zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
    $portfolio_scheme = isset($zn_config['portfolio_scheme']) && $zn_config['portfolio_scheme'] != '' ? $zn_config['portfolio_scheme'] : $portfolio_scheme_global;
?>
	<div class="hg-portfolio-carousel kl-ptfcarousel portfolio-crsl--<?php echo $portfolio_scheme; ?>">
		<?php
			if ( have_posts() ): while ( have_posts() ) : the_post();
				?>
                <div class="portfolio-item kl-ptfcarousel-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ptcontent">
                                <h3 class="title pt-content-title kl-ptfcarousel-item-title">
                                    <a href="<?php the_permalink(); ?>" class="kl-ptfcarousel-item-title-link">
                                        <span class="name kl-ptfcarousel-item-title-name"><?php the_title(); ?></span>
                                    </a>
                                </h3>
                                <div class="pt-cat-desc kl-ptfcarousel-item-desc">
                                    <?php
                                        if ( strpos( get_the_content(), 'more-link' ) !== false ) {
                                            the_content( '' );
                                        }
                                        else {
                                            the_excerpt();
                                        }
                                    ?>
                                </div>
                                <!-- end item desc -->

                                <?php
                                    // Get portfolio fields
                                    get_template_part( 'inc/details', 'portfolio-fields' );
                                ?>


                                <div class="pt-itemlinks itemLinks kl-ptfcarousel-item-links">
                                    <a class="btn btn-fullcolor " href="<?php the_permalink(); ?>">
                                        <?php _e('SEE MORE', 'zn_framework'); ?>
                                    </a>
                                    <?php
                                    $sp_link = get_post_meta(get_the_ID(), 'zn_sp_link', true);
                                    $sp_link_ext = zn_extract_link($sp_link, 'btn btn-lined '.($portfolio_scheme == 'light' ? 'lined-dark':'') );

                                    if (!empty ($sp_link_ext['start'])) {
                                        echo $sp_link_ext['start'] . __("LIVE PREVIEW", 'zn_framework') . $sp_link_ext['end'];
                                    }
                                    ?>
                                </div>
                                <!-- end item links -->
                            </div>
                            <!-- end item content -->
                        </div>
                        <div class="col-sm-6">
                            <div class="ptcarousel kl-ptfcarousel-carousel ptcarousel--frames-<?php echo $frame_style ?> kl-ptfcarousel-frame--<?php echo $frame_style ?>">

                                <?php
                                $port_media = get_post_meta(get_the_ID(), 'zn_port_media', true);
                                if (count( $port_media ) > 1) {
                                    ?>
                                    <div class=" controls kl-ptfcarousel-carousel-controls">
                                        <a href="#" class="prev kl-ptfcarousel-carousel-arr cfs--prev u-trans-all-2s"><span class="glyphicon glyphicon-chevron-left kl-icon-white"></span></a>
                                        <a href="#" class="next kl-ptfcarousel-carousel-arr cfs--next u-trans-all-2s"><span class="glyphicon glyphicon-chevron-right kl-icon-white"></span></a>
                                    </div>
                                <?php
                                }
                                ?>

                                <ul class="zn_general_carousel kl-ptfcarousel-carousel-list cfs--default">
                                    <?php
                                    if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
                                        foreach ( $port_media as $media ) {
                                            $size      = zn_get_size( 'eight' );
                                            $has_image = false;

                                            // Modified portfolio display
                                            // Check to see if we have images
                                            if ( $portfolio_image = $media['port_media_image_comb'] ) {

                                                if ( is_array( $portfolio_image ) ) {

                                                    if ( $saved_image = $portfolio_image['image'] ) {
                                                        if ( ! empty( $portfolio_image['alt'] ) ) {
                                                            $saved_alt = $portfolio_image['alt'];
                                                        }
                                                        else {
                                                            $saved_alt = '';
                                                        }

                                                        if ( ! empty( $portfolio_image['title'] ) ) {
                                                            $saved_title = 'title="' . $portfolio_image['title'] . '"';
                                                        }
                                                        else {
                                                            $saved_title = '';
                                                        }

                                                        $has_image = true;
                                                    }
                                                }
                                                else {
                                                    $saved_image = $portfolio_image;
                                                    $has_image   = true;
                                                    $saved_alt   = '';
                                                    $saved_title = '';
                                                }

                                                if ( $has_image ) {
                                                    $image = vt_resize( '', $saved_image, $size['width'], '', true );
                                                }
                                            }

                                            // Check to see if we have video
                                            if ( $portfolio_media = $media['port_media_video_comb'] ) {
                                                $portfolio_media = str_replace( '', '&amp;', $portfolio_media );
                                            }

                                            // Display the media
                                            echo '<li class="item kl-ptfcarousel-carousel-item kl-has-overlay portfolio-item--overlay cfs--item">';

                                                echo '<div class="img-intro portfolio-item-overlay-imgintro">';
                                                if ( ! empty( $saved_image ) && $portfolio_media ) {
                                                    echo '<a href="' . $portfolio_media . '" data-mfp="iframe" data-lightbox="iframe" class="portfolio-item-link"></a>';
                                                    echo '<img class="kl-ptfcarousel-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .  $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                                                    echo '<div class="portfolio-item-overlay">';
                                                    echo '<div class="portfolio-item-overlay-inner">';
                                                    echo '<span class="portfolio-item-overlay-icon glyphicon glyphicon-play"></span>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                elseif ( ! empty( $saved_image ) ) {
                                                    if (  zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' ) == 'yes' ) {
                                                        echo '<a href="' . get_permalink() . '" data-type="image" data-lightbox="image" class="portfolio-item-link"></a>';
                                                        echo '<img class="kl-ptfcarousel-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                                                        echo '<div class="portfolio-item-overlay">';
                                                        echo '<div class="portfolio-item-overlay-inner">';
                                                        echo '<span class="portfolio-item-overlay-icon glyphicon glyphicon-picture"></span>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    else {
                                                        echo '<a href="' . $saved_image . '" data-type="image" data-lightbox="image" class="portfolio-item-link"></a>';
                                                        echo '<img class="kl-ptfcarousel-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                                                        echo '<div class="portfolio-item-overlay">';
                                                        echo '<div class="portfolio-item-overlay-inner">';
                                                        echo '<span class="portfolio-item-overlay-icon glyphicon glyphicon-picture"></span>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                }
                                                elseif ( $portfolio_media ) {
                                                    echo get_video_from_link( $portfolio_media, '', $size['width'], $size['height'] );
                                                }
                                                echo '</div>';
                                            echo '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- end ptcarousel -->
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php endif; ?>
	</div>
	<!-- end portfolio layout -->
	<?php
		echo '<div class="clear"></div>';
		echo '<div class="col-sm-12 pagination--'.$portfolio_scheme.'">';
		    zn_pagination();
		echo '</div>';
	?>
