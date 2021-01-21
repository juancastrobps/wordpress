<?php
defined( 'ABSPATH' ) || exit;
get_header('shop');

do_action( 'wpcf_before_single_campaign' );

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>

<div class="wpneo-wrapper">
    <div class="wpneocf-container">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <div class="wpneo-list-details">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php do_action( 'wpcf_before_main_content' ); ?>
                        <div itemscope itemtype="http://schema.org/ItemList" id="campaign-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php do_action( 'wpcf_before_single_campaign_summary' ); ?>
                            <div class="wpneo-campaign-summary">
                                <div class="wpneo-campaign-summary-inner" itemscope itemtype="http://schema.org/DonateAction">
                                    <?php do_action( 'wpcf_single_campaign_summary' ); ?>
                                </div><!-- .wpneo-campaign-summary-inner -->
                                <!-- control de comentarios - solo usuarios donates -->
                                <?php                                 
                                if ( (!wc_customer_bought_product( '', get_current_user_id(), $product->get_id() )) || !is_user_logged_in() ) {
                                    function restrict_submit ( $fields){
                                       
                                            $fields =  array(
                                                'comment_field'  => 'Debe ser Donante para dejar comentarios',
                                                'submit_button' => ''
                                            );
                                            return $fields;            
                                        }                                        
                                        add_filter ('comment_form_defaults' , 'restrict_submit');
                                } ?>
                                <!-- codigo social share -->
                              
                                
                            </div><!-- .wpneo-campaign-summary -->
                            <?php do_action( 'wpcf_after_single_campaign_summary' ); ?>
                            <meta itemprop="url" content="<?php the_permalink(); ?>" />
                        </div>
                        <!-- #campaign-<?php the_ID(); ?> -->
                        <?php do_action( 'wpcf_after_single_campaign' ); ?>
                        <?php do_action( 'wpcf_after_main_content' ); ?>
                    <?php endwhile; // end of the loop. ?>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>

<?php get_footer('shop'); ?>