<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteprefix
 */

// Fields
$text_area = get_field( 'text_area', 'option' );
$facebook_link = get_field( 'facebook_link', 'option' );
$twitter_link = get_field( 'twitter_link', 'option' );
$instagram_link = get_field( 'instagram_link', 'option' );
$youtube_link = get_field( 'youtube_link', 'option' );

if ( ! empty( get_field( 'button_footer', 'option' ) ) ) :
  $button_footer = get_field( 'button_footer', 'option' );
  $button_footer_url = $button_footer['url'];
  $button_footer_target = $button_footer['target'];
  $button_footer_title = $button_footer['title'];
endif;
?>

  </div><!-- #content -->

  <footer role="contentinfo" id="colophon" class="site-footer">

    <div class="container">
      <div class="contact-information">
        <?php if ( ! empty( $text_area ) ) :
          echo wpautop( $text_area );
        endif; ?>

        <?php if ( ! empty( $button_footer_url ) ) : ?>
          <p class="button-wrapper"><a class="button button-ghost" href="<?php echo $button_footer_url; ?>" target="<?php echo $button_footer_target; ?>"><?php echo $button_footer_title; ?></a></p>
        <?php endif; ?>
      </div>

      <?php if ( ! empty( $facebook_link ) || ! empty( $twitter_link ) || ! empty( $instagram_link ) || ! empty( $youtube_link ) ) : ?>
        <ul class="social-media">
          <?php if ( ! empty( $facebook_link ) ) : ?><li><a href="<?php echo $facebook_link; ?>"><?php include get_theme_file_path( '/svg/facebook.svg' ); ?></a></li><?php endif; ?>
          <?php if ( ! empty( $twitter_link ) ) : ?><li><a href="<?php echo $twitter_link; ?>"><?php include get_theme_file_path( '/svg/twitter.svg' ); ?></a></li><?php endif; ?>
          <?php if ( ! empty( $instagram_link ) ) : ?><li><a href="<?php echo $instagram_link; ?>"><?php include get_theme_file_path( '/svg/instagram.svg' ); ?></a></li><?php endif; ?>
          <?php if ( ! empty( $youtube_link ) ) : ?><li><a href="<?php echo $youtube_link; ?>"><?php include get_theme_file_path( '/svg/youtube.svg' ); ?></a></li><?php endif; ?>
        </ul>
      <?php endif; ?>
    </div>

  </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
