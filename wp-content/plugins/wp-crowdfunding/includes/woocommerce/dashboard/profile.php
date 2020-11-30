<?php
defined( 'ABSPATH' ) || exit;

$current_user_id = get_current_user_id();
/**
 * If user can manage options
 */
$logged_user_info = true;
if (user_can($current_user_id, 'manage_options')){
	if (isset($_GET['show_user_id'])){
		$current_user_id = (int) sanitize_text_field($_GET['show_user_id']);
		$logged_user_info = false;
	}
}

$data = get_user_meta($current_user_id);
$user = get_user_by('ID', $current_user_id);

$html .= '<div class="wpneo-content">';
    $html .= '<form id="wpneo-dashboard-form" action="" method="" class="wpneo-form">';
    $html .= '<div class="profile-container">';
    $html .= '<div class="wpneo-profile-header"><h2>Mi cuenta</h2></div>';
    $html .= '<div class="wpneo-row">';
            $html .= '<div class="wpneo-col6-picture">';
                $html .= '<div class="wpneo-shadow wpneo-clearfix">';
                    // $html .= '<h4>'.__("Profile Picture","wp-crowdfunding").'</h4>';
                    $html .= '<div class="wpneo-fields">';
                    $html .= '<input type="hidden" name="action" value="wpneo_profile_form">';

                    $html .= '<div class="profile-image">';
                    // do_shortcode('[avatar_upload]');
                        $html .= '</div>';
                
                        $img_src = get_avatar_url( $current_user_id );
                        $image_id = get_user_meta( $current_user_id, 'profile_image_id', true );
                        if ($image_id && $image_id > 0) {
                            $img_src = wp_get_attachment_image_src($image_id, 'full')[0];
                        }
                        // editado imagen
                        $img_src = get_wp_user_avatar_src($user->ID, 'fullsize');
                        $html .= '<img class="profile-form-img" src="'.$img_src.'" alt="'.__( "Profile Image:" , "wp-crowdfunding" ).'">';

                        

                        $html .= '<span id="wpneo-image-show"></span>';
                        $html .= '<input type="hidden" name="profile_image_id" class="wpneo-form-image-id" value="'.$image_id.'">';
                        $html .= '<input type="hidden" name="wpneo-form-image-url" class="wpneo-form-image-url" value="">';
                        $html .= '<button id="wpneo-image" class="wpneo-image-btn"> Cambiar Imagen </button>';
			

                        $html .= '</div>';
                $html .= '</div>';//wpneo-shadow
            $html .= '</div>';//wpneo-col6

            $html .= '<div class="wpneo-col6-info">';
                
                // Basic info
                $html .= '<div class="profile_data">';
                    $html .= '<h4>'.__("Mi información","wp-crowdfunding").'</h4>';
                    $html .= '<p>';
				    $html .= '<span class="data_name">'.__( "Usuario" , "wp-crowdfunding" ).'</span>';
                    // $html .= '<span class="data_info">'.wpcf_function()->get_author_name().'</span>';
                    global $current_user; 
                    $html .= '<span class="data_info">'.$current_user->display_name.'</span>';
                    $html .= '</p>';
                    
                    $html .= '<p>';
                    $html .= '<span class="data_name">'.__( "Nombre" , "wp-crowdfunding" ).'</span>';
                    $html .= '<span class="data_info">';
                    $html .= '<input type="text" name="first_name" value="'.$user->first_name.'" disabled>';
                    $html .= '</span>';
                    $html .= '</p>';                   
                    

                    $html .= '<p>';
					$html .= '<span class="data_name">'.__( "Last Name:" , "wp-crowdfunding" ).'</span>';
					$html .= '<span class="data_info">';
					$html .= '<input type="text" name="last_name" value="'.$user->last_name.'" disabled>';
					$html .= '</span>';
				    $html .= '</p>';

                // About Us
                // $html .= '<span class="wpneo-name">';
                //     $html .= '<p>'.__( "About Us:" , "wp-crowdfunding" ).'</p>';
                // $html .= '</span>';
                // $html .= '<span class="wpneo-fields">';
                //     $value = ''; if(isset($data['profile_about'][0])){ $value = esc_textarea($data['profile_about'][0]); }
                //     $html .= '<textarea name="profile_about" rows="3" disabled>'.$value.'</textarea>';
                // $html .= '</span>';

                // Profile Information
                $html .= '<p>';
                    $html .= '<span class="data_name_biografia">'.__( "Biografía:" , "wp-crowdfunding" ).'</span>';
                    $html .= '<span class="data_info">';
                        $value = ''; if(isset($data['profile_portfolio'][0])){ $value = esc_textarea($data['profile_portfolio'][0]); }
                        $html .= '<textarea name="profile_portfolio" rows="3" disabled>'.$value.'</textarea>';
                    $html .= '</span>';
                $html .= '</p>';

                $html .= '</div>';//wpneo-shadow
            $html .= '</div>';//wpneo-col6

            
            $html .= '<div class="wpneo-col6-contact">';
                $html .= '<div class="profile_contact">';
                    // $html .= '<h4>'.__("Contact Info","wp-crowdfunding").'</h4>';
                    // Email
                    $html .= '<p>';
                        $html .= '<img src="'.site_url().'/wp-content/uploads/2020/11/mail.png" alt="mail">';
                        $html .= '<span class="data_info">';
                            $value = ''; if(isset($data['profile_email1'][0])){ $value = esc_attr($data['profile_email1'][0]); }
                            $html .= '<input type="text" name="profile_email1" value="'.$value.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';
                    // Mobile Number
                    $html .= '<p>';
                        $html .= '<img src="'.site_url().'/wp-content/uploads/2020/11/telefono.png" alt="telefono">';                                     
                        $html .= '<span class="data_info">';
                            $value = ''; if(isset($data['profile_mobile1'][0])){ $value = esc_attr($data['profile_mobile1'][0]); }
                            $html .= '<input type="text" name="profile_mobile1" value="'.$value.'" disabled>';
                        $html .= '</span>';
                    $html .= '<p>';
                    // Website
                    $html .= '<p>';
                        $html .= '<img src="'.site_url().'/wp-content/uploads/2020/11/web.png" alt="web">';    
                        $html .= '<span class="data_info">';
                            $value = ''; if(isset($data['profile_website'][0])){ $value = esc_url($data['profile_website'][0]); }
                            $html .= '<input type="text" name="profile_website" value="'.$value.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';                    
                    // Fax
                    // $html .= '<p>';
                    //     $html .= '<img src="'.site_url().'/wp-content/uploads/2020/11/mail.png" alt="mail">';
                    //     $html .= '<span class="data_info">';
                    //         $value = ''; if(isset($data['profile_fax'][0])){ $value = esc_attr($data['profile_fax'][0]); }
                    //         $html .= '<input type="text" name="profile_fax" value="'.$value.'" disabled>';
                    //     $html .= '</span>';
                    // $html .= '</p>';                    

                    // Address
                    // $html .= '<div class="wpneo-single">';
                    //     $html .= '<div class="wpneo-name">';
                    //         $html .= '<p>'.__( "Address:" , "wp-crowdfunding" ).'</p>';
                    //     $html .= '</div>';
                    //     $html .= '<div class="wpneo-fields">';
                    //         $value = ''; if(isset($data['profile_address'][0])){ $value = esc_textarea($data['profile_address'][0]); }
                    //         $html .= '<input type="text" name="profile_address" value="'.$value.'" disabled>';
                    //     $html .= '</div>';
                    // $html .= '</div>';


                 $html .= '</div>';//profile_data
            $html .= '</div>';//wpneo-col6

            $html .= '<div class="wpneo-col6-social">';
                $html .= '<div class="profile_data">';
                    // $html .= '<h4>'.__("Redes Sociales","wp-crowdfunding").'</h4>';

                    //Facebook
                    $html .= '<p>';
                        $html .= '<img src="'.site_url().'/wp-content/uploads/2020/10/facebook.png" alt="facebook">';
                        $html .= '<span class="data_info">';
                            $value = ''; if(isset($data['profile_facebook'][0])){ $value = esc_textarea($data['profile_facebook'][0]); }
                            $html .= '<input type="text" name="profile_facebook" value="'.$value.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';

                    // Twitter
                    $html .= '<p>';
                    $html .='<img src="'.site_url().'/wp-content/uploads/2020/10/twitter.png" alt="twitter"> </a>';
                        $html .= '<span class="data_info">';
                            $value = ''; if(isset($data['profile_twitter'][0])){ $value = esc_textarea($data['profile_twitter'][0]); }
                            $html .= '<input type="text" name="profile_twitter" value="'.$value.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';

                    // Instagram
                    $html .= '<p>';
                    $html .='<img src="'.site_url().'/wp-content/uploads/2020/10/instagram.png" alt="instagram"> </a>';
                        $html .= '<span class="data_info">';
                            $value = ''; if(isset($data['profile_instagram'][0])){ $value = esc_textarea($data['profile_instagram'][0]); }
                            $html .= '<input type="text" name="profile_instagram" value="'.$value.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';
                    
                    // Youtube
                    $html .= '<p>';
                    $html .='<img src="'.site_url().'/wp-content/uploads/2020/10/youtube.png" alt="youtube"> </a>';
                        $html .= '<span class="data_info">';
                            $value = ''; if(isset($data['profile_youtube'][0])){ $value = esc_textarea($data['profile_youtube'][0]); }
                            $html .= '<input type="text" name="profile_youtube" value="'.$value.'" disabled>';
                        $html .= '</span>';
                    $html .= '</p>';

                $html .= '</div>';//profile_data
            $html .= '</div>';//wpneo-col6



        $html .= '</div>';//wpneo-row
        $html .= '</div>';//profile-container

        ob_start();
        do_action('wpcf_dashboard_after_profile_form');
        $html .= ob_get_clean();

        $html .= wp_nonce_field( 'wpneo_crowdfunding_dashboard_form_action', 'wpneo_crowdfunding_dashboard_nonce_field', true, false );

        //Save Button
		if ($logged_user_info) {
            $html .= '<div class="wpneo-buttons-group">';
            $html .= '<button id="wpneo-edit" class="wpneo-edit-btn">' . __( "Editar info", "wp-crowdfunding" ) . '</button>';
			$html .= '<button id="wpneo-dashboard-btn-cancel" class="wpneo-cancel-btn wpneo-hidden" type="submit">' . __( "Cancel", "wp-crowdfunding" ) . '</button>';
			$html .= '<button id="wpneo-profile-save" class="wpneo-save-btn wpneo-hidden button-primary" type="submit">' . __( "Save", "wp-crowdfunding" ) . '</button>';
            $html .= '</div>';
			$html .= '<div class="clear-float"></div>';
		}

    $html .= '</form>';
$html .= '</div>';