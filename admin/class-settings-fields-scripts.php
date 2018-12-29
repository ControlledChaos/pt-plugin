<?php
/**
 * Settings fields for script loading and more.
 *
 * @package    PT_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace PT_Plugin\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Settings fields for script loading and more.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Scripts {

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

		// Register settings.
		add_action( 'admin_init', [ $this, 'settings' ] );

		// Include jQuery Migrate.
		$migrate = get_option( 'ptp_jquery_migrate' );
		if ( ! $migrate ) {
			add_action( 'wp_default_scripts', [ $this, 'include_jquery_migrate' ] );
		}

	}

	/**
	 * Register settings via the WordPress/ClassicPress Settings API.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings() {

		/**
		 * Generl script options.
		 */
		add_settings_section( 'ptp-scripts-general', __( 'General Options', 'pt-plugin' ), [ $this, 'scripts_general_section_callback' ], 'ptp-scripts-general' );

		// Inline scripts.
		add_settings_field( 'ptp_inline_scripts', __( 'Inline Scripts', 'pt-plugin' ), [ $this, 'ptp_inline_scripts_callback' ], 'ptp-scripts-general', 'ptp-scripts-general', [ esc_html__( 'Add script contents to footer', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-general',
			'ptp_inline_scripts'
		);

		// Inline styles.
		add_settings_field( 'ptp_inline_styles', __( 'Inline Styles', 'pt-plugin' ), [ $this, 'ptp_inline_styles_callback' ], 'ptp-scripts-general', 'ptp-scripts-general', [ esc_html__( 'Add script-related CSS contents to head', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-general',
			'ptp_inline_styles'
		);

		// Inline jQuery.
		add_settings_field( 'ptp_inline_jquery', __( 'Inline jQuery', 'pt-plugin' ), [ $this, 'ptp_inline_jquery_callback' ], 'ptp-scripts-general', 'ptp-scripts-general', [ esc_html__( 'Deregister jQuery and add its contents to footer', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-general',
			'ptp_inline_jquery'
		);

		// Include jQuery Migrate.
		add_settings_field( 'ptp_jquery_migrate', __( 'jQuery Migrate', 'pt-plugin' ), [ $this, 'ptp_jquery_migrate_callback' ], 'ptp-scripts-general', 'ptp-scripts-general', [ esc_html__( 'Use jQuery Migrate for backwards compatibility', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-general',
			'ptp_jquery_migrate'
		);

		// Remove emoji script.
		add_settings_field( 'ptp_remove_emoji_script', __( 'Emoji Script', 'pt-plugin' ), [ $this, 'remove_emoji_script_callback' ], 'ptp-scripts-general', 'ptp-scripts-general', [ esc_html__( 'Remove emoji script from <head>', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-general',
			'ptp_remove_emoji_script'
		);

		// Remove WordPress/ClassicPress version appended to script links.
		add_settings_field( 'ptp_remove_script_version', __( 'Script Versions', 'pt-plugin' ), [ $this, 'remove_script_version_callback' ], 'ptp-scripts-general', 'ptp-scripts-general', [ esc_html__( 'Remove WordPress/ClassicPress version from script and stylesheet links in <head>', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-general',
			'ptp_remove_script_version'
		);

		// Minify HTML.
		add_settings_field( 'ptp_html_minify', __( 'Minify HTML', 'pt-plugin' ), [ $this, 'html_minify_callback' ], 'ptp-scripts-general', 'ptp-scripts-general', [ esc_html__( 'Minify HTML source code to increase load speed', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-general',
			'ptp_html_minify'
		);

		/**
		 * Use included vendor scripts & options.
		 */
		add_settings_section( 'ptp-scripts-vendor', __( 'Included Vendor Scripts', 'pt-plugin' ), [ $this, 'scripts_vendor_section_callback' ], 'ptp-scripts-vendor' );

		// Use Slick.
		add_settings_field( 'ptp_enqueue_slick', __( 'Slick', 'pt-plugin' ), [ $this, 'enqueue_slick_callback' ], 'ptp-scripts-vendor', 'ptp-scripts-vendor', [ esc_html__( 'Use Slick script and stylesheets', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-vendor',
			'ptp_enqueue_slick'
		);

		// Use Tabslet.
		add_settings_field( 'ptp_enqueue_tabslet', __( 'Tabslet', 'pt-plugin' ), [ $this, 'enqueue_tabslet_callback' ], 'ptp-scripts-vendor', 'ptp-scripts-vendor', [ esc_html__( 'Use Tabslet script', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-vendor',
			'ptp_enqueue_tabslet'
		);

		// Use Sticky-kit.
		add_settings_field( 'ptp_enqueue_stickykit', __( 'Sticky-kit', 'pt-plugin' ), [ $this, 'enqueue_stickykit_callback' ], 'ptp-scripts-vendor', 'ptp-scripts-vendor', [ esc_html__( 'Use Sticky-kit script', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-vendor',
			'ptp_enqueue_stickykit'
		);

		/**
		 * Use Tooltipster.
		 *
		 * @todo Add option to enqueue on the backend.
		 */
		add_settings_field( 'ptp_enqueue_tooltipster', __( 'Tooltipster', 'pt-plugin' ), [ $this, 'enqueue_tooltipster_callback' ], 'ptp-scripts-vendor', 'ptp-scripts-vendor', [ esc_html__( 'Use Tooltipster script and stylesheet', 'pt-plugin' ) ] );

		register_setting(
			'ptp-scripts-vendor',
			'ptp_enqueue_tooltipster'
		);

		// Site Settings section.
		if ( ptp_acf_options() ) {

			add_settings_section( 'ptp-registered-fields-activate', __( 'Registered Fields Activation', 'pt-plugin' ), [ $this, 'registered_fields_activate' ], 'ptp-registered-fields-activate' );

			add_settings_field( 'ptp_acf_activate_settings_page', __( 'Site Settings Page', 'pt-plugin' ), [ $this, 'registered_fields_page_callback' ], 'ptp-registered-fields-activate', 'ptp-registered-fields-activate', [ __( 'Deactive the field group for the "Site Settings" options page.', 'pt-plugin' ) ] );

			register_setting(
				'ptp-registered-fields-activate',
				'ptp_acf_activate_settings_page'
			);

		}

	}

	/**
	 * General section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function scripts_general_section_callback( $args ) {

		$html = sprintf( '<p>%1s</p>', esc_html__( 'Inline settings only apply to scripts and styles included with the plugin.' ) );

		echo $html;

	}

	/**
	 * Inline jQuery.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function ptp_inline_jquery_callback( $args ) {

		$option = get_option( 'ptp_inline_jquery' );

		$html = '<p><input type="checkbox" id="ptp_inline_jquery" name="ptp_inline_jquery" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="ptp_inline_jquery"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>This may break the functionality of plugins that put scripts in the head</em>.</small></p>';

		echo $html;

	}

	/**
	 * Include jQuery Migrate.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function ptp_jquery_migrate_callback( $args ) {

		$option = get_option( 'ptp_jquery_migrate' );

		$html = '<p><input type="checkbox" id="ptp_jquery_migrate" name="ptp_jquery_migrate" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="ptp_jquery_migrate"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>Some outdated plugins and themes may be dependent on an old version of jQuery</em></small></p>';

		echo $html;

	}

	/**
	 * Inline scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function ptp_inline_scripts_callback( $args ) {

		$option = get_option( 'ptp_inline_scripts' );

		$html = '<p><input type="checkbox" id="ptp_inline_scripts" name="ptp_inline_scripts" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="ptp_inline_scripts"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Inline styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function ptp_inline_styles_callback( $args ) {

		$option = get_option( 'ptp_inline_styles' );

		$html = '<p><input type="checkbox" id="ptp_inline_styles" name="ptp_inline_styles" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="ptp_inline_styles"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Remove emoji script.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function remove_emoji_script_callback( $args ) {

		$option = get_option( 'ptp_remove_emoji_script' );

		$html = '<p><input type="checkbox" id="ptp_remove_emoji_script" name="ptp_remove_emoji_script" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="ptp_remove_emoji_script"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>Emojis will still work in modern browsers</em></small></p>';

		echo $html;

	}

	/**
	 * Script options and enqueue settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function remove_script_version_callback( $args ) {

		$option = get_option( 'ptp_remove_script_version' );

		$html = '<p><input type="checkbox" id="ptp_remove_script_version" name="ptp_remove_script_version" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="ptp_remove_script_version"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Minify HTML source code.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function html_minify_callback( $args ) {

		$option = get_option( 'ptp_html_minify' );

		$html = '<p><input type="checkbox" id="ptp_html_minify" name="ptp_html_minify" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="ptp_html_minify"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Vendor section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function scripts_vendor_section_callback( $args ) {

		$html = sprintf( '<p>%1s</p>', esc_html__( 'Look for Fancybox options on the Media Settings page.' ) );

		echo $html;

	}

	/**
	 * Use Slick.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_slick_callback( $args ) {

		$option = get_option( 'ptp_enqueue_slick' );

		$html = '<p><input type="checkbox" id="ptp_enqueue_slick" name="ptp_enqueue_slick" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="ptp_enqueue_slick"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://kenwheeler.github.io/slick/' ) ),
			esc_attr( __( 'Learn more about Slick', 'pt-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Tabslet.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_tabslet_callback( $args ) {

		$option = get_option( 'ptp_enqueue_tabslet' );

		$html = '<p><input type="checkbox" id="ptp_enqueue_tabslet" name="ptp_enqueue_tabslet" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="ptp_enqueue_tabslet"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://vdw.github.io/Tabslet/' ) ),
			esc_attr( __( 'Learn more about Tabslet', 'pt-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Sticky-kit.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_stickykit_callback( $args ) {

		$option = get_option( 'ptp_enqueue_stickykit' );

		$html = '<p><input type="checkbox" id="ptp_enqueue_stickykit" name="ptp_enqueue_stickykit" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="ptp_enqueue_stickykit"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://leafo.net/sticky-kit/' ) ),
			esc_attr( __( 'Learn more about Sticky-kit', 'pt-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Tooltipster.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_tooltipster_callback( $args ) {

		$option = get_option( 'ptp_enqueue_tooltipster' );

		$html = '<p><input type="checkbox" id="ptp_enqueue_tooltipster" name="ptp_enqueue_tooltipster" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="ptp_enqueue_tooltipster"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://iamceege.github.io/tooltipster/' ) ),
			esc_attr( __( 'Learn more about Tooltipster', 'pt-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Site Settings section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function registered_fields_activate() {

		if ( ptp_acf_options() ) {

			echo sprintf( '<p>%1s</p>', esc_html( 'The Controlled Chaos plugin registers custom fields for Advanced Custom Fields Pro that can be imported for editing. These built-in field goups must be deactivated for the imported field groups to take effect.', 'pt-plugin' ) );

		}

	}

	/**
	 * Site Settings section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function registered_fields_page_callback( $args ) {

		if ( ptp_acf_options() ) {

			$html = '<p><input type="checkbox" id="ptp_acf_activate_settings_page" name="ptp_acf_activate_settings_page" value="1" ' . checked( 1, get_option( 'ptp_acf_activate_settings_page' ), false ) . '/>';

			$html .= '<label for="ptp_acf_activate_settings_page"> '  . $args[0] . '</label></p>';

			echo $html;

		}

	}

	/**
	 * Include jQuery Migrate.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
    public function include_jquery_migrate( $scripts ) {

		if ( ! empty( $scripts->registered['jquery'] ) ) {

			$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, [ 'jquery-migrate' ] );

		}

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function ptp_settings_fields_scripts() {

	return Settings_Fields_Scripts::instance();

}

// Run an instance of the class.
ptp_settings_fields_scripts();