<?php

class MetaViewCountSetup {
    /**
     * Adds the script in any page we want to monitor visits
     *
     * @todo uses wp_footer and async/defer attributes
     * @static
     */
    public static function Wp(){
        if (!is_single() && !is_page()){
            return;
        }

        if (!get_the_ID()){
            return;
        }

        wp_enqueue_script('meta-view-count-handler', admin_url('admin-ajax.php?action=update_view_count&amp;post_id='.get_the_ID()), array(), '1.0.0', true);
    }

    /**
     * Handles URI call to increment a view count
     *
     * @todo deal with nonce to avoids plain call of the URI
     * @static
     * @wordpress:hook  wp_ajax_nopriv_update_view_count
     * @wordpress:hook  wp_ajax_update_view_count
     * @throws Exception
     */
    public static function AjaxHandler(){
        $post = get_post($_REQUEST['post_id']);

        if (null === $post){
            throw new Exception('Invalid Post');
        }

        $receiver = new MetaViewCountReceiver($post);

        if ($receiver->incrementPost()){
            $receiver->sendCacheHeaders();
        }

        exit;
    }
}
