<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Main portfolio builder Addon Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

if (!class_exists('Swp_Portfolio_Elementor_Widgets_Init')) {
	final class Swp_Portfolio_Elementor_Widgets_Init
	{

		/**
		 * Plugin Version
		 *
		 * @since 1.0.0
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0.0';

		/**
		 * Minimum Elementor Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

		/**
		 * Minimum PHP Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const MINIMUM_PHP_VERSION = '5.4';

		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Kontakt_elementor The single instance of the class.
		 */
		private static $_instance = null;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 * @static
		 *
		 * @return Kontakt_elementor An instance of the class.
		 */
		public static function instance()
		{

			if (is_null(self::$_instance)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct()
		{

			add_action('plugins_loaded', [$this, 'init']);
		}

		/**
		 * Initialize the plugin
		 *
		 * Load the plugin only after Elementor (and other plugins) are loaded.
		 * Checks for basic plugin requirements, if one check fail don't continue,
		 * if all check have passed load the files required to run the plugin.
		 *
		 * Fired by `plugins_loaded` action hook.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function init()
		{

			// Check if Elementor installed and activated
			if (!did_action('elementor/loaded')) {
				add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
				return;
			}

			// Check for required Elementor version
			if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
				return;
			}

			// Check for required PHP version
			if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
				return;
			}

			add_action('elementor/elements/categories_registered', array($this, '_widget_categories'));

			//elementor widget registered
			add_action('elementor/widgets/widgets_registered', array($this, '_widget_registered'));

			// Elementor Editor Style
			add_action('elementor/editor/after_enqueue_styles', [$this, 'editor_icon']);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin()
		{

			if (isset($_GET['activate'])) unset($_GET['activate']);

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
				esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'portfolio-builder-elementor'),
				'<strong>' . esc_html__('Eleblog', 'portfolio-builder-elementor') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'portfolio-builder-elementor') . '</strong>'
			);

			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version()
		{

			if (isset($_GET['activate'])) unset($_GET['activate']);

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'portfolio-builder-elementor'),
				'<strong>' . esc_html__('Eleblog Addon', 'portfolio-builder-elementor') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'portfolio-builder-elementor') . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version()
		{

			if (isset($_GET['activate'])) unset($_GET['activate']);

			$message = sprintf(
				/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'portfolio-builder-elementor'),
				'<strong>' . esc_html__('ELEBLOG', 'portfolio-builder-elementor') . '</strong>',
				'<strong>' . esc_html__('PHP', 'portfolio-builder-elementor') . '</strong>',
				self::MINIMUM_PHP_VERSION
			);

			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}


		/**
		 * _widget_categories()
		 * @since 1.0.0
		 * */

		public function _widget_categories($elements_manager)
		{
			$elements_manager->add_category(
				'portfolio-builder-elementor',
				[
					'title' => esc_html__('Portfolio', 'portfolio-builder-elementor'),
					'icon' => 'fa fa-plug',
				]
			);
		}


		/*
		*
		* icon support
		*/

		public function editor_icon()
		{
			wp_enqueue_style('swp-editor-icon', PORTFOLIO_BUILDER_ELEMENTOR_CSS . '/editor-icon.css', '1.0');
		}


		/**
		 * _widget_registered()
		 * @since 1.0.0
		 * */
		public function _widget_registered()
		{

			if (!class_exists('Elementor\Widget_Base')) {
				return;
			}
			$elementor_widgets = array(
				'grid',
				'generel'
			);
			$elementor_widgets = apply_filters('portfolio_builder_elementor_elementor_widget', $elementor_widgets);

			if (is_array($elementor_widgets) && !empty($elementor_widgets)) {

				foreach ($elementor_widgets as $widget) {

					$template_file = PORTFOLIO_BUILDER_ELEMENTOR_ELEMENTOR . '/widgets/class-swp-portfolio-style-' . $widget . '.php';

					if ($template_file && is_readable($template_file)) {
						include_once $template_file;
					}
				}
			}
		}
	}

	Swp_Portfolio_Elementor_Widgets_Init::instance();
}
