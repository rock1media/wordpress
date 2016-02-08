<?php

$info = $GLOBALS['lp_info'];
$options = $info['options'];
$post = $info['post'];
// tmp
$__index = 0;
?>
<h3 class="m_title m_title_ext text-custom latest_posts-elm-title"><?php echo $info['postTitle'];?></h3>
<div class="row u-mb-0">
    <?php
    // Start the query
    $args = array(
        'posts_per_page' => $info['num_posts'],
        'orderby' => 'date',
        'order'=> 'ID',
    );

    if( ! empty( $info['blog_category'] ) ){
        $args['category__in'] = $info['blog_category'];
    }

    $the_query = new WP_Query( $args );


    // Start the loop
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

        echo '<div class="col-sm-6 col-lg-4 post latest_posts-post">';

        $image = '';
        // Create the featured image html
        if ( has_post_thumbnail( $post->ID ) ) {
            $thumb   = get_post_thumbnail_id( $post->ID );
            $f_image = wp_get_attachment_url( $thumb );
            if ( ! empty ( $f_image ) ) {
                $image         = vt_resize( '', $f_image, 370, 200, true );
                $image         = '<a href="' . get_permalink() . '" class="hoverBorder plus latest_posts-link text-custom-parent-hov"><img src="'. $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="" class="latest_posts-img" /><span class="latest_posts-readon u-trans-all-2s text-custom-child kl-main-bgcolor">' . __( "Read more", 'zn_framework' ). ' +</span></a>';
            }
        }

        echo $image;

        echo '<em class="post-details element-scheme__faded latest_posts-details">';
        the_time( 'd F Y' );
        echo ' ' . __( "By", 'zn_framework' );
        echo ' ' . get_the_author();
        echo ' ' . __( "in", 'zn_framework' ) . ' ';
        the_category( ", " );
        echo '</em>';

        echo '<h3 class="m_title m_title_ext text-custom latest_posts-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

        echo '</div>';

        $__index++;
        if($__index >= $info['num_posts']){
            break;
        }
    }
    wp_reset_postdata();
    ?>
</div>

