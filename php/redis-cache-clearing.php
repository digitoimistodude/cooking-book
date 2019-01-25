<?php


// Maybe invalidate content cache.
add_action( 'save_post', 'siteprefix_maybe_delete_content_cache' );
function siteprefix_maybe_delete_content_cache( $post_id ) {

  // do not flush caches if save is a revision.
  if ( wp_is_post_revision( $post_id ) ) {
    return;
  }

  // flush redis only when logged in user saves post
  if ( function_exists( 'wp_cache_flush' ) && is_user_logged_in() ) {
    wp_cache_flush();
  }
} // end function siteprefix_maybe_delete_content_cache

// clear footer navigation content when navigation is updated.
add_action( 'wp_update_nav_menu', 'siteprefix_delete_contents_nav' );
function siteprefix_delete_contents_nav() {
  delete_content( 'siteprefix_footer_nav' );
}

// add content cache clear link to admin bar.
add_action( 'admin_bar_menu', 'siteprefix_adminbar_add_cache_clear_link', 9999 );
function siteprefix_adminbar_add_cache_clear_link( $wp_admin_bar ) {
  $wp_admin_bar->add_node( array(
    'id'    => 'siteprefixccaheclear',
    'title' => __( 'Empty cache', 'siteprefix' ),
    'href'  => wp_nonce_url( add_query_arg( array( 'clear-siteprefix-cache' => true ) ), 'clear_cache', 'siteprefix_cache_clear_nonce' ),
  ) );
}

// maybe clear content cache if admin bar link was clicked.
add_action( 'admin_init', 'siteprefix_maybe_clear_content_cache' );
function siteprefix_maybe_clear_content_cache() {
  // bail if current user not logged in
  if ( ! is_user_logged_in() ) {
    return;
  }

  // bail if nonce is not there or is invalid.
  if ( ! isset( $_GET['siteprefix_cache_clear_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( $_GET['siteprefix_cache_clear_nonce'] ), 'clear_cache' ) ) {
    return;
  }

  global $wpdb;

  // flush redis
  if ( function_exists( 'wp_cache_flush' ) && is_user_logged_in() ) {
    wp_cache_flush();
  }

  // add notification to show message.
  add_action( 'admin_notices', 'siteprefix_content_cache_cleared' );
}

// show success notification on content cache clear.
function siteprefix_content_cache_cleared() {
  $class = 'notice notice-success';
  $message = __( 'Cache emptied!', 'siteprefix' );
  printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
