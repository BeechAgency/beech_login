<?php
/*
	Actual Login Page Scripts
*/

function BEEECH_login() { 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	//$custom_logo_src = wp_get_attachment_image_src($custom_logo_id, 'full', false)[0];

	$custom_logo_src = get_option( 'BEECH_login_screen_brand_image' );

	$left_bg_image_src = get_option('BEECH_login_screen_background_texture');
	$right_bg_image_src = get_option( 'BEECH_login_screen_background_image' );

	$primary_color =  get_option('BEECH_login_screen_primary_color');
	$secondary_color = get_option('BEECH_login_screen_secondary_color');

    $left_bg_style = get_option('BEECH_login_left_background_style');
    $full_bg = get_option('BEECH_login_background_full_only');

	?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('<?= $custom_logo_src ?>');
			/*height:100px; */
			width: 100%;
			background-size: contain;
			background-repeat: no-repeat;
			padding-bottom: 0px;
            min-height: 125px;
			
			transition: all 250ms;
        }
		body.login {
			background-image: url('<?= $right_bg_image_src ?>');
			background-position: center center;
			background-size: cover;
			background-repeat: no-repeat;
		}
		body.login p#nav { float: none; }
		body.login p#backtoblog { float: none; }
		
		body.login p#nav, body.login p#backtoblog {
			display: inline-block;
			padding: 0;
			
			margin-top: 24px;
		}
		body.login p#nav a, body.login p#backtoblog a {
			color: black;
			border: solid 0px black;
			background-color: transparent;

			border-radius: 2px;
			padding: 5px 10px;
			transition: all 250ms;
		}
		body.login h1 a:hover { opacity: 0.7; }
		body.login #backtoblog a:hover, body.login #nav a:hover {
			color: <?= $secondary_color ?>;
			border-color: black;
			background-color: black;
		}
		
		body.login form {
			background-color: #ffffffc2;
			/*border: solid thin #ffffffc2;*/
			border: none;
			border-radius: 2px;
			padding-top: 30px;
			padding-bottom: 40px;
		}
		body.login form label { color: black; }
		body.login form p:first-child > label, body.login form div.user-pass-wrap label {
			margin-bottom: 15px;
		}
		
		body.login form div.user-pass-wrap {
			/*margin-top: 15px;*/
		}
		body.login p.message {
			background-color: #ffffffc2;
			border-left: 4px solid <?= $primary_color ?>;
			color: black;
		}

		body.login #login input {
			border: 1px solid #CCC;
		}
		#login .submit input.button-primary {
			background-color: <?= $primary_color ?>;
			border: solid 1px <?= $primary_color ?>;
			padding-left: 20px;
			padding-right: 20px;

			transition: all 250ms;
		}
		#login .submit input.button-primary:hover {
			background-color: black;
			border: solid 1px black;
			color: white;

		}

		/* Styles with Right Panel */
		body {
			display: flex;
			justify-content: center;
			align-items: stretch;
			align-content: stretch;
		}
		.clear {
			display: none;
		}
		body #login {
			max-width: 100%;
			min-width: 320px
		}
		body.login .left_panel {
			padding: 20px 40px;
			display: flex;
			align-items: center;
			justify-content: center;
			align-content: center;

			flex-direction: column;

			background-color: #f2f2f2;
			background-image: url(<?= $left_bg_image_src; ?>);
            <?= $left_bg_style ? 'background:'.$left_bg_style .';': ''; ?>
			background-position: 0px 0px;
			background-size: cover;
			background-repeat: no-repeat;
		}
		body.login .right_panel {
			width: 100%;
			position: relative;
			
			
			<?php if($full_bg !== 'false'): ?>background: linear-gradient(217deg, transparent, rgba(0, 0, 0, 0.03) 60%, #000), url('<?= $right_bg_image_src; ?>');<?php endif; ?>
			background-position: center center;
			background-size: cover;
			background-repeat: no-repeat;
			
			display: flex;
			align-items: center;
			justify-content: center;
			align-content: center;

		}

		.right_panel * {
			display: none;
		}

		.right_panel h2 {
			font-size: 48px;
			color: white;
			margin-right: 40px;
		}

		.right_panel .post_list {
			padding: 0;
			list-style: none;
		}
		.post_list a {
			display: block;
			padding: 10px 10px;
			text-decoration: none;
			color: white;


			font-size: 30px;
		}

		/* Footer */
		.beech_logo {    
			width: 62px;
			position: absolute;
			left: 20px;
			bottom: 10px;
		}
		.beech_footer {
			min-width: 480px;
			text-align: right;
			color: black;
		}
		.beech_footer a {
			color: inherit;
			
		}
		a.no_underline {
			text-decoration: none;
		}

		@media (max-width: 600px) {
			html {
				background-image: url('<?= $left_bg_image_src; ?>');
				background-position: 0px 0px;
				background-size: contain;
				
			}
			body.interim-login.login {
				margin-top: 10px;
				/*height: 100%;*/
			}

			body.login .right_panel {
				display: none;
			}

			body.login .left_panel {
				padding: 0;
				width: 100%;
			}
			body.login .beech_footer {
				max-width: 100%;
				min-width: 100%;
				width: 100%;
				margin-bottom: 10px;
				padding-left: 10px;
				padding-right: 10px;

				box-sizing: border-box;
				text-align: center;
			}
			body.login .beech_logo {
				width: 70px;
				position: unset;
				display: block;
				margin-left: auto;
				margin-right: auto;
			}
		}
    </style>
<?php }

function BEECH_left_panel() {
	echo '<div class="left_panel">';
}
function BEECH_right_panel() {
	$beech_logo_src = 'https://uploads-ssl.webflow.com/5f02c38ee45cb86d8770ecf2/5fc587838e0dea496885b067_BEECH-round.png';


	$wp_latest_posts = wp_get_recent_posts(array(
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));


	echo '<div class="beech_footer"><img src="'.$beech_logo_src.'" class="beech_logo" /> <a href="https://beech.agency" class="no_underline">We\'re here to help</a>. 02 4049 9136 | <a href="mailto:hi@beech.agency">hi@beech.agency</a></span></div>';
	echo '</div><div class="right_panel">';
	
	echo '<h2 class="latest_posts">Latest Posts</h2><ul class="post_list">';
	foreach($wp_latest_posts as $post) : ?>
        <li>
            <a href="<?php echo get_permalink($post['ID']) ?>">
                <?php echo get_the_post_thumbnail($post['ID'], 'full'); ?>
                <h4 class="post_list_title"><?php echo $post['post_title'] ?></h4>
            </a>
        </li><?php
    endforeach; wp_reset_query(); 

	echo '</div>';
}

add_action( 'login_enqueue_scripts', 'BEEECH_login' );
add_action( 'login_header', 'BEECH_left_panel');
add_action( 'login_footer', 'BEECH_right_panel');