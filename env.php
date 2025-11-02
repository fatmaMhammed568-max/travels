
<?php
$host = "";
$username = "root";
$password = "";
$dbname = "travels";

$conn = new mysqli("localhost", $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->set_charset("utf8mb4");

?>