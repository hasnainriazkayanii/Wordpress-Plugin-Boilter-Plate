<?php
namespace SmartWpPlugin\Core;

use SmartWpPlugin\DB\DataBaseAction;
use SmartWpPlugin\Models\WpUserModel;
use SmartWpPlugin\Repositories\GlobalConfigrationRepository;
use SmartWpPlugin\DB\Seeder\DatabaseSeeder;

/**
 * class Activate
 * @package SmartWpPlugin\Core
 * DESCRIPTION: Activate Class bein plugin activation operations.
 */
class Activate
{

    /**
     * activate
     *
     * @return void
     * Description: Core Plugin Function Fire on Plugin Activation
     */
    public static function activate()
    {
        ob_start();
        //Check if any plugin dependency is required.
        // if (!defined('WC_VERSION')) {
        //     echo '<div class="error"><p>Wocommerce is Required</p></div>';
        //     die();
        // }
        DataBaseAction::init();
        self::smart_wp_plugin_register_pages();
        self::smart_wp_plugin_create_roles();
        DatabaseSeeder::init();
        write_log(ob_get_contents(),E_USER_ERROR);
    }

    /**
     * add_page
     *
     * @param  mixed $title_of_the_page
     * @param  mixed $content
     * @param  mixed $template
     * @return void
     * Description: Create Custom Page With Templates and shortcodes
     */
    public static function smart_wp_plugin_add_page($title_of_the_page, $content, $template = '')
    {
        $objPage = get_page_by_title($title_of_the_page, 'OBJECT', 'page');
        if (empty($objPage)) {
            $page_id = wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status' => 'close',
                    'post_author' => 1,
                    'post_title' => ucwords($title_of_the_page),
                    'post_name' => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
                    'post_status' => 'publish',
                    'post_content' => $content,
                    'post_type' => 'page',
                )
            );
            if ($template != '') {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
           
            return $page_id;
        }
    }

    /**
     * create_roles
     *
     * @param  mixed $roles
     * @return void
     *  Description: Create Custom Roles
     */
    public static function smart_wp_plugin_create_roles()
    {
        $roles = self::smart_wp_plugin_roles_list();
        if ($roles && !empty($roles)) {
            foreach ($roles as $role) {
                if (!role_exists($role['name'])) {
                    add_role($role['name'], $role['display_name'], $role['capabilities']);
                }
            }
        }
    }
    
    /**
     * create_menu
     *
     * @param  mixed $page_id
     * @return void
     * Description: Create Menu from Page
     */
    public static function create_menu($page_id){
        if ($page_id > 0){
            $locations = get_nav_menu_locations();    
            if (is_array($locations)) {
                foreach ($locations as $location => $menuID){
                $menu = wp_get_nav_menu_object($menuID);            
                $pagesItem = wp_get_nav_menu_items($menu, array("object"=>"page"));
                if (is_array($pagesItem)) 
                  if(!in_array($page_id,$pagesItem)){
                        $item = array(
                            'menu-item-object-id' => $page_id,
                            'menu-item-object' => 'page',
                            'menu-item-type' => 'post_type',
                            'menu-item-status' => 'publish',
                        );
                        wp_update_nav_menu_item($menuID, $page_id, $item);
                  }
                }
            }
    
        }
    
        return 0;
    }

    
    /**
     * smart_wp_plugin_register_pages
     *
     * @return void
     * Description; Create Pages in wordpress for Portals
     */
    public static function  smart_wp_plugin_register_pages(){
        $GlobalConfigrationRepository = new GlobalConfigrationRepository();
        $pages_array=[];
       
        $page_id=self::smart_wp_plugin_add_page('Up Next Admin Dashboard', '[smart-wp-plugin-admin-setting]', 'templates/admin_dashboard.php');
        if($page_id){
            $pages_array['admin_dashboard_page_id']=$page_id;
           
        }  
        if($pages_array && !empty($pages_array)){
            $GlobalConfigrationRepository->save_global_setting($pages_array);
        }
    }
    
    /**
     * smart_wp_plugin_roles_list
     *
     * @return void
     * Description: Roles List
     */
    public static function smart_wp_plugin_roles_list(){
        $roles = array(
            array(
                'name' => 'sb_store_admin',
                'display_name' => 'Application Manager',
                'capabilities' => array(
                    'read' => true,
                    'upload_files' => true,
                    'edit_others_posts'=>true,
                    'delete_private_posts'=>true,
                    'edit_private_posts'=>true,
                    'read_private_posts'=>true,
                    'edit_published_posts'=>true,
                    'publish_posts'=>true,
                    'delete_published_posts'=>true,
                    'edit_posts'=>true,
                    'delete_posts'=>true,

                ),
            ),
        );
        return $roles;
    }
}