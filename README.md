# Add Anchor Links (WordPress Plugin) from Karolína Vyskočilová

[![plugin version](https://img.shields.io/wordpress/plugin/v/add-anchor-links.svg)](https://wordpress.org/plugins/add-anchor-links)

This updated (2021-04-18) fork adds anchors to headings, or to paragraphs, or to both.

For paragraphs (also list items and blockquotes), lexical fragment identifiers are used like for the headings, stabilizing the identifiers against insertions and deletions of paragraphs, but not against edits to the paragraphs. That contrasts with the numeric fragment IDs used from the early internet until the first two decades of this millennium.

## Rationale

Support for paragraph anchors seemed to be inexistent in WordPress until now. An old and unfinished plugin proposed to support these, but it is not maintained.

Links to paragraphs also suffer from the historic bias of using fragment identifiers based on numbering paragraphs, inspired by Douglas Engelbart’s Purple Numbers, called so by his daughter when she saw the purple numbers appended to paragraphs, with the hyperlink on them. That was a time when compacity mattered and was appreciated, as opposed to the actual era where verbose and parameter-rich URLs are so common tbat URL shorteners are thriving.

## Features

This fork of Karolína Vyskočilová’s *Add Anchor Links* WordPress plugin uses the same algorithm to derive fragment identifiers from paragraph contents. The identifiers’ length turns out to be truncated to a reasonable length somewhere in the process. That brings fairly stable identifiers, unaffected by inserting and deleting paragraphs.

The fragment identifiers are disambiguated across elements.

The anchors are offset by 15vh, customizable in Custom CSS (could become a setting when getting along with the setup).

## Bug

This fork has issues with the new setting. The headings checkbox displays always with its checked default value, only the paragraphs checkbox keeps its status, but it is not used to control the algorithm.

The only way to test is to manually edit the Booleans in includes/class-add-anchor-links.php:74..75.

I’m sorry about this failure.

## Meta

Name: Add Anchor Links [https://github.com/vyskoczilova/add-anchor-links](https://github.com/vyskoczilova/add-anchor-links)

Type: WordPress plugin [https://fr.wordpress.org/plugins/add-anchor-links/](https://fr.wordpress.org/plugins/add-anchor-links/)

Author: Karolína Vyskočilová (@vyskoczilova) [https://kybernaut.cz](https://kybernaut.cz)

Forked on GitHub by @pewgeuges on 2020-10-20T0159+0200

This README.md last modified: 2021-04-18T1708+0200
