<?php

function wpfi_rest_api_search_init() {
  register_rest_route( 'wpfi/v1', '/search', array(
    'methods'		=> 'GET',
    'callback'	=> 'wpfi_rest_api_search',
  ) );
}
add_action( 'rest_api_init', 'wpfi_rest_api_search_init' );

function wpfi_rest_api_search( $request ) {
	$data = array();

	if ( ! isset( $_GET['s'] ) ) {
		return $data;
	}

	$rest_controller = new WP_REST_Post_Types_Controller();

	$args = array(
		's'   				=> $_GET['s'],
		'no_found_rows'          	=> true,
		'cache_results'          	=> true,
		'update_post_term_cache' 	=> false,
	);

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
  	while ( $query->have_posts() ) {
  		$query->the_post();

      		$item = $rest_controller->prepare_response_for_collection( $query->post );
      		$item->link = get_the_permalink( $item->ID );
      		$data[] = $item;
  	}
  }

  return $data;
}
