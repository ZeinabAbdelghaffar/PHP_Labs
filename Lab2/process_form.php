<?php
// Start the session
session_start();
// Initialize variables
$name = $email = $message = $thanks = "";
$check = false;
// Function to sanitize user input
function convert_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = convert_input($_POST["name"]);
    $email = convert_input($_POST["email"]);
    $message = convert_input($_POST["message"]);
    // Validate name
    if (empty($name)) {
        $check = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $check = true;
    }
    // Validate email
    if (empty($email)) {
        $check = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check = true;
    }
    // Validate message
    if (empty($message)) {
        $check = true;
    }
    // If no validation errors, process the data
    if (!$check) {
        // Get user's IP address
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if ($ip_address == "::1" || $ip_address == "127.0.0.1") {
            $ip_address = "127.0.0.1";
        }
        // Check if this is the first visit or increment the visit counter
        if (!isset($_SESSION["is_visited"])) {
            $_SESSION["is_visited"] = true;
        } else {
            $_SESSION["counter"] = isset($_SESSION["counter"]) ? $_SESSION["counter"] + 1 : 1;
            echo "You visited the page before " . $_SESSION["counter"] . " times.";
        }
        // Write the log entry
        $line = date("F d Y h:i a") . ", " . $ip_address . ", " . $email . ", " . $name . ", " .  $_SESSION["counter"] . PHP_EOL;
        file_put_contents("log.txt", $line, FILE_APPEND);
    }
}
// Include config file and check if it's an array
$config = include 'config.php';
if (!is_array($config)) {
    // Handle the case when config.php does not return an array
    exit('Config file is not properly formatted.');
}
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
// Display log information
if (file_exists("log.txt")) {
    $imported_content = file("log.txt");
    echo "<div class='log' style='border-style: double; padding: 5px;' > <br/>";
    foreach ($imported_content as $line) {
        $line = explode(",", $line);
        echo "You visited this page " . $line[4] . " times<br/>";
        echo "Visit Date: " . $line[0] . "<br/>";
        echo "IP Address: " . $line[1] . "<br/>";
        echo "Email: " . $line[2] . "<br/>";
        echo "Name: " . $line[3] . "<br/>";
        echo "<hr><br/>";
    }
    echo "</div>";
}
?>