<?php

// First we need to load the composer autoloader so we can use WP Mock
require_once __DIR__ . '/../vendor/autoload.php';

// Now call the bootstrap method of WP Mock
WP_Mock::bootstrap();

// Close approximation of WP's sanitize_title() for tests.
function sanitize_title( $string ) {
    $string = strip_tags( $string );
    $string = strtolower( trim( $string ) );
    return trim( preg_replace( '/[^a-z0-9]+/', '-', $string ), '-' );
}
