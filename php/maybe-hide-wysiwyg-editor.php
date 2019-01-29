<?php

function siteprefix_maybe_hide_editor() {
  if ( ! isset( $_GET['post'] ) ) { // @codingStandardsIgnoreLine
    return;
  }

  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID']; // @codingStandardsIgnoreLine

  if ( ! isset( $post_id ) ) {
    return;
  }

  $template = get_page_template_slug( $post_id );

  if ( 'template-basic.php' !== $template ) {
    remove_post_type_support( 'page', 'editor' );
  }
}
add_action( 'admin_init', 'siteprefix_maybe_hide_editor' );
