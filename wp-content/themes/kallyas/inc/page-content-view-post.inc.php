<?php if(! defined('ABSPATH')){ return; }
/**
 * Displays the layout for the post type POST, inside page.php
 * @internal
 * @see page-content-template.inc.php
 */

/* DISPLAY POST CONTENT */
    global $zn_config;


// Check if PB Element has style selected, if not use Blog style option. If no blog style option, use Global site skin.
$blog_style_global = zget_option( 'blog_style', 'blog_options', false, '' ) != '' ? zget_option( 'blog_style', 'blog_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
$blog_style = isset($zn_config['blog_style']) && $zn_config['blog_style'] != '' ? $zn_config['blog_style'] : $blog_style_global;

// Get multiple columns option
$blog_multi_columns = isset($zn_config['blog_multicolumns']) && $zn_config['blog_multicolumns'] != '' ? $zn_config['blog_multicolumns'] : zget_option( 'sbo_multicolumns', 'blog_options', false, '1' );


$image = '';
if ( has_post_thumbnail() ) {
    $thumb   = get_post_thumbnail_id();
    $f_image = wp_get_attachment_url( $thumb );
    if ( $f_image ) {
        if( zget_option( 'sb_use_full_image', 'blog_options', false, 'no' ) == 'yes' ){
            $featured_image = wp_get_attachment_image_src($thumb, 'full');
            if(isset($featured_image[0]) && !empty($featured_image[0])) {
                $image = '<a data-lightbox="image" href="' . $featured_image[0] . '" class="hoverBorder pull-left full-width kl-blog-post-img"><img src="' . $featured_image[0] . '" alt=""/></a>';
            }
        }
        else {
            $feature_image = wp_get_attachment_url( $thumb );
            $image = vt_resize( '', $f_image, 420, 280, true );
            $image = '<a data-lightbox="image" href="' . $feature_image . '" class="hoverBorder pull-left kl-blog-post-img kl-blog-post--default-view" ><img src="' . $image['url'] . '" alt=""/></a>';
        }
    }
}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <h1 class="page-title kl-blog-post-title"><?php the_title(); ?></h1>

    <div class="itemView clearfix eBlog kl-blog kl-blog-list-wrapper kl-blog--style-<?php echo $blog_style; ?>">

        <div class="kl-blog-post">
            <div class="itemHeader kl-blog-post-header">
                <div class="post_details kl-blog-post-details kl-font-alt">
                    <span class="itemAuthor kl-blog-post-details-author">
                        <?php echo __( "by", 'zn_framework' ); ?>
                        <a class=" kl-blog-post-author-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                            <?php echo get_the_author_meta( 'display_name' );?>
                        </a>
                    </span>
                    <span class="infSep kl-blog-post-details-sep "> / </span>
                    <span class="itemDateCreated kl-blog-post-date">
                        <span class="kl-blog-post-date-icon glyphicon glyphicon-calendar"></span>
                        <?php the_time( 'l, d F Y' ); ?>
                    </span>
                    <span class="infSep kl-blog-post-details-sep"> / </span>
                    <span class="itemCategory kl-blog-post-category">
                        <span class="kl-blog-post-category-icon glyphicon glyphicon-folder-close"></span>
                        <?php echo __( 'Published in ', 'zn_framework' ); ?>
                    </span>
                    <?php the_category( ", " ); ?>
                </div>
            </div>
            <!-- end itemheader -->

            <div class="itemBody kl-blog-post-body kl-blog-cols-<?php echo $blog_multi_columns; ?>">
                <!-- Blog Image -->
                <?php
                    if( !post_password_required() ){
                        echo $image;
                    }
                ?>
                <!-- Blog Content -->
                <?php the_content(); ?>

            </div>
            <!-- end item body -->
            <div class="clearfix"></div>

            <?php

            wp_link_pages( array (
                'before' => '<div class="page-link kl-blog-post-pagelink"><span>' . __( 'Pages:', 'zn_framework' ) . '</span>',
                'after'  => '</div>'
            ) );

            $show_social = get_post_meta( get_the_ID(), 'zn_show_social', true );
            if('default' == $show_social){
                $show_social = zget_option('show_social', 'blog_options', false, false);
            }

            if( 'show' == $show_social ){
                ?>
                <!-- Social sharing -->
                <div class="itemSocialSharing kl-blog-post-socsharing clearfix">

                    <!-- Twitter Button -->
                    <div class="itemTwitterButton kl-blog-post-socsharing-tw">
                        <a href="//twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
                        <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                    </div>

                    <!-- Facebook Button -->
                    <div class="itemFacebookButton kl-blog-post-socsharing-fb">
                        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
                    </div>

                    <!-- Google +1 Button -->
                    <div class="itemGooglePlusOneButton kl-blog-post-socsharing-gp">
                        <script type="text/javascript">
                            jQuery(function($){
                                var po = document.createElement('script');
                                po.type = 'text/javascript';
                                po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(po, s);
                            });
                        </script>
                        <div class="g-plusone" data-size="medium"></div>
                    </div>

                    <div class="clearfix"></div>
                </div><!-- end social sharing -->
            <?php
            } // end social

            if ( has_tag() ) {
                ?>
                <!-- TAGS -->
                <div class="itemTagsBlock kl-blog-post-tags kl-font-alt">
                    <span class="kl-blog-post-tags-text"><?php echo __( 'Tagged under:', 'zn_framework' ); ?></span>
                    <?php echo WpkZn::getPostTags(get_the_ID(), ', '); ?>
                    <div class="clearfix"></div>
                </div><!-- end tags blocks -->
            <?php
            }
            ?>

            <div class="clearfix"></div>

            <?php if( zget_option( 'zn_show_author_info', 'blog_options', false, 'yes' ) == 'yes' ) : ?>
            <div class="post-author kl-blog-post-author">
                <div class="author-avatar kl-blog-post-author-avatar">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), 100 ); ?>
                </div>
                <div class="author-details kl-blog-post-author-details">
                    <h4 class="kl-blog-post-author-title"><?php _e('About', 'zn_framework'); ?> <?php echo get_the_author_meta( 'display_name' );?></h4>
                    <?php echo get_the_author_meta( 'description' );?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php endif; ?>

            <?php if( zget_option( 'zn_show_related_posts', 'blog_options', false, 'yes' ) == 'yes' ) : ?>
            <?php
            /*
             * DISPLAY 3 RELATED POSTS
             */
                // Start the query
                $args = array(
                    'posts_per_page' => 3,
                    'category__in' => wp_get_post_categories( get_the_ID(), array('fields' => 'ids')),
                    'orderby' => 'rand',
                    'order'=> 'ID',
                    'post__not_in' => array( get_the_ID() ),
                );
                $theQuery = new WP_Query( $args );
                $usePostFirstImage = (zget_option( 'zn_use_first_image', 'blog_options' , false, 'yes' ) == 'yes');

            if($theQuery->have_posts()) {
            ?>
            <div class="related-articles kl-blog-related">
                <h3 class="rta-title kl-blog-related-title"><?php _e( 'What you can read next', 'zn_framework' ); ?></h3>
                <div class="row kl-blog-related-row">
                    <?php
                        while($theQuery->have_posts())
                        {
                            $theQuery->the_post();
                            ?>
                            <div class="col-sm-4">
                                <div class="rta-post kl-blog-related-post">
                                    <?php
                                        $thumb   = get_post_thumbnail_id( get_the_ID() );
                                        if( !empty( $thumb ) ){
                                            $f_image = wp_get_attachment_url( $thumb );
                                            $image = vt_resize( '', $f_image, 370, 240, true );
                                            if( !empty( $image ) ){
                                                echo '<a class="kl-blog-related-post-link" href="' . get_permalink() . '">
                                                <img class="kl-blog-related-post-img" src="'. $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" alt=""/></a>';
                                            }
                                        }
                                        elseif ( $usePostFirstImage  && ! post_password_required() ){
                                            $f_image = echo_first_image();
                                            if ( ! empty ( $f_image ) ) {
                                                $image = vt_resize( '', $f_image, 370, 240, true );

                                                if( !empty( $image ) ){
                                                    echo '<a class="kl-blog-related-post-link" href="' . get_permalink() . '">
                                                    <img class="kl-blog-related-post-img" src="'. $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" alt=""/></a>';
                                                }

                                            }
                                        }

                                    ?>
                                    <h5 class="kl-blog-related-post-title"><a class="kl-blog-related-post-title-link" href="<?php echo get_permalink(); ?>"><?php the_title();?></a></h5>
                                </div>
                            </div>
                        <?php
                        }
                        wp_reset_postdata();
                    ?>
                </div>

            </div>
            <?php } /* End if has posts */?>
            <?php endif; ?>
        </div><!-- /.kl-blog-post -->
    </div>
    <!-- End Item Layout -->
</div>
