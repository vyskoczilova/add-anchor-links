# Add Anchor Links (WordPress Plugin) from Karolína&nbsp;Vyskočilová

This updated (2021-04-18) fork adds anchors to headings, or to paragraphs, or to both.

For paragraphs (also list items and blockquotes), lexical fragment identifiers are used like for the headings, stabilizing the identifiers against insertions and deletions of paragraphs, but not against edits to the paragraphs. That contrasts with the numeric fragment IDs used from the early internet until the first two decades of this millennium.

## Rationale

Support for paragraph anchors was ineffective in WordPress until now. An old plugin declared as unfinished proposed to add these, but it is not maintained.

Links to paragraphs also suffer from the historic bias of using fragment identifiers based on numbering paragraphs, inspired by Douglas Engelbart’s Purple Numbers, called so by his daughter when she saw the purple numbers appended to paragraphs, with the hyperlink on them. That was a time when compacity mattered and was appreciated, as opposed to the actual era where verbose and parameter-rich URLs are so common tbat URL shorteners are thriving.

## Features

This fork of Karolína Vyskočilová’s *Add Anchor Links* WordPress plugin uses the same algorithm to derive fragment identifiers from paragraph contents. The identifiers’ length is truncated to a reasonable length by the pre-existing process. That brings fairly stable identifiers, unaffected by inserting and deleting paragraphs.

Fragment identifiers occurring more than once are disambiguated across elements by appending (an ASCII hyphen and) a number incremented through headings, then through paragraphs.

The anchors are offset by 15vh, customizable in Custom CSS with the class `aal_offset_anchor`:
```css
.aal_offset_anchor {
    bottom: 15vh;
}
```

The new setting is fully backwards compatible in that it requires not only to explicitly enable adding anchors to paragraphs, but also eventually to explicitly disable adding anchors to headings, should the plugin’s effect deviate in any way from its default of adding anchors to headings. (Default-checking a box keeps it checked because unchecked boxes are not registered in the DB.)

## Meta

Name: Add Anchor Links [https://github.com/vyskoczilova/add-anchor-links](https://github.com/vyskoczilova/add-anchor-links)

Type: WordPress plugin [https://fr.wordpress.org/plugins/add-anchor-links/](https://fr.wordpress.org/plugins/add-anchor-links/)

Author: Karolína Vyskočilová (@vyskoczilova) [https://kybernaut.cz](https://kybernaut.cz)

Forked on GitHub by @pewgeuges on 2020-10-20T0159+0200

This README.md last modified: 2021-04-18T1708+0200
