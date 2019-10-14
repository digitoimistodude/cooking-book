<?php
/**
 * CPT for services.
 *
 * Registers a new post type
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @package yourproject
 */
function yourproject_register_cpt_service() {

  $labels = array(
    'name'               => __( 'Palvelut', 'yourproject' ),
    'singular_name'      => __( 'Palvelu', 'yourproject' ),
    'add_new'            => __( 'Lisää uusi palvelu', 'yourproject' ),
    'add_new_item'       => __( 'Lisää uusi palvelu', 'yourproject' ),
    'edit_item'          => __( 'Muokkaa palvelua', 'yourproject' ),
    'new_item'           => __( 'Uusi palvelu', 'yourproject' ),
    'view_item'          => __( 'Näytä palvelu', 'yourproject' ),
    'search_items'       => __( 'Hae palveluita', 'yourproject' ),
    'not_found'          => __( 'Palveluita ei löytynyt', 'yourproject' ),
    'not_found_in_trash' => __( 'Palveluita ei löytynyt roskista', 'yourproject' ),
    'parent_item_colon'  => __( 'Yläpalvelu:', 'yourproject' ),
    'menu_name'          => __( 'Palvelut', 'yourproject' ),
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

add_action( 'init', 'yourproject_register_cpt_service' );
