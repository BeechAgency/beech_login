<?php
    if( get_option( 'BEECH_login_display_message_box' ) ) {
        add_action( 'wp_dashboard_setup', 'register_BEECH_dashboard_widget' );
    }
    
    function register_BEECH_dashboard_widget() {

        wp_add_dashboard_widget(
            'BEECH_dashboard_widget',
            'BEECH - Documentaton and Links',
            'BEECH_dashboard_widget_display'
        );
    }

    function BEECH_dashboard_widget_display() {
        $docs_url = get_option('BEECH_login_documentation_link');
        $custom_message = get_option('BEECH_login_message_box_custom_message');
        ?>
            <div style="
                    display: flex;
                    flex-direction: row;
                    flex-wrap: nowrap;
                    align-content: stretch;
                    justify-content: space-between;
                    align-items: flex-start;
                ">
                <div>
                    <p><strong>Hi! Thanks again for working with us here at BEECH.</strong></p> 
                    <?= $custom_message; ?>
                    <p><?php if($docs_url):?>You can easily access your sites guide and documentation by clicking the button below. <?php endif; ?>If you get stuck, we're here to help. Call 02 4049 9136 or email <a href="mailto:hi@beech.agency">hi@beech.agency</a></p>
                    <?php if($docs_url):?><p><a href="<?= $docs_url ?>" target="_Blank" class="button button-primary">View Guide</a></p><?php endif; ?>
                </div>
                <img src="https://uploads-ssl.webflow.com/5f02c38ee45cb86d8770ecf2/5f33ee2351b51ae18bf03192_Untitled-1.svg" style="max-width: 100px; padding-left: 25px; padding-top: 1em;" />
            </div>
        <?php
    }


    /* Removing Wordpress Dahboard Widgets to make it simpler ---------------------------**/

    function remove_dashboard_widgets() {
        global $wp_meta_boxes;

        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
        //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        //remove_action('welcome_panel', 'wp_welcome_panel');
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
        remove_meta_box( 'themefusion_news', 'dashboard', 'normal');

    }

    add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

    