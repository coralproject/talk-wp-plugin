<?php
/**
 * Prints static content for Talk Settings page
 *
 * @package Talk_Plugin
 */
?>
<p>Lorem ipsum Proident non eu Duis amet exercitation ad laboris officia eu anim sunt enim sint reprehenderit voluptate qui aute ut nulla minim consectetur sint consectetur dolor ut reprehenderit tempor ad eu voluptate dolor non Excepteur aute dolore dolore.</p>
<p>
	<?php printf(
		esc_html__( 'You can find out how to install and manage Talk %shere%s.', 'coral-project-talk' ),
		'<a href="https://coralproject.github.io/talk/index.html">',
		'</a>'
	); ?>
</p>
<p>
	<?php printf(
		esc_html__( 'Talk is an open source product brought to you by The Coral Project. Find out more about Coral and the tools we build %shere%s.', 'coral-project-talk' ),
		'<a href="https://coralproject.net">',
		'</a>'
	); ?>
</p>

<h2><?php esc_html_e( 'Talk Settings', 'coral-project-talk' ); ?></h2>
<p>
	<?php printf(
		esc_html__( 'Questions/feedback? Reach out to us on %sTwitter%s or join our %sCommunity%s.', 'coral-project-talk' ),
		'<a href="https://twitter.com/coralproject">',
		'</a>',
		'<a href="https://community.coralproject.net/">',
		'</a>'
	); ?>
</p>
<p>
	<?php printf(
		esc_html__( 'You are using version %s of the Talk WordPress Plugin. View the code, documentation, and latest releases %shere%s.', 'coral-project-talk' ),
		esc_html( get_plugin_data( CORAL_PROJECT_TALK_DIR . '/talk.php' )['Version'] ),
		'<a href="https://github.com/coralproject/talk-wp-plugin">',
		'</a>'
	); ?>
</p>
