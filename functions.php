<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$content_width = 1140;
add_theme_support('editor-styles');
add_filter( 'widget_text', 'do_shortcode');
add_filter( 'wpcf7_form_elements', 'do_shortcode' );
function understrap_wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}

add_action( 'after_setup_theme', 'editor_color_palette' );
function editor_color_palette() {
    add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => __( 'Primary #002AFF', 'sumun-admin' ),
                'slug'  => 'primary',
                'color' => '#002AFF',
            ),
            array(
                'name'  => __( 'Secondary #003DA6', 'sumun-admin' ),
                'slug'  => 'secondary',
                'color' => '#003DA6',
            ),
            array(
                'name'  => __( 'Dark #1C1E29', 'sumun-admin' ),
                'slug'  => 'dark',
                'color' => '#1C1E29',
            ),
            array(
                'name'  => __( 'Light #dadada', 'sumun-admin' ),
                'slug'  => 'light',
                'color' => '#dadada',
            ),
            array(
                'name'  => __( 'Light gray #f1f1f1', 'sumun-admin' ),
                'slug'  => 'light-gray',
                'color' => '#f1f1f1',
            ),
            array(
                'name'  => __( 'White #ffffff', 'sumun-admin' ),
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => __( 'Black #000000', 'sumun-admin' ),
                'slug'  => 'black',
                'color' => '#000000',
            ),

        )
    );
}

$sumun_includes = array(
    '/post-types.php',
    '/shortcodes.php',
    '/customizer-sumun.php',
    // '/gdpr-cookies.php',
    '/widgets-sumun.php',
    // '/blocks-sumun.php',
    // '/dummy-content.php',
    '/svg-sumun.php',
    '/seo.php',
    '/smn-acf.php'
);

foreach ( $sumun_includes as $file ) {
    $filepath = locate_template( 'inc' . $file );
    if ( ! $filepath ) {
        trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
    }
    require_once $filepath;
}

function sumun_after_setup_theme(){
    add_theme_support( 'align-full' );
    add_theme_support( 'align-wide' );

    register_nav_menus( array(
        // 'legal' => __( 'Páginas legales', 'sumun-admin' ),
        // 'account'  => __( 'Páginas de usuario', 'sumun-admin' ),
        // 'movil'  => __( 'Menú móvil', 'sumun-admin' ),
    ) );
}
add_action( 'after_setup_theme', 'sumun_after_setup_theme' );


function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    // Get the theme data
    $the_theme = wp_get_theme();

    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap' );

    // wp_enqueue_script( 'sticky-sidebar', get_stylesheet_directory_uri() . '/js/jquery.sticky-sidebar.min.js', array(), false, true );
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.css' );
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/js/slick/slick-theme.css' );

    wp_enqueue_style( 'sumun-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', null, null, false );
    wp_enqueue_script( 'sumun-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }


}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

function author_page_redirect() {
    if ( is_author() ) {
        wp_redirect( home_url() );
    }
}
add_action( 'template_redirect', 'author_page_redirect' );

function es_blog() {

    if( is_singular('post') || is_category() || is_tag() || ( is_home() && !is_front_page() ) ) {
        return true;
    }

    return false;
}

add_filter( 'theme_mod_understrap_sidebar_position', 'cargar_sidebar');
function cargar_sidebar( $valor ) {
    global $wp_query;
    if ( es_blog() ) {
        $valor = 'right';
    }
    return $valor;
}

function understrap_all_excerpts_get_more_link( $post_excerpt ) {
    if ( ! is_admin() ) {
        global $post;
        if ('' != $post_excerpt) $post_excerpt .= '...';
        // $post_excerpt .= '<p><a class="read-more" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Leer más', 'sumun' ) . '</a></p>';
        $post_excerpt .= '<p class="mt-4"><a class="btn btn-cut btn-outline-primary" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Leer más', 'sumun' ) . '</a></p>';
    }
    return $post_excerpt;
}

function custom_excerpt_length( $length ) {
     return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function understrap_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
    echo $time_string; // WPCS: XSS OK.
}

function prefix_category_title( $title ) {
    if ( is_tax() || is_category() || is_tag() ) {
        $title = single_term_title( '', false );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'prefix_category_title' );

add_filter( 'body_class', 'clases_body' );
function clases_body( $classes ) {
    if (!is_singular()) return $classes;
    $contenedor_estrecho = get_post_meta( get_the_ID(), 'contenedor_estrecho', true );
    if (1 == $contenedor_estrecho) {
        $classes[] = 'contenedor-estrecho';
    }
    return $classes;
}

function understrap_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
        if ( $categories_list && understrap_categorized_blog() ) {
            /* translators: %s: Categories of current post */
            printf( '<span class="cat-links">' . esc_html__( '%s', 'understrap' ) . '</span>', $categories_list ); // WPCS: XSS OK.
        }
        /* translators: used between list items, there is a space after the comma */
        if (is_singular( 'post' ) || is_singular( 'portfolio_page' )) {
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
            if ( $tags_list ) {
                /* translators: %s: Tags of current post */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'understrap' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }
    }

    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'understrap' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

add_action( 'pre_get_posts', 'sumun_pre_get_posts' );
function sumun_pre_get_posts($query) {
    if (!$query->is_main_query() || is_admin() ) return;

    if (is_search() || is_tax('tipo') || is_tax('sector') ) {
        $query->set('posts_per_page', 30);
    }
}

function menu_toggler() {
    ?>

    <button class="navbar-toggler" type="button" data-toggle="modal" data-target="#menu-principal" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
        <span class="slot slot-1"></span>
        <span class="slot slot-2"></span>
    </button>

    <?php
}

add_action( 'wp_body_open', 'menu_principal', 1000 );
function menu_principal() {
    ?>

    <div id="menu-principal" class="modal fade menu-principal bg-dark text-white" tabindex="-1" role="dialog" aria-labelledby="menu-principal-label" aria-hidden="true">

       <div class="menu-principal-inner modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-sm-6">
                        <?php wp_nav_menu( array(
                            'theme_location'  => 'primary',
                            'container'       => 'div',
                            'container_class' => 'menu-principal-container mb-5',
                            'container_id'    => 'menu-principal-container',
                            'menu_class'      => 'menu',
                            'menu_id'         => '',
                            'echo'            => true,
                        ) ); ?>
                    
                    <?php dynamic_sidebar( 'menu-izq' ); ?>
                    
                    </div>
                    <div class="col-sm-6">
                        <?php dynamic_sidebar( 'menu' ); ?>
                    </div>
                </div>

                <div class="text-center"><?php echo get_svg_marca_registro(); ?></div>

            </div>
   
        </div>

    </div>

    <script>
        jQuery('#menu-principal').on('show.bs.modal', function () {
            jQuery('.navbar-toggler').addClass('cerrar');
            jQuery('body').addClass('menu-abierto');
            // jQuery('#wrapper-navbar').toggleClass('bg-primary bg-dark');
        });
        jQuery('#menu-principal').on('hide.bs.modal', function () {
            jQuery('.navbar-toggler').removeClass('cerrar');
            jQuery('body').removeClass('menu-abierto');
            // jQuery('#wrapper-navbar').toggleClass('bg-primary bg-dark');
        });
    </script>

    <?php
}

function smn_get_proyectos_realizados( $item = false ) {

    if ( ! $item ) {
        $item = get_queried_object();
    }

    $img_ids = get_field( 'proyectos_realizados', $item );

    // if ( is_tax() && !$img_ids ) {
    //     $args = array(
    //         'post_type' => 'producto',
    //         'posts_per_page' => -1,
    //         'tax_query' => array(
    //             array(
    //                 'taxonomy' => $item->taxonomy,
    //                 'field'    => 'term_id',
    //                 'terms'    => $item->term_id,
    //             ),
    //         ),
    //     );
    //     $productos = get_posts($args);

    //     $img_ids = array();
    //     foreach ($productos as $producto) {
    //         $producto_img_ids = get_field('proyectos_realizados', $producto->ID);
    //         if ($producto_img_ids) {
    //             $img_ids = array_merge($img_ids, $producto_img_ids);
    //         }
    //     }
    //     $img_ids = array_unique($img_ids);

    // }
   
    if ( $img_ids ) {

        $titulo = __( 'Proyectos realizados', 'gmi' );
        $html = '';
        $html .= '<hr>';
        $html .= '<h2>'.$titulo.'</h2>';

        
        // Generar el HTML del bloque galería con lightbox
        $gallery_html = smn_generate_gallery_block_from_ids( $img_ids );
        $html .= $gallery_html;

        return $html;
    }

    return false;

}

function smn_generate_gallery_block_from_ids( $img_ids ) {
    if ( ! $img_ids ) {
        return false;
    }

    // Generar el HTML del bloque galería con lightbox
    $gallery_html = '<!-- wp:gallery {"linkTo":"lightbox"} -->';
    $gallery_html .= '<figure class="wp-block-gallery has-nested-images columns-default is-cropped">';

    foreach ($img_ids as $img_id) {
        $img_url = wp_get_attachment_image_url($img_id, 'large');
        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
        
        $gallery_html .= '<!-- wp:image {"lightbox":{"enabled":true},"id":' . $img_id . ',"sizeSlug":"large","linkDestination":"none"} -->';
        $gallery_html .= '<figure class="wp-block-image size-large">';
        $gallery_html .= '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '" class="wp-image-' . $img_id . '"/>';
        $gallery_html .= '</figure>';
        $gallery_html .= '<!-- /wp:image -->';
    }

    $gallery_html .= '</figure>';
    $gallery_html .= '<!-- /wp:gallery -->';

    $parsed_html = parse_blocks( $gallery_html );
    $rendered_block = render_block( $parsed_html[0] );

    return $rendered_block;
}

add_filter( 'the_content', 'mostrar_proyectos_realizados_content', 9, 1 );
function mostrar_proyectos_realizados_content( $content ) {
    if ( !is_singular() ) {
        return $content;
    }

    $proyectos_realizados = smn_get_proyectos_realizados();
    if ( $proyectos_realizados ) {
        return $content . $proyectos_realizados;
    }
    return $content;
}

add_filter('the_content', 'mostrar_formulario_pie_content', 10, 1);
function mostrar_formulario_pie_content( $content ) {
    if (!is_singular() && !is_singular( 'testimonio' ) && !is_singular( 'producto' ) && !is_page() ) return $content;

    $ocultar_formulario = get_post_meta( get_the_ID(), 'ocultar_formulario', true );
    if ($ocultar_formulario) return $content;


    $formulario = do_shortcode( get_theme_mod( 'formulario_testimonios', false ) );
    if ( $formulario ) {
        $titulo = get_theme_mod( 'titulo_formulario_testimonios', __( '¿Quiere saber más?', 'gmi' ) );
        $html = '';
        $html .= '<hr>';
        $html .= '<div class="row">';
            $html .= '<div class="col-md-4">';
                $html .= '<h3>'.$titulo.'</h3>';
            $html .= '</div>';
            $html .= '<div class="col-md-8">';
                $html .= $formulario;
            $html .= '</div>';
        $html .= '</div>';

        return $content . $html;
    }

    return $content;
}

add_action( 'wp_footer', 'efecto_marcas_corte_botones' );
function efecto_marcas_corte_botones() {
    ?>

    <script type="text/javascript">
        
        var marcaCorte = '<span class="btn-marca"></span>';
        var marcasCorte = '';
        for (var i = 0; i < 4; i++) {
            marcasCorte += marcaCorte;
        }
        jQuery('.btn-cut, .tiene-marcas-de-corte, #right-sidebar .widget:not(.widget_search)').append('<span class="marcas-corte">' + marcasCorte + '</span>');


    </script>

    <?php
}

function get_gallery_ids( $post = null ) {
    if(!$post) global $post;

    $gallery_ids = get_post_meta( get_the_ID(), 'galeria', true );

    if(!$gallery_ids) {
        global $post;

        $args = array(
            'post_parent'    => $post->ID,
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'fields'         => 'ids',
        );
        $gallery_ids = get_posts( $args );
    }

    return $gallery_ids;

}

function galeria_producto_images() {

    $gallery_ids = get_gallery_ids();

    if($gallery_ids) {
        echo '<div class="galeria-producto" id="galeria-producto-'.get_the_ID().'">';
        foreach ($gallery_ids as $i => $id) {
            echo wp_get_attachment_image( $id, 'medium_large' );
        }
        echo '</div>';
    } else {
        the_post_thumbnail( $size = 'medium_large' );
    }
}

function galeria_producto_controls() {
    
    $gallery_ids = get_gallery_ids();

    if($gallery_ids) {
        echo '<ul class="galeria-producto-controls" id="galeria-producto-controls-'.get_the_ID().'">';
        $titulo_anterior = false;
        foreach ($gallery_ids as $i => $id) {
            $titulo = get_the_title( $id );
            if ($titulo != $titulo_anterior) {
                echo '<li><a href="#galeria-producto-'.get_the_ID().'" data-slide="'.$i.'">'.$titulo.'</a></li>';
            }
            $titulo_anterior = get_the_title( $id );
        }
        echo '</ul>';
    } else {
        the_title();
    }
}

add_action('gmi_before_prefooter', 'mostrar_categorias_de_producto');
function mostrar_categorias_de_producto($content) {
    $taxonomy = 'tipo';
    $args = array(
        'hide_empty'        => 0,
        'taxonomy'          => $taxonomy,
        'parent'            => 0,
    );

    $terms = get_terms($args);
    if ($terms) {

        echo '<div class="wrapper bg-primary text-white" id="wrapper-prefooter-nav">';

            echo '<div class="container">';

                echo '<div class="prefooter-nav">';

                    foreach ($terms as $term) {
                        echo '<h2 class="mb-0"><a href="'.get_term_link( $term, $taxonomy ).'" class="read-more">'.$term->name.'</a></h2>';
                    }

                echo '</div>';

            echo '</div>';

        echo '</div>';
    }

}

function be_menu_item_classes( $classes, $item, $args ) {

    if ($item->type == 'custom' && strpos( $item->url, '#' )) {
        $key = array_search('current-menu-item', $classes);
        if($key) {
            unset($classes[$key]);
        }
    }
        
    return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'be_menu_item_classes', 10, 3 );