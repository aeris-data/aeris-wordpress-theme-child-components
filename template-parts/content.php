<?php
/**
 * Template part for displaying embed page / custom post type service REST & Components
 *
 */
$categories = get_the_terms( $post->ID, 'category');  

?>

<article role="embed-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h3>
           <a href="<?php the_permalink(); ?>">
            <?php the_title();?>
            </a>
        </h3>     
        
        <?php 
        if (get_the_post_thumbnail()) {
        ?>
        <figure>
        <?php the_post_thumbnail( 'illustration-article' ); ?>
        </figure>
        <?php 
        }
        elseif (get_field('screenshots')){
            $images = get_field('screenshots');
            ?>
            <?php $image = $images[0];?>                
            <figure>
            <img src="<?php echo $image['sizes']['illustration-article']; ?>" alt="<?php echo $image['alt']; ?>" />
            </figure>
        <?php 
        }
        ?>        

    </header>
    <?php 
    if (get_field('objectif')) {
        $objectifs = substr(get_field('objectif'), 0, 200);
    ?>
    <section class="aeris-component-objectifs">
        <?php 
       echo $objectifs."...";
        ?>
    </section>
    <?php    
    }
    ?>
    <?php 
    if (get_field('service_rest_description')) {
        $service_rest_description = substr(get_field('service_rest_description'), 0, 200);
    ?>
    <section class="aeris-component-service_rest_description">
        <?php 
        echo $service_rest_description."...";
        ?>
    </section>
    <?php    
    }
    ?>

    <footer>
        <?php theme_aeris_show_categories($categories);?>
        
		<?php theme_aeris_meta(); ?>
	</footer>
</article>