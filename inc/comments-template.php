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
$div_id = 'coral_talk_stream';
$jwt_secret = get_option( 'coral_talk_jwt_secret' );
if ( ! empty( $talk_url ) ) : ?>
	<div class="<?php echo esc_attr( $talk_container_classes ); ?>" id="<?php echo esc_attr( $div_id ); ?>"></div>
	<script src="<?php echo esc_url( $static_url . '/static/embed.js' ); ?>" async onload="
		Coral.Talk.render(document.getElementById('<?php echo esc_js( $div_id ); ?>'), {
			talk: '<?php echo esc_url( $talk_url ); ?>',
			<?php
			if(! empty ($jwt_secret ) && is_user_logged_in() ) {
				$nonce = wp_create_nonce( 'wp_rest' );
				$user = wp_get_current_user();
				$id = $user->ID;
				$header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256'])));
				$payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode(['sub' => "$id", 'id' => "$id", 'nonce' => $nonce, 'jti' => uniqid(), 'iss' => 'wordpress', 'aud' => 'talk', 'iat' => time() ,'exp' => time() + 86400])));
				$signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(hash_hmac('sha256', $header.".".$payload, $jwt_secret, true)));
				$token = $header.".".$payload.".".$signature;
			?>
      auth_token: '<?php echo $token; ?>'
			<?php	
			}
			?>
		});
	"></script>
<?php endif;
