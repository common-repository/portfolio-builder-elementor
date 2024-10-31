<?php
namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 *
 * swp-portfolio elementor Isotop widget.
 *
 * @since 1.0
 */
class Swp_Portfolio_Isotop extends Widget_Base {

    public function get_name() {
        return 'swp_isotop';
    }

    public function get_title() {
        return esc_html__( 'Isotop', 'portfolio-builder-elementor' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['portfolio-builder-elementor'];
    }

    protected function _register_controls() {


    // generel settings
     $this->start_controls_section(
            'ele_style_one_settings',
            [
                'label' => esc_html__( 'Generel Settings', 'portfolio-builder-elementor' ),
            ]
        );

        
        $this->add_control(
            'ppr', [
                'label'   => esc_html__( 'Amount of post to display', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 6
            ]
        );

        $this->add_control(
            'style', [
                'label'   => esc_html__( 'Select Style', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'style-1' => esc_html__( 'Style 1', 'portfolio-builder-elementor' ),
                    'style-2'  => esc_html__( 'Style 2 (Pro)', 'portfolio-builder-elementor' ),
                    'style-3'  => esc_html__( 'Style 3 (Pro)', 'portfolio-builder-elementor' ),
                    'style-4'  => esc_html__( 'Style 4 (Pro)', 'portfolio-builder-elementor' ),
                    'style-5'  => esc_html__( 'Style 5 (Pro)', 'portfolio-builder-elementor' ),
                ),
                'default' => 'style-1'

            ]
        );


        $this->end_controls_section(); // End generel settings


        $this->start_controls_section(
            'Post_filter_settings',
            [
                'label' => esc_html__( 'Post Filter', 'portfolio-builder-elementor' ),
            ]
        );


        $this->add_control(
            'select_cat', [
                'label'    => esc_html__( 'Select Category', 'portfolio-builder-elementor' ),
                'type'     => Controls_Manager::SELECT2,
                'description'=>esc_html__( 'Select Category To display Filter Option', 'portfolio-builder-elementor' ),
                'multiple' => true,
                'options'  => portfolio_builder_elementor_post_category(),

            ]
        );

        $this->add_control(
            'exclude_cat', [
                'label'    => esc_html__( 'Exclude Category', 'portfolio-builder-elementor' ),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => portfolio_builder_elementor_post_category(),
            ]
        );

        $this->add_control(
            'orderby', [
                'label'   => esc_html__( 'Order by', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'author' => esc_html__( 'Author', 'portfolio-builder-elementor' ),
                    'title'  => esc_html__( 'Title', 'portfolio-builder-elementor' ),
                    'date'   => esc_html__( 'Date', 'portfolio-builder-elementor' ),
                    'rand'   => esc_html__( 'Random', 'portfolio-builder-elementor' ),
                ),
                'default' => 'date'

            ]
        );

        $this->add_control(
            'order', [
                'label'   => esc_html__( 'Order', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'desc' => esc_html__( 'DESC', 'portfolio-builder-elementor' ),
                    'asc'  => esc_html__( 'ASC', 'portfolio-builder-elementor' ),
                ),
                'default' => 'desc'

            ]
        );

  
        $this->end_controls_section(); // End Filter

        //title settings
        $this->start_controls_section(
            'tittle_settings',
            [
                'label' => esc_html__( 'Title Settings', 'portfolio-builder-elementor' ),
            ]
        );

         $this->add_control(
            'dtitle', [
                'label'   => esc_html__( 'Display', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'full' => esc_html__( 'Full Title', 'portfolio-builder-elementor' ),
                    'excerpt'  => esc_html__( 'Excerpt', 'portfolio-builder-elementor' ),
                    'hide'  => esc_html__( 'Not Display', 'portfolio-builder-elementor' ),
                ),
                'default' => 'full'

            ]
        );

        $this->add_control(
            'title_excerpt_length', [
                'label'   => esc_html__( 'Title Excerpt Length', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 3,
                'condition' =>[
                    'dtitle'=>'excerpt'
                ]
            ]
        );

        $this->add_control(
            'titltag', [
                'label'   => esc_html__( 'Title Tag', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'condition'=>[
                    'dtitle!' => 'hide'
                ],
                'options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ),
                'default' => 'h2'

            ]
        ); 

        $this->add_control(
            'portfolio-url', [
                'label'   => esc_html__( 'Portfolio Url', 'portfolio-builder-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'condition'=>[
                    'dtitle!' => 'hide'
                ],
                'options' => array(
                    'default' => esc_html__( 'Default', 'portfolio-builder-elementor' ),
                    'external' => esc_html__( 'External', 'portfolio-builder-elementor' ),
                ),
                'default' => 'default'

            ]
        );

        $this->end_controls_section(); // End title


        //title settings
        $this->start_controls_section(
            'Icon_settings',
            [
                'label' => esc_html__( 'Icon Settings', 'portfolio-builder-elementor' ),
            ]
        );

        $this->add_control(
            'enable_icon',
            [
                'label' => esc_html__( 'Display Icon', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'portfolio-builder-elementor' ),
                'label_off' => esc_html__( 'Hide', 'portfolio-builder-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );  

        $this->add_control(
            'video_icon',
            [
                'label' => esc_html__( 'Video Icon', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'portfolio-builder-elementor' ),
                'label_off' => esc_html__( 'Hide', 'portfolio-builder-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'=>[
                    'enable_icon'=>'yes'
                ]
            ]
        );

        $this->add_control(
            'disable_popup',
            [
                'label' => esc_html__( 'Disable Video Popup', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'portfolio-builder-elementor' ),
                'label_off' => esc_html__( 'no', 'portfolio-builder-elementor' ),
                'return_value' => 'yes',
                'default' => '',
                'condition'=>[
                    'enable_icon'=>'yes',
                    'video_icon'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'label' => esc_html__( 'Image Popup Icon', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'portfolio-builder-elementor' ),
                'label_off' => esc_html__( 'Hide', 'portfolio-builder-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'=>[
                    'enable_icon'=>'yes',
                ]
            ]
        );


        $this->add_control(
            'url_icon',
            [
                'label' => esc_html__( 'Url Icon', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'portfolio-builder-elementor' ),
                'label_off' => esc_html__( 'Hide', 'portfolio-builder-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'=>[
                    'enable_icon'=>'yes'
                ]
            ]
        );

         $this->add_control(
            'title_icon',
            [
                'label' => esc_html__( 'Title Url Icon', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'portfolio-builder-elementor' ),
                'label_off' => esc_html__( 'Hide', 'portfolio-builder-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'=>[
                     'enable_icon'=>'yes' ,
                     'style'=>'style-2' 
                ]
            ]
        );

        $this->end_controls_section(); // End icon settings

        // more
		$this->start_controls_section(
            'morefeautes_settings',
            [
                'label' => esc_html__( 'Go Pro ', 'portfolio-builder-elementor' ),
            ]
        );

        $this->add_control(
            'important_note',
            [
                'label' => __( '', 'portfolio-builder-elementor' ),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => '
                <a target="_blank" href="https://1.envato.market/vnErvv">Go Pro</a>
               ',
            ]
        );

        $this->end_controls_section(); // More 

      //title style
        $this->start_controls_section(
            'title_style', [
                'label' => esc_html__( 'Title Style', 'portfolio-builder-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner .content-box .inner-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

       $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner .content-box .inner-title:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        //title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'title_typography',
                'label'          => esc_html__( 'Title Typography', 'portfolio-builder-elementor' ),
                'selector'       => '{{WRAPPER}} .swp-single-inner .content-box .inner-title a',
            ]
        );

     $this->end_controls_section();     

     //sub title style
        $this->start_controls_section(
            'sub_title_style', [
                'label' => esc_html__( 'Sub Title Style', 'portfolio-builder-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__( 'Sub Title Color', 'portfolio-builder-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner .content-box p' => 'color: {{VALUE}}',
                ],
            ]
        );

        //title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'sub_title_typography',
                'label'          => esc_html__( 'Sub Title Typography', 'portfolio-builder-elementor' ),
                'selector'       => '{{WRAPPER}} .swp-single-inner .content-box p',
            ]
        );

     $this->end_controls_section();


    //filter hover color
    $this->start_controls_section(
        'filter_btn_style', [
            'label' => esc_html__( 'Filter Button Style', 'portfolio-builder-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'filter_btn_color',
        [
            'label' => esc_html__( 'Button  Color', 'portfolio-builder-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .portfolio-area .swp-isotope-btn button' => 'color: {{VALUE}}',
            ],
        ]
    );   

    $this->add_control(
        'filter_btn_bg_color',
        [
            'label' => esc_html__( 'Button Background  Color', 'portfolio-builder-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .portfolio-area .swp-isotope-btn button' => 'background-color: {{VALUE}}',
            ],
        ]
    );


    $this->add_control(
        'filter_btn_active',
        [
            'label' => esc_html__( 'Active/Hover  Color', 'portfolio-builder-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .portfolio-area .swp-isotope-btn button:hover, .portfolio-area .swp-isotope-btn button.active' => 'color: {{VALUE}}',
            ],
        ]
    );

     $this->add_control(
        'filter_btn_bg_active',
        [
            'label' => esc_html__( 'Active/Hover bg Color', 'portfolio-builder-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .portfolio-area .swp-isotope-btn button:hover, .portfolio-area .swp-isotope-btn button.active' => 'background-color: {{VALUE}} !important',
            ],
        ]
    ); 

    //btn typography
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name'           => 'filter_btn_typography',
            'label'          => esc_html__( 'Typography', 'portfolio-builder-elementor' ),
            'selector'       => '{{WRAPPER}} .portfolio-area .swp-isotope-btn button',
        ]
    ); 

    $this->end_controls_section();

    //icon color
    $this->start_controls_section(
        'icon_style', [
            'label' => esc_html__( 'Icon Style', 'portfolio-builder-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'icon_color',
        [
            'label' => esc_html__( 'Icon Color', 'portfolio-builder-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swp-readmore-arrow' => 'color: {{VALUE}} !important',
            ],
        ]
    );

    $this->add_control(
        'icon_hover_color',
        [
            'label' => esc_html__( 'Icon Hover Color', 'portfolio-builder-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swp-readmore-arrow:hover' => 'color: {{VALUE}} !important',
            ],
        ]
    );   

    $this->add_control(
        'icon_hover_bg_color',
        [
            'label' => esc_html__( 'Icon Hover Bg Color', 'portfolio-builder-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swp-readmore-arrow:hover' => 'background-color: {{VALUE}} !important',
            ],
        ]
    );

    $this->end_controls_section();
 
    }

    protected function render() {

    $settings = $this->get_settings();

    $args  = array(
        'post_type'           => 'portfolio',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => $settings['ppr'],
    );

    $args['orderby'] = $settings['orderby'];
    $args['order']   = $settings['order'];


    if ( ! empty( $settings['exclude_cat'] ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'portfolio-category',
            'field'    => 'id',
            'terms'    => array_values( $settings['exclude_cat'] ),
            'operator' => 'NOT IN'
        );
    }

    if ( ! empty( $settings['select_cat'] ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'portfolio-category',
            'field'    => 'id',
            'terms'    => array_values( $settings['select_cat'] )
        );
    }


    $posts_query = new \WP_Query( $args );

    if( $settings[ 'style' ] == 'style-2' ){ ?>
        <div class="text-center">
            <h2>This Widget Only Available In <a href="https://1.envato.market/vnErvv" target="_blank" style="text-decoration:underline;color:#222">Pro Version</a></h2>
        </div>
    <?php }elseif( $settings[ 'style' ] == 'style-3' ){ ?>
        <div class="text-center">
             <h2>This Widget Only Available In <a href="https://1.envato.market/vnErvv" target="_blank" style="text-decoration:underline;color:#222">Pro Version</a></h2>
        </div>
    <?php }elseif( $settings[ 'style' ] == 'style-4' ){ ?>
        <div class="text-center">
             <h2>This Widget Only Available In <a href="https://1.envato.market/vnErvv" target="_blank" style="text-decoration:underline;color:#222">Pro Version</a></h2>
        </div> 
    <?php  }elseif( $settings[ 'style' ] == 'style-5' ){ ?>
        <div class="text-center">
                <h2>This Widget Only Available In <a href="https://1.envato.market/vnErvv" target="_blank" style="text-decoration:underline;color:#222">Pro Version</a></h2>
        </div>
    <?php }else{ ?>
        <section class="portfolio-area style-7" >
            <div class="swp-container">
                <div class="isotope-filters swp-isotope-btn text-lg-left text-center">
                   <button class="button active" data-filter="*"><?php echo esc_html__( 'All', 'portfolio-builder-elementor' ); ?></button>
                <?php
                    if( is_array( $settings[ 'select_cat' ] ) ) :
                       foreach ( $settings['select_cat'] as $term ) :
                    ?>
                        <button class="button" data-filter=".<?php echo strtolower(preg_replace('/[^a-zA-Z]+/', '-', portfolio_builder_elementor_get_cat_slug( $term ) ) ); ?>"><?php echo esc_html( portfolio_builder_elementor_get_cat_name( $term )); ?></button>
                        <?php endforeach;
                    else: 
                        $taxonomy = 'portfolio-category';
                        $terms = get_terms($taxonomy); // Get all terms of a taxonomy
                        if ( $terms && !is_wp_error( $terms ) ) :
                        foreach ( $terms as $term ) { ?>
                           <button class="button" data-filter=".<?php echo strtolower(preg_replace('/[^a-zA-Z]+/', '-', $term->slug)); ?>"><?php echo esc_html($term->name); ?></button>
                         <?php } endif; endif; 
                ?>
                </div>
                <div class="swp-section">        
                    <div class="swp-isotope swp-row ">
                        <div class="swp-sizer col-1"></div>
                        <?php 
                            if ( $posts_query->have_posts() ):
                            while ( $posts_query->have_posts() ): $posts_query->the_post();
                            $swp_meta = get_post_meta( get_the_id(), 'swp_portfolio_meta' );
                            $src      = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false, '' );
                            $terms = get_the_terms( get_the_ID(), 'portfolio-category' );
                        ?>
                        <!-- swp item start here -->
                        <div class="swp-item swp-col-lg-4 swp-col-sm-6 <?php foreach ($terms as $term){ echo strtolower(preg_replace('/[^a-zA-Z]+/', '-', $term->slug )).' '; } ?>">
                            <div class="swp-single-inner style-7">
                                <div class="icon-img">
                                    <?php 
                                        if( has_post_thumbnail() ) :
                                            the_post_thumbnail( 'swp-portfolio-card' );
                                         endif;
                                        ?>
                                    <?php if( 'yes' == $settings[ 'enable_icon' ] ) : ?>
                                        <div class="swp-readmore-arrow-wrap">
                                            <?php if( 'yes'== $settings[ 'video_icon' ] ) : ?>
                                                <a class="swp-readmore-arrow <?php echo esc_attr( ( $settings[ 'disable_popup' ] != 'yes' ? 'swp-video-play-btn' : '' ) ); ?>" href="<?php echo esc_url( $swp_meta[0][ 'video-id' ] ); ?>" data-effect="mfp-zoom-in"><i class="fas fa-play"></i></a>
                                            <?php endif; ?>

                                            <?php if( 'yes'== $settings[ 'image_icon' ] ) : ?>
                                               <a class="swp-readmore-arrow swp-image-popup" href="<?php echo esc_url( $src[0] ); ?>"><i class="fas fa-plus"></i></a>
                                            <?php endif; ?>

                                            <?php if( 'yes' == $settings[ 'url_icon' ] ) : ?>
                                            <?php if( $settings[ 'portfolio-url' ] == 'default' ) : ?>
                                                <a class="swp-readmore-arrow" href="<?php the_permalink(); ?>"><i class="fas fa-angle-double-right"></i></a>
                                            <?php else: ?>
                                                 <a class="swp-readmore-arrow" target="_blank" href="<?php echo esc_url( $swp_meta[0]['url'] ); ?>"><i class="fas fa-angle-double-right"></i></a>
                                            <?php endif; endif; ?>

                                        </div>
                                    <?php endif; ?>
                                </div> 
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

                                        </<?php echo esc_attr( $settings[ 'titltag' ] ); ?>>

                                        <?php endif; ?>
                                        <?php if( !empty( $swp_meta[0][ 'sub_title' ] ) ) : ?>
                                        <p><?php echo esc_html( $swp_meta[0][ 'sub_title' ] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                </div>
            </div>
        </section> 
    <?php  }  ?>

 <?php 

    }
    

}

plugin::instance()->widgets_manager->register_widget_type(new Swp_Portfolio_Isotop());