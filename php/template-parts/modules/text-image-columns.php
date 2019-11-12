<?php
/**
 * Module for text + image columns.
 *
 * Module that shows text on the other side and image on the other.
 *
 * @package siteprefix
 */

$title = get_sub_field( 'title' );
$col_text = get_sub_field( 'text' );
$col_image = get_sub_field( 'image' );
$order = get_sub_field( 'order' );

// Bail if no content
if ( empty( $col_text ) ) {
  return;
} ?>

<section class="block block-text-image-columns">
  <div class="container">

    <div class="cols cols-2 cols-<?php echo $order; ?>">

      <?php if ( ! empty( $col_text ) ) : ?>
        <div class="col col-text">
          <h2><?php echo $title; ?></h2>
          <?php echo wpautop( $col_text ); ?>
        </div>
      <?php endif; ?>

      <?php if ( ! empty( $col_image ) ) : ?>
        <div class="col col-image">
          <div class="image" style="background-image: url('<?php echo $col_image['url']; ?>')"></div>
        </div>
      <?php endif; ?>

    </div>

  </div>
</section>
