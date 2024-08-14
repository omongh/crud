<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize message variable
$message = "";

// Retrieve ID from URL and POST data
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && $id && $name && $email) {
    // Update record
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $message = "Record updated successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Fetch the record to be updated
if ($id) {
    $sql = "SELECT name, email FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $name = $user['name'];
        $email = $user['email'];
    } else {
        die("Record not found.");
    }
} else {
    die("Invalid ID.");
}

mysqli_close($conn);

// Include the HTML file to display the form
include '../html/update.html';  // Path to the HTML file
?>
