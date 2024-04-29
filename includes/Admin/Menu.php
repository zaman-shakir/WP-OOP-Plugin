<?php

namespace WPlgoic\Dev\Admin;

/**
 * The Menu handler class
 */
class Menu
{

    public $addressbook;

    /**
     * Initialize the class
     */
    function __construct($addressbook)
    {
        $this->addressbook = $addressbook;

        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu()
    {
        $parent_slug = 'wplgoic';
        $capability = 'manage_options';

        add_menu_page(__('weDevs Academy', 'wplgoic'), __('Academy', 'wplgoic'), $capability, $parent_slug, [$this->addressbook, 'plugin_page'], 'dashicons-welcome-learn-more');
        add_submenu_page($parent_slug, __('Address Book', 'wplgoic'), __('Address Book', 'wplgoic'), $capability, $parent_slug, [$this->addressbook, 'plugin_page']);
        add_submenu_page($parent_slug, __('Settings', 'wplgoic'), __('Settings', 'wplgoic'), $capability, 'wplgoic-settings', [$this, 'settings_page']);
    }

    /**
     * Handles the settings page
     *
     * @return void
     */
    public function settings_page()
    {
        echo 'Settings Page';
    }
}
