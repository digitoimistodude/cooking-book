<?php

function get_primary_category( $post_id = 0 ) {
  $post_id = ! empty( $post_id ) ? $post_id : get_the_id();

  $cat_id = get_post_meta( $post_id, '_yoast_wpseo_primary_category', true );
  if ( empty( $cat_id ) ) {
    $cat_id = get_post_meta( $post_id, '_primary_term_category', true );
  }

  if ( ! empty( $cat_id ) ) {
    return get_term( $cat_id, 'category' );
  }

  $cats = get_the_category( $post_id );

  if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) {
    return $cats[0];
  }

  return false;
} // end get_primary_category
