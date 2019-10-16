<?php
/**
 * Default hero template file.
 *
 * This is the default hero image for page templates, called
 * 'block'. Strictly air specific.
 *
 * @package siteprefix
 */

// Block settings
if ( is_front_page() ) {
  $block_class = ' block-front';
} else {
  $block_class = ' block-' . get_post_type();
}

// Featured image
if ( has_post_thumbnail() ) {
  $featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}

// Fields
$hero_description = get_field( 'description' );
$hero_alignment = get_field( 'hero_alignment' );
$hero_style = get_field( 'hero_style' );

if ( get_field( 'button' ) ) {
  $button = get_field( 'button' );
  $button_url = $button['url'];
  $button_target = $button['target'];
  $button_title = $button['title'];
}

if ( ! empty( get_field( 'title' ) ) ) {
  $hero_title = get_field( 'title' );
} else {
  $hero_title = get_the_title();
}
?>

<section class="block block-hero <?php echo $hero_style . ' '; echo $hero_alignment; echo esc_attr( $block_class ); ?>"<?php if ( has_post_thumbnail() ) : ?> style="background-image: url('<?php echo esc_url( $featured_image ); ?>');"<?php endif; ?>>

  <div class="container">
    <div class="content">
      <?php if ( ! empty( $hero_title ) ) : ?>
        <h1><?php echo esc_attr( $hero_title ); ?></h1>
      <?php endif; ?>

      <?php if ( ! empty( $hero_description ) ) {
        echo wpautop( $hero_description );
      } ?>

      <?php if ( ! empty( $button ) ) : ?>
        <p class="button-wrapper"><a class="button button-ghost" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>"><?php echo $button_title; ?></a></p>
      <?php endif; ?>
    </div>
  </div>
</section>
