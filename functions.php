<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


/******************************************************************
* CUSTOM TAXONOMIES 
*/

add_action('init', 'aeris_component_custom_taxonomies');
function aeris_component_custom_taxonomies()
{
 // Thematiques 
    register_taxonomy(
        'etat',
        'page',
        array(
        'label' => 'Etats',
        'labels' => array(
            'name' => 'Etats',
            'singular_name' => 'Etat',
            'all_items' => 'Tous les états',
            'edit_item' => 'Éditer l\'état',
            'view_item' => 'Voir l\'état',
            'update_item' => 'Mettre à jour l\'état',
            'add_new_item' => 'Ajouter un état',
            'new_item_name' => 'Nouvel état',
            'search_items' => 'Rechercher parmi les états',
            'popular_items' => 'Etats les plus utilisées'
            ),
        'hierarchical' => true,
        'show_ui'   => true
        )
  ); 

    register_taxonomy_for_object_type( 'etat', 'component' );
}

/******************************************************************
 * CUSTOM POST
 *
 */

add_action('init', 'aeris_component_post_type');
function aeris_component_post_type() {
    register_post_type(
        'component',
        array(
          'label' => 'Composant',
          'labels' => array(
            'name' => 'Composants',
            'singular_name' => 'Componsant',
            'all_items' => 'Tous les composants',
            'add_new_item' => 'Ajouter un componsant',
            'edit_item' => 'Éditer le componsant',
            'new_item' => 'Nouveau componsant',
            'view_item' => 'Voir le componsant',
            'search_items' => 'Rechercher parmi les composants',
            'not_found' => 'Pas de componsant trouvé',
            'not_found_in_trash'=> 'Pas de componsant dans la corbeille'
            ),
          'public' => true,
          'capability_type' => 'post',
          'has_archive' => true
        )
      );
    }

/******************************************************************
* ACF 
*/

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_5aa7fd7ac2ed6',
        'title' => 'Meta component page',
        'fields' => array (
            array (
                'key' => 'field_5aa7ffe0652cc',
                'label' => 'Dépendance',
                'name' => 'dependance',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array (
                    0 => 'page',
                ),
                'taxonomy' => array (
                ),
                'filters' => array (
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'object',
            ),
            array (
                'key' => 'field_5aa80064652ce',
                'label' => 'Code',
                'name' => 'code',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 30,
                'new_lines' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'component',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
    
    endif;