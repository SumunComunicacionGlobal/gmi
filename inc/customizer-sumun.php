<?php 
/**
* Crear panel de opciones en el customizador
*/
function sumun_new_customizer_settings($wp_customize) {
    $web_title = get_bloginfo( 'name' );
    // create settings section
    $wp_customize->add_panel('sumun_opciones', array(
        'title'         => $web_title . ': ' . __( 'Opciones de configuración', 'sumun-admin' ),
        'description'   => __( 'Opciones para este sitio web', 'sumun-admin' ),
        'priority'      => 1,
    ));
    $wp_customize->add_section('sumun_redes_sociales', array(
        'title'         => __( 'Redes sociales', 'sumun-admin' ),
        'priority'      => 20,
        'panel'         => 'sumun_opciones',
    ));
    $wp_customize->add_section('sumun_ajustes', array(
        'title'         => __( 'Otros ajustes', 'sumun-admin' ),
        'priority'      => 20,
        'panel'         => 'sumun_opciones',
    ));



    $redes_sociales = array(
        'email',
        'whatsapp',
        'linkedin',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'skype',
        'pinterest',
        'flickr',
        'blog',
    );
    foreach ($redes_sociales as $red) {
        // add a setting
        $wp_customize->add_setting($red);
        
        // Add a control
        $wp_customize->add_control( $red,   array(
            'type'      => 'text',
            'label'     => 'URL ' . $red,
            'section'   => 'sumun_redes_sociales',
        ) );
    }


    $wp_customize->add_setting('telefono');
    $wp_customize->add_control( 'telefono',   array(
        'type'      => 'text',
        'label'     => 'Teléfono',
        'section'   => 'sumun_ajustes',
    ) );

    $wp_customize->add_setting('formulario_testimonios');
    $wp_customize->add_control( 'formulario_testimonios',   array(
        'type'      => 'text',
        'label'     => 'Formulario al pie de los testimonios',
        'description' => 'Insertar el shortcode del formulario que quieras mostrar al pie de los testimonios - historias de usuarios',
        'section'   => 'sumun_ajustes',
    ) );

    $wp_customize->add_setting('titulo_formulario_testimonios');
    $wp_customize->add_control( 'titulo_formulario_testimonios',   array(
        'type'      => 'text',
        'label'     => 'Título a mostrar sobre el formulario',
        'section'   => 'sumun_ajustes',
    ) );

    $wp_customize->add_setting('info_privacidad_formularios');
    $wp_customize->add_control( 'info_privacidad_formularios',   array(
        'type'      => 'textarea',
        'label'     => 'Información básica de privacidad para formularios',
        'description' => 'Esta información se puede reproducir en cualquier lugar con el shortcode [info_basica_privacidad].',
        'section'   => 'sumun_ajustes',
    ) );


}
add_action('customize_register', 'sumun_new_customizer_settings');
/***/
