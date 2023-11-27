<?php

namespace SmartWpPlugin\Core;

/**
 * class Deactivate
 * @package SmartWpPlugin\Core
 * DESCRIPTION: Enqueue styles and scripts
 */
class Enqueue
{
    public function __construct()
    {

        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)) . '/smart-wp-plugin.php';
    }
    
    /**
     * register
     *
     * @return void
     *  Description: Regsiter Wordpress Action and Hooks
     */
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'load_media_files'));
        add_action( 'wp_enqueue_scripts',  array($this,'front_end_scripts') );
    }
    
    /**
     * enqueue
     *
     * @return void
     * Description: Enque Styles and Scripts
     */
    public function enqueue()
    {
        wp_enqueue_style('smart-booking-style', $this->plugin_url . 'assets/css/admin/styles.css');
        wp_enqueue_script('smart-booking-custom', $this->plugin_url . 'assets/js/custom.js');
       
    }
        
    /**
     * load_media_files
     *
     * @return void
     * Description: Add Wordpress Media
     */
    public function load_media_files()
    {
        wp_enqueue_media();
    }
    
    /**
     * front_end_scripts
     *
     * @return void
     * Description: Enque Styles and Scripts on front end
     */
    public function front_end_scripts(){
    }

}