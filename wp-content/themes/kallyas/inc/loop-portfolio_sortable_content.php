<?php
	global $zn_config;

	// GET THE ASSIGNED CATEGORIES
	$css_classes     = '';
	$item_categories = get_the_terms( get_the_ID(), 'project_category' );

	if ( is_object( $item_categories ) || is_array( $item_categories ) ) {
		foreach ( $item_categories as $cat ) {
			$css_classes .= $cat->slug . '_sort ';
		}
	}

?>

<li class="item kl-ptfsortable-item kl-has-overlay portfolio-item--overlay <?php echo $css_classes; ?> even" data-date="<?php the_time( 'U' ); ?>">

	<div class="inner-item kl-ptfsortable-item-inner">
        <div class="img-intro kl-ptfsortable-imgintro portfolio-item-overlay-imgintro">
		<?php
			$port_media = get_post_meta( get_the_ID(), 'zn_port_media', true );
			if ( ! empty ( $port_media ) && is_array( $port_media ) ) {

				$size      = zn_get_size( 'portfolio_sortable' );
				$has_image = false;
				// Modified portfolio display
				// Check to see if we have images
				if ( $portfolio_image = $port_media[0]['port_media_image_comb'] ) {

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
						$image = vt_resize( '', $saved_image, '', '', true );
					}
				}

				// Check to see if we have video
				if ( $portfolio_media = $port_media[0]['port_media_video_comb'] ) {
					$portfolio_media = str_replace( '', '&amp;', $portfolio_media );
				}

				// Display the media
				if ( ! empty( $saved_image ) && $portfolio_media ) {
					echo '<a href="' . $portfolio_media . '" data-mfp="iframe" data-lightbox="iframe" class="portfolio-item-link hoverLink"></a>';
					echo '<img class="kl-ptfsortable-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                    echo '<div class="portfolio-item-overlay">';
                    echo '<div class="portfolio-item-overlay-inner">';
                    echo '<span class="portfolio-item-overlay-icon glyphicon glyphicon-play"></span>';
                    echo '</div>';
                    echo '</div>';
				}
				elseif ( ! empty( $saved_image ) ) {

					if ( zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' ) == 'yes' ) {
						echo '<a href="' . get_permalink() . '" data-type="image" class="portfolio-item-link hoverLink"></a>';
						echo '<img class="kl-ptfsortable-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                        echo '<div class="portfolio-item-overlay">';
                        echo '<div class="portfolio-item-overlay-inner">';
                        echo '<span class="portfolio-item-overlay-icon glyphicon glyphicon-picture"></span>';
                        echo '</div>';
                        echo '</div>';
					}
					else {
						echo '<a href="' . $saved_image . '" data-type="image" data-lightbox="image" class="portfolio-item-link hoverLink"></a>';
						echo '<img class="kl-ptfsortable-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
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
			}
		?>
        </div>

		<h4 class="title kl-ptfsortable-item-title">
			<a href="<?php the_permalink(); ?>" class="kl-ptfsortable-item-title-link"><span class="name"><?php the_title(); ?></span></a>
		</h4>
        <?php
            $excerpt = get_the_excerpt();
            $excerpt = strip_shortcodes( $excerpt );
            $excerpt = strip_tags( $excerpt );
            $the_str = mb_substr( $excerpt, 0, 116 );

            $ptf_show_desc = isset($zn_config['ptf_show_desc']) && !empty($zn_config['ptf_show_desc']) ? $zn_config['ptf_show_desc'] : 'yes';

            if( $ptf_show_desc == 'yes' ){
	            if(! empty($the_str) ){
	        		echo '<div class="moduleDesc kl-ptfsortable-item-desc">'.$the_str . '...' . '</div>';
	        	}
        	} ?>
		<div class="clear"></div>
	</div>
	<!-- end ITEM (.inner-item) -->
</li>