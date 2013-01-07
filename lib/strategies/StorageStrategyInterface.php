<?php

interface StorageStrategyInterface {
    public function get($what);

    public function set($what, $value);

    public function delete($what);

    public function setOption($key, $value);

    public function getOption($key);
}
