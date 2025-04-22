<?php
require_once 'redis.php';

$cache = new RedisCache();
if ($cache->clearAll()) {
    echo "Cache cleared successfully!";
} else {
    echo "Failed to clear cache.";
}
?>