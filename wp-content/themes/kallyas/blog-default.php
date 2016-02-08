<?php
    global $hasSidebar, $zn_config;

// Check if PB Element has style selected, if not use Blog style option. If no blog style option, use Global site skin.
$blog_style_global = zget_option( 'blog_style', 'blog_options', false, '' ) != '' ? zget_option( 'blog_style', 'blog_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
$blog_style = isset($zn_config['blog_style']) && $zn_config['blog_style'] != '' ? $zn_config['blog_style'] : $blog_style_global;

?>
<div class="itemListView eBlog kl-blog kl-blog-list-wrapper kl-blog--style-<?php echo $blog_style; ?> clearfix">

    <div class="itemList kl-blog-list kl-blog--default">
        <?php
            if ( have_posts() ) :
                $postCount = 0;
                while ( have_posts() ) {
                    the_post();

                    $featPostClass = is_sticky( get_the_id() ) ? 'featured-post kl-blog--featured-post' : '';
                    $image = '';
                    $sb_archive_use_full_image = zget_option( 'sb_archive_use_full_image', 'blog_options', false, 'no' );
                    $usePostFirstImage = (zget_option( 'zn_use_first_image', 'blog_options' , false, 'yes' ) == 'yes');

                    // Image Ratio
                    $ratio = 1.77; // 16:9
                    // $ratio = 1.33; // 4:3

                    // Create the featured image html
                    if ( has_post_thumbnail() && !post_password_required() ) {

                        $thumb   = get_post_thumbnail_id( get_the_id() );
                        $f_image = wp_get_attachment_url( $thumb );
                        if ( ! empty ( $f_image ) ) {

                            if(!empty($featPostClass)){
                                $resized_image = vt_resize( '', $f_image, 1140, 480, true );
                                $image = '<div class="zn_full_image kl-blog-full-image">';
                                if(isset($resized_image['url']) && !empty($resized_image['url'])){
                                    $image .= '<img class="zn_post_thumbnail kl-blog-post-thumbnail" src="' . $resized_image['url'] . '" alt=""/>';
                                }
                                $image .= '</div>';
                            }
                            elseif ($sb_archive_use_full_image == 'yes' ) {
                                $image = '<div class="zn_full_image kl-blog-full-image"><a data-lightbox="image" href="' . $f_image .'" class="kl-blog-full-image-link hoverBorder">' . get_the_post_thumbnail( get_the_id(), 'full-width-image', array('class'=>'kl-blog-full-image-img') ) . '</a></div>';
                            }
                            else {

                                $width = zget_option( 'sb_archive_def_cwidth', 'blog_options', false, '460' );
                                $height = $width / $ratio;
                                $resized_image = vt_resize( '', $f_image, $width, $height, true );

                                $image = '<div class="zn_post_image kl-blog-post-image"><a href="' . get_permalink() . '" class="kl-blog-post-image-link hoverBorder pull-left">';
                                if(isset($resized_image['url']) && !empty($resized_image['url'])){
                                    $image .= '<img class="zn_post_thumbnail kl-blog-post-thumbnail" src="' . $resized_image['url'] . '" alt=""/>';
                                }
                                $image .= '</a></div>';
                            }
                        }
                    }
                    elseif ($usePostFirstImage  && ! post_password_required() )
                    {
                        $f_image = echo_first_image();

                        // if sticky post
                        if(! empty($featPostClass)){
                            if ( ! empty ( $f_image ) ) {
                                $resized_image = vt_resize( '', $f_image, 1140, 480, true );
                                $image = '<div class="zn_full_image kl-blog-full-image">';
                                if(isset($resized_image['url']) && !empty($resized_image['url'])){
                                    $image .= '<img class="zn_post_thumbnail kl-blog-post-thumbnail" src="' . $resized_image['url'] . '" alt=""/>';
                                }
                                $image .= '</div>';
                            }
                            else { echo '<div class="zn_sticky_no_image kl-blog-sticky-noimg"></div>'; }
                        }
                        else {
                            if ( ! empty ( $f_image ) ) {
                                if ( $sb_archive_use_full_image == 'yes' ) {
                                    $size = zn_get_size( 'sixteen', $hasSidebar, 30 );
                                    $resized_image = vt_resize( '', $f_image, $size['width'], '', true );
                                    $image = '<div class="zn_full_image kl-blog-full-image"><a class="kl-blog-full-image-link" data-lightbox="image" href="' . $f_image . '">';
                                    if(isset($resized_image['url']) && !empty($resized_image['url'])){
                                        $image .= '<img class="zn_post_thumbnail kl-blog-post-thumbnail kl-blog-full-image-img" src="' . $resized_image['url'] . '" alt=""/>';
                                    }
                                    $image .= '</a></div>';
                                }
                                else {

                                    $width = zget_option( 'sb_archive_def_cwidth', 'blog_options', false, '460' );
                                    $height = $width / $ratio;
                                    $resized_image = vt_resize( '', $f_image, $width, $height, true );

                                    $image = '<div class="zn_post_image kl-blog-post-image">';
                                    $image .= '<a href="' . get_permalink() . '" class="kl-blog-post-image-link hoverBorder pull-left">';
                                    if(isset($resized_image['url']) && !empty($resized_image['url'])){
                                        $image .= '<img class="zn_post_thumbnail kl-blog-post-thumbnail" src="' . $resized_image['url'] . '" alt=""/>';
                                    }
                                    $image .= '</a>';
                                    $image .= '</div>';
                                }
                            }
                        }
                    }
                    ?>
                    <?php if(!empty($featPostClass)) {?>
                    <div class="itemContainer kl-blog-item-container post-<?php echo get_the_ID() .' '. $featPostClass;?>">
                        <?php
                            if(empty($image)){
                                echo '<div class="zn_sticky_no_image kl-blog-sticky-noimg"></div>';
                            }
                            else { echo $image; }
                        ?>
                        <div class="itemFeatContent kl-blog-featured-content">
                            <div class="itemFeatContent-inner kl-blog-featured-inner">
                                <div class="itemHeader kl-blog-item-header">
                                    <h3 class="itemTitle kl-blog-item-title">
                                        <a href="<?php the_permalink(); ?>" class="kl-blog-item-title-link"><?php the_title();?></a>
                                    </h3>
                                    <div class="post_details kl-blog-item-details kl-font-alt">
                                        <span class="catItemDateCreated kl-blog-item-date">
                                                <?php the_time( 'l, d F Y' );?>
                                        </span>
                                        <span class="catItemAuthor kl-blog-item-author"><?php echo __( 'by', 'zn_framework' );?> <?php the_author_posts_link(); ?></span>
                                    </div>
                                    <!-- end post details -->
                                </div>
                                <ul class="itemLinks kl-blog-item-links kl-font-alt clearfix">
                                    <li class="itemCategory kl-blog-item-category">
                                        <span class="kl-blog-item-category-icon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe117;"></span>
                                        <span class="kl-blog-item-category-text"><?php echo __( 'Published in', 'zn_framework' );?></span>
                                        <?php the_category( ", " ); ?>
                                    </li>
                                </ul>
                                <div class="itemComments kl-blog-item-comments">
                                    <a href="<?php the_permalink(); ?>" class="kl-blog-item-comments-link kl-font-alt"><?php comments_number( __( 'No Comments', 'zn_framework'), __( '1 Comment', 'zn_framework' ), __( '% Comments', 'zn_framework' ) ); ?></a>
                                </div>
                                <!-- item links -->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div class="itemContainer kl-blog-item-container post-<?php echo get_the_ID()?> kl-blog--normal-post">
                        <div class="itemHeader kl-blog-item-header">
                            <h3 class="itemTitle kl-blog-item-title">
                                <a href="<?php the_permalink(); ?>" class="kl-blog-item-title-link"><?php the_title();?></a>
                            </h3>
                            <div class="post_details kl-blog-item-details kl-font-alt">
                                <span class="catItemDateCreated kl-blog-item-date">
                                        <?php the_time( 'l, d F Y' );?>
                                </span>
                                <span class="catItemAuthor kl-blog-item-author text-custom-a"><?php echo __( 'by', 'zn_framework' );?> <?php the_author_posts_link(); ?></span>
                            </div>
                            <!-- end post details -->
                        </div>
                        <!-- end itemHeader -->

                        <div class="itemBody kl-blog-item-body">
                            <div class="itemIntroText kl-blog-item-content">
                                <?php
                                echo $image;
                                if( zget_option( 'sb_archive_content_type', 'blog_options', false, 'full' ) == 'excerpt' ){
                                    the_excerpt();
                                }
                                else{
                                    the_content();
                                }
                                ?>
                            </div>
                            <!-- end Item Intro Text -->
                            <div class="clear"></div>
                            <div class="itemBottom kl-blog-item-bottom clearfix">
                                <?php if ( has_tag() ) { ?>
                                    <div class="itemTagsBlock kl-blog-item-tags kl-font-alt">
                                        <?php echo WpkZn::getPostTags(get_the_ID()); ?>
                                        <div class="clear"></div>
                                    </div><!-- end tags blocks -->
                                <?php } ?>
                                <div class="itemReadMore kl-blog-item-more">
                                    <a class="kl-blog-item-more-btn btn btn-fullcolor text-uppercase" href="<?php the_permalink(); ?>"><?php echo __( 'Read more', 'zn_framework' );?></a>
                                </div>
                                <!-- end read more -->
                            </div>
                            <div class="clear"></div>
                        </div>
                        <!-- end Item BODY -->

                        <ul class="itemLinks kl-blog-item-links kl-font-alt clearfix">
                            <li class="itemCategory kl-blog-item-category">
                                <span class="kl-blog-item-category-icon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe117;"></span>
                                <span class="kl-blog-item-category-text"><?php echo __( 'Published in', 'zn_framework' );?></span>
                                <?php the_category( ", " ); ?>
                            </li>
                        </ul>
                        <div class="itemComments kl-blog-item-comments">
                            <a href="<?php the_permalink(); ?>" class="kl-blog-item-comments-link kl-font-alt"><?php comments_number( __( 'No Comments', 'zn_framework'), __( '1 Comment', 'zn_framework' ), __( '% Comments', 'zn_framework' ) ); ?></a>
                        </div>
                        <!-- item links -->
                        <div class="clear"></div>

                    </div><!-- end Blog Item -->
                    <?php } ?>
                    <div class="clear"></div>
                <?php
                    $postCount++;
                }

            else: ?>
                <div class="itemContainer noPosts kl-blog-item-container kl-blog-item--noposts">
                    <p><?php echo __( 'Sorry, no posts matched your criteria.', 'zn_framework' ); ?></p>
                </div><!-- end Blog Item -->
                <div class="clear"></div>
            <?php endif; ?>
    </div>
    <!-- end .itemList -->

    <!-- Pagination -->
    <div class="pagination--<?php echo $blog_style; ?>">
        <?php zn_pagination(); ?>
    </div>
</div>
<!-- end blog items list (.itemListView) -->
