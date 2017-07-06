<?php
/**
 * Generate settings page for Talk plugin
 *
 * @package Talk_Plugin
 */
class Talk_Settings_Page {
	/**
	 * Talk_Settings_Page constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_settings_page' ) );
		add_action( 'admin_init', array( $this, 'setup_settings_page' ) );
	}

	/**
	 * Registers the functions to create the settings page.
	 *
	 * @since 0.0.1
	 */
	public function register_settings_page() {
		add_options_page(
			__( 'Talk Settings', 'coral-project-talk' ),
			__( 'Talk Settings', 'coral-project-talk' ),
			'manage_options',
			'talk-settings',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Registers the settings section(s) and field(s)
	 *
	 * @since 0.0.1
	 */
	public function setup_settings_page() {
		add_settings_section(
			'about-talk',
			__( 'About Talk', 'coral-project-talk' ),
			function() {
				require_once( CORAL_PROJECT_TALK_DIR . '/inc/talk-settings-static-content.php' );
			},
			'talk-settings'
		);

		add_settings_field(
			'coral_talk_base_url',
			__( 'Talk Server Base URL', 'coral-project-talk' ),
			array( $this, 'render_base_url_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_talk_base_url' );
	}

	/**
	 * Prints input field for settings.
	 *
	 * @since 0.0.1
	 */
	public function render_base_url_field() {
		?>
		<input
			style="width: 600px; height: 40px;"
			name="coral_talk_base_url"
			placeholder="https://talk.my-site.com"
			id="coral_talk_base_url"
			type="url"
			value="<?php echo esc_url( get_option( 'coral_talk_base_url' ) ); ?>"
		/>
		<?php
	}

	/**
	 * Generates the markup for the settings page.
	 *
	 * @since 0.0.1
	 */
	public function render_settings_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Talk Settings', 'coral-project-talk' ) ?></h2>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'talk-settings' );
				do_settings_sections( 'talk-settings' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}

new Talk_Settings_Page;

