<?php
/**
 * Comments template replacement.
 * This will replace the default comments.php when calling comments_template()
 * However, it is more performant to use coral_talk_comments_template()
 *
 * @package Talk_Plugin
 */

$talk_url = get_option( 'coral_talk_base_url' );
$rand = rand();
if ( ! empty( $talk_url ) ) : ?>
	<div id="coral_talk_<?php echo absint( $rand ); ?>"></div>
	<script src="<?php echo esc_url( $talk_url . '/embed.js' ); ?>" async onload="
		Coral.Talk.render(document.getElementById('coral_talk_<?php echo absint( $rand ); ?>'), {
			talk: '<?php echo esc_url( $talk_url ); ?>'
		});
	"></script>
<?php endif;
