<?php
defined( 'ABSPATH' ) || exit;
$col_num = get_option('number_of_collumn_in_row', 3);
$number = array( "2"=>"two","3"=>"three","4"=>"four" );
?>
<?php

//var_dump(get_post()->post_content);
//var_dump($permalink);
?>
<button onclick="myFunction()">V</button>
<div id="SearchFields" class="search-fields">
    <div class="search-fields_searchbar"><?php echo do_shortcode( '[wcas-search-form]' ); ?></div>    
    <!-- <form label="porcentaje" action="campanas" class="search-fields_filters"> -->
    <form label="porcentaje" class="search-fields_filters">
       <div class="search-fields-inputs">
            <label class="searchbar-label" for="percent">Porcentaje acumulado</label>
            <!-- <input class="searchbar-input" type="text" name="percent" id="percent"> -->
            <select name='percent' class="searchbar-input">
                <option value="">---</option> 
                <option value="10">10%</option>  
                <option value="20">20%</option>  
                <option value="30">30%</option>
                <option value="40">40%</option> 
                <option value="50">50%</option>  
                <option value="60">60%</option>  
                <option value="70">70%</option>
                <option value="80">80%</option>
                <option value="90">90%</option>
                <option value="100">100%</option>      
            </select>  
        </div>
        <div class="search-fields-inputs">
            <label class="searchbar-label" for="location">Ubicación</label>
            <input class="searchbar-input" type="text" name="location" id="location">           
        </div>
        <div class="search-fields-inputs">
            <label class="searchbar-label" for="date">Fecha desde</label>
            <input type="text" id="datepicker" name="date_range_from" class="datepickers_1" placeholder="" />        
        </div>
        <div class="search-fields-inputs">
            <label class="searchbar-label" for="date">Fecha hasta</label>
            <input type="text" name="date_range_to" class="datepickers_1" placeholder="" />        
        </div>
        <input class="search-buttom" type="submit" value="Filtrar">
    </form>
</div>

<script>
function myFunction() {
  var x = document.getElementById("SearchFields");
  if (x.style.display === "none") {
    x.style.display = "flex";
  } else {
    x.style.display = "none";
  }
}
</script>


<?php
if(isset($_GET["percent"])){
    $filter_percent=$_GET["percent"];
}
if(isset($_GET["location"]) && $_GET["location"] !== ""){
    $filter_location=$_GET["location"];
}
if(isset($_GET["date_range_from"]) && $_GET["date_range_from"] !== ""){
    $date_range_from=$_GET["date_range_from"];
    $date_range_from = strtotime($date_range_from);
}
if(isset($_GET["date_range_to"]) && $_GET["date_range_to"] !== ""){
    $date_range_to=$_GET["date_range_to"];
    $date_range_to = strtotime($date_range_to);
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
                    $post_date = strtotime(wpcf_function()->get_end_date());

                     if ( (  (!$date_range_from || ($date_range_from <= $post_date)) && (!$date_range_to || ($post_date <= $date_range_to)) ) 
                            && (!$filter_percent || $filter_percent <= $post_percent) 
                            && (!$filter_location || strpos($post_location, $filter_location) !== false)){
                    
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