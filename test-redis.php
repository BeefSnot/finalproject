<?php
if (!extension_loaded('redis')) {
    die('Redis extension is not installed or enabled.');
}

try {
    // Connect to Redis
    $redis = new Redis();
    $redis->connect('/home/lumisolutions/.redis/redis.sock');

    // Test setting a key
    $testKey = 'test_key';
    $testValue = 'Hello, Redis!';
    $redis->set($testKey, $testValue);

    // Test getting the key
    $retrievedValue = $redis->get($testKey);

    // Test deleting the key
    $redis->del($testKey);

    // Output results
    echo "Redis connection successful.<br>";
    echo "Set key: $testKey with value: $testValue<br>";
    echo "Retrieved value: $retrievedValue<br>";
    echo "Key deleted successfully.<br>";
} catch (RedisException $e) {
    die('Redis connection failed: ' . $e->getMessage());
}
?>