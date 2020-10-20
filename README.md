# Add Anchor Links (WordPress Plugin)

[![plugin version](https://img.shields.io/wordpress/plugin/v/add-anchor-links.svg)](https://wordpress.org/plugins/add-anchor-links)

This fork repurposes the original plugin to support paragraphs instead of headings.

In doing so, this fork uses lexical fragment identifiers, improving stability, as opposed to the numeric ones that were used in the early internet.

## Rationale

Heading anchors are often added by table-of-contents plugins, e.g. [Table of Contents Plus](https://wordpress.org/plugins/table-of-contents-plus/). URLs with fragment identifiers can then made grabbable from the headings by bracketing the headings with an appropriate hyperlink. This scheme is also used by GitHub in documentation. Not doing so in readme files is done with respect to the format allowing to add random hyperlinks to headings too, but that is bad practice, so best is to stick with GitHub’s practice in documentation.

So in WordPress we have heading anchors integrated with tables of contents.

What is missing in WordPress are links to paragraphs. An old and unfinished plugin proposed to support these, but it is not maintained.

Links to paragraphs also suffer from the historic bias of using fragment identifiers based on numbering pargraphs, inspired by Douglas Engelbart’s Purple Numbers, called so by his daughter when she saw the purple numbers appended to paragraphs, with the hyperlink in them.

## Feature

This new *Add Anchor Links* WordPress plugin fork derives the fragment identifiers from the first ten words of each paragraph. (Less words if the paragraph is shorter.) That brings fairly stable identifiers, unaffected by inserting and deleting paragraphs.

This fork of course keeps the original plugin’s features of selectively adding links based on post types: “page” or “post” (article), or “attachment”, according to admin panel plugin settings.

## Installation

Please install the original plugin via your WordPress add-plugin interface, then replace two files:
1. wp-content/plugins/add-anchor-links/include/class-add-anchor-links.php
2. wp-content/plugins/add-anchor-links/assets/css/add-anchor-links.css
