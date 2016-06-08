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
4. [MySQL](#mysql)
   1. [Replace old URL with new](#replace-old-url-with-new)
5. [Bash / Other](#bash-other)
   1. [Find all projects with gravityforms installed](#find-all-projects-with-gravityforms-installed)
   2. [Quick backup entire site](#quick-backup-entire-site)
   3. [Check WordPress versions in composer.json](#check-wordpress-versions-in-composerjson)
   4. [Replace WordPress versions in composer.json (OS X)](#replace-wordpress-versions-in-composerjson-os-x)

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
<?php if( have_rows('repeater') ): ?>

    <?php while( have_rows('repeater',$id) ): the_row(); 
        $image = get_sub_field('repeater_image');
    ?>

        <?php if ( get_sub_field('repeater_title') ) : ?>
          <h2><?php echo get_sub_field('repeater_title'); ?></h2>
        <?php endif; ?>

        <?php if( $image ) : ?>
            <img src="<?php echo $image['sizes'][ 'large' ]; ?>" alt="<?php echo get_sub_field('repeater_title'); ?>" />
        <?php endif; ?>

    <?php endwhile; ?> 

<?php endif; ?>
```

##### Quick title and description fields

``` php
<?php if ( get_field( 'main_title') ) : ?>
  <h2><?php echo get_field('main_title'); ?></h2>
<?php endif; ?>

<?php if ( get_field( 'main_description') ) : ?>
  <?php echo get_field('main_description'); ?>
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

## Bash / Other

##### Find all projects with gravityforms installed

``` bash
grep -R "gravityforms" --include "composer.json" Projects/
```

##### Quick backup entire site

``` bash
wget --cache=off -U "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36" --cookies=on --glob=on --tries=3 --proxy=off -e robots=off -x -r --level=1 -p -H -k --quota=100m http://www.example.com/
```

##### Check WordPress versions in composer.json

``` bash
grep -R "johnpbloch/wordpress" ~/Projects/*/composer.json
```

In `~/.bashrc`:

``` bash
alias wpversions='grep -R "johnpbloch/wordpress" ~/Projects/*/composer.json'
```

Restart terminal or run `. ~/.bashrc` for changes to take effect. Then you can just type `wpversions` to see WordPress versions.

#### Replace WordPress versions in composer.json (OS X)

``` bash
find ~/Projects/ -name composer.json -maxdepth 2 -exec sed -i "" 's/4.2.3/4.2.4/g' {} +
```

Bash alias in `~/.bashrc`:

``` bash
alias updateversion='find ~/Projects/ -name composer.json -maxdepth 2 -exec sed -i "" 's/$1/$2/g' {} +'
```

Then you can update any version by typing `updateversion oldversion newversion`, for example WordPress 4.2.3 to WordPress 4.2.4: `updateversion 4.2.3 4.2.4`.