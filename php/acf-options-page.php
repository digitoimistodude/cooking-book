<?php
/**
 * This function will add global options page to the ‘wp-admin’ dashboard.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */

if ( function_exists( 'acf_add_options_page' ) ) {
  $option_page = acf_add_options_page(array(
    'page_title'  => 'Alatunniste',
    'menu_title'  => 'Alatunniste',
    'menu_slug'   => 'footer-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false,
    'position'    => 30,
    // Better icons: https://icongr.am/
    'icon_url'    => 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" fill="currentColor" width="20" height="20" viewBox="0 0 24 24"><path d="M6,2H18C19.1,2 20,2.9 20,4V20C20,21.1 19.1,22 18,22H6C4.9,22 4,21.1 4,20V4C4,2.9 4.9,2 6,2M6,16V20H18V16H6Z"/></svg>' ),
  ));
}
