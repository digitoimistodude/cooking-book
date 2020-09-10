/**
 * Add focal points to lazyload images
 *
 * Requires Air Helper and WP Smart Crop
 */
function add_focal_point_to_img( $styles, $thumbnail_id ) {
  $parsed_dimensions = get_crop_dimensions( $thumbnail_id );
    
    if ( ! $parsed_dimensions ) {
      return $styles;
    }

  $styles['object-position'] = implode( ' ', $parsed_dimensions );

  return $styles;
}

add_filter( 'air_image_lazyload_img_styles', 'add_focal_point_to_img', 10, 2 );

/**
 * Add focal points to lazyload divs
 *
 * Requires Air Helper and WP Smart Crop
 */
function add_focal_point_to_div( $styles, $thumbnail_id ) {
    $parsed_dimensions = get_crop_dimensions( $thumbnail_id );
    
    if ( ! $parsed_dimensions ) {
      return $styles;
    }

    $styles['background-position'] = implode( ' ', $parsed_dimensions );

    return $styles;
}
add_filter( 'air_image_lazyload_div_styles', 'add_focal_point_to_div', 10, 2 );

/**
 * Get crop dimensions from image meta
 */
function get_crop_dimensions( $thumbnail_id ) {
  // Check if the crop is enabled on the thumbnail and get the dimensions
  $crop_dimensions = get_post_meta( $thumbnail_id, '_wpsmartcrop_enabled', true ) ? get_post_meta( $thumbnail_id, '_wpsmartcrop_image_focus', true ) : [];

  if ( empty( $crop_dimensions ) ) {
    return false;
  }

  // Add percentage to dimensions and reverse array (top comes first in array)
  $parsed_dimensions = array_map(
    function ( $dimension ) {
      return $dimension . '%';
    },
    array_reverse( $crop_dimensions )
  );
  return $parsed_dimensions;
}
