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
	 * @since 0.0.3 Added new container classes setting
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
		register_setting( 'talk-settings', 'coral_talk_base_url', array(
			'type' => 'string',
			'sanitize_callback' => array( $this, 'sanitize_url' ),
		) );

		add_settings_field(
			'coral_talk_static_url',
			__( 'Talk Static Asset URL', 'coral-project-talk' ),
			array( $this, 'render_static_url_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_talk_static_url', array(
			'type' => 'string',
			'sanitize_callback' => array( $this, 'sanitize_url' ),
		) );

		add_settings_field(
			'coral_talk_container_classes',
			__( 'Talk Embed Container CSS Classes', 'coral-project-talk' ),
			array( $this, 'render_container_classes_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_talk_container_classes' );
	}

	/**
	 * Sanitizes base URL input, removing trailing slash
	 *
	 * @param String $url Input to sanitize.
	 * @return String Sanitized and untrailingslashed URL.
	 * @since 0.0.6
	 */
	public function sanitize_url( $url ) {
		return esc_url( untrailingslashit( $url ) );
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
		<p class="description">The root url of the installed Talk application.</p>
		<?php
	}

	/**
	 * Prints input field for static url setting.
	 *
	 * @since 0.1.0
	 */
	public function render_static_url_field() {
		?>
		<input
				style="width: 600px; height: 40px;"
				name="coral_talk_static_url"
				placeholder="https://cdn.talk-assets.com"
				id="coral_talk_static_url"
				type="url"
				value="<?php echo esc_url( get_option( 'coral_talk_static_url' ) ); ?>"
		/>
		<p class="description">The root url where static Talk assets should be served from. This is used when static Talk assets are served from a CDN. (Default to the value of Talk Server Base URL)</p>
		<?php
	}

	/**
	 * Prints input field for settings.
	 *
	 * @since 0.0.3
	 */
	public function render_container_classes_field() {
		?>
		<input
			style="width: 600px; height: 40px;"
			name="coral_talk_container_classes"
			placeholder=""
			id="coral_talk_container_classes"
			type="text"
			value="<?php echo esc_attr( get_option( 'coral_talk_container_classes' ) ); ?>"
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

