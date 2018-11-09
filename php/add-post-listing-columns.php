<?php

/**
 * @Author: Timi Wahalahti
 * @Date:   2018-11-09 11:47:41
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2018-11-09 11:49:39
 */

/**
 *  Add new column to event CPT
 */
function siteprefix_event_columns( $columns ) {
  return array_merge( $columns, array(
    'location'		=> __( 'Location', 'siteprefix' ),
  ) );
}
add_filter( 'manage_event_posts_columns' , 'siteprefix_event_columns' );

/**
 *  Add content for our custom columns.
 */
function siteprefix_event_columns_display( $column, $post_id ) {
  if ( $column === 'location' ) {
		$location = get_post_meta( get_the_id(), 'location', true );

		if ( ! empty( $location ) ) {
			echo $location;
		}
  }
}
add_action( 'manage_posts_custom_column' , 'siteprefix_event_columns_display', 10, 2 );
