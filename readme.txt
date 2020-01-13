=== Add Anchor Links ===
Contributors: vyskoczilova
Requires at least: 4.8
Tested up to: 4.3.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: anchor, anchor links, content links, content, headings
Stable tag: 1.0.2

Creates anchor links to heading tags in the content of selected posts, just like Github does within the Readme.md files.

== Description ==

Creates anchor links to heading tags in the content of selected posts, just like Github does within the Readme.md files.

Get involved and [join Github](https://github.com/vyskoczilova/add-anchor-links)!

=== Features ===
* Select post type where the anchor links will be added.
* Disable CSS.

=== Compatibility ===
* PHP 5.6 & PHP 7


== Installation ==

1. Follow the standard [WordPress plugin installation procedere](http://codex.wordpress.org/Managing_Plugins).
2. When installed, go to `Settings -> Add Anchor Links` and when should be applied.


== Frequently asked questions ==

= I want to use the latest files. How can I do this? =

Use the GitHub Repo rather than the WordPress Plugin. Do as follows:

1. If you haven't already done: [Install git](https://help.github.com/articles/set-up-git)

2. In the console cd into Your 'wp-content/plugins´ directory

3. Type `git clone https://github.com/vyskoczilova/add-anchor-links` or better type `git fork https://github.com/vyskoczilova/add-anchor-links`

4. If you want to update to the latest files (be careful, might be untested on Your WP-Version) type `git pull´.

= I found a bug. Where should I post it? =

I personally prefer GitHub, to keep things straight. The plugin code is here: [GitHub](https://github.com/vyskoczilova/add-anchor-links)
But you may use the WordPress Forum as well.

= I found a bug and fixed it. How can I contribute? =

Either post it on [GitHub](https://github.com/vyskoczilova/add-anchor-links) or—if you are working on a cloned repository—send me a pull request.


== Changelog ==

= 1.0.2 (2020-01-13) =
* Fix: Fix link position when header has attributes ([PR#1](https://github.com/vyskoczilova/add-anchor-links/pull/1) by [@a-mt](https://github.com/a-mt))

= 1.0.1 (2018-02-12) = 
* Fix: Few typos in readme files.
* Fix: Post types error.
* Added: Notice about settings shown on plugin activation.
* Added: Constant ADD_ANCHOR_LINKS_DONT_LOAD_CSS (see Github).
* Added: Banner & icon image to the WP repository (by [Dušan Konečný](http://abmanufaktura.cz)).

= 1.0.0 (2018-02-08) =
* Initial release