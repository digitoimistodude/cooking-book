/**
 * Get all terms which have articles with certain post type
 * linked to them. Uses a transient because of a possibly slow tax query.
 *
 * @param String $post_type Post type slug
 * @param String $taxonomy Taxonomy slug
 * @param Int $expire Time in seconds for transient expiration, set 0 to not use transient
 *
 * @return Array Term objects
 */

function get_terms_by_post_type( $post_type, $taxonomy, $expire = 10 * MINUTE_IN_SECONDS ) {
  $transient_key = 'otso_' . $taxonomy . '_with_' . $post_type;

  // Check if to use transient and a transient is found
  if ( $expire && get_transient( $transient_key ) ) {
    return get_transient( $transient_key );
  }

  $all_terms = get_terms(
    array(
    'taxonomy' => $taxonomy,
    )
  );

  // Filter terms that have no articles of post type
  $terms = array_filter( $all_terms, function ( $term ) use ( $taxonomy, $post_type ) {
    return get_posts(
      array(
        'post_type' => $post_type,
        'tax_query' => array(
          array(
              'taxonomy' => $taxonomy,
              'field'    => 'id',
              'terms'    => array( $term->term_id ),
          ),
        ),
      )
    );
  });

  // Save to transient if expire is not 0
  if ( $expire ) {
    set_transient( $transient_key, $terms, $expire );
  }

  return $terms;
}
