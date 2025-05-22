<?php

function BEECH_login_admin_page() { 
	// jQuery
	wp_enqueue_script('jquery');
	// This will enqueue the Media Uploader script
	wp_enqueue_media();
	?>   
	<style>
		.form-table img {
			max-width: 220px;
			width: 100%;
			display: block;
			margin-bottom: 20px;
		}
		.BEECH-preview-image {
			background: rgb(255,179,11);
			background: linear-gradient(145deg, rgba(255,179,11,0.1) 0%, rgba(0,0,0,0.1) 100%);
		}
		table.form-table {
			margin-top: 0;
		}
		.form-table td > div {
			padding-bottom: 30px;
		}
		

		* {box-sizing: border-box}

		.tab-menu ul, .tab-menu li {
			margin: 0;
			padding: 0;
		}

		.tab-list {
			margin-top: 20px; 

			background-color: #F9F9F9;
			border: 1px solid #c3c4c7;

			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			align-content: stretch;
			justify-content: flex-start;
			align-items: stretch;
		}
		.tab-body-container {
			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			align-content: stretch;
			justify-content: flex-start;
			align-items: stretch;
			width: 100%;
		}
		.tab-menu {
			max-width: 180px;
		}

		/* Style the tab */
		.tab {
			/*border: 1px solid #ccc;*/
			background-color: #F9F9F9;
			width: 100%;
		}

		/* Style the buttons that are used to open the tab content */
		.tab button {
			display: block;
			background-color: inherit;
			color: #0073aa;
			padding: 25px 20px;
			width: 100%;
			border: none;
			outline: none;
			text-align: left;
			cursor: pointer;
			transition: 0.3s;

			border-bottom: 1px solid #DFDFDF;
			border-right: 1px solid transparent;

			position: relative;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: white;
		}

		/* Create an active/current "tab button" class */
		.tab button.active {
			background-color: white;
			color: black;
			border-right: 1px solid white;
		}
		.tab button::after {content: "";position: absolute;top: 0;bottom: 0;border: transparent 1px solid;right: -3px;}
		.tab button.active::after {content: "";position: absolute;top: 0;bottom: 0;border: white 1px solid;right: -3px;}
		.tab p.submit { text-align: center; }
		.tab p.submit input { padding: 7px 15px; }

		/* Style the tab content */
		.tab-content {
			padding: 0px 0px;
			/*border: 1px solid #ccc;*/
			width: 100%;
			border-left: 1px solid #DFDFDF;
			background-color: #ffffff;
		}
		.tab-content h2 {
			border-bottom: 1px solid #DFDFDF;
			padding: 15px 20px;
			margin-top: 0px;
			margin-bottom: 10px;
		}
		.form-table tr {
			border-bottom: 1px solid #DFDFDF;
		}
		.form-table tr:last-child {
			border-bottom: 1px solid transparent;
		}
		.form-table tr td, .form-table tr th {
			padding: 25px 20px;
		}
		th span.light {
			display: block;
			font-weight: 300;
			margin-top: 10px;
			font-size: 0.9em;
		}
		.form-table input[type=radio] + input[type=radio] {
			margin-left: 1rem;
		}
	</style>
	<div class="wrap">
		<h1 class="wp-heading-inline">BEECH Login Page</h1> 
		<div class="card">
			<p>Hello! You can update your login screen and other bits and pieces from here.</p>
		</div>
		<form method="post" action="options.php">
		<?php settings_fields( 'BEECH-login-screen-settings' ); ?>
		<?php do_settings_sections( 'BEECH-login-screen-settings' ); ?>
		<div class="tab-list">
			<div class="tab-menu tab">
				<ul>
					<li><button class="tab-link active" onclick="openTab(event, 'BEECH-tab1');" >Login Page Images</button></li>
					<li><button class="tab-link" onclick="openTab(event, 'BEECH-tab2');" >Login Page Options</button></li>
					<li><button class="tab-link" onclick="openTab(event, 'BEECH-tab3');" >Homepage Message</button></li>
					<li id="extrasTab" style="display: none;"><button class="tab-link" onclick="openTab(event, 'BEECH-tab4');" >Extras</button></li>
					<li><?php submit_button(); ?></li>
				</ul>
			</div>
			<div class="tab-body-container">
				<div class="tab-content active" id="BEECH-tab1">	
					<h2>Login Page - Images</h2>			
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Login Logo Image<!--<br ><span class="light">Your logo.</span>--></th>
							<td >
								<div>
									<img src="<?php echo get_option( 'BEECH_login_screen_brand_image' ); ?>" class="BEECH-preview-image" />
									<input type="text" 
										name="BEECH_login_screen_brand_image" 
										id="BEECH_login_screen_brand_image" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_screen_brand_image' ); ?>"
										/>
									<input type="button" name="upload-btn2" id="upload-btn2" class="button-secondary" value="Select Image">
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Left Image <span class="light">Can be left blank.</span></th>
							<td>
								<div>
									<img src="<?php echo get_option( 'BEECH_login_screen_background_texture' ); ?>" class="BEECH-preview-image" />
									<!--<label for="BEECH_login_screen_background_texture">Select Image</label>-->
									<input type="text" 
										name="BEECH_login_screen_background_texture" 
										id="BEECH_login_screen_background_texture" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_screen_background_texture' ); ?>"
										/>
									<input type="button" name="upload-btn" id="upload-btn3" class="button-secondary" value="Select Image">
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Right Image</th>
							<td>
								<div>
									<img src="<?php echo get_option( 'BEECH_login_screen_background_image' ); ?>" class="BEECH-preview-image" />
									<!--<label for="BEECH_login_screen_background_image">Select Image</label>-->
									<input type="text" 
										name="BEECH_login_screen_background_image" 
										id="BEECH_login_screen_background_image" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_screen_background_image' ); ?>"
										/>
									<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Select Image">
								</div>
							</td>
						</tr>
						
						
					</table>
				</div>
				<div class="tab-content" id="BEECH-tab2" style="display: none;">
					<h2>Login Page - Options</h2>
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Primary Colour <span class="light">If using a hex, include the hash.</span></th>
							<td>
								<div>
									<input type="color" 
										name="BEECH_login_screen_primary_color" 
										id="BEECH_login_screen_primary_color" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_screen_primary_color' ); ?>"
										/>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Secondary Colour <span class="light">If using a hex, include the hash.</span></th>
							<td>
								<div>
									<input type="color" 
										name="BEECH_login_screen_secondary_color" 
										id="BEECH_login_screen_secondary_color" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_screen_secondary_color' ); ?>"
										/>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Left Background Style <span class="light">Advanced - Background CSS property string</span></th>
							<td>
								<div>
									<input type="text" 
										name="BEECH_login_left_background_style" 
										id="BEECH_login_left_background_style" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_left_background_style' ); ?>"
									/>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Only display the Background on the body<span class="light">True or false, makes the background image stretch under the left side.</span></th>
							<td>
                                <input type="radio" name="BEECH_login_background_full_only" value="1" <?php checked( '1', get_option( 'BEECH_login_background_full_only' ) ); ?> /> Yes
                                <input type="radio" name="BEECH_login_background_full_only" value="0" <?php checked( '0', get_option( 'BEECH_login_background_full_only' ) ); ?> /> No
							</td>
						</tr>
						</tr>
                        <tr valign="top">
							<th scope="row">Invert Logo <span class="light">Invert the logo and footer text.</span></th>
							<td>
                                <input type="radio" name="BEECH_login_invert_logo" value="1" <?php checked( '1', get_option( 'BEECH_login_invert_logo' ) ); ?> /> Yes
                                <input type="radio" name="BEECH_login_invert_logo" value="0" <?php checked( '0', get_option( 'BEECH_login_invert_logo' ) ); ?> /> No
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row">Hide Language Switcher <span class="light">It's big and unnecessary for most people.</span></th>
							<td>
                                <input type="radio" name="BEECH_login_hide_language_switcher" value="1" <?php checked( '1', get_option( 'BEECH_login_hide_language_switcher' ) ); ?> /> Yes
                                <input type="radio" name="BEECH_login_hide_language_switcher" value="0" <?php checked( '0', get_option( 'BEECH_login_hide_language_switcher' ) ); ?> /> No
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row">Display Latest Posts on Login Page <span class="light">Displays the latest posts on the login page - because why not?</span></th>
							<td>
                                <input type="radio" name="BEECH_login_posts_on_login_page" value="1" <?php checked( '1', get_option( 'BEECH_login_posts_on_login_page' ) ); ?> /> Yes
                                <input type="radio" name="BEECH_login_posts_on_login_page" value="0" <?php checked( '0', get_option( 'BEECH_login_posts_on_login_page' ) ); ?> /> No
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Login Page Custom CSS<span class="light">Add CSS if you dare. This can break everything.</span></th>
							<td>
								<div>
									<textarea 
										name="BEECH_login_background_custom_css" 
										id="BEECH_login_background_custom_css" 
										class="regular-text"
										rows="12"
									><?php echo get_option( 'BEECH_login_background_custom_css' ); ?></textarea>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="tab-content" id="BEECH-tab3" style="display: none;"><h2>Homepage Message</h2>
					<table class="form-table">
                        <tr valign="top">
							<th scope="row">Display Message Box <span class="light">Displays the message box on the dashboard.</span></th>
							<td>
                                <input type="radio" name="BEECH_login_display_message_box" value="1" <?php checked( '1', get_option( 'BEECH_login_display_message_box' ) ); ?> /> Yes
                                <input type="radio" name="BEECH_login_display_message_box" value="0" <?php checked( '0', get_option( 'BEECH_login_display_message_box' ) ); ?> /> No
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Documentation link <span class="light">What is the link to the PDF or Notion site for this website?</span></th>
							<td>
								<div>
									<input type="text" 
										name="BEECH_login_documentation_link" 
										id="BEECH_login_documentation_link" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_documentation_link' ); ?>"
										/>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Custom Message <span class="light">Change the message in the message box.</span></th>
							<td>
								<div>
									<textarea type="text" 
										name="BEECH_login_message_box_custom_message" 
										id="BEECH_login_message_box_custom_message" 
										class="regular-text"
									><?php print get_option( 'BEECH_login_message_box_custom_message' ); ?></textarea>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="tab-content" id="BEECH-tab4" style="display: none;"><h2>Extra Settings and Fun Stuff</h2>
					<table class="form-table">
                        <tr valign="top">
							<th scope="row">Healthcheck API Token
								<span class="light">Token from the site to be able to check the health of the site</span>
							</th>
							<td>
								<div>
									<input type="text" 
										name="BEECH_login_healthcheck_token" 
										id="BEECH_login_healthcheck_token" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_healthcheck_token' ); ?>"
										/>
								</div>
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row">Partnership primary logo
								<span class="light">Replace the Beech logo with someone else?</span>
							</th>
							<td>
								<div>
									<img src="<?php echo get_option( 'BEECH_login_screen_partnership_logo' ); ?>" class="BEECH-preview-image" />
									<input type="text" 
										name="BEECH_login_screen_partnership_logo" 
										id="BEECH_login_screen_partnership_logo" 
										class="regular-text"
										value="<?php echo get_option( 'BEECH_login_screen_partnership_logo' ); ?>"
										/>
									<input type="button" name="upload-btn4" id="upload-btn4" class="button-secondary" value="Select Image">
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Partnership Message <span class="light">Replace the little Beech bit on the login page.</span></th>
							<td>
								<div>
									<textarea type="text" 
										name="BEECH_login_screen_partnership_message" 
										id="BEECH_login_screen_partnership_message" 
										class="regular-text"
										rows="4"
									><?php print get_option( 'BEECH_login_screen_partnership_message' ); ?></textarea>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>

			
		</form>
		

		<script type="text/javascript">
			jQuery(document).ready(function($){
				var params = new URLSearchParams(window.location.search);
				var extras = params.get('displayextraoptions');

				if(extras) {
					jQuery('#extrasTab').fadeIn();
				}
				$('#upload-btn').click(function(e) {
					e.preventDefault();
					var image = wp.media({ 
						title: 'Upload Image',
						// mutiple: true if you want to upload multiple files at once
						multiple: false
					}).open()
					.on('select', function(e){
						// This will return the selected image from the Media Uploader, the result is an object
						var uploaded_image = image.state().get('selection').first();
						// We convert uploaded_image to a JSON object to make accessing it easier
						// Output to the console uploaded_image
						console.log(uploaded_image);
						var image_url = uploaded_image.toJSON().url;
						// Let's assign the url value to the input field
						$('#BEECH_login_screen_background_image').val(image_url);
					});
				});
			});
			jQuery(document).ready(function($){
				$('#upload-btn2').click(function(e) {
					e.preventDefault();
					var image = wp.media({ 
						title: 'Upload Image',
						// mutiple: true if you want to upload multiple files at once
						multiple: false
					}).open()
					.on('select', function(e){
						// This will return the selected image from the Media Uploader, the result is an object
						var uploaded_image = image.state().get('selection').first();
						// We convert uploaded_image to a JSON object to make accessing it easier
						// Output to the console uploaded_image
						console.log(uploaded_image);
						var image_url = uploaded_image.toJSON().url;
						// Let's assign the url value to the input field
						$('#BEECH_login_screen_brand_image').val(image_url);
					});
				});
			});
			jQuery(document).ready(function($){
				$('#upload-btn3').click(function(e) {
					e.preventDefault();
					var image = wp.media({ 
						title: 'Upload Image',
						// mutiple: true if you want to upload multiple files at once
						multiple: false
					}).open()
					.on('select', function(e){
						// This will return the selected image from the Media Uploader, the result is an object
						var uploaded_image = image.state().get('selection').first();
						// We convert uploaded_image to a JSON object to make accessing it easier
						// Output to the console uploaded_image
						console.log(uploaded_image);
						var image_url = uploaded_image.toJSON().url;
						// Let's assign the url value to the input field
						$('#BEECH_login_screen_background_texture').val(image_url);
					});
				});
			});
			jQuery(document).ready(function($){
				$('#upload-btn4').click(function(e) {
					e.preventDefault();
					var image = wp.media({ 
						title: 'Upload Image',
						// mutiple: true if you want to upload multiple files at once
						multiple: false
					}).open()
					.on('select', function(e){
						// This will return the selected image from the Media Uploader, the result is an object
						var uploaded_image = image.state().get('selection').first();
						// We convert uploaded_image to a JSON object to make accessing it easier
						// Output to the console uploaded_image
						console.log(uploaded_image);
						var image_url = uploaded_image.toJSON().url;
						// Let's assign the url value to the input field
						$('#BEECH_login_screen_partnership_logo').val(image_url);
					});
				});
			});

			function openTab(evt, tabName) {
				evt.preventDefault();
				// Declare all variables
				var i, tabcontent, tablinks;

				// Get all elements with class="tabcontent" and hide them
				tabcontent = document.getElementsByClassName("tab-content");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}

				// Get all elements with class="tablinks" and remove the class "active"
				tablinks = document.getElementsByClassName("tab-link");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}

				// Show the current tab, and add an "active" class to the link that opened the tab
				document.getElementById(tabName).style.display = "block";
				evt.currentTarget.className += " active";
				}
		</script>
	</div>
<?php } 

add_action( 'admin_menu', 'BEECH_login_admin_menu' );  

/*
	Use the media library
*/

// UPLOAD ENGINE
function load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );