<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = "contact@lumisolutions.tech"; // Replace with your email address
    $subject = "New Contact Form Submission from SPRK Radio";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Email body
    $body = "You have received a new message from SPRK Radio:\n\n" .
            "Name: $name\n" .
            "Email: $email\n\n" .
            "Message:\n$message\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        echo "error: Unable to send email. Please try again later.";
    }
}
?>