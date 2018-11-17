<?php

/**
 * @Author: Timi Wahalahti
 * @Date:   2018-10-17 11:07:20
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2018-11-17 17:08:03
 *
 * NOTE: remove transient cache functionality if you don't build any
 * transien cache clearing when event post type posts update.
 */

function siteprefix_get_events( $amount = 0, $past = false ) {
  $past_key = '';
  if ( $past ) {
    $past_key = '_past';
  }

  $cache = true;
  $today = date( 'Ymd' );
  $transient_key = "events{$past_key}_{$today}|{$amount}";

  if ( getenv( 'WP_ENV' ) === 'development' ) {
    $cache = false;
  }

  // Try to get our events from transient cache.
  if ( $cache && $events = get_transient( $transient_key )  ) {
    return $events;
  }

  $compare = '>';
  if ( $past ) {
    $compare = '<';
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
        'compare' => $compare,
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

  if ( ! $past ) {
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
  }

  // Order the days where we have events.
  ksort( $tmp_events );

  // Loop teh days and events to flatten the array.
  foreach ( $tmp_events as $event_day => $day_events ) {
    $event_day = strtotime( $event_day );

    foreach ( $day_events as $event ) {
      $end_day = get_post_meta( $event, 'end_day', true );

      if ( ! empty( $end_day ) ) {
        $end_day = strtotime( $end_day );
      }

      $day_str = '';
      if ( empty( $end_day ) || $event_day === $end_day ) {
        $day_str = date( 'j.n.Y', $event_day );
      } else {
        $start_month = date( 'm', $event_day );
        $end_month = date( 'm', $end_day );

        if ( $start_month !== $end_month ) {
          $day_str = date( 'j.n.', $event_day );
        } else {
          $day_str = date( 'j.', $event_day );
        }

        $day_str .= ' - ' . date( 'j.n.Y', $end_day );
      }

      // Add event to our return.
      $events[] = array(
        'day_str' => $day_str,
        'post_id' => $event,
      );
    }
  }

  // Return only wanted amount of events.
  array_splice( $events, $amount );

  // Cache events one day in transient.
  set_transient( $transient_key, $events, DAY_IN_SECONDS );

  return $events;
}
