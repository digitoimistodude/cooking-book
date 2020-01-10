<?php
/**
 * This function will add global options page to the ‘wp-admin’ dashboard.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
if ( function_exists( 'acf_add_options_page' ) ) {
  $option_page = acf_add_options_page(array(
    'page_title'  => 'Globaalit sivuston laajuiset kentät ja asetukset',
    'menu_title'  => 'Globaalit',
    'menu_slug'   => 'global-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false,
    'position'    => 30,
    // Better icons: https://icongr.am/
    'icon_url'    => 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-view-grid-plus-outline" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M3 21H11V13H3M5 15H9V19H5M3 11H11V3H3M5 5H9V9H5M13 3V11H21V3M19 9H15V5H19M18 16H21V18H18V21H16V18H13V16H16V13H18Z"/></svg>' ),
  ));
}
