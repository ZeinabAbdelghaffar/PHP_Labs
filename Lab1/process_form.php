<?php
$config = include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $errors = array();
    
    // Validate name
    if (empty($name) || strlen($name) > $config['max_name_length']) {
        $errors[] = "Please enter a valid name (less than {$config['max_name_length']} characters).";
    }
    
    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    
    // Validate message
    if (empty($message) || strlen($message) > $config['max_message_length']) {
        $errors[] = "Please enter a message (less than {$config['max_message_length']} characters).";
    }
    
    // If there are no errors, display a thank you message
    if (empty($errors)) {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>Contact Form Submission</title>";
        echo "<link rel='stylesheet' type='text/css' href='styles.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='output'>";
        echo "<h3>Contact Form Submission</h3>";
        echo "<p>{$config['thank_you_message']}</p>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Message:</strong> $message</p>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        // Display error messages
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>Contact Form Submission</title>";
        echo "<link rel='stylesheet' type='text/css' href='styles.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='output'>";
        echo "<h3>Contact Form Submission</h3>";
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
}
?>
