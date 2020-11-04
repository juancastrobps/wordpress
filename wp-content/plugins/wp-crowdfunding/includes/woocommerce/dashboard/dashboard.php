<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
?>
<?php

ob_start();
include_once WPCF_DIR_PATH.'includes/woocommerce/dashboard/wpcrowd-reports-chart.php';
$html .= ob_get_clean();
?>

<?php

$html .= '<div class="wpneo-row">';
    $html .= '<div class="wpneo-col6">';
    $html .= '<div class="wpneo-shadow wpneo-padding25 wpneo-clearfix">'; 
        $html .= '<h4>'.__( "My Campaigns" , "wp-crowdfunding" ).'</h4>';
        include_once WPCF_DIR_PATH.'includes/woocommerce/dashboard/dashboard-campaign.php';
    $html .= '</div>';//wpneo-shadow 
    $html .= '</div>';//wpneo-col6 
    $html .= '<div class="wpneo-col6">';

    ob_start();
    do_action('wpcf_dashboard_place_3');
    $html .= ob_get_clean();

    $html .= '<div class="wpneo-content wpneo-shadow wpneo-padding25 wpneo-clearfix">'; 
        $html .= '<form id="wpneo-dashboard-form" action="" method="" class="wpneo-form">';
                
                $html .= '<h4>'.__('My Information', 'wp-crowdfunding').'</h4>';                
                $html .= '<div class="profile_data">';
                // User Name
                    $html .= '<p>';
                        $html .= '<span class="data_name">'.__( "Usuario" , "wp-crowdfunding" ).'</span>';
                        // $html .= '<span class="data_info">'.wpcf_function()->get_author_name().'</span>';
                        global $current_user; 
                        $html .= '<span class="data_info">'.$current_user->display_name.'</span>';
                    $html .= '</p>';

                // Email Address
                    $html .= '<p>';
                        $html .= '<span class="data_name">'.__( "Correo" , "wp-crowdfunding" ).'</span>';
                        $html .= '<span class="data_info">';
                            $html .= '<input type="text" name="first_name" value="'.$current_user->user_email.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';  

                // First Name
                    $html .= '<p>';
                        $html .= '<span class="data_name">'.__( "Nombre" , "wp-crowdfunding" ).'</span>';
                        $html .= '<span class="data_info">';
                            $html .= '<input type="text" name="first_name" value="'.$current_user->user_firstname.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';  

                 // Last Name
                    $html .= '<p>';
                        $html .= '<span class="data_name">'.__( "Apellido" , "wp-crowdfunding" ).'</span>';
                        $html .= '<span class="data_info">';
                            $html .= '<input type="text" name="first_name" value="'.$current_user->user_lastname.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>'; 

                // Website
                    $html .= '<p>';
                        $html .= '<span class="data_name">'.__( "Website" , "wp-crowdfunding" ).'</span>';
                        $html .= '<span class="data_info">';
                            $html .= '<input type="text" name="first_name" value="'.$current_user->user_url.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';

                // Bio Info
                    $html .= '<p>';
                        $html .= '<span class="data_name">'.__( "Biografía" , "wp-crowdfunding" ).'</span>';
                        $html .= '<span class="data_info">';
                        $html .= '<textarea name="description" rows="3" disabled>'.$current_user->description.'</textarea>';
                        $html .= '</span>';
                    $html .= '</p>';

                $html .= '</div>';


            //$html .= '<h4>'.__('Payment Info', 'wp-crowdfunding').'</h4>';
            ob_start();
            do_action('wpcf_dashboard_after_dashboard_form');
            $html .= ob_get_clean();

            $html .= wp_nonce_field( 'wpneo_crowdfunding_dashboard_form_action', 'wpneo_crowdfunding_dashboard_nonce_field', true, false );
            //Save Button
            $html .= '<div class="wpneo-buttons-group float-right">';
                $html .= '<button id="wpneo-edit" class="wpneo-edit-btn">'.__( "Edit" , "wp-crowdfunding" ).'</button>';
                $html .= '<button id="wpneo-dashboard-btn-cancel" class="wpneo-cancel-btn wpneo-hidden" type="submit">'.__( "Cancel" , "wp-crowdfunding" ).'</button>';
                $html .= '<button id="wpneo-dashboard-save" class="wpneo-save-btn wpneo-hidden" type="submit">'.__( "Save" , "wp-crowdfunding" ).'</button>';
            $html .= '</div>';
            $html .= '<div class="clear-float"></div>';
        $html .= '</form>';//#wpneo-dashboard-form
    $html .= '</div>';//wpneo-content
    $html .= '</div>';//wpneo-col6 
$html .= '</div>';//wpneo-row
