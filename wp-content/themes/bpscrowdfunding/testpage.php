<?php

/*
Template Name: testpage
*/
get_header(); ?>


<section class="wrapper wrap-content">
	<div class= "site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			if(array_key_exists('button1', $_POST)) { 
				button1(); 
			};

			echo "wtf"; 
			?>
			<form method="post">
			<input type="submit" name="button1" class="button" value="Button1" />
			</form>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</section>

<?php
get_footer();
