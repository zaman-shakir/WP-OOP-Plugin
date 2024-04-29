<?php

namespace WPlgoic\Dev\Admin;

/**
 * Addressbook Handler class
 */
class Addressbook
{

    /**
     * Plugin page handler
     *
     * @return void
     */
    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;

            case 'edit':
                $template = __DIR__ . '/views/address-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/address-view.php';
                break;

            default:
                $template = __DIR__ . '/views/address-list.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Handle the form
     *
     * @return void
     */
    public function form_handler()
    {

        if (!isset($_POST['new_submit_address'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'new-address')) {
            wp_die('Are you cheating?');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }


        $id      = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $address = isset($_POST['address']) ? sanitize_textarea_field($_POST['address']) : '';
        $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

        if (empty($name)) {
            $this->errors['name'] = __('Please provide a name', 'wplgoic');
        }

        if (empty($phone)) {
            $this->errors['phone'] = __('Please provide a phone number.', 'wplgoic');
        }

        if (!empty($this->errors)) {
            return;
        }

        $args = [
            'name'    => $name,
            'address' => $address,
            'phone'   => $phone
        ];

        if ($id) {
            $args['id'] = $id;
        }

        $insert_id = wd_ac_insert_address($args);

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }

        if ($id) {
            $redirected_to = admin_url('admin.php?page=wplgoic&action=edit&address-updated=true&id=' . $id);
        } else {
            $redirected_to = admin_url('admin.php?page=wplgoic&inserted=true');
        }

        wp_redirect($redirected_to);
        exit;
    }
}
