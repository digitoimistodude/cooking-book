<?php
/**
 * Module for infographic numbers.
 *
 * Module that shows some informative numbers in columns.
 *
 * @package yourproject
 */

$numbers = get_sub_field( 'numbers' );

// Bail if no content
if ( empty( $numbers ) ) {
  return;
} ?>

<section class="block block-numbers">
  <div class="container">

    <div class="cols cols-<?php echo count( $numbers ); ?>">

      <?php
        // Maximum of 5
        foreach ( $numbers as $number ) :
        ?>

        <?php if ( ! empty( $number['number'] ) && ! empty( $number['number_description'] ) ) : ?>
          <div class="col">
            <p>
              <span class="number"><?php echo $number['number']; ?></span>
              <span class="number-description"><?php echo $number['number_description']; ?></span>
            </p>
          </div>
        <?php endif; ?>

      <?php endforeach; ?>

    </div>

  </div>
</section>
