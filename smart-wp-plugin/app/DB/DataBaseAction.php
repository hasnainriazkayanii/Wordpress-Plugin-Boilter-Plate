<?php
namespace SmartWpPlugin\DB;
use SmartWpPlugin\DB\Tables\GlobalSetting\SbGlobalConfigrationsTable;


/**
 * Class DataBaseAction
 *
 * @package  SmartWpPlugin\DB
 * Action class to execute Table Classes
 */
class DataBaseAction 
{

    /**
     * DataBaseAction init.
     * Description: Triggers on Activation
    */
    public static function init()
    {
        
        SbGlobalConfigrationsTable::init();
    }
}