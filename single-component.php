<?php
/**
 * The template for displaying all component pages (Custom Post Type)
 *
 *
 * @package aeris
 */
get_header(); 

$etats = get_the_terms( $post->ID, 'etat');
$projets = get_the_terms( $post->ID, 'projet');
$fonctionnalites = get_the_terms( $post->ID, 'fonctionnalite'); 


while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/header-content', 'page' );
?>

<div id="content-area" class="wrapper default component">
    <main id="main" class="site-main" role="main">
        <?php
            // get_template_part( 'template-parts/content', 'page' );
        ?>
        <article id="post-<?php the_ID(); ?>">
            <header>
                <section class="aeris-component-fonctionnalite">
                    <h2>Type de fonctionnalité :</h2>
                    <?php 
                      if( $fonctionnalites ) {
                        ?>
                        <div class="tag">
                        <?php
                            foreach( $fonctionnalites as $fonctionnalite ) { 
                                if ($fonctionnalite->slug !== "non-classe") {
                                echo '<a href="'.site_url().'/fonctionnalite/'.$fonctionnalite->slug.'" class="'.$fonctionnalite->slug.'">';
                                      echo $fonctionnalite->name; 
                                    ?>                    
                                </a>
                        <?php 
                                }
                            }
                        ?>
                        </div>
                        <div class="clear"></div>
                      <?php
                          } 
                    ?>
                </section>
                
                <?php 
                foreach( $etats as $etat ) { 
                    ?>
                <section class="aeris-component-state <?php echo $etat->slug;?>">
                    <?php
                        echo $etat->name; 
                    ?>                    
                </section>
                <?php
                }
                ?>
            </header>
            
            <div class="wrapper-content">
                <?php 
                if (get_field('objectif')) {
                ?>
                <section>
                    <h2>Objectifs</h2>
                    <?php the_field('objectif'); ?>
                </section>
                <?php    
                }
                ?>

                <?php 
                if (get_field('exemple')) {
                ?>
                <section>
                    <h2>Exemple d'utilisation</h2>
                    <?php the_content();
                    //the_field('exemple');?>
                </section>
                <?php    
                }
                ?>

                <?php 
                if (get_field('proprietes')) {
                ?>
                <section>
                    <h2>Propriétés de la balise</h2>
                    <?php the_field('proprietes'); ?>
                </section>
                <?php    
                }
                ?>

                <?php 
                if (get_field('evenements')) {
                ?>
                <section>
                    <h2>Evénements</h2>
                    <?php the_field('evenements'); ?>
                </section>
                <?php    
                }
                ?>

                <?php 
                if (get_field('infos')) {
                ?>
                <section>
                    <h2>Infos complémentaires</h2>
                    <?php the_field('infos'); ?>
                </section>
                <?php    
                }
                ?>

                <!-- <section class="aeris-component-code">
                    <pre>
                    <?php //the_field('code'); ?>
                    </pre>
                <section> -->
            </div>
            <aside>
                 <?php 
                if (get_field('lien_github')) {
                ?>
                <section>
                    <h2>Lien dépôt de source (Git)</h2>
                    <p><a href="<?php the_field('lien_github'); ?>"><?php the_field('lien_github'); ?>
                    </a></p>
                    
                </section>
                <?php    
                }
                ?>

                 <?php 
                if (get_field('demo_url')) {
                ?>
                <section>
                    <h2>Page de démo</h2>
                    <p><a href="<?php the_field('demo_url'); ?>"><?php the_field('demo_url'); ?>
                    </a></p>
                </section>
                <?php    
                }
                ?>

                <?php

                $dependances = get_field('dependance');
                
                if( $dependances ): ?>
                <section class="aeris-component-dependance">
                    <h2>Dépendance avec d'autres composants :</h2>
                    <ul>
                    <?php foreach( $dependances as $post): // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                 </section>
                <?php endif; ?>

                <section class="aeris-component-projet">
                    <h2>Projet(s) utilisant le composant :</h2>
                    <?php 
                    if( $projets ) {
                    ?>
                    <ul>
                    <?php
                        foreach( $projets as $projet ) { 
                            if ($projet->slug !== "non-classe") {
                            echo '<li><a href="'.site_url().'/projet/'.$projet->slug.'" class="'.$projet->slug.'">';
                                    echo $projet->name; 
                                ?>                    
                            </a></li>
                        <?php 
                            }
                        }
                        ?>
                    </ul>
                    <?php
                    } 
                    ?>
                </section>
            </aside>
        </article><!-- #post-## -->
    </main><!-- #main -->
</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
get_footer();