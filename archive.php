<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$post_type = get_post_type();
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<?php if ('producto' == $post_type) echo '<div class="row">'; ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							if ( 'post' == $post_type ) {
								get_template_part( 'loop-templates/content', get_post_format() );
							} else {
								get_template_part( 'loop-templates/content', $post_type );
							}
							?>

						<?php endwhile; ?>

						<?php if ( is_tax() ) {
							get_template_part( 'global-templates/content-fragments', '', array('post_ids' => get_term_meta( get_queried_object_id(), 'bottom_fragments', true ) ) );
						} ?>

					<?php if ('producto' == $post_type) echo '</div>';
					
					echo smn_get_proyectos_realizados();
					
					if ('producto' == $post_type) {
						if (is_active_sidebar( 'mas-info-productos' )) {
							echo '<div class="row">';
								echo '<div class="col-md-6 offset-md-6 bg-primary text-white mas-info-productos">';
									echo get_svg_emoji();
									dynamic_sidebar( 'mas-info-productos' );
								echo '</div>';
							echo '</div>';
						}
					} ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

	</div><!-- #archive-wrapper -->

<?php get_footer(); ?>
