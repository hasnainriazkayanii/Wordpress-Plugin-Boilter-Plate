<?php 

namespace SmartWpPlugin\Controllers;

/**
 * class MainController
 * @package SmartWpPlugin\Controllers;
 * DESCRIPTION: MainController Parent Class Contains Resubale Methods used by controllers.
 */
class MainController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;
	
	public function __construct() {
		
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/smart-wp-plugin.php';
	}

		
	/**
	 * view
	 *
	 * @param  mixed $name
	 * @param  mixed $data
	 * @param  mixed $errors
	 * @return void
	 * Description: Wrapper Functions to Load Views
	 */
	public function view($name,$data=array(),$add_alerts=true,$errors=array())
	{
		if(!empty($data)){
			extract($data);
		}
		if($add_alerts){
			require_once( "$this->plugin_path/views/global/partials/alerts/alerts" . ".php");
			require_once( "$this->plugin_path/views/global/partials/errors/errors" . ".php");
		}
		require_once( "$this->plugin_path/views/global/partials/variables/global_variables" . ".php");
		require_once( "$this->plugin_path/views/$name" . ".php");
	}

		
	/**
	 * transcation_completed
	 *
	 * @param  mixed $message
	 * @param  mixed $status
	 * @return void
	 *  Description: Wrapper Functions to Set Global Sessions
	 */
	public function transcation_completed($message,$status)
	{
		$_SESSION["message"]=$message;
		$_SESSION["status"]=$status;
	}
	
		
	/**
	 * redirect
	 *
	 * @param  mixed $location
	 * @return void
	 *  Description: Wrapper Functions to Redirect 
	 */
	public function redirect($location)
	{
		wp_redirect(admin_url('admin.php?page='.$location));
	}
		
	/**
	 * set_erros
	 *
	 * @param  mixed $errors
	 * @return void
	 * Description: Wrapper Functions to Set Errors
	 */
	public function set_erros($errors){
		$_SESSION["sb-erros"]=$errors;
	}


	/**
	 * set_cookies_erros
	 *
	 * @param  mixed $errors
	 * @return void
	 * Description: Wrapper Functions to Set Errors
	 */
	public function set_cookies_erros($errors){
		setcookie("sb-erros",json_encode($errors),time()+3600*24);
	}


		/**
	 * set_cookies_messages
	 *
	 * @param  mixed $errors
	 * @return void
	 * Description: Wrapper Functions to Set Errors
	 */
	public function set_cookies_messages($message,$status)
	{
		setcookie("message",$message,time()+3600*24);
		setcookie("status",$status,time()+3600*24);
	}
		
	/**
	 * extract_data
	 *
	 * @param  mixed $data
	 * @return void
	 * Description: Wrapper Functions  Get Keys in array
	 */
	public function extract_data($data){
		if(isset($data['data'])){
			return $data['data'];
		}
		return [];
	}
	
	/**
	 * output_view
	 *
	 * @param  mixed $name
	 * @param  mixed $data
	 * @param  mixed $errors
	 * @return void
	 */
	public function output_view($name,$data=array(),$errors=array())
	{
		if(!empty($data)){
			extract($data);
		}
		ob_start();
		include "$this->plugin_path/views/$name" . ".php";
		$html = ob_get_clean();
		return $html;
	}

	/**
	 * redirect_back
	 *
	 * @return void
	 *  Description: Wrapper Functions to Redirect 
	 */
	public function redirect_back()
	{
		wp_redirect(wp_get_referer());
        die();
	}
	
}