<?php

declare(strict_types=1);

namespace App\Model\Service;

use Psr\SimpleCache\CacheInterface;

class FileCacheService implements CacheInterface
{
    protected function getKey(string $key)
    {
        return APP_ROOT . '/var/cache/' . $key;
    }

    public function get($key, $default = null)
    {
        $key = $this->getKey($key);
        $cacheData = file_get_contents($key);

        return $cacheData;
    }

    public function set($key, $value, $ttl = null)
    {
        $key = $this->getKey($key);
        file_put_contents($key, $value);
    }

    public function delete($key)
    {
        $key = $this->getKey($key);
        unlink($key);
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
