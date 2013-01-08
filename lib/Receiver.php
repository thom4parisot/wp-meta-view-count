<?php

/**
 * Deals with the logic of receiving a query for view count
 * Very basic, it's intented to deal with more complex cases in the future
 */
class MetaViewCountReceiver {
    /**
     * @var MetaViewCountObject
     */
    protected $object;

    /**
     * Basic initialization
     *
     * @param StdClass $post
     */
    public function __construct(StdClass $post){
        $this->object = new MetaViewCountObject($post);
    }

    /**
     * Retrieves a countable object
     *
     * @return MetaViewCountObject
     */
    public function getObject(){
        return $this->object;
    }

    /**
     * Increment object view count
     *
     * @todo deal with daily count
     * @todo deal with weekly count
     * @todo deal with monthly count
     *
     * @api
     * @return bool
     */
    public function incrementPost(){
        $this->object->incrementTotal();

        return true;
    }

    /**
     * Increments object view count if the content has not been modified
     *
     * @api
     * @return bool
     */
    public function incrementPostIfNotModified(){
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_MODIFIED'])  || isset($_SERVER['HTTP_IF_NONE_MATCH'])){
            status_header(304);

            return true;
        }
        else{
            return $this->incrementPost();
        }
    }

    /**
     * Sends HTTP headers enabling browser cache
     *
     * @api
     */
    public function sendCacheHeaders(){
        $seconds_to_cache = 864000;
        $expires = gmdate('D, d M Y H:i:s', time() + $seconds_to_cache) . ' GMT';
        $lastmodified = gmdate('D, d M Y H:i:s', time()) . ' GMT';

        header("Content-Type: application/json");
        header("Date: $lastmodified");
        header("Expires: $expires");
        header("Pragma: public");

        status_header(200);
    }
}
