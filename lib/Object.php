<?php

require dirname(__FILE__) . '/strategies/Column.php';
//require dirname(__FILE__) . '/strategies/Meta.php';

class MetaViewCountObject {
    protected $object;

    public static $KEY_TOTAL_COUNT = 'view_count';

    public function __construct(StdClass $object){
        $this->object = $object;

        $this->storage = new ColumnStorage();
        $this->storage->setOption('object', $object);
        $this->storage->setOption('object_id', $object->ID);
    }

    protected function increment($what){
        $total = $this->get($what);

        $this->storage->set($what, $total + 1);
    }

    public function incrementTotal(){
        $this->increment(self::$KEY_TOTAL_COUNT);
    }

    protected function get($what){
        return $this->storage->get($what);
    }

    public function getTotal(){
        return $this->get(self::$KEY_TOTAL_COUNT);
    }
}
