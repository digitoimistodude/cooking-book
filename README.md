# Cooking book

Dude's cooking book is a collection of frequently used, quick front and back end code snippets by [Digitoimisto Dude Oy](https://www.dude.fi) web developer team. These snippets are mainly quick boilerplates for easy and fast use in WordPress development.

# Table of contents

2. [General PHP](#general-php)
   1. [Show all PHP errors](#show-all-php-errors)
3. [WordPress](#wordpress)
   1. [Plugins](#plugins)
     1. [ACF](#acf)
        1. [Repeater field in ACF Pro](#repeater-field-in-acf-pro)
        2. [Quick title and description fields](#quick-title-and-description-fields)
        3. [Simple flexible + repeater content structure](#simple-flexible--repeater-content-structure)
4. [MySQL](#mysql)
   1. [Replace old URL with new](#replace-old-url-with-new)

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
