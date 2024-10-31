<?php

/**
 * Portfolio builder
 *
 * @package     swp-portfolio
 * @author      SolverWP
 * @copyright   2023 solverwp
 * @license     GPL-2.0-or-later
 *
 * Plugin Name: Elementor Portfolio Builder
 * Plugin URI:  https://solverwp.com/
 * Description: Portfolio Builder - Elementor Portfolio Addon is a fully responsive plugin that display your company or personal portfolio/ Gallery items. From admin panel you can easily add your portfolio items. It has widget included with carousel,Isotope,Masonary, Tab, Grid with different settings how many want to display total or  at a time and many more. It has the different custom Project URL, features, video url and many more.
 * Version:     1.0.0
 * Author:      SolverWP
 * Author URI:  https://themeforest.net/user/solverwp/portfolio
 * Text Domain: swp-portfolio
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */


if (!defined('ABSPATH')) {
	die;
}


if (class_exists('Swp_Portfolio_Init')) {
	return;
}

/*
 * Define Plugin Dir Path
 * @since 1.0.0
 * */
define('PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH', plugin_dir_path(__FILE__));
define('PORTFOLIO_BUILDER_ELEMENTOR_ROOT_URL', plugin_dir_url(__FILE__));
define('PORTFOLIO_BUILDER_ELEMENTOR_INC', PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH . '/inc');
define('PORTFOLIO_BUILDER_ELEMENTOR_CSS', PORTFOLIO_BUILDER_ELEMENTOR_ROOT_URL . 'assets/css');
define('PORTFOLIO_BUILDER_ELEMENTOR_JS', PORTFOLIO_BUILDER_ELEMENTOR_ROOT_URL . 'assets/js');
define('PORTFOLIO_BUILDER_ELEMENTOR_IMG', PORTFOLIO_BUILDER_ELEMENTOR_ROOT_URL . 'assets/img');
define('PORTFOLIO_BUILDER_ELEMENTOR_ELEMENTOR', PORTFOLIO_BUILDER_ELEMENTOR_ROOT_PATH . '/elementor');


/** Plugin version **/
define('PORTFOLIO_BUILDER_ELEMENTOR_VERSION', '1.0.0');



/**
 * Load plugin textdomain.
 */
add_action('plugins_loaded', 'portfolio_builder_elementor_textdomain');
if (!function_exists('portfolio_builder_elementor_textdomain')) {

	function portfolio_builder_elementor_textdomain()
	{
		load_plugin_textdomain('portfolio-builder-elementor', false, plugin_basename(dirname(__FILE__)) . '/language');
	}
}


/*
 * require file
*/

if (file_exists(PORTFOLIO_BUILDER_ELEMENTOR_INC . '/class-portfolio-builder-elementor-init.php')) {
	require_once PORTFOLIO_BUILDER_ELEMENTOR_INC . '/class-portfolio-builder-elementor-init.php';
}


function swp_portfolio_notice()
{
	$user_id = get_current_user_id();
	if (!get_user_meta($user_id, 'swp_portfolio_notice_dismissed'))
		echo '<div class="notice-success notice"><h3><a target="_blank" style="text-decoration: none;line-height: 20px;color: #3c434a;font-size:13px" href="https://1.envato.market/vnq6Ky"  >Get access to 60+ million creative assets Like WordPress Themes/PLugins, Html/React,Vue Templates,Android Scripts, Graphics templates,Sound,After Effects And more only at <span style="font-size:15px;color:blue; text-decoration:underline">$16.50</span></a><a style="text-decoration:none;float:right" href="?swp_portfolio-dismissed"><span class="dashicons dashicons-no"></span></a></h3></div>';
}
add_action('admin_notices', 'swp_portfolio_notice');

function swp_portfolio_notice_dismissed()
{
	$user_id = get_current_user_id();
	if (isset($_GET['swp_portfolio-dismissed']))
		add_user_meta($user_id, 'swp_portfolio_notice_dismissed', 'true', true);
}
add_action('admin_init', 'swp_portfolio_notice_dismissed');


add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'swp_portfolio_pro_link');
function swp_portfolio_pro_link($links)
{
	$links[] = '<a target="_blank" href="https://1.envato.market/vnErvv">Go Pro</a>';
	return $links;
}
