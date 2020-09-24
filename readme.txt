=== Sapphire Popups ===
Contributors: runningCoder81
Tags:         Popups, easy to use, no cookies, classic editor, Gutenberg
Tested up to: 5.5
Requires PHP: 5.6
Stable tag:   1.1.0
Plugin URI:   https://github.com/runningCoder81/sapphire-popups
Author:       Bobby Lee
Author URI:   https://therunningcoder.com/
Version:      1.1.0
Text Domain:  sapphire-popups
Domain Path:  /languages
License:      GPLv3
License URI:  http://www.gnu.org/licenses/gpl-3.0.html

A simple way to create popups.

== Description ==

Sapphire Popups allows you to easily add popups and set the behavior of how the popup is displayed all without the use of cookies. It is compatible with the Classic Editor and Gutenberg which makes it easy to use, it's also very approachable for developers to extend.

Major Features in Sapphire Popups include:

* Easily create and manage popups using the Classic Editor or Gutenberg.
* 3 popup behavior selections.
* If a popup is updated it will be displayed again, even if the behavior has not expired.
* Remove popup title option.
* Does not use cookies.
* More features coming soon!!

Behavior selections:

* Default: Display popup on every page load.
* Show Daily: Popup will be displayed once per day.
* Show Once: Popup will show only once ever - unless behavior is changed or popup had been updated.

Popups that get updated will be displayed again even if the behavior is set to Show Once. If the behavior is set to Show Daily and the popup is updated it will be displayed again and the daily timer will start over. This allows for updates to be made even after the popup has been displayed.

== Installation ==

Upload the Sapphire Popups plugin to your site, activate it, and start creating popups.

Enjoy!

== Frequently Asked Questions ==

= What is the Default Behavior =

The Default Behavior will display the popup on every page load.


== Screenshots ==

1. Sapphire Popups settings page. Select a popup, the behavior, and if you want to exclude the Popup Title - that's it!
2. Managing popups is easy.

== Changelog ==

= 1.1.0: - 2020-09-16 =

* Changed: Converted main plugin file to a class - SapphirePopup.

= 1.0.1: - 2020-09-16 =

* Fixed

- Added the_content filter on popup content so that it can be treated the same way as a normal post.
- The issue was that <p> tags were not being added so all lines ended up on one line. The wpautop filter which added <p> tags is one of the filters used in the_content so I just used that.
- I also used wp_kses_post for extra sanitization when pulling from the DB but this removes custom HTML. I found that get_post_by_title() uses get_post() which uses sanitize_post() so this is happening by default.
- includes > core-functions.php > sapphire_popups_add_popup_script.
- https://github.com/runningCoder81/sapphire-popups/issues/1

= 1.0.0: 2020-08-30 =
* Created version 1.





