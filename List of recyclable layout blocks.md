# List of recyclable layout blocks

This document contains list of recyclable layout blocks used in old projects. The point is to make building of similar modules faster in future projects.

# Table of contents

1. [Navigations](#navigations)
2. [Page elements](#page-elements)
    1. [filters](#filters)
3. [Heros](#heros)
    1. [hero-fp-slider](#hero-fp-slider)
4. [Footers](#footers)
    1. [footer-with-three-link-cols-and-contact](#footer-with-three-link-cols-and-contact)

## Navigations

Nothing yet.

## Page elements

### filters

Reusable filters.

``` scss
@import '../layout/filters';
```

- **[PHP:](/php)** [_template-device.php](https://github.com/digitoimistodude/jptindustria/blob/a487a5ee3de401aa65e292edddb71705f66711a9/content/themes/jptindustria/template-device.php#L64-L139)
- **[SCSS:](/scss)** [_filters.scss](https://github.com/digitoimistodude/ctsengtec/blob/master/content/themes/ctsengtec/sass/layout/_filters.scss)

![filters](https://i.imgur.com/a0HXEYO.png "filters")

---

## Heros

### hero-fp-slider

Front page hero slider with changing background image **and** text, without arrows or dots.

``` scss
@import '../extra/slick';
@import '../modules/hero-fp-slider';
```

- **[PHP:](/php)** [front-page.php](https://github.com/digitoimistodude/jptindustria/blob/c8cceceed198f841394d2b718522cc9053f877ef/content/themes/jptindustria/front-page.php#L22-L67)
- **[SCSS:](/scss)** [_front-page.scss](https://github.com/digitoimistodude/jptindustria/blob/c8cceceed198f841394d2b718522cc9053f877ef/content/themes/jptindustria/sass/views/_front-page.scss#L1-L33)

![hero-fp-slider](https://i.imgur.com/csV33NS.png "hero-fp-slider")

---

## Footers

### footer-with-three-link-cols-and-contact

Footer that has three selectable links and contact area.

``` scss
@import '../layout/footer';
```

- **[PHP:](/php)** [footer.php](https://github.com/digitoimistodude/jptindustria/blob/c5ec6c82c5405a243885619c015b9f967c451397/content/themes/jptindustria/footer.php#L1-L72)
- **[SCSS:](/scss)** [_site-footer.scss](https://github.com/digitoimistodude/jptindustria/blob/master/content/themes/jptindustria/sass/layout/_site-footer.scss)

![footer-with-three-link-cols-and-contact](https://i.imgur.com/jNVvodw.png "footer-with-three-link-cols-and-contact")

---
