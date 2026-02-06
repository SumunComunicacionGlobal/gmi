<?php 
add_post_type_support( 'page', 'excerpt' );
// add_action( 'init', 'sumun_settings', 1000 );
function sumun_settings() {  
    register_taxonomy_for_object_type('category', 'page');  
}


if ( ! function_exists('custom_post_type_slide') ) {

// Register Custom Post Type
function custom_post_type_slide() {

	$labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Slides', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Slides', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nueva Slide', 'sumun-admin' ),
		'new_item'              => __( 'Nueva Slide', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Slide', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Slide', 'sumun-admin' ),
		'view_item'             => __( 'Ver Slide', 'sumun-admin' ),
		'view_items'            => __( 'Ver Slide', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Slides', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 3,
		'menu_icon'             => 'dashicons-slides',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> true,
		'taxonomies'			=> array(),
	);
	register_post_type( 'slide', $args );

}
// add_action( 'init', 'custom_post_type_slide', 10 );

}



if ( ! function_exists('custom_post_type_team') ) {

// Register Custom Post Type
function custom_post_type_team() {

	$labels = array(
		'name'                  => _x( 'Team members', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Team member', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Miembro del equipo', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Miembros del equipo', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Miembro del equipo', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Miembro del equipo', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Miembro del equipo', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Miembro del equipo', 'sumun-admin' ),
		'view_item'             => __( 'Ver Miembro del equipo', 'sumun-admin' ),
		'view_items'            => __( 'Ver Miembro del equipo', 'sumun-admin' ),
		'featured_image'		=> __( 'Foto', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Foto', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Foto', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Foto', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Team members', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-id',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'taxonomies'			=> array(),
	);
	register_post_type( 'team', $args );

}
// add_action( 'init', 'custom_post_type_team', 10 );

}

if ( ! function_exists('custom_post_type_producto') ) {

// Register Custom Post Type
function custom_post_type_producto() {

	$labels = array(
		'name'                  => _x( 'Productos', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Producto', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Productos', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Producto', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Producto', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Producto', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Producto', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Producto', 'sumun-admin' ),
		'view_item'             => __( 'Ver Producto', 'sumun-admin' ),
		'view_items'            => __( 'Ver Producto', 'sumun-admin' ),
		'featured_image'		=> __( 'Imagen Principal', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Imagen Principal', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Imagen Principal', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Imagen Principal', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Productos', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'excerpt', 'author', 'thumbnail', 'revisions', 'editor', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 23,
		'menu_icon'             => 'dashicons-screenoptions',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'soluciones', 'gmi' ),
		'rewrite'				=> array(
										'slug'			=> __('soluciones/%tipo%','gmi'),
										'with_front'	=> false,
									),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'taxonomies'			=> array('sector','tipo'),
		'show_in_rest'			=> true,
	);
	register_post_type( 'producto', $args );

}
add_action( 'init', 'custom_post_type_producto', 10 );

}

add_filter( 'post_type_link', 'gmi_show_permalinks', 1, 2 );
function gmi_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'producto' ){
        $terms = wp_get_object_terms( $post->ID, 'tipo' );
        if( $terms ){
            return str_replace( '%tipo%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}

add_filter( 'wpseo_breadcrumb_links', 'wpseo_breadcrumb_add_woo_shop_link' );
function wpseo_breadcrumb_add_woo_shop_link( $links ) {
    global $post;

    // echo '<pre>'; print_r($links); echo '</pre>';

    foreach ($links as $index => $link) {
    	$links[$index]['url'] = str_replace('/producto/', '/'. __('productos', 'gmi') . '/', $link['url']);
    	$links[$index]['url'] = str_replace('/tipo/', '/'. __('soluciones', 'gmi') . '/', $link['url']);

    	if( isset($link['ptarchive']) ) {
    		$pt = $link['ptarchive'];
    		$links[$index]['url'] = get_post_type_archive_link( $pt );
    	}

    }

    // array_splice( $links, 1, -2, $breadcrumb );

    return $links;
}



if ( ! function_exists('custom_post_type_testimonio') ) {

// Register Custom Post Type
function custom_post_type_testimonio() {

	$labels = array(
		'name'                  => _x( 'Testimonios', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Testimonio', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Testimonios', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Testimonios', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Testimonio', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Testimonio', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Testimonio', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Testimonio', 'sumun-admin' ),
		'view_item'             => __( 'Ver Testimonio', 'sumun-admin' ),
		'view_items'            => __( 'Ver Testimonio', 'sumun-admin' ),
		'featured_image'		=> __( 'Foto de perfil', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Foto de perfil', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Foto de perfil', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Foto de perfil', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Testimonios', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'excerpt', 'thumbnail', 'editor', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 23,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'taxonomies'			=> array('procedencia'),
		'show_in_rest'			=> true,
	);
	register_post_type( 'testimonio', $args );

}
add_action( 'init', 'custom_post_type_testimonio', 10 );

}

if ( ! function_exists( 'custom_taxonomy_tipo' ) ) {

// Register Custom Taxonomy
function custom_taxonomy_tipo() {

	$labels = array(
		'name'                       => _x( 'Tipos', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Tipo', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Tipos de producto', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los tipos de producto', 'sumun-admin' ),
		'parent_item'                => __( 'Tipo superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Tipo superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo tipo', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo tipo', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar tipo', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar tipo', 'sumun-admin' ),
		'view_item'                  => __( 'Ver tipo de producto', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar tipos con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar tipos', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Tipos populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar tipos', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay tipos', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de tipos', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de tipos', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
		'rewrite'					 => array(
											'slug'			=> __( 'soluciones', 'gmi' ),
											'with_front'	=> false,
										),
	);
	register_taxonomy( 'tipo', array( 'producto' ), $args );

}
add_action( 'init', 'custom_taxonomy_tipo', 10 );

}

if ( ! function_exists( 'custom_taxonomy_sector' ) ) {

// Register Custom Taxonomy
function custom_taxonomy_sector() {

	$labels = array(
		'name'                       => _x( 'Sectores', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Sector', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Sectores', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los Sectores', 'sumun-admin' ),
		'parent_item'                => __( 'Sector superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Sector superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Sector', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Sector', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Sector', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Sector', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Sector', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Sectores con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Sectores', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Sectores populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Sectores', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Sectores', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Sectores', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Sectores', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'sector', array( 'producto' ), $args );

}
add_action( 'init', 'custom_taxonomy_sector', 10 );

}

function wpb_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'portfolio_page' == $screen->post_type ) {
          $title = 'Título del proyecto';
     } elseif  ( 'slide' == $screen->post_type ) {
          $title = 'Título de la slide';
     } elseif  ( 'team' == $screen->post_type ) {
          $title = 'Nombre y apellidos';
     }
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );

// ADD NEW COLUMN
add_filter('manage_posts_columns', 'sumun_columns_head');
add_filter('manage_pages_columns', 'sumun_columns_head');
add_action('manage_posts_custom_column', 'sumun_columns_content', 10, 2);
add_action('manage_pages_custom_column', 'sumun_columns_content', 10, 2);
function sumun_columns_head($defaults) {
	// $defaults = array('featured_image' => 'Imagen') + $defaults;
    $defaults['featured_image'] = 'Imagen';
    $defaults['excerpt'] = 'Resumen';

    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function sumun_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
    	echo '<div style="height:100px;">' . get_the_post_thumbnail( $post_ID, array(80,80) ) . '</div>';

    }
    if ($column_name == 'excerpt') {
    	$post = get_post($post_ID);
    	echo $post->post_excerpt;
    }
}


?>