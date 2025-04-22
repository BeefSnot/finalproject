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
        // Ensure we're storing clean data without any debug text
        return $this->redis->setex($key, $ttl, $value);
    }

    public function get($key) {
        // Get the raw value without adding any debug text
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