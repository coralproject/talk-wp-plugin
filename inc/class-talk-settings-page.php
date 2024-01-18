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
			__( 'Coral Settings', 'coral-project-talk' ),
			__( 'Coral Settings', 'coral-project-talk' ),
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
			__( 'About Coral', 'coral-project-talk' ),
			function() {
				require_once( CORAL_PROJECT_TALK_DIR . '/inc/talk-settings-static-content.php' );
			},
			'talk-settings'
		);

		add_settings_field(
			'coral_talk_base_url',
			__( 'Server Base URL', 'coral-project-talk' ),
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
			__( 'Static Asset URL', 'coral-project-talk' ),
			array( $this, 'render_static_url_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_talk_static_url', array(
			'type' => 'string',
			'sanitize_callback' => array( $this, 'sanitize_url' ),
		) );

		add_settings_field(
			'coral_container_class_name',
			__( 'Embed Container CSS Class', 'coral-project-talk' ),
			array( $this, 'render_container_class_name_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_container_class_name' );

		add_settings_field(
			'coral_talk_version',
			__( 'Version', 'coral-project-talk' ),
			array( $this, 'render_version_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_talk_version' );

		add_settings_field(
			'coral_custom_css_url',
			__( 'Custom CSS URL', 'coral-project-talk' ),
			array( $this, 'render_custom_css_url_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_custom_css_url', array(
			'type' => 'string',
			'sanitize_callback' => array( $this, 'sanitize_url' ),
		) );

		add_settings_field(
			'coral_custom_fonts_css_url',
			__( 'Custom Fonts CSS URL', 'coral-project-talk' ),
			array( $this, 'render_custom_fonts_css_url_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_custom_fonts_css_url', array(
			'type' => 'string',
			'sanitize_callback' => array( $this, 'sanitize_url' ),
		) );

		add_settings_field(
			'coral_disable_default_fonts',
			__( 'Disable default fonts', 'coral-project-talk' ),
			array( $this, 'render_disable_default_fonts_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_disable_default_fonts');

		add_settings_field(
			'coral_custom_scroll_container',
			__( 'Custom scroll container', 'coral-project-talk' ),
			array( $this, 'render_custom_scroll_container_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_custom_scroll_container' );

		add_settings_field(
			'coral_enable_canonical_story_urls',
			__( 'Enable canonical story urls', 'coral-project-talk' ),
			array( $this, 'render_enable_canonical_story_urls_field' ),
			'talk-settings',
			'about-talk'
		);
		register_setting( 'talk-settings', 'coral_enable_canonical_story_urls' );
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
	 * Prints input field for base URL setting.
	 *
	 * @since 0.0.1
	 */
	public function render_base_url_field() {
		?>
		<input
			style="width: 600px; height: 40px;"
			name="coral_talk_base_url"
			placeholder="https://coral.my-site.com"
			id="coral_talk_base_url"
			type="url"
			value="<?php echo esc_url( get_option( 'coral_talk_base_url' ) ); ?>"
		/>
		<p class="description"><span style="font-weight: bold;">* Required.</span> The root url of the installed Coral application.</p>
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
				placeholder="https://cdn.coral-assets.com"
				id="coral_talk_static_url"
				type="url"
				value="<?php echo esc_url( get_option( 'coral_talk_static_url' ) ); ?>"
		/>
		<p class="description">The root url where static Coral assets should be served from. This is the same value as defined by the <a href="<?php echo esc_url( 'https://docs.coralproject.net/environment-variables#static_uri' ); ?>">STATIC_URI</a> environment variable.</p>
		<?php
	}

	/**
	 * Prints input field for custom CSS url setting.
	 *
	 * @since 1.0.0
	 */
	public function render_custom_css_url_field() {
		?>
		<input
				style="width: 600px; height: 40px;"
				name="coral_custom_css_url"
				placeholder="https://cdn.coral-assets.com/coral_custom.css"
				id="coral_custom_css_url"
				type="url"
				value="<?php echo esc_url( get_option( 'coral_custom_css_url' ) ); ?>"
		/>
		<p class="description">URL for a custom stylesheet to be included to style this Coral stream. To configure a custom stylesheet for all streams, see advanced configuration options in the admin.</p>
		<?php
	}

	/**
	 * Prints input field for custom fonts CSS url setting.
	 *
	 * @since 1.0.0
	 */
	public function render_custom_fonts_css_url_field() {
		?>
		<input
				style="width: 600px; height: 40px;"
				name="coral_custom_fonts_css_url"
				placeholder="https://cdn.coral-assets.com/coral_custom_fonts.css"
				id="coral_custom_fonts_css_url"
				type="url"
				value="<?php echo esc_url( get_option( 'coral_custom_fonts_css_url' ) ); ?>"
		/>
		<p class="description">URL for a custom stylesheet with font-face definitions to be included to style this Coral stream. To configure a custom stylesheet for all streams, see advanced configuration options in the admin.</p>
		<?php
	}

	/**
	 * Prints input field for Coral container class name setting.
	 *
	 * @since 1.0.0
	 */
	public function render_container_class_name_field() {
		?>
		<input
			style="width: 600px; height: 40px;"
			name="coral_container_class_name"
			placeholder=""
			id="coral_container_class_name"
			type="text"
			value="<?php echo esc_attr( get_option( 'coral_container_class_name' ) ); ?>"
		/>
		<p class="description">HTML class name to add to the container of the stream embed for CSS targeting.</p>
		<?php
	}

	/**
	 * Prints input field for custom scroll container setting.
	 *
	 * @since 1.0.0
	 */
	public function render_custom_scroll_container_field() {
		?>
		<input
			style="width: 600px; height: 40px;"
			name="coral_custom_scroll_container"
			placeholder="myElementId"
			id="coral_custom_scroll_container"
			type="text"
			value="<?php echo esc_attr( get_option( 'coral_custom_scroll_container' ) ); ?>"
		/>
		<p class="description">Supports a custom scroll container element if Coral is rendered outside of the render window. Add the element id you wish to use, and Coral will find it if it's in the document and send it through.</p>
		<?php
	}

	/**
	 * Prints input field for disable default fonts setting.
	 *
	 * @since 1.0.0
	 */
	public function render_disable_default_fonts_field() {
		$default_fonts = esc_attr( get_option( 'coral_disable_default_fonts' ) )
		?>
		<select
				style="width: 600px; height: 40px;"
				name="coral_disable_default_fonts"
				placeholder=""
				id="coral_disable_default_fonts"
				type="select"
		>
		<option value="false"
				<?php 
					if ($default_fonts === "false")
						echo "selected=\"selected\""
				?>
			>
				false
			</option>
		<option value="true"
				<?php 
					if ($default_fonts === "true")
						echo "selected=\"selected\""
				?>
			>
				true
			</option>
	</select>
		<p class="description">Disable default fonts will turn off font-face loading of Coral's default fonts.</p>
		<?php
	}

	/**
	 * Prints input field for disable default fonts setting.
	 *
	 * @since 1.0.0
	 */
	public function render_enable_canonical_story_urls_field() {
		$default_fonts = esc_attr( get_option( 'coral_enable_canonical_story_urls' ) )
		?>
		<select
				style="width: 600px; height: 40px;"
				name="coral_enable_canonical_story_urls"
				placeholder=""
				id="coral_enable_canonical_story_urls"
				type="select"
		>
		<option value="true"
				<?php 
					if ($default_fonts === "true")
						echo "selected=\"selected\""
				?>
			>
				true
			</option>
			<option value="false"
				<?php 
					if ($default_fonts === "false")
						echo "selected=\"selected\""
				?>
			>
				false
			</option>
	</select>
		<p class="description">When enabled, the canonical story URL will be passed through to the Coral stream embed.</p>
		<?php
	}

	/**
	 * Prints drop down for version.
	 *
	 * @since 0.0.3
	 */
	public function render_version_field() {
		$talk_version = esc_attr( get_option( 'coral_talk_version' ) )
		?>
		<select
			style="width: 600px; height: 40px;"
			name="coral_talk_version"
			placeholder=""
			id="coral_talk_version"
			type="select"
		>
			<option value="4"
				<?php 
					if ($talk_version === "4")
						echo "selected=\"selected\""
				?>
			>
				4
			</option>
			<option value="5"
				<?php 
					if ($talk_version === "5")
						echo "selected=\"selected\""
				?>
			>
				5+
			</option>
		</select>
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
			<h2><?php esc_html_e( 'Coral Settings', 'coral-project-talk' ) ?></h2>
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

