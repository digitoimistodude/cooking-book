<?php if ( have_rows( 'repeater' ) ) :
  while( have_rows( 'repeater' ) ) : the_row();

    // Fields
    $repeater_image = get_sub_field( 'repeater_image' );
    $repeater_title = get_sub_field( 'repeater_title' )

    if ( ! empty( $repeater_title ) ) : ?>
      <h2><?php echo $repeater_title; ?></h2>
    <?php endif;
    if ( ! empty( $repeater_image ) ) : ?>
      <img src="<?php echo $repeater_image['sizes'][ 'large' ]; ?>" alt="<?php echo $repeater_title; ?>" />
    <?php endif;
  endwhile;
endif;
