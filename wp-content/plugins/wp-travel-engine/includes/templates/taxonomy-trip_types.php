<?php
/**
* The template for displaying trips according to type.
*
* @package Wp_Travel_Engine
* @subpackage Wp_Travel_Engine/includes/templates
* @since 1.0.0
*/
get_header(); ?>
<div id="wte-crumbs">
   <?php
        do_action('wp_travel_engine_breadcrumb_holder');
        ?>
</div>
<div id="wp-travel-trip-wrapper" class="trip-content-area" itemscope itemtype="http://schema.org/ItemList">
    <div class="wp-travel-inner-wrapper">
        <div class="wp-travel-engine-archive-outer-wrap">
            <?php
            $termID = get_queried_object()->term_id; // Parent A ID
            $term = get_term( $termID );
            $taxonomyName = $term->taxonomy;
            $termchildren = get_term_children( $termID, $taxonomyName );
            $obj  = new Wp_Travel_Engine_Functions();
            $wp_travel_engine_setting_option_setting = get_option( 'wp_travel_engine_settings', true );
            $j = 1;

            if($termchildren) {
                $default_posts_per_page = get_option( 'posts_per_page' );
                $wte_trip_cat_slug = get_queried_object()->slug;
                $wte_trip_cat_name = get_queried_object()->name;
                ?>
                <div class="page-header">
                    <h1 class="page-title" itemprop="name" data-id="<?php echo $taxonomyName;?>"><?php echo esc_attr( $wte_trip_cat_name ); ?></h1>
                    <?php $image_id = get_term_meta ( $termID, 'category-image-id', true );
                    if(isset($image_id) && $image_id !='' && isset($wp_travel_engine_setting_option_setting['tax_images']) && $wp_travel_engine_setting_option_setting['tax_images']!='')
                    {
                        $triptypes_banner_size = apply_filters('wp_travel_engine_template_banner_size', 'full');
                        echo wp_get_attachment_image ( $image_id, $triptypes_banner_size );
                    } ?>
                </div>
                <?php 
                $term_description = term_description( $termID, 'trip_types' ); ?>
                <div class="parent-desc" itemprop="description"><?php echo isset( $term_description ) ?  $term_description:'';?></div>
                    <?php
                    $wte_trip_tax_post_args = array(
                        'post_type' => 'trip', // Your Post type Name that You Registered
                        'posts_per_page' => $default_posts_per_page,
                        'order' => apply_filters('wpte_trip_types_trips_order','ASC'),
                        'orderby' => apply_filters('wpte_trip_types_trips_order_by','date'),
                        // 'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'trip_types',
                                'field' => 'slug',
                                'terms' => $wte_trip_cat_slug,
                                'include_children' => false
                            )
                        )
                    );
                    $wte_trip_tax_post_qry = new WP_Query($wte_trip_tax_post_args);
                    $category = get_term_by('name', $wte_trip_cat_name, 'trip_types');
                    $term = get_term( $category->term_id, 'trip_types' );
                    global $post;
                    if($wte_trip_tax_post_qry->have_posts()) :?>
                        <div class="grid <?php echo $termID; ?>" data-id="<?php echo $wte_trip_tax_post_qry->max_num_pages;?>">
                        <?php
                        while($wte_trip_tax_post_qry->have_posts()) :
                            $wte_trip_tax_post_qry->the_post(); 
                            // Start the Loop.
                            // while ( have_posts() ) : the_post();
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                            Wp_Travel_Engine_Functions::get_template( 'content-grid.php', array( 'j' => $j, 'post' => $post ));
                            $j++;
                            
                    endwhile; 
                    wp_reset_postdata();
                    endif;
                    wp_reset_query();
                    if( $term->count > $default_posts_per_page )
                    {
                        echo '<div class="btn-loadmore"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                    }
                    ?>
                </div>
                <?php
                foreach ($termchildren as $child) {
                    $term = get_term_by( 'id', $child, 'trip_types' ); 
                    $term_link = get_term_link( $term );
                    $child_term_description = term_description( $term, 'trip_types' );         
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $default_posts_per_page = get_option( 'posts_per_page' );
                    $my_query = new WP_Query( array(
                        'post_type' => 'trip', 
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomyName,
                                'field' => 'slug',
                                'terms' => $term->slug,
                                'include_children' => false
                            )
                        ),
                        'posts_per_page' => $default_posts_per_page,
                        'order' => apply_filters('wpte_trip_types_trips_order','ASC'),
                        'orderby' => apply_filters('wpte_trip_types_trips_order_by','date'),
                        // 'orderby' => 'menu_order',
                        // 'order' => 'ASC',
                        'paged'=> $paged

                        ));
                        ?>
                    <h2 class="child-title" itemprop="name"><a href="<?php echo esc_url( $term_link );?>"><?php echo esc_attr( $term->name );?></a></h2>
                    <div class="child-desc"><?php echo isset( $child_term_description ) ?  $child_term_description:'';?></div>
                    <div class="grid <?php echo $term->term_id;?>" data-id="<?php echo $my_query->max_num_pages;?>">
                        <?php 
                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <?php
                            global $post;
                            Wp_Travel_Engine_Functions::get_template( 'content-grid.php', array( 'j' => $j, 'post' => $post ));
                            $j++;
                            
                        endwhile;
                        wp_reset_postdata();
                        wp_reset_query();
                        if( $term->count > $default_posts_per_page )
                        {
                            echo '<div class="btn-loadmore"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                        }
                        ?>
                    </div>
                <?php
                } 
            }
            else{
                if(!isset(get_queried_object()->slug))
                    return;
                $wte_trip_cat_slug = get_queried_object()->slug;
                $wte_trip_cat_name = get_queried_object()->name;
                $default_posts_per_page = get_option( 'posts_per_page' );
                $category = get_term_by('slug', $wte_trip_cat_slug, 'trip_types');
                $term = get_term( $category->term_id, 'trip_types' );
                ?>
                <div class="page-header">
                    <div id="wte-crumbs">
                        <?php
                        do_action('wp_travel_engine_beadcrumb_holder');
                        ?>
                    </div>
                    <h1 class="page-title" itemprop="name" data-id="<?php echo $taxonomyName;?>"><?php echo esc_attr( $wte_trip_cat_name ); ?></h1>
                    <?php $image_id = get_term_meta ( $termID, 'category-image-id', true );
                    if(isset($image_id) && $image_id !='' && isset($wp_travel_engine_setting_option_setting['tax_images']) && $wp_travel_engine_setting_option_setting['tax_images']!='')
                    {
                        $triptypes_banner_size = apply_filters('wp_travel_engine_template_banner_size', 'full');
                        echo wp_get_attachment_image ( $image_id, $triptypes_banner_size );
                    } ?>
                </div>
                <?php 
                    $term_description = term_description( $termID, 'trip_types' ); ?>
                    <div class="parent-desc" itemprop="description"><?php echo isset( $term_description ) ?  $term_description:'';?></div>
                        <?php
                        $default_posts_per_page = get_option( 'posts_per_page' );
                        $wte_trip_tax_post_args = array(
                            'post_type' => 'trip', // Your Post type Name that You Registered
                            'posts_per_page' => $default_posts_per_page,
                            'order' => apply_filters('wpte_trip_types_trips_order','ASC'),
                            'orderby' => apply_filters('wpte_trip_types_trips_order_by','date'),
                            // 'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'trip_types',
                                    'field' => 'slug',
                                    'terms' => $wte_trip_cat_slug
                                )
                            )
                        );
                        $wte_trip_tax_post_qry = new WP_Query($wte_trip_tax_post_args);
                        global $post;
                        if($wte_trip_tax_post_qry->have_posts()) : ?>
                            <div class="grid <?php echo $termID;?>" data-id="<?php echo $wte_trip_tax_post_qry->max_num_pages;?>">
                                <?php
                            while($wte_trip_tax_post_qry->have_posts()) :
                                $wte_trip_tax_post_qry->the_post(); 
                                // Start the Loop.
                                // while ( have_posts() ) : the_post();
                                    /*
                                     * Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                Wp_Travel_Engine_Functions::get_template( 'content-grid.php', array( 'j' => $j, 'post' => $post ));
                                $j++;
                                
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    wp_reset_query();
                    if( $term->count > $default_posts_per_page )
                    {
                        echo '<div class="btn-loadmore"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                    }
                    ?>
                </div>
                <?php
                } 
                ?>
            </div>
        </div>
    </div>
<?php get_footer();