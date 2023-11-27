<?php
namespace SmartWpPlugin\Core;

/**
 * class Template
 * @package SmartWpPlugin\Core
 * DESCRIPTION: Template Class used to override theme template with custom template and  register hooks/actions/filters.
 */
class Template
{
    public $templates;

    public function __construct()
    {

        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)) . '/smart-wp-plugin.php';
    }

    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        $this->templates = array(
            'templates/admin_dashboard.php' => 'Customer Dashboard Template',
        );
        add_filter('theme_page_templates', array($this, 'custom_template'));
        add_filter('template_include', array($this, 'load_template'));
    }

    /**
     * custom_template
     *
     * @param  mixed $templates
     * @return void
     */
    public function custom_template($templates)
    {
        $templates = array_merge($templates, $this->templates);

        return $templates;
    }

    /**
     * load_template
     *
     * @param  mixed $template
     * @return void
     */
    public function load_template($template)
    {
        global $post;

        if (!$post) {
            return $template;
        }

        $template_name = get_post_meta($post->ID, '_wp_page_template', true);

        if (!isset($this->templates[$template_name])) {
            return $template;
        }

        $file = WP_PLUGIN_DIR . '/smart-wp-plugin/' . $template_name;

        if (file_exists($file)) {
            if (isset($this->templates[$template_name])) {
                
                if (!validate_admin() && $template_name == 'templates/admin_dashboard.php') {
                    wp_redirect(get_permalink(get_setting_by_slug('login_page_id')));
                    die();
                }
            }
            return $file;
        }
        return $template;
    }
}