<?php
/**
 * Module for upsell-choose-cpt.
 *
 * Module that enables choosing custom amount of CPT content to upsells.
 *
 * @package siteprefix
 */

$title = get_sub_field( 'title' );
$selected_upsells = get_sub_field( 'selected_upsells' );
$brokengrid = get_sub_field( 'brokengrid' );

// Bail if no content
if ( empty( $selected_upsells ) ) {
  return;
} ?>

<section class="block block-upsell-choose-cpt<?php if ( true === $brokengrid ) { echo ' block-brokengrid'; } ?>">
  <div class="container">

    <?php if ( ! empty( $title ) ) : ?>
      <h2><?php echo $title; ?></h2>
    <?php endif; ?>

    <div class="cols cols-<?php echo count( $selected_upsells ); ?>">

      <?php
        // Maximum of 5
        foreach ( $selected_upsells as $upsell ) :

        // Fields
        $short_description = get_field( 'short_description', $upsell->ID );
        ?>

        <div class="col">
          <a href="<?php echo get_permalink( $upsell ); ?>" class="global-link"><span class="screen-reader-text"><?php echo get_the_title( $upsell ); ?></span></a>

          <div class="image"<?php if ( has_post_thumbnail( $upsell ) ) : ?> style="background-image: url('<?php echo wp_get_attachment_url( get_post_meta( $upsell, 'upsell_image', true ) ); ?>');"<?php endif; ?>></div>

          <div class="content">
            <h2><?php echo get_the_title( $upsell ); ?></h2>

            <?php if ( ! empty( $short_description ) ) : ?>
              <p class="short-description"><?php echo $short_description; ?></p>
            <?php endif; ?>

            <p class="read-more-link"><a href="<?php echo get_permalink( $upsell ); ?>"><?php esc_html_e( 'Lue lisää', 'siteprefix' ); ?> &gt;</a></p>
          </div>
        </div>

      <?php endforeach; ?>

    </div>

  </div>
</section>
