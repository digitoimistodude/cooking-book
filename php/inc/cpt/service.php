<?php
/**
 * CPT for services.
 *
 * Registers a new post type
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @package siteprefix
 */
function siteprefix_register_cpt_service() {

  $labels = array(
    'name'               => __( 'Palvelut', 'siteprefix' ),
    'singular_name'      => __( 'Palvelu', 'siteprefix' ),
    'add_new'            => __( 'Lisää uusi palvelu', 'siteprefix' ),
    'add_new_item'       => __( 'Lisää uusi palvelu', 'siteprefix' ),
    'edit_item'          => __( 'Muokkaa palvelua', 'siteprefix' ),
    'new_item'           => __( 'Uusi palvelu', 'siteprefix' ),
    'view_item'          => __( 'Näytä palvelu', 'siteprefix' ),
    'search_items'       => __( 'Hae palveluita', 'siteprefix' ),
    'not_found'          => __( 'Palveluita ei löytynyt', 'siteprefix' ),
    'not_found_in_trash' => __( 'Palveluita ei löytynyt roskista', 'siteprefix' ),
    'parent_item_colon'  => __( 'Yläpalvelu:', 'siteprefix' ),
    'menu_name'          => __( 'Palvelut', 'siteprefix' ),
  );

  $args = array(
    'labels'              => $labels,
    'hierarchical'        => true,
    'description'         => 'description',
    'taxonomies'          => array( 'category' ),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-hammer',
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => true,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => array( 'slug' => 'palvelut' ),    
    'capability_type'     => 'post',
    'supports'            => array(
      'title',
      'editor',
      'thumbnail',
      'custom-fields',
      'revisions',
      'page-attributes',
    ),
  );

  register_post_type( 'service', $args );
}

add_action( 'init', 'siteprefix_register_cpt_service' );
