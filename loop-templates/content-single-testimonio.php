<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="pastilla-cabecera-testimonio mb-5">
		
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

		<div class="contenido-pastilla">

			<?php 
			echo '<div class="h3">"'.$post->post_excerpt.'"</div>';
			$cargo = get_post_meta( get_the_ID(), 'cargo', true );
			$nombre = get_the_title();
			if ($cargo) $nombre .= ' | ' . $cargo;
			echo '<div class="cargo">' . $nombre . '</div>';
			?>


		</div>
	
	</div>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
