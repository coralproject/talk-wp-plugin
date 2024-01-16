<?php
/**
 * Prints static content for Talk Settings page
 *
 * @package Talk_Plugin
 */

?>
<p>
	<?php printf(
		esc_html__( 'Coral is an open-source commenting platform brought to you by Vox Media. Find out more about Coral and the tools we build %shere%s.', 'coral-project-talk' ),
		'<a href="https://coralproject.net" target="_blank">',
		'</a>'
	); ?>
</p>
<p>
	<?php printf(
		esc_html__( 'You can find out how to install and manage Coral %shere%s.', 'coral-project-talk' ),
		'<a href="https://docs.coralproject.net/" target="_blank">',
		'</a>'
	); ?>
</p>

<h2><?php esc_html_e( 'Coral Settings', 'coral-project-talk' ); ?></h2>
<p>
	<?php printf(
		esc_html__( 'You are using version %s of the Coral WordPress Plugin. View the code, documentation, and latest releases %shere%s.', 'coral-project-talk' ),
		esc_html( get_plugin_data( CORAL_PROJECT_TALK_DIR . '/talk.php' )['Version'] ),
		'<a href="https://github.com/coralproject/talk-wp-plugin" target="_blank">',
		'</a>'
	); ?>
</p>
