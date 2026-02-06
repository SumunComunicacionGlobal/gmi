<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" class="fixed-top" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-dark">

				<div class="navbar-logo-group">

					<span class="dots-navbar"><?php echo get_svg_dots(); ?></span>
					<!-- <img src="<?php echo get_stylesheet_directory_uri() ?>/img/dots-white.svg" class="dots-navbar" alt="Esquinero"> -->

					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<a href="<?php echo get_home_url(); ?>" class="navbar-brand custom-logo-link default-logo" rel="home">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo-gmi.svg" class="d-none d-md-inline-block img-fluid" alt="<?php bloginfo('name'); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo-gmi-movil.svg" class="d-md-none img-fluid" alt="<?php bloginfo('name'); ?>">
						</a> 

					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->

				</div>

				<div class="navbar-menu-group">

					<?php 

						echo get_telefono();

						menu_toggler(); 

					?>

				</div>

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->

	<?php if (!is_front_page()) { ?>

	<header class="wrapper cabecera bg-primary text-white">

		<div class="container">



				<div class="row">

					<div class="col-md-6">

						<?php 
						echo get_icono( get_queried_object() );
						if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
						  yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
						}
						if ( is_single() || is_page() ) {
							global $post;
							the_title( '<h1 class="entry-title">', '</h1>' );

							if ('post' == $post->post_type) { ?> 

								<div class="entry-meta">

									<?php understrap_posted_on(); ?>

								</div><!-- .entry-meta -->

							<?php }

							if ( $post->post_excerpt ) {
								wpautop( $post->post_excerpt );
							}
						} elseif( is_archive() ) {
							the_archive_title( '<h1 class="page-title">', '_</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						}

						?>

					</div>
					<div class="col-md-6 col-imagen-cabecera">

						<?php 
						$img_id = false;
						if (is_singular() || is_page() ) {
							$img_id = get_post_meta( get_the_ID(), 'imagen_cabecera_post', true );
						} elseif( is_tax() ) {
							$img_id = get_term_meta( get_queried_object()->term_id, 'imagen_cabecera', true );
						}
						if ($img_id) { 
							$img = wp_get_attachment_image( $img_id, 'medium_large' );
							
							echo '<div class="imagen-cabecera">';
								echo $img;
							echo '</div>';

						} ?>

					</div>

				</div>

		</div>

	</header>

	<?php } ?>
