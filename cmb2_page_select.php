<?php
/**
 * Plugin Name: CMB2 Page Select Field
 * Plugin URI: https://github.com/udhaya0000/cmb2-page-select-field
 * Description: This plugin is borrowed from WebDevStudios CMB2-post-search-field plugin, Custom field for CMB2 which adds a page-search dialog for searching/attaching other post IDs
 * Author: udhayakumar sadagopan
 * Author URI: http://udhayakumars.com
 * Version: 1.0.0
 * License: GPLv2
*/

/**
 * CMB2_Page_Select_field loader
 *
 * Handles checking for and smartly loading the newest version of this library.
 *
 * @category  WordPressLibrary
 * @package   CMB2_Page_Select_field
 * @author    udhayakumar sadagopan <udhaya0000@gmail.com>
 * @copyright 2019 udhayakumar <udhaya0000@gmail.com>
 * @license   GPL-2.0+
 * @version   1.0.0
 * @link      https://github.com/udhaya0000/cmb2-page-select-field
 * @since     1.0.0
 */


if ( ! class_exists( 'CMB2_Page_Select', false ) ) {

	/**
	 * Versioned loader class-name
	 *
	 * This ensures each version is loaded/checked.
	 *
	 * @category  WordPressLibrary
	 * @package   CMB2_Page_Select_field
	 * @author    udhayakumar sadagopan <udhaya0000@gmail.com>
	 * @license   GPL-2.0+
	 * @version   1.0.0
	 * @link      https://github.com/udhaya0000/cmb2-page-select-field
	 * @since     1.0.0
	 */
	class CMB2_Page_Select {

		/**
		 * CMB2_Page_Select_field version number
		 * @var   string
		 * @since 1.0.0
		 */
		const VERSION = '1.0.0';

		/**
		 * Current version hook priority.
		 * Will decrement with each release
		 *
		 * @var   int
		 * @since 1.0.0
		 */
		const PRIORITY = 9998;

		/**
		 * Starts the version checking process.
		 * Creates CMB2_Page_Select_field definition for early detection by
		 * other scripts.
		 *
		 * Hooks CMB2_Page_Select_field inclusion to the cmb2_page_select_field_load hook
		 * on a high priority which decrements (increasing the priority) with
		 * each version release.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			if ( ! defined( 'CMB2_PAGE_SELECT_LOADED' ) ) {
				/**
				 * A constant you can use to check if CMB2_Page_Select_field is loaded
				 * for your plugins/themes with CMB2_Page_Select_field dependency.
				 *
				 * Can also be used to determine the priority of the hook
				 * in use for the currently loaded version.
				 */
				define( 'CMB2_PAGE_SELECT_LOADED', self::PRIORITY );
			}

			// Use the hook system to ensure only the newest version is loaded.
			add_action( 'cmb2_page_select_load', array( $this, 'include_lib' ), self::PRIORITY );

			// Use the hook system to ensure only the newest version is loaded.
			add_action( 'after_setup_theme', array( $this, 'do_hook' ) );
		}

		/**
		 * Fires the cmb2_attached_posts_field_load action hook
		 * (from the after_setup_theme hook).
		 *
		 * @since 1.2.3
		 */
		public function do_hook() {
			// Then fire our hook.
			do_action( 'cmb2_page_select_load' );
		}

		/**
		 * A final check if CMB2_Page_Select_field exists before kicking off
		 * our CMB2_Page_Select_field loading.
		 *
		 * CMB2_PAGE_SELECT_FIELD_VERSION and CMB2_PAGE_SELECT_FIELD_DIR constants are
		 * set at this point.
		 *
		 * @since  1.0.0
		 */
		public function include_lib() {
			if ( class_exists( 'CMB2_Page_Select_field', false ) ) {
				return;
			}

			if ( ! defined( 'CMB2_PAGE_SELECT_VERSION' ) ) {
				/**
				 * Defines the currently loaded version of CMB2_Post_Search_field.
				 */
				define( 'CMB2_PAGE_SELECT_VERSION', self::VERSION );
			}

			if ( ! defined( 'CMB2_PAGE_SELECT_DIR' ) ) {
				/**
				 * Defines the directory of the currently loaded version of CMB2_Post_Search_field.
				 */
				define( 'CMB2_PAGE_SELECT_DIR', dirname( __FILE__ ) . '/' );
			}

			// Include and initiate CMB2_Post_Search_field.
			require_once CMB2_PAGE_SELECT_DIR . 'lib/init.php';
		}

	}

	// Kick it off.
	new CMB2_Page_Select;
}
