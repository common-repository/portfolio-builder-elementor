<?php
/*
 * @package swp-portfolio
 * @since 1.0.0
*/
if (!class_exists('Swp_Portfolio_Custom_Post_Type')){
class Swp_Portfolio_Custom_Post_Type {

	private static $instance;

    function __construct() {

        add_action( 'init', array( $this, 'create_post_type' ) );

    }

    /**
	 * getInstance();
	 * @since 1.0.0
	 * */
	public static function getInstance(){
		if (null == self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}

    function create_post_type() {
    	$labels = array(
		'name'                  => esc_html__( 'Portfolios',  'portfolio-builder-elementor' ),
		'singular_name'         => esc_html__( 'Portfolio',  'portfolio-builder-elementor' ),
		'menu_name'             => esc_html__( 'Portfolio', 'portfolio-builder-elementor' ),
		'name_admin_bar'        => esc_html__( 'Portfolio', 'portfolio-builder-elementor' ),
        'add_new'            => esc_html__( 'Add New Portfolio', 'portfolio-builder-elementor'),
        'add_new_item'       => esc_html__( 'Add New Portfolio', 'portfolio-builder-elementor' ),
        'new_item'           => esc_html__( 'New Portfolio', 'portfolio-builder-elementor' ),
        'edit_item'          => esc_html__( 'Edit Portfolio', 'portfolio-builder-elementor' ),
        'view_item'          => esc_html__( 'View Portfolio', 'portfolio-builder-elementor' ),
        'all_items'          => esc_html__( 'All Portfolios', 'portfolio-builder-elementor' ),
        'search_items'       => esc_html__( 'Search Portfolios', 'portfolio-builder-elementor' ),
        'parent_item_colon'  => esc_html__( 'Parent : Portfolio', 'portfolio-builder-elementor' ),
        'not_found'          => esc_html__( 'No Portfolio found.', 'portfolio-builder-elementor'),
        'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash.', 'portfolio-builder-elementor' ),
        'not_found_in_trash' => esc_html__( 'Portfolios', 'portfolio-builder-elementor' ),
        // Overrides the “Featured Image” label
        'featured_image'        => esc_html__( 'Portfolio Image', 'portfolio-builder-elementor' ),

        // Overrides the “Set featured image” label
        'set_featured_image'    => esc_html__( 'Set Portfolio image', 'portfolio-builder-elementor' ),

        // Overrides the “Remove featured image” label
        'remove_featured_image' => esc_html__( 'Remove Portfolio image', 'portfolio-builder-elementor' ),

        // Overrides the “Use as featured image” label
        'use_featured_image'    => esc_html__( 'Use as Portfolio image', 'portfolio-builder-elementor' ),

	);

        register_post_type( 
            'portfolio',
            array(
                'labels'             => $labels,
                'public'             => true,
                'supports'            =>array( 'title', 'editor','thumbnail', 'author' ),
                'hierarchical'       => false,
                'rewrite'            => array( 'slug' => 'portfolio' ),
                'menu_icon'          => 'dashicons-images-alt2',
                'has_archive' => true,
            )
        );

    }

} // end class


 if (class_exists('Swp_Portfolio_Custom_Post_Type')){
		Swp_Portfolio_Custom_Post_Type::getInstance();
	}

} //endif 


