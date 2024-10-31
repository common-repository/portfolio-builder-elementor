<?php

namespace Elementor;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


/**
 *
 * swp-portfolio elementor Contact widget.
 *
 * @since 1.0
 */
class Swp_Portfolio_Generel extends Widget_Base
{

    public function get_name()
    {
        return 'general';
    }

    public function get_title()
    {
        return esc_html__('General Style', 'portfolio-builder-elementor');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['portfolio-builder-elementor'];
    }

    protected function _register_controls()
    {


        // general settings
        $this->start_controls_section(
            'ele_style_one_settings',
            [
                'label' => esc_html__('General Settings', 'portfolio-builder-elementor'),
            ]
        );


        $this->add_control(
            'ppr',
            [
                'label'   => esc_html__('Amount of post to display', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::TEXT,
                'default' => 6
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => esc_html__('Select Style', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'style-1' => esc_html__('Style 1', 'portfolio-builder-elementor'),
                    'style-2'  => esc_html__('Style 2', 'portfolio-builder-elementor'),
                ),
                'default' => 'style-1'

            ]
        );

        $this->end_controls_section(); // End general settings

        $this->start_controls_section(
            'Post_filter_settings',
            [
                'label' => esc_html__('Post Filter', 'portfolio-builder-elementor'),
            ]
        );


        $this->add_control(
            'select_cat',
            [
                'label'    => esc_html__('Select Category', 'portfolio-builder-elementor'),
                'type'     => Controls_Manager::SELECT2,
                'description' => esc_html__('Select Category To display Filter Option', 'portfolio-builder-elementor'),
                'multiple' => true,
                'options'  => portfolio_builder_elementor_post_category(),

            ]
        );

        $this->add_control(
            'exclude_cat',
            [
                'label'    => esc_html__('Exclude Category', 'portfolio-builder-elementor'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => portfolio_builder_elementor_post_category(),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order by', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'author' => esc_html__('Author', 'portfolio-builder-elementor'),
                    'title'  => esc_html__('Title', 'portfolio-builder-elementor'),
                    'date'   => esc_html__('Date', 'portfolio-builder-elementor'),
                    'rand'   => esc_html__('Random', 'portfolio-builder-elementor'),
                ),
                'default' => 'date'

            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'desc' => esc_html__('DESC', 'portfolio-builder-elementor'),
                    'asc'  => esc_html__('ASC', 'portfolio-builder-elementor'),
                ),
                'default' => 'desc'

            ]
        );


        $this->end_controls_section(); // End Filter

        //title settings
        $this->start_controls_section(
            'tittle_settings',
            [
                'label' => esc_html__('Title Settings', 'portfolio-builder-elementor'),
            ]
        );

        $this->add_control(
            'dtitle',
            [
                'label'   => esc_html__('Display', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'full' => esc_html__('Full Title', 'portfolio-builder-elementor'),
                    'excerpt'  => esc_html__('Excerpt', 'portfolio-builder-elementor'),
                    'hide'  => esc_html__('Not Display', 'portfolio-builder-elementor'),
                ),
                'default' => 'full'

            ]
        );

        $this->add_control(
            'title_excerpt_length',
            [
                'label'   => esc_html__('Title Excerpt Length', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::TEXT,
                'default' => 3,
                'condition' => [
                    'dtitle' => 'excerpt'
                ]
            ]
        );

        $this->add_control(
            'titltag',
            [
                'label'   => esc_html__('Title Tag', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::SELECT,
                'condition' => [
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
            'portfolio-url',
            [
                'label'   => esc_html__('Portfolio Url', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::SELECT,
                'condition' => [
                    'dtitle!' => 'hide'
                ],
                'options' => array(
                    'default' => esc_html__('Default', 'portfolio-builder-elementor'),
                    'external' => esc_html__('External', 'portfolio-builder-elementor'),
                ),
                'default' => 'default'

            ]
        );

        $this->end_controls_section(); // End title

        //title settings
        $this->start_controls_section(
            'sub_title_settings',
            [
                'label' => esc_html__('Sub Title Settings', 'portfolio-builder-elementor'),
            ]
        );

        $this->add_control(
            'enable_sub_title',
            [
                'label' => esc_html__('Display Sub Title', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'portfolio-builder-elementor'),
                'label_off' => esc_html__('Hide', 'portfolio-builder-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->end_controls_section(); // End sub title

        // pagination
        $this->start_controls_section(
            'pagination_settings',
            [
                'label' => esc_html__('Pagination Settings (Pro)', 'portfolio-builder-elementor'),
            ]
        );

        $this->add_control(
            'enable_pagination',
            [
                'label' => esc_html__('Enable Pagination (Pro)', 'portfolio-builder-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'portfolio-builder-elementor'),
                'label_off' => esc_html__('no', 'portfolio-builder-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'pagination_type',
            [
                'label'   => esc_html__('Pagination Type', 'portfolio-builder-elementor'),
                'type'    => Controls_Manager::SELECT2,
                'options' => array(
                    'normal-pagination' => esc_html__('Normal Pagination', 'portfolio-builder-elementor'),
                    'ajax-pagination'  => esc_html__('Ajax Pagination', 'portfolio-builder-elementor'),
                ),
                'default' => 'normal-pagination',
                'condition' => [
                    'enable_pagination' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'important_note',
            [
                'label' => __('', 'portfolio-builder-elementor'),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => '<br/>For More Style And Features <br/>
            <br/><a target="_blank" href="https://1.envato.market/vnErvv">Go Pro</a>
            <br/><br/>
             <h3>Please give us a <a target="_blank" href="https://wordpress.org/support/plugin/ele-blog/reviews/#new-post">Rating</a> To improve this plugin. If you need any help you can contact us at <a target="_blank" href="https://solverwp.com/">SolverWp</a></h3>',
                'content_classes' => 'your-class',
            ]
        );

        $this->end_controls_section(); // End sub title

        //title style
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title Style', 'portfolio-builder-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2e2e36',
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner .content-box .inner-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Title Hover Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner.style-9:hover .content-box .inner-title a, .swp-single-inner.style-19:hover .content-box .inner-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        //title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'title_typography',
                'label'          => esc_html__('Title Typography', 'portfolio-builder-elementor'),
                'selector'       => '{{WRAPPER}} .swp-single-inner .content-box .inner-title a',
                'fields_options' => [
                    // first mimic the click on Typography edit icon
                    'typography'  => ['default' => 'yes'],
                    // then redifine the Elementor defaults
                    'font_size'   => ['default' => ['size' => 20]],
                    'font_weight' => ['default' => 600],
                    'line_height' => ['default' => ['size' => 24]],
                ],
            ]
        );

        $this->end_controls_section();

        //sub title style
        $this->start_controls_section(
            'sub_title_style',
            [
                'label' => esc_html__('Sub Title Style', 'portfolio-builder-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__('Sub Title Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#74787c',
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner .content-box p, .swp-single-inner.style-19 .content-box p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'sub_title_hover_color',
            [
                'label' => esc_html__('Sub Title Hover Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner.style-9:hover .content-box p, .swp-single-inner.style-19:hover .content-box p' => 'color: {{VALUE}}',
                ],
            ]
        );

        //sub title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'sub_title_typography',
                'label'          => esc_html__('Sub Title Typography', 'portfolio-builder-elementor'),
                'selector'       => '{{WRAPPER}} .swp-single-inner .content-box p',
                'fields_options' => [
                    // first mimic the click on Typography edit icon
                    'typography'  => ['default' => 'yes'],
                    // then redifine the Elementor defaults
                    'font_size'   => ['default' => ['size' => 16]],
                    'font_weight' => ['default' => 400],
                    'line_height' => ['default' => ['size' => 27]],
                ],
            ]
        );

        $this->end_controls_section();


        //Button color
        $this->start_controls_section(
            'btn_style',
            [
                'label' => esc_html__('Button Style', 'portfolio-builder-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__('Button  Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2e2e36',
                'selectors' => [
                    '{{WRAPPER}} .swp-single-inner.style-9 .content-box .swp-readmore-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__('Button Background  Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .swp-readmore-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__('Button Hover Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2e2e36',
                'selectors' => [
                    '{{WRAPPER}} .swp-readmore-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover_color',
            [
                'label' => esc_html__('Button Hover Background  Color', 'portfolio-builder-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .swp-readmore-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        //btn typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'btn_typography',
                'label'          => esc_html__('Typography', 'portfolio-builder-elementor'),
                'selector'       => '{{WRAPPER}} .portfolio-area .swp-isotope-btn button',
                'fields_options' => [
                    // first mimic the click on Typography edit icon
                    'typography'  => ['default' => 'yes'],
                    // then redifine the Elementor defaults
                    'font_size'   => ['default' => ['size' => 14]],
                    'font_weight' => ['default' => 600],
                    'line_height' => ['default' => ['size' => 30]],
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings();

        $paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;

        $args  = array(
            'post_type'           => 'portfolio',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $settings['ppr'],
            'paged' => $paged,
        );

        $args['orderby'] = $settings['orderby'];
        $args['order']   = $settings['order'];


        if (!empty($settings['exclude_cat'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'portfolio-category',
                'field'    => 'id',
                'terms'    => array_values($settings['exclude_cat']),
                'operator' => 'NOT IN'
            );
        }

        if (!empty($settings['select_cat'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'portfolio-category',
                'field'    => 'id',
                'terms'    => array_values($settings['select_cat'])
            );
        }


        $posts_query = new \WP_Query($args);

        if ($settings['style'] == 'style-2') { ?>

            <!-- portfolio Card 19 -->
            <section class="portfolio-area style-19 " data-swp_ajaxid="<?php echo esc_attr($this->get_id()); ?>" data-style="general-style-two">
                <div class="swp-container">
                    <?php

                    include PORTFOLIO_BUILDER_ELEMENTOR_ELEMENTOR . '/templates/general-style-two.php';

                    wp_reset_postdata();

                    ?>
                </div>
            </section>
            <!-- portfolio Card 19 -->
        <?php } else { ?>

            <section class="portfolio-area style-9 " data-swp_ajaxid="<?php echo esc_attr($this->get_id()); ?>" data-style="general-style-one">
                <div class="swp-container">
                    <?php
                    include PORTFOLIO_BUILDER_ELEMENTOR_ELEMENTOR . '/templates/general-style-one.php';
                    wp_reset_postdata();
                    ?>
                </div>
            </section>

        <?php    }   ?>

<?php

    }
}

plugin::instance()->widgets_manager->register_widget_type(new Swp_Portfolio_Generel());
