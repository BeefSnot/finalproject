<?php
require_once 'redis.php';

// Start with clean output buffer
ob_clean();
ob_start();

$cache = new RedisCache();

// Cache key for dynamic content
$cacheKey = 'dynamic_content';
$cacheTTL = 3600; // Cache for 1 hour

header('Content-Type: application/json'); // Ensure the response is JSON

// Check if the content is already cached
if ($cachedContent = $cache->get($cacheKey)) {
    // Output only the cached JSON without any extra text
    echo $cachedContent;
    ob_end_flush();
    exit;
}

// Generate dynamic content
$quotes = [
    ['content' => "Life’s too short to skip dessert. 🍰", 'author' => "Anonymous"],
    ['content' => "You’re paws-itively amazing! 🐾", 'author' => "Anonymous"],
    ['content' => "Believe in yourself, and you’ll be unstoppable. 💪", 'author' => "Anonymous"],
    ['content' => "Happiness is a warm puppy. 🐶", 'author' => "Charles M. Schulz"],
    ['content' => "You’re doing great, sweetie! 🌟", 'author' => "Kris Jenner"],
    ['content' => "When nothing goes right, go left. ⬅️", 'author' => "Anonymous"],
    ['content' => "You’re the sprinkles on my cupcake! 🧁", 'author' => "Anonymous"],
    ['content' => "Keep your face to the sunshine and you cannot see a shadow. 🌞", 'author' => "Helen Keller"],
    ['content' => "Be yourself; everyone else is already taken. 🌈", 'author' => "Oscar Wilde"],
    ['content' => "You’re one of a kind! 🌟", 'author' => "Anonymous"],
    ['content' => "Life’s too short to skip dessert. 🍰", 'author' => "Anonymous"],
    ['content' => "You’re paws-itively amazing! 🐾", 'author' => "Anonymous"],
    ['content' => "Believe in yourself, and you’ll be unstoppable. 💪", 'author' => "Anonymous"],
    ['content' => "Happiness is a warm puppy. 🐶", 'author' => "Charles M. Schulz"],
    ['content' => "You’re doing great, sweetie! 🌟", 'author' => "Kris Jenner"],
    ['content' => "When nothing goes right, go left. ⬅️", 'author' => "Anonymous"],
    ['content' => "You’re the sprinkles on my cupcake! 🧁", 'author' => "Anonymous"],
    ['content' => "Keep your face to the sunshine and you cannot see a shadow. 🌞", 'author' => "Helen Keller"],
    ['content' => "Be yourself; everyone else is already taken. 🌈", 'author' => "Oscar Wilde"],
    ['content' => "You’re one of a kind! 🌟", 'author' => "Anonymous"],
    ['content' => "Dream big, sparkle more, shine bright. ✨", 'author' => "Anonymous"],
    ['content' => "You’re the bee’s knees! 🐝", 'author' => "Anonymous"],
    ['content' => "Stay wild, moon child. 🌙", 'author' => "Anonymous"],
    ['content' => "You’re a gem! 💎", 'author' => "Anonymous"],
    ['content' => "Life is short, eat the cake! 🎂", 'author' => "Anonymous"],
    ['content' => "You’re a limited edition! 🌟", 'author' => "Anonymous"],
    ['content' => "Be a voice, not an echo. 📣", 'author' => "Anonymous"],
    ['content' => "You’re the cherry on top! 🍒", 'author' => "Anonymous"],
    ['content' => "Shine bright like a diamond. 💎", 'author' => "Rihanna"],
    ['content' => "You’re the sunshine on a rainy day! ☀️", 'author' => "Anonymous"],
    ['content' => "Keep calm and carry on. 😌", 'author' => "Anonymous"],
    ['content' => "You’re a star! 🌟", 'author' => "Anonymous"],
    ['content' => "Be the reason someone smiles today. 😊", 'author' => "Anonymous"],
    ['content' => "You’re the apple of my eye! 🍏", 'author' => "Anonymous"],
    ['content' => "Stay positive, work hard, make it happen. 💪", 'author' => "Anonymous"],
    ['content' => "You’re the Beyoncé of whatever you do. 👑", 'author' => "Anonymous"],
    ['content' => "Be a cupcake in a world of muffins. 🧁", 'author' => "Anonymous"],
    ['content' => "You’re the peanut butter to my jelly! 🥜🍇", 'author' => "Anonymous"],
    ['content' => "Keep your heels, head, and standards high. 👠", 'author' => "Coco Chanel"],
    ['content' => "You’re the light in my life! 💡", 'author' => "Anonymous"],
    ['content' => "Slay the day, because you’re fabulous. 💃", 'author' => "Anonymous"],
    ['content' => "Be a pineapple: stand tall, wear a crown, and be sweet on the inside. 🍍", 'author' => "Anonymous"],
    ['content' => "You’re one in a melon! 🍉", 'author' => "Anonymous"],
    ['content' => "Keep shining, the world needs your light. ✨", 'author' => "Anonymous"],
    ['content' => "Don’t stop until you’re proud. 🌈", 'author' => "Anonymous"],
    ['content' => "You’re the cat’s whiskers! 🐱", 'author' => "Anonymous"],
    ['content' => "If you can’t love yourself, how in the hell are you gonna love somebody else? 🌈", 'author' => "RuPaul"],
    ['content' => "Darling, don’t forget to fall in love with yourself first. 💖", 'author' => "Carrie Bradshaw"],
    ['content' => "Pour yourself a drink, put on some lipstick, and pull yourself together. 💄", 'author' => "Elizabeth Taylor"],
    ['content' => "I’m not bossy, I’m the boss. 💼", 'author' => "Beyoncé"],
    ['content' => "You were born to stand out, not fit in. 🌟", 'author' => "Lady Gaga"],
    ['content' => "Be the flamingo in a flock of pigeons. 🦩", 'author' => "Anonymous"],
    ['content' => "You are powerful, beautiful, brilliant, and brave. 💪", 'author' => "Laverne Cox"],
    ['content' => "Normal is not something to aspire to, it’s something to get away from. 🌈", 'author' => "Jodie Foster"],
    ['content' => "Don’t be a drag, just be a queen. 👑", 'author' => "Lady Gaga"],
    ['content' => "You’re a rainbow in someone’s cloud. 🌈", 'author' => "Maya Angelou"],
    ['content' => "Elegance is the only beauty that never fades. 💎", 'author' => "Audrey Hepburn"],
    ['content' => "You’re a diamond, darling. They can’t break you. 💎", 'author' => "Anonymous"],
    ['content' => "Love is love. 🌈", 'author' => "Anonymous"],
    ['content' => "The only way to make sense out of change is to plunge into it, move with it, and join the dance. 💃", 'author' => "Alan Watts"],
    ['content' => "You are enough, just as you are. 💖", 'author' => "Meghan Markle"],
    ['content' => "The future belongs to those who believe in the beauty of their dreams. 🌟", 'author' => "Eleanor Roosevelt"],
    ['content' => "Be the change that you wish to see in the world. 🌍", 'author' => "Mahatma Gandhi"],
    ['content' => "No one can make you feel inferior without your consent. 💪", 'author' => "Eleanor Roosevelt"],
    ['content' => "You are the artist of your own life. Don’t hand the paintbrush to anyone else. 🎨", 'author' => "Anonymous"],
    ['content' => "History is made by those who break the rules. 🏳️‍🌈", 'author' => "Harvey Milk"],
    ['content' => "Be proud of who you are, and not ashamed of how someone else sees you. 🌈", 'author' => "Anonymous"],
    ['content' => "You don’t have to be perfect to be amazing. ✨", 'author' => "Anonymous"],
    ['content' => "The most courageous act is still to think for yourself. Aloud. 🗣️", 'author' => "Coco Chanel"],
    ['content' => "We are all born naked, and the rest is drag. 💄", 'author' => "RuPaul"],
    ['content' => "Do not wait for someone else to come and speak for you. It’s you who can change the world. 🌍", 'author' => "Malala Yousafzai"],
    ['content' => "Be the rainbow in someone else’s cloud. 🌈", 'author' => "Maya Angelou"],
    ['content' => "You are never too small to make a difference. 🌱", 'author' => "Greta Thunberg"],
    ['content' => "Be fearless in the pursuit of what sets your soul on fire. 🔥", 'author' => "Jennifer Lee"],
    ['content' => "You are valid. You are loved. You are enough. 🌈", 'author' => "Anonymous"],
    ['content' => "The beauty of standing up for your rights is others see you standing and stand up as well. ✊", 'author' => "Cassandra Duffy"],
    ['content' => "Be loud. Be proud. Be unapologetically you. 🌟", 'author' => "Anonymous"],
    ['content' => "Courage starts with showing up and letting ourselves be seen. 💖", 'author' => "Brené Brown"],
    ['content' => "You are not a drop in the ocean. You are the entire ocean in a drop. 🌊", 'author' => "Rumi"],
    ['content' => "Be a voice for those who have none. 🗣️", 'author' => "Anonymous"],
    ['content' => "Equality means more than passing laws. The struggle is really won in the hearts and minds of the community. ❤️", 'author' => "Barbara Gittings"],
    ['content' => "Be the glitter in the dark. ✨", 'author' => "Anonymous"],
    ['content' => "You are the hero of your own story. 🦸", 'author' => "Joseph Campbell"],
    ['content' => "Be kind, for everyone you meet is fighting a hard battle. 💕", 'author' => "Ian Maclaren"],
    ['content' => "The best way to predict the future is to create it. 🌟", 'author' => "Abraham Lincoln"],
    ['content' => "You are the magic you’ve been waiting for. ✨", 'author' => "Anonymous"],
    ['content' => "Be the kind of person that makes others feel seen, heard, and loved. 💖", 'author' => "Anonymous"],
];

// Select a random quote
$randomQuote = $quotes[array_rand($quotes)];

// Fetch weather data using OpenWeatherMap API
$apiKey = '7f17c76e3536c4e2e69e150ce32f69b5'; // Replace with your API key
$city = 'Tulsa'; // Replace with your desired city
$weatherUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=imperial";

$weatherData = @file_get_contents($weatherUrl);
if ($weatherData) {
    $weatherData = json_decode($weatherData, true);
    if (isset($weatherData['weather'][0]['description']) && isset($weatherData['main']['temp'])) {
        $weatherDescription = $weatherData['weather'][0]['description'];
        $temperature = $weatherData['main']['temp'];
        $weather = "It's currently {$temperature}°F with {$weatherDescription} in {$city}.";
    } else {
        $weather = "Weather data is incomplete. Please try again later.";
    }
} else {
    $weather = "Unable to fetch weather data. Please try again later.";
}

// Prepare content
$content = [
    'status' => 'success',
    'data' => [
        'animations' => [
            'spark' => '<div class="spark" style="top: 10%; left: 15%; animation-delay: 0s;"></div>',
            'bubble' => '<div class="bubble" style="top: 20%; left: 10%; animation-delay: 0s;"></div>',
            'music_note' => '<div class="music-note" style="top: 30%; left: 15%; animation-delay: 0s;">🎵</div>',
        ],
        'quote' => $randomQuote,
        'weather' => $weather,
    ]
];

// Cache the content (clean JSON only)
$jsonContent = json_encode($content, JSON_PRETTY_PRINT);
$cache->set($cacheKey, $jsonContent, $cacheTTL);

// Return the JSON response (and nothing else)
echo $jsonContent;

// End output buffering
ob_end_flush();
?>