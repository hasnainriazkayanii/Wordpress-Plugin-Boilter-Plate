<?php
namespace SmartWpPlugin\DB\Tables\GlobalSetting;
use SmartWpPlugin\DB\Tables\AbstractDatabaseTable;

/**
 * class SbGlobalConfigrationsTable
 * @package SmartWpPlugin\DB\Tables\GlobalSetting
 * DESCRIPTION: Global Settings table structure
 */
class SbGlobalConfigrationsTable extends AbstractDatabaseTable
{

    const TABLE = 'global_configurations';

    /**
     * @return string
     
     * Description: Defines Table Structure
     */
    public static function build_table()
    {
        $table = self::get_table_name();

        return "CREATE TABLE {$table} (
            `configuration_id` bigint unsigned NOT NULL AUTO_INCREMENT,
            `key_name` varchar (100) NOT NULL,
            `value` text NOT NULL,
            `type` varchar (100) NULL,
             PRIMARY KEY (`configuration_id`)
         ) DEFAULT CHARSET=utf8 COLLATE utf8_general_ci";
    }
}