# Add Anchor Links (WordPress Plugin)

[![plugin version](https://img.shields.io/wordpress/plugin/v/add-anchor-links.svg)](https://wordpress.org/plugins/add-anchor-links)

This fork repurposes the original plugin to support paragraphs instead of headings.

In doing so, this fork uses lexical fragment identifiers, improving stability, as opposed to the numeric ones that were used from the early internet until the first two decades of this millennium.

## Rationale

### Heading anchors

Heading anchors are often added by table-of-contents plugins, e.g. [Table of Contents Plus](https://wordpress.org/plugins/table-of-contents-plus/). URLs with fragment identifiers can then made grabbable from the headings by bracketing each heading with an appropriate hyperlink. This scheme is also used by [GitHub in documentation](https://docs.github.com).

Readme files are handled differently on GitHub with respect to the markdown format allowing to add random hyperlinks to headings too. But that is bad practice, so best is to stick with GitHub’s documentation practice.

### Paragraph anchors

In WordPress, we have heading anchors integrated with tables of contents.

The opposite is true for paragraph anchors. These must be kept separate, since any word in a paragraph may need a hyperlink. So the scheme with added icons displaying on hover is an excellent fit for paragraph anchors.

Support for paragraph anchors seemed to be inexistent in WordPress until now. An old and unfinished plugin proposed to support these, but it is not maintained.

Links to paragraphs also suffer from the historic bias of using fragment identifiers based on numbering paragraphs, inspired by Douglas Engelbart’s Purple Numbers, called so by his daughter when she saw the purple numbers appended to paragraphs, with the hyperlink on them. That was a time when compacity mattered and was appreciated, as opposed to the actual era where verbose and parameter-rich URLs are so common URL shorteners are thriving.

## Feature

This new fork of the *Add Anchor Links* WordPress plugin derives the fragment identifiers from the paragraph contents. The identifiers’ length turns out to be truncated to a reasonable length somewhere in the process. That brings fairly stable identifiers, unaffected by inserting and deleting paragraphs.

This fork of course keeps the original plugin’s features of selectively adding links based on post types: “page” or “post” (article), or “attachment”, according to admin panel plugin settings.

## Installation

Please install the original plugin via your WordPress add-plugin interface, then replace two files:
1. wp-content/plugins/add-anchor-links/include/class-add-anchor-links.php
   with
   https://github.com/pewgeuges/add-anchor-links/blob/master/include/class-add-anchor-links.php
2. wp-content/plugins/add-anchor-links/assets/css/add-anchor-links.css
   with
   https://github.com/pewgeuges/add-anchor-links/blob/master/assets/css/add-anchor-links.css

## Meta

Name: Add Anchor Links [https://github.com/vyskoczilova/add-anchor-links](https://github.com/vyskoczilova/add-anchor-links)

Type: WordPress plugin [https://fr.wordpress.org/plugins/add-anchor-links/](https://fr.wordpress.org/plugins/add-anchor-links/)

Author: Karolína Vyskočilová (@vyskoczilova) [https://kybernaut.cz](https://kybernaut.cz)

Forked on GitHub by @pewgeuges on 2020-10-20T0159+0200

This README.md last modified: 2020-10-24T0209+0200
