<?php
/**
 * WordPress recolors svgs so this makes sure the menu_icon is same than others
 * Use this only if you use custom icons for CPTs
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
