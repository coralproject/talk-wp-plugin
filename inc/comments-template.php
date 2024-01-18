<?php
/**
 * Comments template replacement.
 * This will replace the default comments.php when calling comments_template()
 * However, it is more performant to use coral_talk_comments_template()
 *
 * @package Talk_Plugin
 * @since 0.0.3 Added support for talk container class and removed id
 * @since 1.0.0 Added support for custom CSS url, custom fonts CSS url, 
 * disable default fonts, custom scroll container, canonical story url, and story mode. Also
 * updated support for container class name.
 */

$talk_url = get_option( 'coral_talk_base_url' );
$static_url = get_option( 'coral_talk_static_url', $talk_url );
$talk_version = get_option( 'coral_talk_version' );
$coral_custom_css_url = get_option( 'coral_custom_css_url', null );
$coral_custom_fonts_css_url = get_option( 'coral_custom_fonts_css_url', null );
$coral_container_class_name = get_option( 'coral_container_class_name', null);
$coral_disable_default_fonts = get_option( 'coral_disable_default_fonts' );
$coral_custom_scroll_container = get_option( 'coral_custom_scroll_container', null );
$enable_canonical_url = get_option( 'coral_enable_canonical_story_urls' );
$canonical_url = wp_get_canonical_url();
$storyMode = $post->coralStoryMode;

$div_id = 'coral_talk_' . absint( rand() );

if ( empty( $talk_url ) || is_attachment() ):
	exit();
endif;

if ( $talk_version == "5" ) : ?>
	<div id="coral_thread"></div>
	<script type="text/javascript">
	(function() {
		var d = document, s = d.createElement('script');
		const disableDefaultFonts = "<?php echo esc_attr( $coral_disable_default_fonts ); ?>" === "true";
		const storyURL = "<?php echo esc_attr( $enable_canonical_url ); ?>" === "true" ? "<?php echo esc_url( $canonical_url ); ?>" : undefined;
		s.src = "<?php echo esc_url( $talk_url . '/assets/js/embed.js' ); ?>"
		s.onload = function() {
			const customScrollContainer = document.getElementById("<?php echo esc_attr( $coral_custom_scroll_container ); ?>") || undefined;
			Coral.createStreamEmbed({
				id: "coral_thread",
				autoRender: true,
				rootURL: "<?php echo esc_url( $talk_url ); ?>",
				containerClassName: "<?php echo esc_attr( $coral_container_class_name ); ?>",
				customCSSURL: "<?php echo esc_url( $coral_custom_css_url ); ?>",
				customFontsCSSURL: "<?php echo esc_url( $coral_custom_fonts_css_url ); ?>",
				disableDefaultFonts: disableDefaultFonts,
				customScrollContainer: customScrollContainer,
				storyURL: storyURL,
				storyMode: "<?php echo esc_attr( $storyMode ); ?>",
			});
		};
		(d.head || d.body).appendChild(s);
	})();
	</script>
<?php
else : ?>
	<div class="<?php echo esc_attr( $talk_container_classes ); ?>" id="coral_thread"></div>
	<script src="<?php echo esc_url( $static_url . '/static/embed.js' ); ?>" async onload="
		Coral.talkStream = Coral.Talk.render(document.getElementById('coral_thread'), {
			talk: '<?php echo esc_url( $talk_url ); ?>'
		});
	"></script>
<?php endif;
