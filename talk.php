<?php
/**
 * Plugin Name: Coral Project Talk
 * Plugin URI: https://coralproject.net
 * Description: A plugin to replace stock WP commenting with Talk from the Coral Project
 * Version: 0.0.1
 * Author: Alley Interactive, Josh Kadis
 * Author URI: https://www.alleyinteractive.com
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
		require_once( CORAL_PROJECT_TALK_DIR . '/inc/class-talk-settings-page.php' );
		add_filter( 'comments_template', function() {
			return ( CORAL_PROJECT_TALK_DIR . '/inc/comments-template.php' );
		}, 99 );
	}
}

function coral_talk_comments_template() {
	require( CORAL_PROJECT_TALK_DIR . '/inc/comments-template.php' );
}

new Talk_Plugin;
