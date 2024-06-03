<?php
/*
	Actual Login Page Scripts
*/

function BEECH_login_display_postlist() {
	// Arguments for the WP_Query
	$args = array(
		'post_type' => 'post',           // Get only posts
		'post_status' => 'publish',      // Get only published posts
		'posts_per_page' => 5,           // Get the latest 5 posts
		'has_password' => false          // Ensure posts are not password protected
	);

	// The Query
	$query = new WP_Query($args);

	// The Loop
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			// Your loop code goes here
			// For example, you can display the post title and content
			echo '<h2>' . get_the_title() . '</h2>';
			the_excerpt();
		}
	} else {
		// No posts found
		echo '<p>No posts found.</p>';
	}

	// Restore original Post Data
	wp_reset_postdata();

}



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

	$custom_css = get_option('BEECH_login_background_custom_css');
	$login_posts_on = get_option('BEECH_login_posts_on_login_page');
	$hide_language_switcher = get_option('BEECH_login_hide_language_switcher' );
	$invert_logo = get_option('BEECH_login_invert_logo');

	?>
    <style type="text/css">
		:root {
			--clr-primary : <?= $primary_color; ?>;
			--clr-secondary : <?= $secondary_color; ?>;
		}
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
		body.login a:hover { color: var(--clr-primary); }
		
		
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
			color: var(--clr-secondary);
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
			border-left: 4px solid var(--clr-primary);
			color: black;
		}

		body.login #login input {
			border: 1px solid #CCC;
		}
		#login .submit input.button-primary {
			background-color: var(--clr-primary);
			border: solid 1px var(--clr-primary);
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
			width: 80px;
			position: absolute;
			left: 0px;
			bottom: 50%;
			translate: 0% 50%;
		}
		.beech_footer {
			position: relative;
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
				margin-bottom: 15px;
			}
		}

		div.right_panel * {
			display: block;
		}
		.post_list img {
			display: block;
			max-width: 3rem;
			aspect-ratio: 1 / 1;
			height: auto;
			object-fit: cover;
		}

		.right_panel .post_list li {
			margin-bottom: 1rem;
		}

		.right_panel h2.latest_posts {
			font-size: 1.5rem;
			margin-bottom: 1.5rem;
		}

		body.login .right_panel {
			justify-content: flex-end;
		}

		.right_panel .post_list li > a {
			display: flex;
			gap: 1rem;
			padding: 0;
			align-items: flex-start;
		}

		.right_panel .post_list li h4 {
			font-weight: normal;
			font-size: 1.125rem;
		}

		div.right_panel .latest_posts_wrap {
			max-width: 20rem;
			width: 100%;
			background-color: #111414;
			align-self: flex-end;
			padding: 1.5rem;
			border-radius: 2rem 0 0 0;
		}
		<?php if( $login_posts_on !== '1') {
			echo 'div.right_panel .latest_posts_wrap { display: none !important; }';
		} 
		if( $hide_language_switcher === '1' ) {
			echo '.language-switcher, .privacy-policy-page-link { display: none; }';
		}
		if( $invert_logo === '1' ) {
			echo '.beech_footer { color: white; }';
			echo 'body.login p#nav a, body.login p#backtoblog a { color: white; }';
			echo 'body.login #backtoblog a:hover, body.login #nav a:hover { color: white; }';
		}
		
		?>


		<?= $custom_css ?>
    </style>
<?php 
}

function BEECH_left_panel() {
	echo '<div class="left_panel">';
}
function BEECH_right_panel() {
	$beech_logo = '<a href="https://beech.agency" target="_blank"><svg id="beechLogo" class="beech_logo" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 649.26 134.76">
	<defs>
	  <style>
		.logo-letter {
		  fill: currentColor;
		  stroke-width: 0px;
		}
	  </style>
	</defs>
	<path class="logo-letter" d="m84.22,131.55H0V3.21h84.22c25.51,0,42.03,14.28,42.03,30.64s-9.46,28.72-23.74,32.41c9.31,2.41,23.74,10.43,23.74,31.44,0,17.49-17.81,33.85-42.03,33.85Zm-12.35-89.52h-21.18v13.15h21.18c3.53,0,6.58-2.89,6.58-6.58s-3.05-6.58-6.58-6.58Zm0,37.7h-21.18v13.15h21.18c3.53,0,6.58-3.05,6.58-6.58s-3.05-6.58-6.58-6.58Z"/>
	<path class="logo-letter" d="m134.6,131.55V3.21h115.99v38.82h-65.29v13.15h31.76v24.55h-31.76v13.15h65.29v38.66h-115.99Z"/>
	<path class="logo-letter" d="m260.7,131.55V3.21h115.99v38.82h-65.29v13.15h31.76v24.55h-31.76v13.15h65.29v38.66h-115.99Z"/>
	<path class="logo-letter" d="m448.88,134.76c-36.74,0-66.42-30.16-66.42-67.38S412.14,0,448.88,0c33.21,0,56.79,24.55,60.32,56.79h-41.71c-1.6-12.35-9.95-17.33-16.68-17.33-8.66,0-17.33,8.02-17.33,27.91s8.66,27.91,17.33,27.91c6.58,0,14.92-4.97,16.52-16.84h41.87c-3.53,32.09-27.27,56.31-60.32,56.31Z"/>
	<path class="logo-letter" d="m598.56,131.55v-45.08h-30v45.08h-50.69V3.21h50.69v46.36h30V3.21h50.7v128.34h-50.7Z"/>
  </svg></a>';
	$partner_logo_src = get_option( 'BEECH_login_screen_partnership_logo' );
	$partnership_message = get_option('BEECH_login_screen_partnership_message');

	if(strlen($partner_logo_src) > 0) {
		$beech_logo = $partner_logo_src;
	}

	$footer_message = '<a href="https://beech.agency" class="no_underline">We\'re here to help</a>. 02 4049 9136 | <a href="mailto:hi@beech.agency">hi@beech.agency</a>';

	if(strlen($partnership_message) > 0) {
		$footer_message = $partnership_message;
	}

	$wp_latest_posts = wp_get_recent_posts(array(
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'post_status' => 'publish',           // Get the latest 5 posts
		'has_password' => false     // Show only the published posts
    ));


	if(strlen($partner_logo_src) > 0) {
		echo '<div class="beech_footer"><img src="'.$partner_logo_src.'" class="beech_logo" /> ';
	} else {
		echo '<div class="beech_footer">'.$beech_logo;
	}
	echo $footer_message;
	echo '</div></div><div class="right_panel">';
	
	echo '<div class="latest_posts_wrap"><h2 class="latest_posts">Latest Posts</h2><ul class="post_list">';
	foreach($wp_latest_posts as $post) : ?>
        <li>
            <a href="<?php echo get_permalink($post['ID']) ?>">
                <?php echo get_the_post_thumbnail($post['ID'], 'full'); ?>
                <h4 class="post_list_title"><?php echo $post['post_title'] ?></h4>
            </a>
        </li><?php
    endforeach; wp_reset_query(); 

	echo '</div></div>';
}

add_action( 'login_enqueue_scripts', 'BEEECH_login' );
add_action( 'login_header', 'BEECH_left_panel');
add_action( 'login_footer', 'BEECH_right_panel');