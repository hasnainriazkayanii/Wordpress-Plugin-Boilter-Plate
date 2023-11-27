<?php

namespace SmartWpPlugin\Controllers\Admin;

use SmartWpPlugin\Controllers\MainController;
use SmartWpPlugin\Repositories\GlobalConfigrationRepository;
use SmartWpPlugin\Requests\Admin\Settings\AddEmailSettings;



/**
 * class SettingController
 * @package SmartWpPlugin\Controllers\Admin
 * DESCRIPTION: Setting Screen Controller interacts with Bussniess layer
 */
class SettingController extends MainController
{
    private $setting = 'smart-booking-settings';

    public function __construct()
    {
        parent::__construct();
        $this->GlobalConfigrationRepository = new GlobalConfigrationRepository();
        $this->AddEmailSettings = new AddEmailSettings();
    }


    /**
     * list_settings
     *
     * @return void
     * Description: List All Settings
     */
    public function list_settings()
    {
      
        $this->enqueue();
        $GlobalConfigrations = $this->extract_data($this->GlobalConfigrationRepository->list_settings());
       
        $data['pages'] = $this->extract_data($this->GlobalConfigrationRepository->list_pages());
        $email_settings = $this->extract_data($this->GlobalConfigrationRepository->list_email_settting());
        if($email_settings){
            $data['email_settings'] = json_decode($email_settings->value);
        }
        $def_appointment_status = 'Approved';
        $advance_booking = '';

        if ($GlobalConfigrations && count($GlobalConfigrations) > 0) {
            foreach ($GlobalConfigrations as $GlobalConfigration) {
                if ($GlobalConfigration->key_name == 'default_appointment_status') {
                    $def_appointment_status = $GlobalConfigration->value;
                }
                if ($GlobalConfigration->key_name == 'advance_booking') {
                    $advance_booking = $GlobalConfigration->value;
                }
            }
        }

        $data['advance_booking'] = $advance_booking;
        $data['def_appointment_status'] = $def_appointment_status;
        return $this->view('admin/settings/index', $data);
    }


    /**
     * save_global_setting
     *
     * @return void
     * Description: Save  Global Basic Settings
     */
    public function save_global_setting()
    {

        $id = $this->GlobalConfigrationRepository->save_global_setting($_POST);

        if ($id['status']) {
            $this->transcation_completed('Global Setting Saved Successfully', 'success');
        } else {
            $this->transcation_completed('Changes Saved Failed', 'error');
        }
        $this->redirect_back();
    }


    

    
    /**
     * adding specfic page scripts
     *
     * @return void
     */
    public function enqueue()
    {
        wp_enqueue_media();
        wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', FALSE, '1.11.0', TRUE);
        wp_enqueue_script('jquery');
        wp_enqueue_script('smart-wp-plugin-admin-settings', $this->plugin_url . 'assets/js/admin/setting/index.js', false, true);
    }
        
    /**
     * save_email_settings
     * @return void
     * Description: Save Email Settings
     */
    public function save_email_settings()
    {
        if ($this->AddEmailSettings->validate_fields($_POST, $_FILES)) {
            $v_errors = $this->AddEmailSettings->fields_errors();
            $this->set_erros($v_errors);
            wp_redirect(wp_get_referer());
            die();
        }
        $id = $this->GlobalConfigrationRepository->save_email_settings($_POST);
        if ($id['status']) {
            $this->transcation_completed('Email Settings Saved Successfully', 'success');
        } else {
            $this->transcation_completed('Changes Saved Failed', 'error');
        }
        $this->redirect_back();
    }
}
