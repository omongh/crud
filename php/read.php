
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

// SQL query to select all records from the users table
$sql = "SELECT id, name, email FROM users";
$result = mysqli_query($conn, $sql);

// Store the result in an array to pass to the HTML file
$users = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
} else {
    $users = null;  // No records found
}

mysqli_close($conn);

// Get the message from the URL
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

include '../html/read.html';
?>
