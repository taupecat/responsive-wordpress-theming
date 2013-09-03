<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Manning
 */

get_header(); ?>

<?php
if ( is_front_page() && is_active_sidebar( 'sidebar-secondary' ) ) {
	get_sidebar( 'right' );
}
?>

<?php
/**
 * Check to see if the secondary sidebar is active (that is, has any active widgets)
 * AND we're on the home page.  If both of those conditions are true, set a class
 * on our main content area (and also on in our left sidebar) to change the 
 * proportions to what they would be on sub pages (which never have a right sidebar)
 * in the wide view.
 */

if ( is_front_page() && ! is_active_sidebar( 'sidebar-secondary' ) ) {
	$main_content_area_class = 'content-area no-secondary-sidebar';
} else {
	$main_content_area_class = 'content-area';
}
?>

	<div id="primary" class="<?php echo $main_content_area_class; ?>">

		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main>
		<!-- #main -->

	</div>
	<!-- #primary -->

<?php get_sidebar('left'); ?>

<?php get_footer(); ?>
