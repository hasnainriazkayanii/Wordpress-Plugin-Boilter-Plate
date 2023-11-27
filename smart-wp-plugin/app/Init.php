<?php
namespace SmartWpPlugin;
/**
 * Class Init
 * @package  SmartWpPlugin
 *
 * |--------------------------------------------------------------------------
 * |Init
 * |--------------------------------------------------------------------------
 * |
 * | The Init class Load All classes to register the hooks and actions
 * |
 * |
 */
final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 * Description: Load Hooks 
	 */
	public static function get_services() 
	{
		return [
			Hooks\Admin\Menu\Menu::class,
			Hooks\Admin\Setting::class,
			Core\Template::class,
			Core\Enqueue::class,
		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 * Description: Register Hooks/Filters 
	 */
	public static function register_services() 
	{
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class\
	 * Description: Initiate Services 
	 */
	private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}
}