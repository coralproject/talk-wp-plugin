# Coral WP Plugin

This plugin replaces standard WordPress commenting with [Coral by Vox Media](https://coralproject.net). Coral is an open-source commenting platform that rethinks how moderation, comment display, and conversation function, creating the opportunity for safer, smarter discussions.

## Setup

First, you'll need a server running your own instance of Coral. See the [Coral Docs](https://docs.coralproject.net/) for more info about that.

Then you will need to:

1. Add the hostname of your WordPress site to the whitelist in the settings of your Coral instance.
1. Install and activate this plugin as you would any other WordPress plugin.
1. Go to `https://mysite.com/wp-admin/options-general.php?page=talk-settings`
1. Add the URL of your Coral instance to `Server Base URL` in Settings and click Save.
1. Review and complete any further Settings and click Save.

## Story settings

Coral will use the canonical URL for a Wordpress post for the Story URL.

## HTTPS and Dev Mode

Your site must be served over `https` in order to integrate with Coral **unless** Coral is set to dev mode.

If you're installing Coral with Docker, you can do that by adding `NODE_ENV=dev` to the environment variables in your [`docker-compose.yml`](https://docs.coralproject.net/talk/installation-from-docker/). Otherwise, any method of setting `process.env.NODE_ENV = 'dev'` will do the trick.

## Theme usage

If your theme uses WordPress' standard `comments_template()` to render comments forms, the output will be overridden by the Coral embed code.

If you are building a custom theme, we recommend using `coral_talk_comments_template()` instead of the usual `comments_template()` for performance reasons.

Note that comments can still be turned on or off for an invidual post:

![Discussion meta box](lib/img/discussion-meta-box.png)

[`comments_open()`](https://codex.wordpress.org/Function_Reference/comments_open) will still work when the Coral Plugin is active, but other functions like [`get_comments_number()`](https://codex.wordpress.org/Template_Tags/get_comments_number) that reference the `wp_comments` database table may not.

We recommend something like:

```php
if ( comments_open() ) {
	coral_talk_comments_template();
}
```

## AMP support

Coral v4.9.0+ comes with AMP support. This plugin automatically integrates with [AMP for WP](https://wordpress.org/plugins/accelerated-mobile-pages/) and adds the AMP version of Coral to the comments. Don't forget to disable the other comments integrations inside of `AMP -> Settings`.

If you are building a custom theme, you can use `coral_talk_comments_amp_template()` to add the Coral AMP Iframe.

## Version

Coral version <= `v3.9.1` use plugin version `v0.0.6`

Coral version >= `4.0.0` use plugin version `v0.1.0`

Coral version >= `5.0.0` use plugin version `v0.2.1`
