<?php
/**
 * Template Name: Home
 */

get_header(); ?>


	<header class="page-header page-home aligcenter">
		
        <div>
            <?php
                if ( have_posts() ) {

                // Load posts loop.
                while ( have_posts() ) {
                        the_post();
                        
                        the_content();
                    }
                };
                ?>        
        </div>
	</header><!-- .page-header -->



<div class="tagcloud">
	<?php wp_tag_cloud( );?>
</div>

<?php
get_footer();
