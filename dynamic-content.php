<?php
require_once 'redis.php';

$cache = new RedisCache();

// Cache key for dynamic content
$cacheKey = 'dynamic_content';
$cacheTTL = 3600; // Cache for 1 hour

// Check if the content is already cached
if ($cachedContent = $cache->get($cacheKey)) {
    echo $cachedContent;
    exit;
}

// Generate dynamic content (e.g., animations, quotes, weather data)
$content = [
    'animations' => [
        'spark' => '<div class="spark" style="top: 10%; left: 15%; animation-delay: 0s;"></div>',
        'bubble' => '<div class="bubble" style="top: 20%; left: 10%; animation-delay: 0s;"></div>',
        'music_note' => '<div class="music-note" style="top: 30%; left: 15%; animation-delay: 0s;">🎵</div>',
    ],
    'quote' => [
        'content' => 'Believe in yourself, and you’ll be unstoppable. 💪',
        'author' => 'Anonymous',
    ],
    'weather' => 'Sunny, 25°C 🌞',
];

// Cache the content
$cache->set($cacheKey, json_encode($content), $cacheTTL);

// Return the content
echo json_encode($content);
?>