<?php

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
if ( have_rows( 'modular_content', $have_rows_id ) ) {

	// loop modules.
  while ( have_rows( 'modular_content', $have_rows_id ) ) {
  	the_row();

    // make template part name.
    $template_part_name = str_replace( '_', '-', get_row_layout() );
    $template_part_path = get_theme_file_path( "template-parts/modules/{$template_part_name}.php" );

    // check if file really exists and output (include) module if file exists.
    if ( file_exists( $template_part_path ) ) {
      include $template_part_path;
    }
  }
}
