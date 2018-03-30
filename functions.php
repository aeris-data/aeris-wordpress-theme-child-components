<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.9/js/all.js', array(), null );

}

add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
/**
 * Filter the HTML script tag of `font-awesome` script to add `defer` attribute.
 *
 * @param string $tag    The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return   Filtered HTML script tag.
 */
function add_defer_attribute( $tag, $handle ) {
    if ( 'font-awesome' === $handle ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }

    return $tag;
}

/******************************************************************
* CUSTOM TAXONOMIES 
*/

add_action('init', 'aeris_component_custom_taxonomies');
function aeris_component_custom_taxonomies()
{
    // Etat du composant :  Actif / en dev / A faire / obsolete
    register_taxonomy(
        'etat',
        'component',
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

    // Projet 
    register_taxonomy(
        'projet',
        'component',
        array(
        'label' => 'Projets',
        'labels' => array(
            'name' => 'Projets',
            'singular_name' => 'Projet',
            'all_items' => 'Tous les projets',
            'edit_item' => 'Éditer le projet',
            'view_item' => 'Voir le projet',
            'update_item' => 'Mettre à jour le projet',
            'add_new_item' => 'Ajouter un projet',
            'new_item_name' => 'Nouveau projet',
            'search_items' => 'Rechercher parmi les projets',
            'popular_items' => 'projets les plus utilisées'
            ),
        'hierarchical' => true,
        'show_ui'   => true
        )
    );

    // Type de fonctionnalité
    register_taxonomy(
        'fonctionnalite',
        'component',
        array(
        'label' => 'Fonctionnalités',
        'labels' => array(
            'name' => 'Fonctionnalités',
            'singular_name' => 'Type de Fonctionnalité',
            'all_items' => 'Toutes les fonctionnalités',
            'edit_item' => 'Éditer la fonctionnalité',
            'view_item' => 'Voir la fonctionnalité',
            'update_item' => 'Mettre à jour la fonctionnalité',
            'add_new_item' => 'Ajouter une fonctionnalité',
            'new_item_name' => 'Nouvelle fonctionnalité',
            'search_items' => 'Rechercher parmi les fonctionnalités',
            'popular_items' => 'fonctionnalités les plus utilisées'
            ),
        'hierarchical' => true,
        'show_ui'   => true
        )
    );

    // Type de service REST
    register_taxonomy(
        'type_rest',
        'service-rest',
        array(
        'label' => 'Type',
        'labels' => array(
            'name' => 'Type',
            'singular_name' => 'Type de service',
            'all_items' => 'Toutes les types de services',
            'edit_item' => 'Éditer le type de service',
            'view_item' => 'Voir le type de service',
            'update_item' => 'Mettre à jour le type de service',
            'add_new_item' => 'Ajouter une type de service',
            'new_item_name' => 'Nouveau type de service',
            'search_items' => 'Rechercher parmi les types de services',
            'popular_items' => 'Types de services les plus utilisées'
            ),
        'hierarchical' => true,
        'show_ui'   => true
        )
    );

    // register_taxonomy_for_object_type( 'etat', 'component' );
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
            'singular_name' => 'Composant',
            'all_items' => 'Tous les composants',
            'add_new_item' => 'Ajouter un composant',
            'edit_item' => 'Éditer le composant',
            'new_item' => 'Nouveau composant',
            'view_item' => 'Voir le composant',
            'search_items' => 'Rechercher parmi les composants',
            'not_found' => 'Pas de composant trouvé',
            'not_found_in_trash'=> 'Pas de composant dans la corbeille'
            ),
          'public' => true,
          'supports' => array( 'title', 'thumbnail', 'comments', 'revisions'),
          'capability_type' => 'post',
          'has_archive' => true
        )
      );

      register_post_type(
        'service-rest',
        array(
          'label' => 'Service REST',
          'labels' => array(
            'name' => 'Service REST',
            'singular_name' => 'Service REST',
            'all_items' => 'Tous les services REST',
            'add_new_item' => 'Ajouter un service REST',
            'edit_item' => 'Éditer le service REST',
            'new_item' => 'Nouveau service REST',
            'view_item' => 'Voir le service REST',
            'search_items' => 'Rechercher parmi les services REST',
            'not_found' => 'Pas de service REST trouvé',
            'not_found_in_trash'=> 'Pas de service REST dans la corbeille'
            ),
          'public' => true,
          'supports' => array( 'title', 'revisions'),
          'capability_type' => 'post',
          'has_archive' => true
        )
      );
    }

/** LOAD ACF CONFIG */   
include ('acf-config.php');