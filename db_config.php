<?php
$servername = "localhost";
$username = "depacom_eatery";
$password = "Super32870679";
$dbname = "depacom_eatery";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "| Connected successfully | \n";

}
?>
