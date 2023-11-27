<?php 
namespace SmartWpPlugin\Hooks\Admin\Menu;


/**
 * class AdminMenuCommon
 * @package SmartWpPlugin\Hooks\Admin\Menu
 * DESCRIPTION: AdminMenuCommon Class create admin dashboard menu and pages.
 */
class AdminMenuCommon
{
	public $admin_pages = array();

	public $admin_subpages = array();


	/**
     * AdminMenuCommon register .
     * Register/Call Menu Hooks
	 *  Description: Registers Hooks/Filters
     */
 	public function register()
	{
		if ( ! empty($this->admin_pages) ) {
			add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );
		}
	}

	/**
     * AdminMenuCommon addPages .
     * Add Menu  Pages
	 * @param array $pages
	 * @return Self Object
	 * Description: Add Pages in Menu 
     */
	public function addPages( array $pages )
	{
		$this->admin_pages = $pages;

		return $this;
	}

	/**
     * AdminMenuCommon withSubPage .
     * Add Menu  SubPages
	 * @param string $title
	 * @return Self Object
	 *  Description: Add Pages with Sub Pages in Menu 
     */
	public function withSubPage( string $title = null ) 
	{
		if ( empty($this->admin_pages) ) {
			return $this;
		}

		$admin_page = $this->admin_pages[0];

		$subpage = array(
			array(
				'parent_slug' => $admin_page['menu_slug'], 
				'page_title' => $admin_page['page_title'], 
				'menu_title' => ($title) ? $title : $admin_page['menu_title'], 
				'capability' => $admin_page['capability'], 
				'menu_slug' => $admin_page['menu_slug'], 
				'callback' => $admin_page['callback']
			)
		);

		$this->admin_subpages = $subpage;

		return $this;
	
	}
	/**
     * AdminMenuCommon addSubPages .
     * Merge Pages and Subpages
	 * @param array $pages
	 * @return Self Object
	 * Description: Merge Pages and SubPages
     */
	public function addSubPages( array $pages )
	{
		$this->admin_subpages = array_merge( $this->admin_subpages, $pages );

		return $this;
	}

	/**
     * AdminMenuCommon addAdminMenu .
     * Display  Pages and Subpages.
	 * Description: Add Menu 
     */
	public function addAdminMenu()
	{
		foreach ( $this->admin_pages as $page ) {
			add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
		}

		foreach ( $this->admin_subpages as $page ) {
			add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
		}
	}
   	
}