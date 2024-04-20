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
        $parent_slug = 'wplgoic';
        $capability = 'manage_options';
        add_menu_page(__('WPlgoic', 'wplgoic'), __('WPlgoic Section', 'wplgoic'), 'manage_options', 'wplgoic', [$this, 'plugin_page'], 'dashicons-welcome-learn-more');
        add_submenu_page($parent_slug, __('Address Book', 'wplgoic'), __('Address Book', 'wplgoic'), $capability, $parent_slug, [$this, 'addressbook_page']);
        add_submenu_page($parent_slug, __('Settings', 'wplgoic'), __('Settings', 'wplgoic'), $capability, 'wplgoic-settings', [$this, 'settings_page']);
    }
    /**
     * Render the plugin page
     *
     * @return void
     */
    public function addressbook_page()
    {
        $addressbook = new Addressbook();
        $addressbook->plugin_page();
    }
    public function plugin_page()
    {
        echo 'Settings Page';
    }
}
