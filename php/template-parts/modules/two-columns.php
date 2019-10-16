<?php
/**
 * Module for two columns.
 *
 * Module that adds two columns.
 *
 * @package siteprefix
 */

// Fields
$title = get_sub_field( 'title' );
$col_1 = get_sub_field( 'col_1' );
$col_2 = get_sub_field( 'col_2' );

if ( get_sub_field( 'button' ) ) {
  $button = get_sub_field( 'button' );
  $button_url = $button['url'];
  $button_target = $button['target'];
  $button_title = $button['title'];
}

// Bail if no content
if ( empty( $col_1 ) && empty( $col_2 ) ) {
  return;
} ?>

<section class="block block-two-columns">
  <div class="container">

    <?php if ( ! empty( $title ) ) : ?>
      <h2 class="block-title"><?php echo $title; ?></h2>
    <?php endif; ?>

    <div class="cols cols-<?php if ( ! empty( $col_2 ) ) { echo '2'; } else { echo '1'; } ?>">

      <?php if ( ! empty( $col_1 ) ) : ?>
        <div class="col col-1">
          <?php echo $col_1; ?>
        </div>
      <?php endif; ?>

      <?php if ( ! empty( $col_2 ) ) : ?>
        <div class="col col-2">
          <?php echo $col_2; ?>
        </div>
      <?php endif; ?>

    </div>

    <?php if ( ! empty( $button ) ) : ?>
      <p class="button-wrapper"><a class="button button-ghost" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>"><?php echo $button_title; ?></a></p>
    <?php endif; ?>

  </div>
</section>
