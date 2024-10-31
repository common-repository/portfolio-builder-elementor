<?php
/**
 * @package portfolio builder
 * @sicne 1.0.0
 * */

if ( ! class_exists( 'Portfolio_builder_elementor_Init' ) ) {

	class Portfolio_builder_elementor_Init {

		//instance
		protected static $instance;

		public function __construct() {
			//plugin_assets
			add_action( 'wp_enqueue_scripts', array( $this, 'plugin_assets' ), 99 );

			//load plugin dependency files
			$this->load_plugin_dependency_files();
		}



		/**
		 * plugin_assets()
		 * @since 1.0.0
		 * */
		public function plugin_assets() {
			$this->load_plugin_css();
			$this->load_plugin_js();
		}

		/*
		*ele blog default font
		*/
		public static function portfolio_builder_elementor_fonts_url() {
			$fonts_url = '';
			$font_families = array();

			if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'portfolio-builder-elementor' ) ) :
				$font_families[] = 'Inter:300,400,500,600,700&display=swap';
				$font_families[] = 'Rubik:400,400i,500,600,700,800display=swap';
				$query_args = array(
					'family'  => urlencode( implode( '|', $font_families ) ),
					'display' => 'swap',
				);
				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			endif;

			return esc_url_raw( $fonts_url );
		}


		/**
		 * load plugin css
		 * @since 1.0.0
		 * */
		public function load_plugin_css() {

			wp_enqueue_style( 'swp-portfolio-font', self::portfolio_builder_elementor_fonts_url(), array(), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, 'all');
			wp_enqueue_style( 'swp-grid', PORTFOLIO_BUILDER_ELEMENTOR_CSS.'/swp-grid.css',array(), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, 'all');
		    wp_enqueue_style( 'magnific', PORTFOLIO_BUILDER_ELEMENTOR_CSS.'/magnific.min.css',array(), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, 'all');
		    wp_enqueue_style( 'owl', PORTFOLIO_BUILDER_ELEMENTOR_CSS.'/owl.min.css',array(), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, 'all');
		    wp_enqueue_style( 'fontawesome', PORTFOLIO_BUILDER_ELEMENTOR_CSS.'/fontawesome.min.css',array(), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, 'all');
		    wp_enqueue_style( 'swp-global', PORTFOLIO_BUILDER_ELEMENTOR_CSS.'/swp-global.css',array(), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, 'all');
		    wp_enqueue_style( 'swp-portfolio-main', PORTFOLIO_BUILDER_ELEMENTOR_CSS.'/swp-styles.css',array(), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, 'all');


		}

		/**
		 * load plugin js
		 * @since 1.0.0
		 * */
		public function load_plugin_js() {

			wp_enqueue_script( 'owl-carousel', PORTFOLIO_BUILDER_ELEMENTOR_JS.'/owl.carousel.min.js',array( 'jquery' ), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, true);
			wp_enqueue_script( 'imagesloaded', PORTFOLIO_BUILDER_ELEMENTOR_JS.'/imagesloaded.pkgd.min.js',array( 'jquery' ), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, true);
		    wp_enqueue_script( 'magnific', PORTFOLIO_BUILDER_ELEMENTOR_JS.'/magnific.min.js',array( 'jquery' ), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, true);
		    wp_enqueue_script( 'isotope', PORTFOLIO_BUILDER_ELEMENTOR_JS.'/isotope.pkgd.min.js',array( 'jquery' ), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, true);
		    wp_enqueue_script( 'swp-main', PORTFOLIO_BUILDER_ELEMENTOR_JS.'/swp-main.js',array( 'jquery' ), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, true);
		    wp_enqueue_script( 'swp-portfolio-elementor-script', PORTFOLIO_BUILDER_ELEMENTOR_JS.'/elementor-script.js',array( 'jquery' ), PORTFOLIO_BUILDER_ELEMENTOR_VERSION, true);
			wp_localize_script( 'swp-portfolio-elementor-script', 'portfolio_builder_elementor_localize', array( 'ajax_url' => admin_url('admin-ajax.php') ) );

		}


		/**
		 * load_plugin_dependency_files()
		 * @since 1.0.0
		 * */
		public function load_plugin_dependency_files() {

			if( ! class_exists( 'CSF' ) ){
				require PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH.'/lib/codestar-framework/codestar-framework.php';
			}

			$includes_files = array(				
				array(
					'file-name' => 'admin/class-custom-post-type',
					'file-path' => PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH
				),				
				array(
					'file-name' => 'admin/post-meta',
					'file-path' => PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH
				),				
				array(
					'file-name' => 'admin/class-custom-taxonomy',
					'file-path' => PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH
				),				
				array(
					'file-name' => 'swp-portfolio-elementor-widgets-init',
					'file-path' => PORTFOLIO_BUILDER_ELEMENTOR_ELEMENTOR
				),				
				array(
					'file-name' => 'functions',
					'file-path' => PORTFOLIO_BUILDER_ELEMENTOR_INC
				),
			);
			if ( is_array( $includes_files ) && ! empty( $includes_files ) ) {
				foreach ( $includes_files as $file ) {
					if ( file_exists( $file['file-path'] . '/' . $file['file-name'] . '.php' ) ) {
						require $file['file-path'] . '/' . $file['file-name'] . '.php';
					}
				}
			}

		}

	}//end class

	new Portfolio_builder_elementor_Init();
}

