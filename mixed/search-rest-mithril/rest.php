<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2019-10-22 16:02:40
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-10-22 16:05:46
 */

// Add our REST API endpoint for search.
add_action( 'rest_api_init', 'wpfi_rest_api_search_init' );
function wpfi_rest_api_search_init() {
  register_rest_route( 'wpfi/v1', '/search', array(
    'methods'   => 'GET',
    'callback'  => 'wpfi_rest_api_search',
  ) );
} // end wpfi_rest_api_search_init

// REST API search endpoint callback.
function wpfi_rest_api_search( $request ) {
  $data = array();

  // bail if no search param.
  if ( ! isset( $_GET['s'] ) ) {
    return $data;
  }

  // used later to prepare post object
  $rest_controller = new WP_REST_Post_Types_Controller();

  // do search query
  $args = array(
    's'                       => $_GET['s'],
    'no_found_rows'           => true,
    'cache_results'           => true,
    'update_post_term_cache'  => false,
  );

  $query = new WP_Query( $args );

  // loop results
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();

      // add result to response
      $item = $rest_controller->prepare_response_for_collection( $query->post );
      $item->link = get_the_permalink( $item->ID );
      $data[] = $item;
    }
  }

  return $data;
} // end wpfi_rest_api_search
