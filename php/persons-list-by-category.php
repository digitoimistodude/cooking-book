<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2019-11-04 11:32:02
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-11-04 11:39:41
 */

// defaults
$persons = array();

// get teams
$teams = get_terms( 'person-category', array(
  'hide_empty' => true,
  'orderby'    => 'order',
) );

if ( ! empty( $teams ) && ! is_wp_error( $teams ) ) {
  // loop teams
  foreach ( $teams as $key => $team ) {
    // get persons in that team
    $persons_query = new WP_Query(
      array(
        'post_type'       => 'person',
        'post_status'     => 'publish',
        'posts_per_page'  => 500,
        'orderby'         => 'menu_order',
        'tax_query'       => array(
          array(
            'taxonomy'  => 'person-category',
            'terms'     => $team->term_id,
          ),
        ),
        'no_found_rows'   => true,
        'cache_results'   => true,
      )
    );

    // loop persons in team
    if ( $persons_query->have_posts() ) {
      $persons_query->the_post();

      // add person to array
      $persons[ $key ][] = array(
        'id'    => get_the_id(),
        'name'  => get_the_title(),
      );
    } // end if have_posts()
  } // end foreach
} // end if
