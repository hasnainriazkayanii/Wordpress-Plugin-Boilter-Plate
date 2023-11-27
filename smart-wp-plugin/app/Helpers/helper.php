<?php

use  SmartWpPlugin\Models\GlobalConfigrationModel;

/**
 * get_advance_booking_days
 *
 * @return void
 * Description: Get Settings Advance Booking Days
 */
function get_advance_booking_days()
{
    $setting = new GlobalConfigrationModel();
    return $setting->get_advance_booking_days();
}


/**
 * get_booking_default_status
 *
 * @return void
 * Description: Get Settings Default Appointment Status
 */
function get_booking_default_status()
{
    $setting = new GlobalConfigrationModel();
    return $setting->get_booking_default_status();
}

/**
 * get_setting_by_slug
 *
 * @param  mixed $slug
 * @return void
 */
function get_setting_by_slug($slug)
{
    $setting = new GlobalConfigrationModel();
    $setting_object = $setting->get_key_name($slug);
    if ($setting_object) {
        return $setting_object->value;
    } else {
        return false;
    }
}

/**
 * format_currency
 *
 * @param  mixed $symbol
 * @param  mixed $dollars
 * @return void
 * Description: Format Currency
 */
function format_currency($symbol, $dollars)
{
    $formatted = $symbol . number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2);
    return $dollars < 0 ? "({$formatted})" : "{$formatted}";
}


function format_money($dollars)
{
    $formatted =  number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2);
    return $dollars < 0 ? "({$formatted})" : "{$formatted}";
}


/**
 * SmartWpPlugin_db_start_transcation
 *
 * @return void
 */
function SmartWpPlugin_db_start_transcation()
{
    global $wpdb;
    $wpdb->query('START TRANSACTION');
}

/**
 * SmartWpPlugin_db_roolback_transcation
 *
 * @return void
 */
function SmartWpPlugin_db_roolback_transcation()
{
    global $wpdb;
    $wpdb->query('ROLLBACK');
}

/**
 * SmartWpPlugin_db_commit_transcation
 *
 * @return void
 */
function SmartWpPlugin_db_commit_transcation()
{
    global $wpdb;
    $wpdb->query('COMMIT');
}

if (!function_exists('write_log')) {

    /**
     * write_log
     *
     * @param  mixed $log
     * @return void
     * Description: Create Run Time Logs.
     */
    function write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}


if (!function_exists('random_color')) {

    /**
     * random_color
     *
     * @return void
     */
    function random_color()
    {
        $rcolor = '#';
        for ($i = 0; $i < 6; $i++) {
            $rNumber = rand(0, 15);
            switch ($rNumber) {
                case 10:
                    $rNumber = 'A';
                    break;
                case 11:
                    $rNumber = 'B';
                    break;
                case 12:
                    $rNumber = 'C';
                    break;
                case 13:
                    $rNumber = 'D';
                    break;
                case 14:
                    $rNumber = 'E';
                    break;
                case 15:
                    $rNumber = 'F';
                    break;
            }
            $rcolor .= $rNumber;
        }
        return $rcolor;
    }
}


if (!function_exists('get_email_settings')) {

       
    /**
     * get_email_settings
     *
     * @param  mixed $slug
     * @return void
     * Description: Get Email Settings
     */
    function get_email_settings($slug)
    {
        $setting = new GlobalConfigrationModel();
        $setting_object = $setting->get_key_name('email-settings');
        if ($setting_object) {
            $email_settings = (array) json_decode($setting_object->value);
            if(isset($email_settings[$slug])){
              return $email_settings[$slug];
            }
            return false;
        } else {
            return false;
        }
    }
}
if (!function_exists('SmartWpPlugin_add_flash_notice')) {


     /**
     * SmartWpPlugin_add_flash_notice
     *
     * @param  mixed $slug
     * @return void
     * Description: Set Errors and Notices
     */
    function SmartWpPlugin_add_flash_notice( $notice = "", $type = "warning", $dismissible = true ) {
        $notices = get_option( "SmartWpPlugin_my_flash_notices", array() );
        $dismissible_text = ( $dismissible ) ? "is-dismissible" : "";
        if(empty($notices)){
            array_push( $notices, array( 
                "notice" => $notice, 
                "type" => $type, 
                "dismissible" => $dismissible_text
            ) );
            add_option("SmartWpPlugin_my_flash_notices", $notices );
        }
        else{
        array_push( $notices, array( 
                "notice" => $notice, 
                "type" => $type, 
                "dismissible" => $dismissible_text
            ) );
            update_option("SmartWpPlugin_my_flash_notices", $notices );
        }
        return;
    }
}
if (!function_exists('SmartWpPlugin_display_flash_notices')) {


    /**
    * SmartWpPlugin_display_flash_notices
    *
    * @param  mixed $slug
    * @return void
    * Description: Display and Delete Errors and Notices
    */
    function SmartWpPlugin_display_flash_notices() {
        $notices = get_option( "SmartWpPlugin_my_flash_notices", array() ); 
        if( ! empty( $notices ) ) {
            foreach ( $notices as $notice ) {
                $notice['msg-class']=$notice['type'];
                if($notice['type']=='error'){
                    $notice['msg-class']='danger';
                }
                printf('<div class="notice  text-%4$s %2$s notice-%1$s %2$s"><p>%3$s</p></div>',
                    $notice['type'],
                    $notice['dismissible'],
                    $notice['notice'],
                    $notice['msg-class'],
                );
            }
            delete_option( "SmartWpPlugin_my_flash_notices", array() );
            return;
        }
        return;
    }
}


if ( ! function_exists( 'role_exists' ) ) {
    /**
     * role_exists
     *
     * @param  mixed $role
     * @return void
     * Description: Validates Role Exsistance
     */
    function role_exists($role)
    {

        if (!empty($role)) {
            return $GLOBALS['wp_roles']->is_role($role);
        }

        return false;
    }
}

if ( ! function_exists( 'validate_customer' ) ) {
    /**
     * validate_customer
     *
     * @return void
     * Description: Validates Sb Customer Role
     */
    function validate_customer()
    {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('sb_client', (array) $user->roles)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if ( ! function_exists( 'validate_employee' ) ) { 
    /**
     * validate_employee
     *
     * @return void
     */
    function validate_employee()
    {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('sb_employee', (array) $user->roles)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if ( ! function_exists( 'validate_admin' ) ) { 
    /**
     * validate_admin
     *
     * @return void
    */
    function validate_admin()
    {
        if (is_user_logged_in()) {
            $user = wp_get_current_user();
            if (in_array('sb_store_admin', (array) $user->roles) || in_array('Administrator', (array) $user->roles) || in_array('administrator', (array) $user->roles)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}



if ( ! function_exists( 'user_roles' ) ) { 
    /**
     * user_roles
     *
     * @return void
     * Description: Smart Booking Roles
     */
    function user_roles()
    {
        $roles = array(
            array(
                'name' => 'sb_employee',
                'display_name' => 'Employee',
                array(),
            ),
            array(
                'name' => 'sb_client',
                'display_name' => 'Client',
                array(),
            ),
            array(
                'name' => 'sb_store_admin',
                'display_name' => 'Admin',
                array(),
            ),
        );
        return $roles;
    }
}

if ( ! function_exists( 'sortFunction' ) ) {    
    /**
     * sortFunction
     *
     * @param  mixed $a
     * @param  mixed $b
     * @return void
     */
    function sortFunction( $a, $b ) {
        return strtotime($a) - strtotime($b);
    }
}

if ( ! function_exists( 'SmartWpPlugin_get_logged_in_empoyee_id' ) ) {    
    /**
     * SmartWpPlugin_get_logged_in_empoyee_id
     *
     * @return void
     */
    function SmartWpPlugin_get_logged_in_empoyee_id(){
        $emp = new EmployeeModel();
        $employee_data=$emp->get_employee_by_user(SmartWpPlugin_get_current_user_id());
        return $employee_data->employee_id;
    }
}

if ( ! function_exists( 'SmartWpPlugin_get_current_user_id' ) ) {
       
    /**
     * SmartWpPlugin_get_current_user_id
     *
     * @return void
     */
    function SmartWpPlugin_get_current_user_id(){
        return get_current_user_id();
    }

    
}

