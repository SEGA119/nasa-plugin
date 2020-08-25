<?php

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

if( !function_exists('save_image_from_url') ) : 

function save_image_from_url($url) {

    $tmp = download_url( $url );

    $file_array = array(
        'name' => basename( $url ),
        'tmp_name' => $tmp
    );

    /**
     * Check for download errors
     * if there are error unlink the temp file name
     */
    if ( is_wp_error( $tmp ) ) {
        @unlink( $file_array[ 'tmp_name' ] );
        return FALSE;
    }

    $id = media_handle_sideload( $file_array, '0' );

    if ( is_wp_error( $id ) ) {
        @unlink( $file_array['tmp_name'] );
        return FALSE;
    }

    /**
     * Get the url of the sideloaded file
     */
    $value = wp_get_attachment_url( $id );

// Now you can do something with $value (or $id)

    return $id;

}

endif;

if( !function_exists( 'get_youtube_thumb' ) ) : 

function get_youtube_thumb( $url ) {
	
	if( strpos( $url, 'youtube.com' ) === FALSE )
		return FALSE;
	
	$url_layout = 'https://img.youtube.com/vi/%s/maxresdefault.jpg';
	
	$code = substr( $url, strrpos( $url, '/' ) + 1, strpos( $url, '?' ) - strrpos( $url, '/' ) - 1 );
	
	return sprintf( $url_layout, $code );
	
}

endif;