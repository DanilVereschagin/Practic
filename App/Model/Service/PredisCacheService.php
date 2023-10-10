<?php

declare(strict_types=1);

namespace App\Model\Service;

use Predis\Client;
use Psr\SimpleCache\CacheInterface;

class PredisCacheService implements CacheInterface
{
    protected Client $redis;

    public function __construct()
    {
        $this->redis = new Client();
        $this->redis->connect('127.0.0.1', 6379);
    }

    public function get($key, $default = null)
    {
        $cacheData = $this->redis->get($key);

        return json_decode($cacheData);
    }

    public function set($key, $value, $ttl = null)
    {
        $this->redis->set($key, json_encode($value));
    }

    public function delete($key)
    {
        $this->redis->del($key);
    }

    public function clear()
    {
        // TODO: Implement clear() method.
    }

    public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    public function deleteMultiple($keys)
    {
        // TODO: Implement deleteMultiple() method.
    }

    public function has($key)
    {
        // TODO: Implement has() method.
    }
}
