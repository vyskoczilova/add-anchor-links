<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Add_Anchor_Links' ) ) {
    class Add_Anchor_Links {  

        /**
        - Constructor
        */
        function __construct() {
        
            add_filter('the_content', array(&$this,'add_anchor_links_to_the_content') );            
            
        }

        public function add_anchor_links_to_the_content ( $content ) {

            if ( is_singular( add_anchor_links_post_types( true ) ) ) {
                return $this->add_anchors( $content );
            }

        }


        /**
         - Add Links
         * Replace headings with an anchor
         */
        private function add_anchors( $text ) {

            // search for headlines
            $pattern = '#<h([1-6])(?: [^>]+)?>(.+?)</h\1>#is';
            preg_match_all( $pattern , $text , $headlines, PREG_SET_ORDER);            

            if( $headlines ){
				foreach ($headlines as $headline) {

                    if ( strlen( $headline[2] ) ) {

                        $anchor = sanitize_title( $headline[2] );
                        $icon = '<a href="#'.$anchor.'" aria-hidden="true" class="aal_anchor" id="'.$anchor.'"><svg aria-hidden="true" class="aal_svg" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>';

                        $pos = strpos($text, $headline[0]) + 4; 
					    $text = substr_replace($text, $icon, $pos, 0); // inssert after h tag

                    }

				}
			}

            
            return $text;
        }

    }
}
new Add_Anchor_Links();