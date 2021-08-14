<?php
/**
 * Comments amp template.
 *
 * @package Talk_Plugin
 * @since 0.2.0
 */

$talk_url = get_option( 'coral_talk_base_url' );
if ( ! empty( $talk_url ) ) : ?>
    <amp-iframe
        class="talk-amp-iframe"
        width=600 height=140
        layout="responsive"
        sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms"
        resizable
        src="<?php echo esc_url( $talk_url ); ?>/embed/stream/amp?storyURL=<?php echo urlencode(wp_get_canonical_url()); ?>">
        <div placeholder></div>
        <div overflow tabindex=0 role=button aria-label="Read more">Read more</div>
    </amp-iframe>
<?php endif;
