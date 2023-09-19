<?php
/*
 * Plugin Name:       Wp Demo Admin Notice
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rezwanul Haque
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wdan
 * Domain Path:       /languages
 */
if (!defined('ABSPATH')) {
   exit;
}
function wdan_load_my_plugin_translation()
{
   load_plugin_textdomain('your-plugin-textdomain', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'wdan_load_my_plugin_translation');



add_action('admin_notices', 'wdan_custom_admin_notice');
function wdan_custom_admin_notice()
{
   global $pagenow;
   if (!(isset($_COOKIE['dc-close']) && $_COOKIE['dc-close'] == 1)) {
      if (in_array($pagenow, ['plugins.php'])) {
         $remote_notice = wp_remote_get('example.come');
         $remote_body = wp_remote_retrieve_body($remote_notice);
         // if ($remote_body !== "") {
?>
            <div id="wdan_notice_success" class="notice notice-success is-dismissible">
               <p>Hey,Here is notice for you </p>
               <!-- <p><?php echo $remote_body; ?></p> -->
            </div>
<?php
         // }
      }
   }
}

add_action('admin_enqueue_scripts', 'wdan_enqueue_files');

function wdan_enqueue_files()
{
   wp_enqueue_script('wdan_enqueue_js', plugin_dir_url(__FILE__) . 'inc/notice.js', array('jquery'), time(), true);
}
