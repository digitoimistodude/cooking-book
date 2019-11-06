<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2019-11-06 11:11:57
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-11-06 11:14:47
 */

add_filter( 'pre_get_posts', 'siteprefix_event_filtering' );
function siteprefix_event_filtering( $query ) {
  // do not filter on admin
  if ( is_admin() ) {
    return;
  }

  // filter only main queries
  if ( ! $query->is_main_query() ) {
    return;
  }

  // bail if not event archive
  if ( ! $query->is_post_type_archive( 'event' ) ) {
    return;
  }

  // defaults
  $filter = null;
  $tax_query = array();

  // show good amount of contents
  $query->set( 'posts_per_page', '50' );
  $query->set( 'orderby', array(
    'start_day_clause' => 'ASC',
    'start_time_clause' => 'ASC',
  ) );

  $meta_query = array();

  // default start and possible from filter
  $start_day = date( 'Ymd' );
  if ( isset( $_GET['start-date'] ) && ! empty( $_GET['start-date'] ) ) {
    $start_day = date( 'Ymd', strtotime( $_GET['start-date'] ) );
  }

  // default end and possible from filter
  $end_day = date('Ymd', strtotime( '+1 Month') );
  if ( isset( $_GET['end-date'] ) && ! empty( $_GET['end-date'] ) ) {
    $end_day = date( 'Ymd', strtotime( $_GET['end-date'] ) );
  }

   // get ongoing and future events
  $meta_query[] = array(
    'relation' => 'OR',

    // ongoing
    array(
      array(
        'key'     => 'end_day',
        'value'   => $start_day,
        'compare' => '>=',
      ),
      array(
        'key'     => 'start_day',
        'compare' => 'EXISTS',
      )
    ),

    // future one day
    array(
      array(
        'key'     => 'start_day',
        'value'   => $start_day,
        'compare' => '>=',
      ),
      array(
        'key'     => 'end_day',
        'compare' => 'NOT EXISTS',
      )
    ),

    // future multiple days
    array(
      array(
        'key'     => 'start_day',
        'value'   => $start_day,
        'compare' => '>=',
      ),
      array(
        'key'     => 'end_day',
        'value'   => $end_day,
        'compare' => '<=',
      )
    )
  );

  // combine meta queries and add ordering clauses
  $meta_query = array_merge( $meta_query, array(
    'relation' => 'AND',
    'start_day_clause' => array(
      'key' => 'start_day',
      'compare' => 'EXISTS',
    ),
    'start_time_clause' => array(
      'key' => 'start_time',
      'compare' => 'EXISTS',
    )
  ) );

  // set meta query
  $query->set( 'meta_query', $meta_query );

  // maybe filter by catgory
  if ( isset( $_GET['event_category'] ) ) {
    $tax_query[] = array(
      'taxonomy'  => 'events-category',
      'field'     => 'slug',
      'terms'     => sanitize_text_field( $_GET['event_category'] ),
    );
  }

  // set tax query
  if ( ! empty( $tax_query ) ) {
    if ( count( $tax_query ) > 1 ) {
      $tax_query['relation'] = 'AND';
    }

    $query->set( 'tax_query', $tax_query );
  }
} // siteprefix_event_filtering
