<?php
/**
 * Module for title and text
 *
 * @package ctsengtec
 */

$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
$width = get_sub_field( 'width' );
$bg_color = get_sub_field( 'bg_color' );
$aligntext = get_sub_field( 'aligntext' );

// Bail if no content
if ( empty( $text ) ) {
  return;
} ?>

<section class="block block-title-and-text has-<?php echo $bg_color; ?>-bg-color is-aligned-<?php echo $aligntext; ?>">
  <div class="container">
    <?php if ( ! empty( $title ) ) : ?>
      <h2 class="block-title"><?php echo esc_attr( $title ); ?></h2>
    <?php endif; ?>

    <?php if ( ! empty( $text ) ) : ?>
      <div class="content" style="max-width: <?php echo $width; ?>rem;">
        <?php echo $text; // WPCS: XSS ok. ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php wp_reset_postdata();
