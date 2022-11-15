<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package X_Bliss
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
	  /**
	   * Hook - x_bliss_single_image.
	   *
	   * @hooked x_bliss_add_image_in_single_display - 10
	   */
	  do_action( 'x_bliss_single_image' );
	?>


	<div class="entry-content-wrapper">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php x_bliss_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'x-bliss' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php x_bliss_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-content-wrapper -->
</article><!-- #post-## -->
