<?php

namespace SmartWpPlugin\Hooks\Admin\Menu;
use SmartWpPlugin\Hooks\Admin\Setting;

/**
 * class Menu
 * @package SmartWpPlugin\Hooks\Admin\Menu
 * DESCRIPTION: Menu Class defines admin menu and pages and register hooks.
 */
class Menu
{
    public $menu;

    public $pages = array();

    public $subpages = array();

    /**
     * Menu register .
     * Create Pages and Register Hooks
     * Description: Registers Hooks/Filters
     */
    public function register()
    {
        $this->menu = new AdminMenuCommon();
        $this->setPages();
        $this->setSubpages();
        $this->menu->addPages($this->pages)->addSubPages($this->subpages)->register();
        add_action('init', array($this, 'tatwerat_startSession'), 1);
        add_filter('wp_nav_menu_objects', array($this, 'manage_menu_options'), 10, 2);
        add_filter('woocommerce_prevent_admin_access', '__return_false');
        add_filter('woocommerce_disable_admin_bar', '__return_false');
        add_action('admin_bar_menu',  array($this, 'add_all_node_ids_to_toolbar'), 99999);
    }

    /**
     * Menu setPages .
     * Menu Main Page Array
     * @return array
     * Description: Set Menu Pages
     */
    public function setPages()
    {

        $setting = new Setting();
        $this->pages = array(
            array(
                'page_title' => 'Smart WP Plugin',
                'menu_title' => 'Smart WP Plugin',
                'capability' => 'manage_options',
                'menu_slug' => 'smart-wp-plugin',
                'callback' => array($setting,'menu_page'),
                'icon_url' => 'dashicons-store',
                'position' => 2,
            ),
        );
    }

    /**
     * Menu setSubpages .
     * Menu Sub Pages Array
     * @return array
     * Description: Set Menu Sub Pages
     */
    public function setSubpages()
    {
        $setting = new Setting();
        $this->subpages = array(
            array(
                'parent_slug' => 'smart-wp-plugin', 
				'page_title' =>'Settings', 
				'menu_title' => 'Settings', 
				'capability' => 'manage_options', 
				'menu_slug' => 'settings', 
                'callback' => array($setting,'menu_page'),
            ),
        );
    }

    /**
     * Menu tatwerat_startSession .
     * Initlize Session for Alerts
     * Description: Start Session
     */
    public function tatwerat_startSession()
    {
        if (!session_status() === PHP_SESSION_ACTIVE || session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * manage_menu_options
     *
     * @param  mixed $items
     * @param  mixed $args
     * @return void
     * Description: Remove Menu Items
     */
    public function manage_menu_options($items, $args)
    {
        $post = get_post(get_setting_by_slug('login_page_id'));
        if ($items && count($items) > 0) {
            foreach ($items as $item) {
                if (is_user_logged_in()) {
                    if ($item->ID == get_setting_by_slug('login_page_id')) {
                        unset($item);
                    }
                    if ($item->ID == get_setting_by_slug('register_page_id')) {
                        unset($item);
                    }
                }
            }
        }

        return $items;
    }

    /**
     * add_all_node_ids_to_toolbar
     *
     * @param  mixed $wp_admin_bar
     * @return void
     * Description: Remove Extra Menu Items
     */
    public function add_all_node_ids_to_toolbar($wp_admin_bar)
    {
        $dashboard_link = admin_url();
        if (validate_customer()) {
            $dashboard_link = get_permalink(get_setting_by_slug('dashboard_page_id'));
            $wp_admin_bar->remove_node('updates');
            $wp_admin_bar->remove_node('comments');
            $wp_admin_bar->remove_node('new-content');
            $wp_admin_bar->remove_node('wp-logo');
            $wp_admin_bar->remove_node('site-name');
            $wp_admin_bar->remove_node('elementor_inspector');
            $wp_admin_bar->remove_node('elementor_beta_secondary_report_issue');
            $wp_admin_bar->remove_node('elementor_beta_secondary_report_issue');
        }
        if (validate_employee()) {
            $dashboard_link = get_permalink(get_setting_by_slug('employee_dashboard_page_id'));
        }
        if (validate_admin()) {
            $dashboard_link = get_permalink(get_setting_by_slug('admin_dashboard_page_id'));
        }
        $wp_admin_bar->add_menu(array('id' => 'dashboard-link',  'title' => '<span class="ab-icon dashicons dashicons-dashboard"></span>' . __('Dashboard'), 'href' => $dashboard_link));
        $wp_admin_bar->remove_node('search');
        $wp_admin_bar->remove_node('customize');
    }
}
