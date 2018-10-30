<?php
/**
 * Custom pagination
 *
 * @package air-light SCSS equivalent can be found from cooking-book/scss (air-light import location: features/_custom-pagination.scss )
 */
function custom_pagination() {
  global $wp_query;

  $big = 999999999; // Need an unlikely integer

  $paginate_links = paginate_links(
    array(
      'base'        => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'      => '?paged=%#%',
      'current'     => max( 1, get_query_var( 'paged' ) ),
      'total'       => $wp_query->max_num_pages,
      'prev_text'   => __( '&larr; uudempia' ),
      'next_text'   => __( 'vanhempia &rarr;' ),
    )
  );

  echo '<p class="custom-pagination">' . $paginate_links . '</p>';
}
