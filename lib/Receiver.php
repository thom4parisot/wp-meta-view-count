<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oncletom
 * Date: 06/01/13
 * Time: 11:36
 * To change this template use File | Settings | File Templates.
 */
class MetaViewCountReceiver {
    protected $object;

    public function __construct(StdClass $post){
        $this->object = new MetaViewCountObject($post);
    }

    public function getObject(){
        return $this->object;
    }

    public function incrementPost(){
        $this->object->incrementTotal();
    }
}
