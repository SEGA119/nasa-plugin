<?php

if( !function_exists('get_date') ) : 

function get_current_date() {

	return date('Y-m-d');

}

endif;

if( !function_exists('get_last_five_dates') ) : 

function get_last_five_dates() {

	$dates = array();
	
	for( $i = -4; $i <= 0; $i++ ) {
		array_push( $dates, date('Y-m-d', strtotime(sprintf("%s days", $i))) );
	}
	
	return $dates;

}

endif;