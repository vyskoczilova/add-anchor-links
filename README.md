# Add Anchor Links (WordPress Plugin)

[![plugin version](https://img.shields.io/wordpress/plugin/v/add-anchor-links.svg)](https://wordpress.org/plugins/add-anchor-links)
[![build](https://travis-ci.com/vyskoczilova/add-anchor-links.svg?branch=master)](https://travis-ci.com/github/vyskoczilova/add-anchor-links)

Creates anchor links to heading tags in the content of selected posts, just like Github does within the Readme.md files.

## Unreleased changes
* none

## Roadmap
* Add ID directly to headline
* Use less code for link added

## Developer features

### Run the add_links manually

```php
echo \Kybernaut\AddAnchorLinks::add_links('<h1>Title</h1>');
```

### Don't load CSS if not needed

	define('ADD_ANCHOR_LINKS_DONT_LOAD_CSS', true);

## Credits

* [Automatic deployment to WordPress.org](https://github.com/10up/action-wordpress-plugin-deploy)
