<?php
namespace SmartWpPlugin\Requests\Emails;

use Rakit\Validation\Rule;

/**
 * class UniqueRule
 * @package SmartWpPlugin\Requests\Emails
 * DESCRIPTION: UniqueRule Custom Rule to vldaite duplicate fields in database table.
 */
class UniqueRule extends Rule
{
    protected $message = ":attribute :value has been used";

    protected $fillableParams = ['table', 'column', 'except'];

    protected $pdo;   

    /**
     * check
     *
     * @param  mixed $value
     * @return bool
     * Description:  Custom Rule for Unique Table Attribute
     */
    public function check($value): bool
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $sbprefix = 'sb_';
        $this->requireParameters(['table', 'column']);
        
        $column = $this->parameter('column');
        $table = $prefix . '' . $sbprefix . '' . $this->parameter('table');
        if( $this->parameter('table')=='users'){
            $table = $prefix .''. $this->parameter('table');
        }
        
        $except = $this->parameter('except');
        
        if ($except and $except == $value) {
            return true;
        }
        $data = $wpdb->get_row('SELECT  count(*) as count FROM ' . $table . ' WHERE ' . $column . ' = "' . $value . '"');
        return intval($data->count) === 0;
    }
}
