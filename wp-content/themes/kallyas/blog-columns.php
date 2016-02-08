<?php
	global $columns, $zn_config;

/*
 * Load resources in footer
 */
wp_enqueue_script('isotope');

$columns = !empty( $zn_config['blog_columns'] ) ? $zn_config['blog_columns'] : zget_option( 'blog_style_layout', 'blog_options', false, '1' );
$columns_size = 12 / ($columns ? $columns : 6); // prevent division by 0

// Check if PB Element has style selected, if not use Blog style option. If no blog style option, use Global site skin.
$blog_style = zget_option( 'blog_style', 'blog_options', false, '' ) != '' ? zget_option( 'blog_style', 'blog_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
if( isset( $zn_config['blog_style'] ) ){
    $blog_style = $zn_config['blog_style'] != '' ? $zn_config['blog_style'] : $blog_style;
}
?>
	<div class="itemListView clearfix eBlog kl-blog kl-blog-list-wrapper kl-blog--style-<?php echo $blog_style; ?>">

		<?php
			if ( have_posts() ) :

                echo '<div class="itemList zn_blog_columns kl-blog--columns">';

				while ( have_posts() ) {
					the_post();

					$image = '';

					$image_size = zn_get_size( 'span' . $columns_size );

					// Create the featured image html
					if ( has_post_thumbnail( get_the_id() ) ) {
						$thumb = get_post_thumbnail_id( get_the_id() );
						if ( ! empty ( $thumb ) ) {
                            $image = get_the_post_thumbnail(get_the_ID(), 'full', array('class'=>'kl-blog-item-thumbnail-img'));
							$image = '<a class="kl-blog-item-thumbnail-link" href="' . get_permalink() . '">'.$image.'</a>';
						}
					}
					elseif ( zget_option( 'zn_use_first_image', 'blog_options' , false, 'yes' ) == 'yes' ) {
						$f_image = echo_first_image();

						if ( ! empty ( $f_image ) ) {
                            $image = '<img class="kl-blog-item-thumbnail-img" src="' . $f_image . '" alt=""/>';
                            $image = '<a class="kl-blog-item-thumbnail-link" href="' . get_permalink() . '">'.$image.'</a>';
						}
					}
					?>
                    <div class="col-sm-6 col-lg-<?php echo $columns_size;?> blog-isotope-item kl-blog-column">
                        <div class="itemContainer kl-blog-item-container zn_columns zn_columns<?php echo $columns;?> post-<?php the_ID(); ?>">
                            <?php if( ! empty( $image ) ) : ?>
                            <div class="itemThumbnail kl-blog-item-thumbnail">
                                <?php echo $image; ?>
                                <div class="overlay kl-blog-item-overlay">
                                    <div class="overlay__inner kl-blog-item-overlay-inner">
                                        <a href="<?php the_permalink(); ?>" class="readMore kl-blog-item-overlay-more" title="" data-readmore="<?php echo __('Read More', 'zn_framework') ?>"></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="itemHeader kl-blog-item-header">
                                <h3 class="itemTitle kl-blog-item-title">
                                    <a href="<?php the_permalink(); ?>" class="kl-blog-item-title-link"><?php the_title();?></a>
                                </h3>

                                <div class="post_details kl-blog-item-details kl-font-alt">
    								<span class="catItemDateCreated kl-blog-item-date">
                                        <span class="kl-blog-item-dateicon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe109;"></span>
                                        <?php the_time( 'l, d F Y' );?>
                                    </span>
    								<span class="catItemAuthor kl-blog-item-author"><?php echo __( 'by', 'zn_framework' );?> <?php the_author_posts_link(); ?></span>
                                </div>
                                <!-- end post details -->
                            </div>
                            <!-- end itemHeader -->

                            <div class="itemBody kl-blog-item-body">
                                <div class="itemIntroText kl-blog-item-content">
                                    <?php the_excerpt(); ?>
                                </div>
                                <!-- end Item Intro Text -->
                                <div class="clearfix"></div>
                            </div>
                            <!-- end Item BODY -->

                            <ul class="itemLinks kl-blog-item-links kl-font-alt clearfix">
                                <li class="itemCategory kl-blog-item-category">
                                    <span class="kl-blog-item-category-icon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe117;"></span>
                                    <span class="kl-blog-item-category-text"><?php echo __( 'Published in', 'zn_framework' );?></span>
                                    <?php the_category( ", " ); ?>
                                </li>
                            </ul>
                            <!-- item links -->
                            <div class="clearfix"></div>
                            <?php if ( has_tag() ) { ?>
                                <div class="itemTagsBlock kl-blog-item-tags kl-font-alt">
                                    <span class="kl-blog-item-tags-icon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe042;"></span>
                                    <span class="kl-blog-item-tags-text"><?php echo __( 'Tagged under:', 'zn_framework' ); ?></span>
                                    <?php echo WpkZn::getPostTags(get_the_ID(), ', '); ?>
                                    <div class="clearfix"></div>
                                </div><!-- end tags blocks -->
                            <?php } ?>
                        </div><!-- end Blog Item -->
                    </div>
					<?php
				}

                echo '</div>';

			else: ?>
				<div class="itemContainer noPosts kl-blog-item-container kl-blog-item--noposts">
					<p><?php echo __( 'Sorry, no posts matched your criteria.', 'zn_framework' ); ?></p>
				</div><!-- end Blog Item -->
				<div class="clearfix"></div>
			<?php endif; ?>

		<!-- end .itemList -->

		<!-- Pagination -->
        <div class="pagination--<?php echo $blog_style; ?>">
            <?php zn_pagination(); ?>
        </div>
    </div>

