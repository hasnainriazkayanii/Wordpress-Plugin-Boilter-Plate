<?php 
namespace SmartWpPlugin\Hooks\Admin;
use SmartWpPlugin\Controllers\Admin\SettingController;

/**
 * class Setting
 * @package SmartWpPlugin\Hooks\Admin
 * DESCRIPTION: Setting Class  register hooks/actions/filters.
 */
class Setting
{
   /**
     * register
     *
     * @return void
     * Description: Registers Hooks/Filters
     */
    public function register()
    {
        $SettingController = new SettingController();
        add_shortcode('smart-wp-plugin-admin-setting',array($SettingController,'list_settings'));
        add_action('admin_post_globalsetting-save', array($SettingController,'save_global_setting'));
        add_action('admin_post_emailsetting-save',array($SettingController,'save_email_settings'));
        
    }

     /**
     * menu_page
     *
     * @return void
     * Description: Get All Settings
     */
    public function menu_page()
    {
        $SettingController = new SettingController();
        $SettingController->list_settings();
    }
}