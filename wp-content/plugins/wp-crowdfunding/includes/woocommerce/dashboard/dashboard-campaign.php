<?php
defined( 'ABSPATH' ) || exit;

$page_numb = max( 1, get_query_var('paged') );
$posts_per_page = get_option( 'posts_per_page',10 );
$args = array(
    'post_type' 		=> 'product',
    'post_status'		=> array('publish', 'draft'),
    'author'    		=> get_current_user_id(),
    'tax_query' 		=> array(
        array(
            'taxonomy' => 'product_type',
            'field'    => 'slug',
            'terms'    => 'crowdfunding',
        ),
    ),
    'posts_per_page'    => 4,
    'paged'             => $page_numb
);

$html .= '<div class="wpneo-row wp-dashboard-row">';
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
    global $post;
    $i = 1;
    while ( $the_query->have_posts() ) : $the_query->the_post();
        ob_start(); 
        $permalink = wpcf_function()->is_published() ? get_permalink() : '#';
        ?>
        <div class="wpneo-col6">



        <!-- edit dashboard campaings-->

        <div class="wpneo-listings dashboard">
                <?php do_action('wpcf_campaign_loop_item_before_content'); ?>
                <div class="wpneo-listing-content">
                    <?php do_action('wpcf_campaign_loop_item_content'); ?>
                </div>
                <?php do_action('wpcf_campaign_loop_item_after_content'); ?>
            </div>


        <!-- edit -->





            

            <?php do_action('wpcf_dashboard_campaign_loop_item_after_content'); ?>
            <div style="clear: both"></div>
        </div>
        <?php $i++;
        $html .= ob_get_clean();
    endwhile;
    wp_reset_postdata();
else :
    $html .= "<p>".__( 'Sorry, no Campaign Found.','wp-crowdfunding' )."</p>";
endif;
$html .= '</div>';
$html .= wpcf_function()->get_pagination( $page_numb , $the_query->max_num_pages );

