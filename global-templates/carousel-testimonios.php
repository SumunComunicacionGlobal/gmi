<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

	$post_type = 'testimonio';

	$args = array(
				'post_type'			=> $post_type,
				'post_status'		=> array('publish', 'pending'),
				'posts_per_page'	=> -1,
				'orderby'			=> 'rand',
	);



	$query = new WP_Query($args);
	if ($query->have_posts()) {


		echo '<div id="carousel-testimonios" class="carousel slide bg-light" data-ride="carousel">';
			echo get_marcas_corte_registro();
			
			echo '<div class="carousel-inner">';
				$indicators = '';
				while ($query->have_posts()) { $query->the_post();
					global $post;
					$active_class = '';
					if( $query->current_post == 0 ) {
						$active_class = 'active';
					}
					$bg_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$indicators .= '<li data-target="#carousel-testimonios" data-slide-to="'.$query->current_post.'" class="'.$active_class.' bg-light ">';

					$numero = sprintf('%02d', $query->current_post + 1);
					$pto = get_post_type_object( $post_type );

					echo '<div class="carousel-item testimonio '.$active_class.'">';

						// get_template_part( 'loop-templates/content', 'testimonio' );
						
						echo '<div class="carousel-item-inner bg-cover d-flex align-items-center" style="background-image:url('.$bg_url.')">';

							echo '<div class="container">';

								// echo '<div class="testimonio-content-wrapper">';
								echo '<div class="row flex-sm-row-reverse align-items-center">';

									echo '<div class="col-sm-6 col-md-8">';

										$logo_id = get_post_meta( get_the_ID(), 'logo', true );
										if( $logo_id ) {
											echo wp_get_attachment_image( $logo_id, 'medium_large', false, array('class' => 'p-5 mx-auto d-block') );
										}

									echo '</div>'; // .col

									echo '<div class="col-sm-6 col-md-4">';

										echo '<div class="numero-slide mb-3">'.$numero.'</div>';
										echo '<div class="post-type-name mb-5">'.$pto->labels->name.'</div>';
										echo '<div class="h1 nombre-testimonio">'.get_the_title().'</div>';
										echo '<div class="contenido-testimonio mb-3">"' .$post->post_excerpt. '"</div>';
										echo '<div class="cargo">'.get_post_meta( $post->ID, 'cargo', true ).'</div>';
										if( $post->post_status == 'publish' ) {
											echo '<a class="btn btn-cut btn-outline-secondary mt-5" href="'.get_the_permalink().'" title="">'.__( 'Conoce la historia', 'gmi' ).'</a>';
										}

									echo '</div>'; // .col

								echo '</div>'; // .row
								// echo '</div>'; // .testimonio-content-wrapper

							echo '</div>'; // .container

						echo '</div>'; // .container

					echo '</div>'; // .carousel-item
				}
			echo '</div>'; // .carousel-inner


			if ( $query->found_posts > 1 ) {
				// echo '<ol class="carousel-indicators">';
				// 	echo $indicators;
				// echo '</ol>';
				?>
				<div class="gmi-carousel-control">
					<div class="container">
						<a class="gmi-carousel-control-prev" href="#carousel-testimonios" role="button" data-slide="prev">
						    <span class="gmi-carousel-control-prev-icon" aria-hidden="true"><?php echo get_svg_flecha_derecha(); ?></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="gmi-carousel-control-next" href="#carousel-testimonios" role="button" data-slide="next">
						    <span class="gmi-carousel-control-next-icon" aria-hidden="true"><?php echo get_svg_flecha_derecha(); ?></span>
						    <span class="sr-only">Next</span>
						  </a>
					</div>
				</div>

			<?php }

		echo '</div>'; // .carousel

		}
	wp_reset_postdata();
