<?php
namespace SmartWpPlugin\Repositories;

/**
 * class AbstractRepository
 * @package SmartWpPlugin\Repositories
 * DESCRIPTION: AbstractRepository  class has common functions used by all repositorires.
 */
class AbstractRepository
{    
    /**
     * send_response
     *
     * @param  mixed $data
     * @param  mixed $errros
     * @param  mixed $message
     * @param  mixed $status
     * @return array
     * Description: Wrapper Function For Sending Response
     */
    public function send_response($data = array(), $errros = array(), $message = 'success', $status = TRUE)
    {
        $response = array(
            'data' => $data,
            'errors' => $errros,
            'message' => $message,
            'status' => $status,
        );
        return $response;
    }    
    /**
     * output_view
     *
     * @param  mixed $name
     * @param  mixed $data
     * @param  mixed $errors
     * @return void
     *  Description: Wrapper Method to return view
     */
    public function output_view($name,$data=array(),$errors=array())
	{
		if(!empty($data)){
			extract($data);
		}
		ob_start();
        include plugin_dir_path( dirname( __FILE__, 2 ) )."views/".$name.".php";
		$html = ob_get_clean();
		return $html;
	}
}
