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
     */
    public function incrementPost(){
        $this->object->incrementTotal();
    }
}
