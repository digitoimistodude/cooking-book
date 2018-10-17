<?php

/**
 * @Author: Timi Wahalahti
 * @Date:   2018-10-17 11:07:20
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2018-10-17 11:08:50
 *
 * NOTE: remove transient cache functionality if you don't build any
 * transien cache clearing when event post type posts update.
 */

function siteprefix_get_events( $amount = 0 ) {
  $today = date( 'Ymd' );
  $transient_key = "events_{$today}|{$amount}";

  // Try to get our events from transient cache.
  if ( $events = get_transient( $transient_key ) ) {
    return $events;
  }

  $events = array();
  $tmp_events = array();

  // Get events starting tomorrow or later.
  $query = array(
    'post_type'                 => 'event',
    'post_status'               => 'publish',
    'orderby'                   => 'meta_value',
    'meta_key'                  => 'start_day',
    'meta_query'                => array(
      array(
        'key'     => 'start_day',
        'value'   => $today,
        'compare' => '>',
      ),
    ),
    'posts_per_page'            => 100,
    'no_found_rows'             => false,
    'cache_results'             => true,
    'update_post_term_cache'    => true,
    'update_post_meta_cache'    => false,
  );

  $query = new WP_Query( $query );
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();

      // Add event to array with day as a key.
      $event_day = get_post_meta( get_the_id(), 'start_day', true );
      $tmp_events[ $event_day ][] = get_the_id();
    }
  }

  wp_reset_query();

  // Get active events, starting today or ongoing.
  $query = array(
    'post_type'                 => 'event',
    'post_status'               => 'publish',
    'orderby'                   => 'meta_value',
    'meta_key'                  => 'start_day',
    'meta_query'                => array(
      array(
        'key'     => 'start_day',
        'value'   => $today,
        'compare' => '<=',
      ),
      array(
        'key'     => 'end_day',
        'value'   => $today,
        'compare' => '>=',
      ),
    ),
    'posts_per_page'            => 100,
    'no_found_rows'             => false,
    'cache_results'             => true,
    'update_post_term_cache'    => true,
    'update_post_meta_cache'    => false,
  );

  $query = new WP_Query( $query );
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();

      // Add event to array with day as a key.
      $event_day = get_post_meta( get_the_id(), 'start_day', true );
      $tmp_events[ $event_day ][] = get_the_id();
    }
  }

  wp_reset_query();

  // Order the days where we have events.
  ksort( $tmp_events );

  // Loop teh days and events to flatten the array.
  foreach ( $tmp_events as $event_day => $day_events ) {
    foreach ( $day_events as $event ) {

      // Add event to our return.
      $events[] = array(
        'start_day' => $event_day,
        'post_id'   => $event,
      );
    }
  }

  // Return only wanted amount of events.
  array_splice( $events, $amount );

  // Cache events one day in transient.
  set_transient( $transient_key, $events, DAY_IN_SECONDS );

  return $events;
}
