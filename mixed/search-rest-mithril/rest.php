<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2019-10-22 16:02:40
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-10-23 12:06:51
 */

// Add our REST API endpoint for search.
add_action( 'rest_api_init', 'wpfi_rest_api_search_init' );
function wpfi_rest_api_search_init() {
  register_rest_route( 'wpfi/v1',
    '/search',
      array(
      'methods'   => 'GET',
      'callback'  => 'wpfi_rest_api_search',
    )
  );
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
    's'                       => sanitize_text_field( $_GET['s'] ),
    'posts_status'            => 'publish',
    'has_password'            => false,
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

      // remove some un-necssary data
      unset( $item->post_content );
      unset( $item->post_password );
      unset( $item->to_ping );
      unset( $item->pinged );
      unset( $item->post_content_filtered );
      unset( $item->post_mime_type );
      unset( $item->filter );
      unset( $item->menu_order );

      $data[] = $item;
    }
  }

  return $data;
} // end wpfi_rest_api_search
