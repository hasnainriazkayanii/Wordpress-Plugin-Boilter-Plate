<?php
namespace SmartWpPlugin\DB\Tables;
use SmartWpPlugin\Exceptions\NotFoundException;

/**
 * class AbstractDatabaseTable
 * @package SmartWpPlugin\DB\Tables
 * DESCRIPTION: Abstract Class contain resuable functions.
 */
class AbstractDatabaseTable
{
    const TABLE = '';

    /**
     * @return string
     * @throws NotFoundException
     * Description: Get Table Name
     */
    public static function get_table_name()
    {
        if (!static::TABLE) {
            throw new NotFoundException('Table name is not provided');
        }

        global $wpdb;
        return $wpdb->prefix . 'sb_' . static::TABLE;
    }
    
    /**
     * get_table_prefix_with_name
     *
     * @param  mixed $tbl_name
     * @return void
     * Description: Get Database Prefix
     */
    public static function get_table_prefix_with_name($tbl_name)
    {
       
        global $wpdb;
        return $wpdb->prefix . 'sb_' .$tbl_name ;
    }
    
    /**
     * init
     *
     * @return void
     * Description: Execute Database Query to create table
     */
    public static function init()
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $query=static::build_table();
        maybe_create_table(self::get_table_name(),$query);
        global $wpdb;
        foreach (static::alter_table() as $command) {
            $wpdb->query($command);
        }
    }

    /**
     * delete
     * Delete table table from the database
     * Description: Delete Database Table
     */
    public static function delete()
    {
        global $wpdb;

        $table = self::get_table_name();

        $sql = "DROP TABLE IF EXISTS {$table};";
        $wpdb->query($sql);
    }

    /**
     * is_valid_table_prefix
     * @return boolean
     * Description: Validates Database Prefix Name
     */
    public static function is_valid_table_prefix()
    {
        global $wpdb;

        return strlen($wpdb->prefix) <= 16;
    }

    /**
     * alter_table
     * @return array
     *  Description: Alter Database Table
     */
    public static function alter_table()
    {
        return [];
    }
}