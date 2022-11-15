<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package X_Bliss
 */

?><?php
	/**
	 * Hook - x_bliss_action_doctype.
	 *
	 * @hooked x_bliss_doctype -  10
	 */
	do_action( 'x_bliss_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - x_bliss_action_head.
	 *
	 * @hooked x_bliss_head -  10
	 */
	do_action( 'x_bliss_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<?php do_action( 'wp_body_open' ); ?>

	<?php
	/**
	 * Hook - x_bliss_action_before.
	 *
	 * @hooked x_bliss_header_top_content - 5
	 * @hooked x_bliss_page_start - 10
	 * @hooked x_bliss_skip_to_content - 15
	 */
	do_action( 'x_bliss_action_before' );
	?>

    <?php
	  /**
	   * Hook - x_bliss_action_before_header.
	   *
	   * @hooked x_bliss_header_start - 10
	   */
	  do_action( 'x_bliss_action_before_header' );
	?>
		<?php
		/**
		 * Hook - x_bliss_action_header.
		 *
		 * @hooked x_bliss_site_branding - 10
		 */
		do_action( 'x_bliss_action_header' );
		?>
	<?php
	  /**
	   * Hook - x_bliss_action_after_header.
	   *
	   * @hooked x_bliss_header_end - 10
	   */
	  do_action( 'x_bliss_action_after_header' );
	?>

	<?php
	/**
	 * Hook - x_bliss_action_before_content.
	 *
	 * @hooked x_bliss_content_start - 10
	 */
	do_action( 'x_bliss_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - x_bliss_action_content.
	   */
	  do_action( 'x_bliss_action_content' );
	?>
