<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oncletom
 * Date: 06/01/13
 * Time: 11:37
 * To change this template use File | Settings | File Templates.
 */
class MetaViewCountSetup {
    public static function Wp(){
        if (!is_single() && !is_page()){
            return;
        }

        if (!get_the_ID()){
            return;
        }

        wp_enqueue_script('meta-view-count-handler', admin_url('admin-ajax.php?action=update_view_count&amp;post_id='.get_the_ID()), array(), '1.0.0', true);
    }

    public static function AjaxHandler(){
        $post = get_post($_REQUEST['post_id']);

        if (null === $post){
            throw new Exception('Invalid Post');
        }

        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_MODIFIED'])  || isset($_SERVER['HTTP_IF_NONE_MATCH'])){
            status_header(304);
            exit;
        }

        $receiver = new MetaViewCountReceiver($post);
        $receiver->incrementPost();

        $seconds_to_cache = 864000;
        $expires = gmdate('D, d M Y H:i:s', time() + $seconds_to_cache) . ' GMT';
        $lastmodified = gmdate('D, d M Y H:i:s', time()) . ' GMT';

        header("Content-Type: application/json");
        header("Date: $lastmodified");
        header("Expires: $expires");
        header("Pragma: public");
        header("Max-Age: $seconds_to_cache");
        header("Cache-Control: s-max-age: 1800, max-age: $seconds_to_cache");

        status_header(200);
        echo json_encode(array());

        exit;
    }
}
