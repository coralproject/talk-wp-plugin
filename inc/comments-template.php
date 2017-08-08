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
		Coral.Talk.render(document.getElementById(<?php echo wp_json_encode( $div_id ); ?>), {
			talk: '<?php echo esc_url( $talk_url ); ?>',
			// Disabled, if the id is specified, Talk expects that that asset exists already.
			// asset_id: '<?php echo esc_js( coral_talk_get_asset_id() ); ?>'
		});
	"></script>
<?php endif;
