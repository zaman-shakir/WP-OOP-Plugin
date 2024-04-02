<?php


namespace WPlgoic\Dev\Admin;

class Menu
{

    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu()
    {
        //add_menu_page(__('weDevs Academy', 'wedevs-academy'), __('Academy', 'wedevs-academy'), 'manage_options', 'wedevs-academy', [$this, 'plugin_page'], 'dashicons-welcome-learn-more');
        add_menu_page(__('WPlgoic', 'wplgoic'), __('WPlgoic M', 'wplgoic'), 'manage_options', 'wplgoic', [$this, 'plugin_page'], 'dashicons-welcome-learn-more');
    }

    public function plugin_page()
    {
        echo 'Hello World';
    }
}
