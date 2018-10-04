<?php

/**
 *  NOTE!
 *
 *  This snippet is suggested to use only if your server and
 *  WordPress installation has redis or some similar software
 *  enabled. Saving modulat content html output to database is
 *  not adviced.
 */

// define what modules se should NOT cache.
$exclude_template_part_from_cache = array(
  'contact-form'  => true,
);

// normally we want to use current page id
$have_rows_id = get_the_id();

/**
 *  ... but there is some expectations, like:
 *  - blog archive page
 *  - custom post type archive pages
 *
 *  NOTE! these cheks assumes you use air-helper, polylang and
 *  page for post type (humanmade/page-for-post-type) plugins.
 */
if ( is_home() ) {
	$have_rows_id = pll_get_post( get_option( 'page_for_posts' ) );
} elseif ( is_post_type_archive() ) {
	$post_type = get_post_type();
	$have_rows_id = pll_get_post( get_option( "page_for_{$post_type}" ) );
}

// check if there is modules.
if ( have_rows( 'modular_content', $have_rows_id ) ) :

	// loop modules.
  while ( have_rows( 'modular_content', $have_rows_id ) ) : the_row();

  	// make template part name.
    $template_part_name = str_replace( '_', '-', get_row_layout() );
    $template_part_path = get_theme_file_path( "template-parts/modules/{$template_part_name}.php" );

    /**
     *  Make transient key.
     *  Key contains $have_rows_id to differiate modules if same module is used on multiple pages
     *
     *  TOOD: differiate use case where same module is used multiple times (add row ID to key)
     */
    $template_part_transient_name = "modular_page_{$have_rows_id}_module_{$template_part_name}";

    // check if module needs to bypass cache
    if ( ! array_key_exists( $template_part_name, $exclude_template_part_from_cache ) ) {

      // module can be cached, try to find it is already in cache.
      if ( ! $template_part_output = get_transient( $template_part_transient_name ) ) {

        // module is not in cache.
        // validate that file actually exists.
        if ( file_exists( $template_part_path ) ) {

          // get module content.
          ob_start( 'ob_gzhandler' );
          include $template_part_path;
          $template_part_output = ob_get_clean();

          // save module to cache.
          set_transient( $template_part_transient_name, $template_part_output, HOUR_IN_SECONDS );
        }
      }
    } else {
      // module is exluded from cache.

      // validate that file actually exists.
      if ( file_exists( $template_part_path ) ) {

        // get module content.
        ob_start();
        include $template_part_path;
        $template_part_output = ob_get_clean();
      }
    }

    // finally output module content.
    echo $template_part_output;
  endwhile;
endif;
