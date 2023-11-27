<?php
namespace SmartWpPlugin\Models;

use SmartWpPlugin\Models\MainModel;

/**
 * class PageModel
 * @package SmartWpPlugin\Models
 * DESCRIPTION: PageModel  handle database operations.
 */
class PageModel extends MainModel
{

    /**
     * list_pages
     *
     * @return void
     * Description:Get Post Type Page
     */
    public function list_pages()
    {
        $posts = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'page',
            'post_status' => 'publish',
        ));
        $post_title_array = wp_list_pluck($posts, 'post_title', 'ID');
        return $post_title_array;
    }

    /**
     * add_page
     *
     * @param  mixed $title_of_the_page
     * @param  mixed $content
     * @param  mixed $template
     * @return void
     * Description: Save Post Type Page
     */
    public function add_page($title_of_the_page, $content, $template = '')
    {
        $objPage = get_page_by_title($title_of_the_page, 'OBJECT', 'page');
        if (empty($objPage)) {
            $page_id = wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status' => 'close',
                    'post_title' => ucwords($title_of_the_page),
                    'post_name' => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
                    'post_status' => 'publish',
                    'post_content' => $content,
                    'post_type' => 'page',
                )
            );
            if ($template != '') {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
            return $page_id;
        }
    }

    /**
     * update_page
     *
     * @param  mixed $id
     * @param  mixed $title_of_the_page
     * @param  mixed $content
     * @param  mixed $template
     * @return void
     *  Description: Update Post Type Page
     */
    public function update_page($post_id, $title_of_the_page, $content, $template = '')
    {
        $page_id = wp_update_post(
            array(
                'ID' => $post_id,
                'comment_status' => 'close',
                'ping_status' => 'close',
                'post_status' => 'publish',
                'post_content' => $content,
                'post_type' => 'page',
            )
        );
        if ($template != '') {
            update_post_meta($page_id, '_wp_page_template', $template);
        }
        return $page_id;

    }

}
