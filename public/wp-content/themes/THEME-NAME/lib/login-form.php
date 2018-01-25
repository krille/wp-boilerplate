<?php

function custom_login_logo() { ?>
	<style type="text/css">
		#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/tr-logo.svg);
			width:146px;
			height:100px;
			background-size: 146px 100px;
			background-repeat: no-repeat;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_logo' );
