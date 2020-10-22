# Add Anchor Links (WordPress Plugin)

[![plugin version](https://img.shields.io/wordpress/plugin/v/add-anchor-links.svg)](https://wordpress.org/plugins/add-anchor-links)

This fork repurposes the original plugin to support paragraphs instead of headings.

In doing so, this fork uses lexical fragment identifiers, improving stability, as opposed to the numeric ones that were used in the early internet.

## Rationale

### Heading anchors

Heading anchors are often added by table-of-contents plugins, e.g. [Table of Contents Plus](https://wordpress.org/plugins/table-of-contents-plus/). URLs with fragment identifiers can then made grabbable from the headings by bracketing the headings with an appropriate hyperlink. This scheme is also used by GitHub in documentation. 

Not doing so in readme files on GitHub is done with respect to the markdown format allowing to add random hyperlinks to headings too. But that is bad practice, so best is to stick with GitHub’s practice in documentation.

So in WordPress we have heading anchors integrated with tables of contents.

### Paragraph anchors

The opposite is true for paragraph anchors. These must be kept separate, since any word in a paragraph may need a hyperlink. So the scheme with added icons displaying on hover is an excellent fit for paragraph anchors.

In WordPress, support for paragraph anchors seemed to be inexistent until now. An old and unfinished plugin proposed to support these, but it is not maintained.

Links to paragraphs also suffer from the historic bias of using fragment identifiers based on numbering paragraphs, inspired by Douglas Engelbart’s Purple Numbers, called so by his daughter when she saw the purple numbers appended to paragraphs, with the hyperlink on them.

## Feature

This new *Add Anchor Links* WordPress plugin fork derives the fragment identifiers from the first ten words of each paragraph. That brings fairly stable identifiers, unaffected by inserting and deleting paragraphs.

For this to work, each paragraph’s word count must be >= 11.

This fork is work in progress, with the requirement in mind that it must be backwards compatible.

## Installation

Please install the original plugin via your WordPress add-plugin interface, then replace two files using these (class-add-anchor-links.php has been reset for that purpose while work is in progress):
1. [https://github.com/pewgeuges/add-anchor-links/include/class-add-anchor-links.php](https://github.com/pewgeuges/add-anchor-links/include/class-add-anchor-links.php)
2. [wp-content/plugins/add-anchor-links/assets/css/add-anchor-links.css](wp-content/plugins/add-anchor-links/assets/css/add-anchor-links.css)


## Meta

Name: Add Anchor Links [https://github.com/vyskoczilova/add-anchor-links](https://github.com/vyskoczilova/add-anchor-links)

Type: WordPress plugin [https://fr.wordpress.org/plugins/add-anchor-links/](https://fr.wordpress.org/plugins/add-anchor-links/)

Author: Karolína Vyskočilová (@vyskoczilova) [https://kybernaut.cz](https://kybernaut.cz)

Forked on GitHub by @pewgeuges on 2020-10-20T0159+0200

This README.md last modified: 2020-10-21T2327+0200
