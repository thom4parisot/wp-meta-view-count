<?php

interface StorageStrategyInterface {
    /**
     * Retrieves a storage value
     *
     * @param string $what
     * @return string|int
     */
    public function get($what);

    /**
     * Sets a storage value
     * This should be persistent in your implementation
     *
     * @param string $what
     * @param string|int $value
     * @return null
     */
    public function set($what, $value);

    /**
     * Deletes a storage location
     * May not be applicable to all storage
     *
     * @param string $what
     * @return null
     */
    public function delete($what);

    /**
     * Sets a storage option
     * This usually lives in memory and has no persistence
     *
     * @param string $key
     * @param mixed $value
     * @return null
     */
    public function setOption($key, $value);

    /**
     * Retrieves a storage option
     *
     * @param string $key
     * @return mixed
     */
    public function getOption($key);
}
