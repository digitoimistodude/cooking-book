# Cooking book

Dude's Cooking Book is a collection of frequently used, quick front and back end code snippets by [Digitoimisto Dude Oy](https://www.dude.fi) web developer team. These snippets are mainly quick boilerplates for easy and fast use in WordPress development.

# Table of contents

1. [jQuery](#jquery)
   1. [Resize div based on viewport height](#resize-div-based-on-viewport-height)
2. [General PHP](#general-php)
   1. [Show all PHP errors](#show-all-php-errors)
3. [WordPress](#wordpress)
   1. [Plugins](#plugins)
     1. [ACF](#acf)
        1. [Repeater field in ACF Pro](#repeater-field-in-acf-pro)
        2. [Quick title and description fields](#quick-title-and-description-fields)
        3. [Simple flexible + repeater content structure](#simple-flexible--repeater-content-structure)
        4. [Options page for layout settings](#options-page-for-layout-settings)
4. [MySQL](#mysql)
   1. [Replace old URL with new](#replace-old-url-with-new)

## jQuery

##### Resize div based on viewport height

``` javascript
$('.slide').css('height', window.innerHeight);
$(window).resize(function(){
    $('.slide').css('height', window.innerHeight);
});
```

## WordPress
### Plugins
#### ACF

##### Repeater field in ACF Pro

``` php
<?php if ( have_rows( 'repeater' ) ) :
  while( have_rows( 'repeater' ) ) : the_row();

    // Fields
    $repeater_image = get_sub_field( 'repeater_image' );
    $repeater_title = get_sub_field( 'repeater_title' );

    if ( ! empty( $repeater_title ) ) : ?>
      <h2><?php echo $repeater_title; ?></h2>
    <?php endif;
    if ( ! empty( $repeater_image ) ) : ?>
      <img src="<?php echo $repeater_image['sizes'][ 'large' ]; ?>" alt="<?php echo $repeater_title; ?>" />
    <?php endif;
  endwhile;
endif; ?>
```

##### Quick title and description fields

``` php
<?php if ( get_field( 'main_title') ) : ?>
  <h2><?php echo get_field( 'main_title' ); ?></h2>
<?php endif; ?>

<?php if ( get_field( 'main_description' ) ) : ?>
  <?php echo get_field( 'main_description' ); ?>
<?php endif; ?>
```

##### Simple flexible + repeater content structure

``` php
<?php if ( have_rows( 'section' ) ) : ?>
  <?php while ( have_rows( 'section' ) ) : the_row(); ?>

    <?php if ( get_row_layout() === 'section_layout' ) : ?>

      <?php if ( have_rows( 'section_repeater' ) ) : ?>
        <?php while ( have_rows( 'section_repeater' ) ) : the_row(); ?>

          <?php if ( get_sub_field( 'repeater_field' ) ) : ?>
            <?php echo get_sub_field( 'repeater_field' ); ?>
          <?php endif; ?>

        <?php endwhile; ?>
      <?php endif; ?>

    <?php elseif ( get_row_layout() === 'section_another_layout' ) : ?>

      <?php if ( get_sub_field( 'section_another_title' ) ) : ?>
        <h2><?php echo get_sub_field( 'section_another_title' ); ?></h2>
      <?php endif; ?>

      <?php if ( get_sub_field( 'section_another_description' ) ) : ?>
        <h2><?php echo get_sub_field( 'section_another_description' ); ?></h2>
      <?php endif; ?>

    <?php endif; ?>

  <?php endwhile; ?>
<?php endif; ?>
```

##### Options page for layout settings

``` php
/**
 * This function will add global options page to the ‘wp-admin’ dashboard.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
if ( function_exists( 'acf_add_options_page' ) ) {

  $option_page = acf_add_options_page(array(
    'page_title'  => 'Layout',
    'menu_title'  => 'Layout',
    'menu_slug'   => 'more-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false,
    'position'    => 30,
    // Better icons: https://icongr.am/
    'icon_url'    => 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" fill="#9ea4aa" width="20" height="20" viewBox="0 0 24 24"><path d="M6,2H18C19.1,2 20,2.9 20,4V20C20,21.1 19.1,22 18,22H6C4.9,22 4,21.1 4,20V4C4,2.9 4.9,2 6,2M6,16V20H18V16H6Z"/></svg>' ),
  ));

}
```

Also, this is needed when using icongr.am custom SVG icons:

``` php
/**
 * WordPress recolors svgs so this makes sure the menu_icon is same than others
 */
add_action( 'admin_head', 'air_fix_admin_svg' );

function air_fix_admin_svg() {
  echo '
  <style type="text/css">
    .wp-menu-image.svg {
      filter: brightness(121.5%) !important;
    }

    /* Hide setting parent on taxonomy, we do not want anyone to do that */
    .form-field.term-parent-wrap {
      display: none !important;
    }

    /* Hide "some themes might use this" crap description on taxonomy description */
    .term-description-wrap p.description {
      display: none !important;
    }
  }
  </style>';
}
```

## General PHP
##### Show all PHP errors

``` php
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
```

## MySQL

##### Replace old URL with new

``` sql
update wp_posts set post_content = replace(post_content, 'http:\/\/oldurl.info', 'http:\/\/newurl.com');
```