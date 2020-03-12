<?php if( get_theme_mod( 'about_display_option', true ) ) : ?>
  <?php 
    $about_ID = absint( get_theme_mod( 'about_page' ) );
    $post = get_post( $about_ID );
    setup_postdata( $post );
  ?>
<?php $about_image = wp_get_attachment_image_src( get_post_thumbnail_id( $about_ID ), 'medium' ); ?>

<?php wp_reset_postdata(); endif;