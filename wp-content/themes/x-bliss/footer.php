<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package X_Bliss
 */

	/**
	 * Hook - x_bliss_action_after_content.
	 *
	 * @hooked x_bliss_content_end - 10
	 */
	do_action( 'x_bliss_action_after_content' );
?>

	<?php
	/**
	 * Hook - x_bliss_action_before_footer.
	 *
	 * @hooked x_bliss_footer_start - 10
	 */
	do_action( 'x_bliss_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - x_bliss_action_footer.
	   *
	   * @hooked x_bliss_footer_copyright - 10
	   */
	  do_action( 'x_bliss_action_footer' );
	?>
	<?php
	/**
	 * Hook - x_bliss_action_after_footer.
	 *
	 * @hooked x_bliss_footer_end - 10
	 */
	do_action( 'x_bliss_action_after_footer' );
	?>

<?php
	/**
	 * Hook - x_bliss_action_after.
	 *
	 * @hooked x_bliss_page_end - 10
	 * @hooked x_bliss_footer_goto_top - 20
	 */
	do_action( 'x_bliss_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
