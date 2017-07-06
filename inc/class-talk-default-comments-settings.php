<?php
/**
 * Adjust WordPress comments settings display in WP Admin with Coral Talk is active
 *
 * @package Talk_Plugin
 */

class Talk_Default_Comments_Settings {
	/**
	 * Just the constructor
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'options_discussion_notice' ) );
		add_filter( 'admin_menu', function() {
			remove_menu_page( 'edit-comments.php' );
		} );
		add_action( 'post_comment_status_meta_box-options', function() {
			printf( '<p><em>%s</em></p>',
				esc_html__( 'Comments managed by Coral Project Talk', 'coral-project-talk' )
			);
		} );
	}

	public function options_discussion_notice() {
		$screen = get_current_screen();
		if ( 'options-discussion' !== $screen->base ) {
			return;
		}
		printf(
			'<div class="notice notice-success"><p>%s</p></div>',
			sprintf(
				esc_html__( 'Comments are managed by Coral Project Talk. (%ssettings%s)', 'coral-project-talk' ),
				'<a href="' . esc_url( admin_url( 'options-general.php?page=talk-settings' ) ) . '">',
				'</a>'
			)
		);
	}
}

new Talk_Default_Comments_Settings;
