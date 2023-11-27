<?php

namespace SmartWpPlugin\Repositories;

use SmartWpPlugin\Models\GlobalConfigrationModel;
use SmartWpPlugin\Models\PageModel;
use SmartWpPlugin\Repositories\AbstractRepository;
use SmartWpPlugin\Requests\Admin\Settings\AddEmailSettings;

/**
 * class EmployeeWorkHourRepository
 * @package SmartWpPlugin\Repositories
 * DESCRIPTION: EmployeeWorkHourRepository Service Layer.
 */
class GlobalConfigrationRepository extends AbstractRepository
{

    private $pages_keys = [
       
        'admin_dashboard_page_id' => array(
            'name' => 'Up Next Admin Dashboard',
            'content' => '[smart-wp-plugin-admin-setting]',
            'template' => 'templates/admin_dashboard.php',
        ),

    ];
    private $email_settings_key = 'email-settings';
    public function __construct()
    {

        $this->GlobalConfigrationModel = new GlobalConfigrationModel();
        $this->PageModel = new PageModel();
        $this->AddEmailSettings = new AddEmailSettings();
    }

    /**
     * list_settings
     *
     * @return void
     * Description: List All
     */
    public function list_settings()
    {
        return $this->send_response($this->GlobalConfigrationModel->list_settings());
    }

    /**
     * GlobalConfigrationRepository save .
     * @param array $data
     * @return int id
     *  Description: Save
     */
    public function save($data)
    {
        return $this->GlobalConfigrationModel->save($data);
    }

    /**
     * GlobalConfigrationRepository update .
     * @param int $id
     * @param array $data
     * @return int id
     * Description: Update
     */
    public function update($id, $data)
    {
        return $this->send_response($this->GlobalConfigrationModel->updation($id, $data));
    }

    /**
     * GlobalConfigrationRepository save_global_setting .
     * @return ALert success/error
     * Description: Save Global Settings
     */
    public function save_global_setting($params)
    {

        if (isset($params['action'])) {
            unset($params['action']);
        }
        foreach ($params as $data_array) {
            $isExisiting = false;
            $value = $data_array;
            $key = array_search($data_array, $params);
            $data = array(
                $key => $value,
            );
            $isExisiting = $this->GlobalConfigrationModel->get_key_name($key);
            if ($isExisiting) {
                $id = $this->update($isExisiting->configuration_id, $data);
            } else {
                $id = $this->save($data);
            }
            if ($id) {
                if (isset($this->pages_keys[$key])) {
                    if (isset($this->pages_keys[$key]['template'])) {
                        $this->PageModel->update_page($value, $this->pages_keys[$key]['name'], $this->pages_keys[$key]['content'], $this->pages_keys[$key]['template']);
                    } else {
                        $this->PageModel->update_page($value, $this->pages_keys[$key]['name'], $this->pages_keys[$key]['content']);
                    }
                }
            }
        }
        return $this->send_response(array('setting_id' => $id));
    }

    /**
     * GlobalConfigrationRepository get_key_name.
     * @param int $id
     * @return object
     * Description: Get By Unqiue Key
     */
    public function get_key_name($val)
    {
        $GlobalConfigrationModel = new GlobalConfigrationModel();
        return $this->send_response($GlobalConfigrationModel->get_key_name($val));
    }
    /**
     * list_pages
     *
     * @return void
     *  Description: List All Wordpress Pages
     */
    public function list_pages()
    {
        return $this->send_response($this->PageModel->list_pages());
    }




    

    /**
     * list_qucikbooks_settting
     *
     * @return void
     */
    public function list_email_settting()
    {
        return $this->send_response($this->GlobalConfigrationModel->get_key_name($this->email_settings_key));
    }



    

    
    /**
     * save_email_settings
     *
     * @param  mixed $params
     * @return void
     */
    public function save_email_settings($params){
        if ($this->AddEmailSettings->validate_fields($_POST, $_FILES)) {
            $v_errors = $this->AddEmailSettings->fields_errors();
            return $this->send_response([], $v_errors, 'validation error', false);
        }
        if (isset($params['action'])) {
            unset($params['action']);
        }
        $data = array(
            'value' => json_encode($params),
            'key_name' => $this->email_settings_key,
            'type' => 'email-settings',
        );
        $isExisiting = $this->GlobalConfigrationModel->get_key_name($this->email_settings_key);
        if ($isExisiting) {
            $id = $this->GlobalConfigrationModel->update_settings($isExisiting->configuration_id, $data);
        } else {
            $id = $this->GlobalConfigrationModel->save_settings($data);
        }
        if ($id) {
            return $this->send_response(array('setting_id' => $id));
        }
        return $this->send_response([], [], "Something Went Wrong", false);
    }
}
