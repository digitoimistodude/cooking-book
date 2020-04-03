# List of recyclable modules

This document contains list of recyclable modules used in old projects. The point is to make building of similar modules faster in future projects.

# Table of contents

1. [Modules with static text and media](#modules-with-static-text-and-media)
    1. [text-image-static](#text-image-static)
    2. [gallery-slider](#gallery-slider)
    2. [gallery-masonry](#gallery-masonry)
2. [Modules with relations to CPTs](#modules-with-relations-to-cpts)
    1. [person](#person)

## Modules with static text and media

### text-image-static

``` scss
@import '../modules/text-image-static';
```

- **[PHP:](/php)** [text-image-static.php](https://github.com/digitoimistodude/jptindustria/blob/master/content/themes/jptindustria/template-parts/modules/text-image-static.php)
- **[SCSS:](/scss)** [_text-image-static.scss](https://github.com/digitoimistodude/jptindustria/blob/master/content/themes/jptindustria/sass/modules/_text-image-static.scss)

![text-image-static](https://fileshare.servebeer.com/ihAMI.png "text-image-static")

---

### gallery-slider

``` scss
@import '../modules/gallery';
```

- **[PHP:](/php)** [gallery.php](https://github.com/digitoimistodude/clojutre/blob/0e1af5404f5b1a69dbcd5b8f0fd9afd89711dcf5/content/themes/clojutre/template-parts/modules/gallery.php#L1-L39)
- **[SCSS:](/scss)** [_gallery.scss](https://github.com/digitoimistodude/clojutre/blob/0e1af5404f5b1a69dbcd5b8f0fd9afd89711dcf5/content/themes/clojutre/sass/modules/_gallery.scss#L1-L30)

![gallery](https://fileshare.servebeer.com/AXJhh.png "gallery")

### gallery-masonry

``` scss
@import '../features/gallery-fullscreen';
@import '../modules/masonry-gallery';
```

- **[PHP:](/php)** [masonry-gallery.php](https://github.com/digitoimistodude/byemmi/blob/master/content/themes/byemmi/template-parts/modules/masonry-gallery.php)
- **[SCSS:](/scss)** [_masonry-gallery.scss](https://github.com/digitoimistodude/byemmi/blob/master/content/themes/byemmi/sass/modules/_masonry-gallery.scss)
- **[SCSS:](/scss)** [_gallery-fullscreen.scss](https://github.com/digitoimistodude/byemmi/blob/master/content/themes/byemmi/sass/features/_gallery-fullscreen.scss)
- **[JSON:](/js)** [package.json](https://github.com/digitoimistodude/byemmi/blob/1acad5eb3ce90d3a6711f088c61c999e6f880f6f/content/themes/byemmi/package.json#L43)
- **[JSON:](/js)** [package.json](https://github.com/digitoimistodude/byemmi/blob/1acad5eb3ce90d3a6711f088c61c999e6f880f6f/content/themes/byemmi/package.json#L48)
- **[JS:](/js)** [gulpfile.json](https://github.com/digitoimistodude/byemmi/blob/1acad5eb3ce90d3a6711f088c61c999e6f880f6f/gulpfile.js#L401-L408)
- **[JS:](/js)** [scripts.js](https://github.com/digitoimistodude/byemmi/blob/1acad5eb3ce90d3a6711f088c61c999e6f880f6f/content/themes/byemmi/js/src/scripts.js#L24-L54)
- **[HTML:](/js)** [header.php](https://github.com/digitoimistodude/byemmi/blob/1acad5eb3ce90d3a6711f088c61c999e6f880f6f/content/themes/byemmi/header.php#L26-L35)

![gallery-masonry](https://fileshare.servebeer.com/de6RS.png "gallery-masonry")


---

## Modules with relations to CPTs

### person

``` scss
@import '../modules/person';
```

- **[PHP:](/php)** [person.php](https://github.com/digitoimistodude/jptindustria/blob/master/content/themes/jptindustria/template-parts/modules/person.php)
- **[SCSS:](/scss)** [_person.scss](https://github.com/digitoimistodude/jptindustria/blob/master/content/themes/jptindustria/sass/modules/_person.scss)

![person](https://fileshare.servebeer.com/0byUC.png "person")

---