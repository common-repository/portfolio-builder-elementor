<?php
/*
 * general style two template
*/
?>
<div class="swp-row">
    <?php 
    if ( $posts_query->have_posts() ):
    while ( $posts_query->have_posts() ): $posts_query->the_post();
    $swp_meta = get_post_meta( get_the_id(), 'swp_portfolio_meta' );
    $src    = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false, '' );
    ?>
        <div class="swp-col-lg-6 swp-col-md-6">
            <div class="swp-single-inner style-19">
                <?php if( has_post_thumbnail() ) : ?>
                    <div class="icon-img">
                        <?php the_post_thumbnail( 'swp-portfolio-general' ); ?>
                    </div> 
                <?php endif; ?>
                <div class="content-box">
                    <?php 
                    //check if not hide title
                    if( 'hide' != $settings[ 'dtitle' ] ) :

                    ?>
                    <<?php echo esc_attr( $settings[ 'titltag' ] ); ?> class="inner-title">

                        <?php if( $settings[ 'portfolio-url' ] == 'default' ) : ?>

                        <a href="<?php the_permalink(); ?>">

                        <?php else : ?>

                            <a target="_blank" href="<?php echo esc_url( $swp_meta[0]['url'] ); ?>">

                        <?php endif; ?>

                        <?php
                            if( 'full' == $settings[ 'dtitle' ] ) :

                            the_title();

                            else :
                            echo esc_html( wp_trim_words( get_the_title(), $settings[ 'title_excerpt_length' ], '' ));
                            endif;
                            ?>
                        </a>
                    <?php endif; ?>
                    
                    </<?php echo esc_attr( $settings[ 'titltag' ] ); ?>>
                    <?php if( !empty( $swp_meta[0][ 'sub_title' ] ) && $settings[ 'enable_sub_title' ] == 'yes' ) : ?>
                        <p><?php echo esc_html( $swp_meta[0][ 'sub_title' ] ); ?></p>
                    <?php endif; ?>

                    <?php if( $settings[ 'portfolio-url' ] == 'default' ) : ?>
                        <a class="swp-readmore-text" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'portfolio-builder-elementor' ); ?> <i class="fas fa-angle-double-right"></i></a>
                    <?php else: ?>
                        <a class="swp-readmore-text" href="<?php echo esc_url( $swp_meta[0]['url'] ); ?>"><?php echo esc_html__( 'Read More', 'portfolio-builder-elementor' ); ?> <i class="fas fa-angle-double-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile;  endif; ?>

</div>
<div class="swpajaxapend"></div>