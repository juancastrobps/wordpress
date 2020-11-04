<?php
defined( 'ABSPATH' ) || exit;
$col_num = get_option('number_of_collumn_in_row', 3);
$number = array( "2"=>"two","3"=>"three","4"=>"four" );
?>
<?php

//var_dump(get_post()->post_content);
//var_dump($permalink);
?>
<!-- <form label="porcentaje" action="campanas">
<select name='percent' onchange="this.form.submit()">
  <option value="---">---</option> 
  <option value="10">10</option>  
  <option value="20">20</option>  
  <option value="30">30</option>
  <option value="50">50</option>    
</select>  
</form> -->
<div class="search-fields">
    <div class="search-fields_searchbar"><?php echo do_shortcode( '[wcas-search-form]' ); ?></div>    
    <form label="porcentaje" action="campanas" class="search-fields_filters">
       <div class="search-fields-inputs">
            <label class="searchbar-label" for="percent">Porcentaje acumulado</label>
            <input class="searchbar-input" type="text" name="percent" id="percent">
        </div>
        <div class="search-fields-inputs">
            <label class="searchbar-label" for="location">Ubicación</label>
            <input class="searchbar-input" type="text" name="location" id="location">           
        </div>
        <input class="search-buttom" type="submit" value="Buscar">
    </form>
</div>

<?php
if(isset($_GET["percent"])){
    $filter_percent=$_GET["percent"];
    //echo "select percent is => ".$filter_percent;
}
if(isset($_GET["location"]) && $_GET["location"] !== ""){
    $filter_location=$_GET["location"];
}
?>
<div class="wpneo-wrapper">
    <div class="wpneo-container">
        <?php do_action('wpcf_campaign_listing_before_loop'); ?>
        <div class="wpneo-wrapper-inner">
            <?php if (have_posts()): ?>
                <?php
                $i = 1;
                while (have_posts()) : the_post();

                    $post_percent = wpcf_function()->get_raised_percent();
                    $post_location = wpcf_function()->campaign_location();
                    
                     if ( (!$filter_percent || $filter_percent < $post_percent) && (!$filter_location || strpos($post_location, $filter_location) !== false)){
                    
                            $class = '';
                            if( $i == $col_num ){
                                $class = 'last';
                                $i = 0;
                            }
                            if($i == 1){ $class = 'first'; }
                                
                            ?>
                            <div class="wpneo-listings <?php echo $number[$col_num]; ?> <?php echo $class; ?>">
                                <?php do_action('wpcf_campaign_loop_item_before_content'); ?>
                                <div class="wpneo-listing-content">
                                    <?php  do_action('wpcf_campaign_loop_item_content'); ?>
                                </div>
                                <?php do_action('wpcf_campaign_loop_item_after_content'); ?>
                            </div>
                    
                    <?php 
                   } 
                    $i++; endwhile; ?>
            <?php
            else:
                wpcf_function()->template('include/loop/no-campaigns-found');
            endif;
            ?>
        </div>
        <?php 
            do_action('wpcf_campaign_listing_after_loop');
            wpcf_function()->template('include/pagination');
        ?>
    </div>
</div>