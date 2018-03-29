<?php
/**
 * The template for displaying all REST SERVICES pages (Custom Post Type)
 *
 *
 * @package aeris
 */
get_header(); 

$types_rest = get_the_terms( $post->ID, 'type_rest');

while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/header-content', 'page' );
?>

<div id="content-area" class="wrapper default component rest">
    <main id="main" class="site-main" role="main">
        <?php
            // get_template_part( 'template-parts/content', 'page' );
        ?>
        <article id="post-<?php the_ID(); ?>">
            <header>
            
                <section class="aeris-component-type_rest">
                    <h2>Type de service REST :</h2>
                    <?php 
                      if( $types_rest ) {
                        ?>
                        <div class="tag">
                        <?php
                            foreach( $types_rest as $type_rest ) { 
                                if ($type_rest->slug !== "non-classe") {
                                echo '<a href="'.site_url().'/type_rest/'.$type_rest->slug.'" class="'.$type_rest->slug.'">';
                                      echo $type_rest->name; 
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
            </header>
            
            <div class="wrapper-content">
                <!-- DESCRIPTION -->
                <?php 
                if (get_field('service_rest_description')) {
                ?>
                <section class="aeris-component-service_rest_description">
                    <input type="checkbox" name="" id="rest_description" checked>
                    <h2><label for="rest_description">Description</label></h2>
                    <div>
                        <?php the_field('service_rest_description'); ?>
                    </div>
                </section>
                <?php    
                }
                ?>

                <!-- ENTREE -->
                <?php 
                if (get_field('service_rest_in')) {
                    $code = get_field('service_rest_in');
                    $code_htmlentities=htmlentities($code);
                ?>
                <section class="aeris-component-rest_in">
                    <input type="checkbox" name="" id="rest_in" >
                    <h2><label for="rest_in">Entrée</label></h2>
                    <div>
                        <pre><?php echo $code_htmlentities;?></pre>
                    </div>  
                <section>
                <?php    
                }
                ?>

                <!-- SORTIE -->
                <?php 
                if (get_field('service_rest_out')) {
                    $code = get_field('service_rest_out');
                    $code_htmlentities=htmlentities($code);
                ?>
                <section class="aeris-component-rest_out">
                    <input type="checkbox" name="" id="rest_out" >
                    <h2><label for="rest_out">Sortie</label></h2>
                    <div>
                        <pre><?php echo $code_htmlentities;?></pre>
                    </div>
                <section>
                <?php    
                }
                ?>
                
                <!-- EXEMPLE D'UTILISATION -->
                <?php 
                if (get_field('service_rest_example')) {
                    $code = get_field('service_rest_example');
                    $code_htmlentities=htmlentities($code);
                ?>
                <section class="aeris-component-rest_example">
                <input type="checkbox" name="" id="rest_example" >
                    <h2><label for="rest_example">Exemple d'utilisation</label></h2>
                    <div>
                        <pre><?php echo $code_htmlentities;?></pre>
                    </div>
                <section>
                <?php    
                }
                ?>

            </div>
            <aside>
            <?php 
                if (get_field('service_rest_swagger')) {
                ?>
                <section class="aeris-component-links">
                    <a href="<?php the_field('service_rest_swagger'); ?>"><span class="fas fa-cogs"></span>  Swagger</a>
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