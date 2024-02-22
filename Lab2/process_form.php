<?php
// Start the session to store session variables
session_start();

// Define variables and initialize with empty values
$nameErr = $emailErr = $messageErr = "";
$name = $email = $message = "";
$thanks = "";
$check = 0;
$config = [
    'thank_you_message' => 'Your custom thank you message here',
];

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted with the 'submit' button
    if (isset($_POST['submit'])) {
        // Process form data
        $name = convert_input($_POST["name"]);
        $email = convert_input($_POST["email"]);
        $message = convert_input($_POST["message"]);

        // Validate name
        if (empty($name)) {
            $nameErr = "Name is required";
            $check = 1;
        } else {
            process_name($name);
        }

        // Validate email
        if (empty($email)) {
            $emailErr = "Email is required";
            $check = 1;
        } else {
            process_email($email);
        }

        // Validate message
        if (empty($message)) {
            $messageErr = "Empty Message";
            $check = 1;
        } else {
            process_message($message);
        }

        // If no errors, process the form and write logs
        if ($check == 0) {
            // Modify the thanks message
            echo "<h3>Contact Form Submission</h3>";
            echo "<p>Thank You for contacting us :)</p>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Message:</strong> $message</p>";
            write_logs($name, $email);

            // Read and display the contents of log.txt in a table
            if (file_exists("log.txt")) {
                $log_contents = file("log.txt");
                if (!empty($log_contents)) {
                    echo "<h3>Log Contents</h3>";
                    echo "<table border='1'>";
                    echo "<tr><th>Date</th><th>IP Address</th><th>Email</th><th>Name</th><th>Visits</th><th>Browser</th></tr>";
                    foreach ($log_contents as $line) {
                        $fields = explode(",", $line);
                        echo "<tr>";
                        foreach ($fields as $field) {
                            echo "<td>$field</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Log file is empty.";
                }
            } else {
                echo "Log file not found.";
            }
        } else {
            $thanks = "";
        }
    }
}

// Function to process name
function process_name($name) {
    global $nameErr, $check;
    $name = convert_input($name);
    if (strlen($name) < 255) {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    } else {
        $nameErr = "Name Should be shorter than 100 characters";
        $check = 1;
    }
}

// Function to process email
function process_email($email) {
    global $emailErr, $check;
    $email = convert_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $check = 1;
    }
}

// Function to process message
function process_message($message) {
    global $messageErr, $check;
    if (strlen($message) < 255) {
        $message = convert_input($message);
    } else {
        $messageErr = "Message Should be shorter than 255 characters";
        $check = 1;
    }
}

// Function to write logs
function write_logs($name, $email) {
    global $thanks;
    $ip_address = $_SERVER['REMOTE_ADDR'];
    if ($ip_address === '::1') {
        $ip_address = '127.0.0.1';
    }
    if (!isset($_SESSION["is_visited"])) {
        $_SESSION["is_visited"] = true;
        $_SESSION["counter"] = 1; // Initialize counter
    } else {
        $_SESSION["counter"] = isset($_SESSION["counter"]) ? $_SESSION["counter"] + 1 : 1;
        echo "You visited the page before " . $_SESSION["counter"] . " times.";
    }
    if (file_exists("log.txt")) {
        $fp = fopen("log.txt", "a+");
        $line = date("F d Y h:m a") . ", " . $ip_address . ", " . $email . ", " . $name . ", " .  $_SESSION["counter"] . ", " . $_SERVER['HTTP_USER_AGENT'] . PHP_EOL; // Include the browser information
        fwrite($fp, $line);
        fclose($fp);
        $thanks = "Thank You";
    } else {
        $fp = fopen("log.txt", "w");
        fclose($fp);
    }
}


// Function to sanitize input data
function convert_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>