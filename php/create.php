<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";
$message = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
echo "Connection Successful.<br>";  // This confirms that the connection was successful

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($conn, $sql)) {
    mysqli_select_db($conn, $dbname);

    // Create table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL
    )";
    
    if (mysqli_query($conn, $sql)) {
        // Check if form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

            if (mysqli_query($conn, $sql)) {
                $message = "New record created successfully";
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        $message = "Error creating table: " . mysqli_error($conn);
    }
} else {
    $message = "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);

// Output the message after the operation
if (!empty($message)) {
    echo $message;
}
?>
