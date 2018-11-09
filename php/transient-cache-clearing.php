<?php

// Maybe invalidate content transients.
add_action( 'save_post', 'siteprefix_maybe_delete_transients' );
function siteprefix_maybe_delete_transients( $post_id ) {

  // do not flush caches if save is a revision.
  if ( wp_is_post_revision( $post_id ) ) {
    return;
  }

  /**
   *  Get all site content transients from databse. This comes handy later on
   *  when we need to flush transients that has dynamic values in end of the key.
   *
   *  @codingStandardsIgnoreStart
   */
  global $wpdb;
  $sql = "SELECT `option_name` AS `name` FROM  $wpdb->options WHERE `option_name` LIKE '%transient_siteprefix%'";
  $transients = $wpdb->get_results( $wpdb->prepare( $sql ) );
  // @codingStandardsIgnoreEnd

  // no saved transients so no need to go any further, bail.
  if ( empty( $transients ) ) {
    return;
  }

  // loop transients and make nicer array for handling.
  foreach ( $transients as $key => $transient ) {
    $transients[ $key ] = @end( explode( '_transient_', $transient->name ) );
  }

  // get post type of saved post.
  $post_type = get_post_type( $post_id );

  // clear cache for custom post type.
  if ( 'CPT' === $post_type ) {

    /**
     *  Loop trhu all tranients, if transient name matches to custom post type, delete.
     *  Custom post type transients might contain dynamic data at the end, post ID's seperated
     *  with |
     */
    foreach ( $transients as $transient ) {
      if ( strpos( $transient, 'siteprefix_cpt' ) !== false ) {
        delete_transient( $transient );
      }
    }
  } // end clear cache for custom post type.
} // end function siteprefix_maybe_delete_transients

// clear footer navigation transient when navigation is updated.
add_action( 'wp_update_nav_menu', 'siteprefix_delete_transients_nav' );
function siteprefix_delete_transients_nav() {
  delete_transient( 'siteprefix_footer_nav' );
}

// add content cache clear link to admin bar.
add_action( 'admin_bar_menu', 'siteprefix_adminbar_add_cache_clear_link', 9999 );
function siteprefix_adminbar_add_cache_clear_link( $wp_admin_bar ) {
  global $wp;
  $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
  $wp_admin_bar->add_node( array(
    'id'    => 'siteprefixccaheclear',
    'title' => __( 'Clear content cache', 'siteprefix' ),
    'href'  => wp_nonce_url( add_query_arg( array( 'clear-siteprefix-cache' => true ), $current_url ), 'clear_cache', 'siteprefix_cache_clear_nonce' ),
  ) );
}

// maybe clear transient cache if admin bar link was clicked.
add_action( 'admin_init', 'siteprefix_maybe_clear_transient_cache' );
function siteprefix_maybe_clear_transient_cache() {
  // bail if current user not logged in
  if ( ! is_user_logged_in() ) {
    return;
  }

  // bail if nonce is not there or is invalid.
  if ( ! isset( $_GET['siteprefix_cache_clear_nonce'] ) || ! wp_verify_nonce( $_GET['siteprefix_cache_clear_nonce'], 'clear_cache' ) ) {
    return;
  }

  global $wpdb;

  // get all site content transients from databse.
  // @codingStandardsIgnoreStart
  $sql = "SELECT `option_name` AS `name` FROM  $wpdb->options WHERE `option_name` LIKE '%transient_siteprefix%'";
  $transients = $wpdb->get_results( $sql );
  // @codingStandardsIgnoreEnd

  // no saved transients so no need to go any further, bail.
  if ( empty( $transients ) ) {
    return;
  }

  // loop transients and delete ever each one.
  foreach ( $transients as $key => $transient ) {
    delete_transient( @end( explode( '_transient_', $transient->name ) ) );
  }

  // add notification to show message.
  add_action( 'admin_notices', 'siteprefix_transient_cache_cleared' );
}

// show success notification on content cache clear.
function siteprefix_transient_cache_cleared() {
  $class = 'notice notice-success';
  $message = __( 'Content cache cleared!', 'siteprefix' );
  printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
