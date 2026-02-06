<?php 
function contenido_pagina($atts) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
				'imagen'	=> 'no',
				'dominio'	=> false,

		), $atts)	
	);
	if ($dominio) {
		$api_url = $dominio . '/wp-json/wp/v2/pages/' . $id;
		$data = wp_remote_get( $api_url );
		$data_decode = json_decode( $data['body'] );

		// echo '<pre>'; print_r($data_decode); echo '</pre>';

		$content = $data_decode->content->rendered;
		return $content;
	} else {
		if ( 0 != $id) {
			$content_post = get_post($id);
			$content = $content_post->post_content;
			$content = '<div class="post-content-container">'.apply_filters('the_content', $content) .'</div>';
			if ('si' == $imagen) {
				$content = '<div class="entry-thumbnail">'.get_the_post_thumbnail($id, 'full') . '</div>' . $content;
			}
			return $content;
		}
	}
}
add_shortcode('contenido_pagina','contenido_pagina');

function home_url_shortcode() {
	return get_home_url();
}
add_shortcode('home_url','home_url_shortcode');

function theme_url_shortcode() {
	return get_stylesheet_directory_uri();
}
add_shortcode('theme_url','theme_url_shortcode');

function uploads_url_shortcode() {
	$upload_dir = wp_upload_dir();
	$uploads_url = $upload_dir['baseurl'];
	return $uploads_url;
}
add_shortcode('uploads_url','uploads_url_shortcode');

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

function term_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_term_link( $id );
}
add_shortcode('cat_link', 'term_link_sh');

function post_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_the_permalink( $id );
}
add_shortcode('post_link', 'post_link_sh');

// Link Sumun
function link_sumun( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'texto' => 'Diseño web: Sumun.net',
			'url'	=> 'https://sumun.net',
		), $atts )
	);

    $link = '<a href="'.$url.'" target="_blank">'.$texto.'</a>';
    if (is_front_page()) {
        return $link;
    }
    return $texto;
}
add_shortcode( 'link_sumun', 'link_sumun' );

function paginas_hijas() {
	global $post;
	if ( is_post_type_hierarchical( $post->post_type ) /*&& '' == $post->post_content */) {
		$args = array(
			'post_type'			=> array($post->post_type),
			'posts_per_page'	=> -1,
			'post_status'		=> 'publish',
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'post_parent'		=> $post->ID,
		);
		$r = '';
		$query = new WP_Query($args);
		if ($query->have_posts() ) {
			$r .= '<div class="contenido-adicional">';
			// $r .= '<h3>'.__( 'Contenido en', 'sumun' ).' "'.$post->post_title.'"</h3>';
			// $r .= '<ul>';
			while($query->have_posts() ) {
				$query->the_post();
				// $r .= '<li>';
					$r .= '<a class="btn btn-primary btn-lg mr-2 mb-2 pagina-hija" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
				$r .= '</li>';
			}
			// $r .= '</ul>';
			// $r .= '</div>';
		} elseif(0 != $post->post_parent) {
			wp_reset_postdata();
			$current_post_id = get_the_ID();
			$args['post_parent'] = $post->post_parent;
			$query = new WP_Query($args);
			if ($query->have_posts() && $query->found_posts > 1 ) {
				$r .= '<div class="contenido-adicional">';
				while($query->have_posts() ) {
					$query->the_post();
					if ($current_post_id == get_the_ID()) {
						$r .= '<span class="btn btn-primary btn-sm mr-2 mb-2">'.get_the_title().'</span>';
					} else {
						$r .= '<a class="btn btn-outline-primary btn-sm mr-2 mb-2" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
					}
				}
				$r .= '</div>';
			}
		}
		wp_reset_postdata();
		return $r;
	}
}
add_shortcode( 'paginas_hijas', 'paginas_hijas' );

add_filter('the_content', 'mostrar_paginas_hijas', 100);
function mostrar_paginas_hijas($content) {
	global $post;
	if (is_admin() || !is_singular() || !in_the_loop() || is_front_page() ) return $content;
	global $post;
	if (has_shortcode( $post->post_content, 'paginas_hijas' )) return $content;

	return $content . paginas_hijas();

}

function get_redes_sociales() {

	$r = '';
	
    $redes_sociales = array(
        'email' => 'envelope',
        'whatsapp' => 'whatsapp',
        'linkedin' => 'linkedin',
        'twitter' => 'twitter',
        'facebook' => 'facebook',
        'instagram' => 'instagram',
        'youtube' => 'youtube',
        'skype' => 'skype',
        'pinterest' => 'pinterest',
        'flickr' => 'flickr',
        'blog' => 'rss',
    );
    $r .= '<div class="redes-sociales">';

    foreach ($redes_sociales as $red => $fa_class) {
    	$url = get_theme_mod( $red, '' );
    	if( '' != $url) {
	    	$r .= '<a href="'.$url.'" target="_blank" rel="nofollow" title="'.sprintf( __( 'Abrir %s en otra pestaña', 'sumun' ), $red ).'"><span class="red-social '.$red.' fa fa-'.$fa_class.'"></span></a>';
    	}
    }

    // $r .= '<span class="follow-us">' . __( 'Follow us', 'sumun' ) . '</span>';

    $r .= '</div>';

    return $r;

}
add_shortcode( 'redes_sociales', 'get_redes_sociales' );

function get_info_basica_privacidad() {

	$r = '';
	
	$text = get_theme_mod( 'info_privacidad_formularios', '' );
	if( '' != $text) {
		$r .= '<div class="info-basica-privacidad">';
	    	$r .= wpautop( $text );
		$r .= '</div>';
	}

    return $r;

}
add_shortcode( 'info_basica_privacidad', 'get_info_basica_privacidad' );

function sitemap() {
	$pt_args = array(
		'has_archive'		=> true,
	);
	$pts = get_post_types( $pt_args );
	// if (isset($pts['rl_gallery'])) unset $pts['rl_gallery'];
	$pts = array_merge( array('page'), $pts, array('post') );
	$r = '';

	foreach ($pts as $pt) {
		$pto = get_post_type_object( $pt );
		$taxonomies = get_object_taxonomies( $pt );

		$posts_args = array(
				'post_type'			=> $pt,
				'posts_per_page'	=> -1,
				'orderby'			=> 'menu_order',
				'order'				=> 'asc',
		);

		$posts_q = new WP_Query($posts_args);
		if ($posts_q->have_posts()) {

			$r .= '<h3 class="mt-3">'.$pto->labels->name.'</h3>';
			if ($taxonomies) {
				foreach ($taxonomies as $tax) {
					$terms = get_terms( array('taxonomy' => $tax) );
					foreach ($terms as $term) {
						$r .= '<a href="'.get_term_link( $term ).'" class="btn btn-dark btn-sm mr-1 mb-1">'.$term->name.'</a>';
					}
				}
			}

			while ($posts_q->have_posts()) { $posts_q->the_post();
				$r .= '<a href="'.get_the_permalink().'" class="btn btn-outline-primary btn-sm mr-1 mb-1">'.get_the_title().'</a>';
			}
		}

		wp_reset_postdata();
	}

	return $r;
}
add_shortcode( 'sitemap', 'sitemap' );

function testimonios() {
	ob_start();
	get_template_part( 'global-templates/carousel-testimonios' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'testimonios', 'testimonios' );

function get_telefono() {

	$telefono = get_theme_mod( 'telefono', false );
	if ( $telefono ) {
		$telefono_link = str_replace(' ', '', $telefono);
		$telefono_link = 'tel:0034' . $telefono_link;


		return '<a class="telefono" href="'.$telefono_link.'"><span class="img-telefono mr-3">'.get_svg_phone().'</span>'.$telefono.'</a>';

	}

	return false;

}
add_shortcode('telefono', 'get_telefono');

function carrusel_sectores( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'taxonomy' => 'sector',
			'carrusel' => true,
			'page_id'	=> 26,
		), $atts )
	);

	if ($page_id) {

		$terms = get_posts( array(
			'post_type'			=> 'page',
			'post_parent'		=> $page_id,
			'posts_per_page'	=> -1,
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
		) );

	} else {

		$terms = get_terms( array(
			'taxonomy'		=> $taxonomy,
			'hide_empty'	=> false,
		) );

	}

	$carrusel = ($carrusel === true ) ? true : false;

	$r = '';

	if ($terms) {

		if ( $carrusel ) {
			$r .= '<div class="slick-terms">';
		} else {
			$r .= '<div class="row">';
		}
		$i = 0;

		foreach ($terms as $term) {
			$i++;

			// $icono = get_term_meta( $term->term_id, 'icono_svg', true );
			// if (!$icono) {
			// 	$icono_id = get_term_meta( $term->term_id, 'icono_img', true );
			// 	$icono = wp_get_attachment_image( $icono_id, 'medium' );
			// }
			$icono = get_icono($term);
			if($page_id) {
				$titulo = get_the_title( $term );
				$link = get_the_permalink( $term->ID );
			} else {
				$titulo = $term->name;
				$link = get_term_link( $term );
			}

			if ( $carrusel ) {
				$r .= '<div class="slick-item">';
			} else {
				$r .= '<div class="col-sm-6">';
			}
				$r .= '<p class="numero-carrusel">'.sprintf('%02d', $i).'</p>';
				$r .= '<a class="term-block" href="'.$link.'">';
					$r .= '<div class="term-block-icon">';
						$r .= $icono;
					$r .= '</div>';
					$r .= '<h2 class="term-block-title">_' . $titulo . '_</h2>';
					$r .= '<div class="term-block-footer">';
					// $r .= '<img class="dots-carrusel" src="'.get_stylesheet_directory_uri().'/img/dots-white.svg" alt="Esquinero" width="75" height="75" />';
						$r .= '<div class="dots dots-carrusel">' . get_svg_dots() . '</div>';
					$r .= '</div>';
				$r .= '</a>';
			$r .= '</div>';
		}

		$r .= '</div>';
	}
	ob_start();
	?>

	<script>
		jQuery('.slick-terms').slick({
		  dots: false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 4,
		  slidesToScroll: 4,
		  responsive: [
		    {
		      breakpoint: 992,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		      }
		    },
		    {
		      breakpoint: 720,
		      settings: {
				centerMode: true,
				centerPadding: '60px',
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
		});
	</script>

	<?php
	$r .= ob_get_clean();

    return $r;
}
add_shortcode( 'carrusel_sectores', 'carrusel_sectores' );

add_shortcode( 'proyectos_realizados', 'proyectos_realizados_shortcode' );
function proyectos_realizados_shortcode() {

	$r = '';

	// Get all pages with proyectos_realizados meta
	$pages_with_projects = get_posts(array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'proyectos_realizados',
				'compare' => 'EXISTS'
			)
		)
	));

	foreach ($pages_with_projects as $page) {
		$img_ids = get_field('proyectos_realizados', $page->ID);
		if ($img_ids) {
			$title = sprintf( __( 'Proyectos realizados en %s', 'sumun' ), $page->post_title );
			$r .= '<div class="proyectos-realizados-type mb-5">';
				$r .= '<h2>' . $title . '</h2>';
				$r .= smn_generate_gallery_block_from_ids($img_ids);
			$r .= '</div>';
		}
	}
	
	// Get all product types (assuming 'producto' is the post type)
	$product_types = get_terms(array(
		'taxonomy' => 'tipo', // adjust taxonomy name as needed
	));


	foreach ($product_types as $type) {
		// Get products for this type
		$products = get_posts(array(
			'post_type' => 'producto', // adjust post type as needed
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => $type->taxonomy,
					'field'    => 'term_id',
					'terms'    => $type->term_id,
				),
			),
			'meta_query' => array(
				array(
					'key' => 'proyectos_realizados',
					'compare' => 'EXISTS'
				)
			)
		));

		$p = '';

		foreach ($products as $product) {
			$img_ids = get_field('proyectos_realizados', $product);
			if ($img_ids) {
				$p .= '<div class="proyectos-realizados mb-5">';
					$p .= '<h3>' . $product->post_title . '</h3>';
					$p .= smn_generate_gallery_block_from_ids($img_ids);
				$p .= '</div>';
			}
		}

		if ($p) {
			$r .= '<div class="proyectos-realizados-type">';
				$title = sprintf( __( 'Proyectos de %s', 'sumun' ), $type->name );
				$r .= '<h2>' . $title . '</h2>';
				$r .= $p;
			$r .= '</div>';
		}

	}

	return $r;

}


