<?php
/**
 * Module for upsell-choose-cpt.
 *
 * Module that enables choosing custom amount of CPT content to upsells.
 *
 * @package yourproject
 */

$title = get_sub_field( 'title' );
$selected_upsells = get_sub_field( 'selected_upsells' );

// Bail if no content
if ( empty( $selected_upsells ) ) {
  return;
} ?>

<section class="block block-upsell-choose-cpt">

  <div class="container">

    <?php if ( ! empty( $title ) ) : ?>
      <h2><?php echo $title; ?></h2>
    <?php endif; ?>

    <div class="cols cols-<?php echo count( $selected_upsells ); ?>">

      <?php
        // Maximum of 5
        foreach ( $selected_upsells as $upsell ) : ?>

        <div class="col">
          <a href="<?php echo get_permalink( $upsell ); ?>" class="global-link"><span class="screen-reader-text"><?php echo get_the_title( $upsell ); ?></span></a>

          <div class="image"<?php if ( has_post_thumbnail( $upsell ) ) : ?> style="background-image: url('<?php echo wp_get_attachment_url( get_post_meta( $upsell, 'upsell_image', true ) ); ?>');"<?php endif; ?>></div>

          <h2><?php echo get_the_title( $upsell ); ?></h2>

          <p class="read-more-link"><a href="<?php echo get_permalink( $upsell ); ?>"><?php esc_html_e( 'Lue lisää', 'yourproject' ); ?> &gt;</a></p>
        </div>

      <?php endforeach; ?>

    </div>

  </div>

</section>
