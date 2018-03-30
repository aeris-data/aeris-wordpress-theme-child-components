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
                <section class="aeris-component-objectifs">
                    <h2>Objectifs</h2>
                    <?php the_field('objectif'); ?>
                </section>
                <?php    
                }
                ?>

                <?php 
                if (get_field('exemple')) {
                    $code = get_field('exemple');
                    $code_htmlentities=htmlentities($code);
                ?>
                <section class="aeris-component-code">
                    <h2>Exemple d'utilisation</h2>
                    <pre><?php echo $code_htmlentities;?></pre>
                <section>
                <?php    
                }
                ?>
                

                <?php 
                if (get_field('proprietes')) {
                ?>
                <section class="aeris-component-proprietes">
                    <h2>Propriétés de la balise</h2>
                    <?php the_field('proprietes'); ?>
                </section>
                <?php    
                }
                ?>

                <?php 
                if (get_field('evenements')) {
                ?>
                <section class="aeris-component-evenements">
                    <h2>Evénements</h2>
                    <?php the_field('evenements'); ?>
                </section>
                <?php    
                }
                ?>

                <?php 
                if (get_field('infos')) {
                ?>
                <section class="aeris-component-infos">
                    <h2>Infos complémentaires</h2>
                    <?php the_field('infos'); ?>
                </section>
                <?php    
                }
                ?>
                <?php

                $images = get_field('screenshots');

                if( $images ): ?>
                <section class="aeris-component-screenshots">
                    <h2>Screenshots</h2>
                    <?php foreach( $images as $image ): ?>
                        
                    <a href="<?php echo $image['url']; ?>" class="foobox" rel="gallery" data-caption-title="<?php echo $image['caption']; ?>">
                        <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>
                        
                    <?php endforeach; ?>
                    
                </section>
                <?php endif; ?>
            </div>
            <aside>
                <?php 
                if (get_field('lien_github')) {
                ?>
                <section class="aeris-component-links">
                    <a href="<?php the_field('lien_github'); ?>"><span class="fab fa-git-square"></span> Source</a>
                    <?php 
                    if (get_field('demo_url')) {
                    ?>
                    <!-- <section class="aeris-component-demo"> -->
                    <a href="<?php the_field('demo_url'); ?>"><span class="fas fa-play"></span> Demo</a>
                    <?php    
                    }
                    ?>
                </section>
                <?php    
                }
                ?>

                <!-- CONTACTS -->
                <?php 
                if (get_field( 'contacts' )) {
                    $contacts_array = get_field( 'contacts' ); 
                    // $count_contact=count($contacts_array);
                ?>
                <section class="aeris-component-contact">
                    <h2><span class="fas fa-user"></span> Contact(s)</h2>
                    <ul>
                    <?php foreach ($contacts_array as $contact): ?>
                        <li> <?php //var_dump($contact);?>
                            <?php //echo "".$contact["display_name"]." <small>(".$contact["user_firstname"]." ".$contact["user_lastname"].")</small>"; ?> 
                            <?php echo "".$contact["display_name"]."";?> 
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </section>
                <?php
                }
                ?>

                <!-- DEPENDANCES -->
                <?php
                $dependances = get_field('dependance');                
                if( $dependances ): ?>
                <section class="aeris-component-dependance">
                    <h2><span class="fas fa-cogs"></span> Dépendance(s)</h2>
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
                
                <!-- SERVICES REST -->
                <?php
                $services_rest_relations = get_field('services_rest_relations');                
                if( $services_rest_relations ): ?>
                <section class="aeris-component-servicerest">
                    <h2><span class="fas fa-cog"></span> Service(s) REST</h2>
                    <ul>
                    <?php foreach( $services_rest_relations as $post): // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                 </section>
                <?php endif; ?>                

                <!-- PROJETS -->
                 <?php 
                if( $projets ) {
                ?>
                <section class="aeris-component-projet">
                    <h2><span class="fas fa-rocket"></span> Projet(s)</h2>                   
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
                </section>
                <?php
                } 
                ?>
            </aside>
        </article><!-- #post-## -->
        <?php			

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
    </main><!-- #main -->
</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
get_footer();