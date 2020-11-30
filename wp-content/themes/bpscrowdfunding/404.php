<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Charitize
 */

get_header(); ?>
<div class="wrapper page-inner-title">
	<div class="container">
	    <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'charitize' ); ?></h1>
				</header><!-- .entry-header -->
	        </div>
	    </div>
	</div>
</div>
<?php 
/**
 * charitize_action_after_header hook
 * @since charitize 1.0.0
 *
 * @hooked null
 */
do_action( 'charitize_action_after_header' );
?>	
<section class="wrapper wrap-content">
	<div class= "site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<div class="page-content">
						<p  style="font-size:3em; text-align:center"><?php esc_html_e( 'No hay ningún resultado', 'charitize' ); ?></p>		

						</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</section>

<?php
get_footer();
