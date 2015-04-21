# Front End Cheat Sheet

A collection of frequently used front end code snippets by [Roni "Rolle" Laukkarinen](http://www.twitter.com/rolle). Used [CodeBox](http://www.shpakovski.com/codebox/) for a long time, but noticed it was overkill for simple snippets. So, back to basics.

# Table of contents

1. [jQuery](#jquery)
   
   1. [Resize div based on viewport height](#resize-div-based-on-viewport-height)
   
2. [PHP](#php)
   
   1. [Repeater field in ACF Pro](#repeater-field-in-acf-pro)
   2. [Show all PHP errors](#show-all-php-errors)
   
3. [MySQL](#mysql)
   
   1. [Replace old URL with new](#replace-old-url-with-new)

4. [Bash / Other](#bash-other)

   1. [Find all projects with gravityforms installed](#find-all-projects-with-gravityforms-installed)
   2. [Quick backup to HTML + resources](#quick-backup-to-html-resources)
   


## jQuery

### Resize div based on viewport height

``` javascript
$('.slide').css('height', window.innerHeight);
$(window).resize(function(){
    $('.slide').css('height', window.innerHeight);
});
```

## PHP

### Repeater field in ACF Pro

``` php
<?php if( have_rows('repeater') ): ?>
    <div class="repeater wrapper">

    <?php while( have_rows('repeater',$id) ): the_row(); 
        $repeater_title = get_sub_field('repeater_title');
        $repeater_description = get_sub_field('repeater_description');
        $image = get_sub_field('repeater_image');
        $repeater_image = $image['sizes'][ 'large' ];
    ?>

        <div class="item">

            <div class="description-container">
                <h2><?php echo $repeater_title; ?></h2>
                <?php echo wpautop($repeater_description); ?>
            </div>

            <div class="image-container">
                <?php if($repeater_image) : ?>
                    <img src="<?php echo $repeater_image; ?>" alt="<?php echo $repeater_title; ?>" />
                <?php endif; ?>
            </div>

        </div>

    <?php endwhile; ?> 

    </div>
<?php endif; ?>
```

### Show all PHP errors

``` php
<?php 
    ini_set('display_errors', 1); 
    error_reporting(E_ALL);
?>
```

## MySQL

### Replace old URL with new

``` sql
update wp_posts set post_content = replace(post_content, 'http:\/\/oldurl.info', 'http:\/\/newurl.com');
```

## Bash / Other

### Find all projects with gravityforms installed

``` bash
grep -R "gravityforms" --include "composer.json" Projects/
```

### Quick backup to HTML + resources

``` bash
wget --mirror --convert-links --adjust-extension --page-requisites --no-parent  http://www.example.com/
```