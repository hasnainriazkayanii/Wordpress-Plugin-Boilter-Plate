<?php

namespace SmartWpPlugin\Models;

use SmartWpPlugin\Exceptions\NotFoundException;

/**
 * class MainModel
 * @package SmartWpPlugin\Models
 * DESCRIPTION: MainModel abstract class handle direct query to the database.
 */
class MainModel
{
	public $prefix;

	public $sb_prefix = 'sb_';

	const TABLE = '';
	/**
	 * MainModel add.
	 *
	 * @param string         $table
	 * @param array            $data
	 * @return int  Last insterted ID
	 * Description: Wrapper Method To Save Data into the DB
	 */
	public function add($table, $data)
	{
		global $wpdb;
		$wpdb->insert($table, $data);
		return $wpdb->insert_id;
	}
	/**
	 * MainModel edit.
	 *
	 * @param string         $table
	 * @param primary_key column   $key
	 *  @param int           $id
	 * @return object  	row record
	 * Description: Wrapper Method To Get Record By Column
	 */
	public function edit($table, $key, $id)
	{
		global $wpdb;
		return $wpdb->get_row('SELECT  * from ' . $table . ' WHERE ' . $key . '=' . "$id");
	}



	/**
	 * MainModel update.
	 *
	 * @param string         $table
	 * @param primary_key column   $key
	 * @param int           $id
	 * @param array         $data
	 * @return int  		Primary Key
	 * Description: Wrapper Method To Update Record By Column
	 */
	public function update($table, $key, $id, $data)
	{
		global $wpdb;
		$where = array($key => $id);
		$wpdb->update($table, $data, $where);
		return $id;
	}

	/**
	 * MainModel delete.
	 *
	 * @param string         $table
	 * @param primary_key column   $key
	 * @param int           $id
	 * @return boolean
	 * Description: Wrapper Method To Delete Record By Column
	 */
	public function delete($table, $key, $id)
	{
		global $wpdb;
		$where = array($key => $id);
		return $wpdb->delete($table, $where);
	}
	/**
	 * delete_all
	 *
	 * @param  mixed $table
	 * @return void
	 * Description: Wrapper Method To Delete All Records
	 */
	public function delete_all($table)
	{
		global $wpdb;
		return $wpdb->query('TRUNCATE TABLE ' . $table);
	}


	/**
	 * MainModel get_all.
	 *
	 * @param string         $table
	 * @return array
	 * Description: Wrapper Method To Get All Records
	 */

	public function get_all($table)
	{
		global $wpdb;
		return $wpdb->get_results('SELECT  * from ' . $table);
	}

	/**
	 * MainModel get_last_inserted_id.
	 *
	 * @param string         $table
	 * @return int
	 * Description: Wrapper Method To Get Last Id
	 */
	public function get_last_inserted_id($table)
	{
		global $wpdb;
	}

	/**
	 * MainModel get_prefix.
	 * @return string
	 * Description: Wrapper Method To Get DB prefix
	 */
	public function get_prefix()
	{
		global $wpdb;
		return $wpdb->prefix . '' . $this->sb_prefix;
	}


	/**
	 * MainModel get_wp_prefix.
	 * @return string
	 * Description: Wrapper Method To Get Wordpress DB prefix
	 */
	public function get_wp_prefix()
	{
		global $wpdb;
		return $wpdb->prefix;
	}
	/**
	 * MainModel get_table_name.
	 * @return string
	 * Description: Wrapper Method To Get Table Name
	 */
	public static function get_table_name()
	{
		if (!static::TABLE) {
			throw new NotFoundException('Table name is not provided');
		}
		global $wpdb;
		$prefix = $wpdb->prefix;
		$sbprefix = 'sb_';
		return $prefix . $sbprefix . static::TABLE;
	}

	/**
	 * MainModel get_single_field.
	 * @param string $table
	 * @param string $fieldName
	 * @return array
	 * Description: Wrapper Method To Get Single Field
	 */
	public function get_single_field($table, $fieldName)
	{
		global $wpdb;
		return $wpdb->get_results('SELECT ' . $fieldName . ' FROM ' . $table);
	}

	/**
	 * MainModel get_results.
	 * @param string $table
	 * @param string/int/float $key
	 * @param string/int/float $value
	 * @return array
	 * Description: Wrapper Method To Get Single Field by primary Key
	 */
	public function get_where($table, $key, $value)
	{
		global $wpdb;
		return $wpdb->get_results('SELECT * FROM ' . $table . ' WHERE ' . $key . ' = ' . $value);
	}
	/**
	 * get_where_row
	 *
	 * @param  mixed $table
	 * @param  mixed $key
	 * @param  mixed $value
	 * @return void
	 * Description: Wrapper Method To Get Single Field by Column Key
	 */
	public function get_where_row($table, $key, $value)
	{
		global $wpdb;
		return $wpdb->get_row('SELECT * FROM ' . $table . ' WHERE ' . $key . ' = "' . $value . '"');
	}

	/**
	 * MainModel get_single_field_by_relational.
	 * @param string $table
	 * @param string/int/float $key
	 * @param string/int/float $value
	 * @return array
	 * Description: Wrapper Method To Get  by Foreign Key
	 */
	public function get_single_field_by_relational($table, $key, $value, $fieldName)
	{
		global $wpdb;
		$result = $wpdb->get_results('SELECT ' . $fieldName . ' FROM ' . $table . ' WHERE ' . $key . ' = ' . $value);
		$ids = wp_list_pluck($result, $fieldName);
		return $ids;
	}

	/**
	 * MainModel update_relational.
	 * @param string $table
	 * @param array $where
	 * @param array $data
	 * @return int numbers of rows updated
	 * Description: Wrapper Method To Update by Foreign Key
	 */
	public function update_relational($table, $where, $data)
	{
		global $wpdb;
		return $wpdb->update($table, $data, $where);
	}


	/**
	 * MainModel delete_relation.
	 * @param string $table
	 * @param array $where
	 * @return boolean  
	 *  Description: Wrapper Method To Delete by Foreign Key
	 */

	public function delete_relation($table, $where)
	{
		global $wpdb;
		return $wpdb->delete($table, $where);
	}
	/**
	 * MainModel truncate_relation.
	 * @param string $table
	 * @return boolean  
	 * Description: Wrapper Method To Truncate by Foreign Key
	 */

	public function truncate_relation($table)
	{
		global $wpdb;
		return $wpdb->query("TRUNCATE TABLE $table");
	}


	/**
	 * MainModel raw.
	 * @param string $query
	 * @return array  
	 * Description: Wrapper Method To Execute Raw Query
	 */
	public function raw($query)
	{
		global $wpdb;
		return $wpdb->get_results($query);
	}

	/**
	 * raw_array
	 *
	 * @param  mixed $query
	 * @return void
	 */
	public function raw_array($query)
	{
		global $wpdb;
		return $wpdb->get_results($query, 'ARRAY_A');
	}
	/**
	 * raw_single
	 *
	 * @param  mixed $query
	 * @return void
	 *  Description: Wrapper Method To Execute Raw Query and get Signle Row
	 */
	public function raw_single($query)
	{
		global $wpdb;
		return $wpdb->get_row($query);
	}
	/**
	 * get_where_in
	 *
	 * @param  mixed $table
	 * @param  mixed $field
	 * @param  mixed $whereIn
	 * @return void
	 * Description: Wrapper Method To Get Where IN
	 */
	public function get_where_in($table, $field, $whereIn)
	{
		global $wpdb;
		return $wpdb->get_results('SELECT * FROM ' . $table . ' WHERE ' . $key . ' IN ' . $whereIn);
	}

	/**
	 * MainModel get_results from key.
	 * @param string $table
	 * @param string $key
	 * @param string $value
	 * @return array
	 * Description: Wrapper Method To Get By Column Name and Value
	 */
	public function get_where_key_name($table, $key, $value)
	{
		global $wpdb;
		return $wpdb->get_row('SELECT * FROM ' . $table . ' WHERE ' . $key . ' = "' . $value . '"');
	}

	public function pluck_field($table, $fieldName)
	{
		global $wpdb;
		$result = $wpdb->get_results('SELECT ' . $fieldName . ' FROM ' . $table);
		$ids = wp_list_pluck($result, $fieldName);
		return $ids;
	}

	/**
	 * MainModel get_all_order_by.
	 *
	 * @param string         $table
	 * @return array
	 * Description: Get All With Order By
	 */

	public function get_all_order_by($table, $order_by = NULL)
	{
		global $wpdb;
		return $wpdb->get_results('SELECT  * from ' . $table . ' ' . $order_by);
	}


	/**
	 * get_count
	 *
	 * @param  mixed $query
	 * @return void
	 * Description: Get Count
	 */
	public function get_count($query)
	{
		global $wpdb;
		return $wpdb->get_var($query);
	}

	public function list_single_field($table, $fieldName)
	{
		global $wpdb;
		$result = $wpdb->get_results('SELECT ' . $fieldName . ' FROM ' . $table);
		$ids = wp_list_pluck($result, $fieldName);
		return $ids;
	}
	/**
	 * raw_update
	 *
	 * @param  mixed $query
	 * @return void
	 */
	public function raw_update($query)
	{
		global $wpdb;
		return $wpdb->query($query);
	}

	/**
	 * MainModel update.
	 *
	 * @param string         $table
	 * @param primary_key column   $key
	 * @param int           $id
	 * @param array         $data
	 * @return int  		Primary Key
	 * Description: Wrapper Method To Update Record By Column
	 */
	public function update_where($table, $where, $data)
	{
		global $wpdb;
		$wpdb->update($table, $data, $where);
		return true;
	}


	/**
	 * MainModel update.
	 *
	 * @param string         $table
	 * @param primary_key column   $key
	 * @param int           $id
	 * @param array         $data
	 * @return int  		Primary Key
	 * Description: Wrapper Method To Update Record By Column
	 */
	public function pluck_fields($table, $fields, $array_value = '', $array_index = '', $where = array())
	{
		global $wpdb;
		$where_clause = " 1=1 ";
		if (count($where) > 0) {
			foreach ($where as $key => $where_field) {
				$where_clause .= ' AND ' . $key . '=' . $where_field . ' ';
			}
		}
		$select_fields = $fields;
		if (is_array($fields)) {
			$select_fields = implode('', $fields);
		}

		$results = $wpdb->get_results('SELECT  ' . $select_fields . ' FROM ' . $table . ' WHERE ' . $where_clause);
		if ($array_value != '' && $array_index != '') {
			$plugged_array['pluck'] = wp_list_pluck($results, $array_index, $array_value);
			return array_merge($results, $plugged_array);
		} else if ($array_value != '') {
			$plugged_array['pluck'] = wp_list_pluck($results, $array_value);
			return array_merge($results, $plugged_array);
		} else {
			return $results;
		}
	}

	/**
	 * MainModel update.
	 *
	 * @param string         $table
	 * @param primary_key column   $key
	 * @param int           $id
	 * @param array         $data
	 * @return int  		Primary Key
	 * Description: Wrapper Method To Update Record By Column
	 */
	public function pluck_raw($query, $array_value = '', $array_index = '')
	{
		global $wpdb;
		$results = $wpdb->get_results($query);
		if ($array_value != '' && $array_index != '') {
			$plugged_array['pluck'] = wp_list_pluck($results, $array_index, $array_value);
			return array_merge($results, $plugged_array);
		} else if ($array_value != '') {
			$plugged_array['pluck'] = wp_list_pluck($results, $array_value);
			return array_merge($results, $plugged_array);
		} else {
			return $results;
		}
	}

	
	/**
	 * delete_where_in
	 *
	 * @param  mixed $table
	 * @param  mixed $column
	 * @param  mixed $value
	 * @return void
	 */
	public function delete_where_in($table,$column,$value){
		global $wpdb;
		$in = "'" . implode("', '", $value) . "'";
		$delete_query = "DELETE FROM ".$table." WHERE ".$column." IN (".$in.")";
		return $wpdb->query($delete_query);
	}
	

	/**
	 * raw_query
	 *
	 * @param  mixed $query
	 * @return void
	 */
	public function raw_query($query){
		global $wpdb;
		return $wpdb->query($query);
	}
}
