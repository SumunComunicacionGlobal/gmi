<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<div class="entry-header-inner">

			<?php
			echo get_svg_dots();
			the_title(
				sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h2>'
			);
			?>

		</div>


	</header><!-- .entry-header -->

	<?php galeria_producto_images(); ?>

	<div class="entry-content">

		<div class="row">

			<div class="col-lg-6 col-xl-5 mb-3">

				<div class="entry-meta">
					<?php galeria_producto_controls(); ?>
				</div><!-- .entry-meta -->

			</div>

			<div class="col-lg-6 col-xl-7 mb-3 excerpt-producto">

				<?php echo wpautop( $post->post_excerpt ); ?>

				<?php understrap_entry_footer(); ?>

			</div>

		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<a href="<?php the_permalink(); ?>"><?php _e( 'Ver ejemplos', 'gmi' ); ?>:</a>

		<?php $gallery_ids = get_gallery_ids();
		if($gallery_ids) {
			echo '<div class="entry-footer-iconos">';

				foreach ($gallery_ids as $img_id) {
					echo wp_get_attachment_image( $img_id, array(48,48), false, array('class' => 'rounded-circle ml-2 border') );
				}
			echo '</div>';
		} ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
