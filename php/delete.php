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

// Retrieve ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    // Delete record
    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $message = "Record deleted successfully.";
    } else {
        $message = "Error deleting record: " . mysqli_error($conn);
    }
} else {
    $message = "Invalid ID.";
}

mysqli_close($conn);

// Redirect to read.php with a message
header("Location: read.php?message=" . urlencode($message));
exit();
?>
