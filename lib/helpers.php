<?php

if (!function_exists('the_view_count')){
    /**
     * Prints out the view count for a post/page within a loop
     *
     * @return null
     */
    function the_view_count(){
        echo get_view_count();
    }

    /**
     * Returns the view count for a post/page within a loop
     *
     * @return int|string
     */
    function get_view_count(){
        if (in_the_loop()){
            global $post;

            $countObject = new MetaViewCountObject($post);
            return $countObject->getTotal();
        }
        else{
            return 'N/A';
        }
    }
}