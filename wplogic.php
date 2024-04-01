<?php

/**
 * Plugin Name: WpLgoic
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

final class WPlgoic
{
    const version = '1.0';

    private function __construct()
    {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    public function define_constants()
    {
        define('WPlgoic_VERSION', self::version);
        define('WPlgoic_FILE', __FILE__);
        define('WPlgoic_PATH', __DIR__);
        define('WPlgoic_URL', plugins_url('', WPlgoic_FILE));
        define('WPlgoic_ASSETS', WPlgoic_URL . '/assets');
    }
    public function activate()
    {
        $installed = get_option('wplgoic_installed');

        if (!$installed) {
            update_option('wplgoic_installed', time());
        }

        update_option('wplgoic_version', WPlgoic_VERSION);
    }
    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {

        if (is_admin()) {
            new WPlgoic\Admin();
        } else {
            new WPlgoic\Frontend();
        }
    }
    /**
     * Initializes a singleton instance
     *
     * @return \WPlgoic
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }
}
/**
 * Initializes the main plugin
 *
 * @return \WPlgoic
 */
function wplgoic()
{
    return WPlgoic::init();
}

// kick-off the plugin
wplgoic();
