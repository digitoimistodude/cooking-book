<?php

/**
 * Better Flexible Content field with image previews, title and module name.
 */
add_action( 'acf/input/admin_head', 'siteprefix_acf_admin_head_custom_js_css' );
function siteprefix_acf_admin_head_custom_js_css() { ?>
  <style>
    /* do not show flexible content fields if it is not collapsed */
    .acf-flexible-content .acf-fields.-collapse {
      display: none;
    }

    /* do not show repeter fields if not collapsed */
    .acf-repeater.-row .acf-row > .acf-row-handle .acf-icon.-collapse {
      display: block;
    }

    /* better styiling? */
    .acf-postbox .acf-field.separator {
      padding-bottom: 0;
    }
    .acf-postbox .acf-field.separator .acf-label {
      margin: 0;
    }
    .acf-postbox .acf-field.separator label {
      font-size: 14px;
    }
    .acf-postbox .acf-field.separator + .acf-field {
      border-top: none;
    }

    /* style edit links on relation fields */
    .acf-postbox .acf-relationship .values  span.acf-rel-item a.edit-link {
      font-style: italic;
      font-size: 12px;
    }

    .acf-postbox .acf-relationship .selection .values  span.acf-rel-item:hover a.edit-link {
      color: #fff;
    }

    /* module preview styles */
    .acf-module-preview {
      display: none;
      position: fixed;
      left: 170px;
      top: 40px;
      z-index: 100;

      height: 300px;
      max-height: 300px;

      width: 900px;
      max-width: 900px;
    }

    .acf-module-preview img {
      border: solid 10px #fff;
      width: 100%;
    }

    .acf-module-preview.show {
      display: block;
    }
  </style>

  <script type="text/javascript">
    jQuery(function($) {
      var images_path = '<?php echo get_stylesheet_directory_uri() ?>';
      var timer;

      // do not show flexible content or row field before opening, excluding new items
      $('.acf-flexible-content .layout:not(.acf-clone)').addClass('-collapsed');
      $('#acf-flexible-content-collapse').detach();

      // show module preview image when module name is hovered
      jQuery(document).on({
        'mouseover': function () {
          timer = setTimeout(function () {
            layout = jQuery('.acf-tooltip.acf-fc-popup li a:hover').attr('data-layout')
            jQuery('.acf-module-preview').html( '<img src="' + images_path + '/images/acf-modules/' + layout + '.png">' );
            jQuery('.acf-module-preview').addClass('show');
          }, 100);
        },
        'mouseout' : function () {
          clearTimeout(timer);
          jQuery('.acf-module-preview').removeClass('show');
        }
      }, '.acf-tooltip.acf-fc-popup li a' );

      // hide module preview when module is added
      acf.addAction('append', function( $el ){
        jQuery('.acf-module-preview').removeClass('show');
      });
    });
  </script>
<?php }

add_action( 'acf/input/admin_footer', 'siteprefix_acf_add_module_preview' );
function siteprefix_acf_add_module_preview() {
  echo '<div class="acf-module-preview"></div>';
}

// Add edit link to ACF relationship results
add_filter( 'acf/fields/relationship/result', 'siteprefix_acf_field_relationship_result', 10, 4 );
function siteprefix_acf_field_relationship_result( $result, $object, $field, $post ) {
  $link = '<a href="' . get_edit_post_link( $object->ID ) . '" class="edit-link">Edit ' . $object->post_type . '</a>';
  return $result . ' ' . $link;
}

// Modify ACF Flexible field title to show area title and module type.
add_filter( 'acf/fields/flexible_content/layout_title', 'siteprefix_acf_flexible_content_layout_title', 10, 4 );
function siteprefix_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {
  $new_title = get_sub_field( 'area_title' );

  if ( empty( $new_title ) ) {
    $new_title = get_sub_field( 'title' );
  }

  $old_title = $title;

  if ( ! empty( $new_title ) ) {
    $title = '<b>' . $new_title . '</b><br />';
    $title .= ' <small><i>Module: ' . $old_title . '</i></small>';
  }

  return $title;
}
