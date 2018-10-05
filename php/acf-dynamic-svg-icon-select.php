<?php

/**
 * @Author: Timi Wahalahti
 * @Date:   2018-10-05 11:23:09
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2018-10-05 11:26:25
 */

/**
 *  Make dynamic svg icon select to ACF select fields which name
 *  contains "icon_svg".
 *
 *  NOTE! This functions needs air-helper to work.
 */
function siteprefix_acf_dynamic_select_for_icon( $field ) {

	// check if field name does not contain "icon_svg" and check that our function to get icons exists.
  if ( ! strpos( $field['name'], 'icon_svg' ) && ! function_exists( 'get_icons_for_user' ) ) {
    return $field;
  }

  // add icons from "svg/foruser" directory.
  $field['choices'] = get_icons_for_user();

  return $field;
}
add_filter( 'acf/load_field/type=select', 'siteprefix_acf_dynamic_select_for_icon' );
