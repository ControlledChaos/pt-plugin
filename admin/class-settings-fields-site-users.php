<?php
/**
 * Settings fields for user options.
 *
 * @package    PT_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace PT_Plugin\Admin;

use PT_Plugin\Admin\Partials\Field_Callbacks\Users_Callbacks as Callbacks;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Settings fields for user options.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Users {

    /**
	 * Instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

			// Require the class files.
			$instance->dependencies();

		}

		// Return the instance.
		return $instance;

	}

    /**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
    public function __construct() {

        // Media settings.
        add_action( 'admin_init', [ $this, 'settings' ] );

	}

	/**
	 * Class dependency files.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Callbacks for the Dashboard tab.
		require PTP_PATH . 'admin/partials/field-callbacks/class-users-callbacks.php';

	}

    /**
	 * User settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings() {

        // User settings section.
        add_settings_section(
            'ptp-site-users',
            __( 'User Settings', 'pt-plugin' ),
            [],
            'ptp-site-users'
        );

        // Local avatars only (no Gravatars).
		add_settings_field(
			'ptp_block_gravatar',
			__( 'Block Gravatars', 'pt-plugin' ),
			[ Callbacks::instance(), 'block_gravatar' ],
			'ptp-site-users',
			'ptp-site-users',
			[ esc_html__( 'Prevent avatar requests from Gravatar.com', 'pt-plugin' ) ]
		);

		register_setting(
			'ptp-site-users',
			'ptp_block_gravatar'
		);

    }

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function ptp_settings_fields_users() {

	return Settings_Fields_Users::instance();

}

// Run an instance of the class.
ptp_settings_fields_users();