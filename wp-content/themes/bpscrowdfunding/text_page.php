<?php
/**
 * Template part for displaying text content in page.php.
 *
 * 
 * Template Name: text_page
 */

get_header(); ?>
<div class="wrapper wrap-content">
	<div class="container">
	    <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="page-content">
				
			<?php 
			
			wp_title() ;
			echo get_post_field('post_content', $post->ID); ?>
				</div><!-- .page-content -->
	        </div>
	    </div>
	</div>
</div>
<?php 

do_action( 'charitize_action_after_header' );
get_footer();
