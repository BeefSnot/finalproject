<?php
require_once 'redis.php';

$cache = new RedisCache();
$cache->clearAll();

echo "Redis cache cleared successfully!";
?>