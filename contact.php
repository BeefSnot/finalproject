<?php
require_once 'redis.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $cache = new RedisCache();
    $cacheKey = "contact_form_" . md5($email . $message);

    // Check if the message is already cached
    if ($cache->get($cacheKey)) {
        echo "duplicate";
        exit;
    }

    // Email details
    $to = "contact@lumisolutions.tech";
    $subject = "New Contact Form Submission from SPRK Radio";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    $body = "You have received a new message from SPRK Radio:\n\n" .
            "Name: $name\n" .
            "Email: $email\n\n" .
            "Message:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        // Cache the message to prevent duplicates
        $cache->set($cacheKey, json_encode(['name' => $name, 'email' => $email, 'message' => $message]), 3600);
        echo "success";
    } else {
        echo "error";
    }
}
?>