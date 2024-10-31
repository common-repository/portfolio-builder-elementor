<?php
/*
 * @package swp-portfolio
 * @since 1.0.0
*/

//portfolio post meta
if ( class_exists( 'CSF' ) ) {

 $portfolio_builder_elementor_prefix = 'swp';

    CSF::createMetabox($portfolio_builder_elementor_prefix.'_portfolio_meta',array(
        'title' => esc_html__('Portfolio Info','portfolio-builder-elementor'),
        'post_type' => 'portfolio',
    ));

    CSF::createSection($portfolio_builder_elementor_prefix.'_portfolio_meta',array(
        'fields' => array(
            array(
                'id' => 'sub_title',
                'type' => 'text',
                'title' => esc_html__('Sub Title','portfolio-builder-elementor'),
                'desc' =>  esc_html__( 'Write Portfolio Sub Title', 'portfolio-builder-elementor' )
            ),            
            array(
                'id' => 'video-id',
                'type' => 'text',
                'title' => esc_html__('Video Url','portfolio-builder-elementor'),
                'desc' =>  esc_html__( 'Enter youtube/vimeo video url ', 'portfolio-builder-elementor' ),
                'default'=> 'https://www.youtube.com/watch?v=cReIHnePBT0'
            ),            
            array(
                'id' => 'url',
                'type' => 'text',
                'title' => esc_html__('Portfolio Url','portfolio-builder-elementor'),
                'desc' =>  esc_html__( 'You can add external link for your portfolio', 'portfolio-builder-elementor' )
            ),
            array(
                  'id'        => 'info',
                  'type'      => 'group',
                  'title'     => esc_html__( 'Portfolio Info', 'portfolio-builder-elementor' ),
                  'fields'    => array(
                    array(
                      'id'    => 'type',
                      'type'  => 'text',
                      'title' => esc_html__( 'Info Type', 'portfolio-builder-elementor' ),
                    ),                    
                    array(
                      'id'    => 'details',
                      'type'  => 'textarea',
                      'title' => esc_html__( 'Info Details', 'portfolio-builder-elementor' ),
                    ),

                  ),
            ),
            array(
                  'id'        => 'social',
                  'type'      => 'group',
                  'title'     => esc_html__( 'Social Profile', 'portfolio-builder-elementor' ),
                  'fields'    => array(
                    array(
                      'id'    => 'icon',
                      'type'  => 'icon',
                      'title' => esc_html__( 'Social Icon', 'portfolio-builder-elementor' ),
                    ),                    
                    array(
                      'id'    => 'url',
                      'type'  => 'text',
                      'title' => esc_html__( 'Social Profile Url', 'portfolio-builder-elementor' ),
                    ),

                  ),
            ),
            array(
              'id'    => 'gallery',
              'type'  => 'gallery',
              'title' => esc_html__( 'Portfolio Details Page Slider Image', 'portfolio-builder-elementor' ),
            ),
            array(
              'id'    => 'related_post',
              'type'  => 'switcher',
              'title' => esc_html__( 'Display Related Post', 'portfolio-builder-elementor' ),
              'default'=> false
            ),
            array(
              'id' => 'related_text',
              'type' => 'text',
              'title' => esc_html__('Related Post Title','portfolio-builder-elementor'),
              'default' =>  esc_html__( 'Related Post ', 'portfolio-builder-elementor' )
          ), 
            
        )
    )); 

}