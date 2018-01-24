<?php

// https://github.com/aFarkas/wp-lazysizes/blob/master/wp-lazysizes.php

if ( ! class_exists( 'LazySizes' ) ) :

class LazySizes {

    const version = '0.9.4';
    private static $options = array();
    private static $instance;

    function __construct() {

        if ( !is_admin() ) {
            add_filter( 'the_content', array( $this, 'filter_images'), 200 );
            //add_filter( 'post_thumbnail_html', array( $this, 'filter_images'), 200 );
            add_filter( 'widget_text', array( $this, 'filter_images'), 200 );
            add_filter( 'wp_get_attachment_image_attributes', array( $this, 'filter_image_attributes'), 200 );
        }
    }


    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    function filter_image_attributes( $attr ) {

        if ( is_feed()
            || intval( get_query_var( 'print' ) ) == 1
            || intval( get_query_var( 'printpage' ) ) == 1
            || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
        ) {
            return $attr;
        }

        $attr['data-src'] = $attr['src'];
        $attr['src'] = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';


        if ( !empty($attr['sizes'])) {
            $attr['data-sizes'] = 'auto';
            unset($attr['sizes']);
        }

        if ( !empty($attr['srcset'])) {
            $attr['data-srcset'] = $attr['srcset'];
            unset($attr['srcset']);
        }

        $attr['class'] = $attr['class'] .= ' lazyload';

        return $attr;
    }


    function filter_images( $content ) {

        if ( is_feed()
            || intval( get_query_var( 'print' ) ) == 1
            || intval( get_query_var( 'printpage' ) ) == 1
            || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
        ) {
            return $content;
        }

        $respReplace = 'data-sizes="auto" data-srcset=';


        $matches = array();
        $skip_images_regex = '/class=".*lazyload.*"/';
        $placeholder_image = apply_filters( 'lazysizes_placeholder_image',
            'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' );
        preg_match_all( '/<img\s+.*?>/', $content, $matches );

        $search = array();
        $replace = array();

        foreach ( $matches[0] as $imgHTML ) {

            // Don't do the replacement if a skip class is provided and the image has the class.
            if ( ! ( preg_match( $skip_images_regex, $imgHTML ) ) ) {

                $replaceHTML = preg_replace( '/<img(.*?)src=/i',
                    '<img$1src="' . $placeholder_image . '" data-src=', $imgHTML );

                $replaceHTML = preg_replace( '/srcset=/i', $respReplace, $replaceHTML );

                $replaceHTML = $this->_add_class( $replaceHTML, 'lazyload' );

                if ( preg_match( '/width=["|\']*(\d+)["|\']*/', $imgHTML, $width ) == 1
                    && preg_match( '/height=["|\']*(\d+)["|\']*/', $imgHTML, $height ) == 1 ) {
                    $ratioBox = '<span class="o-ratio';
                    if ( preg_match( '/(align(none|left|right|center))/', $imgHTML, $align_class ) == 1 ) {
                        $ratioBox .= ' ' . $align_class[0];
                        $replaceHTML = str_replace( $align_class[0], '', $replaceHTML );
                    }

                    $ratioBox .= '" style="max-width: ' . $width[1] . 'px; max-height: ' . $height[1] . 'px;';
                    $ratioBox .= '"><span class="o-ratio__helper" style="padding-bottom: ';
                    $replaceHTML = $ratioBox . (($height[1] / $width[1]) * 100) . '%;"></span>'. $replaceHTML . '</span>';
                }

                array_push( $search, $imgHTML );
                array_push( $replace, $replaceHTML );
            }
        }

        $content = str_replace( $search, $replace, $content );

        return $content;
    }


    private function _add_class( $htmlString = '', $newClass ) {

        $pattern = '/class="([^"]*)"/';

        // Class attribute set.
        if ( preg_match( $pattern, $htmlString, $matches ) ) {
            $definedClasses = explode( ' ', $matches[1] );
            if ( ! in_array( $newClass, $definedClasses ) ) {
                $definedClasses[] = $newClass;
                $htmlString = str_replace(
                    $matches[0],
                    sprintf( 'class="%s"', implode( ' ', $definedClasses ) ),
                    $htmlString
                );
            }
        // Class attribute not set.
        } else {
            $htmlString = preg_replace( '/(\<.+\s)/', sprintf( '$1class="%s" ', $newClass ), $htmlString );
        }

        return $htmlString;
    }
}

LazySizes::get_instance();

endif;
