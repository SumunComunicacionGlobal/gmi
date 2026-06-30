<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'mb-5 col-md-6 col-lg-4' ); ?> id="post-<?php the_ID(); ?>">

	<div class="card h-100 position-relative rounded-lg">

		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
				<?php echo get_the_post_thumbnail( $post->ID, 'medium', array( 'class' => 'card-img-top' ) ); ?>
			</a>
		<?php endif; ?>

		<div class="card-body">

			<header class="entry-header">

				<?php
				the_title(
					sprintf( '<h2 class="entry-title h3"><a class="stretched-link" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h2>'
				);
				?>

				<?php if ( 'post' == get_post_type() ) : ?>

					<div class="entry-meta">
						<?php understrap_posted_on(); ?>
					</div><!-- .entry-meta -->

				<?php endif; ?>

			</header><!-- .entry-header -->

			<div class="entry-content card-text">

				<?php the_excerpt(); ?>

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
		</div>

	</div>

</article><!-- #post-## -->
