<?php

namespace NasaPlugin;

class RequestProvider 
{
	
	private const API_KEY = 'DEMO_KEY';
	private const API_URL = 'https://api.nasa.gov';
	
	private function get_content( $path, $params_array ) {
		
		$url = self::API_URL . $path . '?api_key=' . self::API_KEY;
		
		foreach( $params_array as $key => $value ) {
			$url .= sprintf('&%s=%s', $key, $value);
		}
				
		$response = file_get_contents( $url );
		$response = json_decode( $response, TRUE );
		
		return $response;
		
	}
	
	private function parse( $response ) {
		
		$data = array(
			'post_title' => $response['date'],
		);

		if( $response['media_type'] == 'video' ) {

			$data['post_thumbnail'] = get_youtube_thumb($response['url']);

		} elseif( $response['media_type'] == 'image' ) {

			$data['post_thumbnail'] = $response['url'];

		}
		
		return $data;
		
	}
	
	public function getPictureOfTheDay( $date = FALSE ) {

		if( $date ) {
			
			$response = $this->get_content('/planetary/apod', array( 'date' => $date ));
			
			if( 
				isset( $response['date'] )
				&& isset( $response['url'] )
				&& isset( $response['media_type'] )
			  )
				return $this->parse($response);
			
			
		}

		return FALSE;		
		
	}
	
}