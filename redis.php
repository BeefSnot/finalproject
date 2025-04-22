<?php
if (!extension_loaded('redis')) {
    die('Redis extension is not installed or enabled.');
}

class RedisCache {
    private $redis;

    public function __construct() {
        $this->redis = new Redis();
        $this->connect();
    }

    private function connect() {
        try {
            $this->redis->connect('/home/lumisolutions/.redis/redis.sock');
        } catch (RedisException $e) {
            die('Redis connection failed: ' . $e->getMessage());
        }
    }

    public function set($key, $value, $ttl = 3600) {
        return $this->redis->setex($key, $ttl, $value);
    }

    public function get($key) {
        return $this->redis->get($key);
    }

    public function delete($key) {
        return $this->redis->del($key);
    }

    public function clearAll() {
        return $this->redis->flushAll();
    }
}
?>