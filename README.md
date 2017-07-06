# Coral Project Talk

This plugin replaces standard WordPress commenting with [Talk](https://coralproject.net/products/talk.html) from the [Coral Project](https://coralproject.net).

## Setup

First, you'll need a server running your own instance of Talk. See the Talk [installation guide](https://github.com/coralproject/talk/blob/master/INSTALL.md) for more info about that.

Then...

1. Add the hostname of your WordPress site to the whitelist in the settings of your Talk instance.
1. Install and activate this plugin as you would any other WordPress plugin.
1. Go to `https://mysite.com/wp-admin/options-general.php?page=talk-settings`
    1. Note that your site must be served over `https` in order to integrate with Talk.
1. Enter the URL of your Talk instance and click Save.

## Theme usage

If your theme uses WordPress' standard `comments_template()` to render comments forms, the output will be overridden by the Talk embed code.

If you are building a custom theme, we recommend using `coral_talk_comments_template()` instead of the usual `comments_template()` for performance reasons.