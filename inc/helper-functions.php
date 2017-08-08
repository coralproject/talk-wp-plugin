<?php
/**
 * Helper functions
 *
 * @package Talk_Plugin
 * @since 0.0.4
 */

/**
 * Prints an admin notice. If the message contains two %s placeholders,
 * the content between them will be wrapped in a link to the plugin settings page
 *
 * @param string $type 'error', 'warning', 'success'.
 * @param string $message Translated message text.
 */
function coral_talk_print_admin_notice( $type = 'error', $message = 'Coral Talk error' ) {
	$has_link = ( 2 === substr_count( $message, '%s' ) );

	?>
		<div class="notice notice-<?php echo esc_attr( $type ); ?>">
			<p><?php echo ! $has_link ?
				esc_html( $message ) :
				sprintf(
					esc_html( $message ),
					'<a href="' . esc_url( admin_url( 'options-general.php?page=talk-settings' ) ) . '">',
					'</a>'
				);
			?>
			</p>
		</div>
	<?php
}
