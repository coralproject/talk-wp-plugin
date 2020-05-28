<?php
/**
 * Plugin Name: Coral by Vox Media
 * Plugin URI: https://coralproject.net
 * Description: A plugin to replace stock WP commenting with Coral by Vox Media comments.
 * Version: 0.2.3
 * Author: Coral by Vox Media, Alley Interactive
 * Author URI: https://www.coralproject.net
 * License: Apache 2.0
 *
 * @package Talk_Plugin
 */

define( 'CORAL_PROJECT_TALK_DIR', dirname( __FILE__ ) );

/**
 * Class Talk_Plugin
 */
class Talk_Plugin {
	/**
	 * Talk_Plugin constructor.
	 */
	public function __construct() {
		require_once( CORAL_PROJECT_TALK_DIR . '/inc/helper-functions.php' );
		require_once( CORAL_PROJECT_TALK_DIR . '/inc/class-talk-settings-page.php' );
		require_once( CORAL_PROJECT_TALK_DIR . '/inc/class-talk-default-comments-settings.php' );
		add_filter( 'comments_template', function( $default_template_path ) {
			return coral_talk_plugin_is_usable() && coral_talk_plugin_enable_for_page() ?
				coral_talk_get_comments_template_path() :
				$default_template_path;
		}, 99 );
		add_filter( 'amp_post_template_data', function ( $data ) {
			$display_comments_on = ampforwp_get_comments_status();
			if ( $display_comments_on ) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}}
			$styles = ["background: transparent"];
			if ( empty( $data['post_amp_styles']['.talk-amp-iframe'] ) ) {
				$data['post_amp_styles']['.talk-amp-iframe'] = $styles;
			} else {
				$data['post_amp_styles']['.talk-amp-iframe'] = array_merge($styles, $data['post_amp_styles']['.talk-amp-iframe']);
			}
			return $data;
		} );
		add_action ( 'ampforwp_before_comment_hook', function() {
			$display_comments_on = ampforwp_get_comments_status();
			if ( $display_comments_on ) {
				coral_talk_comments_amp_template();
			}
		});
		add_action( 'admin_notices', function() {
			if ( ! coral_talk_plugin_is_usable() ) {
				coral_talk_print_admin_notice(
					'warning',
					__( 'The Base URL is required in %sCoral Plugin settings%s', 'coral-project-talk' )
				);
			}
		} );
	}
}

/**
 * Assuming that the plugin is active (otherwise this function won't be available)
 * determine if the required Talk instance URL option is set
 *
 * @since 0.0.2
 * @return bool
 */
function coral_talk_plugin_is_usable() {
	$talk_url = get_option( 'coral_talk_base_url' );
	return ! empty( $talk_url );
}

/**
 * Check if comments should be rendered for the current page
 *
 * @since 0.1.1
 * @return bool
 */
function coral_talk_plugin_enable_for_page() {
	global $post;
	if ( ! isset( $post ) ) {
		return false;
	}
	// Don't render if comments are off for this post
	if ( ! comments_open() ) {
		return false;
	}
	// Don't render if this is a preview
	if ( in_array( $post->post_status, array(
		'draft', 'auto-draft', 'pending', 'future', 'trash'
	) ) ) {
		return false;
	}
	return true;
}

/**
 * Get absolute path to comments template file
 *
 * @since 0.0.2
 * @return string File path
 */
function coral_talk_get_comments_template_path() {
	return ( CORAL_PROJECT_TALK_DIR . '/inc/comments-template.php' );
}

/**
 * Get absolute path to comments amp template file
 *
 * @since 0.2.0
 * @return string File path
 */
function coral_talk_get_comments_amp_template_path() {
	return ( CORAL_PROJECT_TALK_DIR . '/inc/comments-amp-template.php' );
}

/**
 * Template tag to render the Coral Talk amp template.
 *
 * @since 0.2.0
 */
function coral_talk_comments_amp_template() {
	require( coral_talk_get_comments_amp_template_path() );
}


/**
 * Template tag to render the Coral Talk template without the performance hit of
 * filtering comments_template()
 *
 * @since 0.0.1
 */
function coral_talk_comments_template() {
	require( coral_talk_get_comments_template_path() );
}

/**
 * Construct asset_id based on current post type and ID.
 * Must be used inside The Loop.
 *
 * @return string asset_id
 * @since 0.0.2
 */
function coral_talk_get_asset_id() {
	return get_post_type() . '-' . get_the_ID();
}

new Talk_Plugin;
