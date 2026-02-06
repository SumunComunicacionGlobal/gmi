<?php 
/* Widget areas */
add_action( 'widgets_init', 'sumun_widgets_init', 20 );
function sumun_widgets_init() {
    
    register_sidebar(
        array(
            'name'          => __( 'Menú widgets izquierda', 'understrap' ),
            'id'            => 'menu-izq',
            'description'   => __( 'Aparece en la columna izquierda del menu', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div><!-- .widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Menú widgets derecha', 'understrap' ),
            'id'            => 'menu',
            'description'   => __( 'Aparece en la columna derecha del menu', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div><!-- .widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Más info sobre productos', 'understrap' ),
            'id'            => 'mas-info-productos',
            'description'   => __( 'Aparece al final de los listados de productos o de categorías de producto. Ideal para insertar un formulario de solicitud de información.', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div><!-- .widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Pre footer', 'understrap' ),
            'id'            => 'prefooter',
            'description'   => __( 'Aparece antes del Pie de Página Completo', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Copyright', 'understrap' ),
            'id'            => 'copyright',
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

}
/***/

/* Site info */
add_action( 'understrap_site_info', 'understrap_add_site_info' );

/**
 * Add site info content.
 */
function understrap_add_site_info() {
    echo '<div class="row">';
        echo '<div class="col-md-6">';
            echo '<div class="footer-widget">';
                echo '<img class="logo-footer" src="' . get_stylesheet_directory_uri() . '/img/logo-footer.svg" alt="Logo Grupo Milan Inagraf" width="152" height="73" />';
            echo '</div>';
        echo '</div>';
        echo '<div class="col-md-6">';
            if (is_active_sidebar( 'copyright' )) {
                    dynamic_sidebar( 'copyright' );
            }
        echo '</div>';
    echo '</div>';

    echo '<span class="marca-registro">' . get_svg_marca_registro() . '</span>';
}

/***/