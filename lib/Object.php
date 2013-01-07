<?php

require dirname(__FILE__) . '/strategies/Column.php';
//require dirname(__FILE__) . '/strategies/Meta.php';

/**
 *
 */
class MetaViewCountObject {
    /**
     * @var StdClass WordPress Post/Page object
     */
    protected $object;

    /**
     * Probably not the best place to store that information (should be located in the storage handler)
     *
     * @var string Key identifier
     */
    public static $KEY_TOTAL_COUNT = 'view_count';

    /**
     * Initialize the business logic
     *
     * @param StdClass $object Post/Page WordPress object
     */
    public function __construct(StdClass $object){
        $this->object = $object;

        $this->storage = new ColumnStorage();
        $this->storage->setOption('object', $object);
        $this->storage->setOption('object_id', $object->ID);
    }

    /**
     * Increments a named counter
     *
     * @param string $what
     */
    protected function increment($what){
        $total = $this->get($what);

        $this->storage->set($what, $total + 1);
    }

    /**
     * Increments the total views counter
     *
     * @api
     */
    public function incrementTotal(){
        $this->increment(self::$KEY_TOTAL_COUNT);
    }

    /**
     * Retrieves a named counter
     *
     * @param string $what
     * @return int
     */
    protected function get($what){
        return $this->storage->get($what);
    }

    /**
     * Retrieves the total views counter
     *
     * @return int
     */
    public function getTotal(){
        return $this->get(self::$KEY_TOTAL_COUNT);
    }
}
