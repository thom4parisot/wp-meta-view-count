<?php

require_once dirname(__FILE__) . '/StorageStrategyInterface.php';

/**
 * Post/Page database storage
 * Data are stored as MySQL column in a naive approach
 *
 * @todo creates column for storage if needed on plugin activation
 */
class ColumnStorage implements StorageStrategyInterface {
    protected $options = array();

    /**
     * @see StorageStrategyInterface::get()
     */
    public function get($what){
        return (int)$this->options['object']->{$what};
    }

    /**
     * @see StorageStrategyInterface::set()
     */
    public function set($what, $value){
        /** @param WPDB $wpdb */
        global $wpdb;

        $wpdb->update($wpdb->posts, array($what => $value), array('ID' => $this->options['object_id']), array('%d'), array('%d'));
    }

    /**
     * @see StorageStrategyInterface::delete()
     */
    public function delete($what){
        $this->set($what, 0);
    }

    /**
     * @see StorageStrategyInterface::setOption()
     */
    public function setOption($key, $value){
        $this->options[ $key ] = $value;
    }

    /**
     * @see StorageStrategyInterface::getOption()
     */
    public function getOption($key){
        return isset($this->options[ $key ]) ? $this->options[ $key ] : null;
    }
}
