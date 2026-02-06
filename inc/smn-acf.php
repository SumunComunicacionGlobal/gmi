<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_629dfb4e7fd46',
        'title' => 'Campos para Categorías',
        'fields' => array(
            array(
                'key' => 'field_62bf0111539dd',
                'label' => 'Fragmentos de contenido en la parte inferior',
                'name' => 'bottom_fragments',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'content_fragment',
                ),
                'taxonomy' => '',
                'allow_null' => 1,
                'multiple' => 1,
                'return_format' => 'id',
                'ui' => 1,
            ),
        ),
        'location' => array(
            array(
            array(
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'all',
            ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
    
    
    endif;		