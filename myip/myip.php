<?php
/*
* Plugin Name: MY-IP
* Description: A plugin to find your IP location by tech ustaad
* Version: 1.0
* Author: Zeehsan Ali
* License: GPL2
*/
if(!defined('ABSPATH')):
    die("You cannot access this file directory");
endif;
register_activation_hook(__FILE__, 'plugin_activate');
register_deactivation_hook(__FILE__, 'plugin_deactivate');
function plugin_activate()
{
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'myip_settings';
    $sql = "CREATE TABLE $table (
        `id` int(11) NOT NULL,
        `status` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ALTER TABLE $table
  ADD PRIMARY KEY (`id`);
  ALTER TABLE $table
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
    $wpdb->query($sql);
}
function plugin_deactivate()
{
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'myip_settings';
    $sql = "DROP TABLE $table";
    $wpdb->query($sql);
}
add_action('admin_head', 'replace_admin_menu_icons_css');
function replace_admin_menu_icons_css()
{
?>
    <style>
        .wp-menu-image.dashicons-before.dashicons-admin-generic::before {
            content: "\f118";
        }
    </style>
<?php
}
add_action('admin_menu', 'add_admin_page');
function add_admin_page()
{
    add_menu_page(
        'MyIp Dashboard',
        'MyIp',
        'manage_options',
        'my-plugin',
        'admin_page_html'
    );
}
?>

<?php
add_shortcode('display_myip_block', 'show_html_block');
function show_html_block()
{
    include "myip-container.php";
}



function admin_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    $default_tab = null;
    $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?> <div class="wrap">
        <?php
        echo "<h1 style='text-align:center !important;font-size:40px;color:#a20050 !important;padding:5px 0;font-weight:bold;line-height:3rem;'>Welcome to the My-Ip by Tech Ustaad</h1>";
        ?>
        <br>
        <h1><?php
            echo esc_html(get_admin_page_title());
            ?></h1>
        <nav class="nav-tab-wrapper">
            <a href="?page=my-plugin" class="nav-tab <?php
                                                        if ($tab === null) :
                                                        ?>nav-tab-active<?php
                                                                    endif;
                                                                        ?>">Home</a>
            <a href="?page=my-plugin&tab=settings" class="nav-tab <?php if ($tab === 'settings') : ?>nav-tab-active<?php
                                                                                                                endif;
                                                                                                                    ?>
             ">Settings</a>
            <a href="?page=my-plugin&tab=tools" class="nav-tab <?php if ($tab === 'tools') : ?>nav-tab-active<?php endif; ?>">Tools</a>
        </nav>
        <div class="tab-content">
            <?php
            switch ($tab):
                case 'settings': {
            ?>
                        <form class="woocommerce-EditAccountForm edit-account" action="" method="post">
                            <h3>General Settings</h3>
                            <p><label for="ip" style="font-size: 14px; margin-right: 5px;">Show Ip Address:</label> <input id="ip" type="checkbox" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="country" style="font-size: 14px; margin-right: 5px;">Show Country Name: </label><input type="checkbox" id="country" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="city" style="font-size: 14px; margin-right: 5px;">Show City Name:</label> <input type="checkbox" id="city" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="timeZone" style="font-size: 14px; margin-right: 5px;">Show TimeZone:</label> <input type="checkbox" id="timeZone" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="region" style="font-size: 14px; margin-right: 5px;">Show Region Name:</label> <input type="checkbox" id="region" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="postal" style="font-size: 14px; margin-right: 5px;">Show Postal Code:</label> <input type="checkbox" id="postal" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="isp" style="font-size: 14px; margin-right: 5px;">Show ISP Organization:</label> <input type="checkbox" id="isp" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="userAgent" style="font-size: 14px; margin-right: 5px;">Show User Agent:</label> <input type="checkbox" id="userAgent" name="mc4wp-subscribe" value="1" /></p>

                            <p><label for="hostName" style="font-size: 14px; margin-right: 5px;">Show Host Name:</label> <input type="checkbox" id="hostName" name="mc4wp-subscribe" value="1" /></p>
                            <br>
                            <button style="margin-top: 5px; padding: 8px 15px;color:#fff;border-radius: 3px;background:#135e96; border:1.5px solid #135e96;cursor: pointer;">Save Changes</button>
                        </form>
                    <?php
                        break;
                    }
                case 'tools': { ?>
                        <h2>Tools will be available soon...</h2>
                    <?php
                        break;
                    }
                default: {
                    ?>
                        <!-- <h2>Go to the settings tab to customize the options</h2> -->
                        <br>
                        <h2>Short Code</h2>
                        <label style="cursor: initial;">Copy the short code and paste it where you want to show the output</label>
                        <div style="width: 550px;display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; padding: 1rem 1.5rem; background: #fff; border-radius: 10px;" class="shortcode">
                            <input type="text" id="short_code" style="font-size: 25px;border: 0; outline: 0; background: transparent;" value="[display_myip_block]" readonly/>
                        <button id="btnCopy" style="padding: 5px 20px;font-size: 22px; color:#fff;border-radius: 3px;background:#135e96; border:1.5px solid #135e96;cursor: pointer;">Copy</button>
                        </div>
            <?php
                    }
                    break;
            endswitch;
            ?>
        </div>
    </div>
    <script>
        let text = document.getElementById("short_code");
        let btnCopy = document.getElementById("btnCopy");
        btnCopy.addEventListener("click",()=>{
            text.select();
  text.setSelectionRange(0, 99999);
  document.execCommand("copy");
  alert("Shortcode coppied !");
        });
    </script>
<?php
}
?>