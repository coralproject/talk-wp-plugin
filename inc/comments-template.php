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
$talk_container_classes = get_option( 'coral_talk_container_classes' );
$div_id = 'coral_talk_' . absint( rand() );
if ( ! empty( $talk_url ) ) : ?>
	<div class="<?php echo esc_attr( $talk_container_classes ); ?>" id="<?php echo esc_attr( $div_id ); ?>"></div>
	<script src="<?php echo esc_url( $talk_url . '/embed.js' ); ?>" async onload="
		Coral.talkStream = Coral.Talk.render(document.getElementById('<?php echo esc_js( $div_id ); ?>'), {
			talk: '<?php echo esc_url( $talk_url ); ?>'
		});
	"></script>
<?php endif;
