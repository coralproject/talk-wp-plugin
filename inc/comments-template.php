<?php
/**
 * Comments template replacement.
 * This will replace the default comments.php when calling comments_template()
 * However, it is more performant to use coral_talk_comments_template()
 *
 * @package Talk_Plugin
 * @since 0.0.3 Added support for talk container class and removed id
 */

$talk_url = get_option( 'coral_talk_base_url' );
$static_url = get_option( 'coral_talk_static_url', $talk_url );
$talk_container_classes = get_option( 'coral_talk_container_classes' );
$talk_version = get_option( 'coral_talk_version' );

$div_id = 'coral_talk_' . absint( rand() );

if ( empty( $talk_url) ):
	exit();
endif;

if ( $talk_version == "5" ) : ?>
	<div class="<?php echo esc_attr( $talk_container_classes ); ?>" id="coral_thread"></div>
	<script type="text/javascript">
	(function() {
		var d = document, s = d.createElement('script');
		s.src = "<?php echo esc_url( $talk_url . '/assets/js/embed.js' ); ?>"
		s.onload = function() {
			Coral.createStreamEmbed({
				id: "coral_thread",
				autoRender: true,
				rootURL: "<?php echo esc_url( $talk_url ); ?>",
				storyID: "<?php echo get_the_ID(); ?>",
			});
		};
		(d.head || d.body).appendChild(s);
	})();
	</script>
<?php endif;

if ( $talk_version != "5" ) : ?>
	<div class="<?php echo esc_attr( $talk_container_classes ); ?>" id="<?php echo esc_attr( $div_id ); ?>"></div>
	<script src="<?php echo esc_url( $static_url . '/static/embed.js' ); ?>" async onload="
		Coral.talkStream = Coral.Talk.render(document.getElementById('<?php echo esc_js( $div_id ); ?>'), {
			talk: '<?php echo esc_url( $talk_url ); ?>'
		});
	"></script>
<?php endif;
