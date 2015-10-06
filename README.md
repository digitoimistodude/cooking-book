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
   2. [Quick backup entire site](#quick-backup-entire-site)
   3. [Check WordPress versions in composer.json](#check-wordpress-versions-in-composerjson)
   4. [Replace WordPress versions in composer.json (OS X)](#replace-wordpress-versions-in-composerjson-os-x)

## jQuery

#### Resize div based on viewport height

``` javascript
$('.slide').css('height', window.innerHeight);
$(window).resize(function(){
    $('.slide').css('height', window.innerHeight);
});
```

## PHP

#### Repeater field in ACF Pro

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

#### Show all PHP errors

``` php
<?php 
    ini_set('display_errors', 1); 
    error_reporting(E_ALL);
?>
```

## MySQL

#### Replace old URL with new

``` sql
update wp_posts set post_content = replace(post_content, 'http:\/\/oldurl.info', 'http:\/\/newurl.com');
```

## Bash / Other

#### Find all projects with gravityforms installed

``` bash
grep -R "gravityforms" --include "composer.json" Projects/
```

#### Quick backup entire site

``` bash
wget --cache=off -U "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36" --cookies=on --glob=on --tries=3 --proxy=off -e robots=off -x -r --level=1 -p -H -k --quota=100m http://www.example.com/
```

#### Check WordPress versions in composer.json

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