<?php 
namespace SmartWpPlugin\Models;
use SmartWpPlugin\Models\MainModel;

/**
 * class GlobalConfigrationModel
 * @package SmartWpPlugin\Models
 * DESCRIPTION: GlobalConfigrationModel handle database operations.
 */
class GlobalConfigrationModel extends MainModel
{
    
    const TABLE = 'global_configurations';

    private $priamry_key='configuration_id';

    private $gateway_key ='pos-payment-gateways';

        
    /**
     * list_settings
     *
     * @return void
     * Description: List All Settings
     */
    public function list_settings()
    {    
        $table= self::get_table_name();
        return $this->get_all($table);
    }

    /**
     * GlobalConfigrationModel save .
     * @param array $params
     * @return int id 
     * Description: Save Settings
     */
	public function save($params)
	{
        $table= self::get_table_name();
        $key=key($params);

        $data=array(
            'key_name'=>key($params),
            'value'=>$params[$key],
        );
        if(isset($params['type'])){
            $data['type']=$params['type'];
        }

        $id=$this->add($table,$data);
        return $id;
	}
    
    /**
     * save
     *
     * @param  mixed $params
     * @return void
     */
    public function save_settings($params)
	{
        $table= self::get_table_name();
        $data=array(
            'key_name'=>$params['key_name'],
            'value'=>$params['value'],
        );
        if(isset($params['type'])){
            $data['type']=$params['type'];
        }
        $id=$this->add($table,$data);
        return $id;
	}
    
    /**
     * save_settings
     *
     * @param  mixed $params
     * @return void
     */
    public function update_settings($id,$params)
	{
        $table= self::get_table_name();
        $data=array(
            'key_name'=>$params['key_name'],
            'value'=>$params['value'],
        );
        if(isset($params['type'])){
            $data['type']=$params['type'];
        }
        $id=$this->update($table,$this->priamry_key,$id,$data);
        return $id;
	}

    
    /**
     * GlobalConfigrationModel updation .
     * @return int id
     * Description: Update Settings
     */
	public function updation($id,$params)
    {
        $table= self::get_table_name();
        $key=key($params);
        $data=array(
            'key_name'=>key($params),
            'value'=>$params[$key],
        );
        $id=$this->update($table,$this->priamry_key,$id,$data);
        return $id;
    }
    

    /**
     * GlobalConfigrationModel get_key_name record.
     * @param int $id
     * @return object 
     * Description: Get By Key
    */
    public function get_key_name($val)
    {

        $table= self::get_table_name();
        return $this->get_where_row($table,'key_name',$val);
    }
        
    /**
     * get_advance_booking_days
     *
     * @return void
     * Description: Get Advance Boog Days
     */
    public function get_advance_booking_days(){
        $row=$this->get_key_name('advance_booking');
        if($row){
            return $row->value;
        }
        return 30;
    }
        
    /**
     * get_booking_default_status
     *
     * @return void
     * Description: Get Default Status
     */
    public function get_booking_default_status(){
        $row=$this->get_key_name('default_appointment_status');
        if($row){
            return $row->value;
        }
        return "Pending";
    }


     /**
     * get_payment_gateways
     *
     * @return void
     */
    public function get_payment_gateways(){
        return $this->get_key_name($this->gateway_key);
    }

   

}