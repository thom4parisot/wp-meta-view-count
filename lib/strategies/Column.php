<?php

require_once dirname(__FILE__) . '/StorageStrategyInterface.php';

class ColumnStorage implements StorageStrategyInterface {
    protected $options = array();

    public function get($what){
        return (int)$this->options['object']->{$what};
    }

    public function set($what, $value){
        /** @param WPDB $wpdb */
        global $wpdb;

        $wpdb->update($wpdb->posts, array($what => $value), array('ID' => $this->options['object_id']), array('%d'), array('%d'));
    }

    public function delete($what){
        $this->set($what, 0);
    }

    public function setOption($key, $value){
        $this->options[ $key ] = $value;
    }

    public function getOption($key){
        return isset($this->options[ $key ]) ? $this->options[ $key ] : null;
    }
}
