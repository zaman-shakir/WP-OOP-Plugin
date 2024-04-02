<?php


/**
 * Plugin Name: WpLgoic Dev
 * Description: A tutotial plugin to understand how oop works
 * Plugin URI: https://zaman-shakir.xyz
 * Author: Shakir
 * Author URI: https://zaman-shakir.xyz
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!defined('ABSPATH')) {
    exit;
}
require_once __DIR__ . '/vendor/autoload.php';

final class WPlgoic_Dev
{
    const version = '1.0';

    private function __construct()
    {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        // require_once(WPlgoic_DEV_PATH . '/includes/Admin.php');
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    public function define_constants()
    {
        define('WPlgoic_DEV_VERSION', self::version);
        define('WPlgoic_DEV_FILE', __FILE__);
        define('WPlgoic_DEV_PATH', __DIR__);
        define('WPlgoic_DEV_URL', plugins_url('', WPlgoic_DEV_FILE));
        define('WPlgoic_DEV_ASSETS', WPlgoic_DEV_URL . '/assets');
    }
    public function activate()
    {

        $installed = get_option('wplgoic_dev_installed');

        if (!$installed) {
            update_option('wplgoic_dev_installed', time());
        }

        update_option('wplgoic_dev_version', WPlgoic_DEV_VERSION);
    }
    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {

        if (is_admin()) {
            new WPlgoic\Dev\Admin();
        } else {
            // new WPlgoic\Frontend();
        }
    }

    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }
}

function wplgoic_dev()
{
    return WPlgoic_Dev::init();
}

// kick-off the plugin
wplgoic_dev();
