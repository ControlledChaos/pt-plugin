<?php
/**
 * Field import page.
 *
 * @package    PT_Plugin
 * @subpackage controlled-chaos
 * @since controlled-chaos 1.0.0
 */

namespace PT_Plugin\Fields_Import_Page;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$active_tab = 'ptp-registered-fields-import';
if ( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'ptp-registered-fields-import';
} ?>

<div class="wrap import-registered-field-groups">
    <h1><?php esc_html_e( 'Registered Fields', 'pt-plugin' ); ?></h1>
    <p class="description"><?php esc_html_e( 'Tools for ACF fields registered by the Controlled Chaos plugin.', 'pt-plugin' ); ?></p>
    <h2 class="nav-tab-wrapper">
        <a href="edit.php?post_type=acf-field-group&page=acf-theme-fields&tab=ptp-registered-fields-import" class="nav-tab <?php echo $active_tab == 'ptp-registered-fields-import' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Import', 'pt-plugin' ); ?></a>
        <a href="edit.php?post_type=acf-field-group&page=acf-theme-fields&tab=ptp-registered-fields-activation" class="nav-tab <?php echo $active_tab == 'ptp-registered-fields-activation' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Activation', 'pt-plugin' ); ?></a>
    </h2>
    <?php if ( $active_tab == 'ptp-registered-fields-import' ) :

        // Check the version of ACF.
        $acf_version = explode( '.', acf_get_setting( 'version' ) );
        if ( $acf_version[0] != '5' ) : ?>
        <div id="message" class="error below-h2">
            <p><?php printf( esc_html__( 'This tool was built for ACF version 5 and you have version %s.', 'pt-plugin' ) ); ?></p>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $imported ) ) { ?>
        <div id="message" class="updated below-h2">
            <p><strong><?php esc_html_e( 'Field groups imported:', 'pt-plugin' ); ?></strong></p>
            <ul>
            <?php foreach ( $imported as $import ) { ?>
                <li><?php edit_post_link( $import['title'], '', '', $import['id']); ?></li>
            <?php } ?>
            </ul>
        </div>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php esc_html_e( 'Next step:', 'pt-plugin' ); ?></strong></p>
            <?php printf(
                '<p><a href="%1s">%2s</a>%3s</p>',
                admin_url( '/edit.php?post_type=acf-field-group&page=acf-theme-fields&tab=ptp-registered-fields-activation' ),
                esc_html__( 'Disable', 'pt-plugin' ),
                esc_html__( ' the imported field groups. The duplicate field IDs will interfere with the editing of fields.', 'pt-plugin' )
            ); ?>
        </div>
        <?php }
        printf( '<p>%1s</p>', esc_html__( 'This tool imports any field groups registered outside the ACF plugin so that they can be edited.', 'pt-plugin' ) ); ?>
        <?php if ( ! empty( $acf_local->groups ) ) : ?>

        <form method="POST">
            <table class="widefat">
                <thead>
                    <th><?php esc_html_e( 'Import', 'pt-plugin' ); ?></th>
                    <th><?php esc_html_e( 'Registered Field Groups', 'pt-plugin' ); ?></th>
                    <th><?php esc_html_e( 'Possible Existing Matches', 'pt-plugin' ); ?></th>
                </thead>
                <tbody>
                    <?php
                    foreach( $acf_local->groups as $key => $field_group ): ?>
                    <tr>
                        <td><input type="checkbox" name="fieldsets[]" value="<?php echo esc_attr( $key ); ?>" /></td>
                        <td><?php echo $field_group['title']; ?></td>
                        <td><?php
                        $sql = "SELECT ID, post_title FROM $wpdb->posts WHERE post_title LIKE '%s' AND post_type='acf-field-group'";
                        // Set post status
                        $post_status = apply_filters( 'acf_recovery\query\post_status', '' );
                        if ( ! empty( $post_status ) ) {
                            $sql .= ' AND post_status="' . esc_sql( $post_status ) . '"';
                        }
                        $matches = $wpdb->get_results( $wpdb->prepare( $sql, '%' . $wpdb->esc_like( $field_group['title'] ) .'%' ) );
                        if ( empty( $matches ) ) {
                            echo '<em>' . esc_html__( 'No matches found.', 'pt-plugin' ) . '</em>';
                        } else {
                            $links = array();
                            foreach ( $matches as $match ) {
                            $links[] = '<a href="' . get_edit_post_link( $match->ID ) . '">' . $match->post_title . '</a>';
                        }
                            echo implode( ', ', $links );
                        }
                        ?></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php wp_nonce_field( 'acf_php_recovery' ); ?>
            <input type="hidden" name="acf_php_recovery_action" value="import" />
            <p class="submit">
                <input type="submit" value="<?php esc_html_e( 'Import', 'pt-plugin' ); ?>" class="button-primary" />
            </p>
        </form>

        <h3><?php esc_html_e( 'Field groups found in files:', 'pt-plugin' ); ?></h3>

        <pre class="import-registered-field-groups-arrays">
        <?php echo var_export( $acf_local->groups ); ?>
        </pre>

        <?php else : ?>

        <p><strong><?php _e( 'No field groups found in files.', 'pt-plugin' ); ?></strong></p>

        <?php endif; ?>
    <?php elseif ( $active_tab == 'ptp-registered-fields-activation' ) : ?>
    <form action="options.php" method="post">
        <?php settings_fields( 'ptp-registered-fields-activate' );
        do_settings_sections( 'ptp-registered-fields-activate' ); ?>
        <p class="submit"><?php submit_button( __( 'Save Settings', 'pt-plugin' ), 'primary', '', false, [] ); echo ' '; ?></p>
    </form>
    <?php endif; ?>
</div>